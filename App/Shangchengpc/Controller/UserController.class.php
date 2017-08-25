<?php

namespace Shangchengpc\Controller;
use Think\Controller;
use Common\Lib\String; //引入类函数
use Common\Lib\Category; //引入类函数
use Common\Lib\Common; //引入类函数

class UserController extends Controller {
	public function _initialize(){
		
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
		
		
		
		
		
		
	}
	
	
	
	public function son($arr,$cat_id){
        static $list;
        foreach($arr as $v){
            if($v['user_sjid1'] == $cat_id){
                $list[] =$v;
                $this->son($arr,$v['user_login_bh']);
            }
        }
        return $list;
    }

	
	
	/**
	 * 会员控制器
	 */
    public function index(){
		
		//$riqi1=strtotime('20161019');//传过来时间戳
		//$riqi2=date('Ymd',$riqi1);
		//echo $riqi1;echo "<br/>";echo $riqi2;die();
		if(session('bh')){
			$bh=session('bh');
			$user=D('User')->where(array('user_login_bh'=>$bh))->find();
			
			  if($user['user_dengji']>=2){
                $puser1=D('jifenfanhuan_zs')->where('pbh="'.$bh.'"')->count();
                $ppuser1=D('jifenfanhuan_zs')->where('ppbh="'.$bh.'"')->count();
                $arr = M('user')->field('id,user_login_bh,user_sjid1')->where(1)->select();
               if($user['user_dengji']>=2){
                    $puser = 1;
                }else{
                    $puser = 0;

            }
            }

			if($user){
				$this->assign('user',$user);
			}
			$this->assign('bh',session('bh'));
		}
		if(!session('config')){
			$config=D('Config')->find();
			session('config',$config);
		}else{
			$config=session('config');
		}
		$this->assign('config',$config);
		$this->assign('puser',$puser);
		$this->display();
    }
	/**
	 * 可用积分
	 */
	public function keyongjifen(){
		if(session('bh')){
		$bh=session('bh');
		$ks=0;
		$num=10;
		$m=M('User_jifen');
		//**分页实现代码
		$count=$m->where(array('user_login_bh'=>$bh,'jifen_type'=>1))->order('id desc')->count();// 查询满足要求的总记录数
		$Page = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show = $Page->show();// 分页显示输出
		//**分页实现代码
		$keyong=$m->where(array('user_login_bh'=>$bh,'jifen_type'=>1))->limit($Page->firstRow.','.$Page->listRows)->order('id desc')->select();

		//**分页实现代码
		$this->assign('page',$show);// 赋值分页输出
		if($keyong){
			foreach($keyong as $kk=>$kv){
						if($kv['jifen_laiyuan']){
							if($kv['jifen_laiyuan']=='xt'){
								if($kv['jifen_yuanyin']==1){
									$ly=$kv['user_login_bh'].'系统转入';
									$jf=$kv['jifen_num'];
								}
							}elseif($kv['jifen_laiyuan']=='bdfh'){
								if($kv['jifen_yuanyin']==1){
									$ly=$kv['user_login_bh'].'系统报单返还转入';
									$jf=$kv['jifen_num'];
								}
							}elseif($kv['jifen_laiyuan']=='ft'){
								if($kv['jifen_yuanyin']==4){
									$ly=$kv['user_login_bh'].'复投转出';
									$jf='-'.$kv['jifen_num'];
								}
							}else{
								if(strlen($kv['jifen_laiyuan'])>7){
									$ly=$kv['user_login_bh'].$kv['jifen_laiyuan'];
									$jf=$kv['jifen_num'];
								}else{
									if($kv['jifen_yuanyin']==1){
										$ly=$kv['user_login_bh'].'可用积分转入自'.$kv['jifen_laiyuan'];
										$jf=$kv['jifen_num'];
									}elseif($kv['jifen_yuanyin']==2){
										$ly=$kv['user_login_bh'].'报单转出自'.$kv['jifen_laiyuan'];
										$jf='-'.$kv['jifen_num'];
									}elseif($kv['jifen_yuanyin']==3){
										$ly=$kv['user_login_bh'].'隔代取酬自'.$kv['jifen_laiyuan'];
										$jf=$kv['jifen_num'];
									}elseif($kv['jifen_yuanyin']==4){
										$ly=$kv['user_login_bh'].'可用积分转出给'.$kv['jifen_laiyuan'];
										$jf='-'.$kv['jifen_num'];
									}elseif($kv['jifen_yuanyin']==6){
										$ly=$kv['user_login_bh'].'报单收入自'.$kv['jifen_laiyuan'];
										$jf=$kv['jifen_num'];
									}elseif($kv['jifen_yuanyin']==7){
										$ly=$kv['user_login_bh'].'下级分公司报单收入自'.$kv['jifen_laiyuan'];
										$jf=$kv['jifen_num'];
									}elseif($kv['jifen_yuanyin']==8){
										$ly=$kv['user_login_bh'].'隔代分公司报单收入自'.$kv['jifen_laiyuan'];
										$jf=$kv['jifen_num'];
									}
								}
							}
						}else{
							if($kv['jifen_yuanyin']==1){
								$ly='系统返还';
								$jf=$kv['jifen_num'];
							}elseif($kv['jifen_yuanyin']==2){
								$ly='报单转出';
								$jf='-'.$kv['jifen_num'];
							}elseif($kv['jifen_yuanyin']==5){
								$ly='商城购物转出';
								$jf='-'.$kv['jifen_num'];
							}
						}
					$data[$kk]['date'] = $kv['jifen_date'];
					$data[$kk]['detail'] = $ly;
					$data[$kk]['num'] = $jf;
					$data[$kk]['last'] = $kv['jifen_shengyu'];
					}
				}
			$this->assign('data',$data);
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
	/**
	 * 待用积分
	 */
	public function daiyongjifen(){
		if(session('bh')){
		$bh=session('bh');
		$m=M('User_jifen');
		//**分页实现代码
		$count=$m->where(array('user_login_bh'=>$bh,'jifen_type'=>2))->order('id desc')->count();// 查询满足要求的总记录数
		$Page = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show = $Page->show();// 分页显示输出
		$daiyong=$m->where(array('user_login_bh'=>$bh,'jifen_type'=>2))->limit($Page->firstRow.','.$Page->listRows)->order('id desc')->select();
		$this->assign('page',$show);// 赋值分页输出
		if($daiyong){
					foreach($daiyong as $dk=>$dv){
					
					    if($dv['jifen_laiyuan']){
							if($dv['jifen_yuanyin']==1){
								$ly=$dv['jifen_laiyuan'].'转入'.$dv['user_login_bh'];
								$jf=$dv['jifen_num'];
							}
							if($dv['jifen_laiyuan']=='ft'){
								if($dv['jifen_yuanyin']==1){
									$ly=$dv['user_login_bh'].'复投转入';
									$jf=$dv['jifen_num'];
								}
							}else{
								if($dv['jifen_yuanyin']==2){
									$ly=$dv['user_login_bh'].'报单转入自'.$dv['jifen_laiyuan'];
									$jf=$dv['jifen_num'];
								}
							}
						}else{
							if($dv['jifen_yuanyin']==1){
								$ly=$dv['jifen_laiyuan'].'转入'.$dv['user_login_bh'];
								$jf=$dv['jifen_num'];
							}
							elseif($dv['jifen_yuanyin']==2){
								$ly='报单转入';
								$jf=$dv['jifen_num'];
							}elseif($dv['jifen_yuanyin']==4){
								$ly='系统返还';
								$jf='-'.$dv['jifen_num'];
							}
						}
					
					$data[$dk]['date'] = $dv['jifen_date'];
					$data[$dk]['detail'] = $ly;
					$data[$dk]['num'] = $jf;
					$data[$dk]['last'] = $dv['jifen_shengyu'];
					}
				}
				$this->assign('data',$data);
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
	/**
	 * 分享积分
	 */
	public function fenxiangjifen(){
		if(session('bh')){
		$bh=session('bh');
		$m=M('User_jifen');
		//**分页实现代码
		$count=$m->where(array('user_login_bh'=>$bh,'jifen_type'=>3))->order('id desc')->count();// 查询满足要求的总记录数
		$Page = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show = $Page->show();// 分页显示输出
		$fenxiang=$m->where(array('user_login_bh'=>$bh,'jifen_type'=>3))->limit($Page->firstRow.','.$Page->listRows)->order('id desc')->select();
		$this->assign('page',$show);// 赋值分页输出
				if($fenxiang){
					foreach($fenxiang as $fk=>$fv){
						if($fv['jifen_laiyuan']){
							if($fv['jifen_yuanyin']==1){
								$ly=$fv['jifen_laiyuan'].'转入'.$fv['user_login_bh'];
								$jf=$fv['jifen_num'];
							}
							if($fv['jifen_laiyuan']=='ft'){
								if($fv['jifen_yuanyin']==1){
									$ly=$fv['user_login_bh'].'复投转入';
									$jf=$fv['jifen_num'];
								}
							}else{
								if($fv['jifen_yuanyin']==2){
									$ly=$fv['user_login_bh'].'报单转入自'.$fv['jifen_laiyuan'];
									$jf=$fv['jifen_num'];
								}elseif($fv['jifen_yuanyin']==3){
									$ly=$fv['user_login_bh'].'隔代取酬转出自'.$fv['jifen_laiyuan'];
									$jf='-'.$fv['jifen_num'];
								}
							}
						}else{
							if($fv['jifen_yuanyin']==1){
								$ly=$fv['jifen_laiyuan'].'转入'.$fv['user_login_bh'];
								$jf=$fv['jifen_num'];
							}
							elseif($fv['jifen_yuanyin']==2){
								$ly='报单转入';
								$jf=$fv['jifen_num'];
							}
						}
					$data[$fk]['date'] = $fv['jifen_date'];
					$data[$fk]['detail'] = $ly;
					$data[$fk]['num'] = $jf;
					$data[$fk]['last'] = $fv['jifen_shengyu'];
					}
				}
				$this->assign('data',$data);
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
	
	
	
	
	
	
	
	
	/**
	 * 赠送积分
	 */
	public function zengsong(){
		if(session('bh')){
		$bh=session('bh');
		$m=M('User_jifen');
		//**分页实现代码
		$count=$m->where(array('user_login_bh'=>$bh,'jifen_type'=>10))->order('id desc')->count();// 查询满足要求的总记录数
		$Page = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show = $Page->show();// 分页显示输出
		$fenxiang=$m->where(array('user_login_bh'=>$bh,'jifen_type'=>10))->limit($Page->firstRow.','.$Page->listRows)->order('id desc')->select();
		$this->assign('page',$show);// 赋值分页输出
				if($fenxiang){
					foreach($fenxiang as $fk=>$fv){
						if($fv['jifen_laiyuan']){
							if($fv['jifen_yuanyin']==1){
								$ly='系统转入';
								$jf=$fv['jifen_num'];
							}
							
						}
					$data[$fk]['date'] = $fv['jifen_date'];
					$data[$fk]['detail'] = $ly;
					$data[$fk]['num'] = $jf;
					$data[$fk]['last'] = $fv['jifen_shengyu'];
					}
				}
				$this->assign('data',$data);
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
	
	
	
	
	
	
	
	
	/**
	 * 充值积分
	 */
	public function baodanjifen(){
		if(session('bh')){
		$bh=session('bh');
		$m=M('User_jifen');
		//**分页实现代码
		$count=$m->where(array('user_login_bh'=>$bh,'jifen_type'=>4))->order('id desc')->count();// 查询满足要求的总记录数
		$Page = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		
		$baodan=$m->where(array('user_login_bh'=>$bh,'jifen_type'=>4))->limit($Page->firstRow.','.$Page->listRows)->order('id desc')->select();
		$show = $Page->show();// 分页显示输出
		$this->assign('page',$show);// 赋值分页输出
				if($baodan){
					foreach($baodan as $fk=>$fv){
						if($fv['jifen_laiyuan']){
							if($fv['jifen_laiyuan']=='cz'){
								if($fv['jifen_yuanyin']==1){
									$ly='充值转入';
									$jf=$fv['jifen_num'];
								}
							}else{
								if($fv['jifen_yuanyin']==1){
									$ly=$fv['user_login_bh'].'充值积分转入自'.$fv['jifen_laiyuan'];
									$jf=$fv['jifen_num'];
								}elseif($fv['jifen_yuanyin']==2){
									$ly=$fv['user_login_bh'].'报单转出自'.$fv['jifen_laiyuan'];
									$jf='-'.$fv['jifen_num'];
								}elseif($fv['jifen_yuanyin']==4){
									$ly=$fv['user_login_bh'].'充值积分转出给'.$fv['jifen_laiyuan'];
									$jf='-'.$fv['jifen_num'];
								}
							}
						}else{
							if($fv['jifen_yuanyin']==2){
								$ly='报单转出';
								$jf='-'.$fv['jifen_num'];
							}
						}
					$data[$fk]['date'] = $fv['jifen_date'];
					$data[$fk]['detail'] = $ly;
					$data[$fk]['num'] = $jf;
					$data[$fk]['last'] = $fv['jifen_shengyu'];
					}
				}
				$this->assign('data',$data);
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
	/**
	 * 消费服务中心
	 */

	 
	 
	public function xiaofei(){
		
	if(session('bh')){
		$bh=session('bh');
		
		
		if(!session('config')){
			$config=D('Config')->find();
			session('config',$config);
		}else{
			$config=session('config');
		}
		}
		$this->assign('config',$config);
		$this->assign('bh',$bh);
		$this->display();
	}
	/**
	 * 消费服务中心2111
	 */
	public function xiaofei2(){
		
		
		
		if(session('bh')){
			$bh=session('bh');
			$this->assign('bh',$bh);
		}else{
			$this->error('网络出错，请稍候重试');
		}
		
		
		
		if(I('get.proid')){
			/*if (session('admin_name')){
				$this->error('请本人操作');
			}*/
		
			$proid=I('get.proid');
			$bduser=D('User')->where(array('user_login_bh'=>$proid))->find();
			$user=D('User')->where(array('user_login_bh'=>$bh))->find();
			$sjbh=$bduser['user_sjid1'];
			$bdid=$bduser['id'];
			if($user['user_dengji']<=$bduser['user_dengji']){
				$this->error('您的等级无法给该用户报单');
			}
			for($i=0;$i<$bdid;$i++){
				if($sjbh==$bh){
					$wangti=1;
					break;
				}
				$sj=D('User')->where(array('user_login_bh'=>$sjbh))->find();
				$sjbh=$sj['user_sjid1'];
				if($sj['user_dengji']==2){
					if($user['user_dengji']==2){
						$wg=1;
						break;
					}
				}
				if($sj['user_dengji']==3){
					$wg=1;
					break;
				}
				if(!$sjbh){
					break;
				}
			}
			if($wg){
				$this->error('请在报单人的上级分公司或服务中心报单');
			}
			if($wangti){
				$this->assign('user',$bduser);
			}else{
				$this->error('该会员未在您的网体下');
			}
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
	/**
	 * 消费服务中心3
	 */
	/**
	 * 消费服务中心3
	 */
		public function xiaofei3(){
		$canshu  =  M('qici')->where('pos=1')->find();	
		
		
		
		if(IS_POST){
			if(I('post.t')=='b'){
				if(session('bh')){
					$bh=session('bh');
				}else{
					echo json_encode(array('code'=>2,'msg'=>'登陆失效，请重新登陆'));
					exit;
				}
				$user=D('User')->where(array('user_login_bh'=>$bh))->find();
				if($user['user_name']!=session('name')){
					echo json_encode(array('code'=>2,'msg'=>'请勿多号同时登陆'));
					exit;
				}
				if($user['id']!=session('id')){
					echo json_encode(array('code'=>2,'msg'=>'请勿多号同时登陆'));
					exit;
				}
				$proid=I('post.proid');
				$baodan=I('post.money');
				$keyong=I('post.k');
				$chongzhi=I('post.c');
				$jifen=I('post.jifen');
		if(strlen($user['user_zfpass'])>30){
					$zfpass=sjjiami('mima',I('post.pwd2'));
				}else{
					$zfpass=I('post.pwd2');
				}
				if(I('post.r')){
					$riqi=I('post.r');//传过来日期
					$riqi1=strtotime($riqi);//传过来时间戳
					$riqi2=date('Ymd',$riqi1);//转换为ymd
					$riqi3=date('Ymd')-$riqi2;//与现在时间相差天数
					$j1='+'.($canshu['tianshu']-$riqi3).' day';//传过来日期21天后日期
				}else{
					$riqi1=time();
					$riqi2=date('Ymd');
					$riqi3=0;
					$j1="+".$canshu['tianshu']." day";
				}
				if($baodan!=$keyong+$chongzhi){
					echo json_encode(array('code'=>2,'msg'=>'输入积分+充值积分=报单金额'));
					exit;
				}
				if($baodan%10||$baodan<10){
					echo json_encode(array('code'=>2,'msg'=>'报单金额应为10的倍数'));
					exit;
				}
				if($chongzhi/$baodan<0.5){
					echo json_encode(array('code'=>2,'msg'=>'输入积分或报单金额有误'));
					exit;
				}
				if($user['user_dengji']<2){
					echo json_encode(array('code'=>2,'msg'=>'登陆失效，请重新登陆'));
					exit;
				}
				if($user['user_zfpass']!=$zfpass){
					echo json_encode(array('code'=>2,'msg'=>'二级密码错误'));
					exit;
				}
				
				//验证充值积分
				$bduser=D('User')->where(array('user_login_bh'=>$proid))->find();
				if($bduser['user_baodanjifen']<$chongzhi){
					echo json_encode(array('code'=>2,'msg'=>$proid.'充值积分不足'));
					exit;
				}
 				  

				//服务中心减可用积分
				  if($jifen==1)
				   {
					   if($user['user_zs_keyongjf']<$keyong)
					    {
						   $this->error('老的可用积分不足');
						   
						   }else{
					       $user_keyong=$user['user_zs_keyongjf']-$keyong;//老
					       $jg=D('User')->where(array('id'=>$user['id']))->data(array('user_zs_keyongjf'=>$user_keyong))->save();
					     }
				 }else if($jifen==2)
				  {
					  if($user['user_keyongjf']<$keyong)
					    {
						   $this->error('新的可用积分不足');
						   
						   }else{
					 $user_keyong=$user['user_keyongjf']-$keyong; //新
					 $jg=D('User')->where(array('id'=>$user['id']))->data(array('user_keyongjf'=>$user_keyong))->save();
				  }
					  
				  }					   					  
			  
				if($jg){
					//增加积分表操作记录
					D('User_jifen')->data(array('user_login_bh'=>$user['user_login_bh'],'jifen_laiyuan'=>$bduser['user_login_bh'],'jifen_num'=>$keyong,'jifen_type'=>1,'jifen_yuanyin'=>1,'jifen_shengyu'=>$user_keyong,'jifen_date'=>$riqi1))->add();
				}
				//报单人加代用积分分享积分减充值积分
				//$canshu=D('Canshu')->find();
				$bddaiyong=$baodan*$canshu['beizeng'];
				$bddata['user_daiyongjf']=$bduser['user_daiyongjf']+$bddaiyong;
				$bddata['user_fenxiangjf']=$bduser['user_fenxiangjf']+$baodan;
				$bddata['user_baodanjifen']=$bduser['user_baodanjifen']-$chongzhi;
				$jg1=D('User')->where(array('id'=>$bduser['id']))->data($bddata)->save();
				if($jg1){
					
					//可用积分增加记录
					$bduser_keyong=$bduser['user_keyongjf']+$keyong;
					D('User_jifen')->data(array('user_login_bh'=>$bduser['user_login_bh'],'jifen_laiyuan'=>$user['user_login_bh'],'jifen_num'=>$keyong,'jifen_type'=>1,'jifen_yuanyin'=>1,'jifen_shengyu'=>$bduser_keyong,'jifen_date'=>$riqi1))->add();
					//可用积分减少记录
					D('User_jifen')->data(array('user_login_bh'=>$bduser['user_login_bh'],'jifen_laiyuan'=>$user['user_login_bh'],'jifen_num'=>$keyong,'jifen_type'=>1,'jifen_yuanyin'=>4,'jifen_shengyu'=>$bduser['user_keyongjf'],'jifen_date'=>$riqi1))->add();
					
					//充值积分减少记录
					D('User_jifen')->data(array('user_login_bh'=>$bduser['user_login_bh'],'jifen_laiyuan'=>$user['user_login_bh'],'jifen_num'=>$chongzhi,'jifen_type'=>4,'jifen_yuanyin'=>4,'jifen_shengyu'=>$bddata['user_baodanjifen'],'jifen_date'=>$riqi1))->add();
					
					//待用积分增加记录
					D('User_jifen')->data(array('user_login_bh'=>$bduser['user_login_bh'],'jifen_laiyuan'=>$user['user_login_bh'],'jifen_num'=>$bddaiyong,'jifen_type'=>2,'jifen_yuanyin'=>1,'jifen_shengyu'=>$bddata['user_daiyongjf'],'jifen_date'=>$riqi1))->add();
					
					//分享积分增加记录
					D('User_jifen')->data(array('user_login_bh'=>$bduser['user_login_bh'],'jifen_laiyuan'=>$user['user_login_bh'],'jifen_num'=>$baodan,'jifen_type'=>3,'jifen_yuanyin'=>1,'jifen_shengyu'=>$bddata['user_fenxiangjf'],'jifen_date'=>$riqi1))->add();
					
					//待用分期返还
					$sybili=100-($canshu['fhbili']*$canshu['tianshu']);
					$riqis = time(); 
					$arr1['fan_date']  = date("Ymd",strtotime("+".$canshu['tianshu']." day",$riqis));
					$arr1['bh'] =$bduser['user_login_bh'];
					$arr1['num']=$bddaiyong*$sybili/100;
					$arr1['status']=0;
					
					
					D('Jifenfanhuan')->data($arr1)->add();
					// $bduser=D('User')->where(array('user_login_bh'=>$proid))->find();
					
					
					$ppbh =D('User')->where(array('user_login_bh'=>$proid))->where('user_sjid2 != "A800001"')->getField('user_sjid2');
					$pbh =D('User')->where(array('user_login_bh'=>$proid))->where('user_sjid1 != "A800001"')->getField('user_sjid1');
					//$user_dengji =D('User')->where(array('user_login_bh'=>$pbh))->where('user_sjid1 != "A800001"')->getField('user_dengji');
					$zhitui=D('User')->where(array('user_sjid1'=>$ppbh))->count();

					if($pbh){
						//$user_dengji =D('User')->where(array('user_login_bh'=>$proid))->getField('user_dengji');
						$sjshjl =  M('user')->where('user_login_bh="'.$bh.'"')->find();
						$user_dengji = $sjshjl['user_dengji'];
						if($user_dengji == 2){
                            $lilv = 0.01;
                        }elseif($user_dengji == 3){
                            $lilv = 0.02;
                        }elseif($user_dengji ==4){
                            $lilv = 0.03;
                        }else{
                            $lilv = 0;
                        }	
						$sr=floor($baodan*$lilv);
	
						//分公司或服务中心增加收入    2,0.01
                        //上级审核奖励
                        
						$udata['user_keyongjf']=$sjshjl['user_keyongjf']+$sr;
						D('User')->where(array('user_login_bh'=>$sjshjl['user_login_bh'],'id'=>$sjshjl['id']))->data($udata)->save();
						D('User_jifen')->data(array('user_login_bh'=>$sjshjl['user_login_bh'],'jifen_laiyuan'=>'报单收入自'.$proid,'jifen_num'=>$sr,'jifen_type'=>1,'jifen_yuanyin'=>1,'jifen_shengyu'=>$udata['user_keyongjf'],'jifen_date'=>time()))->add();
					}	


						
					if($ppbh){

					$s2user =D('User')->where(array('user_login_bh'=>$ppbh))->find();

						if($zhitui>=2 && $zhitui <=3 ){
								$s2fx=floor($baodan*5/100);
							}elseif($zhitui>=4 && $zhitui <=6 ){
                                $s2fx=floor($baodan*10/100);
                            }elseif($zhitui>=7){
                                $s2fx=floor($baodan*15/100);
                            }else{
                                $s2fx = 0;
                            }
                          // F('zhitui',$zhitui);		
							//F('baodan',$baodan);
							//F('s2fx',$s2fx);	
							//上二分享积分大于隔代收入 user_keyongjf user_agxfq
							if($s2user['user_fenxiangjf']>=$s2fx){
								$s2data['user_fenxiangjf']=$s2user['user_fenxiangjf']-$s2fx;
								$s2data['user_keyongjf']=$s2user['user_keyongjf']+$s2fx;
								//给上二级减分享加可用
								$jg1=D('User')->where(array('id'=>$s2user['id']))->data($s2data)->save();
								//上二积分变化写入积分表
								D('User_jifen')->data(array('user_login_bh'=>$s2user['user_login_bh'],'jifen_laiyuan'=>'隔代'.$proid,'jifen_num'=>$s2fx,'jifen_type'=>3,'jifen_yuanyin'=>4,'jifen_shengyu'=>$s2data['user_fenxiangjf'],'jifen_date'=>time()))->add();


                                D('User_jifen')->data(array('user_login_bh'=>$s2user['user_login_bh'],'jifen_laiyuan'=>'隔代'.$proid,'jifen_num'=>$s2fx,'jifen_type'=>1,'jifen_yuanyin'=>1,'jifen_shengyu'=>$s2data['user_keyongjf'],'jifen_date'=>time()))->add();
                            }else{//小于
								if($s2user['user_fenxiangjf']){
									$s2data['user_fenxiangjf']=0;
									$s2data['user_keyongjf']=$s2user['user_keyongjf']+$s2user['user_fenxiangjf'];
									//给上二级减分享加可用
									$jg1=D('User')->where(array('id'=>$s2user['id']))->data($s2data)->save();
									D('User_jifen')->data(array('user_login_bh'=>$s2user['user_login_bh'],'jifen_laiyuan'=>'隔代'.$proid,'jifen_num'=>$s2user['user_fenxiangjf'],'jifen_type'=>3,'jifen_yuanyin'=>4,'jifen_shengyu'=>$s2data['user_fenxiangjf'],'jifen_date'=>time()))->add();
                                    D('User_jifen')->data(array('user_login_bh'=>$s2user['user_login_bh'],'jifen_laiyuan'=>'隔代'.$proid,'jifen_num'=>$s2user['user_fenxiangjf'],'jifen_type'=>1,'jifen_yuanyin'=>1,'jifen_shengyu'=>$s2data['user_keyongjf'],'jifen_date'=>time()))->add();
                                }


					}


					}
					/*if($sr){
						$user=D('User')->where(array('user_login_bh'=>$bh))->find();
						$userky=$user['user_keyongjf']+$sr;
						$jg3=D('User')->where(array('id'=>$user['id']))->data(array('user_keyongjf'=>$userky))->save();
						if($jg3){
							D('User_jifen')->data(array('user_login_bh'=>$bh,'jifen_laiyuan'=>$bduser['user_login_bh'],'jifen_num'=>$sr,'jifen_type'=>1,'jifen_yuanyin'=>1,'jifen_shengyu'=>$userky,'jifen_date'=>$riqi1))->add();
						}
					}*/
					if($user['user_dengji']==3){
						//分公司上级和隔代上级
						if($user['user_sjid1']){
							$usj1=D('User')->where(array('user_login_bh'=>$user['user_sjid1']))->find();
							if($usj1['user_dengji']==3){
								//上级分公司收入
								$sjfsr=floor($chongzhi*0.02);
								//上级分公司可用
								$sjfky=$usj1['user_keyongjf']+$sjfsr;
								$jg4=D('User')->where(array('id'=>$usj1['id']))->data(array('user_keyongjf'=>$sjfky))->save();
								if($jg4){
									//增加可用积分记录
									D('User_jifen')->data(array('user_login_bh'=>$usj1['user_login_bh'],'jifen_laiyuan'=>$user['user_login_bh'],'jifen_num'=>$sjfsr,'jifen_type'=>1,'jifen_yuanyin'=>1,'jifen_shengyu'=>$sjfky,'jifen_date'=>$riqi1))->add();
								}
							}else{
								if($user['user_sjid2']){
									$usj2=D('User')->where(array('user_login_bh'=>$user['user_sjid2']))->find();
									if($usj2['user_dengji']==3){
										$sjfsr=floor($chongzhi*0.01);
										$sjfky=$usj2['user_keyongjf']+$sjfsr;
										$jg5=D('User')->where(array('id'=>$usj2['id']))->data(array('user_keyongjf'=>$sjfky))->save();
										if($jg5){
											D('User_jifen')->data(array('user_login_bh'=>$usj2['user_login_bh'],'jifen_laiyuan'=>$user['user_login_bh'],'jifen_num'=>$sjfsr,'jifen_type'=>1,'jifen_yuanyin'=>1,'jifen_shengyu'=>$sjfky,'jifen_date'=>$riqi1))->add();
										}
									}
								}
							}
						}
					}

					 Vendor('Qcloud.SmsSingleSender');
	               // $userid = I('post.proid');
	                $phoneNumber2 = M('user')->where('user_login_bh="'.$proid.'"')->getField('user_phone');
	                $pass1 = '111111';
	                $pass2 = '222222';
	                // 请根据实际 appid 和 appkey 进行开发，以下只作为演示 sdk 使用
	                $appid = 1400028710;
	                $appkey = "52b347d20b82b003114a1d7e18c196c3";
	                $templId = 17351;
	                $params = array("{$proid}", "{$pass1}", "{$pass2}");
	                $singleSender = new SmsSingleSender($appid, $appkey);

	                $result = $singleSender->sendWithParam("86", $phoneNumber2, $templId, $params);
					echo json_encode(array('code'=>1,'msg'=>'报单成功','url'=> C("PATH_URL").'/u.html'));
					exit;
				}else{
					echo json_encode(array('code'=>2,'msg'=>'网络出错，请稍候重试'));
					exit;
				}
			}
		}
		if(I('get.proid')){
			$proid=I('get.proid');
			$user=D('User')->where(array('user_login_bh'=>$proid))->find();
			$this->assign('user',$user);
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



	
	/**
	 * 站内工单
	 */
	public function gongdan(){
		if(session('bh')){
			$bh=session('bh');
			$gd=D('User_gongdan')->where(array('user_login_bh'=>$bh))->select();
			$this->assign('gd',$gd);
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
	/**
	 * 站内工单添加
	 */
	public function addgongdan(){
		if(!session('config')){
			$config=D('Config')->find();
			session('config',$config);
		}else{
			$config=session('config');
		}
		$this->assign('config',$config);
		$this->display();
	}
		/**
	 * 站内工单添加1
	 */
	public function addgongdan1(){
		if(IS_POST){
			if($_FILES){
				//是否上传图片
				$upload = new \Think\Upload();// 实例化上传类
				$upload->maxSize 	= 3145728;// 设置附件上传大小
				$upload->exts    	= array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
				$upload->savePath	= './Uploads/';// 设置附件上传根目录
				$upload->savePath  	=  '/Images/'; // 设置附件上传（子）目录
				$upload->autoSub 	= true;
				$upload->subName 	= array('date','Ymd');
				$upload->saveName = array('uniqid','');//设置上传文件规则
				$info = $upload->upload();
				if (!$info) {
					//捕获上传异常
					$this->error($upload->getErrorMsg());
				} else {
					foreach($info as $file){
						$file_image = './Uploads'.$file['savepath'].$file['savename'];
						$file_mini='./Uploads'.$file['savepath'].'mini/'.$file['savename'];
						$file_path='./Uploads'.$file['savepath'].'mini/';
						if (!is_dir($file_path)) {mkdir($file_path,0777);}
						$img=new \Think\Image();
						$img->open($file_image);
						$img->thumb(400,320)->save($file_mini);
					}
				}unlink($file_image);
				if($file_mini){
					$data['gd_pic']=substr($file_mini,1,strlen($file_mini));
				}
			}
			if(I('post.mobile')){
				$data['gd_title']=I('post.mobile');
			}
			if(I('post.content')){
				$data['gd_content']=I('post.content');
			}
			if($data){
				$data['user_login_bh']=session('bh');
				$data['gd_date']=time();
				//var_dump($data);die();
				$jg=D('User_gongdan')->data($data)->add();
				if($jg){
					$this->success('提交成功！', '/u.html');
				}else{
					$this->error('提交失败');
				}
			}else{
				$this->error('提交失败');
			}
		}
	}
	/**
	 * 站内工单添加
	 */
	public function addpic(){
		if(IS_POST){
			if($_FILES){
				//是否上传图片
				$upload = new \Think\Upload();// 实例化上传类
				$upload->maxSize 	= 3145728;// 设置附件上传大小
				$upload->exts    	= array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
				$upload->savePath	= './Uploads/';// 设置附件上传根目录
				$upload->savePath  	=  '/Images/'; // 设置附件上传（子）目录
				$upload->autoSub 	= true;
				$upload->subName 	= array('date','Ymd');
				$upload->saveName = array('uniqid','');//设置上传文件规则
				$info = $upload->upload();//var_dump($info);die();
				if (!$info) {
					//捕获上传异常
					$this->error($upload->getErrorMsg());
				} else {
					foreach($info as $file){
						$file_image = './Uploads'.$file['savepath'].$file['savename'];
						$file_mini='./Uploads'.$file['savepath'].'mini/'.$file['savename'];
						$file_path='./Uploads'.$file['savepath'].'mini/';
						if (!is_dir($file_path)) {mkdir($file_path,0777);}
						//var_dump($file_mini);
						$img=new \Think\Image();
						$img->open($file_image);
						$img->thumb(400,320)->save($file_mini);
					}
				}unlink($file_image);
				if($file_mini){
					echo json_encode(array('url'=>substr($file_mini,1,strlen($file_mini))));
					exit;
				}
			}
		}
	}
	/**
	 * 可用积分互转
	 */
	public function jifenhuzhuan(){
		if(!session('config')){
			$config=D('Config')->find();
			session('config',$config);
		}else{
			$config=session('config');
		}
		$this->assign('config',$config);
		$this->display();
	}
	/**
	 * 可用积分互转2
	 */
	public function jifenhuzhuan2(){
		if(I('get.proid')){
			/*if (session('admin_name')){
				$this->error('请本人操作');
			}*/
			$proid=I('get.proid');
			$user=D('User')->where(array('user_login_bh'=>$proid))->find();
			$flag=$user['user_flag'];

			if($flag==1)
				{
			   if(!$user){
				$this->error('查无此人');
			   }
			    
				
				}else{
					$this->error('不能给新会员互转积分',C("PATH_URL").'/ujz.html');
					//$this->success('转帐成功！', '/u.html');
					exit;
					}

			$this->assign('user',$user);
		}
		//var_dump($user);die();
		if(!session('config')){
			$config=D('Config')->find();
			session('config',$config);
		}else{
			$config=session('config');
		}
		$this->assign('config',$config);
		$this->display();
	}
	/**
	 * 可用积分互转3
	 */
	public function jifenhuzhuan3(){
		if(I('get.bh')){
			$bh=I('get.bh');
			$user=D('User')->where(array('user_login_bh'=>$bh))->find();
			$this->assign('user',$user);
			
			if($user==0){
				$this->error('会员编号有误','./ujz.html');
				exit();
				}
			
		}
		
		if($bh==''){
				$this->error('请输入接受会员编号','./ujz.html');
				exit();
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
	/**
	 * 可用积分互转4
	 */
	public function jifenhuzhuan4(){
		if(IS_POST){
			
		
			if(session('bh')){
				$bh=session('bh');
				$user=D('User')->where(array('user_login_bh'=>$bh))->find();
				if(I('post.zfpassword')){
					if(strlen($user['user_zfpass'])>30){
						$zfpassword=sjjiami('mima',I('post.zfpassword'));
					}else{
						$zfpassword=I('post.zfpassword');
					}
				}
				if($user['user_zfpass']!=$zfpassword){
					$this->error('支付密码不正确');
				}
				if(I('post.keyong')){
					$keyong=I('post.keyong');
				}
				
				if(I('post.proid')){
					$proid=I('post.proid');
					$dfuser=D('User')->where(array('user_login_bh'=>$proid))->find();
					if(!$dfuser){
						$this->error('查无此人');
					}
				}
				
				
				$hzjf=I('post.hz');
				if($hzjf==1)
				{    
				if($keyong>$user['user_zs_keyongjf'])
				{
					$this->error('老的可用积分不足');
					}else
					{
						$zj=D('User')->where(array('id'=>$user['id']))->setDec('user_zs_keyongjf',$keyong);//减积分
				if($zj){
					$sy=$user['user_zs_keyongjf']-$keyong;
					D('User_jifen')->data(array('user_login_bh'=>$user['user_login_bh'],'jifen_laiyuan'=>$proid,'jifen_num'=>$keyong,'jifen_type'=>1,'jifen_yuanyin'=>4,'jifen_shengyu'=>$sy,'jifen_date'=>time()))->add();
				      }
				   }
				}
				if($hzjf==2)
				{
					if($keyong>$user['user_keyongjf'])
					{
						$this->error('新的可用积分不足');
						}else
						{
							$zj=D('User')->where(array('id'=>$user['id']))->setDec('user_keyongjf',$keyong);//减积分
	                if($zj){
					$sy=$user['user_keyongjf']-$keyong;
					D('User_jifen')->data(array('user_login_bh'=>$user['user_login_bh'],'jifen_laiyuan'=>$proid,'jifen_num'=>$keyong,'jifen_type'=>1,'jifen_yuanyin'=>4,'jifen_shengyu'=>$sy,'jifen_date'=>time()))->add();
				           }
					}
				}


				
				$df=D('User')->where(array('user_login_bh'=>$proid))->setInc('user_zs_keyongjf',$keyong);
				if($df){
					$syky=D('User')->field('user_zs_keyongjf')->where(array('user_login_bh'=>$proid))->find();
					$jg=D('User_jifen')->data(array('user_login_bh'=>$proid,'jifen_laiyuan'=>$user['user_login_bh'],'jifen_num'=>$keyong,'jifen_type'=>1,'jifen_yuanyin'=>1,'jifen_shengyu'=>$syky['user_zs_keyongjf'],'jifen_date'=>time()))->add();
				}
			
				if($jg){
					$this->success('转帐成功！', './u.html');
				}else{
					$this->error('转帐失败');
				}
			}
		}
	}
	/**
	 * 直推会员
	 */
	public function zhitui(){
		if(session('bh')){
			$bh=session('bh');
			$zhitui=D('User')->where(array('user_sjid1'=>$bh))->select();
			foreach($zhitui as $k=>$v){
				$zhitui[$k]['xh']=$k+1;
			}
			$this->assign('zj',$bh);
			$this->assign('zt',$zhitui);
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
	/**
	 * 下级直推会员
	 */
	public function xiazhitui(){
		if(I('get.bh')){
			$bh=I('get.bh');
			$zhitui=D('User')->where(array('user_sjid1'=>$bh))->select();
			foreach($zhitui as $k=>$v){
				$zhitui[$k]['xh']=$k+1;
			}
			$this->assign('zj',$bh);
			$this->assign('zt',$zhitui);
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
	/**
	 * 报单积分互转
	 */
	public function baodanjifenhuzhuan(){
		$bh=session('bh');
		$this->assign('bh',$bh);
		if(!session('config')){
			$config=D('Config')->find();
			session('config',$config);
		}else{
			$config=session('config');
		}
		$this->assign('config',$config);
		$this->display();
	}
	/**
	 * 报单积分互转2
	 */
	public function baodanjifenhuzhuan2(){
		$bh=session('bh');
		$this->assign('bh',$bh);
		if(I('get.proid')){
			$proid=I('get.proid');
			$user=D('User')->where(array('user_login_bh'=>$proid))->find();
			if(!$user){
				$this->error('查无此人');
			}
			$this->assign('user',$user);
		}
		//var_dump($user);die();
		if(!session('config')){
			$config=D('Config')->find();
			session('config',$config);
		}else{
			$config=session('config');
		}
		$this->assign('config',$config);
		$this->display();
	}
	/**
	 * 报单积分互转3
	 */
	public function baodanjifenhuzhuan3(){
		$bh=session('bh');
				$this->assign('bh',$bh);
		if(I('get.bh')){
			$bh=I('get.bh');
			
			$user=D('User')->where(array('user_login_bh'=>$bh))->find();
			$this->assign('user',$user);
		}
		//var_dump($user);die();
		if(!session('config')){
			$config=D('Config')->find();
			session('config',$config);
		}else{
			$config=session('config');
		}
		$this->assign('config',$config);
		$this->display();
	}
	/**
	 * 报单积分互转4
	 */
	public function baodanjifenhuzhuan4(){
		if(IS_POST){
			if(session('bh')){
				$bh=session('bh');
				$this->assign('bh',$bh);
				$user=D('User')->where(array('user_login_bh'=>$bh))->find();
				if(I('post.zfpassword')){
					if(strlen($user['user_zfpass'])>30){
						$zfpassword=sjjiami('mima',I('post.zfpassword'));
					}else{
						$zfpassword=I('post.zfpassword');
					}
				}
				if($user['user_zfpass']!=$zfpassword){
					$this->error('支付密码不正确');
				}
				if(I('post.chongzhi')){
					$chongzhi=I('post.chongzhi');
				}
				
				if(I('post.proid')){
					$proid=I('post.proid');
				}
				
				
				$bdjf=I('post.bdjf');
				
				 if($bdjf==1)
				 {
					  if($chongzhi>$user['user_zs_baodanjf'])
					   {
						$this->error('老的充值积分不足');
						 }else
						 {
						$zj=D('User')->where(array('id'=>$user['id']))->setDec('user_zs_baodanjf',$chongzhi);//减积分 ---老
						if($zj){
						  $sy=$user['user_zs_baodanjf']-$chongzhi;
						  D('User_jifen')->data(array('user_login_bh'=>$user['user_login_bh'],'jifen_laiyuan'=>$proid,'jifen_num'=>$chongzhi,'jifen_type'=>4,'jifen_yuanyin'=>4,'jifen_shengyu'=>$sy,'jifen_date'=>time()))->add(); 
						      }
						 }
				}
			    if($bdjf==2)
				 {
					 if($chongzhi>$user['user_baodanjifen'])
					    {
						 $this->error('新的充值积分不足');
						 }else
						   {
						   $zj=D('User')->where(array('id'=>$user['id']))->setDec('user_baodanjifen',$chongzhi);//减积分 ---新
						   if($zj){
							$sy=$user['user_baodanjifen']-$chongzhi;
							D('User_jifen')->data(array('user_login_bh'=>$user['user_login_bh'],'jifen_laiyuan'=>$proid,'jifen_num'=>$chongzhi,'jifen_type'=>4,'jifen_yuanyin'=>4,'jifen_shengyu'=>$sy,'jifen_date'=>time()))->add();
							}
					 }
				 }

				$df=D('User')->where(array('user_login_bh'=>$proid))->setInc('user_baodanjifen',$chongzhi);
				if($df){
					$sycz=D('User')->field('user_baodanjifen')->where(array('user_login_bh'=>$proid))->find();
					$jg=D('User_jifen')->data(array('user_login_bh'=>$proid,'jifen_laiyuan'=>$user['user_login_bh'],'jifen_num'=>$chongzhi,'jifen_type'=>4,'jifen_yuanyin'=>1,'jifen_shengyu'=>$sycz['user_baodanjifen'],'jifen_date'=>time()))->add();
				}
				if($jg){
					$this->success('转帐成功！', './u.html');
				}else{
					$this->error('转帐失败');
				}
			}
		}
	}
	
	
	/**
	 * 我的订单
	 */
	public function mydingdan(){
		if(!session('config')){
			$config=D('Config')->find();
			session('config',$config);
		}else{
			$config=session('config');
		}
		$this->assign('config',$config);
		$beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
		//echo date('Y-m-d');
		//echo '<br/>';
		$beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
		$endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
		//echo $beginToday."--".$endToday."--".time();
		//echo '<br/>';
		$map['date'] = array(array('gt',$beginToday),array('lt',$endToday)) ;
		$jljfsum=D('Dingdan')->where($map)->sum('jianglijifen');
		$ykxjsum=D('Dingdan')->where($map)->sum('yingkouxianjin');
		//今天的总利润
		$todaylr=$jljfsum+$ykxjsum;	
		//echo $todaylr;
		//echo '<br/>';
		/*加权分红*/
		$axjf_min =M('Fenhong_bili')->where('name="加权分红"')->getField('axjf_min');
		$axjf_bili =M('Fenhong_bili')->where('name="加权分红"')->getField('bili');
		$axjf_status =M('Fenhong_bili')->where('name="加权分红"')->getField('status');						
		$axjf_fh=intval($todaylr*$axjf_bili);
		//遍历用户爱心积分
		$userfh=D('User')->where('user_axxfq > '.$axjf_min)->select();
		/*供应商*/
		$gysaxjf_min =M('Fenhong_bili')->where('name="供应商"')->getField('axjf_min');				
		$gysaxjf_bili =M('Fenhong_bili')->where('name="供应商"')->getField('bili');				
		$gysaxjf_status =M('Fenhong_bili')->where('name="供应商"')->getField('status');						
		$gysaxjf_fh=intval($todaylr*$gysaxjf_bili);
		
		//遍历供应商爱心积分
		$gysfh=D('Goods')->field('tjr_bh')->group('tjr_bh')->select();
		foreach($gysfh as $key=>$vs){			
			$gysbh[$key]=$vs['tjr_bh'];
		}		
		//var_dump($gysbh);
		$dategysbh['user_login_bh']=array('in',$gysbh);
		$dategysbh['user_axxfq']=array('egt',$gysaxjf_min);
		$gysaxxfjjh=D('User')->where($dategysbh)->select();	
		if(time()==$endToday){
		/*加权分红*/
		foreach($userfh as $key=>$v){
			$userbh=$v['user_login_bh'];
			switch($axjf_status){
				case 0:	//返可用积分
					$userkyjf=D('User')->where('user_login_bh = "'.$userbh.'"')->getField('user_keyongjf');
					$lastuserkyjf=$userkyjf+$axjf_fh;
					$lastdatakyjf['user_keyongjf']=$lastuserkyjf;
					M('User')->where("user_login_bh='".$userbh."'")->save($lastdatakyjf);	
					/*user_jifen可用积分分红记录*/
					$userjf=array();
					$userjf['user_login_bh']=$userbh;
					$userjf['jifen_laiyuan']='jljf';
					$userjf['jifen_num']=$axjf_fh;
					$userjf['jifen_type']=1;
					$userjf['jifen_yuanyin']=1;
					$userjf['jifen_shengyu']=$lastuserkyjf;
					$userjf['jifen_date']=time();
					M('User_jifen')->add($userjf);		
				
				break;
				case 1:	//返现金
					$userxj=D('User')->where('user_login_bh = "'.$userbh.'"')->getField('user_xianjin');
					$lastuserxj=$userxj+$axjf_fh;
					$lastdataxj['user_xianjin']=$lastuserxj;
					M('User')->where("user_login_bh='".$userbh."'")->save($lastdataxj);	
					/*user_jifen可用积分分红记录*/	
					/*user_jifen可用积分分红记录*/
					$userjf=array();
					$userjf['user_login_bh']=$userbh;
					$userjf['jifen_laiyuan']='jljf';
					$userjf['jifen_num']=$axjf_fh;
					$userjf['jifen_type']=9;
					$userjf['jifen_yuanyin']=1;
					$userjf['jifen_shengyu']=$lastuserxj;
					$userjf['jifen_date']=time();
					M('User_jifen')->add($userjf);		
								
				break;
			}
			//var_dump($userbh);
			//echo '<br/>';
		}		
		/*供应商分红*/
		foreach($gysaxxfjjh as $key=>$vt){
			$gysuserbh=$vt['user_login_bh'];
			switch($gysaxjf_status){
				case 0:	//返可用积分
					$gyskyjf=D('User')->where('user_login_bh = "'.$gysuserbh.'"')->getField('user_keyongjf');
					$lastgyskyjf=$gyskyjf+$gysaxjf_fh;
					$lastdategyskyjf['user_keyongjf']=$lastgyskyjf;
					M('User')->where("user_login_bh='".$gysuserbh."'")->save($lastdategyskyjf);	
					/*gys_jifen可用积分分红记录*/	
					$gysjf=array();
					$gysjf['user_login_bh']=$gysuserbh;
					$gysjf['jifen_laiyuan']='jljf';
					$gysjf['jifen_num']=$gysaxjf_fh;
					$gysjf['jifen_type']=1;
					$gysjf['jifen_yuanyin']=1;
					$gysjf['jifen_shengyu']=$lastgyskyjf;
					$gysjf['jifen_date']=time();
					M('User_jifen')->add($gysjf);		
				break;
				case 1:	//返现金
					$gysxj=D('User')->where('user_login_bh = "'.$gysuserbh.'"')->getField('user_xianjin');
					$lastgysxj=$gysxj+$gysaxjf_fh;
					$lastgysxj['user_xianjin']=$lastgysxj;
					M('User')->where("user_login_bh='".$gysuserbh."'")->save($lastgysxj);	
					/*gys_jifen现金分红记录*/	
					$gysjf=array();
					$gysjf['user_login_bh']=$gysuserbh;
					$gysjf['jifen_laiyuan']='jljf';
					$gysjf['jifen_num']=$gysaxjf_fh;
					$gysjf['jifen_type']=1;
					$gysjf['jifen_yuanyin']=1;
					$gysjf['jifen_shengyu']=$lastgysxj;
					$gysjf['jifen_date']=time();
					M('User_jifen')->add($gysjf);		
				break;
			}			
			
		}
		}
		$this->display();
	}
	
	
	
	
	
	
	/**
	 * 订单详情
	 */
	public function ddetail(){
		if(!session('config')){
			$config=D('Config')->find();
			session('config',$config);
		}else{
			$config=session('config');
		}
		$this->assign('config',$config);
		$this->display();
	}
	/**
	 * 修改个人信息
	 */
	public function updateinfo(){
		if(session('bh')){
			$bh=session('bh');
			$user=D('User')->where(array('user_login_bh'=>$bh))->find();
			if(IS_POST){
				if($_FILES['touxiang']['name']!=''){

		//是否上传图3145728片
				$upload = new \Think\Upload();// 实例化上传类
				$upload->maxSize 	= 3145728;// 设置附件上传大小
				$upload->exts    	= array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
				$upload->savePath	= './Uploads/';// 设置附件上传根目录
				$upload->savePath  	=  '/Images/'; // 设置附件上传（子）目录
				$upload->autoSub 	= true;
				$upload->subName 	= array('date','Ymd');
				$upload->saveName = array('uniqid','');//设置上传文件规则
				$info = $upload->upload();
				
				
				
				if (!$info) {
					//捕获上传异常
					$this->error('图片上传失败,请检查图片格式或大小');
					//$this->error($upload->getErrorMsg());
				}else {
					foreach($info as $file){
						$file_image = './Uploads'.$file['savepath'].$file['savename'];
						$file_photo='./Uploads'.$file['savepath'].'photo/'.$file['savename'];
						$file_path='./Uploads'.$file['savepath'].'photo/';
						if (!is_dir($file_path)) {mkdir($file_path,0777);}
						//var_dump($file_mini);
						$img=new \Think\Image();
						$img->open($file_image);
						$img->thumb(100,100)->save($file_photo);
					}
				}
			}
				//$where['user_login_bh']=$bh;
			if($_FILES['touxiang']['error']!=4){
				$data['user_logo']=$file_photo;
			}
				$data['user_minzu']=I('post.user_minzu');
				$data['user_email']=I('post.user_email');
				$data['user_phone']=I('post.user_phone');
				$data['user_address']=I('post.user_address');
				$data['user_postcode']=I('post.user_postcode');
				$jg=D('User')->where(array('user_login_bh'=>$bh))->data($data)->save();
				if($jg){
					$this->success('修改成功！请用新密码重新登录', './uu.html');
				}else{
					$this->error('修改失败,重新提交');
				}
				exit();
			}
			$this->assign('user',$user);
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
	
	/*查看金额*/
	public function chakan(){

		if(session('bh')){
			$bh=session('bh');
			$result=D('User')->where('user_login_bh="'.$bh.'"')->select();
			$this->assign('result',$result);				
			$this->display();
		}
		
    }



	/**
	 * 修改密码
	 */
	public function updatepass(){
		if(session('bh')){
			$bh=session('bh');
			$user=D('User')->where(array('user_login_bh'=>$bh))->find();
			if(IS_POST){
				if(I('post.idStr')){
					if(strlen($user['user_zfpass'])>30){
						$jiami=sjjiami('mima',I('post.oldPwd'));
					}else{
						$jiami=I('post.oldPwd');
					}
					
					if($jiami==$user['user_zfpass']){
						$newpass=sjjiami('mima',I('post.newPwd'));
						$jg=D('User')->where(array('id'=>$user['id']))->data(array('user_zfpass'=>$newpass))->save();
						if($jg){
							echo json_encode(array('state'=>1));
							exit;
						}else{
							echo json_encode(array('state'=>3));
							exit;
						}
					}else{
						echo json_encode(array('state'=>2));
						exit;
					}
				}else{
					$jiami=sjjiami('mima',I('post.oldPwd'));
					if($jiami==$user['user_pass']){
						$newpass=sjjiami('mima',I('post.newPwd'));
						$jg=D('User')->where(array('id'=>$user['id']))->data(array('user_pass'=>$newpass))->save();
						if($jg){
							echo json_encode(array('state'=>1));
							exit;
						}else{
							echo json_encode(array('state'=>3));
							exit;
						}
					}else{
						echo json_encode(array('state'=>2));
						exit;
					}
				}
				//var_dump($_POST);die();
			}
		}
		if(!session('config')){
			$config=D('Config')->find();
			session('config',$config);
		}else{
			$config=session('config');
		}
		$this->assign('bh',$bh);
		$this->assign('config',$config);
		$this->display();
	}
	
	
	
	/*充值*/
	public function chongzhi(){
		//echo session('bh');
		//var_dump(session());
		if(session('bh')){
			$bh=session('bh');
			$hyid=session('id');
			$result=D('User')->where('user_login_bh="'.$bh.'"')->select();
			$this->assign('result',$result);
			$id=$result[0]['id'];
		
			//调取tixian数据
			$tixian=M('Tixian');			
			$result2=$tixian->where(array('uid'=>$id,'ss_type'=>1))->order('tg_date')->select();		
			$this->assign('result2',$result2);		
			$this->display();
		}
		
    }

	/*充值添加*/
	public function chongzhiwr(){
		$data=array();
		$data['txye']=I('post.txye');
		$userid=I('post.uid');
		$result=D('User')->where('id='.$userid)->select();
		$data['uid']=$result[0]['id'];
		$data['kahao']=$result[0]['user_yinhangka'];
		$data['kaihuhang']=$result[0]['user_kaihuhang'];
		$data['kaihuren']=$result[0]['user_name'];
		$data['ss_type']=I('post.ss_type');	
		$data['sq_date']=time();	
		$tixian=M('Tixian');			
		$tixian->add($data);
		if($tixian->create()){	
			$this->success('充值成功，请等待审核',C("PATH_URL").'/ucz.html');
		}else{
			$this->error('充值失败',C("PATH_URL").'/ucz.html');
		}	
	}


	
	
	/**
	 * 爱国消费券
	 */
	public function PatrioticPoint(){
		if(session('bh')){
		$bh=session('bh');
		$m=M('User_jifen');
		//**分页实现代码
		$count=$m->where(array('user_login_bh'=>$bh,'jifen_type'=>5))->order('id desc')->count();// 查询满足要求的总记录数
		$Page = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show = $Page->show();// 分页显示输出
		$fenxiang=$m->where(array('user_login_bh'=>$bh,'jifen_type'=>5))->limit($Page->firstRow.','.$Page->listRows)->order('id desc')->select();
		$this->assign('page',$show);// 赋值分页输出
				if($fenxiang){
					foreach($fenxiang as $fk=>$fv){
						if($fv['jifen_laiyuan']){
							if($fv['jifen_laiyuan']=='fh'){
								if($fv['jifen_yuanyin']==1){
									$ly='积分转入';
									$jf=$fv['jifen_num'];
								}
								if($fv['jifen_yuanyin']==5){
									$ly='消费';
									$jf=$fv['jifen_num'];
								}
								if($fv['jifen_yuanyin']==6){
									$ly='撤销';
									$jf=$fv['jifen_num'];
								}			
								
							}
						}
					$data[$fk]['date'] = $fv['jifen_date'];
					$data[$fk]['detail'] = $ly;
					$data[$fk]['num'] = $jf;
					$data[$fk]['last'] = $fv['jifen_shengyu'];
					}
				}
				$this->assign('data',$data);
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



	/**
	 * 平台维护费
	 */
	public function MaintenanceCost(){
		if(session('bh')){
		$bh=session('bh');
		$m=M('User_jifen');
		//**分页实现代码
		$count=$m->where(array('user_login_bh'=>$bh,'jifen_type'=>6))->order('id desc')->count();// 查询满足要求的总记录数
		$Page = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show = $Page->show();// 分页显示输出
		$fenxiang=$m->where(array('user_login_bh'=>$bh,'jifen_type'=>6))->limit($Page->firstRow.','.$Page->listRows)->order('id desc')->select();
				if($fenxiang){
					foreach($fenxiang as $fk=>$fv){
					   if($fv['jifen_laiyuan']){
							if($fv['jifen_laiyuan']=='fh'){
								if($fv['jifen_yuanyin']==1){
									$ly='平台维护';
									$jf=$fv['jifen_num'];
								}
								if($fv['jifen_yuanyin']==5){
									$ly=$fv['user_login_bh'].'';
									$jf=$fv['jifen_num'];
								}	
							}
						}
					$data[$fk]['date'] = $fv['jifen_date'];
					$data[$fk]['detail'] = $ly;
					$data[$fk]['num'] = $jf;
					$data[$fk]['last'] = $fv['jifen_shengyu'];
					}
				}
				$this->assign('data',$data);
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


	/**
	 * 爱心消费券
	 */
	public function BenevolencePoint(){
		if(session('bh')){
		$bh=session('bh');
		$m=M('User_jifen');
		//**分页实现代码
		$count=$m->where(array('user_login_bh'=>$bh,'jifen_type'=>7))->order('id desc')->count();// 查询满足要求的总记录数
		$Page = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show = $Page->show();// 分页显示输出
		$fenxiang=$m->where(array('user_login_bh'=>$bh,'jifen_type'=>7))->limit($Page->firstRow.','.$Page->listRows)->order('id desc')->select();
		$this->assign('page',$show);// 赋值分页输出
				if($fenxiang){
					foreach($fenxiang as $fk=>$fv){
						if($fv['jifen_laiyuan']){
							if($fv['jifen_laiyuan']=='fh'){
								if($fv['jifen_yuanyin']==1){
									$ly='积分转入';
									$jf=$fv['jifen_num'];
								}
								if($fv['jifen_yuanyin']==5){
									$ly='消费';
									$jf=$fv['jifen_num'];
								}
								if($fv['jifen_yuanyin']==6){
									$ly='失效';
									$jf=$fv['jifen_num'];
								}	
							}
						}
					$data[$fk]['date'] = $fv['jifen_date'];
					$data[$fk]['detail'] = $ly;
					$data[$fk]['num'] = $jf;
					$data[$fk]['last'] = $fv['jifen_shengyu'];
					}
				}
				$this->assign('data',$data);
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
	
	
	/**
	 * 退出登陆
	 */
	public function loginout(){
    	session_start();
    	session_unset();//删除所有session变量
    	session_destroy();//删除session文件
		echo 1;
    	//$this->success('成功退出',U('login/index'));
		//$this->redirect('/l');
    	
	}
	
}