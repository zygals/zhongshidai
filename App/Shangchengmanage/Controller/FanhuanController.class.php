<?php

namespace Shangchengmanage\Controller;
use Think\Controller;
use Common\Lib\Common; //引入类函数
use Common\Lib\String; //引入类函数
use Think\Upload;
use Think\Image;
class FanhuanController extends CommonController {
	/**
	 * 待用返还
	 */
	public function index() {

		$this->display();
	}
	/**
	 * 分类编辑页面
	 */
	public function fanhuan() {
		$date=date('Ymd',strtotime('+1 day'));
        $fanarr=D('Jifenfanhuan')->where(array('fan_date'=>array('lt',$date)))->select();
        if(!$fanarr){
            $this->error('今天没有要返回的会员');
        }
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
        $fan = array();
		$keyarr=explode(',',$keys);
		foreach($fanarr as $k=>$v){
			foreach($keyarr as $kk=>$kv){
				if($v['bh']==$kv){
					$fan[$kv]+=$v['num'];
				}

            }
		}


		foreach($fan as $fk=>$fv){
            $keyongojifen = $fv*0.55;
            $aiguoxiaofeiquan = $fv*0.3;
            $aixinxiaofeiquan = $fv*0.1;
            $pingtaiweihufei = $fv*0.05;

            D('User')->where(array('user_login_bh'=>$fk))->setDec('user_daiyongjf',$fv);
            D('User')->where(array('user_login_bh'=>$fk))->setInc('user_keyongjf',$keyongojifen);
            D('User')->where(array('user_login_bh'=>$fk))->setInc('user_agxfq',$aiguoxiaofeiquan);
            D('User')->where(array('user_login_bh'=>$fk))->setInc('user_axxfq',$aixinxiaofeiquan);
            D('User')->where(array('user_login_bh'=>$fk))->setInc('user_ptwhf',$pingtaiweihufei);
            $data = array();
            $data['user_login_bh'] = $fk;
            $data['jifen_laiyuan'] = 'fh';
            $data['user_daiyongjf'] = $fv;
            $data['user_keyongjf'] = $keyongojifen;
            $data['user_agxfq'] = $aiguoxiaofeiquan;
            $data['user_axxfq'] = $aixinxiaofeiquan;
            $data['user_ptwhf'] = $pingtaiweihufei;
            $data['jifen_date'] = time();
            D('User_fanhuan')->data($data)->add();


			$user=D('User')->field('user_daiyongjf,user_keyongjf,user_agxfq,user_axxfq,user_ptwhf')->where(array('user_login_bh'=>$fk))->find();
            //1可用积分2待用积分3分享积分4充值积分5爱国消费券6平台维护7爱心消费券
            //1转入2报单3隔代4转出5购物6撤销
			D('User_jifen')->data(array('user_login_bh'=>$fk,'jifen_laiyuan'=>'fh','jifen_num'=>$fv,'jifen_type'=>2,'jifen_yuanyin'=>4,'jifen_shengyu'=>$user['user_daiyongjf'],'jifen_date'=>time()))->add();
			D('User_jifen')->data(array('user_login_bh'=>$fk,'jifen_laiyuan'=>'fh','jifen_num'=>$keyongojifen,'jifen_type'=>1,'jifen_yuanyin'=>1,'jifen_shengyu'=>$user['user_keyongjf'],'jifen_date'=>time()))->add();
			D('User_jifen')->data(array('user_login_bh'=>$fk,'jifen_laiyuan'=>'fh','jifen_num'=>$aiguoxiaofeiquan,'jifen_type'=>5,'jifen_yuanyin'=>1,'jifen_shengyu'=>$user['user_agxfq'],'jifen_date'=>time()))->add();
			D('User_jifen')->data(array('user_login_bh'=>$fk,'jifen_laiyuan'=>'fh','jifen_num'=>$aixinxiaofeiquan,'jifen_type'=>7,'jifen_yuanyin'=>1,'jifen_shengyu'=>$user['user_axxfq'],'jifen_date'=>time()))->add();
			D('User_jifen')->data(array('user_login_bh'=>$fk,'jifen_laiyuan'=>'fh','jifen_num'=>$pingtaiweihufei,'jifen_type'=>6,'jifen_yuanyin'=>1,'jifen_shengyu'=>$user['user_ptwhf'],'jifen_date'=>time()))->add();
		}

		$jg=D('Jifenfanhuan')->where(array('id'=>array('in',$ids)))->delete();
		if($jg){
			$this->success('返还成功');
		}else{
			$this->error('返还失败');
		}
	}

    public function flist(){
        $fanhuan = M('user_jifen');
        $fh_data = $fanhuan->group('user_login_bh')->where('jifen_laiyuan="fh"')->select();
        $count=$fanhuan->where('jifen_laiyuan="fh"')->count();
        //**分页实现代码
        $Page = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        //**分页实现代码
        $arr=$fanhuan->limit($Page->firstRow.','.$Page->listRows)->where('jifen_laiyuan="fh"')->order('id desc')->select();
        foreach($arr as $k=>$v){
            if($v['user_dengji']==1){
                $arr[$k]['dj']='vip会员';
            }elseif($v['user_dengji']==2){
                $arr[$k]['dj']='社区工作站';
            }elseif($v['user_dengji']==3){
                $arr[$k]['dj']='区域服务中心';
            }elseif($v['user_dengji']==4){
                $arr[$k]['dj']='省级分公司';
            }

            if($v['user_sjid1']){
                $sj=$m->where(array('user_login_bh'=>$v['user_sjid1']))->find();
                $arr[$k]['sj']=$sj['user_name'];
            }
            if($v['user_sjid2']){
                $sj=$m->where(array('user_login_bh'=>$v['user_sjid2']))->find();
                $arr[$k]['sj2']=$sj['user_name'];
            }
        }
        //**分页实现代码
        $this->assign('page',$show);// 赋值分页输出
        //**分页实现代码
        $this->assign('vlist',$arr);
        $this->assign('count',$count);
        $this->display();
    }
}

?>