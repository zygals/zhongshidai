<?php

namespace Shangchengmanage\Controller;
use Think\Controller;
use Common\Lib\Common; //引入类函数
use Common\Lib\String; //引入类函数
use Think\Upload;
use Think\Image;
class GoodsController extends CommonController {
	/**
	 * 管理
	 */
	public function index() {
		
		  $pgg= isset($_GET['p']) ? $_GET['p'] : 1;
        $_SESSION['pgg'] =$pgg ;

		$fl=D('Goodsfenlei')->where(array('is_show'=>1,'fid'=>0))->order('id asc')->select();
		//$fl2 = D('Goodsfenlei')->where(array('is_show'=>1,'fid'=>$fl[0]['id']))->order('id asc')->select();
		$this->assign('fl',$fl);//所有一级
		//$this->assign('fl2',$fl2);//默认第一个一级下的二级

		$m=M('Goods');
    	//**分页实现代码
    	$count=$m->count();// 查询满足要求的总记录数
		$Page = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
    	//var_dump($page);
		$show = $Page->show();// 分页显示输出
		//var_dump($show);
    	//**分页实现代码
		$fenlei=D('Goodsfenlei')->where(array('is_show'=>1))->order('paixu asc')->select();
		$arr=$m->limit($Page->firstRow.','.$Page->listRows)->order('id desc')->select();
		foreach($arr as $k=>$v){
			foreach($fenlei as $fk=>$fv){
				if($v['fid']==$fv['id']){
                    $arr[$k]['fenlei'] = M('Goodsfenlei')->where(['id'=>$v['fid']])->getField('name');//一级分类名称
					//zyg $arr[$k]['fenlei']= $fname1.'-'.$fv['name'];
					break;
				}
			}
		}
    //   dump($arr);
		//**分页实现代码
		$this->assign('page',$show);// 赋值分页输出 
		//**分页实现代码
		$this->assign('vlist',$arr);
		$this->assign('count',$count);
		$this->display();
		
	}
	
	
	public function delpic($id=0,$picurl=''){
            $model = M('Goods');
            $picArr = $model->where('id='.$id)->getField('pic_arr');
            $picArr =  explode('|',$picArr);
            $picurl= '.'.pack('H*',$picurl);
            $key = array_search($picurl,$picArr,false);
            unset($picArr[$key]);
            $picArr = implode('|',$picArr);
            $model->where('id='.$id)->data('pic_arr='.$picArr)->save();
            $this->success('删除操作成功！',U('Goods/edit',array('id'=>$id)));
        }

	
	/**
	 * 编辑页面
	 */
	public function edit() {
		$id=I('get.id');
		$m=M('Goods');
		$data = $m->find($id);
		
		$data['pic']=substr($data['pic'],1,strlen($data['pic']));
		
		$pics= array_filter(explode("|", $data['pic_arr']));
		
		foreach($pics as $f=>$v){
			
			$pics2[]=substr($v,1,strlen($v));
			
			}
			
		$fenlei=D('Goodsfenlei')->where(array('is_show'=>1,'fid'=>0))->order('paixu asc')->select();
        $row_fenlei=D('Goodsfenlei')->where(array('is_show'=>1,'id'=>$data['fid']))->order('paixu asc')->find();//所属分类
       //zyg $fenlei2 =D('Goodsfenlei')->where(array('is_show'=>1,'fid'=>$row_fenlei['fid']))->order('paixu asc')->select();//二级分类
        $data['fid1'] =  $row_fenlei['fid'] ;//一级
        //dump($fenlei2);
		$this->assign('fl',$fenlei);
		//zyg $this->assign('fl2',$fenlei2);
		$this->assign('data',$data);
		$this->assign('pics',$pics2);
    	$this->display();
	}

