<?php

namespace Shangchengmanage\Controller;
use Think\Controller;
use Common\Lib\String; //引入类函数
use Common\Lib\Category; //引入类函数
use Common\Lib\Common; //引入类函数
class FutouController extends Controller {


    public function parent($arr,$cat_id){
        $list = array();
        //dump($arr);
        foreach($arr as $k=>$v){

            if($v['user_login_bh'] == $cat_id){

                     $list =  $this->parent($arr,$v['user_sjid1']);
                     $list[] =$v;


            }
        }
        return $list;
    }

    public function get_parent_id($cid='A800001'){
        $db = M('user');
        $pids = array();
        $pa1 = '';
        $parent = $db ->where("user_login_bh = '".$cid."'")->getField('user_sjid1');
        if( $parent != null ||  $parent != '' ||  $parent != 0){
            $pa1.= $parent;
            $npids= $this->get_parent_id($parent);
            if(isset($npids))
                $pa1.= ','.$npids;
        }
        return $pa1;
    }



    public function dengjicheck($m){
        $m = trim($m);
        $user1=M("user")->field('user_dengji')->where('user_login_bh="'.$m.'"')->find();
        return $user1['user_dengji'];
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


   public function futoushenhe(){
        $user = M('user');
        $goods= M('jifenfanhuan_zs');
       
        $Model = M();
        $sql='SELECT a . * FROM  `dq_jifenfanhuan_zs` a,  `dq_user` b WHERE a.bh = b.user_login_bh AND b.user_dengji >=2 ORDER BY a.id DESC';
        $voList = $Model->query($sql);

        $count=count($voList);// 查询满足要求的总记录数
        $Page = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        
        $sql1='SELECT a . * FROM  `dq_jifenfanhuan_zs` a,  `dq_user` b WHERE a.bh = b.user_login_bh AND b.user_dengji >=2 ORDER BY a.id DESC LIMIT '.$Page->firstRow.','.$Page->listRows;
         $puser= $Model->query($sql1);
        //**分页实现代码
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('puser',$puser);
        
        //**分页实现代码
        $this->assign('count',$count);
        $this->display();
    }



    public function futoutongguo(){
        $id = I('get.id');
        $ftdata =  M('jifenfanhuan_zs')->where(array('id'=>$id,'status'=>0))->find();
        if($ftdata['stauts'] == 1){
            $this->error('已审核，请勿重复提交');
            exit();
        }
        $canshu=D('qici')->where('pos=1')->find();

            $ftbh=$ftdata['bh'];
            header("Content-Type:text/html;charset=utf-8");
            $bh=session('bh');

            //var_dump($_POST);
            $baodan=D('User_jifen')->where(array('user_login_bh'=>$ftbh,'jifen_num'=>array('gt',0),'jifen_type'=>1,'jifen_yuanyin'=>1))->count();
            $ftuser=D('User')->where(array('user_login_bh'=>$ftbh))->find();
            $puser=D('User')->where(array('user_login_bh'=>$ftdata['pbh']))->where('user_sjid1 != "A800001" OR user_sjid2 != 0 ')->find();
            $user=D('User')->where(array('user_login_bh'=>$ftdata['ppbh']))->where('user_sjid1 != "A800001" OR user_sjid2 != 0 ')->find();
            // var_dump($ftuser);
            if($baodan>0){

                $ftjf=$ftdata['num'];
                if($ftjf){

                    if($ftuser['user_keyongjf']< $ftjf){

                        $this->error($ftjf.'可用积分不足，无法通过申请复投');

                    }
                    //var_dump($ftky);die();

                    $ftdy=floor($ftjf*1.00)*$canshu['beizeng'];
                    $data['user_keyongjf']=$ftuser['user_keyongjf']-$ftjf;
                    $data['user_daiyongjf']=$ftuser['user_daiyongjf']+$ftdy;
                    $data['user_fenxiangjf']=$ftuser['user_fenxiangjf']+$ftjf;
                    // var_dump($ftuser['user_keyongjf'].'--'.$ftjf);
                    // var_dump($ftuser['user_daiyongjf'].'--'.$ftdy);
                    // var_dump($ftuser['user_fenxiangjf'].'--'.$ftjf);
                    // var_dump($data);
                    // var_dump($ftjf);
                   // var_dump($data);
                    // exit();
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

                        // if($user_dengji == 2){
                        //     $lilv = 0.01;
                        // }elseif($user_dengji == 3){
                        //     $lilv = 0.15;
                        // }elseif($user_dengji == 4){
                        //     $lilv = 0.25;
                        // }else{
                        //     $lilv = 0;
                        // }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               

                        // $sr=floor($ftjf*$lilv);
                        // if($puser && $puser['user_login_bh'] !='A800001'){
                            //分公司或服务中心增加收入    2,0.01
                            //上级审核奖励
                           // $sjshjl =  M('user')->where('user_login_bh="'.$puser['user_login_bh'].'"')->find();
                            // $udata['user_keyongjf']=$puser['user_keyongjf']+$sr;

                            // D('User')->where(array('user_login_bh'=>$puser['user_login_bh'],'id'=>$puser['id']))->data($udata)->save();
                            //分公司或服务中心积分变化写入积分表
                            // D('User_jifen')->data(array('user_login_bh'=>$puser['user_login_bh'],'jifen_laiyuan'=>'复投收入自'.$ftuser['user_login_bh'],'jifen_num'=>$sr,'jifen_type'=>1,'jifen_yuanyin'=>1,'jifen_shengyu'=>$udata['user_keyongjf'],'jifen_date'=>time()))->add();

                        // }

                        if($user){

                            if($ftuser['user_sjid2']){
                                $quchou=D('gedaiquchou')->select();
                                $s2user=D('User')->where(array('user_login_bh'=>$ftuser['user_sjid2']))->find();
                                //复投会员上二级直推人数
                                $zhitui=D('User')->where(array('user_sjid1'=>$s2user['user_login_bh']))->count();


                                if($zhitui>=2 && $zhitui <=3 ){
                                    $s2fx=floor($ftjf*5/100);
                                }elseif($zhitui>=4 && $zhitui <=6 ){
                                    $s2fx=floor($ftjf*10/100);
                                }elseif($zhitui>=7){
                                    $s2fx=floor($ftjf*15/100);
                                }else{
                                    $s2fx = 0;
                                }

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
                            $status = M('Jifenfanhuan_zs')->where('id='.$id)->setField(array('status'=>1,'shenhe_bh'=>'A00001'));

                            if($status){
                                $this->success('复投审核通过成功！', U('Futou/futoushenhe'));
                            }else{
                                $this->error('已审核，请勿重复审核！',  U('Futou/futoushenhe'));
                            }
                    }
                }
            }else{
                $this->error('未转入会员');
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
                            dump($s2fx);
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