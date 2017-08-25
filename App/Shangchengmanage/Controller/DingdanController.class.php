<?php

namespace Shangchengmanage\Controller;
use Think\Controller;
use Common\Lib\Common; //引入类函数
use Common\Lib\String; //引入类函数
use Think\Upload;
use Think\Image;
class DingdanController extends CommonController {
	/**
	 * 订单管理
	 */
	public function index() {
		$m=M('Dingdan');
    	//**分页实现代码
    	$count=$m->count();// 查询满足要求的总记录数
    	$Page = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
    	$show = $Page->show();// 分页显示输出
    	//**分页实现代码
		$arr=$m->limit($Page->firstRow.','.$Page->listRows)->order('id desc')->select();
		foreach($arr as $k=>$v){
			$user=D('User')->where(array('user_login_bh'=>$v['bh']))->find();
			$arr[$k]['uname']=$user['user_name'];
			$garr=json_decode($v['gid'],true);
			$goodstr='';
			foreach($garr as $gk=>$gv){
				$gstr='';
				$good=D('Goods')->find($gv['gid']);
				if($gstr==''){
					$gstr=$good['name'].'*'.$gv['num'];
				}else{
					$gstr.=' , '.$good['name'].'*'.$gv['num'];
				}
				$goodstr.=$gstr;
			}
			$arr[$k]['goodstr']=$goodstr;
			if($v['type']==1){
				$arr[$k]['dtype']='<span style="color:red;">未支付</span>';
			}elseif($v['type']==2){
				$arr[$k]['dtype']='<span style="color:green;">已完成</span>';
			}elseif($v['type']==3){
				$arr[$k]['dtype']='<span style="color:orange;">已取消</span>';
			}
			if($v['good_type']==1){
				$arr[$k]['gtype']='<span style="color:blue;">待收货</span>';
			}elseif($v['good_type']==2){
				$arr[$k]['gtype']='<span style="color:green;">已完成</span>';
			}elseif($v['good_type']==3){
				$arr[$k]['gtype']='<span style="color:orange;">退货</span>';
			}else{
				$arr[$k]['gtype']='<span style="color:red;">待发货</span>';
			}
			
		}



    if($_GET['fahuo']){
	    $seleid = I('POST.seleid');
			foreach($seleid as $vo)
			{
			  $con['good_type']=0;
		      $con['type']=2;
			  $con['id']=$vo;
			  $sty=$m->where($con)->select();
			   foreach($sty as $v){
					   $data['good_type']=1;
					   $n=$m->where('id='.$v['id'])->save($data);
				   }
				}
				$con1['type']=2;
				$con1['good_type']=1;
				$arr=$m->limit($Page->firstRow.','.$Page->listRows)->order('id desc')->select();
		 foreach($arr as $k=>$v){
			$user=D('User')->where(array('user_login_bh'=>$v['bh']))->find();
			$arr[$k]['uname']=$user['user_name'];
			$garr=json_decode($v['gid'],true);
			$goodstr='';
			foreach($garr as $gk=>$gv){
				$gstr='';
				$good=D('Goods')->find($gv['gid']);
				if($gstr==''){
					$gstr=$good['name'].'*'.$gv['num'];
				}else{
					$gstr.=' , '.$good['name'].'*'.$gv['num'];
				}
				$goodstr.=$gstr;
			}
			$arr[$k]['goodstr']=$goodstr;
			if($v['type']==1){
				$arr[$k]['dtype']='<span style="color:red;">未支付</span>';
			}elseif($v['type']==2){
				$arr[$k]['dtype']='<span style="color:green;">已完成</span>';
			}elseif($v['type']==3){
				$arr[$k]['dtype']='<span style="color:orange;">已取消</span>';
			}
			if($v['good_type']==1){
				$arr[$k]['gtype']='<span style="color:blue;">待收货</span>';
			}elseif($v['good_type']==2){
				$arr[$k]['gtype']='<span style="color:green;">已完成</span>';
			}elseif($v['good_type']==3){
				$arr[$k]['gtype']='<span style="color:orange;">退货</span>';
			}else{
				$arr[$k]['gtype']='<span style="color:red;">待发货</span>';
			}
		}
	      
	}
		//**分页实现代码
		$this->assign('page',$show);// 赋值分页输出
		//**分页实现代码
		$this->assign('vlist',$arr);
		$this->assign('count',$count);
		$this->display();
		
	}
	/**
	 * 导出eexcel
	 */
	public function daochu(){
		$dingdan=D('Dingdan')->select();
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=订单.xls');
		header('Pragma: no-cache');
		header('Expires: 0');
		$title = array('编号', '会员编号', '商品', '订单号', '订单总额', '奖励积分','支付状态','发货状态','备注信息','物流公司','物流单号','时间');
		echo iconv('utf-8', 'gbk', implode("\t", $title)), "\n";
		foreach ($dingdan as $value) {
			$garr=json_decode($value['gid'],true);
			$goodstr='';
			foreach($garr as $gk=>$gv){
				$gstr='';
				$good=D('Goods')->find($gv['gid']);
				if($gstr==''){
					$gstr=$good['name'].'*'.$gv['num'];
				}else{
					$gstr.=' , '.$good['name'].'*'.$gv['num'];
				}
				$goodstr.=$gstr;
			}
			$value['gid']=$goodstr;
			echo iconv('utf-8', 'gbk', implode("\t", $value)), "\n";
		}

	}
	/**
	 * 全部订单导出CSV
	 */
	public function daochu1(){
		$dingdan=D('Dingdan')->select();
		$data=iconv('utf-8','gb2312',"编号,会员编号,商品,订单号,订单总额,奖励积分,支付状态,发货状态,备注信息,物流公司,物流单号,时间\n");
		foreach ($dingdan as $key=>$value) {
			$garr=json_decode($value['gid'],true);
			$goodstr='';
			foreach($garr as $gk=>$gv){
				$gstr='';
				$good=D('Goods')->find($gv['gid']);
				if($gstr==''){
					$gstr=$good['name'].'*'.$gv['num'];
				}else{
					$gstr.=' , '.$good['name'].'*'.$gv['num'];
				}
				$goodstr.=$gstr;
			}
			if($value['type']==1){
				$type=iconv('utf-8','gb2312',"未支付");
			}elseif($value['type']==2){
				$type=iconv('utf-8','gb2312',"完成");
			}elseif($value['type']==3){
				$type=iconv('utf-8','gb2312',"取消");
			}
			if($value['good_type']==0){
				$gtype=iconv('utf-8','gb2312',"待发货");
			}elseif($value['good_type']==1){
				$gtype=iconv('utf-8','gb2312',"待收货");
			}elseif($value['good_type']==2){
				$gtype=iconv('utf-8','gb2312',"已完成");
			}elseif($value['good_type']==3){
				$gtype=iconv('utf-8','gb2312',"退货");
			}
			$beizhu=iconv('utf-8','gb2312',$value['beizhu']);
			$gid= iconv('utf-8','gb2312',$goodstr);
			$wuliu= iconv('utf-8','gb2312',$value['wuliu']);
			$danhao= iconv('utf-8','gb2312',$value['danhao']);
			$data.=$value['id'].','.$value['bh'].','.$gid.','.$value['dingdanhao'].','.$value['yingfukuan'].','.$value['jianglijifen'].','.$type.','.$gtype.','.$beizhu.','.$wuliu.','.$danhao.','.date('Y-m-d H:i:s',$value['date'])."\n";
			
		}
		$filename = date('Ymd').'all.csv';
		header("Content-type:text/csv");
		header("Content-Disposition:attachment;filename=".$filename);
		header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
		header('Expires:0');
		header('Pragma:public');
		echo $data;
	}
	/**
	 * 未发货订单导出CSV
	 */
	public function daochu2(){
		$dingdan=D('Dingdan')->where(array('good_type'=>0))->select();
		foreach ($dingdan as $key=>$value) {
			$garr=json_decode($value['gid'],true);
			$goodstr='';
			foreach($garr as $gk=>$gv){
				$gstr='';
				$good=D('Goods')->find($gv['gid']);
				if($gstr==''){
					$gstr=$good['name'].'*'.$gv['num'];
				}else{
					$gstr.=' , '.$good['name'].'*'.$gv['num'];
				}
				$goodstr.=$gstr;
			}
			if($value['type']==1){
				$type=iconv('utf-8','gb2312',"已支付");
			}elseif($value['type']==2){
				$type=iconv('utf-8','gb2312',"完成");
			}elseif($value['type']==3){
				$type=iconv('utf-8','gb2312',"取消");
			}
			if($value['good_type']==0){
				$gtype=iconv('utf-8','gb2312',"待发货");
			}elseif($value['good_type']==1){
				$gtype=iconv('utf-8','gb2312',"待收货");
			}elseif($value['good_type']==2){
				$gtype=iconv('utf-8','gb2312',"已完成");
			}elseif($value['good_type']==3){
				$gtype=iconv('utf-8','gb2312',"退货");
			}
			$beizhu=iconv('utf-8','gb2312',$value['beizhu']);
			$gid= iconv('utf-8','gb2312',$goodstr);
			$wuliu= iconv('utf-8','gb2312',$value['wuliu']);
			$danhao= iconv('utf-8','gb2312',$value['danhao']);
			$data.=$value['id'].','.$value['bh'].','.$gid.','.$value['dingdanhao'].','.$value['yingfukuan'].','.$value['jianglijifen'].','.$type.','.$gtype.','.$beizhu.','.$wuliu.','.$danhao.','.date('Y-m-d H:i:s',$value['date'])."\n";
			
		}
		$filename = date('Ymd').'wfh.csv';
		header("Content-type:text/csv");
		header("Content-Disposition:attachment;filename=".$filename);
		header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
		header('Expires:0');
		header('Pragma:public');
		echo $data;
	}
	/**
	 * 详情页面
	 */
	public function detail() {
		$id=I('get.id');
		$canshu=D('Canshu')->order('id desc')->find();
		$m=M('Dingdan');
		$data = $m->find($id);
		
		$user=D('User')->where(array('user_login_bh'=>$data['bh']))->find();
		$dizhi=D('User_address')->where(array('bh'=>$user['user_login_bh']))->order('id desc')->find();
		
		$this->assign('dizhi',$dizhi);
		$garr=json_decode($data['gid'],true);
		foreach($garr as $k=>$v){
			$good=D('Goods')->find($v['gid']);
			$good['pic1']=substr($good['pic'],1,strlen($good['pic']));
			$good['num']=$v['num'];
			$goods[]=$good;
		}
		if($data['type']==1){
			$data['dtype']='<span style="color:red;">已支付</span>';
		}elseif($data['type']==2){
			$data['dtype']='<span style="color:green;">已完成</span>';
		}elseif($data['type']==3){
			$data['dtype']='<span style="color:orange;">已取消</span>';
		}
		/*if($data['good_type']==1){
			$data['gtype']='待收货';
		}elseif($data['good_type']==2){
			$data['gtype']='已完成';
		}elseif($data['good_type']==3){
			$data['gtype']='退货';
		}else{
			$data['gtype']='待发货';
		}
		*/
	  if(IS_POST)
	  { 
			  $con['id']=I('get.id');
			  $con['good_type']=0;
		      $con['type']=2;
			  $sty=D('dingdan')->where($con)->find();
			        $gtye['good_type']=$sty['good_type'];
					$box = I('POST.box');
						foreach($box as $v)
						{ 
							if($v==0)
							{
								$data['good_type']=0;
								 $id=I('get.id');
					            $n=$m->where('id='.$id)->save($data);
								}elseif($v==1)
								{
							    $data['good_type']=1;
								 $id=I('get.id');
					            $n=$m->where('id='.$id)->save($data);
									}elseif($v==2)
								{
							    $data['good_type']=2;
								 $id=I('get.id');
					            $n=$m->where('id='.$id)->save($data);
									}elseif($v==3)
								{
							    $data['good_type']=3;
								 $id=I('get.id');
					            $n=$m->where('id='.$id)->save($data);
									}
						} 
				if($box){
					$this->success('发货成功',U('dingdan/index'));
				}else{
					$this->error('发货失败',U('dingdan/detail'));
				}	
						
		 }
		if($data['type']==1&&$data['good_type']==0){
			$this->assign('fh',1);
		}
		if($data['type']==1&&$data['good_type']==1){
			if(strtotime("-".$canshu['shouhuoday']." day")>$data['date']){
				$this->assign('morensh',1);
			}
		}
		$this->assign('user',$user);
		$this->assign('goods',$goods);
		$this->assign('data',$data);
    	$this->display();
	}

	/**
	 * 发货
	 */
	public function fahuo() {//var_dump($_GET);die();
		$id = I('get.id');
		if(I('get.w')){
			$wuliu=I('get.w');
		}else{
			$this->error('请填写物流信息');
		}
		if(I('get.d')){
			$danhao=I('get.d');
		}else{
			$this->error('请填写快递单号');
		}
		$jg=D('Dingdan')->where(array('id'=>$id))->data(array('wuliu'=>$wuliu,'danhao'=>$danhao,'good_type'=>1))->save();
		if ($jg>0){
			$this->success('发货成功！',U('Dingdan/index'));
		}
		else {
			$this->error('发货失败！');
		}
		
	}
	/**
	 * 默认发货
	 */
	public function shouhuo() {
		$id = I('get.id');
		$jg=D('Dingdan')->where(array('id'=>$id))->data(array('type'=>2,'good_type'=>2))->save();
		if ($jg>0){
			$this->success('订单已完成！',U('Dingdan/index'));
		}
		else {
			$this->error('提交失败！');
		}
		
	}


}

?>