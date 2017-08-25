<?php
namespace Shangchengmanage\Controller;
use Think\Controller;
class CanshuManagerController extends CommonController {
	/**
	 * 网站配置信息展示
	*/ 

	public function index() {
	$m=M('qici');
	//**分页实现代码
	$count=$m->count();// 查询满足要求的总记录数
	$Page = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
	$show = $Page->show();// 分页显示输出
	//**分页实现代码
	
	$arr=$m->limit($Page->firstRow.','.$Page->listRows)->order('id desc')->select();
	
	//**分页实现代码
	$this->assign('page',$show);// 赋值分页输出
	//**分页实现代码
	$this->assign('vlist',$arr);
	$this->assign('count',$count);
	$this->display();
	
    }
	
	/**
	 * 删除分类
	 */
	public function del() {//die(I('get.id'));
		$id=I('get.id');
		
		$m=M('qici');
		$arr=$m->find($id);
		
		$count=$m->delete($id);
		if ($count>0){
			$this->success('删除成功！');
		}
		else {
			$this->error('删除失败！');
		}

	}
	
	
	
  
}