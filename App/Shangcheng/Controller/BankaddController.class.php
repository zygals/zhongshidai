<?php

namespace Shangcheng\Controller;
use Think\Controller;
use Common\Lib\String; //引入类函数
use Common\Lib\Category; //引入类函数
use Common\Lib\Common; //引入类函数
class BankaddController extends Controller {
	public function _initialize(){
		//var_dump(session());die();
		if(session('admin_name')){
			if(I('get.b')){
				session('bh',I('get.b'));
			}
		}
		if(!session('bh')){
			header('location:/l.html');
		}
	}
	public function bangdyhk(){	
		if(session('bh')){
			$bh=session('bh');
			$hyid=session('id');
			$result=D('User')->where('user_login_bh="'.$bh.'"')->select();
			$this->assign('result',$result);
            $id = $result[0]['id'];
			//统计数据
			$tixian=M('User_card');			
			$result2=$tixian->where('uid='.$id)->order('id desc')->select();			
			$this->assign('result2',$result2);					
			/*删除*/
			if($_GET['del']){
				$id=I('get.id');
				$del=$tixian->where('id='.$id)->delete();						
				if($del){
					$this->success('删除成功',U('Bankadd/bangdyhk'));
					exit();
				}else{
					$this->error('删除失败',U('Bankadd/bangdyhk'));
					exit();
				}
			}
			$this->display();
	}

    }

	public function bangdyhkedit(){
		if(session('bh')){	
			$tixian=M('User_card');	
			/*审核*/		
			if($_GET['id']){
				$id=I('get.id');
				$shenhe=$tixian->where('id='.$id)->select();	
				$this->assign('shenhe',$shenhe);	
			}
			if($_POST['id']){
				$id=$_POST['id'];
				$data=array();
				$data['uid']=$_POST['uid'];
				$data['kaihu_name']=$_POST['kaihu_name'];
				$data['bank_name']=$_POST['bank_name'];
				$data['bank_kaohao']=$_POST['bank_kaohao'];
				$data['status']=$_POST['status'];
				$data['kaihu_hang']=$_POST['kaihu_hang'];
				$tixian=M('User_card');			
				$cardedit=$tixian->where('id='.$id)->save($data);
				if($cardedit){	
					$this->success('修改成功',U('Bankadd/bangdyhk'));
					exit();
					/*echo '<script type="text/javascript" > alert("修改成功！");</script>';
					$this->redirect('/Shangcheng/Bankadd/bangdyhk');//跳转*/
				}else{
					$this->error('修改失败',U('Bankadd/bangdyhk'));
					exit();
				}	
			}
			$this->display();
		}
    }	
	/*充值添加*/
	public function bangdyhkwr(){
		$data=array();
		$data['uid']=$_POST['uid'];
		$data['kaihu_name']=$_POST['kaihu_name'];
		$data['bank_name']=$_POST['bank_name'];
		$data['bank_kaohao']=$_POST['bank_kaohao'];
		$data['status']=$_POST['status'];
		$tixian=M('User_card');			
		$tixian->add($data);
		if($tixian->create()){	
			$this->success('绑定成功', 'bangdyhk');
			exit();
		}else{
			$this->error('绑定失败','bangdyhk');
			exit();
		}	
	}


	
}