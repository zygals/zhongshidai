<?php

namespace Shangchengmanage\Controller;
use Think\Controller;
use Common\Lib\Category; //引入类函数
use Common\Lib\Common; //引入类函数
use Common\Lib\String; //引入类函数
class XipuController extends CommonController {
	/**
	 * 显示会员
	 */
	public function index() {
		if(I('post.keyword')){
			$bh=I('post.keyword');
			$user=D('User')->where(array('user_login_bh'=>$bh))->find();
			
			$zhitui=D('User')->where(array('user_sjid1'=>$user['user_login_bh']))->select();
			//var_dump($zhitui);die();
			foreach($zhitui as $k=>$v){
				if($k==0){
					$source1="{source : '".$user['user_name']."', target : '".$v['user_name']."', weight : 4, itemStyle: {
							normal: { color: 'red' }
						}},";
				}
				//$category.="{category:1, name: '".$v['user_name']."'},";
				$category.="{category:1, name: '".$v['user_name']."',value : '".$v['id']."'},";
				if($k>0){
					$source.="{source : '".$user['user_name']."', target : '".$v['user_name']."', weight : 4},";
				}
			}
		}elseif(I('get.id')){
			$id=I('get.id');
			$user=D('User')->where(array('id'=>$id))->find();
			
			$zhitui=D('User')->where(array('user_sjid1'=>$user['user_login_bh']))->select();
			//var_dump($zhitui);die();
			foreach($zhitui as $k=>$v){
				if($k==0){
					$source1="{source : '".$user['user_name']."', target : '".$v['user_name']."', weight : 4, itemStyle: {
							normal: { color: 'red' }
						}},";
				}
				//$category.="{category:1, name: '".$v['user_name']."'},";
				$category.="{category:1, name: '".$v['user_name']."',value : '".$v['id']."'},";
				if($k>0){
					$source.="{source : '".$user['user_name']."', target : '".$v['user_name']."', weight : 4},";
				}
			}
		}else{
			$user=D('User')->where(array('id'=>1))->find();
			$zhitui=D('User')->where(array('user_sjid1'=>$user['user_login_bh']))->select();
			foreach($zhitui as $k=>$v){
				if($k==0){
					$source1="{source : '".$user['user_name']."', target : '".$v['user_name']."', weight : 4, itemStyle: {
							normal: { color: 'red' }
						}},";
				}
				//$category.="{category:1, name: '".$v['user_name']."'},";
				$category.="{category:1, name: '".$v['user_name']."',value : '".$v['id']."'},";
				if($k>0){
					$source.="{source : '".$user['user_name']."', target : '".$v['user_name']."', weight : 4},";
				}
			}
		}
		//var_dump($zhitui);die();
		$this->assign('user',$user);
		$this->assign('category',$category);
		$this->assign('source',$source);
		$this->assign('source1',$source1);
		$this->display();
	}
	
	
}



?>