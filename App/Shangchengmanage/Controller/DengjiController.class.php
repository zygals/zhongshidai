<?php

namespace Shangchengmanage\Controller;
use Think\Controller;
use Common\Lib\Common; //引入类函数
use Common\Lib\String; //引入类函数
use Think\Upload;
use Think\Image;
class DengjiController extends CommonController {
	/**
	 * 分类管理
	 */
	public function index() {
		$m=M('Dengji');
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
	 * 分类编辑页面
	 */
	public function edit() {
		$id=I('get.id');
		$m=M('Dengji');
		$data = $m->find($id);
		if($data['tiaojian2_max'] == -1){
			$data['tiaojian2_max'] =  '';
			}  
		$data['pic']=substr($data['pic'],1,strlen($data['pic']));
		$this->assign('data',$data);
    	$this->display();
	}

	/**
	 * 分类编辑处理
	 */
	public function do_edit() {
		$id = $_POST['id'];
		$data['is_show']=I('post.is_show');
		$data['name']=I('post.name');
		$data['paixu']=I('post.paixu');
		
		$data['ticheng']=I('post.ticheng');
		$data['renwuliang_min']=I('post.renwuliang_min');
		$data['renwuliang_max']=I('post.renwuliang_max');
		$data['tiaojian1_min']=I('post.tiaojian1_min');
		$data['tiaojian1_max']=I('post.tiaojian1_max');
		$data['tiaojian2_min']=I('post.tiaojian2_min');
        $data['tiaojian2_max']=I('post.tiaojian2_max');
		
		$data['date']=time();
		$count=M('Dengji')->where(array('id' => $id))->data($data)->save();
		if ($count>0){
			$this->success('修改成功！',U('Dengji/index'));
		}
		else {
			$this->error('修改失败！');
		}
	}

	/**
	 * 添加分类
	 */
	public function add() {
		$this->display();
	}
	/**
	 * 添加分类处理
	 */
	public function do_add(){
		C('TOKEN_ON',false);
 		if(IS_POST){
			$m=M('Dengji');
			$data['name']=I('post.name');
			$data['ticheng']=I('post.ticheng');
			$data['renwuliang_min']=I('post.renwuliang_min');
			$data['renwuliang_max']=I('post.renwuliang_max');
			$data['tiaojian1_min']=I('post.tiaojian1_min');
			$data['tiaojian1_max']=I('post.tiaojian1_max');
			$data['tiaojian2_min']=I('post.tiaojian2_min');
			$data['tiaojian2_max']=I('post.tiaojian2_max');
			$data['is_show']=I('post.is_show');
			$data['date']=time();
			if($data['tiaojian2_max']=="")
			{
				 $data['tiaojian2_max']=-1;
				}
				else{
					$data['tiaojian2_max']=I('post.tiaojian2_max');
					}
			$count=$m->add($data);
			if ($count>0){
				$this->success('添加成功！',U('Dengji/index'));
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
		
		$m=M('Dengji');
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