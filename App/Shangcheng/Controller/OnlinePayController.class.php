<?php

namespace Shangcheng\Controller;

use Qcloud\Sms\SmsSingleSender;
use Think\Controller;
use Common\Lib\String; //引入类函数
use Common\Lib\Category; //引入类函数
use Common\Lib\Common; //引入类函数
class OnlinePayController extends Controller
{
    /**
     * 充值首页
     */
    public function index()
    {
        if(session('bh')){
            $bh=session('bh');

            $result=D('User')->where('user_login_bh="'.$bh.'"')->select();
            $this->assign('result',$result);
            $id=$result[0]['id'];
            $trade_no = time().mt_rand(10,10000).'-'.$bh;
            $this->assign('trade_no',$trade_no);
          //  echo $trade_no;
            //充值记录
            	$tixian=M('OnlineChongzhi');
                $list_jilu=$tixian->where(array('user_bh'=>$bh))->order('create_time desc')->select();
              //  dump(session());
                $this->assign('list_jilu',$list_jilu);
                $config=session('config');
                $this->assign('config',$config);
                $url = "/alipay/pagepay/pagepay.php";
                if(ismobile1()){
                    $url ="/alipay_mobile/wappay/pay.php";
                }
                //dump($url);
                $this->assign('url',$url);
                 $this->display();
        }


    }
}
