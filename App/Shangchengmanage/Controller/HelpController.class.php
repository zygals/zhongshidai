<?php

namespace Shangchengmanage\Controller;
use Think\Controller;
use Common\Lib\Common; //引入类函数
use Common\Lib\String; //引入类函数
use Think\Upload;
use Think\Image;
class HelpController extends CommonController {
	/**
	 * 公告管理
	 */
	public function index() {
		$m=M('Help');
    	//**分页实现代码
    	$count=$m->count();// 查询满足要求的总记录数
    	$Page = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
    	$show = $Page->show();// 分页显示输出
    	//**分页实现代码

		$arr=$m->limit($Page->firstRow.','.$Page->listRows)->order('id desc')->select();

		//**分页实现代码
		$this->assign('page',$show);// 赋值分页输出
		//**分页实现代码
		$this->assign('vlist',$arr);
		$this->assign('count',$count);
		$this->display();
		
	}
	/**
	 * 分类编辑页面
	 */
	public function edit() {
		$id=I('get.id');
		$m=M('Help');
		$data = $m->find($id);
		$data['img']=substr($data['img'],1,strlen($data['img']));
		$fenlei=D('Helpcate')->where(array('is_show'=>1))->order('paixu asc')->select();
		$this->assign('fl',$fenlei);
		$this->assign('data',$data);
    	$this->display();
	}

	/**
	 * 分类编辑处理
	 */
	public function do_edit() {

		$ids=I('post.id');
		$title=I('post.title');
		if(trim($title) == ''){
			$this->error('标题不能为空!');
		}
		$select = M('Help')->field('title')->where('id <> '.$ids)->select();
		$a  = array();
		foreach($select as $k=>$v){
			foreach($v as $vv){
				$a[] = $vv;
			}
		}
		$result = in_array($title,$a);
		if($result){
			$this->error('标题已存在!');
		}
		//是否上传图片
		if($_FILES['img']['name']){
			$upload = new \Think\Upload();// 实例化上传类
			$upload->maxSize 	= 3145728;// 设置附件上传大小
			$upload->exts    	= array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->savePath	= './Uploads/';// 设置附件上传根目录
			$upload->savePath  	=  '/Images/'; // 设置附件上传（子）目录
			$upload->autoSub 	= true;
			$upload->subName 	= array('date','Ymd');
			$upload->saveName = array('uniqid','');//设置上传文件规则

			$info = $upload->upload();//var_dump($info);die();
			//die("ddd");
			if (!$info) {
				//捕获上传异常
				$this->error($upload->getErrorMsg());
			} else {
				foreach($info as $file){
					$file_image = './Uploads'.$file['savepath'].$file['savename'];
					$file_mini='./Uploads'.$file['savepath'].'mini/'.$file['savename'];
					$file_path='./Uploads'.$file['savepath'].'mini/';
					if (!is_dir($file_path)) {mkdir($file_path,0777);}
					//var_dump($file_mini);
					$img=new \Think\Image();
					$img->open($file_image);
					$img->thumb(300,240)->save($file_mini);

				}
			}unlink($file_image);

		}




		$id = $_POST['id'];
		$data['is_show']=I('post.is_show');
		$data['fid']=I('post.fid');
		$data['title']=I('post.title');
		if(I('post.content')){$data['content']=I('post.content');}
		$data['paixu']=I('post.paixu');
		if($file_mini){$data['img']=$file_mini;}
		$data['date']=time();
		$count=M('Help')->where(array('id' => $id))->data($data)->save();
		if ($count>0){
			$this->success('修改成功！',U('Help/index'));
		}else {
			$this->error('修改失败！');
		}
	}

	/**
	 * 添加商品
	 */
	public function add() {
		$mc=M('Helpcate')->where('types =1 AND is_show=1')->select();
		$this->assign('fl',$mc);
		$this->display();
	}
	
	public function do_add(){
		C('TOKEN_ON',false);
 		if(IS_POST){//var_dump($_POST);die();
			$m=M('Help');
			$title = I('post.title');
			if(trim($title) == ''){
				$this->error('标题不能为空!');
			}
			if(trim($_FILES['img']['name']) == ''){
				$this->error('请上传图标!');
			}
			$id = $m->field('id')->where('title like "%'.$title.'%"')->find();
			if($id){
				$this->error('标题已存在!');
			}
			//是否上传图片
			if($_FILES['img']['name']){
				$upload = new \Think\Upload();// 实例化上传类
				$upload->maxSize 	= 3145728;// 设置附件上传大小
				$upload->exts    	= array('jpg', 'gif', 'png', 'jpeg'); // 设置附件上传类型
				$upload->savePath	= './Uploads/'; // 设置附件上传根目录
				$upload->savePath  	=  '/Images/'; // 设置附件上传（子）目录
				$upload->autoSub 	= true;
				$upload->subName 	= array('date','Ymd');
				$upload->saveName = array('uniqid',''); //设置上传文件规则

				$info = $upload->upload();//var_dump($info);die();
				//die("ddd");
				if (!$info) {
					//捕获上传异常
					$this->error($upload->getErrorMsg());
				} else {
					foreach($info as $file){
						$file_image = './Uploads'.$file['savepath'].$file['savename'];
						$file_mini='./Uploads'.$file['savepath'].'mini/'.$file['savename'];
						$file_path='./Uploads'.$file['savepath'].'mini/';
						if (!is_dir($file_path)) {mkdir($file_path,0777);}
						//var_dump($file_mini);
						$img=new \Think\Image();
						$img->open($file_image);
						$img->thumb(100,100)->save($file_mini);

					}
				}unlink($file_image);

			}



			$data['fid']=I('post.fid');
			$data['title']=I('post.title');
			if($file_mini){$data['img']=$file_mini;};
			$data['is_show']=I('post.is_show');
			$data['paixu']=I('post.paixu');
			$data['content']=I('post.content');
			$data['date']=time();

			//var_dump($data);die();
			$count=$m->add($data); //修改表单用save函数
			if ($count>0){
				$this->success('添加成功！',U('Help/index'));
			}else {
				$this->error('添加失败!');
			}
		}
	}
	
	/**
	 * 删除分类
	 */
	public function del() {//die(I('get.id'));
		$id=I('get.id');
		
		$m=M('Help');
		$arr=$m->find($id);
		//删除本地图片附件 unlink('图片url')
		unlink($arr["image"]);
		
		$count=$m->delete($id);
		if ($count>0){
			$this->success('删除成功！');
		}
		else {
			$this->error('删除失败！');
		}

	}



}

?>