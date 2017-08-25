<?php
namespace Shangchengmanage\Controller;
use Think\Controller;
class CanshuController extends CommonController {
	/**
	 * 网站配置信息展示
	 */
    public function index(){
		$canshu=D('qici')->find();
		$this->assign('cs',$qici);
		$this->display();
    }

	/**
	 * 添加
	 */
	public function add() {
		$this->display();
	}
	/**
	 * 添加处理
	*/ 
	public function do_add(){
		$qishu =  I('post.qishu');
		$pos =  I('post.shezhi');
		C('TOKEN_ON',false);
		//var_dump($_POST);die();
 		if(IS_POST){
			  
		$canshu=D('qici')->field('qishu')->where('qishu='.$qishu)->find();
		$pos=D('qici')->field('pos')->where('pos ='.$pos)->find(); 
					if($pos['pos']){
						$this->error('当前发行期次已存在！');
						exit();
					}
		
					if($canshu['qishu']==I('post.qishu')){
						$this->error('您添加的期数已存在！');
						exit();
					}
					
				
					$m=M('qici');
					$data['qishu']=I('post.qishu');
					$data['beizeng']=I('post.beizeng');
					$data['tianshu']=I('post.tianshu');
					$data['xiane']=I('post.xiane');
                    $data['gedai']=I('post.gedai');

					if(I('post.shezhi')==1){
					$result = $m->where('pos!=0')->setField('pos','0');
					}
					$data['pos']=I('post.shezhi');
					$count=$m->add($data);
					if ($count>0){
						$this->success('添加成功！',U('CanshuManager/index'));
					}else {
						$this->error('添加失败!');
					}
				
		   }
	 }
 

}