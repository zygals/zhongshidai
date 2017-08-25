<?php
namespace Shangchengmanage\Controller;
use Think\Controller;
class CommonController extends Controller {
	/**
	 * 公共验证控制器CommonAction
	 */
	Public function _initialize(){
		header("Content-Type:text/html; charset=utf-8");
		session_start();
		if (!isset($_SESSION['admin_name']) || $_SESSION['admin_name']==''){
			//$this->error('请勿无权访问！你的ip已被记录',U('Login/index'));
			$this->redirect('/Shangchengmanage/Login/index');
		}
	}
}