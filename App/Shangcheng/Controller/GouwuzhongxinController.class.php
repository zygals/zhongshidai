<?php

namespace Shangcheng\Controller;
use Think\Controller;
use Common\Lib\String; //引入类函数
use Common\Lib\Category; //引入类函数
use Common\Lib\Common; //引入类函数
class GouwuzhongxinController extends Controller {
	/**
	 * 购物中心控制器
	 */
    public function index(){
		$fenlei=D('Goodsfenlei')->where(array('is_show'=>1))->order('paixu asc')->select();
		$this->assign('fl',$fenlei);
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
	 * 分类
	 */
    public function product(){
		$ks=0;
		$num=20;
		if(IS_POST){
			if(I('post.pageIndex')){
				$fid=I('post.fid');
				if(I('post.tj')==1){
					$order='click desc';
				}elseif(I('post.tj')==2){
					$order='jifen asc';
				}else{
					$order='xiaoshou desc';
				}
				$ks=$num*I('post.pageIndex');
				if($fid==0){
                    $goods=D('Goods')->field('id,name,jifen,pic,xianjing')->where(array('is_show'=>1))->order($order)->limit($ks.','.$num)->select();
                }else{

                    $goods=D('Goods')->field('id,name,jifen,pic,xianjing')->where(array('fid'=>$fid,'is_show'=>1))->order($order)->limit($ks.','.$num)->select();
                }
				if($goods){
					foreach($goods as $gk=>$gv){
						$pic=substr($gv['pic'],1,strlen($gv['pic']));
						$html.='
						   <li style="margin-bottom: 10px;">
							<a href="/d/b/'.$gv['id'].'.html">
								<div class="dummy">
									<p class="tiao-1">
                                    <h5 style="text-align:center; margin:auto; color:#666;">'.$gv['name'].'</h5>
										<img style= "width: 100%;" src="'.$pic.'" alt="">
									</p>
								</div>
							</a>
								<p class="dinggou" style="text-overflow: ellipsis; white-space: nowrap">￥'.$gv['xianjing'].'</font>+'.$gv['jifen'].'积分</p>
							
						</li>';
					}
					echo json_encode(array('code'=>1,'data'=>$html));
					exit;
				}else{
					echo json_encode(array('code'=>2));
					exit;
				}
			}else{
				$fid=I('post.fid');
				if(I('post.tj')==1){
					$order='click desc';
				}elseif(I('post.tj')==2){
					$order='jifen asc';
				}else{
					$order='xiaoshou desc';
				}
				$goods=D('Goods')->field('id,name,jifen,pic,xianjing')->where(array('fid'=>$fid,'is_show'=>1))->order($order)->limit($ks.','.$num)->select();
				if($goods){
					foreach($goods as $gk=>$gv){
						$pic=substr($gv['pic'],1,strlen($gv['pic']));
						$html.='<li style="margin-bottom: 10px;">
							<a href="/d/b/'.$gv['id'].'.html">
								<div class="dummy">
									<p class="tiao-1">
                                    <h5 style="text-align:center; margin:auto; color:#666;">'.$gv['name'].'</h5>
										<img style= "width: 100%;" src="'.$pic.'" alt="">
									</p>
								</div>
							</a>
								<p class="dinggou" style="text-overflow: ellipsis; white-space: nowrap">￥'.$gv['xianjing'].'</font>+'.$gv['jifen'].'积分</p>
							
						</li>';
					}
					echo json_encode(array('code'=>1,'data'=>$html));
					exit;
				}else{
					echo json_encode(array('code'=>2));
					exit;
				}
			}
		}
		if(I('get.f')){
			$id=I('get.f');
			if($id>0){
				$fl=D('Goodsfenlei')->find($id);
				$this->assign('fl',$fl);
				$goods=D('Goods')->field('id,name,jifen,pic,xianjing')->where(array('fid'=>$id,'is_show'=>1))->order('click desc')->limit($ks.','.$num)->select();
				foreach($goods as $gk=>$gv){
					$goods[$gk]['pic']=substr($gv['pic'],1,strlen($gv['pic']));
				}
				//$this->assign('gd',$goods);
			}
			//所有产品
			if($id=='all'){
                $fl=['id'=>0];
                $this->assign('fl',$fl);
                $goods=D('Goods')->field('id,name,jifen,pic,xianjing')->order('click desc')->limit($ks.','.$num)->select();
                foreach($goods as $gk=>$gv){
                    $goods[$gk]['pic']=substr($gv['pic'],1,strlen($gv['pic']));
                }
            }
            $this->assign('gd',$goods);
		}
		if(I('get.w')){
			$word=I('get.w');
			$goods=D('Goods')->field('id,name,jifen,pic')->where(array('name'=>array("like","$word%"),'is_show'=>1))->order('click desc')->limit($ks.','.$num)->select();
			foreach($goods as $gk=>$gv){
				$goods[$gk]['pic']=substr($gv['pic'],1,strlen($gv['pic']));
			}
			$this->assign('gd',$goods);
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
	
}