<?php

namespace Shangcheng\Controller;
use Think\Controller;
use Common\Lib\String; //引入类函数
use Common\Lib\Category; //引入类函数
use Common\Lib\Common; //引入类函数
class GonggaoController extends Controller {
	/**
	 * 公告咨询控制器
	 */
    public function index(){
		$ks=0;
		$num=10;
		if(IS_POST){
			if(I('post.pageIndex')){
				$ks=$num*I('post.pageIndex');
				$fid=I('post.cateid');
				$gg=D('Gonggao')->where(array('is_show'=>1,'fid'=>$fid))->order('id desc')->limit($ks.','.$num)->select();
				if($gg){
					foreach($gg as $k=>$v){
						$content1=htmlspecialchars_decode($v['content']);
						$html.='<li onclick="window.location.href=\'/gd/b/'.$v['id'].'.html\'">
									<i>'.$content1.'</i>
									<span>
										<a href="/gd/b/'.$v['id'].'.html">'.$v['title'].'</a>
									</span>
								</li>';
					}
					echo json_encode(array('code'=>1,'data'=>$html));
					exit;
				}else{
					echo json_encode(array('code'=>2));
					exit;
				}
			}else{
				$html='';
				$fid=I('post.cateid');
				$gg=D('Gonggao')->where(array('is_show'=>1,'fid'=>$fid))->order('id desc')->limit($ks.','.$num)->select();
				if($gg){
					foreach($gg as $k=>$v){
						$content1=htmlspecialchars_decode($v['content']);
						$html.='<li onclick="window.location.href=\'/gd/b/'.$v['id'].'.html\'">
									<i>'.$content1.'</i>
									<span>
										<a href="/gd/b/'.$v['id'].'.html">'.$v['title'].'</a>
									</span>
								</li>';
					}
					echo json_encode(array('data'=>$html));
					exit;
				}else{
					echo json_encode(array('data'=>$html));
					exit;
				}
			}
		}
		$gg=D('Gonggao')->where(array('is_show'=>1,'fid'=>1))->order('id desc')->limit($ks.','.$num)->select();
		foreach($gg as $k=>$v){
			$gg[$k]['content1']=htmlspecialchars_decode($v['content']);
		}
		//var_dump($gg);die();
		$this->assign('gg',$gg);
		if(!session('config')){
			$config=D('Config')->find();
			session('config',$config);
		}else{
			$config=session('config');
		}
		
		$this->assign('config',$config);
		$this->display();
    }
	//详情
	public function detail(){
		if(I('get.b')){
			$id=I('get.b');
			$detail=D('Gonggao')->find($id);
			$detail['content1']=htmlspecialchars_decode($detail['content']);
			$this->assign('dt',$detail);
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