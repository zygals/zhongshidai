<?php
namespace Shangchengpc\Controller;
use Qcloud\Sms\SmsSingleSender;
use Think\Controller;
use Common\Lib\String; //引入类函数
use Common\Lib\Category; //引入类函数
use Common\Lib\Common; //引入类函数
class IndexController extends Controller {
	/**
	 * 网站首页控制器
	 */
    public function index(){
		$lunbo=D('Column')->field('column_images')->where(array('column_type'=>1,'column_show'=>1))->order('column_sort asc')->limit(4)->select();
		$tupian=D('Column')->field('column_type,column_images')->where(array('column_type'=>array('gt',1),'column_show'=>1))->order('column_sort asc')->select();
		
		foreach($tupian as $k=>$v){
			if($v['column_type']==2){
				$this->assign('logo',$v['column_images']);
			}
			if($v['column_type']==3){
				$this->assign('lianjie',$v['column_images']);
			}
			if($v['column_type']==4){
				$this->assign('gouwu',$v['column_images']);
			}
		}
		if(!session('config')){
			$config=D('Config')->find();
			session('config',$config);
		}else{
			$config=session('config');
		}
		$this->assign('config',$config);
		
		$glist=D('Goods')->field('id,name,jifen,pic,xianjing')->where(array('is_show'=>1,'fid'=>14))->order('paixu desc')->limit(10)->select();
		if(session('bh')){
			$this->assign('bh',session('bh'));
		}
		$this->assign('lunbo',$lunbo);

		//精品推荐
		$jxlist=D('Goods')->field('id,name,jifen,pic,xianjing')->where(array('is_show'=>1,'index_post'=>1))->order('paixu desc')->limit(20)->select();
		if(session('bh')){
			$this->assign('bh',session('bh'));
		}
		$this->assign('jxlist',$jxlist);
		
		// 爱国消费专区
		$aglist=D('Goods')->field('id,name,jifen,pic,xianjing')->where(array('is_show'=>1,'index_post'=>2))->order('paixu desc')->limit(5)->select();
		if(session('bh')){
			$this->assign('bh',session('bh'));
		}
		$this->assign('aglist',$aglist);
		// 推荐专区
		$tjblist=D('Goods')->field('id,name,jifen,pic,xianjing')->where(array('is_show'=>1,'index_post'=>3))->order('paixu desc')->limit(5)->select();
		if(session('bh')){
			$this->assign('bh',session('bh'));
		}
		$this->assign('tjblist',$tjblist);

		// $tjlist=D('Goods')->field('id,name,jifen,pic,xianjing')->where(array('is_show'=>1,'index_post'=>3))->order('paixu desc')->limit(2,12)->select();
		// if(session('bh')){
		// 	$this->assign('bh',session('bh'));
		// }
		// $this->assign('tjlist',$tjlist);

		// 新品专区
	    $xpblist=D('Goods')->field('id,name,jifen,pic,xianjing')->where(array('is_show'=>1,'index_post'=>4))->order('paixu desc')->limit(5)->select();
		if(session('bh')){
			$this->assign('bh',session('bh'));
		}
		$this->assign('xpblist',$xpblist);	
		
	    // $xplist=D('Goods')->field('id,name,jifen,pic,xianjing')->where(array('is_show'=>1,'index_post'=>4))->order('paixu desc')->limit(2,12)->select();
		// if(session('bh')){
		// 	$this->assign('bh',session('bh'));
		// }
		// $this->assign('xplist',$xplist);
		$xx=D('message')->where('gb_dell=0 and gb_read=0')->select();
		$bh=session('bh');
			$k=0;
			if(session('bh')){
				
				 foreach($xx as $vo)
				 {
					 if($vo['gb_user_bh']){
						 $arbh=$vo['gb_user_bh'];
						 $ary=explode(",",$arbh);
						 if(in_array($bh,$ary)){
							$k++;
							}
					    }else{
							$k++;
						   }
				 }
		}
        // $message= $znxx + $znxx1;
		//var_dump($message);
		$this->assign('k',$k);
		
		// 1f 瓷器 40
		$f1array=D('Goods')->where(array('is_show'=>1,'fid'=>40))->order('id desc')->limit("0,5")->select();
		$this->assign('f1',$f1array);
		// 2f 女装 17
		$f2array=D('Goods')->where(array('is_show'=>1,'fid'=>17))->order('id desc')->limit("0,5")->select();
		$this->assign('f2',$f2array);		
		// 3f 男装 18
		$f3array=D('Goods')->where(array('is_show'=>1,'fid'=>18))->order('id desc')->limit("0,5")->select();
		$this->assign('f3',$f3array);
		// 4f 内衣 19
		$f4array=D('Goods')->where(array('is_show'=>1,'fid'=>19))->order('id desc')->limit("0,5")->select();
		$this->assign('f4',$f4array);
		//5f 童装  20
		$f5array=D('Goods')->where(array('is_show'=>1,'fid'=>20))->order('id desc')->limit("0,5")->select();
		$this->assign('f5',$f5array);
		//6f 鞋靴  21
		$f6array=D('Goods')->where(array('is_show'=>1,'fid'=>21))->order('id desc')->limit("0,5")->select();
		$this->assign('f6',$f6array);
		//7f 配饰  22
		$f7array=D('Goods')->where(array('is_show'=>1,'fid'=>22))->order('id desc')->limit("0,5")->select();
		$this->assign('f7',$f7array);
		//8f 户外  23
		$f8array=D('Goods')->where(array('is_show'=>1,'fid'=>23))->order('id desc')->limit("0,5")->select();
		$this->assign('f8',$f8array);
		//9f 箱包  25
		$f9array=D('Goods')->where(array('is_show'=>1,'fid'=>25))->order('id desc')->limit("0,5")->select();
		$this->assign('f9',$f9array);
		//10f 母婴  26
		$f10array=D('Goods')->where(array('is_show'=>1,'fid'=>26))->order('id desc')->limit("0,5")->select();
		$this->assign('f10',$f10array);
		//11f 玩具  27
		$f11array=D('Goods')->where(array('is_show'=>1,'fid'=>27))->order('id desc')->limit("0,5")->select();
		$this->assign('f11',$f11array);
		//12f 美妆  28
		$f12array=D('Goods')->where(array('is_show'=>1,'fid'=>28))->order('id desc')->limit("0,5")->select();
		$this->assign('f12',$f12array);
		//13f 食品  29
		$f13array=D('Goods')->where(array('is_show'=>1,'fid'=>29))->order('id desc')->limit("0,5")->select();
		$this->assign('f13',$f13array);
		//14f 酒水  39
		$f14array=D('Goods')->where(array('is_show'=>1,'fid'=>39))->order('id desc')->limit("0,5")->select();
		$this->assign('f14',$f14array);
		//15f 日用  30
		$f15array=D('Goods')->where(array('is_show'=>1,'fid'=>30))->order('id desc')->limit("0,5")->select();
		$this->assign('f15',$f15array);
		//16f 数码  31
		$f16array=D('Goods')->where(array('is_show'=>1,'fid'=>31))->order('id desc')->limit("0,5")->select();
		$this->assign('f16',$f16array);
		//17f 家电  32
		$f17array=D('Goods')->where(array('is_show'=>1,'fid'=>32))->order('id desc')->limit("0,5")->select();
		$this->assign('f17',$f17array);
		//18f 家纺  33
		$f18array=D('Goods')->where(array('is_show'=>1,'fid'=>33))->order('id desc')->limit("0,5")->select();
		$this->assign('f18',$f18array);
		//19f 家装  34
		$f19array=D('Goods')->where(array('is_show'=>1,'fid'=>34))->order('id desc')->limit("0,5")->select();
		$this->assign('f19',$f19array);
		//20f 保健  35
		$f20array=D('Goods')->where(array('is_show'=>1,'fid'=>35))->order('id desc')->limit("0,5")->select();
		$this->assign('f20',$f20array);
		//21f 卡券  36
		$f21array=D('Goods')->where(array('is_show'=>1,'fid'=>36))->order('id desc')->limit("0,5")->select();
		$this->assign('f21',$f21array);
		//22f 汽车  37
		$f22array=D('Goods')->where(array('is_show'=>1,'fid'=>37))->order('id desc')->limit("0,5")->select();
		$this->assign('f22',$f22array);
		//23f 房产  38
		$f23array=D('Goods')->where(array('is_show'=>1,'fid'=>38))->order('id desc')->limit("0,5")->select();
		$this->assign('f23',$f23array);

		//商城公告
		$gonggaolist=D('gonggao')->where(array('fid'=>1))->order('id desc')->limit(6)->select();
		$this->assign('gao',$gonggaolist);
		//促销活动
		$cuxiaolist=D('gonggao')->where(array('fid'=>3))->order('id desc')->limit(6)->select();
		$this->assign('cux',$cuxiaolist);

		$this->display();
    }
/**
	 * 商品详情
	 */
	public function detail(){
		
		
		
		// 新品专区
		$arr1=D('Goods')->field('id,name,jifen,pic,xianjing')->where(array('is_show'=>1,'fid'=>14))->order('paixu desc')->limit(5)->select();	
			
		$this->assign('content1',$arr1);
		
		
		
		//精品推荐
		$arr2=D('Goods')->field('id,name,jifen,pic,xianjing')->where(array('is_show'=>1,'index_post'=>1))->order('paixu desc')->limit(5)->select();	
		$this->assign('content2',$arr2);
		
		
		
		// 爱国消费专区
		$arr3=D('Goods')->field('id,name,jifen,pic,xianjing')->where(array('is_show'=>1,'xf_fl'=>1))->order('paixu desc')->limit(5)->select();
		$this->assign('content3',$arr3);
		

		
		if(I('get.b')){
			$id=I('get.b');
			
			
			$d=D('Goods')->find($id);
				
			D('Goods')->where(array('id'=>$id))->setInc('click');
			
			$d['sy']=$d['kucun']-$d['xiaoshou']-$d['xtyuliu'];
			$d['pic']=substr($d['pic'],1,strlen($d['pic']));
			$d['content']=html_entity_decode($d['content']);
			$d['xs']=$d['xiaoshou']+$d['xtyuliu'];
			if($d['sy']<0){
				$d['sy']=0;
			}
			
			//分类
			$fid=$d['fid'];
			$fidname=D('goodsfenlei')->field('name')->where(array('id'=>$fid))->select();
			$this->assign('name',$fidname[0]);
			//同类商品推荐
		
		$leilist=D('Goods')->field('id,fid,name,jifen,pic,xianjing')->where(array('is_show'=>1,'fid'=>$fid))->order('paixu desc')->limit(4)->select();
		$this->assign('fid',$fid);
		$this->assign('leilist',$leilist);
			$pics= array_filter(explode("|", $d['pic_arr']));
			
			
			$this->assign('pics',$pics);
			$this->assign('pic',$pics);
			$this->assign('d',$d);
			if(session('bh')){
				$this->assign('bh',session('bh'));
			}
			$this->assign('config',session('config'));
			if(!session('config')){
			$config=D('Config')->find();
			session('config',$config);
		}else{
			$config=session('config');
		}
		$this->assign('config',$config);
			$this->display();
		}else{
			$this->error('未知错误');
		}
		
		
	
	}

	
	
