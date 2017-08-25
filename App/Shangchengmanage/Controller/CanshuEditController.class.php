<?php
namespace Shangchengmanage\Controller;
use Think\Controller;
class CanshuEditController extends CommonController {
	/**
	 * 网站配置信息展示
	*/ 
	
   	/**
	 * 编辑页面
	 */
	 
	public function index() {
    $id=I('get.id'); 
	$m=M('qici');
	$updqici = $m->find($id); 
	$this->assign('vlist',$updqici);
	$this->display();
	
    }	 
	 
	 
	 
	 
	public function edit() {
		$id=I('get.id');      
		
		$data = $m->find($id);
		$this->assign('data',$data);
    	$this->display();
	}

	/**
	 * 编辑处理
	 */
	public function do_edit() {
		$pos =  I('post.shezhi');
		$pos=D('qici')->field('pos')->where('pos ='.$pos)->find(); 
					if($pos['pos']){
						$this->error('当前发行期次已存在！',U('CanshuManager/index'));
											}

      $mide=M('qici');
		$data['id']=I('post.id');
		$data['qishu']=I('post.qishu');
		$data['beizeng']=I('post.beizeng');
		$data['tianshu']=I('post.tianshu');
		$data['xiane']=I('post.xiane');
		$data['pos']=I('post.shezhi');
        $data['gedai']=I('post.gedai');
		$count=$mide->where(array('id' => $data['id']))->data($data)->save();
		
		/*var_dump($adminindex->getLastSql());*/
	
		if ($count>0){
			$this->success('修改成功！',U('CanshuManager/index'));
		}
		else {
			$this->error('修改失败！');
		}
	}


	
	
  
}