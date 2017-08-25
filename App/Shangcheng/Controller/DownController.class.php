<?php

namespace Shangcheng\Controller;
use Think\Controller;
use Common\Lib\String; //引入类函数
use Common\Lib\Category; //引入类函数
use Common\Lib\Common; //引入类函数
class DownController extends Controller {
	/**
	 * 公告咨询控制器
	 */
    public function index(){

		//var_dump($gg);die();
		$data_geren = M('Down')->where('fid=9')->select();
		$this->assign('data',$data_geren);
		$this->display();
    }
	//详情

	
}