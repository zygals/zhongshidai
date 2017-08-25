<?php

namespace Shangchengpc\Controller;
use Think\Controller;
use Common\Lib\String; //引入类函数
use Common\Lib\Category; //引入类函数
use Common\Lib\Common; //引入类函数
class SearchController extends Controller {
	/**
	 * 搜索控制器
	 */
    public function index(){
		if(!session('config')){
			$config=D('Config')->find();
			session('config',$config);
		}else{
			$config=session('config');
		}
		$this->assign('config',$config);
		$this->display();
    }
	
	
	
	
	public function search(){
		$keyword1=I('get.keyword');
		
		$keyword=trim($keyword1);

		//判断存在id
		/*if ($id==null){
			$this->assign('ifid',not);
		}*/
		if ($keyword==null){
			$this->error('请输入搜索关键字！');
		} 
		$m=D('Goods');
		$data['name']=array('like',"%{$keyword}%");
		//$arr=$m->where($data)->relation(true)->select();
		$arr=$m->where($data)->select();
		//$arr=$m->where("name like '%{$keyword}%'")->select();
	
    	//**分页实现代码
    	/*$count=count($arr);// 查询满足要求的总记录数
    	$Page = new \Think\Page($count,11);// 实例化分页类 传入总记录数和每页显示的记录数(25)
    	$show = $Page->show();// 分页显示输出
    	//**分页实现代码
		$data['user_name']=array('like',"%{$keyword}%");
		//$arr=$m->where($data)->relation(true)->limit($Page->firstRow.','.$Page->listRows)->select();
		//$arr=$m->where($data)->limit($Page->firstRow.','.$Page->listRows)->select();
		$arr=$m->where("user_login_bh='{$keyword}' or user_name like '%{$keyword}%'")->limit($Page->firstRow.','.$Page->listRows)->select();		
		
		
		
		
		foreach($arr as $k=>$v){
			if($v['user_dengji']==1){
				$arr[$k]['dj']='普通会员';
			}elseif($v['user_dengji']==2){
				$arr[$k]['dj']='结算中心';
			}elseif($v['user_dengji']==3){
				$arr[$k]['dj']='分公司';
			}
			if($v['user_sjid1']){
				$sj=$m->where(array('user_login_bh'=>$v['user_sjid1']))->find();
				$arr[$k]['sj']=$sj['user_name'];
			}
			if($v['user_sjid2']){
				$sj=$m->where(array('user_login_bh'=>$v['user_sjid2']))->find();
				$arr[$k]['sj2']=$sj['user_name'];
			}
		}*/
		
		
	
		//exit;
		if ($arr==null){
			$this->error('没有数据');
	
		}else{
			//**分页实现代码
			//$this->assign('show',$show);// 赋值分页输出
			//**分页实现代码
			$this->assign('vlist',$arr); //在新查询到的数据再分配给前台模板显示
		//	$this->assign('count',$count);
			$this->display('list'); //指定模板
		}
	
	}
public function message(){
		$xx=D('message')->where('gb_dell=0')->select();
		$bh=session('bh');
	  if(session('bh')){
				$k=0;
				$mesary=array();
				$mesary1=array();
				 foreach($xx as $vo)
				 {	
					 if($vo['gb_user_bh']){
						 $arbh=$vo['gb_user_bh'];
						 $ary=explode(",",$arbh);
						 if(in_array($bh,$ary)){
							  $map['gb_user_bh']=  array('LIKE',$bh.'%');
							  $map['gb_dell']=0; 
							  $map['gb_read']=0;  
							  $znxx=D('message')->where($map)->select();
							  $mesary=$znxx;
							}
					    }else{
							if($k==0){
							  $map1['gb_user_bh']='';
							  $map1['gb_dell']=0; 
							  $znxx1=D('message')->where($map1)->select();
							  $mesary1=$znxx1;
							  $k=1;
							}
						}
				 }
		}
					foreach($mesary as $key=>$vk)
							{
								$mesary1[]=$vk;
							}
		$this->assign('message',$mesary1);
		$this->display();	
			}

public function messagedetail(){
		if(I('get.id')){
			
			$id=I('get.id');
			$detail=D('message')->find($id);
			$detail['content1']=htmlspecialchars_decode($detail['content']);

			$data['gb_read']=1;
			$det=D('message')->where('id='.$id)->save($data);
			$this->assign('dt',$detail);
			
		}
		$this->display();
	}

}