<?php

namespace Shangcheng\Controller;
use Think\Controller;
use Common\Lib\String; //引入类函数
use Common\Lib\Category; //引入类函数
use Common\Lib\Common; //引入类函数
class HelpController extends Controller {
	/**
	 * 公告咨询控制器
	 */
    public function index(){

		//var_dump($gg);die();
		$data_geren = M('Help')->order('paixu asc')->where('fid=1')->select();
		$data_zhongxin = M('Help')->order('paixu asc')->where('fid=2')->select();
		$data_gouwu = M('Help')->order('paixu asc')->where('fid=3')->select();
		$data_bangzhu = M('Help')->order('paixu asc')->where('fid=4')->select();
		$data_jiangli = M('Help')->order('paixu asc')->where('fid=5')->select();
		$this->assign('geren',$data_geren);
		$this->assign('zhongxin',$data_zhongxin);
		$this->assign('gouwu',$data_gouwu);
		$this->assign('bangzhu',$data_bangzhu);
		$this->assign('jiangli',$data_jiangli);
		$this->display();
    }
	//详情

	public function content(){
		if(I('get.b')){
			$id=I('get.b');
			$detail=D('Help')->find($id);
			$detail['content']=htmlspecialchars_decode($detail['content']);
			$this->assign('dt',$detail);
		}
		if(!session('config')){
			$config=D('Config')->find();
			session('config',$config);
		}else{
			$config=session('config');
		}

		$this->assign('config',$config);
		$this->display();
	}
}