<?php

namespace Shangchengmanage\Controller;
use Think\Controller;
use Common\Lib\Category; //引入类函数
class BannerController extends CommonController {
	/**
	 * 显示首页轮播
	 */
	public function index() {
    	$m=D('Column');
    	$arr=$m->where("column_link=0 AND f_id=0 and column_type=1")->order('column_sort')->select();
    	//**分页实现代码
    	$count = count($arr);// 查询满足要求的总记录数
    	$Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
    	$show = $Page->show();// 分页显示输出
    	//**分页实现代码
    	$arr=$m->where("column_link=0 AND f_id=0 and column_type=1")->order('column_sort')->limit($Page->firstRow.','.$Page->listRows)->select();
//     	dump($arr);
//     	exit;
    	foreach($arr as $k2 => $v2){
    		$arr[$k2]['column_imgsize'] = get_byte($v2['column_imgsize']);
    	}
    	$this->assign('page',$show);// 赋值分页输出
    	$this->assign('vlist',$arr);
    	$this->assign('count',$count);
        $this->display();
	}
	/**
	 * 显示首页图片
	 */
	public function tupian() {
    	$m=D('Column');
    	$arr=$m->where("column_link=0 AND f_id=0 and column_type>1")->order('column_sort')->select();
		//var_dump($arr);die();
    	//**分页实现代码
    	$count = count($arr);// 查询满足要求的总记录数
    	$Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
    	$show = $Page->show();// 分页显示输出
    	//**分页实现代码
    	$arr=$m->where("column_link=0 AND f_id=0 and column_type>1")->order('column_sort')->limit($Page->firstRow.','.$Page->listRows)->select();
//     	dump($arr);
//     	exit;
    	foreach($arr as $k2 => $v2){
    		$arr[$k2]['column_imgsize'] = get_byte($v2['column_imgsize']);
    	}
    	$this->assign('page',$show);// 赋值分页输出
    	$this->assign('vlist',$arr);
    	$this->assign('count',$count);
        $this->display();
	}
	
	/**
	 * 新增首页轮播
	 */
	public function add(){
		$this->display();
	}
	/**
	 * 新增首页图片
	 */
	public function tpadd(){
		$this->display();
	}
	/**
	 * 处理栏目添加
	 */
	public function do_add() {
    	//dump($_POST);exit;
		$m=M('Column'); //先读取News数据库表模型文件
		if (!$m->create()){
			$this->error($m->geterror());
		}
		//处理图片文件上传
    	$file=$_FILES['column_images']['name'];
     	//var_dump($file);die();
    	if (!empty($file)) {
    		//如果有文件上传 上传附件
	    	$upload = new \Think\Upload();// 实例化上传类
	    	$upload->maxSize 	= 3145728;// 设置附件上传大小
	    	$upload->exts    	= array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
	    	$upload->savePath	= './Uploads/';// 设置附件上传根目录
	    	$upload->savePath  	=  '/Tmp/'; // 网站主栏目图片 设置附件上传（子）目录  缩略图
	    	$upload->autoSub 	= true;
	    	$upload->subName 	= array('date','Ymd');
	    	$upload->saveName = array('uniqid','');//设置上传文件规则
	    	$info = $upload->upload();
	    	if (!$info) {
	    		//捕获上传异常
	    		$this->error($upload->getErrorMsg());
	    	} else {
	    		foreach($info as $file){
	    			$image = '/'.'Uploads'.$file['savepath'].$file['savename'];
					$size = $file['size'];
	    		}
	    	}
			$data['column_images']=$image;
			$data['column_imgsize']=$size;
		}
		$data['column_name']=I('post.column_name');
		$data['column_show']=I('post.column_show');
		$data['column_sort']=I('post.column_sort');
		$data['column_type']=I('post.column_type');
		$data['column_addtime']=time();
		//var_dump($data);die();
		$arr=$m->data($data)->add(); //自动修改 不需要定义id 因为post表单中已经有
		if ($arr){
			if($data['column_type']>1){
				$this->success('添加成功',U('Banner/tupian'));
			}else{
				$this->success('添加成功',U('Banner/index'));
			}
		}else {
			$this->error('添加失败');
		}
	}
	
