<?php
namespace Shangchengmanage\Controller;
use Think\Controller;
class OnlinePayController extends CommonController {
	/**
	 * 显示后台管理首页
	 */
    public function index(){
        $pageSize = 15;
        if($_GET['sousuo']){
            /*$data['kaihuren']=array('like', '%'.$_GET['keyword'].'%');
            $data['ss_type']=1;
            $total=M('Tixian')->where($data)->count();*/
        }else{
            $total = M('online_chongzhi')->count();
        }
        $page = new \Think\Page($total,$pageSize);
        $show = $page->show();
        if($_GET['sousuo']){
           /* $data['kaihuren']=array('like', '%'.$_GET['keyword'].'%');
            $data['ss_type']=1;
            $total=M('Tixian')->where($data)->count();*/
        }else{
           // $total = M('Tixian')->where('ss_type=1')->count();
        }
        if($_GET['sousuo']){
//            $data['kaihuren']=array('like', '%'.$_GET['keyword'].'%');
//            $data['ss_type']=1;
//            $result = M('Tixian')->limit($page->firstRow,$page->listRows)->where($data)->order('sq_date desc ')->select();
        }else{
            $result = M('online_chongzhi')->limit($page->firstRow,$page->listRows)->order('create_time desc ')->select();

        }
        foreach ($result as $k=>$row_){
          //  dump($row_);exit;
            $user_name = M('User')->where(array('user_login_bh'=>array('eq',$row_['user_bh'])))->field('user_name')->find();
            $result[$k]['true_name'] = $user_name['user_name'];
        }
        $count=M('online_chongzhi')->count();
       // dump($result);
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $this->assign('result',$result);
        $this->assign('show',$show);
        $this->assign('count',$count);
        //分页结束
    	$this->display();
    }
    /**
     * 显示后台右边页面
     */
    public function right(){

    }
}