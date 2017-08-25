<?php

namespace Shangcheng\Controller;
use Think\Controller;
use Common\Lib\String; //引入类函数
use Common\Lib\Category; //引入类函数
use Common\Lib\Common; //引入类函数
class FutouController extends Controller {
	/**
	 * 搜索控制器
	 */
    public function index(){
		if(!session('bh')){
			$this->error('登陆失效，请重新登陆');
		}
		if(!session('config')){
			$config=D('Config')->find();
			session('config',$config);
		}else{
			$config=session('config');
		}
        $jfzs = M('jifenfanhuan_zs')->where(array('bh'=>session('bh')))->order('id desc')->select();
        $dengji = M('user')->where(array('user_login_bh'=>session('bh')))->getField('user_dengji');

        $this->assign('jfzs',$jfzs);
        $this->assign('bh',session('bh'));
        $this->assign('dengji',$dengji);
		$this->assign('config',$config);
		$this->display();
    }
	/**
	 * 复投
	 */
	public function futou(){
		if(session('bh')){
			$bh=session('bh');
		}else{
			$this->error('网络出错，请稍候重试');
		}
		if(I('get.proid')){

			$user=D('User')->where(array('user_login_bh'=>$bh))->find();
			$proid=I('get.proid');
			$ftuser=D('User')->where(array('user_login_bh'=>$proid))->find();

			if($proid!=$bh && $user['user_dengji'] <1){
				$this->error('只能给自己复投');
			}
			$this->assign('ftuser',$ftuser);
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
	 * 复投2
	 */
	public function futou2(){
		if(session('bh')){
			$bh=session('bh');
            $data = D('user')->where('user_login_bh="'.$bh.'"')->find();
		}else{
			$this->error('网络出错，请稍候重试');
		}
		if(I('get.bh')){
			$this->assign('ftbh',I('get.bh'));
		}
		//var_dump($user);die();
		if(!session('config')){
			$config=D('Config')->find();
			session('config',$config);
		}else{
			$config=session('config');
		}
        $dengji = M('user')->where(array('user_login_bh'=>session('bh')))->getField('user_dengji');
        $this->assign('dengji',$dengji);
        $this->assign('bh',$bh);
        $this->assign('data',$data);
		$this->assign('config',$config);
		$this->display();
	}

	/**
	 * 处理复投
	 */

    public function futouzs(){

        $canshu=D('qici')->where('pos=1')->find();
        if(session('bh')){
            if (session('bh') != I('post.proid')){
                $this->error('请本人操作');
            }

            $ftbh=I('post.proid');
            header("Content-Type:text/html;charset=utf-8");
            echo "<script>if(confirm('确认复投申请吗')==false){window.location.href='/u.html'; break; }</script>";
            $bh=session('bh');

            //var_dump($_POST);
            $baodan=D('User_jifen')->where(array('user_login_bh'=>$ftbh,'jifen_num'=>array('gt',0),'jifen_type'=>1,'jifen_yuanyin'=>1))->count();
            $ftuser=D('User')->where(array('user_login_bh'=>$ftbh))->find();
            if($baodan>0){
                $user=D('User')->where(array('user_login_bh'=>$bh))->find();
                if(sjjiami('mima',I('post.zfpassword'))!=$user['user_zfpass']){
                    $this->error('支付密码不正确');
                }
                $ftjf=I('post.futou');

                if($ftjf){
                    $ftzs=D('jifenfanhuan_zs')->field('bh,sum(num) as numss')->where('bh="'.$bh.'" and status=0')->find();
                    $nums = 0+$ftzs['numss'];
                    if(@$nums){
                        if($ftuser['user_keyongjf']-$nums<$ftjf){
                            $this->error('积分不足,您还有'.$nums.'正在审核中，请审核通过后再复投','/u.html',6);
                        }
                    }else{
                        if($ftuser['user_keyongjf']<$ftjf){
                            $this->error('可用积分不足，无法复投');
                        }
                    }


                    $arr1['fan_date']=date("Ymd",strtotime("+".$canshu['tianshu']." day"));
                    $arr1['bh']=$ftuser['user_login_bh'];
                    $arr1['pbh']=$ftuser['user_sjid1'];
                    $arr1['ppbh']=$ftuser['user_sjid2'];
                    $arr1['num']=$ftjf;
                    $arr1['qici'] = $canshu['qishu'];
                    $arr1['tijiao_date']=time();
                    $arr1['shenhe_bh']='';
                    $arr1['beizeng']=$canshu['beizeng'];
                    $arr1['stauts']=0;
                    $ftzs=D('jifenfanhuan_zs')->data($arr1)->add();
                    if($ftzs){
                        $this->success('复投申请提交成功','/u.html');
                    }
                }
            }else{
                $this->error('返还未产生可用积分');
            }
        }
    }




    public function futoushenhe2(){
        $bh=session('bh');
        $ks=0;
        $num=10;
        $user_dengji = M('user')->field('user_dengji')->where(array('user_login_bh'=>$bh))->find();

        if($user_dengji['user_dengji'] >=2){

            if(1){
                $page=I('post.pageIndex')-1;
                $ks=$num*$page;
                $arr = M('user')->field('id,user_login_bh,user_sjid1')->where(1)->select();
                $arr2 =  $this->son($arr,$bh);
                $where['bh'] = array('in',$arr2);//cid在这个数组中，
                $where['bh'] = array('in',$arr2);//cid在这个数组中，
                $puser=D('jifenfanhuan_zs')->where($where)->order('id desc')->select();
            }

        }
        //$this->assign('puser',$puser);
        $this->display();
    }

    public function son($arr,$cat_id){
        static $list;
        foreach($arr as $v){

            if($v['user_sjid1'] == $cat_id){
                $list[]= $v['user_login_bh'];

                if($v['user_dengji'] >=2 ){
                    break;
                }
                $this->son($arr,$v['user_login_bh']);
            }
        }
        return $list;
    }

    public function dengjicheck($m){
        $m = trim($m);
        $user1=M("user")->field('user_dengji')->where('user_login_bh="'.$m.'"')->find();
        return $user1['user_dengji'];
    }


   /* public function get_parent_id($cid='A800001'){
        $db = M('user');
        $pids = array();
        $pa1 = '';
        $parents = $db ->data('user_login_bh,user_sjid1,user_dengji')->where("user_login_bh = '".$cid."'")->find();
        $parent = $parents['user_sjid1'];
        $parents = $db ->data('user_login_bh,user_sjid1,user_dengji')->where("user_login_bh = '".$parent."'")->find();
        $parents_dengji= $parents['user_dengji'];
        if($parents['user_dengji'] >1){
            $pa1= $parents['user_login_bh'];

        }else{
            if( $parent != 'A800001'){
                $npids= $this->get_parent_id($parent);
                $dengji = $npids['user_dengji'];
                if($dengji > 1){
                    $pa1= $npids['user_login_bh'];


                }

            }
        }

        return $pa1;

    }*/

/*
 * 导致数据库存请求超时的代码：
 *  根据登录编号查询上级，1 VIP会员  2  社区工作站  3 区域服务中心
 * */
    public  function get_parent_id($cid){
        $db = M('user');
        $nav = $db ->data('user_login_bh,user_sjid1,user_dengji')->where("user_login_bh = '".$cid."'")->find();
       /* if(!$nav){
            return 000;
        }*/
        if($nav['user_dengji'] ==1 and $nav['user_sjid1']  != 'A800001'){// 5010 数据
            return $this->get_parent_id($nav['user_sjid1']);
        }

        return $nav['user_login_bh'];
    }



    public  function getNavPid($cid){
        $db = M('user');
        $nav = $db ->data('user_login_bh,user_sjid1,user_dengji')->where("user_login_bh = '".$cid."'")->find();
        if($nav['user_dengji'] ==1 and $nav['user_sjid1']  != 'A800001'){
        return $this->getNavPid($nav['user_sjid1']);
        }
        echo 'CC'.$nav['user_login_bh'];
        return $nav['user_login_bh'];
    }



    public function futoushenhe(){
        if(!session('bh')){
            $this->error('登陆失效，请重新登陆');
        }
        $sbh=session('bh');
        $ks=0;
        $num=100;
        $user_dengji = M('user')->field('user_dengji')->where(array('user_login_bh'=>$sbh))->find();

        if($user_dengji['user_dengji'] >=2){
            if(I('post.pageIndex')){
                $page=I('post.pageIndex')-1;
                $ks=$num*$page; //280 ,10   290,10
                $puser=D('jifenfanhuan_zs')->where('shenhe_bh="'.$sbh.'" OR shenhe_bh=""')->order('id desc')->limit($ks.','.$num)->select();/*
            ["id"] => string(4) "4393"
    ["bh"] => string(12) "A13313623383"
    ["num"] => string(4) "2750"
    ["fan_date"] => string(8) "20170905"
    ["tijiao_date"] => string(10) "1499387944"
    ["shenhe_bh"] => string(0) ""
    ["pbh"] => string(12) "D18295195768"
    ["ppbh"] => string(12) "A18295195768"
    ["qici"] => string(1) "3"
    ["status"] => string(1) "0"
    ["beizeng"] => string(1) "4"*/
             // dump( $puser);
                if($puser){
                   // $arr = M('user')->field('id,user_login_bh,user_sjid1,user_dengji')->select();
                    $html="";
                    foreach($puser as $kk=>$kv){ //
                        $bh=$kv['bh'];//申请者用户编号
                        $arr2 =  $this->get_parent_id($bh);//A13755207621
                      //  echo $arr2;
                        $araypids=explode(',',$arr2);
                        $isin = in_array($sbh,$araypids);//如果上级编号是我
                        if($isin){
                            $str = array();
                            foreach ($araypids as $ve) {
                                $ddj=$this->dengjicheck($ve);
                                if($ddj >1 ){
                                    $str[] =$ve;
                                    if($str[0] == $sbh){
                                        if($kv['status'] == 0){
                                            $url = "<a onclick='shenhetongguo(".$kv['id'].",this)' style='color: red'>未审核</a>";
                                        }else{
                                            $url = '已审核';
                                        }
                                        $user_name= M('user')->where(array('user_login_bh'=>$kv['bh']))->getField('user_name');
                                        $tijiao_date = date('Ymd',$kv['tijiao_date']);
										if($kv['bh'] != $sbh ){
											    $html.="<tr>
                                                <td>".$kv['id']."".$user_name.'('.$kv['bh'].")</td>//会员名称
                                                <td>".$kv['num']."</td>
                                                <td>".$kv['fan_date']."</td>
                                                <td>".$tijiao_date."</td>
                                                <td>".$kv['qici']."</td>
                                                <td>".$kv['beizeng']."</td>
                                                <td>".$url."</td>
                                            </tr>";
                                            if($ddj>=2){
                                                break;
                                            }
										}
                                    }

                                }
                            }
                        }


                    }

                   echo json_encode(array('code'=>1,'data_info'=>$html));
                    exit;
                }else{
                    echo json_encode(array('code'=>2));
                    exit;
                }
            }

        }
        //$this->assign('puser',$puser);
        $this->display();
    }



    public function futoutongguo(){
        $id = I('get.id');
        $ftdata =  M('jifenfanhuan_zs')->where(array('id'=>$id))->find();
       // dump( $ftdata) ;exit;
        if($ftdata['status'] == 1){
            echo json_encode(['code'=>1,'msg'=>'已审核，请勿重复提交']);
            exit;
//            $this->error('已审核，请勿重复提交');
//            exit();
        }
        $canshu=D('qici')->where('pos=1')->find();
		if(session('bh')){

			$ftbh=$ftdata['bh'];
			header("Content-Type:text/html;charset=utf-8");
			$bh=session('bh');

			//var_dump($_POST);
			$baodan=D('User_jifen')->where(array('user_login_bh'=>$ftbh,'jifen_num'=>array('gt',0),'jifen_type'=>1,'jifen_yuanyin'=>1))->count();
			$ftuser=D('User')->where(array('user_login_bh'=>$ftbh))->find();
            $user=D('User')->where(array('user_login_bh'=>$ftdata['ppbh']))->find();

			if($baodan>0){
				$ftjf=$ftdata['num'];

				if($ftjf){

					if($ftuser['user_keyongjf']< $ftjf){
                        echo json_encode(['code'=>1,'msg'=>'可用积分不足，无法通过申请复投']);
                        exit;
						//$this->error($ftjf.'可用积分不足，无法通过申请复投');
					}
					//var_dump($ftky);die();

					$ftdy=floor($ftjf*1.00)*$canshu['beizeng'];
					$data['user_keyongjf']=$ftuser['user_keyongjf']-$ftjf;
					$data['user_daiyongjf']=$ftuser['user_daiyongjf']+$ftdy;
					$data['user_fenxiangjf']=$ftuser['user_fenxiangjf']+$ftjf;
					//复投会员减少可用积分

					$jg=D('User')->where(array('user_login_bh'=>$ftuser['user_login_bh'],'id'=>$ftuser['id']))->data($data)->save();

					if($jg){
						//复投会员积分变化写入积分表
						D('User_jifen')->data(array('user_login_bh'=>$ftuser['user_login_bh'],'jifen_laiyuan'=>'ft','jifen_num'=>$ftjf,'jifen_type'=>1,'jifen_yuanyin'=>4,'jifen_shengyu'=>$data['user_keyongjf'],'jifen_date'=>time()))->add();
                        D('User_jifen')->data(array('user_login_bh'=>$ftuser['user_login_bh'],'jifen_laiyuan'=>'ft','jifen_num'=>$ftdy,'jifen_type'=>2,'jifen_yuanyin'=>1,'jifen_shengyu'=>$data['user_daiyongjf'],'jifen_date'=>time()))->add();
                        D('User_jifen')->data(array('user_login_bh'=>$ftuser['user_login_bh'],'jifen_laiyuan'=>'ft','jifen_num'=>$ftjf,'jifen_type'=>3,'jifen_yuanyin'=>1,'jifen_shengyu'=>$data['user_fenxiangjf'],'jifen_date'=>time()))->add();

                        $arr1['fan_date']=date("Ymd",strtotime("+".$canshu['tianshu']." day"));
						$arr1['bh']=$ftuser['user_login_bh'];
						$arr1['num']=$ftdy;
						//复投会员新增加待用积分写入返还表
						D('Jifenfanhuan')->data($arr1)->add();

						$sjshjl =  M('user')->where('user_login_bh="'.$bh.'"')->find();
						$user_dengji = $sjshjl['user_dengji'];

                         if($user_dengji == 2){
                            $lilv = 0.01;
                        }elseif($user_dengji == 3){
                            $lilv = 0.15;
                        }elseif($user_dengji == 4){
                            $lilv = 0.25;
                        }else{
                            $lilv = 0;
                        }


						$sr=floor($ftjf*$lilv);

						//分公司或服务中心增加收入    2,0.01
                        //上级审核奖励

						$udata['user_keyongjf']=$sjshjl['user_keyongjf']+$sr;
						D('User')->where(array('user_login_bh'=>$sjshjl['user_login_bh'],'id'=>$sjshjl['id']))->data($udata)->save();
						//分公司或服务中心积分变化写入积分表
						D('User_jifen')->data(array('user_login_bh'=>$sjshjl['user_login_bh'],'jifen_laiyuan'=>'复投收入自'.$ftuser['user_login_bh'],'jifen_num'=>$sr,'jifen_type'=>1,'jifen_yuanyin'=>1,'jifen_shengyu'=>$udata['user_keyongjf'],'jifen_date'=>time()))->add();
						if($ftuser['user_sjid2']){
							$quchou=D('gedaiquchou')->select();
							$s2user=D('User')->where(array('user_login_bh'=>$ftuser['user_sjid2']))->find();
							//复投会员上二级直推人数
							if($s2user['user_login_bh'] != 'A800001'){
								$zhitui=D('User')->where(array('user_sjid1'=>$s2user['user_login_bh']))->count();

                           /* if($zhitui>=2 && $zhitui <=3 ){
								$s2fx=floor($ftjf*5/100);
							}elseif($zhitui>=4 && $zhitui <=6 ){
                                $s2fx=floor($ftjf*10/100);
                            }elseif($zhitui>=7){
                                $s2fx=floor($ftjf*15/100);
                            }else{
                                $s2fx = 0;
                            }*/
                                $gedai =  isset($canshu['gedai']) ? $canshu['gedai'] : 0;
                                $s2fx=$ftjf*$gedai;


							//上二分享积分大于隔代收入 user_keyongjf user_agxfq
							if($s2user['user_fenxiangjf']>=$s2fx){
								$s2data['user_fenxiangjf']=$s2user['user_fenxiangjf']-$s2fx;
								$s2data['user_keyongjf']=$s2user['user_keyongjf']+$s2fx;
								//给上二级减分享加可用
								$jg1=D('User')->where(array('id'=>$s2user['id']))->data($s2data)->save();
								//上二积分变化写入积分表
								D('User_jifen')->data(array('user_login_bh'=>$s2user['user_login_bh'],'jifen_laiyuan'=>'隔代'.$ftuser['user_login_bh'],'jifen_num'=>$s2fx,'jifen_type'=>3,'jifen_yuanyin'=>4,'jifen_shengyu'=>$s2data['user_fenxiangjf'],'jifen_date'=>time()))->add();


                                D('User_jifen')->data(array('user_login_bh'=>$s2user['user_login_bh'],'jifen_laiyuan'=>'隔代'.$ftuser['user_login_bh'],'jifen_num'=>$s2fx,'jifen_type'=>1,'jifen_yuanyin'=>1,'jifen_shengyu'=>$s2data['user_keyongjf'],'jifen_date'=>time()))->add();
                            }else{//小于
								if($s2user['user_fenxiangjf']){
									$s2data['user_fenxiangjf']=0;
									$s2data['user_keyongjf']=$s2user['user_keyongjf']+$s2user['user_fenxiangjf'];
									//给上二级减分享加可用
									$jg1=D('User')->where(array('id'=>$s2user['id']))->data($s2data)->save();
									D('User_jifen')->data(array('user_login_bh'=>$s2user['user_login_bh'],'jifen_laiyuan'=>'隔代'.$ftuser['user_login_bh'],'jifen_num'=>$s2user['user_fenxiangjf'],'jifen_type'=>3,'jifen_yuanyin'=>4,'jifen_shengyu'=>$s2data['user_fenxiangjf'],'jifen_date'=>time()))->add();
                                    D('User_jifen')->data(array('user_login_bh'=>$s2user['user_login_bh'],'jifen_laiyuan'=>'隔代'.$ftuser['user_login_bh'],'jifen_num'=>$s2user['user_fenxiangjf'],'jifen_type'=>1,'jifen_yuanyin'=>1,'jifen_shengyu'=>$s2data['user_keyongjf'],'jifen_date'=>time()))->add();
                                }
							}
							}
						}
                        $status = M('Jifenfanhuan_zs')->where('id='.$id)->setField(array('status'=>1,'shenhe_bh'=>$bh));

                        if($status){
                            echo json_encode(['code'=>0,'msg'=>'复投审核通过成功']);
                            exit;
                           // $this->success('复投审核通过成功！', '/u.html');
                        }else{
                            echo json_encode(['code'=>1,'msg'=>'已审核，请勿重复审核！']);
                            exit;
                         //   $this->error('已审核，请勿重复审核！', '/u.html');
                        }

					}
				}
			}else{
                echo json_encode(['code'=>1,'msg'=>'未转入会员']);
                exit;
				//$this->error('未转入会员');
			}
		}
	}

    public function futouzhijie(){
        $canshu=D('qici')->where('pos=1')->find();
        if(session('bh')){
            if (session('bh') != I('post.proid')){
                $this->error('只能本人操作');
            }
            $ftbh=I('post.proid');
            header("Content-Type:text/html;charset=utf-8");
            echo "<script>if(confirm('确认复投吗')==false){window.location.href='/u.html'; break; }</script>";
            $bh=session('bh');

            //var_dump($_POST);
            $baodan=D('User_jifen')->where(array('user_login_bh'=>$ftbh,'jifen_num'=>array('gt',0),'jifen_type'=>1,'jifen_yuanyin'=>1))->count();
            $ftuser=D('User')->where(array('user_login_bh'=>$ftbh))->find();
            if($baodan>0){
                $user=D('User')->where(array('user_login_bh'=>$ftuser['user_sjid2']))->find();
                if(sjjiami('mima',I('post.zfpassword'))!=$ftuser['user_zfpass']){
                    $this->error('支付密码不正确');
                }
                $ftjf=I('post.futou');

                if($ftjf){

                    if($ftuser['user_keyongjf']<$ftjf){
                        $this->error('可用积分不足，无法复投');
                    }
                    //var_dump($ftky);die();
                    $ftdy=floor($ftjf*1.00)*$canshu['beizeng'];
                    $data['user_keyongjf']=$ftuser['user_keyongjf']-$ftjf;
                    $data['user_daiyongjf']=$ftuser['user_daiyongjf']+$ftdy;
                    $data['user_fenxiangjf']=$ftuser['user_fenxiangjf']+$ftjf;
                    //复投会员减少可用积分
                    $jg=D('User')->where(array('user_login_bh'=>$ftuser['user_login_bh'],'id'=>$ftuser['id']))->data($data)->save();
                    if($jg){
                        //复投会员积分变化写入积分表
                        D('User_jifen')->data(array('user_login_bh'=>$ftuser['user_login_bh'],'jifen_laiyuan'=>'ft','jifen_num'=>$ftjf,'jifen_type'=>1,'jifen_yuanyin'=>4,'jifen_shengyu'=>$data['user_keyongjf'],'jifen_date'=>time()))->add();
                        D('User_jifen')->data(array('user_login_bh'=>$ftuser['user_login_bh'],'jifen_laiyuan'=>'ft','jifen_num'=>$ftdy,'jifen_type'=>2,'jifen_yuanyin'=>1,'jifen_shengyu'=>$data['user_daiyongjf'],'jifen_date'=>time()))->add();
                        D('User_jifen')->data(array('user_login_bh'=>$ftuser['user_login_bh'],'jifen_laiyuan'=>'ft','jifen_num'=>$ftjf,'jifen_type'=>3,'jifen_yuanyin'=>1,'jifen_shengyu'=>$data['user_fenxiangjf'],'jifen_date'=>time()))->add();
                        $arr1['fan_date']=date("Ymd",strtotime("+".$canshu['tianshu']." day"));
                        $arr1['bh']=$ftuser['user_login_bh'];
                        $arr1['num']=$ftdy;
                        //复投会员新增加待用积分写入返还表
                        D('Jifenfanhuan')->data($arr1)->add();
                        $sr=floor($ftjf*0.01);
                        //分公司或服务中心增加收入
                        $udata['user_keyongjf']=$user['user_keyongjf']+$sr;
                        D('User')->where(array('user_login_bh'=>$user['user_login_bh'],'id'=>$user['id']))->data($udata)->save();

                        //分公司或服务中心积分变化写入积分表
                        D('User_jifen')->data(array('user_login_bh'=>$user['user_login_bh'],'jifen_laiyuan'=>'复投收入自'.$ftuser['user_login_bh'],'jifen_num'=>$sr,'jifen_type'=>1,'jifen_yuanyin'=>1,'jifen_shengyu'=>$udata['user_keyongjf'],'jifen_date'=>time()))->add();
                        if($ftuser['user_sjid2'] && $ftuser['user_sjid2'] !=0){
                            $quchou=D('gedaiquchou')->select();
                            $s2user=D('User')->where(array('user_login_bh'=>$ftuser['user_sjid2']))->find();
                            //复投会员上二级直推人数
                            $zhitui=D('User')->where(array('user_sjid1'=>$s2user['user_login_bh']))->count();
                            foreach($quchou as $k=>$v){
                                if($zhitui>=$quchou['min'] && $zhitui <=$quchou['max'] ){
                                    $s2fx=floor($ftjf*$quchou['jiangli']/100);
                                }elseif($zhitui>=7){
                                    $s2fx=floor($ftjf*$quchou['jiangli']/100);
                                }else{
                                    $s2fx=0;
                                }

                            }

                            //上二分享积分大于隔代收入
                            if($s2user['user_fenxiangjf']>=$s2fx){
                                $s2data['user_fenxiangjf']=$s2user['user_fenxiangjf']-$s2fx;
                                $s2data['user_keyongjf']=$s2user['user_keyongjf']+$s2fx;
                                //给上二级减分享加可用
                                $jg1=D('User')->where(array('id'=>$s2user['id']))->data($s2data)->save();
                                //上二积分变化写入积分表
                                D('User_jifen')->data(array('user_login_bh'=>$s2user['user_login_bh'],'jifen_laiyuan'=>'隔代'.$ftuser['user_login_bh'],'jifen_num'=>$s2fx,'jifen_type'=>3,'jifen_yuanyin'=>4,'jifen_shengyu'=>$s2data['user_fenxiangjf'],'jifen_date'=>time()))->add();
                                D('User_jifen')->data(array('user_login_bh'=>$s2user['user_login_bh'],'jifen_laiyuan'=>'隔代'.$ftuser['user_login_bh'],'jifen_num'=>$s2fx,'jifen_type'=>1,'jifen_yuanyin'=>1,'jifen_shengyu'=>$s2data['user_keyongjf'],'jifen_date'=>time()))->add();

                            }else{//小于
                                if($s2user['user_fenxiangjf']){
                                    $s2data['user_fenxiangjf']=0;
                                    $s2data['user_keyongjf']=$s2user['user_keyongjf']+$s2user['user_fenxiangjf'];
                                    //给上二级减分享加可用
                                    $jg1=D('User')->where(array('id'=>$s2user['id']))->data($s2data)->save();
                                    D('User_jifen')->data(array('user_login_bh'=>$s2user['user_login_bh'],'jifen_laiyuan'=>'隔代'.$ftuser['user_login_bh'],'jifen_num'=>$s2user['user_fenxiangjf'],'jifen_type'=>3,'jifen_yuanyin'=>4,'jifen_shengyu'=>$s2data['user_fenxiangjf'],'jifen_date'=>time()))->add();
                                    D('User_jifen')->data(array('user_login_bh'=>$s2user['user_login_bh'],'jifen_laiyuan'=>'隔代'.$ftuser['user_login_bh'],'jifen_num'=>$s2user['user_fenxiangjf'],'jifen_type'=>1,'jifen_yuanyin'=>1,'jifen_shengyu'=>$s2data['user_keyongjf'],'jifen_date'=>time()))->add();

                                }
                            }
                        }
                        $this->success('复投成功！', '/u.html');
                    }
                }
            }else{
                $this->error('待用返还未产生可用积分');
            }
        }
    }
}