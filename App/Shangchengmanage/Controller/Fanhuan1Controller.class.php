<?php

namespace Shangchengmanage\Controller;
use Think\Controller;
use Common\Lib\Common; //引入类函数
use Common\Lib\String; //引入类函数
use Think\Upload;
use Think\Image;
class Fanhuan1Controller extends Controller {
	/**
	 * 返还
	 */
	public function fanhuan() {
		$fp=fopen('shell.txt','a+');
		fwrite($fp,"bbbbbbbb\n");
		fclose($fp);
		echo "000000";die();
		$date=date('Ymd');
		$fanarr=D('Jifenfanhuan')->where(array('fan_date'=>array('lt',$date)))->select();
		//var_dump($fanarr);die();
		$keys='';
		$ids='';
		foreach($fanarr as $k=>$v){
			if(strstr($keys,$v['bh'])==false){
				if($keys!=''){
					$keys.=','.$v['bh'];
				}else{
					$keys=$v['bh'];
				}
			}
			if($ids!=''){
				$ids.=','.$v['id'];
			}else{
				$ids=$v['id'];
			}
		}
		$keyarr=explode(',',$keys);
		foreach($fanarr as $k=>$v){
			foreach($keyarr as $kk=>$kv){
				if($v['bh']==$kv){
					$fan[$kv]+=$v['num'];
				}
			}
		}
		foreach($fan as $fk=>$fv){
			D('User')->where(array('user_login_bh'=>$fk))->setInc('user_keyongjf',$fv);
			D('User')->where(array('user_login_bh'=>$fk))->setDec('user_daiyongjf',$fv);
			$user=D('User')->field('user_keyongjf,user_daiyongjf')->where(array('user_login_bh'=>$fk))->find();
			D('User_jifen')->data(array('user_login_bh'=>$fk,'jifen_num'=>$fv,'jifen_type'=>1,'jifen_yuanyin'=>1,'jifen_shengyu'=>$user['user_keyongjf'],'jifen_date'=>time()))->add();
			D('User_jifen')->data(array('user_login_bh'=>$fk,'jifen_num'=>$fv,'jifen_type'=>2,'jifen_yuanyin'=>4,'jifen_shengyu'=>$user['user_daiyongjf'],'jifen_date'=>time()))->add();
		}
		D('Jifenfanhuan')->where(array('id'=>array('in',$ids)))->delete();
		
	}


}

?>