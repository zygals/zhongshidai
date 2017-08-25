<?php

namespace Shangchengmanage\Controller;
use Think\Controller;
use Qcloud\Sms\SmsSingleSender;
use Common\Lib\Category; //引入类函数
use Common\Lib\Common; //引入类函数
use Common\Lib\String; //引入类函数
class UserController extends CommonController {
	/**
	 * 显示会员
	 */
	public function index() {
        $module_name = '/' . MODULE_NAME . '/' . CONTROLLER_NAME . '/' . ACTION_NAME;//
        $p= isset($_GET['p']) ? $_GET['p'] : 1;
        $_SESSION['p'] = $p;
        $p = $_SESSION['p'];
		$m=D('User');
    	//**分页实现代码
    	$count=$m->count();// 查询满足要求的总记录数
    	$Page = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
    	$show = $Page->show();// 分页显示输出
    	//**分页实现代码
		$arr=$m->limit($Page->firstRow.','.$Page->listRows)->order('id desc')->select();
		foreach($arr as $k=>$v){
			if($v['user_dengji']==1){
				$arr[$k]['dj']='VIP会员';
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
        $this->assign('module_name',$module_name);// 赋值分页输出
		//**分页实现代码
		$this->assign('vlist',$arr);
		$this->assign('count',$count);
		$this->display();
	}
	
	
	
	
	
	
	/**
	 * 老积分
	 */
	public function old() {
		$m=D('User');
		
		 $pljf= isset($_GET['p']) ? $_GET['p'] : 1;
        $_SESSION['pljf'] = $pljf;
		$module_name = '/' . MODULE_NAME . '/' . CONTROLLER_NAME . '/' . ACTION_NAME;//
    	//**分页实现代码
    	$count=$m->count();// 查询满足要求的总记录数
    	$Page = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
    	$show = $Page->show();// 分页显示输出
    	//**分页实现代码
		$arr=$m->limit($Page->firstRow.','.$Page->listRows)->order('id desc')->select();
		foreach($arr as $k=>$v){
			if($v['user_dengji']==1){
				$arr[$k]['dj']='VIP会员';
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
		$this->assign('module_name',$module_name);
		$this->display();
	}
	
	
	
	
	/**
	 * 充值
	 */
	public function chongzhi(){
        $p=I('get.p');
		$id=I('get.id');
		$m=D('User');
    	$arr=$m->find($id);
		$this->assign('v',$arr);
    	$this->display();
	}
	
	
	public function zengsong(){
        $p=I('get.p');
		$id=I('get.id');
		$m=D('User');
    	$arr=$m->find($id);
		$this->assign('v',$arr);
    	$this->display();
	}
	
	
	public function do_zengsong(){

		$id=I('post.id');
		$zengsong=I('post.user_zengsongjifen');
		if($zengsong){
			$m=D('User');
			$jg=$m->where(array('id'=>$id))->setInc('user_zengsongjifen',$zengsong);
			$user=$m->find($id);
			$sy=$user['user_zengsongjifen'];
			
			D('User_jifen')->data(array('user_login_bh'=>$user['user_login_bh'],'jifen_laiyuan'=>'zs','jifen_num'=>$zengsong,'jifen_type'=>10,'jifen_yuanyin'=>1,'jifen_shengyu'=>$sy,'jifen_date'=>time()))->add();

            if ($jg){
				$this->success('赠送成功',U('User/index/',array('p'=>session('p'))));
			}else {
				$this->error('赠送失败');
			}
		}else{
			$this->error('请填写赠送积分');
		}
	}
	
	
	/**
	 * 充值处理
	 */

	public function do_chongzhi(){

		$id=I('post.id');
		$chongzhi=I('post.user_baodanjifen');
		if($chongzhi){
			$m=D('User');
			$jg=$m->where(array('id'=>$id))->setInc('user_baodanjifen',$chongzhi);
			$user=$m->find($id);
			$sy=$user['user_baodanjifen'];
			D('User_jifen')->data(array('user_login_bh'=>$user['user_login_bh'],'jifen_laiyuan'=>'cz','jifen_num'=>$chongzhi,'jifen_type'=>4,'jifen_yuanyin'=>1,'jifen_shengyu'=>$sy,'jifen_date'=>time()))->add();

            if ($jg){
				$this->success('充值成功',U('User/index/',array('p'=>session('p'))));
			}else {
				$this->error('充值失败');
			}
		}else{
			$this->error('请填写充值积分');
		}
	}


	/**
	 * 转入
	 */



	public function zhuanru(){


        $id=I('get.id');
        $m=D('User');
        $m_dj = M('dengji');
        $arr=$m->find($id);
        $dj_m = $arr['user_dengji'];
        $dengji = $m_dj->where('id='.$dj_m)->find();
        $arr['dengji'] = $dengji;
		$this->assign('v',$arr);
    	$this->display();
	}

	/**
	 * 处理会员可用积分转入
	 */

public function do_zhuanru(){
		$id=I('post.id');
		$chongzhi=I('post.user_keyongjf');
		if($chongzhi){
			$m=D('User');
			$jg=$m->where(array('id'=>$id))->setInc('user_keyongjf',$chongzhi);
			$user=$m->find($id);
			$sy=$user['user_keyongjf'];
			D('User_jifen')->data(array('user_login_bh'=>$user['user_login_bh'],'jifen_laiyuan'=>'jfzr','jifen_num'=>$chongzhi,'jifen_type'=>1,'jifen_yuanyin'=>1,'jifen_shengyu'=>$sy,'jifen_date'=>time()))->add();
			if ($jg){
				$this->success('转入成功',U('User/index',array('p'=>session('p'))));
			}else {
				$this->error('转入失败');
			}
		}else{
			$this->error('请填写转入积分');
		}
	}





   /* public function do_zhuanru(){

        $id=I('post.id');
        $keyong=I('post.user_keyongjf');
        if(1){
            if($keyong <=0){
                $this->error('转换积分必须大于0');
            }

            $m=D('User');
            $arr=$m->find($id);
            $canshu=D('qici')->where('pos=1')->find();
            if($arr['user_baodanjifen']){
                if($arr['user_baodanjifen']>=$keyong){
                    $data['user_baodanjifen']=$arr['user_baodanjifen']-$keyong;
                    $data['user_daiyongjf']=$arr['user_daiyongjf']+($keyong*$canshu['beizeng']);
                    $data['user_fenxiangjf']=$arr['user_fenxiangjf']+$keyong;
                    $jg=$m->where(array('id'=>$id))->data($data)->save();
                    if($jg){
                        if(I('post.riqi')){
                            $riqi=I('post.riqi');//传过来日期
                            $riqi1=strtotime($riqi);//传过来时间戳
                        }else{
                            $riqi1=time();
                        }
                        $bh=$arr['user_login_bh'];
                        $fjifen=$keyong*$canshu['beizeng'];
                        $tian=$canshu['tianshu']+1;
                        $sybili=100-($canshu['fhbili']*$canshu['tianshu']);
                        $arr1['bh']=$bh;
                        $arr1['num'] = $fjifen;
                        $arr1['fan_date']  =date("Ymd",strtotime("+".$canshu['tianshu']." day",$riqi1));
                        $zhuanru = D('Jifenfanhuan')->data($arr1)->add();

                        if($zhuanru){
                            D('User_jifen')->data(array('user_login_bh'=>$arr['user_login_bh'],'jifen_laiyuan'=>'jfzr','jifen_num'=>$keyong,'jifen_type'=>4,'jifen_yuanyin'=>4,'jifen_shengyu'=>$data['user_baodanjifen'],'jifen_date'=>$riqi1))->add();
                            //D('User_jifen')->data(array('user_login_bh'=>$arr['user_login_bh'],'jifen_num'=>$chongzhi,'jifen_type'=>4,'jifen_yuanyin'=>2,'jifen_shengyu'=>$data['user_baodanjifen'],'jifen_date'=>$riqi1))->add();
                            D('User_jifen')->data(array('user_login_bh'=>$arr['user_login_bh'],'jifen_laiyuan'=>'jfzr','jifen_num'=>$fjifen,'jifen_type'=>2,'jifen_yuanyin'=>1,'jifen_shengyu'=>$data['user_daiyongjf'],'jifen_date'=>$riqi1))->add();
                            D('User_jifen')->data(array('user_login_bh'=>$arr['user_login_bh'],'jifen_laiyuan'=>'jfzr','jifen_num'=>$keyong,'jifen_type'=>3,'jifen_yuanyin'=>1,'jifen_shengyu'=>$data['user_fenxiangjf'],'jifen_date'=>$riqi1))->add();
                            $this->success('转入成功',U('User/index'));
                        }
                    }else{
                        $this->error('转入失败');
                    }
                }else{
                    $this->error('充值积分不足');
                }
            }else{
                $this->error('充值积分不足');
            }
        }else{
            $this->error('请填写转入积分');
        }
    }*/

	/**
	 * 报单
	 */
    public function baodan(){
        $id=I('get.id');
        $m=D('User');
        $arr=$m->find($id);
        $this->assign('v',$arr);
        $this->display();
    }
    /**
     * 处理报单
     */
    public function do_baodan(){

        $id=I('post.id');
        $chongzhi=I('post.user_baodanjifen');
        $keyong=I('post.user_keyongjf');
        if(1){
            if($keyong <=0){
                $this->error('转换积分必须大于0');

            }
          

            $m=D('User');
            $arr=$m->find($id);
            //$canshu=D('Canshu')->find();
			 $canshu=D('qici')->where('pos=1')->find();
            if($arr['user_keyongjf']){

                if($arr['user_keyongjf']>=$keyong){
                    $data['user_keyongjf']=$arr['user_keyongjf']-$keyong;
					 $data['user_baodanjifen']=$arr['user_baodanjifen']-$chongzhi;
                    $data['user_daiyongjf']=$arr['user_daiyongjf']+($keyong+$chongzhi)*$canshu['beizeng'];
                    $data['user_fenxiangjf']=$arr['user_fenxiangjf']+$keyong+$chongzhi;
					$data['user_count']=$arr['user_count']+$keyong+$chongzhi;
                    $jg=$m->where(array('id'=>$id))->data($data)->save();
                    if($jg){
						
						 if(I('post.riqi')){
                            $riqi=I('post.riqi');//传过来日期
                            $riqi1=strtotime($riqi);//传过来时间戳
                        }else{
                            $riqi1=time();
                        }
                        $bh=$arr['user_login_bh'];
                        $fjifen=($keyong+$chongzhi)*$canshu['beizeng'];
                        $tian=$canshu['tianshu']+1;
                        $sybili=100-($canshu['fhbili']*$canshu['tianshu']);
                        $arr1['bh']=$bh;
                        $arr1['num'] = $fjifen;
                        $arr1['fan_date']  =date("Ymd",strtotime("+".$canshu['tianshu']." day",$riqi1));
                        $zhuanru = D('Jifenfanhuan')->data($arr1)->add();

                        /// $arr	
						$zhitui=D('User')->where(array('user_sjid1'=>$bh))->count();
					
						$ppbh =D('User')->where(array('user_login_bh'=>$bh))->where('user_sjid2 != "A800001"')->getField('user_sjid2');

						if($ppbh){
						$s2user =D('User')->where(array('user_login_bh'=>$ppbh))->find();
						$baodan = $chongzhi+$keyong;
				
						if($zhitui>=2 && $zhitui <=3 ){
								$s2fx=floor($baodan*5/100);
							}elseif($zhitui>=4 && $zhitui <=6 ){
                                $s2fx=floor($baodan*10/100);
                            }elseif($zhitui>=7){
                                $s2fx=floor($baodan*15/100);
                            }else{
                                $s2fx = 0;
                            }
                            //F('SS',$s2fx);		

							//上二分享积分大于隔代收入 user_keyongjf user_agxfq
							if($s2user['user_fenxiangjf']>=$s2fx){
								$s2data['user_fenxiangjf']=$s2user['user_fenxiangjf']-$s2fx;
								$s2data['user_keyongjf']=$s2user['user_keyongjf']+$s2fx;
								//给上二级减分享加可用
								$jg1=D('User')->where(array('id'=>$s2user['id']))->data($s2data)->save();
								//上二积分变化写入积分表
								D('User_jifen')->data(array('user_login_bh'=>$s2user['user_login_bh'],'jifen_laiyuan'=>'隔代'.$bh,'jifen_num'=>$s2fx,'jifen_type'=>3,'jifen_yuanyin'=>4,'jifen_shengyu'=>$s2data['user_fenxiangjf'],'jifen_date'=>time()))->add();


                                D('User_jifen')->data(array('user_login_bh'=>$s2user['user_login_bh'],'jifen_laiyuan'=>'隔代'.$bh,'jifen_num'=>$s2fx,'jifen_type'=>1,'jifen_yuanyin'=>1,'jifen_shengyu'=>$s2data['user_keyongjf'],'jifen_date'=>time()))->add();
                            }else{//小于
								if($s2user['user_fenxiangjf']){
									$s2data['user_fenxiangjf']=0;
									$s2data['user_keyongjf']=$s2user['user_keyongjf']+$s2user['user_fenxiangjf'];
									//给上二级减分享加可用
									$jg1=D('User')->where(array('id'=>$s2user['id']))->data($s2data)->save();
									D('User_jifen')->data(array('user_login_bh'=>$s2user['user_login_bh'],'jifen_laiyuan'=>'隔代'.$bh,'jifen_num'=>$s2user['user_fenxiangjf'],'jifen_type'=>3,'jifen_yuanyin'=>4,'jifen_shengyu'=>$s2data['user_fenxiangjf'],'jifen_date'=>time()))->add();
                                    D('User_jifen')->data(array('user_login_bh'=>$s2user['user_login_bh'],'jifen_laiyuan'=>'隔代'.$bh,'jifen_num'=>$s2user['user_fenxiangjf'],'jifen_type'=>1,'jifen_yuanyin'=>1,'jifen_shengyu'=>$s2data['user_keyongjf'],'jifen_date'=>time()))->add();
                                }

                         }   



						}	
						    	



                        if($zhuanru){
							    D('User_jifen')->data(array('user_login_bh'=>$arr['user_login_bh'],'jifen_laiyuan'=>'jfbd','jifen_num'=>$keyong,'jifen_type'=>4,'jifen_yuanyin'=>4,'jifen_shengyu'=>$data['user_baodanjifen'],'jifen_date'=>$riqi1))->add();
                            //D('User_jifen')->data(array('user_login_bh'=>$arr['user_login_bh'],'jifen_num'=>$chongzhi,'jifen_type'=>4,'jifen_yuanyin'=>2,'jifen_shengyu'=>$data['user_baodanjifen'],'jifen_date'=>$riqi1))->add();
                            D('User_jifen')->data(array('user_login_bh'=>$arr['user_login_bh'],'jifen_laiyuan'=>'jfbd','jifen_num'=>$fjifen,'jifen_type'=>2,'jifen_yuanyin'=>1,'jifen_shengyu'=>$data['user_daiyongjf'],'jifen_date'=>$riqi1))->add();
                            D('User_jifen')->data(array('user_login_bh'=>$arr['user_login_bh'],'jifen_laiyuan'=>'jfbd','jifen_num'=>$keyong,'jifen_type'=>3,'jifen_yuanyin'=>1,'jifen_shengyu'=>$data['user_fenxiangjf'],'jifen_date'=>$riqi1))->add();
                          
                        }

                        $this->success('报单成功',U('User/index',array('p'=>session('p'))));
                    }else{
                        $this->error('报单失败');
                    }
                }else{
                    $this->error('可用积分不足');
                }
            }else{
                $this->error('可用积分不足');
            }
        }else{
            $this->error('请填写报单积分');
        }
    }

    public function chehui(){
        $id=I('get.id');
        $m=D('User');
        $arr=$m->find($id);
        $this->assign('v',$arr);
        $this->display();
    }

    /**
     * 处理报单撤回
     */

    public function do_chehui(){
        $canshu=D('Canshu')->find();

        $id=I('post.id');

        if(I('post.riqi')){
            $riqi=I('post.riqi');//传过来日期
            $riqi1=strtotime($riqi);//传过来时间戳 array('id'=>$id,'jifen_date'=>$riqi1)
        }
        $m=D('User');
        $arr=$m->find($id);
        $bh=$arr['user_login_bh'];
        $m_user_jifen = M('User_jifen');

        $search= $m_user_jifen->where('user_login_bh='.$bh.' AND jifen_yuanyin=6 AND " and jifen_date>="'.$riqi1.'" and jifen_date < "'.($riqi1+60*60*24).'"')->find();
        if($search){
            $this->error($riqi.'已撤回，请不要重复撤回');
        }
        die();
        $data = $m_user_jifen->field('user_login_bh,SUM(jifen_num) as nums')->where('user_login_bh="'.$bh.'" and jifen_date>="'.$riqi1.'" and jifen_date < "'.($riqi1+60*60*24).'" and  jifen_type=3 and jifen_yuanyin=2')->group('user_login_bh')->select();
        if($data){
            $nums = $data[0]['nums'];
            $data1['user_keyongjf']=$arr['user_keyongjf']+$nums;
            $user_keyongjf=$arr['user_keyongjf']+$nums;
            $data1['user_daiyongjf']=$arr['user_daiyongjf']-($nums*$canshu['dybeishu']);
            $dayongjf6 = $nums*$canshu['dybeishu'];
            $data1['user_fenxiangjf']=$arr['user_fenxiangjf']-$nums;
            $user_fenxiangjf=$arr['user_fenxiangjf']-$nums;

            if( intval($data1['user_daiyongjf']) < 0 || intval($data1['user_fenxiangjf']) <0 ){
                $this->error('待用积分或分享积分不足，无法撤销');
            }

            $chjg=$m->where(array('user_login_bh'=>$bh))->data($data1)->save();

            if($chjg){
                $date1 = time();
                D('User_jifen')->data(array('user_login_bh'=>$arr['user_login_bh'],'jifen_num'=>$nums,'jifen_type'=>1,'jifen_yuanyin'=>6,'jifen_shengyu'=>$data1['user_keyongjf'],'jifen_date'=>$date1))->add();
                //D('User_jifen')->data(array('user_login_bh'=>$arr['user_login_bh'],'jifen_num'=>$chongzhi,'jifen_type'=>4,'jifen_yuanyin'=>6,'jifen_shengyu'=>$data['user_baodanjifen'],'jifen_date'=>$riqi1))->add();
                D('User_jifen')->data(array('user_login_bh'=>$arr['user_login_bh'],'jifen_num'=>$dayongjf6,'jifen_type'=>2,'jifen_yuanyin'=>6,'jifen_shengyu'=>$data1['user_daiyongjf'],'jifen_date'=>$date1))->add();
                D('User_jifen')->data(array('user_login_bh'=>$arr['user_login_bh'],'jifen_num'=>$user_fenxiangjf,'jifen_type'=>3,'jifen_yuanyin'=>6,'jifen_shengyu'=>$data1['user_fenxiangjf'],'jifen_date'=>$date1))->add();

                $this->success('撤回成功',U('User/index'));
            }else{
                $this->error('撤回失败');
            }


        }else{
            $this->error($riqi.'无报单记录');
        }


    }
	
	/**
	 * 积分明细
	 */
	
	public function jifen(){
		$id=I('get.id');
		if($id){
			$m=D('User');
			$user=$m->find($id);
			if($user){
				$where['user_login_bh']=$user['user_login_bh'];
				$jifen=D('User_jifen')->where($where)->order('id desc')->select();
				$this->assign('j',$jifen);
				$keyongjifen=array();
				$fenxiangjifen=array();
				$daiyongjifen=array();
				$aiguoxiaofei=array();
				$aixinxiaofei=array();
				$pingtaiweihu=array();
				$xiaofeijiangli=array();
				$cash=array();
				
				foreach($jifen as $k=>$v){
					if($v['jifen_type']==1){
						$keyongjifen[]=$v;
					}elseif($v['jifen_type']==2){
						$daiyongjifen[]=$v;
					}elseif($v['jifen_type']==3){
						$fenxiangjifen[]=$v;
					}elseif($v['jifen_type']==4){
						$chongzhi[]=$v;
					}elseif($v['jifen_type']==5){
						$aiguoxiaofei[]=$v;
					}elseif($v['jifen_type']==6){
						$pingtaiweihu[]=$v;
					}elseif($v['jifen_type']==7){
						$aixinxiaofei[]=$v;
					}elseif($v['jifen_type']==8){
						$xiaofeijiangli[]=$v;
					}elseif($v['jifen_type']==9){
						$cash[]=$v;
					}elseif($v['jifen_type']==10){
						$zengsong[]=$v;
					}
				}	
				//现金处理		
				if($cash){
					foreach($cash as $hk=>$hv){
						if($hv['jifen_laiyuan']){
							if($hv['jifen_laiyuan']=='cz'){
								if($hv['jifen_yuanyin']==1){
									$cash[$hk]['ly']='充值现金';
									$cash[$hk]['jf']=$hv['jifen_num'];
								}
							}elseif($hv['jifen_laiyuan']=='gwxf'){
								if($hv['jifen_yuanyin']==4){
									$cash[$hk]['ly']=$hv['user_login_bh'].'现金消费';
									$cash[$hk]['jf']='-'.$hv['jifen_num'];
								}
							}elseif($hv['jifen_laiyuan']=='tx'){
								if($hv['jifen_yuanyin']==4){
									$cash[$hk]['ly']=$hv['user_login_bh'].'提现转出';
									$cash[$hk]['jf']='-'.$hv['jifen_num'];
								}
							}
						}
					}
					$this->assign('cash',$cash);
				}
				
				
				//赠送积分		
				if($zengsong){
					foreach($zengsong as $hkzs=>$hvzs){
						if($hvzs['jifen_laiyuan']){
							if($hvzs['jifen_laiyuan']=='zs'){
								if($hvzs['jifen_yuanyin']==1){
									$zengsong[$hkzs]['ly']='系统转入';
								    $zengsong[$hkzs]['jf']=$hvzs['jifen_num'];
								}
							}
						}
					}
					$this->assign('zengsong',$zengsong);
				}
				
				
				
			//充值积分两种情况，充值转入和转出
				if($chongzhi){
					foreach ($chongzhi as $ck=>$cv) {
						if($cv['jifen_yuanyin']==1){
							$chongzhi[$ck]['ly']='充值转入';
							$chongzhi[$ck]['jf']=$cv['jifen_num'];
						}elseif($cv['jifen_yuanyin']==4){
							$chongzhi[$ck]['ly']='充值积分转出';
							$chongzhi[$ck]['jf']='-'.$cv['jifen_num'];
						}
					}
					$this->assign('cz',$chongzhi);
				}
				//待用积分
				if($daiyongjifen){
					//var_dump($daiyongjifen);
					foreach ($daiyongjifen as $dk=>$dv) {
						if($dv['jifen_laiyuan']){
							if($dv['jifen_laiyuan']=='fh'){//系统返还
								if($dv['jifen_yuanyin']==1){
									$daiyongjifen[$dk]['ly']='系统返还';
									$daiyongjifen[$dk]['jf']=$dv['jifen_num'];
								}elseif($dv['jifen_yuanyin']==4){
									$daiyongjifen[$dk]['ly']='系统转出';
									$daiyongjifen[$dk]['jf']='-'.$dv['jifen_num'];
								}
							}elseif($dv['jifen_laiyuan']=='jfzr'){
								if($dv['jifen_yuanyin']==1){
									$daiyongjifen[$dk]['ly']='充值积分转入';
									$daiyongjifen[$dk]['jf']=$dv['jifen_num'];
								}elseif($dv['jifen_yuanyin']==4){
									$daiyongjifen[$dk]['ly']='积分转出';
									$daiyongjifen[$dk]['jf']='-'.$dv['jifen_num'];
								}
							}elseif($dv['jifen_laiyuan']=='ft'){

									if($dv['jifen_yuanyin']==1){
										$daiyongjifen[$dk]['ly']='自可用积分复投转入';
										$daiyongjifen[$dk]['jf']=$dv['jifen_num'];
									}elseif($dv['jifen_yuanyin']==4){
										$daiyongjifen[$dk]['ly']='复投转出';
										$daiyongjifen[$dk]['jf']='-'.$dv['jifen_num'];
									}
							}else{//laiyuan是会员编号的

								if($dv['jifen_yuanyin']==1){
									$daiyongjifen[$dk]['ly']='自编号为'.$dv['jifen_laiyuan'].'转入';
									$daiyongjifen[$dk]['jf']=$dv['jifen_num'];
								}elseif($dv['jifen_yuanyin']==4){
									$daiyongjifen[$dk]['ly']=$dv['jifen_laiyuan'];
									$daiyongjifen[$dk]['jf']='-'.$dv['jifen_num'];
								}
							}
						}else{
							if($dv['jifen_yuanyin']==1){
								$daiyongjifen[$dk]['ly']='系统转入';
								$daiyongjifen[$dk]['jf']=$dv['jifen_num'];
							}elseif($dv['jifen_yuanyin']==4){
								$daiyongjifen[$dk]['ly']='系统转出';
								$daiyongjifen[$dk]['jf']='-'.$dv['jifen_num'];
							}
						}
					}
					$this->assign('d',$daiyongjifen);
				}
				//可用积分
				if($keyongjifen){
					foreach ($keyongjifen as $kk => $kv) {
						if($kv['jifen_laiyuan']){
							if($kv['jifen_laiyuan']=='fh'){
								if($kv['jifen_yuanyin']==1){
									$keyongjifen[$kk]['ly']='系统返还';
									$keyongjifen[$kk]['jf']=$kv['jifen_num'];
								}elseif($kv['jifen_yuanyin']==4){
									$keyongjifen[$kk]['ly']='系统转出';
									$keyongjifen[$kk]['jf']='-'.$kv['jifen_num'];
								}elseif($kv['jifen_yuanyin']==5){
									$keyongjifen[$kk]['ly']='购物消费';
									$keyongjifen[$kk]['jf']='-'.$kv['jifen_num'];
								}

							}elseif($kv['jifen_laiyuan']=='jfzr'){

								if($kv['jifen_yuanyin']==1){
									$keyongjifen[$kk]['ly']='积分转入';
									$keyongjifen[$kk]['jf']=$kv['jifen_num'];
								}elseif($kv['jifen_yuanyin']==4){
									$keyongjifen[$kk]['ly']='积分转出';
									$keyongjifen[$kk]['jf']='-'.$kv['jifen_num'];
								}elseif($kv['jifen_yuanyin']==5){
									$keyongjifen[$kk]['ly']='购物消费';
									$keyongjifen[$kk]['jf']='-'.$kv['jifen_num'];
								}

							}elseif($kv['jifen_laiyuan']=='ft'){

								if($kv['jifen_yuanyin']==1){
										$keyongjifen[$kk]['ly']='复投转入';
										$keyongjifen[$kk]['jf']=$kv['jifen_num'];
								}elseif($kv['jifen_yuanyin']==4){
									$keyongjifen[$kk]['ly']='复投转出';
									$keyongjifen[$kk]['jf']='-'.$kv['jifen_num'];
								}elseif($kv['jifen_yuanyin']==5){
									$keyongjifen[$kk]['ly']='购物消费';
									$keyongjifen[$kk]['jf']='-'.$kv['jifen_num'];
								}
								
							}else{//laiyuan是会员编号的
								if($kv['jifen_yuanyin']==1){
									$keyongjifen[$kk]['ly']=$kv['jifen_laiyuan'].'转入';
									$keyongjifen[$kk]['jf']=$kv['jifen_num'];
								}elseif($kv['jifen_yuanyin']==4){
									$keyongjifen[$kk]['ly']='转出给'.$kv['jifen_laiyuan'];
									$keyongjifen[$kk]['jf']='-'.$kv['jifen_num'];
								}elseif($kv['jifen_yuanyin']==5){
									$keyongjifen[$kk]['ly']='购物消费';
									$keyongjifen[$kk]['jf']='-'.$kv['jifen_num'];
								}
							}

						}else{
							if($kv['jifen_yuanyin']==1){
								$keyongjifen[$kk]['ly']='系统转入';
								$keyongjifen[$kk]['jf']=$kv['jifen_num'];
							}elseif($kv['jifen_yuanyin']==4){
								$keyongjifen[$kk]['ly']='系统转出';
								$keyongjifen[$kk]['jf']='-'.$kv['jifen_num'];
							}elseif($kv['jifen_yuanyin']==5){
								$keyongjifen[$kk]['ly']='购物消费';
								$keyongjifen[$kk]['jf']='-'.$kv['jifen_num'];
							}
						}
					}
					$this->assign('k',$keyongjifen);
				}
				//分享积分
				if($fenxiangjifen){
					foreach ($fenxiangjifen as $fk => $fv) {
						if($fv['jifen_laiyuan']){
							if($fv['jifen_laiyuan']=='fh'){
								if($fv['jifen_yuanyin']==1){
									$fenxiangjifen[$fk]['ly']='系统返还';
									$fenxiangjifen[$fk]['jf']=$fv['jifen_num'];
								}elseif($fv['jifen_yuanyin']==4){
									$fenxiangjifen[$fk]['ly']='系统转出';
									$fenxiangjifen[$fk]['jf']='-'.$fv['jifen_num'];
								}elseif($fv['jifen_yuanyin']==5){
									$fenxiangjifen[$fk]['ly']='购物消费';
									$fenxiangjifen[$fk]['jf']='-'.$fv['jifen_num'];
								}
							}elseif($fv['jifen_laiyuan']=='jfzr'){
								if($fv['jifen_yuanyin']==1){
									$fenxiangjifen[$fk]['ly']='充值积分转入';
									$fenxiangjifen[$fk]['jf']=$fv['jifen_num'];
								}elseif($fv['jifen_yuanyin']==4){
									$fenxiangjifen[$fk]['ly']='积分转出';
									$fenxiangjifen[$fk]['jf']='-'.$fv['jifen_num'];
								}elseif($fv['jifen_yuanyin']==5){
									$fenxiangjifen[$fk]['ly']='购物消费';
									$fenxiangjifen[$fk]['jf']='-'.$fv['jifen_num'];
								}
							}elseif($fv['jifen_laiyuan']=='ft'){
								if($fv['jifen_yuanyin']==1){
									$fenxiangjifen[$fk]['ly']='自可用积分复投转入';
									$fenxiangjifen[$fk]['jf']=$fv['jifen_num'];
								}elseif($fv['jifen_yuanyin']==4){
									$fenxiangjifen[$fk]['ly']='复投转出';
									$fenxiangjifen[$fk]['jf']='-'.$fv['jifen_num'];
								}elseif($fv['jifen_yuanyin']==5){
									$fenxiangjifen[$fk]['ly']='购物消费';
									$fenxiangjifen[$fk]['jf']='-'.$fv['jifen_num'];
								}
							}else{
								if($fv['jifen_yuanyin']==1){
									$fenxiangjifen[$fk]['ly']=$fv['jifen_laiyuan'].'转入';
									$fenxiangjifen[$fk]['jf']=$fv['jifen_num'];
								}elseif($fv['jifen_yuanyin']==4){
									$fenxiangjifen[$fk]['ly']=$fv['jifen_laiyuan'].'转出';
									$fenxiangjifen[$fk]['jf']='-'.$fv['jifen_num'];
								}elseif($fv['jifen_yuanyin']==5){
									$fenxiangjifen[$fk]['ly']='购物消费';
									$fenxiangjifen[$fk]['jf']='-'.$fv['jifen_num'];
								}
							}

						}else{

							if($fv['jifen_yuanyin']==1){
								$fenxiangjifen[$fk]['ly']='系统转入';
								$fenxiangjifen[$fk]['jf']=$fv['jifen_num'];
							}elseif($fv['jifen_yuanyin']==4){
								$fenxiangjifen[$fk]['ly']='系统转出';
								$fenxiangjifen[$fk]['jf']='-'.$fv['jifen_num'];
							}elseif($fv['jifen_yuanyin']==5){
								$fenxiangjifen[$fk]['ly']='购物消费';
								$fenxiangjifen[$fk]['jf']='-'.$fv['jifen_num'];
							}

						}
					}
					$this->assign('f',$fenxiangjifen);
				}
				//爱国消费积分
				if($aiguoxiaofei){
					foreach ($aiguoxiaofei as $ak => $av) {
						if($av['jifen_laiyuan']){
							if($av['jifen_laiyuan']=='fh'){
								if($av['jifen_yuanyin']==1){
									$aiguoxiaofei[$ak]['ly']='系统返还';
									$aiguoxiaofei[$ak]['jf']=$av['jifen_num']; 
								}elseif($av['jifen_yuanyin']==4){
									$aiguoxiaofei[$ak]['ly']='系统转出';
									$aiguoxiaofei[$ak]['jf']='-'.$av['jifen_num'];
								}elseif($av['jifen_yuanyin']==5){
									$aiguoxiaofei[$ak]['ly']='购物消费';
									$aiguoxiaofei[$ak]['jf']='-'.$av['jifen_num'];
								}
							}elseif($av['jifen_laiyuan']=='jfzr'){
								if($av['jifen_yuanyin']==1){
									$aiguoxiaofei[$ak]['ly']='待用积分转入';
									$aiguoxiaofei[$ak]['jf']=$av['jifen_num'];
								}elseif($av['jifen_yuanyin']==4){
									$aiguoxiaofei[$ak]['ly']='积分转出';
									$aiguoxiaofei[$ak]['jf']='-'.$av['jifen_num'];
								}elseif($av['jifen_yuanyin']==5){
									$aiguoxiaofei[$ak]['ly']='购物消费';
									$aiguoxiaofei[$ak]['jf']='-'.$av['jifen_num'];
								}
							}elseif($av['jifen_laiyuan']=='ft'){
								if($av['jifen_yuanyin']==1){
										$aiguoxiaofei[$ak]['ly']='复投转入';
										$aiguoxiaofei[$ak]['jf']=$av['jifen_num'];
								}elseif($av['jifen_yuanyin']==4){
									$aiguoxiaofei[$ak]['ly']='复投转出';
									$aiguoxiaofei[$ak]['jf']='-'.$av['jifen_num'];
								}elseif($av['jifen_yuanyin']==5){
									$aiguoxiaofei[$ak]['ly']='购物消费';
									$aiguoxiaofei[$ak]['jf']='-'.$av['jifen_num'];
								}
							}elseif($av['jifen_laiyuan']=='jljf'){
								if($av['jifen_yuanyin']==1){
									$aiguoxiaofei[$ak]['ly']='从奖励积分转入';
									$aiguoxiaofei[$ak]['jf']=$av['jifen_num'];
								}elseif($av['jifen_yuanyin']==4){
									$aiguoxiaofei[$ak]['ly']='转出';
									$aiguoxiaofei[$ak]['jf']='-'.$av['jifen_num'];
								}elseif($av['jifen_yuanyin']==5){
									$aiguoxiaofei[$ak]['ly']='购物消费';
									$aiguoxiaofei[$ak]['jf']='-'.$av['jifen_num'];
								}
							}else{
								if($av['jifen_yuanyin']==1){
									$aiguoxiaofei[$ak]['ly']='自编号为'.$av['jifen_laiyuan'].'转入';
									$aiguoxiaofei[$ak]['jf']=$av['jifen_num'];
								}elseif($av['jifen_yuanyin']==4){
									$aiguoxiaofei[$ak]['ly']=$av['jifen_laiyuan'];
									$aiguoxiaofei[$ak]['jf']='-'.$av['jifen_num'];
								}elseif($av['jifen_yuanyin']==5){
									$aiguoxiaofei[$ak]['ly']='购物消费';
									$aiguoxiaofei[$ak]['jf']='-'.$av['jifen_num'];
								}
							}
						}else{
							if($av['jifen_yuanyin']==1){
								$aiguoxiaofei[$ak]['ly']='系统转入';
								$aiguoxiaofei[$ak]['jf']=$av['jifen_num'];
							}elseif($av['jifen_yuanyin']==4){
								$aiguoxiaofei[$ak]['ly']='系统转出';
								$aiguoxiaofei[$ak]['jf']='-'.$av['jifen_num'];
							}elseif($av['jifen_yuanyin']==5){
								$aiguoxiaofei[$ak]['ly']='购物消费';
								$aiguoxiaofei[$ak]['jf']='-'.$av['jifen_num'];
							}
						}
					}
					$this->assign('ag',$aiguoxiaofei);
				}
				//爱心消费积分
				if($aixinxiaofei){
					foreach ($aixinxiaofei as $axk => $axv) {
						if($axv['jifen_laiyuan']){
							if($axv['jifen_laiyuan']=='fh'){
								if($axv['jifen_yuanyin']==1){
									$aixinxiaofei[$axk]['ly']='系统返还';
									$aixinxiaofei[$axk]['jf']=$axv['jifen_num'];
								}elseif($axv['jifen_yuanyin']==4){
									$aixinxiaofei[$axk]['ly']='系统转出';
									$aixinxiaofei[$axk]['jf']='-'.$axv['jifen_num'];
								}elseif($axv['jifen_yuanyin']==5){
									$aixinxiaofei[$axk]['ly']='购物消费';
									$aixinxiaofei[$axk]['jf']='-'.$axv['jifen_num'];
								}
							}elseif($axv['jifen_laiyuan']=='jfzr'){
								if($axv['jifen_yuanyin']==1){
									$aixinxiaofei[$axk]['ly']='待用积分转入';
									$aixinxiaofei[$axk]['jf']=$axv['jifen_num'];
								}elseif($axv['jifen_yuanyin']==4){
									$aixinxiaofei[$axk]['ly']='积分转出';
									$aixinxiaofei[$axk]['jf']='-'.$axv['jifen_num'];
								}elseif($axv['jifen_yuanyin']==5){
									$aixinxiaofei[$axk]['ly']='购物消费';
									$aixinxiaofei[$axk]['jf']='-'.$axv['jifen_num'];
								}
							}elseif($axv['jifen_laiyuan']=='ft'){
								if($axv['jifen_yuanyin']==1){
										$aixinxiaofei[$axk]['ly']='复投转入';
										$aixinxiaofei[$axk]['jf']=$axv['jifen_num'];
								}elseif($axv['jifen_yuanyin']==4){
									$aixinxiaofei[$axk]['ly']='复投转出';
									$aixinxiaofei[$axk]['jf']='-'.$axv['jifen_num'];
								}elseif($axv['jifen_yuanyin']==5){
									$aixinxiaofei[$axk]['ly']='购物消费';
									$aixinxiaofei[$axk]['jf']='-'.$axv['jifen_num'];
								}
							}else{
								if($axv['jifen_yuanyin']==1){
									$aixinxiaofei[$axk]['ly']='自编号为'.$axv['jifen_laiyuan'].'转入';
									$aixinxiaofei[$axk]['jf']=$axv['jifen_num'];
								}elseif($axv['jifen_yuanyin']==4){
									$aixinxiaofei[$axk]['ly']=$axv['jifen_laiyuan'];
									$aixinxiaofei[$axk]['jf']='-'.$axv['jifen_num'];
								}elseif($axv['jifen_yuanyin']==5){
									$aixinxiaofei[$axk]['ly']='购物消费';
									$aixinxiaofei[$axk]['jf']='-'.$axv['jifen_num'];
								}
							}
						}else{
							if($axv['jifen_yuanyin']==1){
								$aixinxiaofei[$axk]['ly']='系统转入';
								$aixinxiaofei[$axk]['jf']=$axv['jifen_num'];
							}elseif($axv['jifen_yuanyin']==4){
								$aixinxiaofei[$axk]['ly']='系统转出';
								$aixinxiaofei[$axk]['jf']='-'.$axv['jifen_num'];
							}elseif($axv['jifen_yuanyin']==5){
								$aixinxiaofei[$axk]['ly']='购物消费';
								$aixinxiaofei[$axk]['jf']='-'.$axv['jifen_num'];
							}
						}
					}
					$this->assign('ax',$aixinxiaofei);
				}
				if($pingtaiweihu){
					foreach ($pingtaiweihu as $pk => $pv) {
						if($pv['jifen_laiyuan']){
							if($pv['jifen_laiyuan']=='fh'){
								if($pv['jifen_yuanyin']==1){
									$pingtaiweihu[$pk]['ly']='系统返还';
									$pingtaiweihu[$pk]['jf']=$pv['jifen_num'];
								}elseif($pv['jifen_yuanyin']==4){
									$pingtaiweihu[$pk]['ly']='系统转出';
									$pingtaiweihu[$pk]['jf']='-'.$pv['jifen_num'];
								}elseif($pv['jifen_yuanyin']==5){
									$pingtaiweihu[$pk]['ly']='购物扣除';
									$pingtaiweihu[$pk]['jf']='-'.$pv['jifen_num'];
								}
							}elseif($pv['jifen_laiyuan']=='jfzr'){
								if($pv['jifen_yuanyin']==1){
									$pingtaiweihu[$pk]['ly']='待用积分转入';
									$pingtaiweihu[$pk]['jf']=$pv['jifen_num'];
								}elseif($pv['jifen_yuanyin']==4){
									$pingtaiweihu[$pk]['ly']='积分转出';
									$pingtaiweihu[$pk]['jf']='-'.$pv['jifen_num'];
								}elseif($pv['jifen_yuanyin']==5){
									$pingtaiweihu[$pk]['ly']='购物扣除';
									$pingtaiweihu[$pk]['jf']='-'.$pv['jifen_num'];
								}
							}elseif($pv['jifen_laiyuan']=='ft'){
								if($pv['jifen_yuanyin']==1){
										$pingtaiweihu[$pk]['ly']='复投转入';
										$pingtaiweihu[$pk]['jf']=$pv['jifen_num'];
								}elseif($pv['jifen_yuanyin']==4){
									$pingtaiweihu[$pk]['ly']='复投转出';
									$pingtaiweihu[$pk]['jf']='-'.$pv['jifen_num'];
								}elseif($pv['jifen_yuanyin']==5){
									$pingtaiweihu[$pk]['ly']='购物扣除';
									$pingtaiweihu[$pk]['jf']='-'.$pv['jifen_num'];
								}
							}else{
								if($pv['jifen_yuanyin']==1){
									$pingtaiweihu[$pk]['ly']='自编号为'.$pv['jifen_laiyuan'].'转入';
									$pingtaiweihu[$pk]['jf']=$pv['jifen_num'];
								}elseif($pv['jifen_yuanyin']==4){
									$pingtaiweihu[$pk]['ly']=$pv['jifen_laiyuan'];
									$pingtaiweihu[$pk]['jf']='-'.$pv['jifen_num'];
								}elseif($pv['jifen_yuanyin']==5){
									$pingtaiweihu[$pk]['ly']='购物扣除';
									$pingtaiweihu[$pk]['jf']='-'.$pv['jifen_num'];
								}
							}
						}else{
							if($pv['jifen_yuanyin']==1){
								$pingtaiweihu[$pk]['ly']='系统转入';
								$pingtaiweihu[$pk]['jf']=$pv['jifen_num'];
							}elseif($pv['jifen_yuanyin']==4){
								$pingtaiweihu[$pk]['ly']='系统转出';
								$pingtaiweihu[$pk]['jf']='-'.$pv['jifen_num'];
							}elseif($pv['jifen_yuanyin']==5){
								$pingtaiweihu[$pk]['ly']='购物扣除';
								$pingtaiweihu[$pk]['jf']='-'.$pv['jifen_num'];
							}
						}
					}

					$this->assign('px',$pingtaiweihu);
				}
				if($xiaofeijiangli){
					foreach ($xiaofeijiangli as $xk => $xv) {
						if($xv['jifen_yuanyin']==1){
							$xiaofeijiangli[$xk]['ly']='消费奖励';
							$xiaofeijiangli[$xk]['jf']=$xv['jifen_num'];
						}elseif($xv['jifen_yuanyin']==4){
							$xiaofeijiangli[$xk]['ly']=$pv['jifen_laiyuan'];
							$xiaofeijiangli[$xk]['jf']='-'.$xv['jifen_num'];
						}
					}
				    $this->assign('xx',$xiaofeijiangli);		
				}
			}//$user结束

			$this->assign('u',$user);
			$this->display();

		}//$id结束
	}
	/**
	 * 显示会员详细信息
	 */
	public function detail() {
    	$id=I('get.id');
		$dj=D('Dengji')->select();
    	$m=D('User');
    	$arr=$m->find($id);
    	$this->assign('v',$arr);
		$this->assign('dj',$dj);
    	$this->display();
	}
	/**
	 * 处理会员信息
	 */
	public function do_detail() {
	    $m=D('User'); //先读取News数据库表模型文件
		if(I('post.user_pass')!=''){
			$data['user_pass']=sjjiami('mima',I('post.user_pass'));
		}
		if(I('post.user_zfpass')!=''){
			$data['user_zfpass']=sjjiami('mima',I('post.user_zfpass'));
		}
			$data['id']=I('post.id');
			$data['user_name']=I('post.user_name');
			$data['user_dengji']=I('post.user_dengji');
            $data['user_sjid1']=I('post.user_sjid1');
            $data['user_idcard']=I('post.user_idcard');
            $data['user_keyongjf']=I('post.user_keyongjf');
            $data['user_fenxiangjf']=I('post.user_fenxiangjf');
            $data['user_sjid1']=I('post.user_sjid1');
			$data['user_phone']=I('post.user_phone');
			$data['user_ok']=I('post.user_ok');
            $data['user_zengsongjifen']=I('post.user_zengsongjifen');
		//var_dump($_POST);die();
    	$arr=$m->data($data)->save(); //自动修改 不需要定义id 因为post表单中已经有
    	if ($arr){
            if(I('post.status_id') == 1){
                Vendor('Qcloud.SmsSingleSender');
                $userid = I('post.user_login_bh');
                $pass1 = '111111';
                $pass2 = '222222';
                // 请根据实际 appid 和 appkey 进行开发，以下只作为演示 sdk 使用
                $appid = 1400028710;
                $appkey = "52b347d20b82b003114a1d7e18c196c3";
                $phoneNumber2 = I('post.user_phone');
                $templId = 17351;
                $params = array("{$userid}", "{$pass1}", "{$pass2}");
                $singleSender = new SmsSingleSender($appid, $appkey);

                $result = $singleSender->sendWithParam("86", $phoneNumber2, $templId, $params);
                $rsp = json_decode($result);

            }
    		$this->success('修改成功',U('User/index/',array('p'=>session('p'))));
    	}else {
    		$this->error('修改失败');
    		//$this->error($m->geterror());
    	}
	}
	
	/**
	 * 显示添加会员页面
	 */
	public function add() {
		$dj=D('Dengji')->select();
		$this->assign('dj',$dj);
		$this->display();
	}

	/**
	 * 处理会员添加
	 */
	public function do_add() {
    	//var_dump($_POST);exit;
		$m=M('User'); //先读取News数据库表模型文件
		if (!$m->create()){
			$this->error($m->geterror());
		}

		$data['user_name']=I('post.user_name');
		$data['user_phone']=I('post.user_phone');
		$data['user_idcard']=I('post.user_idcard');
		
		$data['user_pass']=sjjiami('mima',I('post.user_pass'));
		$data['user_zfpass']=sjjiami('mima',I('post.user_zfpass'));

		
		$data['user_regdate']=$data['user_date']=time();
		$data['user_regip']=$data['user_ip']=get_client_ip('',1);
		$data['user_sjid1']=I('post.j_TuiJianNum');
		if(I('post.j_TuiJianNum')){
			$bh=I('post.j_TuiJianNum');
			$sj=D('User')->where(array('user_login_bh'=>$bh))->find();
			if($sj){
				if($sj['user_sjid1']){
					$data['user_sjid2']=$sj['user_sjid1'];
				}
				$data['user_sjid1']=$sj['user_login_bh'];
			}else{
				//echo json_encode(array('code'=>2,'msg'=>'推荐人编号有误'));
				 echo "<script>alert('推荐人编号有误');javascript:history.back(-1);</script>";
				exit;
			}
		}
	   $phone=I('post.user_phone');
	   $result=$m->where('user_phone="'.$phone.'"')->count();
		if($result<8)
		 {
			 
			$result1=$model->where('user_phone="'.$phone.'"')->order('user_login_bh desc')->find();
						if($result1==''){
							 $user_login_bh='A'.$phone;	
							 echo "<script charset='utf-8'>alert('您的编号为'+'$user_login_bh');</script>";
							
						}else{
							$result2=$result1['user_login_bh'];
							$result3=substr($result2,0,1);
						 	switch($result3){
								case 'A':
				                   $user_login_bh='B'.$phone;
					        	    echo "<script charset='utf-8'>alert('您的编号为'+'$user_login_bh');</script>";
									break;
								case 'B':
									$user_login_bh='C'.$phone;
					        	   echo "<script charset='utf-8'>alert('您的编号为'+'$user_login_bh');</script>";
									break;
								case 'C':
									$user_login_bh='D'.$phone;
					        	  echo "<script charset='utf-8'>alert('您的编号为'+'$user_login_bh');</script>";
									break;
								case 'D':
									$user_login_bh='E'.$phone;
					        	  echo "<script charset='utf-8'>alert('您的编号为'+'$user_login_bh');</script>";
									break;
								case 'E':
									$user_login_bh='F'.$phone;
					        	  echo "<script charset='utf-8'>alert('您的编号为'+'$user_login_bh');</script>";
									break;	
									
								case 'F':
									$user_login_bh='G'.$phone;
					       			echo "<script charset='utf-8'>alert('您的编号为'+'$user_login_bh');</script>";
									break;
								case 'G':
									$user_login_bh='H'.$phone;
					     			 echo "<script charset='utf-8'>alert('您的编号为'+'$user_login_bh');</script>";
									break;
								case 'H':
									$user_login_bh='I'.$phone;
					     			echo "<script charset='utf-8'>alert('您的编号为'+'$user_login_bh');</script>";
									break;
								case 'I':
									$user_login_bh='J'.$phone;
					   				echo "<script charset='utf-8'>alert('您的编号为'+'$user_login_bh');</script>";
									break;
									
							
								case 'J':
									$user_login_bh='K'.$phone;
					   				echo "<script charset='utf-8'>alert('您的编号为'+'$user_login_bh');</script>";
									break;
								case 'K':
									$user_login_bh='L'.$phone;
					   				echo "<script charset='utf-8'>alert('您的编号为'+'$user_login_bh');</script>";
									break;
									
								case 'L':
									$user_login_bh='M'.$phone;
					   				echo "<script charset='utf-8'>alert('您的编号为'+'$user_login_bh');</script>";
									break;
								case 'M':
									$user_login_bh='N'.$phone;
					   				echo "<script charset='utf-8'>alert('您的编号为'+'$user_login_bh');</script>";
									break;	
								case 'N':
									$user_login_bh='O'.$phone;
					   				echo "<script charset='utf-8'>alert('您的编号为'+'$user_login_bh');</script>";
									break;
									
								case 'O':
									$user_login_bh='P'.$phone;
					   				echo "<script charset='utf-8'>alert('您的编号为'+'$user_login_bh');</script>";
									break;
								case 'P':
									$user_login_bh='Q'.$phone;
					   				echo "<script charset='utf-8'>alert('您的编号为'+'$user_login_bh');</script>";
									break;	
								case 'Q':
									$user_login_bh='R'.$phone;
					   				echo "<script charset='utf-8'>alert('您的编号为'+'$user_login_bh');</script>";
									break;
									
								case 'R':
									$user_login_bh='S'.$phone;
					   				echo "<script charset='utf-8'>alert('您的编号为'+'$user_login_bh');</script>";
									break;
								case 'S':
									$user_login_bh='T'.$phone;
					   				echo "<script charset='utf-8'>alert('您的编号为'+'$user_login_bh');</script>";
									break;	
								case 'T':
									$user_login_bh='U'.$phone;
					   				echo "<script charset='utf-8'>alert('您的编号为'+'$user_login_bh');</script>";
									break;
									
								case 'U':
									$user_login_bh='V'.$phone;
					   				echo "<script charset='utf-8'>alert('您的编号为'+'$user_login_bh');</script>";
									break;
								case 'V':
									$user_login_bh='W'.$phone;
					   				echo "<script charset='utf-8'>alert('您的编号为'+'$user_login_bh');</script>";
									break;	
								case 'W':
									$user_login_bh='X'.$phone;
					   				echo "<script charset='utf-8'>alert('您的编号为'+'$user_login_bh');</script>";
									break;
									
								case 'X':
									$user_login_bh='Y'.$phone;
					   				echo "<script charset='utf-8'>alert('您的编号为'+'$user_login_bh');</script>";
									break;
								case 'Y':
									$user_login_bh='Z'.$phone;
					   				echo "<script charset='utf-8'>alert('您的编号为'+'$user_login_bh');</script>";
									break;		
								case 'Z':
									
					   				echo "你的手机号注册次数已达到8次或者编号超出字母编号，请换手机号重新注册";
									break;
								
									
								default:
								
									echo "你的手机号注册次数已达到8次或者编号不是字母编号，请换手机号重新注册";
									break;
							}
							
						}
		 
         }
		 
	    $data['user_login_bh']=$user_login_bh;	
		$data['user_dengji']=I('post.user_dengji');	
					
		$arr=$m->data($data)->add();
		
		if ($arr > 0){
		    $this->success('添加成功',U('User/index'));
		}else {
			$this->error('添加失败');
		}
	}


	/**
	 * 删除会员处理
	 */
	public function del() {
		$m=M('User');
		$id=I('get.id');
		$count=$m->delete($id);
		if ($count>0){
			$this->success('删除成功！',U('User/index/',array('p'=>session('p'))));
		}
		else {
			$this->error('删除失败！');
		}
	}
	
	
	/**
	 * 查询数据表单处理类文件
	 */
	public function search(){
		$keyword=I('get.keyword');
		//判断存在id
		if ($id==null){
			$this->assign('ifid',not);
		}
		/*if ($keyword==null){
			$this->error('请输入搜索关键字！');
		}*/
		$m=D('User');
		$data['user_name']=array('like',"%{$keyword}%");
		//$arr=$m->where($data)->relation(true)->select();
		$arr=$m->where($data)->select();
		$arr=$m->where("user_login_bh='{$keyword}' or user_name like '%{$keyword}%'")->select();
    	//**分页实现代码
    	$count=count($arr);// 查询满足要求的总记录数
    	$Page = new \Think\Page($count,11);// 实例化分页类 传入总记录数和每页显示的记录数(25)
    	$show = $Page->show();// 分页显示输出
    	//**分页实现代码
		$data['user_name']=array('like',"%{$keyword}%");
		//$arr=$m->where($data)->relation(true)->limit($Page->firstRow.','.$Page->listRows)->select();
		//$arr=$m->where($data)->limit($Page->firstRow.','.$Page->listRows)->select();
		$arr=$m->where("user_login_bh='{$keyword}' or user_name like '%{$keyword}%'")->limit($Page->firstRow.','.$Page->listRows)->select();		
		foreach($arr as $k=>$v){
			
			if($v['user_dengji']==1){
				$arr[$k]['dj']='VIP会员';
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
		//dump($arr);
		//exit;
		if ($arr==null){
			$this->error('没有数据');
	
		}else {
			//**分页实现代码
			$this->assign('page',$show);// 赋值分页输出
			//**分页实现代码
			$this->assign('vlist',$arr); //在新查询到的数据再分配给前台模板显示
			$this->assign('count',$count);
			$this->display('index'); //指定模板
		}
	
	}
	
	public function search1(){
		$keyword=I('get.keyword');
		//判断存在id
		if ($id==null){
			$this->assign('ifid',not);
		}
		/*if ($keyword==null){
			$this->error('请输入搜索关键字！');
		}*/
		$m=D('User');
		$data['user_name']=array('like',"%{$keyword}%");
		//$arr=$m->where($data)->relation(true)->select();
		$arr=$m->where($data)->select();
		$arr=$m->where("user_login_bh='{$keyword}' or user_name like '%{$keyword}%'")->select();
    	//**分页实现代码
    	$count=count($arr);// 查询满足要求的总记录数
    	$Page = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
    	$show = $Page->show();// 分页显示输出
    	//**分页实现代码
		$data['user_name']=array('like',"%{$keyword}%");
		//$arr=$m->where($data)->relation(true)->limit($Page->firstRow.','.$Page->listRows)->select();
		//$arr=$m->where($data)->limit($Page->firstRow.','.$Page->listRows)->select();
		$arr=$m->where("user_login_bh='{$keyword}' or user_name like '%{$keyword}%'")->limit($Page->firstRow.','.$Page->listRows)->select();		
		foreach($arr as $k=>$v){
			
			if($v['user_dengji']==1){
				$arr[$k]['dj']='VIP会员';
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
		//dump($arr);
		//exit;
		if ($arr==null){
			$this->error('没有数据');
	
		}else {
			//**分页实现代码
			//$this->assign('show',$show);// 赋值分页输出
			$this->assign('page',$show);// 赋值分页输出
			//**分页实现代码
			$this->assign('vlist',$arr); //在新查询到的数据再分配给前台模板显示
			$this->assign('count',$count);
			$this->display('old'); //指定模板
		}
	
	}
	
	/*商城总积分统计*/
	public function countjifen(){
		$mod1=D('user_jifen');
		$arrs=$mod1->field('jifen_type,sum(jifen_num) as sumjf')->group('jifen_type')->order('jifen_type')->select();
		$as=array();
		$artype=array();
		foreach ($arrs as $k => $value) {
			if($value['jifen_type']<10){
				$artype[]=$value['jifen_type'];
			}else{
				unset($arrs[$k]);
			}
		}
		$i=1;
	 	while($i<=7){
	 	 	if(!in_array($i,$artype)){
	 	 		$as['jifen_type']=$i;
	 	 		$as['sumjf']='0';
	 	 		$arrs[]=$as;
	 	 	}
	 	 	$i++;
	 	}
		$this->assign('arrayjf',$arrs);
		$this->display();
	}

	

/**
	 * 充值审核
	 */
	 public function rmbchongzhi(){		
		$tixian=M('Tixian');
		/*审核*/		
		if($_GET['shen']){
			$id=I('get.id');
			$data['status']=$_GET['shen'];
			$result=$tixian->where('id='.$id)->select();	
			$uid=$result[0]['uid'];
			$tixian->where('id='.$id)->data($data)->save();	
			$result2=D('User')->where('id='.$uid)->select();
			$datas['user_xianjin']=$result2[0]['user_xianjin']+$result[0]['txye'];
			$results=D('User')->where('id='.$uid)->data($datas)->save();
			if($results){
				 $dataxz=array();
				  $dataxz['user_login_bh']=$result2[0]['user_login_bh'];
				  $dataxz['jifen_laiyuan']='cz';
				  $dataxz['jifen_num']=$result[0]['txye'];
				  $dataxz['jifen_type']=9;
				  $dataxz['jifen_yuanyin']=1;//转入
				  $dataxz['jifen_shengyu']=$datas['user_xianjin'];
				  $dataxz['jifen_date']=time();
				  M('User_jifen')->add($dataxz);
					$this->success('审核成功',U('User/rmbchongzhi'));
					exit;
			}else {
					$this->error('审核失败');
					exit;
			}
		}
		/*删除*/
		if($_GET['del']){
			$id=I('get.id');
			$shanchu=$tixian->where('id='.$id)->delete();
			if($shanchu){
				$this->success('删除成功',U('User/rmbchongzhi'));
				exit;
			}else {
				$this->error('删除失败');
				exit;
			}						
		}
		$pageSize = 15;
		if($_GET['sousuo']){
			$data['kaihuren']=array('like', '%'.$_GET['keyword'].'%');
			$data['ss_type']=1;
			$total=M('Tixian')->where($data)->count();			
		}else{			
			$total = M('Tixian')->where('ss_type=1')->count();
		}
		$page = new \Think\Page($total,$pageSize);
		$show = $page->show(); 
		if($_GET['sousuo']){
			$data['kaihuren']=array('like', '%'.$_GET['keyword'].'%');
			$data['ss_type']=1;
			$total=M('Tixian')->where($data)->count();			
		}else{			
			$total = M('Tixian')->where('ss_type=1')->count();
		}	
		if($_GET['sousuo']){
			$data['kaihuren']=array('like', '%'.$_GET['keyword'].'%');
			$data['ss_type']=1;
			$result = M('Tixian')->limit($page->firstRow,$page->listRows)->where($data)->order('sq_date desc ')->select();		
		}else{			
			$result = M('Tixian')->limit($page->firstRow,$page->listRows)->where('ss_type=1')->order('sq_date desc ')->select();		

		}			
		$page->setConfig('prev','上一页');
		$page->setConfig('next','下一页');
		$this->assign('result',$result);		
		$this->assign('show',$show);		
		//分页结束
    	$this->display();
	}


	
/**
	提现 
	 * 
	 */

 public function rmbtixian(){		
		$tixian=M('Tixian');
		/*审核*/		
		if($_GET['shen']){
			$id=I('get.id');
			$data['status']=$_GET['shen'];
			$ss_type=2;
			$result=$tixian->where('id='.$id,'ss_type='.$ss_type)->select();
			$uid=$result[0]['uid'];
			$data['tg_date']=time();
			$tixian->where('id='.$id)->data($data)->save();
			 if($tixian){
					$this->success('审核成功',U('User/rmbtixian'));
						exit;
				 }
			}
		/*驳回*/
		if($_GET['bh']){
			$tixian=M('Tixian');
			$id=I('get.id');
			$bohui=$tixian->where('id='.$id)->find();
			$datas['id']=$bohui['uid'];
			$datas['bh_xianjin']=$bohui['txye'];
			
            $data['status']=2;
		    $bh=$tixian->where('id='.$id)->data($data)->save();
			if($bh){
				$xianjin=D('User')->where('id='.$datas['id'])->find();
				$datas['user_xianjin']=$xianjin['user_xianjin']+$datas['bh_xianjin'];
				$results=D('User')->where('id='.$datas['id'])->data($datas)->save();
				$this->success('驳回成功',U('User/rmbtixian'));
				exit;
			}				
		}
		/*打款成功*/
		if($_GET['dkcg'])
		{
			$tixian=M('Tixian');
			$id=I('get.id');
			$data['status']=3;
			$dkcg=$tixian->where('id='.$id)->data($data)->save();
			if($dkcg)
			{
				$this->success('打款成功',U('User/rmbtixian'));
				exit;
				}
			}
		/*批量审核*/
		$vv=I('post.button');
		if($vv==1)
		{ 
		   $tixian=M('Tixian');
		   $seleid=I('POST.intid');
		     foreach($seleid as $vo)
			{
          	  $con['ss_type']=2;
			  $con['status']=0;
			  $con['id']=$vo;
			  $sty=$tixian->where($con)->select();
			  foreach($sty as $v){
					   $data['status']=1;
					   $data['ss_type']=2;
					   $n=$tixian->where('id='.$v['id'])->save($data);
				   }
				}
				if($n)
				{
					$this->success('批量审核成功',U('User/rmbtixian'));
					exit;
					}
	    }
		/*批量打款*/
		if($vv==2)
		{ 
		   $tixian=M('Tixian');
		   $seleid=I('POST.intid');
		     foreach($seleid as $vo)
			{
          	  $con['ss_type']=2;
			  $con['status']=1;
			  $con['id']=$vo;
			  $sty=$tixian->where($con)->select();
			  foreach($sty as $v){
					   $data['status']=3;
					   $data['ss_type']=2;
					   $n=$tixian->where('id='.$v['id'])->save($data);
				   }
				}
				if($n)
				{
					$this->success('批量打款成功',U('User/rmbtixian'));
					exit;
					}
	    }
 /*查询*/
	 if($_GET['sousuo']){
			  $data['kaihuren']=array('like', '%'.$_GET['keyword'].'%');
			  $data['ss_type']=2;
			  $total=M('Tixian')->where($data)->count();
			  $Page = new \Think\Page($total,15);
			  $show = $Page->show();	
			  $list= M('Tixian')->limit($Page->firstRow.','.$Page->listRows)->where($data)->order('sq_date desc ')->select();
			}
			
    $hidd=I('get.hidd');
	
	
	if($hidd==8 && (I('get.sele')==0 || I('get.sele')==1 || I('get.sele')==2 || I('get.sele')==3)&& (I('get.date')<>'') )
	{
	 $data['status']=I('get.sele');
     $time=I('get.date');
	 $timestamp0= strtotime($time);
	 $timestamp24 = strtotime($time) + 86400;
	 $data['sq_date']=array('between',array($timestamp0,$timestamp24));
	 $data['ss_type']=2;
        if($data['status']==0)/*未审核*/
			 { 
			$data['status']==0 ;
			 }
		 if($data['status']==1)/*未审核*/
			 { 
			$data['status']==1 ;
			 }	
		if($data['status']==2)/*未审核*/
			 { 
			$data['status']==2 ;
			 }
		if($data['status']==3)/*未审核*/
			 { 
			$data['status']==4 ;
			 }	 	  
		
	   $tot=M('Tixian')->where($data)->count();
	   $Page = new \Think\Page($tot,15);
	   $show = $Page->show();	
	   $list=M('Tixian')->limit($Page->firstRow.','.$Page->listRows)->where($data)->order('sq_date desc ')->select();     
	}
	if($hidd==8)
	{ 
	  $data['ss_type']=2;
	  if($hidd==8 && I('get.sele')<>'' || I('get.date')<>'' )
	  {
	     $data['status']=I('get.sele');
        if($data['status']==0)/*未审核*/
			 { 
			$data['status']==0 ;
			 }
		 if($data['status']==1)/*未审核*/
			 { 
			$data['status']==1 ;
			 }	
		if($data['status']==2)/*未审核*/
			 { 
			$data['status']==2 ;
			 }
		if($data['status']==3)/*未审核*/
			 { 
			$data['status']==4 ;

			 }	 	  
	   $tot=M('Tixian')->where($data)->count();
	   $Page = new \Think\Page($tot,15);
	   $show = $Page->show();	
	   $list=M('Tixian')->limit($Page->firstRow.','.$Page->listRows)->where($data)->order('sq_date desc ')->select();     
	}else if($hidd==8 && I('get.sele')=='' && I('get.date')=='' ){
	   $tot=M('Tixian')->where($data)->count();
	   $Page = new \Think\Page($tot,15);
	   $show = $Page->show();	
	   $list=M('Tixian')->limit($Page->firstRow.','.$Page->listRows)->where('ss_type=2')->order('sq_date desc ')->select();     
		}
}else{
		  $count=M('Tixian')->where('ss_type=2')->count();
		  $Page = new \Think\Page($count,15);
		  $show = $Page->show();	
		  $list= M('Tixian')->limit($Page->firstRow.','.$Page->listRows)->where('ss_type=2')->order('sq_date desc ')->select();
		 }
		$this->assign('page',$show);// 赋值分页输出
		$this->assign('list',$list);	
    	$this->display();
        }
		
		
		/**
	 * 互转
	 */
	public function huzhuan(){
        $id=I('get.id');
        $m=D('User');
        $arr=$m->where('id='.$id)->find();
        $this->assign('v',$arr);
    	$this->display();
	}

	/**
	 *可用积分互转
	 */
public function do_huzhuan(){
		$id=I('post.id');
		$huzhuan=I('post.keyongjf');
		if($huzhuan){
			$m=D('User');
			$user=$m->find($id);
			  $jifen=$user['user_zs_keyongjf'];
              if($huzhuan>$jifen)
              {
                   $this->error('老的可用积分不足');
              }else{                
             $jg=$m->where(array('id'=>$id))->setDec('user_zs_keyongjf',$huzhuan);
			  D('User_jifen')->data(array('user_login_bh'=>$user['user_login_bh'],'jifen_laiyuan'=>'jfzr','jifen_num'=>$huzhuan,'jifen_type'=>1,'jifen_yuanyin'=>4,'jifen_shengyu'=>$user['user_zs_keyongjf'],'jifen_date'=>time()))->add();
			   if ($jg){
				   $this->success('互转成功',U('User/old',array('p'=>session('pljf'))));
			    }else {
				$this->error('互转失败');
			        }
                }
		}else{
			$this->error('请填写转入积分');
		}
	}

		
		
}





?>