<?php

namespace Shangchengmanage\Controller;
use Think\Controller;
class VerifyController extends Controller {
	/**
	 * 验证码实现
	 */
	public function code(){
		//$w=222;
		$w=I('get.w');
    	$h=I('get.h');
    	//dump($w);
    	//exit;
		$config = array(
			'fontSize' => 18, 
			'length' => 4,
			'imageW' => $w, 
			'imageH' => $h,
			//'bg' => array(22, 150, 215),
			'useCurve' => true, //是否使用混淆曲线
			'useNoise' => true, //是否添加杂点
			'useImgBg' => false,//是否使用背景图片
			);
        $verify = new \Think\Verify($config);
        $verify->entry(1);
	}

}
