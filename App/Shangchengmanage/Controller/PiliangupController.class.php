<?php
namespace Shangchengmanage\Controller;
use Think\Controller;
use Common\Lib\Common; //引入类函数
use Common\Lib\String; //引入类函数
use Think\Upload;
use Think\Image;
class PiliangupController extends CommonController {
	/**
	 * 待用返还
	 */
	public function index() {
		$this->display();
	}
	/**
	 * 分类编辑页面
	 */
	public function update() {
		$ks=I('post.bhkaishi');
		$js=I('post.bhjieshu');
		$lx=I('post.lx');
		$newpass=sjjiami('mima',I('post.password'));
		if(strstr($ks,'T')||strstr($js,'T')){
			$ksuser=D('User')->field('id')->where(array('user_login_bh'=>$ks))->find();
			$jsuser=D('User')->field('id')->where(array('user_login_bh'=>$js))->find();
			//var_dump($ksuser);var_dump($jsuser);die();
			if($ksuser==''||$jsuser==''){
				$this->error("开始或结束编号有误");
			}
			if($lx==1){
				$jg=D('User')->where(array('id'=>array('egt',$ksuser['id']),'id'=>array('elt',$jsuser['id'])))->data(array('user_pass'=>$newpass))->save();
			}elseif($lx==2){
				$jg=D('User')->where(array('id'=>array('egt',$ksuser['id']),'id'=>array('elt',$jsuser['id'])))->data(array('user_zfpass'=>$newpass))->save();
			}
			if($jg){
				$this->success('修改成功');
			}else{
				$this->error('修改失败');
			}
		}else{
			$this->error('编号有误');
		}
		
	}


}

?>