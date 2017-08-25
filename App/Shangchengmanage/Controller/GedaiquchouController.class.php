<?php
namespace Shangchengmanage\Controller;
use Think\Controller;
class GedaiquchouController extends CommonController {
	/**
	 * 网站配置信息展示
	*/ 

	public function index() {
	$m=M('gedaiquchou');
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
	 * 添加
	 */
	public function add() {
		$this->display();
	}
	/**
	 * 添加处理
	 */
	public function do_add(){
		C('TOKEN_ON',false);
		//var_dump($_POST);die();
 		if(IS_POST){
			$m=M('gedaiquchou');
			$data['min']=I('post.min');
			$data['max']=I('post.max');
			$data['jiangli']=I('post.jiangli');
			$count=$m->add($data);
			if ($count>0){
				$this->success('添加成功！',U('Gedaiquchou/index'));
			}else {
				$this->error('添加失败!');
			}
		}
	}	
		
	/**
	 * 编辑
	 */
	public function edit() {
		$id=I('get.id');
		$m=M('gedaiquchou');
		$data = $m->find($id);
		$this->assign('data',$data);
    	$this->display();
	}

	/**
	 * 编辑处理
	 */
	public function do_edit() {
		$id = $_POST['id'];
		
		$data['min']=I('post.min');
		$data['max']=I('post.max');
		$data['jiangli']=I('post.jiangli');
		$count=M('gedaiquchou')->where(array('id' => $id))->data($data)->save();
		if ($count>0){
			$this->success('修改成功！',U('Gedaiquchou/index'));
		}
		else {
			$this->error('修改失败！');
		}
	}
	
	
	/**
	 * 删除
	 */
	public function del() {//die(I('get.id'));
		$id=I('get.id');
		
		$m=M('gedaiquchou');
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

