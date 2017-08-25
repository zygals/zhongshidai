<?php

namespace Shangchengpc\Controller;
use Think\Controller;
use Common\Lib\String; //引入类函数
use Common\Lib\Category; //引入类函数
use Common\Lib\Common; //引入类函数
class GouwuzhongxinController extends Controller {
	
	public function _initialize(){
	
		if(session('bh')){
			if(I('get.b')){
				session('bh',I('get.b'));
			}
		}
	
			if(session('bh')){
				
			$this->assign('bh',session('bh'));
		}
	}
	
	
	/**
	 * 购物中心控制器
	 */
    public function index(){
		$fenlei=D('Goodsfenlei')->where(array('is_show'=>1))->order('paixu asc')->select();
		$this->assign('fl',$fenlei);
		if(!session('config')){
			$config=D('Config')->find();
			session('config',$config);
		}else{
			$config=session('config');
		}
	
		$this->assign('config',$config);
		$this->display();
    }
	/**
	 * 分类
	 */
    public function product(){
    	//get .f = 可用积分
    	//get. m = 爱国积分
    	$ks=0;
		$num=10;

    	$model = M('goodsfenlei')->select();
    	$grade = array();
	    	$grade[0]['min'] = '0';
	    	$grade[0]['max'] = '100';
	    	
	    	$grade[1]['min'] = '100';
	    	$grade[1]['max'] = '500';
	    	
	    	$grade[2]['min'] = '500';
	    	$grade[2]['max'] = '1000';
	    	
	    	$grade[3]['min'] = '1000';
	    	$grade[3]['max'] = '2000';
	    	
	    	$grade[4]['min'] = '2000';
	    	$grade[4]['max'] = '3000';
	    	
	    	$grade[5]['min'] = '3000';
	    	$grade[5]['max'] = '5000';
		$this->assign('list',$model);
		$this->assign('f',I('get.f'));
		$this->assign('min',I('get.min'));
		$this->assign('max',I('get.max'));
		
		$this->assign('date',I('get.date'));
		$this->assign('num',I('get.num'));
		$this->assign('price',I('get.price'));
		$this->assign('grade',$grade);

		if(I('get.f')){       //分类
			$where['fid'] = I('get.f');
		}
		$min = I('get.min')+0;    //起始积分
		$max = I('get.max')+0;    //结束积分
		if($min>0){
			if($max!=0){
				$where['jifen']['0'] = array('egt',$min);
				$where['jifen']['1'] = array('elt',$max);
			}else{
				$where['jifen']['0'] = array('egt',$min);
			}
		}else{
			if($max!=0){
				$where['jifen']['0'] = array('elt',$max);
			}
		}


		if(I('get.date')){		//日期排序
			$date = I('get.date');
			if($date = 1){
				$order = 'date asc';
			}else{
				$order = 'date desc';
			}
		}
		if(I('get.num')){		//销量排序
			$num = I('get.num');
			if($num = 1){
				$order = 'xiaoshou asc';
			}else{
				$order = 'xiaoshou desc';
			}
		}
		if(I('get.price')){		//价格排序
			$price = I('get.price');
			if($price = 1){
				$order = 'xianjing asc';
			}else{
				$order = 'xianjing desc';
			}
		}
		if(I('get.m')){
			$where['xf_fl'] = '1';
		}

		if(I('get.inp')==1){		//精选商品
			$where['index_post'] = '1';
		}
		$keyword = '%'.I('get.keyword').'%';
		if($keyword!=''){
			$where['name'] = array('like',$keyword);
		}
		$m=M('Goods');
		//**分页实现代码
		$count=$m->where($where)->order($order)->count();// 查询满足要求的总记录数
		$Page = new \Think\Page($count,48);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show = $Page->show();// 分页显示输出
		//**分页实现代码
		$arr=$m->where($where)->limit($Page->firstRow.','.$Page->listRows)->order($order)->select();
		//dump($arr);
		//exit;
		//**分页实现代码
		$this->assign('page',$show);// 赋值分页输出
		$this->assign('content',$arr);// 赋值分页输出
	

		$arr1=$m->where('xf_fl="1"')->limit('4')->order('id desc')->select();   //爱国消费券
		$arr2=$m->where('index_post="1"')->limit('4')->order('id desc')->select();   //精品推荐
		$arr3=$m->limit('4')->order('date desc')->select();   //新品上架
		$this->assign('content1',$arr1);
		$this->assign('content2',$arr2);
		$this->assign('content3',$arr3);
		$this->display();
    }
	
}