	/**
	 * 处理轮播广告添加
	 */
	public function upload() {
// 		dump($_POST);
// 		exit;
		$file=$_FILES;
		$file=$file['column_images'];
		$file=$file['name'];
// 		dump($file);
// 		exit;
		if (empty($file)){
			$this->error('请先选择上传图片');
		}
		if (!empty($_FILES)) {
			$id=I('post.id');
			$m=M('Column');
			$arr=$m->find($id);
// 			dump($arr);
// 			exit;
			if (!$arr['column_images']==null){
				//删除本地图片附件 unlink('图片url')
				unlink('./Uploads/'.$arr["column_images"]);
			}
			//如果有文件上传 上传附件
			$this->_upload();
		}
	}
	
	/**
	 * 文件上传
	 */ 
	protected function _upload() {
		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize 	= 3145728;// 设置附件上传大小
		$upload->exts    	= array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->savePath	= './Uploads/';// 设置附件上传根目录
		$upload->savePath  	=  '/Img/'; // 网站主栏目图片 设置附件上传（子）目录
		$upload->autoSub 	= true;
		$upload->subName 	= array('date','Ymd');
		$upload->saveName = array('uniqid','');//设置上传文件规则
		$info = $upload->upload();
		
		//$upload->thumbRemoveOrigin  = true;//删除原图
		if (!$info) {
			//捕获上传异常
			$this->error($upload->getErrorMsg());
		} else {
			//取得成功上传的文件信息
			//给m_缩略图添加水印, Image::water('原文件名','水印图片地址')
			//Image::water($uploadList[0]['savepath'] . 'm_' . $uploadList[0]['savename'], APP_PATH.'Tpl/Public/Images/logo.png');
			//dump($uploadList[0]);
			//exit;
		
			foreach($info as $file){
				$image = $file['savepath'].$file['savename'];
				$size = $file['size'];
			}
		}
		
		$id=I('post.id');
		//**获取栏目的下级所有子栏目
		$m=D('Column')->select();
		$m=Category::getChilds($m,$id); //获取id所有的下级栏目的信息
		//将二维数组变成一维数组
		foreach ($m as $value){
			$data[]=$value['id'];
		}
		$data[]=$id;
		//dump($data);
		//exit;
		
		$m=D('Column'); //数据库表，配置文件中定义了表前缀，这里则不需要写
		//判断id是数组还是一个数值
		if(is_array($data)){
			$where = 'id in('.implode(',',$data).')';
			//implode() 函数返回一个由数组元素组合成的字符串
		}else{
			$where = 'id='.$data;
		}
		//dump($where);
		//exit;
		$date['column_show']=1;
		$date['column_images']=$image;
		$date['column_imgsize']=$size;
		$count=$m->where($where)->save($date); //修改表单用save函数
		if ($count>0){
			$this->success('上传图片成功！',U('Banner/index'));
		}
		else {
			$this->error('上传图片失败!');
			//$this->error($m->geterror());
		}
	}
	
	
	/**
	 * 显示首页轮播广告
	 */
	public function do_advert() {
		$m=D('Advert');
    	//**分页实现代码
    	$count=$m->count();// 查询满足要求的总记录数
    	$Page = new \Think\Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数(25)
    	$show = $Page->show();// 分页显示输出
    	//**分页实现代码
	
		$arr=$m->order('user_rsdate')->limit($Page->firstRow.','.$Page->listRows)->select();
		//dump($arr);
		//exit;
	
		//**分页实现代码
		$this->assign('page',$show);// 赋值分页输出
		//**分页实现代码
		$this->assign('vlist',$arr);
		$this->display();
	}


