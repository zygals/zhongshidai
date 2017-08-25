<?php

namespace Shangchengmanage\Controller;
use Think\Controller;
class IndexController extends CommonController {
	/**
	 * 首页展示
	 */
    public function index(){
		if (isset($_SESSION['admin_name']) || $_SESSION['admin_name']!=''){
		//echo U('Login/index');
			$this->redirect('/Shangchengmanage/Admin/index');	
		}
		$this->display();
    }
}