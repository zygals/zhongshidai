<?php

namespace Shangchengmanage\Controller;
use Think\Controller;
use Common\Lib\Common; //引入类函数
use Common\Lib\String; //引入类函数
use Think\Upload;
use Think\Image;
class GonggaoController extends CommonController {
	/**
	 * 公告管理
	 */
	public function index() {
		$m=M('Gonggao');
    	//**分页实现代码
    	$count=$m->count();// 查询满足要求的总记录数
    	$Page = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
    	$show = $Page->show();// 分页显示输出
    	//**分页实现代码
		
		$arr=$m->limit($Page->firstRow.','.$Page->listRows)->order('id desc')->select();
		foreach($arr as $k=>$v){
			if($v['fid']==1){
				$arr[$k]['fenlei']='公告';
			}else{
				$arr[$k]['fenlei']='资讯';
			}
		}
		//**分页实现代码
		$this->assign('page',$show);// 赋值分页输出
		//**分页实现代码
		$this->assign('vlist',$arr);
		$this->assign('count',$count);
		$this->display();
		
	}
	/**
	 * 分类编辑页面
	 */
	public function edit() {
		$id=I('get.id');
		$m=M('Gonggao');
		$data = $m->find($id);
		$fenlei=D('Goodsfenlei')->where(array('is_show'=>1))->order('paixu asc')->select();
		$this->assign('fl',$fenlei);
		$this->assign('data',$data);
    	$this->display();
	}

	/**
	 * 分类编辑处理
	 */
	public function do_edit() {
		$id = $_POST['id'];
		$data['is_show']=I('post.is_show');
		$data['fid']=I('post.fid');
		$data['title']=I('post.title');
		if(I('post.content')){$data['content']=I('post.content');}
		$data['paixu']=I('post.paixu');
		$data['date']=time();
		$count=M('Gonggao')->where(array('id' => $id))->data($data)->save();
		if ($count>0){
			$this->success('修改成功！');
		}
		else {
			$this->error('修改失败！');
		}
	}

	/**
	 * 添加商品
	 */
	public function add() {
		$fenlei=D('Goodsfenlei')->where(array('is_show'=>1))->order('paixu asc')->select();
		$this->assign('fl',$fenlei);
		$this->display();
	}
	
	public function do_add(){
		C('TOKEN_ON',false);
 		if(IS_POST){//var_dump($_POST);die();
			$m=M('Gonggao');
			$data['fid']=I('post.fid');
			$data['title']=I('post.title');
			$data['is_show']=I('post.is_show');
			$data['paixu']=I('post.paixu');
			$data['content']=I('post.content');
			$data['date']=time();
			//var_dump($data);die();
			$count=$m->add($data); //修改表单用save函数
			if ($count>0){
				$this->success('添加成功！',U('Gonggao/index'));
			}else {
				$this->error('添加失败!');
			}
		}
	}
	
	/**
	 * 删除分类
	 */
	public function del() {//die(I('get.id'));
		$id=I('get.id');
		
		$m=M('Gonggao');
		$arr=$m->find($id);
		//删除本地图片附件 unlink('图片url')
		unlink($arr["image"]);
		
		$count=$m->delete($id);
		if ($count>0){
			$this->success('删除成功！');
		}
		else {
			$this->error('删除失败！');
		}

	}
	

}

?>