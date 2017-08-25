<?php

namespace Shangcheng\Controller;
use Think\Controller;
use Common\Lib\String; //引入类函数
use Common\Lib\Category; //引入类函数
use Common\Lib\Common; //引入类函数
class GouwucheController extends Controller {
	/**
	 * 购物车控制器
	 */
	const PAY_TYPE_MONEY_JIFEN = 1;
	const PAY_TYPE_MONEY_AGXFQ = 2;//爱国消费券
    //限购good id
    private $arr_xiangouids = array(1693  , 1678 , 1668  ,1692  , 1684  , 1682);
    public function index(){
		if(session('bh')){
			$bh=session('bh');
			$gwc=D('Gouwuche')->where(array('user_login_bh'=>$bh,'type'=>1,'pay_type'=>self::PAY_TYPE_MONEY_JIFEN))->select();
			if($gwc){
				foreach($gwc as $k=>$v){
					$good=D('Goods')->find($v['gid']);
						$gwc[$k]['pic']=$good['pic'];
						$gwc[$k]['gname']=$good['name'];
						$gwc[$k]['jifen']=$good['jifen'];
						$gwc[$k]['only_jifen']=$good['only_jifen'];
						//$gwc[$k]['xg']=$good['xgnum'];
						$gwc[$k]['xj']=$good['xianjing'];

				}
				$this->assign('gwc',$gwc);
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
    //爱国消费车
 public function index1(){
		if(session('bh')){
			$bh=session('bh');
			$gwc1=D('Gouwuche')->where(array('user_login_bh'=>$bh,'type'=>1,'pay_type'=>self::PAY_TYPE_MONEY_AGXFQ))->select();
			if($gwc1){
				foreach($gwc1 as $k=>$v){
					$good=D('Goods')->find($v['gid']);
						$gwc1[$k]['pic']=$good['pic'];
						$gwc1[$k]['gname']=$good['name'];
						$gwc1[$k]['agxfq']=$good['agxfq'];
						//$gwc1[$k]['xg']=$good['xgnum'];//限购
						$gwc1[$k]['xj']=$good['xianjing'];

				}
				$this->assign('gwc1',$gwc1);
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
		$this->display();
	}
	/**
	 * 提交订单
	 */
	public function tijiao(){
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
	 * 加入购物车
	 */
    public function add(){
		if(IS_POST){
			if(I('post.bh')==''){
				echo json_encode(array('code'=>2,'msg'=>'请先登陆'));
				exit;
			}
			if(I('post.idStr')==''){
				echo json_encode(array('code'=>2,'msg'=>'请选择商品'));
				exit;
			}
			$data['user_login_bh']=I('post.bh');
			if($data['user_login_bh']!=session('bh')){
				echo json_encode(array('code'=>2,'msg'=>'登陆失效，请重新登陆'));
				exit;
			}
			$data['gid']=I('post.idStr');
			$good=D('Goods')->find($data['gid']);
			$dingdan=D('Dingdan')->where(array('bh'=>$data['user_login_bh']))->select();
			foreach($dingdan as $ddk=>$ddv){
				$gidarr=json_decode($ddv['gid'],true);//[{"gid":"1634","num":"8"}]
                foreach($gidarr as $gik=>$giv){
					if($giv['gid']==$good['id']){
						$dnum+=$giv['num']; //如果订单中有此商品
					}
				}
			}
			$gouwuche=D('Gouwuche')->where(array('user_login_bh'=>$data['user_login_bh'],'gid'=>$good['id']))->select();
			foreach($gouwuche as $gck=>$gcv){
				$dnum+=$gcv['num'];
			}
			$xgsl=$good['xgnum'];
			/*if($xgsl !== 0 && $dnum>=$good['xgnum']){
				echo json_encode(array('code'=>2,'msg'=>'超出限购数量'));
				exit;
			}*/
			//购物车加入相同的商品，则数目增加
			$gwc=D('Gouwuche')->where(array('user_login_bh'=>$data['user_login_bh'],'gid'=>$data['gid'],'type'=>1,'pay_type'=>I('post.pay_type')))->find();
			//dump($gwc);exit;
			if($gwc['id']){
				$jg=D('Gouwuche')->where(array('id'=>$gwc['id']))->setInc('num',1);
			}else{
				$data['num']=I('post.countStr');
				$data['type']=1;
				$data['pay_type']=I('post.pay_type'); //
				$data['date']=time();
				$jg=D('Gouwuche')->data($data)->add();
			}
			if($jg){
				echo json_encode(array('code'=>1));
				exit;
			}else{
				echo json_encode(array('code'=>2,'msg'=>'网络出错，请稍候重试'));
				exit;
			}
		}
    }
/**
	 * 自增自减
	 */
	public function badd(){
		if(IS_POST){
			if(I('post.countStr')){
				$id=I('post.proid');
				if($id){
					$gwc=D('Gouwuche')->find($id);
				}
				$num=I('post.countStr');
				if($num>0){
					if(session('bh')){
						$bh=session('bh');
					}else{
						echo json_encode(array('code'=>2,'msg'=>'登陆失效，请重新登陆'));
						exit;
					}
					$good=D('Goods')->find($gwc['gid']);
					$dingdan=D('Dingdan')->where(array('bh'=>$bh))->select();
					foreach($dingdan as $ddk=>$ddv){
						$gidarr=json_decode($ddv['gid'],true);
						foreach($gidarr as $gik=>$giv){
							if($giv['gid']==$good['id']){
								$dnum+=$giv['num'];
							}
						}
					}
					$gouwuche=D('Gouwuche')->where(array('user_login_bh'=>$bh,'gid'=>$good['id']))->select();
					foreach($gouwuche as $gck=>$gcv){
						$dnum+=$gcv['num'];
					}
					$jg=D('Gouwuche')->where(array('id'=>$id,'user_login_bh'=>$bh))->setInc('num',1);
						$count=$gwc['num']+1;

					if($count <1){
						M('Gouwuche')->where('id='.$id)->setField('num',1);
						$count = 1;

					}

				}else{
					$jg=D('Gouwuche')->where(array('id'=>$id,'user_login_bh'=>session('bh')))->setDec('num',1);
					$count=$gwc['num']-1;

						if($count <1){
						M('Gouwuche')->where('id='.$id)->setField('num',1);
						$count = 1;

					}


				}
				if($jg){
					echo json_encode(array('code'=>1,'count'=>$count));
					exit;
				}else{
					echo json_encode(array('code'=>2,'msg'=>'网络出错，请稍候重试'));
					exit;
				}
			}elseif(I('post.idStr')){
				$idstr=I('post.idStr');
				$id=substr($idstr,0,-1);
				session('orderid',$id);//719,720

				echo json_encode(array('code'=>1,'url'=>'/go.html'));
				exit;
			}
		}



	}
	//购物车中选中后结算
	public function gorder(){
		//echo session('orderid');
		 $mm=session('mm');
		if(session('orderid')){
			$orderid=session('orderid');
			if(strstr($orderid,',')){//more carts
				$gwc=D('Gouwuche')->where(array('id'=>array('in',$orderid)))->select();
			}else{ // one cart
				if($mm==1){
					$gwc=D('Gouwuche')->where(array('id'=>$orderid))->select();
				}else{
					$gwc=D('Gouwuche')->where(array('id'=>$orderid))->select();
				}
			}
			$user=D('User')->where(array('user_login_bh'=>session('bh')))->find();
			$addre=D('User_address')->where(array('bh'=>$user['user_login_bh']))->select();
			foreach($addre as $k=>$v){
				if($v['is_moren']==1){
					$moren=$v;
				}
			}
			if(!$moren){
				$moren=$addre[0];
			}
			$this->assign('dz',$moren);
            $zjf = 0;
            $zqs = 0;
				foreach($gwc as $k=>$v){
					$good=D('Goods')->find($v['gid']);
					$gwc[$k]['pic']=$good['pic'];
					$gwc[$k]['gname']=$good['name'];
					$gwc[$k]['guige']=$good['guige'];
					//zyg $gwc[$k]['jiangli']=$good['jiangli'];
                    if($v['pay_type']==self::PAY_TYPE_MONEY_JIFEN){
                        $gwc[$k]['jifen']=$good['jifen'];
                        $zjf=$zjf+($good['jifen']*$v['num']);
                        $pay_type = self::PAY_TYPE_MONEY_JIFEN;
                    }else{
                        $gwc[$k]['agxfq']=$good['agxfq'];
                        $zjf=$zjf+($good['agxfq']*$v['num']);
                        $pay_type = self::PAY_TYPE_MONEY_AGXFQ;
                    }
					$gwc[$k]['xg']=$good['xgnum']; //0
					if($good['xianjing']==''){$good['xianjing']=0;}
					$gwc[$k]['xj']=$good['xianjing'];
					$zqs=$zqs+$good['xianjing']*$v['num'];

					//zyg $jiangli=$jiangli+($good['jifen']*$v['num']);
				}

			// zyg $this->assign('jiangli',$jiangli);
			$this->assign('zjf',$zjf);//总积分
			$this->assign('user',$user);
			$this->assign('gwc',$gwc);
			$this->assign('pay_type',$pay_type);
			$this->assign('zqs',$zqs);//总现金
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
	public function gorder1(){
		//echo session('orderid');
		 $mm=session('mm');
		if(session('orderid')){
			$orderid=session('orderid');
			if(strstr($orderid,',')){
				$gwc=D('Gouwuche')->where(array('id'=>array('in',$orderid)))->select();
			}else{
				if($mm==1){
					$gwc=D('Gouwuche')->where(array('id'=>$orderid))->select();
				}else{
					$gwc=D('Gouwuche')->where(array('id'=>$orderid))->select();
				}
			}
			$user=D('User')->where(array('user_login_bh'=>session('bh')))->find();
			$addre=D('User_address')->where(array('bh'=>$user['user_login_bh']))->select();
			foreach($addre as $k=>$v){
				if($v['is_moren']==1){
					$moren=$v;
				}
			}
			if(!$moren){
				$moren=$addre[0];
			}
			$this->assign('dz',$moren);

				foreach($gwc as $k=>$v){
					$good=D('Goods')->find($v['gid']);
					$gwc[$k]['pic']=$good['pic'];
					$gwc[$k]['gname']=$good['name'];
					$gwc[$k]['guige']=$good['guige'];
					$gwc[$k]['jiangli']=$good['jiangli'];
					$gwc[$k]['jifen']=$good['jifen'];
					$gwc[$k]['xg']=$good['xgnum'];
					if($good['xianjing']==''){$good['xianjing']=0;}
					$gwc[$k]['xj']=$good['xianjing'];
					$zqs=$zqs+$good['xianjing']*$v['num'];
					$zjf=$zjf+($good['jifen']*$v['num']);
					$jiangli=$jiangli+($good['jifen']*$v['num']);
				}

			$this->assign('jiangli',$jiangli);
			$this->assign('zjf',$zjf);
			$this->assign('user',$user);
			$this->assign('gwc',$gwc);
			$this->assign('zqs',$zqs);
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
	/**
	 * 收货地址
	 */
	public function address(){
		//echo 'ok';
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
	 * 添加收货地址
	 */
	public function address1(){
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
	 * 添加收货地址
	 */
	public function address2(){
		if(IS_POST){
			$json=file_get_contents('ChineseCities.json');
			$arr=json_decode($json,true);
			if(I('post.t')=='p'){
				foreach($arr as $k=>$v){
					$html.='<option data_id="'.($k+1).'" value="'.$v['name'].'">'.$v['name'].'</option>';
				}
				echo json_encode(array('state'=>1,'data'=>$html));
				exit;
			}elseif(I('post.t')=='sc'){
				if(session('bh')){
					$bh=session('bh');
				}else{
					echo json_encode(array('code'=>2,'msg'=>'登陆失效，请重新登陆'));
					exit;
				}
				$id=I('post.proid');
				$jg=D('Gouwuche')->where(array('bh'=>$bh,'id'=>$id))->delete();
				if($jg){
					echo json_encode(array('code'=>1));
					exit;
				}else{
					echo json_encode(array('code'=>2,'msg'=>'网络出错，请稍候重试'));
					exit;
				}

			}elseif(I('post.t')=='a'){
				if(I('post.userName'))$data['name']=I('post.userName');
				if(I('post.userTel'))$data['mobile']=I('post.userTel');
				if(I('post.userCode'))$data['youbian']=I('post.userCode');
				if(I('post.userAddress'))$data['dizhi']=I('post.userAddress');
				if(I('post.proID'))$data['sheng']=I('post.proID');
				if(I('post.cityID'))$data['shi']=I('post.cityID');
				if(I('post.areaID'))$data['qu']=I('post.areaID');
				if(I('post.useKahao'))$data['kahao']=I('post.useKahao');
				if(I('post.useKaihuhang'))$data['kaihuhang']=I('post.useKaihuhang');
				if(I('post.useKaihuming'))$data['kaihuming']=I('post.useKaihuming');
				if($data){
					if(session('bh')){
						$data['bh']=session('bh');
					}else{
						echo json_encode(array('state'=>2));
						exit;
					}
					$data['date']=time();
					$jg=D('User_address')->data($data)->add();
					if($jg){
						echo json_encode(array('state'=>1));
						exit;
					}
				}
			}elseif(I('post.t')=='d'){
				if(session('bh')){
					$bh=session('bh');
					$addmr=D('User_address')->where(array('bh'=>$bh,'is_moren'=>1))->order('id desc')->find();
					if($addmr){
						$html='<li class="address_item curr"><a href="/gdd.html?id='.$addmr['id'].'"><div class="address_item_info">收货人：'.$addmr['name'].'<span class="fr">'.$addmr['mobile'].'</span></div><div class="address_item_info address_item_addr">详细地址：'.$addmr['dizhi'].'</div><div class="address_item_icon"><img src="/Public/Home/Shangchengpc/images/moren.png"></div></a></li>';
					}
					$addre=D('User_address')->where(array('bh'=>$bh,'is_moren'=>array('neq',1)))->order('id desc')->select();
					foreach($addre as $k=>$v){
						if($html!=''){
							$html.='<li class="address_item"><a href="/gdd.html?id='.$v['id'].'"><div class="address_item_info">收货人：'.$v['name'].'<span class="fr">'.$v['mobile'].'</span></div><div class="address_item_info address_item_addr">详细地址：'.$v['dizhi'].'</div><div class="address_item_icon"><img src="/Public/Home/Shangcheng/images/moren.png"></div></a></li>';
						}else{
							if($k==0){
								$html.='<li class="address_item curr"><a href="/gdd.html?id='.$v['id'].'"><div class="address_item_info">收货人：'.$v['name'].'<span class="fr">'.$v['mobile'].'</span></div><div class="address_item_info address_item_addr">详细地址：'.$v['dizhi'].'</div><div class="address_item_icon"><img src="/Public/Home/Shangchengpc/images/moren.png"></div></a></li>';
							}else{
								$html.='<li class="address_item"><a href="/gdd.html?id='.$v['id'].'"><div class="address_item_info">收货人：'.$v['name'].'<span class="fr">'.$v['mobile'].'</span></div><div class="address_item_info address_item_addr">详细地址：'.$v['dizhi'].'</div><div class="address_item_icon"><img src="/Public/Home/Shangcheng/images/moren.png"></div></a></li>';
							}
						}
					}
					echo json_encode(array('state'=>1,'data'=>$html));
					exit;
				}
			}elseif(I('post.t')=='de'){
				$id=I('post.idStr');
				$detail=D('User_address')->find($id);
				if($detail){
					$data['userName']=$detail['name'];
					$data['userTel']=$detail['mobile'];
					$data['userArea']=$detail['sheng'].' '.$detail['shi'].' '.$detail['qu'];
					$data['userAddress']=$detail['dizhi'];
					$data['kh']=$detail['kahao'];
					$data['khm']=$detail['kaihuming'];
					$data['khh']=$detail['kaihuhang'];
					$data['state']=1;
					echo json_encode($data);
					exit;
				}else{
					echo json_encode(array('state'=>2));
					exit;
				}
			}elseif(I('post.t')=='ed'){
				$id=I('post.idStr');
				$detail=D('User_address')->find($id);
				if($detail){
					$data['userName']=$detail['name'];
					$data['userTel']=$detail['mobile'];
					$data['userCode']=$detail['youbian'];
					$data['Pri']=$detail['sheng'];
					$data['City']=$detail['shi'];
					$data['Area']=$detail['qu'];
					$data['userAddress']=$detail['dizhi'];
					$data['kh']=$detail['kahao'];
					$data['khm']=$detail['kaihuming'];
					$data['khh']=$detail['kaihuhang'];
					$data['state']=1;
					echo json_encode($data);
					exit;
				}else{
					echo json_encode(array('state'=>2));
					exit;
				}
			}elseif(I('post.t')=='u'){
				$id=I('post.idStr');
				$detail=D('User_address')->find($id);
				if($detail['name']!=I('post.userName')){
					$data['name']=I('post.userName');
				}
				if($detail['mobile']!=I('post.userTel')){
					$data['mobile']=I('post.userTel');
				}
				if($detail['youbian']!=I('post.userCode')){
					$data['youbian']=I('post.userCode');
				}
				if($detail['dizhi']!=I('post.userAddress')){
					$data['dizhi']=I('post.userAddress');
				}
				if($detail['sheng']!=I('post.proID')){
					$data['sheng']=I('post.proID');
				}
				if($detail['shi']!=I('post.cityID')){
					$data['shi']=I('post.cityID');
				}
				if($detail['qu']!=I('post.areaID')){
					$data['qu']=I('post.areaID');
				}
				if($detail['kahao']!=I('post.useKahao')){
					$data['kahao']=I('post.useKahao');
				}
				if($detail['kaihuhang']!=I('post.useKaihuhang')){
					$data['kaihuhang']=I('post.useKaihuhang');
				}
				if($detail['kaihuming']!=I('post.useKaihuming')){
					$data['kaihuming']=I('post.useKaihuming');
				}
				if($data){
					if(session('bh')){
						//$data['bh']=session('bh');
					}else{
						echo json_encode(array('state'=>2));
						exit;
					}
					$data['id']=$id;
					$jg=D('User_address')->data($data)->save();
					if($jg){
						echo json_encode(array('state'=>1));
						exit;
					}else{
						echo json_encode(array('state'=>2));
						exit;
					}
				}
			}elseif(I('post.t')=='m'){
				if(I('post.state')==1){
					if(session('bh')){
						$bh=session('bh');
					}else{
						echo json_encode(array('state'=>2));
						exit;
					}
					$id=I('post.idStr');
					D('User_address')->where(array('bh'=>$bh,'id'=>array('neq',$id)))->data(array('is_moren'=>0))->save();
					$jg=D('User_address')->where(array('id'=>$id))->data(array('is_moren'=>1))->save();
					if($jg){
						echo json_encode(array('state'=>1));
						exit;
					}else{
						echo json_encode(array('state'=>2));
						exit;
					}
				}elseif(I('post.state')==2){
					if(session('bh')){
						//$data['bh']=session('bh');
					}else{
						echo json_encode(array('state'=>2));
						exit;
					}
					$id=I('post.idStr');
					$jg=D('User_address')->where(array('id'=>$id))->delete();
					if($jg){
						echo json_encode(array('state'=>1));
						exit;
					}else{
						echo json_encode(array('state'=>2));
						exit;
					}
				}
			}elseif(I('post.t')=='t'){ //go 提交订
           		$orderid=session('orderid');
				if(session('bh')==''){
					echo json_encode(array('code'=>2,'msg'=>'登陆失效，请重新登陆'));
					exit;
				}
				$data['bh']=session('bh');
				$dizhi=D('User_address')->where(array('bh'=>$data['bh']))->order('id desc')->find();
				if(!$dizhi['dizhi']){
					echo json_encode(array('code'=>2,'msg'=>'请先完善收货地址'));
					exit;
				}
				$data['yingfukuan']=I('post.r_total');
				$data['shop_type']=I('post.pay_type'); //订单类型为可用积分或是爱国消费积分
				//zyg $data['jianglijifen']=I('post.jl');
				$data['yingkouxianjin']=I('post.pro_money');//总现金
				if(I('post.descriptions')){
					$data['beizhu']=I('post.descriptions');
				}
				$data['dingdanhao']=time().mt_rand(0,9).mt_rand(0,9);
			    $have_only_jifen = false; //是否有纯积分商品?
                $first_num = 0;//第一次下单时纯积分good数量

				if(strstr($orderid,',')){//如果是多个购物车
					$arr=explode(',',$orderid);
					foreach($arr as $k=>$v){
						$gwc=D('Gouwuche')->find($v);
						$garr['gid']=$gwc['gid'];
						$garr['num']=$gwc['num'];
						$gid[]=$garr;
                        $good=D('Goods')->find($gwc['gid']);
                        //如果车中商品数量大于库存，则提示此商品下单失败
                        if($gwc['num']>$good['kucun']-$good['xiaoshou']){
                            echo json_encode(array('code'=>2,'msg'=>$good['name'].' 库存紧张，请稍候！'));
                            exit;
                        }
                        //限购商品
                        if(in_array($good['id'],$this->arr_xiangouids)){
                            $first_num+=$gwc['num'];
                            $have_only_jifen = true;
                        }
					}

					$data['gid']=json_encode($gid);
				}else{
					$gwc=D('Gouwuche')->find($orderid);
					$good=D('Goods')->find($gwc['gid']);
					//比较库存
                    if($gwc['num']>$good['kucun']-$good['xiaoshou']){
                        echo json_encode(array('code'=>2,'msg'=>$good['name'].' 库存紧张，请稍候！'));
                        exit;
                    }
                   // dump($gwc);
					//如果商品在限购id中，则
                    if(in_array($good['id'],$this->arr_xiangouids)){
                        $have_only_jifen = true;
                        $first_num=$gwc['num'];
                    }
					$dingdan=D('Dingdan')->where(array('bh'=>$data['bh']))->select();
					if($dingdan){
						foreach($dingdan as $ddk=>$ddv){
							$gidarr=json_decode($ddv['gid'],true);
							foreach($gidarr as $gik=>$giv){
								if($giv['gid']==$good['id']){
									$dnum+=$giv['num'];
								}
							}
						}
					}

					$gouwuche=D('Gouwuche')->where(array('user_login_bh'=>$data['bh'],'gid'=>$good['id']))->select();

					foreach($gouwuche as $gck=>$gcv){
						$dnum+=$gcv['num'];
					}
					$xgsl=$good['xgnum'];
					/*if($xgsl !== 0 && $dnum>=$good['xgnum']){
						echo json_encode(array('code'=>2,'msg'=>'超出限购数量'));
						exit;
					}*/
					$gid[0]['gid']=$gwc['gid'];
					$gid[0]['num']=$gwc['num'];
					$data['gid']=json_encode($gid);
				}
                //echo $first_num;exit;
				//添加订单前判断当前商品是否是纯积分的，不能超过5
                $today = strtotime(date("Y-m-d"));
                $list_order  =D('dingdan')->where(array('bh'=>$data['bh'],'date'=>array('gt',$today),'type'=>2))->select();
				//如果有买纯积分的商品
               // echo $first_num;exit;
                if($have_only_jifen){
                    if($first_num>5){
                        echo json_encode(array('code'=>2,'msg'=>'您购买的纯积分商品超过限定数量5个，下单不成功！'));
                        exit;
                    }
                   // $num_ = 0; //计算订单中纯名分数目
                    foreach($list_order as $k=>$row_){
                        $arr_gid = json_decode($row_['gid'],true);
                        foreach($arr_gid as $gik=>$row_2){
                            if(in_array($row_2['gid'],$this->arr_xiangouids)){
                                $first_num+=$row_2['num'];
                            }
                        }
                    }
                    if($first_num>5){
                        echo json_encode(array('code'=>2,'msg'=>'您购买的纯积分商品总数超过限定数量5个，下单不成功！'));
                        exit;
                    }
                }
				$data['date']=time();
				$data['type']=1;//没支付
				$data['yingkouxianjin']=I('pro_money');//zyg

				$fh=D('Dingdan')->data($data)->add();//添加订单表
               // dump($data);exit;
				if($fh){
					$jg=D('Gouwuche')->where(array('id'=>array('in',$orderid)))->delete();
					if($jg){
						echo json_encode(array('code'=>1,'url'=>'/gt.html?id='.$data['dingdanhao']));
						exit;
					}else{
						echo json_encode(array('code'=>2,'msg'=>'网络出错，请稍候重试'));
						exit;
					}

				}else{
					echo json_encode(array('code'=>2,'msg'=>'网络出错，请稍候重试'));
					exit;
				}

			}elseif(I('post.t')=='dd'){
				$ddh=I('post.proid');
				if($ddh){
					$dingdan=D('Dingdan')->where(array('dingdanhao'=>$ddh,'bh'=>session('bh')))->find();
					if($dingdan){
						echo json_encode(array('code'=>1,'OrderNum'=>$dingdan['dingdanhao'],'OrderTotal'=>$dingdan['yingfukuan'],'jianglijifen'=>$dingdan['jianglijifen'],'yingkouxianjin'=>$dingdan['yingkouxianjin'],'shop_type'=>$dingdan['shop_type']));
						exit;
					}else{
						echo json_encode(array('code'=>2,'msg'=>'网络出错，请稍候重试'));
						exit;
					}
				}else{
					echo json_encode(array('code'=>2,'msg'=>'网络出错，请稍候重试'));
					exit;
				}
			}elseif(I('post.t')=='w'){
				if(session('bh')){
					$bh=session('bh');
				}else{
					echo json_encode(array('code'=>2,'msg'=>'登陆失效，请重新登陆'));
					exit;
				}
				$ks=0;
				$num=5;
				$page=0;
				$type=I('post.cateid');
				if(I('post.pageIndex')){
					$page=I('post.pageIndex');
					$ks=$num*$page;
				}



				//echo $page;die();
				$dingdan=D('Dingdan')->where(array('bh'=>$bh,'type'=>$type))->order('id desc')->limit($ks.','.$num)->select();

				if($dingdan){
					foreach($dingdan as $k=>$v){
						if($type==3){
							$html.='<div class="box-fourteen-2a">
									<span class="box-fourteen-1a">
										<i></i>
										<span>订单号：'.$v['dingdanhao'].'下单时间：'.date('Y-m-d H:i:s',$v['date']).'</span>
										<a href="javascript:void(0)">已取消</a>
									</span>';
						}else{
							$html.='<div class="box-fourteen-2a">
									<span class="box-fourteen-1a">
										<i></i>
										<span>订单号：'.$v['dingdanhao'].'下单时间：'.date('Y-m-d H:i:s',$v['date']).'</span>
										<a href="javascript:void(0)">未付款</a>
									</span>';
						}
						$gid=json_decode($v['gid'],true);
						//var_dump($gid);die();
						foreach($gid as $gk=>$gv){
							$good=D('Goods')->find($gv['gid']);
							$html.='<span class="box-fourteen-1b">
										<i>
											<img src="'.$good['pic'].'">
										</i>
										<div class="box-fourteen-1ba">
											<p>'.$good['name'].':'.$good['guige'].'</p>
										</div>
										<div href="" class="box-fourteen-1bb">
											<p>积分：'.$good['jifen'].'</p>
											<p>x'.$gv['num'].'</p>
										</div>
									</span>';
						}
						if($type==3){
							$html.='<span class="box-fourteen-1c"><p>实付积分：'.$v['yingfukuan'].'</p> <div class="box-fourteen-1ca"><button type="button" >已取消</button></div></span></div>';
						}else{
							$html.='<span class="box-fourteen-1c"><p>实付积分：'.$v['yingfukuan'].'</p> <div class="box-fourteen-1ca"><button type="button" onclick="GetOrderReadyCancel(&#39;'.$v['dingdanhao'].'&#39;)">取消</button><button type="button" onclick="window.location.href=&#39;/gt.html?id='.$v['dingdanhao'].'&#39;">去付款</button></div></span></div>';
						}
					}//var_dump($html);die();
					$count=$page+1;
					echo json_encode(array('code'=>1,'count'=>$count,'data'=>$html));
					exit;
				}else{
					$count=$page;
					echo json_encode(array('code'=>2,'count'=>$count));
					exit;
				}
			}elseif(I('post.t')=='q'){
				if(I('post.proid')){
					$proid=I('post.proid');
					$jg=D('Dingdan')->where(array('dingdanhao'=>$proid,'bh'=>session('bh')))->data(array('type'=>3))->save();
					if($jg){
						echo json_encode(array('code'=>1));
						exit;
					}else{
						echo json_encode(array('code'=>2,'msg'=>'网络出错，请稍候重试'));
						exit;
					}
				}
			}elseif(I('post.t')=='z'){//确认支付
				if(session('bh')){
					$bh=session('bh');
				}else{
					echo json_encode(array('code'=>2,'msg'=>'登陆失效，请重新登陆'));
					exit;
				}

				$ddh=I('post.proid');

				$user=D('User')->where(array('user_login_bh'=>$bh))->find();

				if(strlen($user['user_zfpass'])>30){
					$two=sjjiami('mima',I('post.sendCode'));
					if($user['user_zfpass']!=$two){
						echo json_encode(array('code'=>2,'msg'=>'二级密码错误'));
						exit;
					}
				}else{
					if($user['user_zfpass']!=I('post.sendCode')){
						echo json_encode(array('code'=>2,'msg'=>'二级密码错误'));
						exit;
					}
				}


				$dingdan=D('Dingdan')->where(array('bh'=>$bh,'dingdanhao'=>$ddh))->find();
				if($dingdan){
				    //如果说订单中的商品剩余库存不足，则提示不能支付
                    $arr_good = json_decode($dingdan['gid'],true);//[{gid:1,num2},{gid:2,num3}]
                    foreach($arr_good as $k=>$goodinfo){
                       $row_good= D('Goods')->where(array('id'=>$goodinfo['gid']))->field('id,name,kucun,xiaoshou')->find();
                        if($goodinfo['num']>$row_good['kucun']-$row_good['xiaoshou']){
                            echo json_encode(array('code'=>2,'msg'=>$row_good['name'].' 已经售完，订单失效！'));
                            exit;
                        }
                    }
                   if($dingdan['shop_type']==self::PAY_TYPE_MONEY_JIFEN){ //用可用积分扣
                       if($user['user_keyongjf']>$dingdan['yingfukuan']){
                           // $canshu=D('Canshu')->find();
                           $sy=$user['user_keyongjf']-$dingdan['yingfukuan'];
                           $sxj=$user['user_xianjin']-$dingdan['yingkouxianjin'];
                           $condt1['user_keyongjf']=$sy;
                           $condt1['user_xianjin']=$sxj;
                           D('User')->where(array('id'=>$user['id']))->data($condt1)->save();
                       }else{
                           echo json_encode(array('code'=>2,'msg'=>'积分不足'));
                           exit;
                       }
                   }elseif($dingdan['shop_type']==self::PAY_TYPE_MONEY_AGXFQ){
                       if($user['user_agxfq']>$dingdan['yingfukuan']){
                           // $canshu=D('Canshu')->find();
                           $sy=$user['user_agxfq']-$dingdan['yingfukuan'];
                           $sxj=$user['user_xianjin']-$dingdan['yingkouxianjin'];
                           $condt1['user_agxfq']=$sy;
                           $condt1['user_xianjin']=$sxj;
                           D('User')->where(array('id'=>$user['id']))->data($condt1)->save();
                       }else{
                           echo json_encode(array('code'=>2,'msg'=>'爱国消费积分不足'));
                           exit;
                       }
                   }
                           //D('User_jifen')->data(array('user_login_bh'=>$bh,'jifen_num'=>$dingdan['yingfukuan'],'jifen_type'=>1,'jifen_yuanyin'=>5,'jifen_shengyu'=>$sy,'jifen_date'=>time()))->add();

                          $fjifen=$dingdan['jianglijifen'];  //奖励积分不要了
                           $arr1['bh']=$bh;
                           $arr1['num']=$fjifen;
                           $canshu=D('qici')->where('pos=1')->find();
                           $arr1['fan_date']=date("Ymd",strtotime("+".$canshu['tianshu']." day"));
                           $fh=D('Jifenfanhuan')->data($arr1)->add();

                               $garr=json_decode($dingdan['gid'],true);
                               foreach($garr as $gk=>$gv){

                                   D('Goods')->where(array('id'=>$gv['gid']))->setInc('xiaoshou',$gv['num']);
                               }
                               $jg=D('Dingdan')->where(array('id'=>$dingdan['id']))->data(array('type'=>2))->save();
                               if($jg){

                                   $jgresult=D('Dingdan')->where(array('id'=>$dingdan['id']))->select();
                                   /*
                                       消费明细
                                   */
                                   $point = $jgresult[0]['yingfukuan'];
                                   $datapoint=array();
                                   $datapoint['user_login_bh']=$bh;
                                   $datapoint['jifen_laiyuan']='gwxf';
                                   $datapoint['jifen_num']=$point;
                                   $datapoint['jifen_type']=1;
                                   $datapoint['jifen_yuanyin']=4;
                                   $datapoint['jifen_shengyu']=$sy;
                                   $datapoint['jifen_date']=time();
                                   $cash = $jgresult[0]['yingkouxianjin'];
                                   $datacash=array();
                                   $datacash['user_login_bh']=$bh;
                                   $datacash['jifen_laiyuan']='gwxf';
                                   $datacash['jifen_num']=$cash;
                                   $datacash['jifen_type']=9;
                                   $datacash['jifen_yuanyin']=4;
                                   $datacash['jifen_shengyu']=$sxj;
                                   $datacash['jifen_date']=time();
                                   M('User_jifen')->add($datapoint);   //积分明细入库
                                   if($cash>0){
                                       M('User_jifen')->add($datacash);	//现金明细入库
                                   }
                                   /**/
                                   $jifensum=$jgresult[0]['yingfukuan']+$jgresult[0]['yingkouxianjin'];
                                   $huiyuanbh=$jgresult[0]['bh'];
                                   $bili =M('Fenhong_bili')->where('name="加权分红"')->getField('bili');
                                   $fanaxxfq=intval($jifensum*$bili);
                                   $hyaxjf =M('User')->where("user_login_bh='".$huiyuanbh."'")->getField('user_axxfq');
                                   $hyaxjfsum=$hyaxjf+$fanaxxfq;
                                   $dataax['user_axxfq']=$hyaxjfsum;
                                   /*给用户返爱心消费券*/
                                   $hyaxjfadd =M('User')->where("user_login_bh='".$huiyuanbh."'")->save($dataax);
                                   /*捐赠记录*/
                                   $datajz=array();
                                   $datajz['user_login_bh']=$huiyuanbh;
                                   $datajz['jifen_laiyuan']='jz';
                                   $datajz['jifen_num']=$fanaxxfq;
                                   $datajz['jifen_type']=7;
                                   $datajz['jifen_yuanyin']=1;
                                   $datajz['jifen_shengyu']=$hyaxjfsum;
                                   $datajz['jifen_date']=time();
                                   M('User_jifen')->add($datajz);

                                   echo json_encode(array('code'=>1,'msg'=>'支付成功','url'=>'/umd.html'));
                                   exit;
                               }

				}
			}elseif(I('post.t')=='y'){
				if(session('bh')){
					$bh=session('bh');
				}else{
					echo json_encode(array('code'=>2,'msg'=>'登陆失效，请重新登陆'));
					exit;
				}
				$ks=0;
				$num=5;
				$page=0;
				if(I('post.pageIndex')){
					$page=I('post.pageIndex')-1;
					$ks=$num*$page;
				}



				$dingdan=D('Dingdan')->where(array('bh'=>$bh,'type'=>2))->order('id desc')->limit($ks.','.$num)->select();
				F('AA',$dengdan);
				if($dingdan){
					foreach($dingdan as $k=>$v){
						if($v['good_type']==0){
							$fahuo='待发货';
						}elseif($v['good_type']==1){
							$fahuo='待收货';
						}elseif($v['good_type']==2){
							$fahuo='已完成';
						}else{
							$fahuo='退货';
						}
						$html.='<div class="box-fourteen-2a">
									<span class="box-fourteen-1a">
										<i></i>
										<span>订单号：'.$v['dingdanhao'].'下单时间：'.date('Y-m-d H:i:s',$v['date']).'</span>
										<a href="javascript:void(0)">'.$fahuo.'</a>
									</span>';
						$gid=json_decode($v['gid'],true);
						foreach($gid as $gk=>$gv){
							$good=D('Goods')->find($gv['gid']);
							if($v['shop_type']==self::PAY_TYPE_MONEY_JIFEN){
                                $str_jf = "可用积分：{$good['jifen']}";
                            }else{
                                $str_jf = "爱国消费积分：{$good['agxfq']}";
                            }
							$html.='<span class="box-fourteen-1b" style="border-bottom:1px solid #ccc;margin-bottom:20px">
									<i><img src="'.$good['pic'].'"></i>
									<div class="box-fourteen-1ba">
										<p>商品名称：'.$good['name'].'<br/>商品规格：'.$good['guige'].'</p>
									</div>
									<div href="" class="box-fourteen-1bb">
										<p>'.$str_jf.'</p>
										<p>现金：'.$good['xianjing'].' 元</p>
										<p>x'.$gv['num'].'</p>
									</div>
								</span>';
						}
						$html.='<span class="box-fourteen-1c">
									<p>实付积分：'.$v['yingfukuan'].' 积分</p>
									<p>实付现金：'.$v['yingkouxianjin'].' 元</p>
									<div class="box-fourteen-1ca">
										<button type="button" onclick="window.location.href=&#39;/ddt.html?id='.$v['dingdanhao'].'&#39;" style="border:1px solid #a10508">订单详情</button>
									</div>
								</span></div>';

					}
					$count=$page+2;
						echo json_encode(array('code'=>1,'count'=>$count,'data'=>$html));
						exit;

				}else{

					echo json_encode(array('code'=>2));
					exit;
				}
			}elseif(I('post.t')=='dt'){
				if(session('bh')){
					$bh=session('bh');
				}else{
					echo json_encode(array('code'=>2,'msg'=>'登陆失效，请重新登陆'));
					exit;
				}
				$ddh=I('post.proid');
				$dingdan=D('Dingdan')->where(array('bh'=>$bh,'dingdanhao'=>$ddh))->find();
				$dizhi=D('User_address')->where(array('bh'=>$bh,'is_moren'=>1))->find();
				if(!$dizhi){
					$dizhi=D('User_address')->where(array('bh'=>$bh))->order('id desc')->find();
				}
				if($dingdan){
					if($dingdan['good_type']==0){
						$fahuo='待发货';
					}elseif($dingdan['good_type']==1){
						$fahuo='待收货';
					}elseif($dingdan['good_type']==2){
						$fahuo='已完成';
					}else{
						$fahuo='退货';
					}
					$html.='<div class="ddh" id="orderNum">订单号：'.$dingdan['dingdanhao'].'</div>
							<div class="box-placea-1">
								<h5 id="userName">'.$dizhi['name'].'</h5>
								<p>
									<span class="fr" id="userTel"></span>
								</p>
								<p id="userAddress">'.$dizhi['sheng'].' '.$dizhi['shi'].' '.$dizhi['qu'].' '.$dizhi['dizhi'].'</p>
							</div>
							<div class="box-placea-2">
								<h5>商品列表</h5>
							</div>
							<div id="order_cart">';
					$gid=json_decode($dingdan['gid'],true);
					foreach($gid as $gk=>$gv){
						$good=D('Goods')->find($gv['gid']);
						$html.='<div class="box-placea-2">
								<img src="'.$good['pic'].'" alt="" onclick="javascript:window.location.href=&#39;/d/b/'.$good['id'].'&#39;">
								<span class="box-place-2a" onclick="javascript:window.location.href=&#39;/d/b/'.$good['id'].'&#39;">'.$good['name'].':'.$good['guige'].'</span>
								<span>数量：
									<a href="javascript:void(0)">'.$gv['num'].'</a>
								</span>
								<span>
									<a href="javascript:void(0)">'.$good['jifen'].'积分</a>
								</span>
								<span>';
						if($dingdan['good_type']==2){
							$html.='<span style="cursor:pointer;" >订单完成 &nbsp;
										
									</span>';
						}else{
							$html.='<span style="cursor:pointer;" onclick="GetProIsStateChange(this,&#39;'.$dingdan['dingdanhao'].'&#39;)">'.$fahuo.' &nbsp;
										<a style="color:#1d83e0;">确认收货</a>
									</span>';
						}
						$html.='</span>
							</div>';
						if(trim($dingdan['beizhu'])==''){//die("111");
							$beizhu.=$good['name'].':'.$good['guige'].'*'.$gv['num'].' ';
						}else{//die("222");
							$beizhu=$dingdan['beizhu'];
						}
					}
					//var_dump($dingdan['beizhu']);die();
					$html.='</div>
							<div class="box-placea-5">
								<span>
									<em><h5>商品总积分</h5></em>
									<a href="javascript:void(0)" class="yanse-11" id="order_pro_total">'.$dingdan['yingfukuan'].'</a>
								</span>
								<span><em><h6>备注</h6></em></span>
								<span class="fr" id="order_pro_ProDetail">'.$beizhu.';</span>
								<span class="fr" id="order_remark_desc"></span>
							</div>';
					echo json_encode(array('code'=>1,'data'=>$html));
					exit;
				}else{
					echo json_encode(array('code'=>2,'msg'=>'网络出错，请稍候重试'));
					exit;
				}
			}elseif(I('post.t')=='s'){
				if(session('bh')){
					$bh=session('bh');
				}else{
					echo json_encode(array('code'=>2,'msg'=>'登陆失效，请重新登陆'));
					exit;
				}
				$ddh=I('post.proid');
				//echo $bh;echo "<br/>";echo $ddh;die();
				$jg=D('Dingdan')->where(array('bh'=>$bh,'dingdanhao'=>$ddh))->data(array('good_type'=>2))->save();
				if($jg){
					echo json_encode(array('code'=>1));
					exit;
				}else{
					echo json_encode(array('code'=>2,'msg'=>'网络出错，请稍候重试'));
					exit;
				}
			}
			if(I('post.state')==1){
				$idstr=I('post.idStr')-1;
				session('cityid',$idstr);
				foreach($arr[$idstr]['city'] as $k=>$v){
					$html.='<option data_id="'.($k+1).'" value="'.$v['name'].'">'.$v['name'].'</option>';
				}
				echo json_encode(array('state'=>1,'data'=>$html));
				exit;
			}elseif(I('post.state')==2){
				$idstr=I('post.idStr')-1;
				$cityid=session('cityid');
				foreach($arr[$cityid]['city'][$idstr]['area'] as $k=>$v){
					$html.='<option data_id="'.($k+1).'" value="'.$v.'">'.$v.'</option>';
				}
				echo json_encode(array('state'=>2,'data'=>$html));
				exit;
			}
		}
	}	/**
	 * 收货地址详情
	 */
	public function adddetail(){
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
	 * 收货地址编辑
	 */
	public function editaddress(){
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