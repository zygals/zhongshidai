<?php

namespace Shangchengpc\Controller;
use Think\Controller;
use Common\Lib\String; //引入类函数
use Common\Lib\Category; //引入类函数
use Common\Lib\Common; //引入类函数
class GonggaoController extends Controller {
	
	
	
	public function _initialize(){
	
	
			if(session('bh')){
			$this->assign('bh',session('bh'));
		}
	}
	
	
	
	/**
	 * 公告咨询控制器
	 */
    public function index(){

		$count=D('Gonggao')->where(array('is_show'=>1,'fid'=>1))->order('id desc')->count();// 查询满足要求的总记录数
		$Page = new \Think\Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show = $Page->show();// 分页显示输出
		$gg=D('Gonggao')->where(array('is_show'=>1,'fid'=>1))->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		foreach($gg as $k=>$v){
			$gg[$k]['content1']=htmlspecialchars_decode($v['content']);
		}
		//var_dump($gg);die();
  

		$this->assign('page',$show);// 赋值分页输出
		$this->assign('content',$arr);// 赋值分页输出
		$this->assign('gg',$gg);
		if(!session('config')){
			$config=D('Config')->find();
			session('config',$config);
		}else{
			$config=session('config');
		}
		

        $m=M('Goods');
        $arr1=$m->where('xf_fl="1"')->limit('2')->order('id desc')->select();   //爱国消费券
		$arr2=$m->where('index_post="1"')->limit('2')->order('id desc')->select();   //精品推荐
		$arr3=$m->limit('2')->order('date desc')->select();   //新品上架
		
		$this->assign('content1',$arr1);
		$this->assign('content2',$arr2);
		$this->assign('content3',$arr3);


		$this->assign('config',$config);
		$this->display();
    }
	//详情
	public function detail(){
		if(I('get.b')){
			$id=I('get.b');
			$detail=D('Gonggao')->find($id);
			$detail['content1']=htmlspecialchars_decode($detail['content']);
			$this->assign('dt',$detail);
		}
		if(!session('config')){
			$config=D('Config')->find();
			session('config',$config);
		}else{
			$config=session('config');
		}
		
       $m=M('Goods');
        $arr1=$m->where('xf_fl="1"')->limit('2')->order('id desc')->select();   //爱国消费券
		$arr2=$m->where('index_post="1"')->limit('2')->order('id desc')->select();   //精品推荐
		$arr3=$m->limit('2')->order('date desc')->select();   //新品上架
		
		$this->assign('content1',$arr1);
		$this->assign('content2',$arr2);
		$this->assign('content3',$arr3);


		$this->assign('config',$config);
		$this->display();
	}
	
}