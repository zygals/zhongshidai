<?php

namespace Shangchengpc\Controller;
use Think\Controller;
use Common\Lib\String; //引入类函数
use Common\Lib\Category; //引入类函数
use Common\Lib\Common; //引入类函数
class DrawalController extends Controller {
	
	public function _initialize(){
		//var_dump(session());die();
		if(session('bh')){
			if(I('get.b')){
				session('bh',I('get.b'));
			}
		}
		if(!session('bh')){
			echo "<script>alert('对不起，请登录');window.location.href='./l.html'</script>";
			exit();
			
		}
		
		
		if(session('bh')){
			$bh=session('bh');
		$userleft=D('User')->where(array('user_login_bh'=>$bh))->find();
		if($userleft){
				$this->assign('userleft',$userleft);
			}
		$this->assign('bh',$bh);}
		
		if(!session('config')){
			$config=D('Config')->find();
			session('config',$config);
		}else{
			$config=session('config');
		}
		$this->assign('config',$config);
		
		
		
	}
	
	
	
	
 public function tixian(){
	 if(session('bh')){
	   $bh=session('bh');
	   $model=M('user');
	   $mod=M('user_card');
	   $data=$model->where(array('user_login_bh'=>$bh))->find();
	   $this->assign('data',$data);
	   $id=$data['id'];
	   $card=$mod->where(array('uid'=>$id))->select();
	   $this->assign('card',$card);
	   
	   $tixian=M('Tixian');			
	   $tqxj=$tixian->where(array('ss_type'=>2,'uid'=>$id))->order('sq_date desc')->select();
	   $this->assign('tqxj',$tqxj);		
	   $this->display();
	 }

 }
 public function tx(){
	    $data=array();
		$data['txye']=I('post.txye');
	    $userid=I('post.uid');
		$result2=D('user_card')->where(array('uid'=>$userid))->select();
		 foreach ($result2 as $v) {
                $res=$v;
                $v[]=$res;
            }
		$data['bank_kaohao']=I('post.sele');
		$ucard=D('user_card')->where(array('bank_kaohao'=>$data['bank_kaohao']))->find();
		$data['uid']=I('post.uid');
		$data['kaihuren']=$ucard['kaihu_name'];
		$data['kaihuhang']=$ucard['bank_name'];
		$data['kahao']=$ucard['bank_kaohao'];
		$data['ss_type']=I('post.ss_type');
		$data['status']=0;
		$data['sq_date']=time();
		 $xianjin=D('user')->where(array('id'=>$userid))->find();
		 $mon['user_xianjin']=$xianjin['user_xianjin'];
		// $mon['user_xianjin']=$xianjin['user_xianjin']-$data['txye'];
		// $txxj=D('User')->where('id='.$uid)->data($mon)->save();
		  if($mon['user_xianjin']<100)
		  {   
			  $this->error('您的余额不足，请查看您的余额',C("PATH_URL").'/tx.html');
			  }
			  else
			  {
				 if($data['txye']<=$mon['user_xianjin'])
					{
					   $mon['user_xianjin']=$xianjin['user_xianjin']-$data['txye'];
		               $txxj=D('User')->where('id='.$userid)->save($mon);
					   $tixian=M('Tixian');
		               $tixian->add($data);
						if($tixian->create()){	
							$this->success('提现成功，请等待审核',C("PATH_URL").'/tx.html');
							 }else{
							$this->error('提现失败，请查看您的余额',C("PATH_URL").'/tx.html');
							 }
					}else{
						$this->error('您的余额不足，请查看您的余额',C("PATH_URL").'/tx.html');
						}
				
		      }
			  
			  
			  
			  
 }
 
}
