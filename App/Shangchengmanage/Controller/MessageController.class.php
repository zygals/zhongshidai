<?php

namespace Shangchengmanage\Controller;
use Think\Controller;
use Common\Lib\Category; //引入类函数
use Common\Lib\Common; //引入类函数
use Common\Lib\String; //引入类函数
class MessageController extends CommonController {
	
 public function index(){
	   $h=M('message');
    	//**分页实现代码
    	$count=$h->count();// 查询满足要求的总记录数
    	$Page = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
    	$show = $Page->show();// 分页显示输出
    	//**分页实现代码
		$arr=$h->limit($Page->firstRow.','.$Page->listRows)->where('gb_dell=0')->order('id desc')->select();
		$this->assign('page',$show);// 赋值分页输出
		//**分页实现代码
		$this->assign('vlist',$arr);
		$this->assign('count',$count);
		$this->display();
	 }

public function add() {
		$hy=D('user')->select();
		$this->assign('hy',$hy);
		$this->display();
	}

public function do_add() {
		$hyxx=M('message');
		$data['gb_title']=I('post.mess_title');
		$data['gb_content']=I('post.mess_cont');
		
		$data['gb_user_bh']=I('POST.seleid');
		$data['gb_addtime']=time();
		if($data['gb_user_bh']=="")
		{
			$count=$hyxx->add($data);
		}else{
	    $data['gb_user_bh']=implode(",", $data['gb_user_bh']);
		$count=$hyxx->add($data);
		}
	   if ($count>0){
				$this->success('信息发送成功！',U('Message/index'));
			}else {
				$this->error('信息发送失败!',U('Message/add'));
			}
	}
public function edit() {
    	$id=I('get.id');
		$xg=D('message')->where('id='.$id)->select();
		$hy=D('user')->select();
		$this->assign('hy',$hy);
		$this->assign('xg',$xg);
    	$this->display();
	}
public function do_edit() {	
        $id=I('post.id');
        $hyxx=M('message');
		$data['gb_title']=I('post.mess_title');
		$data['gb_content']=I('post.mess_cont');
		$data['gb_user_bh']=I('POST.seleid');
		$data['gb_addtime']=time();
		if($data['gb_user_bh']=="")
		{
			$count=$hyxx->where('id='.$id)->save($data);
		}else{
	    $data['gb_user_bh']=implode(",", $data['gb_user_bh']);
		$count=$hyxx->where('id='.$id)->save($data);
		}
	   if ($count>0){
				$this->success('信息修改成功！',U('Message/index'));
			}else {
				$this->error('信息修改失败!',U('Message/edit'));
			}
}
public function del() {
		$m=M('message');
		$id=I('get.id');
		$del['gb_dell']=1;
		$count=$m->where('id='.$id)->save($del);
		if ($count>0){
			$this->success('删除成功！');
		     }
		else {
			$this->error('删除失败！');
		}
		
}
	


}
