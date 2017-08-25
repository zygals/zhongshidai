<?php

namespace Shangcheng\Controller;
use Think\Controller;
use Common\Lib\String; //引入类函数
use Common\Lib\Category; //引入类函数
use Common\Lib\Common; //引入类函数
class NoticeController extends Controller {
	/**
	 * 公告咨询控制器
	 */
	 
    public function index(){
		
		$this->display();
	}
	
}