	/**
	 * 分类编辑处理
	 */
	public function do_edit() {
		//import("ORG.Util.Image");
		$id = $_POST['id'];
		//var_dump($id);die();
		
		//是否上传图片
		if($_FILES['pic']['name']){
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
		
		$model = D('Goods');
        $picArr = $model->where('id='.$id )->select();
		
       
        if($this->isUploadImages($_FILES['pic_arr']['tmp_name'])){
            $oldPicArr =$model->where('id='.$id)->getField('pic_arr');
            $_POST['pic_arr'] = $this->uploadArrImg($path='Images',$tb='pic_arr',$w=434,$h=357,$oldPicArr);
        }
		
		
		/* if($this->isUploadImages($_FILES['pic_arr']['tmp_name'])){
                $_POST['pic_arr'] = $this->uploadArrImg($path='Images',$tb='pic_arr',$w=434,$h=357);
          

				
			}*/
		if(I('post.is_show')){$data['is_show']=I('post.is_show');}
		if(I('post.fid')){$data['fid']=I('post.fid');}
		if(I('post.name')){$data['name']=I('post.name');}
		if(I('post.tjr_bh')){$data['tjr_bh']=I('post.tjr_bh');}
		if(I('post.xianjing')>=0){$data['xianjing']=I('post.xianjing');}
		if(I('post.xf_fl')){$data['xf_fl']=I('post.xf_fl');}
		if(I('post.index_post')){$data['index_post']=I('post.index_post');}
		if(I('post.xgnum')){$data['xgnum']=I('post.xgnum');}
		if(I('post.xtyuliu')){$data['xtyuliu']=I('post.xtyuliu');}
		if(I('post.yunfei')){$data['yunfei']=I('post.yunfei');}
		if(I('post.user_jibie')){$data['user_jibie']=I('post.user_jibie');}
		if(I('post.jifen')>=0){$data['jifen']=I('post.jifen');}
        if(I('post.agxfq')>=0){$data['agxfq']=I('post.agxfq');}
		//if(I('post.only_jifen')){$data['only_jifen']=I('post.only_jifen');}
		if(I('post.jiangli')>=0){$data['jiangli']=I('post.jiangli');}
		if(I('post.guige')){$data['guige']=I('post.guige');}
		if(I('post.kucun')>=0){$data['kucun']=I('post.kucun');}
		if($file_mini){$data['pic']=$file_mini;}
		if($_POST['pic_arr']){$data['pic_arr']=$_POST['pic_arr'];}
		if($file_mini2){$data['pic2']=$file_mini2;}
		//if($image2){$data['image2']=$image2;}
		if(I('post.content')){$data['content']=I('post.content');}
		if(I('post.paixu')>=0){$data['paixu']=I('post.paixu');}
		if($data){
			if(session('admin_name')){
				$data['user']=session('admin_name');
			}
			$data['date']=time();
			$count=M('Goods')->where(array('id' => $id))->data($data)->save();
		}
		if ($count>0){
			$this->success('修改成功！',U('Goods/index/',array('p'=>session('pgg'))));
		}
		else {
			$this->error('修改失败！');
		}
	}


public function uploadArrImg($path='article',$tb='uploadfiles',$w=150,$h=150,$oldPicArr=''){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		//$upload->autoSub 	= true;
        $upload->rootPath  =     './Uploads';// 设置附件上传根目录
        $upload->savePath  =     ''.$path.'/'; // 设置附件上传（子）目录
        $upload->savename =time();
		$upload->saveName   =    array('uniqid','');
        // 上传单个文件

        foreach($_FILES as $key=>$vo){
            $info   =   $upload->upload(array("$key" => $vo));
        }
        if(!$info) {// 上传错误提示错误信
            $this->error($upload->getError());

        }else {// 上传成功 获取上传文件信息

            $arr = array();
            foreach ($info as $k => $v) {
                $image = new \Think\Image();
                $image->open($upload->rootPath . $v['savepath'] . $v['savename']);//
                $image->thumb($w, $h, \Think\Image::IMAGE_THUMB_CENTER)->save('./' . $upload->rootPath . $v['savepath'] . $v['savename']);
                $arr[] ='./' .$upload->rootPath . $v['savepath'] . $v['savename'];//数据库路径
            }
            $oldPicArr = explode('|',$oldPicArr);

            if ($oldPicArr) {
            $arr = array_merge($oldPicArr, $arr);
             }


            return   implode('|',$arr);
        }

    }


	/**
	 * 添加商品
	 */
	public function add() {
        $fenlei=D('Goodsfenlei')->where(array('is_show'=>1))->order('paixu asc')->select();
		//zyg $fenlei=D('Goodsfenlei')->where(array('is_show'=>1,'fid'=>0))->order('paixu asc')->select();
        //zyg $fl2 = D('Goodsfenlei')->where(array('is_show'=>1,'fid'=>$fenlei[0]['id']))->order('paixu asc')->select();;
		//zyg $this->assign('fl2',$fl2);
		$this->assign('fl',$fenlei);
		$this->display();
	}
	//二级分类ajax  zyg
/*	public function reqCate2(){
        C('TOKEN_ON',false);
        $id = I('id');
       // echo json_encode(['code'=>0,'data'=>$id]);exit;
        $fenlei=D('Goodsfenlei')->where(array('is_show'=>1,'fid'=>$id))->order('paixu asc')->select();
        if($fenlei){
            echo json_encode(['code'=>0,'data'=>$fenlei]);
        }else{
            echo json_encode(['code'=>__LINE__,'msg'=>'下级分类存在']);
        }
        exit;
    }*/
	protected function isUploadImages($files)
    {
        foreach ($files as $k => $v)
        {
            if($v)
                return TRUE;
        }
        return FALSE;
    }


	
	public function do_add(){
		C('TOKEN_ON',false);
 		//dump($_POST);exit;
		$file = $_FILES['pic'];
		$file2=$_FILES['pic_arr'];
		//dump($file2);exit;

		if (empty($file['name'])){
			$this->error('缩略图上传失败!');
		}else if(empty($file2['name'])){
		    $this->error('请上传大图');
		
		}else {
                $upload = new \Think\Upload();// 实例化上传类
				$upload->maxSize 	= 3145728;// 设置附件上传大小
				$upload->exts    	= array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			//	$upload->savePath	= './Uploads/';// 设置附件上传根目录
				$upload->savePath  	=  '/Images/'; // 网站主栏目图片 设置附件上传（子）目录
				$upload->autoSub 	= true;
				$upload->subName 	= array('date','Ymd');
				$upload->saveName = array('uniqid','');//设置上传文件规则
				$info = $upload->upload();//var_dump($info);
				
				if (!$info) {
					//捕获上传异常
					$this->error($upload->getErrorMsg());
				} else {
					foreach($info as $file){
						$file_image = './Uploads'.$file['savepath'].$file['savename'];
						$file_mini='./Uploads'.$file['savepath'].'mini/'.$file['savename'];
						$file_path='./Uploads'.$file['savepath'].'mini/';
						if (!is_dir($file_path)) {mkdir($file_path,0777);}
						$img=new \Think\Image();
						$img->open($file_image);
						$img->thumb(300,240)->save($file_mini);
					}
				}unlink($file_image);
				
		
					
	 	 if($this->isUploadImages($_FILES['pic_arr']['tmp_name'])){
                $_POST['pic_arr'] = $this->uploadArrImg($path='Images',$tb='pic_arr',$w=750,$h=430);

			}
			$m=M('Goods');
			if(I('post.fid')){$data['fid']=I('post.fid');}
			if(I('post.name')){$data['name']=I('post.name');}
			if(I('post.xgnum')){$data['xgnum']=I('post.xgnum');}
			if(I('post.tjr_bh')){$data['tjr_bh']=I('post.tjr_bh');}
			if(I('post.xianjing')){$data['xianjing']=I('post.xianjing');}
			if(I('post.xf_fl')){$data['xf_fl']=I('post.xf_fl');}
			if(I('post.index_post')){$data['index_post']=I('post.index_post');}
			if(I('post.is_show')){$data['is_show']=I('post.is_show');}
			if(I('post.xtyuliu')){$data['xtyuliu']=I('post.xtyuliu');}
			if(I('post.yunfei')){$data['yunfei']=I('post.yunfei');}
			if(I('post.user_jibie')){$data['user_jibie']=I('post.user_jibie');}
			if(I('post.jifen')>=0){$data['jifen']=I('post.jifen');}
            if(I('post.agxfq')>=0){$data['agxfq']=I('post.agxfq');} // 爱国消费券
			if(I('post.jiangli')>=0){$data['jiangli']=I('post.jiangli');}
			if(I('post.guige')){$data['guige']=I('post.guige');}
			if(I('post.kucun')>=0){$data['kucun']=I('post.kucun');}
			if($file_mini){$data['pic']=$file_mini;}
			if($_POST['pic_arr']){$data['pic_arr']=$_POST['pic_arr'];}
			if($file_mini2){$data['pic2']=$file_mini2;}
			if(I('post.content')){$data['content']=I('post.content');}
			if(I('post.paixu')){$data['paixu']=I('post.paixu');}
			$data['date']=time();
			if(session('admin_name')){$data['user']=session('admin_name');}
			//var_dump($data);die();
			$count=$m->add($data); //修改表单用save函数
			if ($count>0){
				$this->success('添加成功！',U('Goods/index'));
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
		
		$m=M('Goods');
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
	
	/**
	 * 查询数据表单处理
	 */
	public function search(){

        $fl=D('Goodsfenlei')->where(array('is_show'=>1,'fid'=>0))->order('id asc')->select();
		$this->assign('fl',$fl);
		
		$fenle=I('get.fid');
		$keyword=I('get.keyword');
        
		$m=D('Goods');
		if ($fenle==""&&$keyword==null){
			$this->error('请选择分类或输入搜索商品名称');
			$this->display('index');
		}
		if ($fenle!=""&&$keyword==null ){
			
			  $con['fid']=$fenle;
			  $arr=$m->where($con)->select();
			
			}
			
		if ($fenle=="" &&$keyword!=null ){
			
		     $con['name']=array('like','%'.$keyword.'%');
	
		     $arr=$m->where($con)->select();
		
		 }
	 
		if ($fenle!=""&&$keyword!=null ){
			
			 $con['fid']=$fenle;
			 $con['name']=array('like','%'.$keyword.'%');
			 
		     $arr=$m->where($con)->select();
		
		 }		
		
		//$arr=$m->where("name like '%{$keyword}%'")->select();
    	//**分页实现代码
		
    	$count=count($arr);// 查询满足要求的总记录数
		
    	$Page = new \Think\Page($count,11);// 实例化分页类 传入总记录数和每页显示的记录数
		//var_dump($Page);
    	$show = $Page->show();// 分页显示输出
		//var_dump($show);
		
    	//**分页实现代码
		$fenlei=D('Goodsfenlei')->where(array('is_show'=>1))->order('paixu asc')->select();
		$arr=$m->where($con)->limit($Page->firstRow.','.$Page->listRows)->order('id desc')->select();
		foreach($arr as $k=>$v){
			foreach($fenlei as $fk=>$fv){
				if($v['fid']==$fv['id']){
                    $fname1 = M('Goodsfenlei')->where(['id'=>$fv['fid']])->getField('name');//一级分类名称
                    $arr[$k]['fenlei']= $fname1.'-'.$fv['name'];
					//$arr[$k]['fenlei']=$fv['name'];
					break;
				}
			}
		}
				
		if ($arr==null){
			$this->error('没有数据');
			
	
		}else {
			//**分页实现代码
			$this->assign('page',$show);// 赋值分页输出
			//**分页实现代码
			$this->assign('vlist',$arr); //在新查询到的数据再分配给前台模板显示
			$this->assign('count',$count);
			$this->display('index'); //指定模板
		}
	
	}	

}

?>