	/**
	 * 修改密码
	 */
	public function changePass(){
		
		if(IS_POST){
			$user_phone=session('mobile');
			
			$data['user_pass']=sjjiami('mima',I('post.pass'));
			
			$user=D('User')->where(array('user_phone'=>$user_phone))->save($data);
			
			if($user){
					header('location:/l.html');
					}else{
					$this->error('修改失败');
					
				}
			
			
			}
		
		
		
		}
	
	
	public function login(){
		//var_dump();die();
	
		if(IS_POST){
			 
			
		// 检查验证码
    	$verify = I('post.verify');
//     	dump($verify);
//     	exit;
    	if (!check_verify($verify)) {
			$this->error('验证码不正确');
		}
			
			$user_login_bh=strtoupper(I('post.bh'));
			$user_pass=I('post.pass');
			
			$user=D('User')->where(array('user_login_bh'=>$user_login_bh))->find();
			/*if($user['user_ok']==0){
				$this->error('您的账号未激活,请联系管理员');
			}*/
			//var_dump($user);die();
			if($user){
				$jiami=sjjiami('mima',$user_pass);
				//echo $jiami;echo "<br/>";echo $user['user_pass'];die();
				if($user['user_pass']==$jiami){
					$data['user_login']=array('exp','user_login+1');
					$data['user_oldip']=$user['user_ip'];
					$data['user_ip']=get_client_ip('',1);
					$data['user_olddate']=$user['user_date'];
					$data['user_date']=time();
					$jg=D('User')->where(array('id'=>$user['id']))->data($data)->save();
					if($jg){
						session('bh',$user_login_bh);
						//session('bh',$user['user_login_bh']);
						session('id',$user['id']);
						session('name',$user['user_name']);
						$ldata['uid']=$user['id'];
						$ldata['user_login_bh']=$user['user_login_bh'];
						$ldata['login_time']=time();
						$ldata['login_ip']=$data['user_ip'];
						$ldata['login_liulanqi']=$_SERVER['HTTP_USER_AGENT'];
						//$today=strtotime("today");
						//$log=D('User_loginlog')->where(array('user_login_bh'=>$user['user_login_bh'],'login_time'=>array('gt',$today)))->count();
						if(!$log){
							D('User_loginlog')->data($ldata)->add();
						}
						header('location:./u.html');
					}
				}else{
					$this->error('用户名或密码错误');
				}
			}else{
				$this->error('用户名或密码错误');
			}
		}
		if(session('bh')){
			$this->assign('bh',session('bh'));
		}
		if(!session('config')){
			$config=D('Config')->find();
			session('config',$config);
		}else{
			$config=session('config');
		}
		$this->assign('config',$config);
		$this->assign('config',session('config'));
		$this->display();
	}
	
