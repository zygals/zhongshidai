<?php

namespace Shangchengmanage\Controller;
use Think\Controller;
use Common\Lib\Category; //引入类函数
use Common\Lib\Common; //引入类函数
use Common\Lib\String; //引入类函数
class FenhongController extends CommonController {
	/**
	 * 显示会员
	 */
	public function index() {
		$fenhong=D('Fenhong_bili')->select();
		$this->assign('fenhong',$fenhong);
		$this->display();
	}
	/*添加*/
	public function add() {
		if(isset($_POST['name'])){
			$data=array();
			$data['name']=$_POST['name'];
			$data['bili']=$_POST['bili'];
			$data['axjf_min']=$_POST['axjf_min'];	
			$data['status']=$_POST['status'];	
			$fenhong=M('Fenhong_bili');			
			$fenhongs=$fenhong->add($data);
			if($fenhongs){
				$this->success('新增成功',U('Fenhong/index'));	
			}else{
				$this->error('新增失败',U('Fenhong/index'));
			}	
		}
		$this->display();
		
	}
	public function addwt() {
		if(isset($_POST['name'])){
			$data=array();
			$data['name']=$_POST['name'];
			$data['bili']=$_POST['bili'];
			$data['axjf_min']=$_POST['axjf_min'];	
			$data['status']=$_POST['status'];	
			$fenhong=M('Fenhong_bili');			
			$fenhongs=$fenhong->add($data);
			if($fenhongs){
				$this->success('新增成功',U('Fenhong/index'));	
			}else{
				$this->error('新增失败',U('Fenhong/index'));
			}	
		}
	}	
	

	/*修改页面*/
	public function fenhong() {
		if($_GET['id']){
			$id=$_GET['id'];
			//echo $id;
			$fenhong=D('Fenhong_bili')->where('id='.$id)->select();	
			$this->assign('fenhong',$fenhong);
		}
		$this->display();
	}
	
	/*修改*/
	public function edit() {
		if(isset($_POST['id'])){
				$id=$_GET['id'];
				$data=array();	
				$data['name']=$_POST['name'];
				$data['bili']=$_POST['bili'];
				$data['axjf_min']=$_POST['axjf_min'];	
				$data['status']=$_POST['status'];	
				$bili=M('Fenhong_bili');			
				$fhbili=$bili->where('id='.$id)->save($data);
				if($fhbili){
					$this->success('修改成功',U('Fenhong/index'));	
				}else{
					$this->error('修改失败',U('Fenhong/index'));
				}
			}	
	}
	
	/*删除*/
	public function del(){
		if($_GET['id']){
			$id=$_GET['id'];
			$result=D('Fenhong_bili')->where('id='.$id)->delete();		
			if($result){
				$this->success('删除成功',U("Fenhong/index"));	
			}else{
				$this->error('删除失败',U("Fenhong/index"));
			}	
		}		
	}	
	
}






?>