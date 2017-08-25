<?php
namespace Shangchengmanage\Controller;
use Think\Controller;
class AdminController extends CommonController {
	/**
	 * 显示后台管理首页
	 */
    public function index(){
		//var_dump($_SESSION);
    	$this->display();
    }
    /**
     * 显示后台右边页面
     */
    public function right(){
    	//**查询admin表的数据
    	//**显示登录用户信息
    	$id=$_SESSION['id'];
//     	dump($id);
//     	exit;
    	$m=D('Admin');
    	$arr=$m->find($id);
    	//var_dump($arr);
    	$this->assign('v',$arr);
    	//显示站点统计
    	$m=D('User');
    	$countUser=$m->count();// 查询满足要求的总记录数
    	$this->assign('countUser',$countUser);
    	$m=D('News');
    	$countNews=$m->count();// 查询满足要求的总记录数
    	$this->assign('countNews',$countNews);
    	$m=D('Guestbook ');
    	$countGuestbook=$m->count();// 查询满足要求的总记录数
    	$this->assign('countGuestbook',$countGuestbook);
    	$m=D('Advert ');
    	$countAdvert=$m->count();// 查询满足要求的总记录数
    	$this->assign('countAdvert',$countAdvert);
    	$m=D('Notice ');
    	$countNotice=$m->count();// 查询满足要求的总记录数
    	$this->assign('countNotice',$countNotice);
    	//数据库大小
    	$dbtables = M()->query('SHOW TABLE STATUS');
    	$total = 0;
    	foreach ($dbtables as $k => $v) {
    		$dbtables[$k]['size'] = get_byte($v['data_length'] + $v['index_length']);
    		$total+=$v['data_length'] + $v['index_length'];
    	}
    	$this->assign('total', get_byte($total));
    	$this->display();
    }
    /**
     * login_out方法
     * 后台管理员退出
     */
    public function login_out(){
    	session_start();
    	session_unset();//删除所有session变量
    	session_destroy();//删除session文件
    	//$this->success('成功退出',U('login/index'));
		$this->redirect('login/index');
    }
    /**
     * 模板实例
     */
    public function code(){
    	//header("Content-Type:text/html; charset=utf-8");
    	$this->display();
    }
}