	public function verify(){
        $verify = new \Think\Verify();
        $verify->entry(1);
    }
	/**
	 * 会员注册
	 */
	public function reg(){
		//session('code','12345');
		//var_dump(session('code'));
		$this->display();
	}

	public function Ok(){
		$this->display();
	}

/*	public function do_reg1(){
		$Stdents=M("User"); 
		$tname=isset($_POST['j_TuiJianming'])? $_POST['j_TuiJianming'] : 0 ;
		$tjname=$Stdents->where('user_name="'.$tname.'"')->getField('user_login_bh');;
		$this->ajaxReturn($tjname,"JSON");
		echo json_encode($tjname);  
	}*/
	
	

	
	public function do_reg1(){
		$Stdents=M("User"); 
		$html = '';
		$tname=isset($_POST['j_TuiJianming'])? $_POST['j_TuiJianming'] : 0 ;
		/*$tjname=$Stdents->where('user_name="'.$tname.'"')->getField('user_login_bh');
		$this->ajaxReturn($tjname,"JSON");
		echo json_encode($tjname);  */
		$tjname=$Stdents->where('user_name="'.$tname.'"')->select();
		foreach($tjname as $k=>$v){
			if($v['user_login_bh']!=''){
				$bh = $v['user_login_bh'];
				$html = $html."<option value=".$bh." class='durex'>".$bh."</option>";
			}
		}
		$this->ajaxReturn($html,"JSON");
		echo json_encode($html);
	}

	
	
	
	
	