	/**
	 * 显示栏目广告修改页面
	 */
	public function edit() {
		$id=I('get.id');
		//dump($id);
		//exit;
    	$m=D('Column');
    	$arr=$m->find($id);
    	//dump($arr);exit;

    	$this->assign('v',$arr);
    	$this->display();
	}
	/**
	 * 图片修改页面
	 */
	public function tpedit() {
		$id=I('get.id');
		//dump($id);
		//exit;
    	$m=D('Column');
    	$arr=$m->find($id);
    	//dump($arr);exit;

    	$this->assign('v',$arr);
    	$this->display();
	}
	/**
	 * 处理栏目添加
	 */
	public function do_edit() {
    	//dump($_POST);exit;
		$m=M('Column'); //先读取News数据库表模型文件
		
		//处理图片文件上传
    	$file=$_FILES['column_images']['name'];
     	//var_dump($file);die();
    	if (!empty($file)) {
    		//如果有文件上传 上传附件
	    	$upload = new \Think\Upload();// 实例化上传类
	    	$upload->maxSize 	= 3145728;// 设置附件上传大小
	    	$upload->exts    	= array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
	    	$upload->savePath	= './Uploads/';// 设置附件上传根目录
	    	$upload->savePath  	=  '/Tmp/'; // 网站主栏目图片 设置附件上传（子）目录  缩略图
	    	$upload->autoSub 	= true;
	    	$upload->subName 	= array('date','Ymd');
	    	$upload->saveName = array('uniqid','');//设置上传文件规则
	    	$info = $upload->upload();
	    	if (!$info) {
	    		//捕获上传异常
	    		$this->error($upload->getErrorMsg());
	    	} else {
	    		foreach($info as $file){
	    			$image = '/'.'Uploads'.$file['savepath'].$file['savename'];
					$size = $file['size'];
	    		}
	    	}
			$data['column_images']=$image;
			$data['column_imgsize']=$size;
		}
		$map['id']=I('post.id');
		$data['column_name']=I('post.column_name');
		$data['column_show']=I('post.column_show');
		$data['column_sort']=I('post.column_sort');
		$data['column_type']=I('post.column_type');
		$data['column_addtime']=time();
		//var_dump($data);die();
		$arr=$m->where($map)->data($data)->save(); //自动修改 不需要定义id 因为post表单中已经有
		if ($arr){
			if($data['column_type']>1){
				$this->success('修改成功',U('Banner/tupian'));
			}else{
				$this->success('修改成功',U('Banner/index'));
			}
		}else {
			$this->error('修改失败');
		}
	}

	//开启关闭栏目广告处理
	public function ifedit() {
		$id=I('get.id');
		//dump($id);
		$m=M('Column');
		$arr=$m->find($id);
		//dump($arr);
		//exit;
		
		if ($arr['column_show']==1){
			$id=I('get.id');
			//**获取栏目的下级所有子栏目
			$m=D('Column')->select();
			$m=Category::getChilds($m,$id); //获取id所有的下级栏目的信息
			//将二维数组变成一维数组
			foreach ($m as $value){
				$data[]=$value['id'];
			}
			$data[]=$id;
			//dump($data);
			//exit;
				
			$m=D('Column'); //数据库表，配置文件中定义了表前缀，这里则不需要写
			//判断id是数组还是一个数值
			if(is_array($data)){
				$where = 'id in('.implode(',',$data).')';
				//implode() 函数返回一个由数组元素组合成的字符串
			}else{
				$where = 'id='.$data;
			}
			//dump($where);
			//exit;
			$date['column_show']=0;
			$count=$m->where($where)->save($date); //修改表单用save函数
			if ($count>0){
				$this->success('关闭成功！');
			}
			else {
				$this->error('关闭失败！');
			}
			 
		}else {
			$id=I('get.id');
			//**获取栏目的下级所有子栏目
			$m=D('Column')->select();
			$m=Category::getChilds($m,$id); //获取id所有的下级栏目的信息
			//将二维数组变成一维数组
			foreach ($m as $value){
				$data[]=$value['id'];
			}
			$data[]=$id;
			//dump($data);
			//exit;
				
			$m=D('Column'); //数据库表，配置文件中定义了表前缀，这里则不需要写
			//判断id是数组还是一个数值
			if(is_array($data)){
				$where = 'id in('.implode(',',$data).')';
				//implode() 函数返回一个由数组元素组合成的字符串
			}else{
				$where = 'id='.$data;
			}
			//dump($where);
			//exit;
			$date['column_show']=1;
			$count=$m->where($where)->save($date); //修改表单用save函数
			if ($count>0){
				$this->success('开启成功！');
			}
			else {
				$this->error('开启失败！');
			}
		}

	}
	public function del(){
		//**判断是否有限权，显示登录管理员信息
    	$id=$_SESSION['id'];
    	$m=D('Admin');
    	$arr=$m->find($id);
    	$arr=$arr['admin_type'];
    	if ($arr==1){// 如果不是超级管理员限权
    		$this->error('你不是超级管理员，没有限权！');
    	}
    	$m=M('Column');
    	$id=I('get.id');
    	$count=$m->delete($id);
    	if ($count>0){
    		$this->success('删除成功');
    	}
    	else {
    		$this->error('删除失败');
    	}
	}

}

?>