	public function zhuce(){
		
		if(IS_POST){
			$model=D('User');
			if(session('code')!=I('post.code')){
				 echo "<script charset='utf-8'>alert('验证码错误');javascript:history.back(-1);</script>";
				 exit;	
			}
			
			
			if(I('post.j_TuiJianNum')){
				$bh=I('post.j_TuiJianNum');
				
				
				$sj=$model->where('user_login_bh="'.$bh.'"')->find();
				if($sj){
					if($sj['user_sjid1']){
						$data['user_sjid2']=$sj['user_sjid1'];
					}
					$data['user_sjid1']=$sj['user_login_bh'];
				}else{
					
					
					 echo "<script charset='utf-8'>alert('推荐人编号有误');javascript:history.back(-1);</script>";
					exit;
				}
			}
		
			$data['user_pass']=sjjiami('mima',I('post.user_pass'));
			$data['user_zfpass']=sjjiami('mima',I('post.user_zfpass'));
			$data['user_idcard']=I('post.idcard');
			$data['user_name']=I('post.trueName');
			$data['user_phone']=I('post.mobile');
			$data['user_ok']=0;
			$data['user_regdate']=time();
			$data['user_regip']=get_client_ip('',1);	
			   
			     $phone=$data['user_phone'];
				 $user_pass = I('post.user_pass');
				 $result=$model->where('user_phone="'.$phone.'"')->count();
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
							$data['user_login_bh']=$user_login_bh;
							 $jg=D('User')->data($data)->add();
							if($jg)
							{
								/*
								    Vendor('Qcloud.SmsSingleSender');
									$userid = $data['user_login_bh'];
                                    $pass1 = I('post.user_pass');
                                    $pass2 = I('post.user_zfpass');
									$appid = 1400028710;
									$appkey = "52b347d20b82b003114a1d7e18c196c3";
									$phoneNumber2 = I('post.mobile');
									$templId = 17351;
                                    $params = array("{$userid}", "{$pass1}", "{$pass2}");
									$singleSender = new SmsSingleSender($appid, $appkey);
                                    $result = $singleSender->sendWithParam("86", $phoneNumber2, $templId, $params);
                                    $rsp = json_decode($result);

								 echo "<script charset='utf-8'>alert('您的注册信息已发至您的手机".$phoneNumber2."，请牢记您的登陆编号和登陆密码');window.location.href='".C("PATH_URL")."/l.html';</script>";

							*/
                                  echo "<script charset='utf-8'>alert('注册成功');window.location.href='".C("PATH_URL")."/l.html';</script>";

								} 
						 }
				     else{
						  
					     echo "<script charset='utf-8'>alert('你的手机号注册次数已达到8次或者编号不是字母编号，请换手机号重新注册');javascript:history.back(-1);</script>";
					   }
		}
	}
	
	
	
	
  public function setCode1(){
		
        $tmp = range(0,9);
        $result =implode('',array_rand($tmp,5));
        session('code1',$result,60);
	    $target = "http://121.199.16.178/webservice/sms.php?method=Submit";
        //替换成自己的测试账号,参数顺序和wenservice对应
        $mobile = $_POST['mobile'];
		session('mobile',$mobile,60);
        if(empty($mobile)){
            echo '手机号码不能为空';
        }
        $post_data = "account=cf_wxhdcs456&password=wxhdcs@123&mobile=".$mobile."&content=".rawurlencode("您的验证码是：".$result."。请不要把验证码泄露给其他人。");
        //密码可以使用明文密码或使用32位MD5加密
        $gets =  $this->xml_to_array($this->Post($post_data, $target));
       echo $gets['SubmitResult']['msg'];
    }	
	
	
	
 public function setCode(){


     $tmp = range(0,9);
     $result =implode('',array_rand($tmp,5));
     session('code',$result,60);
     $nums = session('code');
     Vendor('Qcloud.SmsSingleSender');
     // 请根据实际 appid 和 appkey 进行开发，以下只作为演示 sdk 使用
     $appid = 1400028710;
     $appkey = "52b347d20b82b003114a1d7e18c196c3";
     $phoneNumber2 = I('post.mobile');
     $templId = 19244;
     $params = array("{$nums}");
     $singleSender = new SmsSingleSender($appid, $appkey);
     $result = $singleSender->sendWithParam("86", $phoneNumber2, $templId, $params);
     $rsp = json_decode($result);
    echo $rsp;


    }
public function verification(){
        $code  =  I('post.code',trim());
        if($code === session('code')){
            echo 1;
        }else{
            echo 2;
        }
    }

	
public function verification2(){
        $code  =  I('post.code',trim());
        if($code === session('code1')){
            echo 1;
        }else{
            echo 2;
        }
    }		
	
public function Post($curlPost,$url){
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_HEADER, false);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_NOBODY, true);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
			$return_str = curl_exec($curl);
			curl_close($curl);
			return $return_str;
	}
public   function xml_to_array($xml){
            $reg = "/<(\w+)[^>]*>([\\x00-\\xFF]*)<\\/\\1>/";
            if(preg_match_all($reg, $xml, $matches)){
                $count = count($matches[0]);
                for($i = 0; $i < $count; $i++){
                $subxml= $matches[2][$i];
                $key = $matches[1][$i];
                    if(preg_match( $reg, $subxml )){
                        $arr[$key] = $this->xml_to_array( $subxml );
                    }else{
                        $arr[$key] = $subxml;
                    }
                }
            }
            return $arr;
        }
 

	

	/**
	 * 渠道建设
	 */
	public function qudao(){
		$this->assign('config',session('config'));
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
	 * 渠道建设1
	 */
	public function qudao1(){
		$this->assign('config',session('config'));
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
	 * 渠道建设2
	 */
	public function qudao2(){
		$this->assign('config',session('config'));
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
	 * 渠道建设3
	 */
	public function qudao3(){
		$this->assign('config',session('config'));
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
	 * 充值审核
	 */
	 public function rmbchongzhi(){		
		/*
		$id=I('get.id');
		$m=D('User');
    	$arr=$m->find($id);
		$this->assign('v',$arr);
		*/
		$tixian=M('Tixian');
		/*审核*/		
		if($_GET['shen']){
			$id=I('get.id');
			$data['status']=$_GET['shen'];
			$tixian->where('id='.$id)->data($data)->save();		
		}
		/*删除*/
		if($_GET['del']){
			$id=I('get.id');
			$tixian->where('id='.$id)->delete();						
		}
		$pageSize = 10;
		if($_GET['sousuo']){
			$data['kaihuren']=array('like', '%'.$_GET['keyword'].'%');
			$total=M('Tixian')->where($data)->count();			
		}else{			
			$total = M('Tixian')->count();
		}
		$page = new \Think\Page($total,$pageSize);
		$show = $page->show(); 
		if($_GET['sousuo']){
			$data['kaihuren']=array('like', '%'.$_GET['keyword'].'%');
			$total=M('Tixian')->where($data)->count();			
		}else{			
			$total = M('Tixian')->count();
		}	
		if($_GET['sousuo']){
			$data['kaihuren']=array('like', '%'.$_GET['keyword'].'%');
			$data['ss_type']=1;
			$result = M('Tixian')->limit($page->firstRow,$page->listRows)->where($data)->order('tg_date desc ')->select();		
		}else{			
			$result = M('Tixian')->limit($page->firstRow,$page->listRows)->where('ss_type=1')->order('tg_date desc ')->select();		

		}			
		$page->setConfig('prev','上一页');
		$page->setConfig('next','下一页');
		$this->assign('result',$result);		
		$this->assign('show',$show);		
		//分页结束
    	$this->display();
	}

	
	
	
	
	
}