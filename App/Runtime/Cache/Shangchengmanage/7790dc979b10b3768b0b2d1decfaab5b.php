<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo (C("setting.Copyright")); ?> <?php echo (C("setting.Version")); ?> <?php echo (C("setting.Code")); ?></title>
<script language="javascript" type="text/javascript" src="/App/Shangchengmanage/View/Default/js/jquery.js"></script>
<script src="/App/Shangchengmanage/View/Default/js/frame.js" language="javascript" type="text/javascript"></script>
<link href="/App/Shangchengmanage/View/Default/css/style.css" rel="stylesheet" type="text/css" />

<!--[if IE 6]>
<script src="/App/Shangchengmanage/View/Default/Js/DD_belatedPNG.js" language="javascript" type="text/javascript"></script>
<script>
  DD_belatedPNG.fix('.nav ul li a,.top_link ul li,background');   /* string argument can be any CSS selector */
</script>
<![endif]-->
</head>
<body class="showmenu">
<style>
.w50{width:100px;}
span b{ color:red;}
</style>
<table width="100%" height="31px" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
      <tr>
        <td height="31"><div class="titlebt">添加等级</div></td>
      </tr>
    </table>
<div class="main">
	<div class="form">
		<form method='post' id="form_do" name="form_do" action="/shangchengmanage/dengji/do_add" enctype="multipart/form-data">
		<dl>
			<dt> 等级名称：</dt>
			<dd>
				<input type="text" name="name" id="name" class="inp_w250" value="请输入名称" onfocus="if(value=='请输入名称') {value=''}"  onblur="checkname()"/>
			</dd>
		</dl>
        <dl>
			<dt> 提成：</dt>
			<dd>
				<input type="text" name="ticheng" id="ticheng" class="inp_w250" value="请输入提成" onfocus="if(value=='请输入提成') {value=''}"  onblur="checkticheng()" /><span style=" margin-left:20px;">例如：<b>0</b>或者<b>0.05</b></span>
			</dd>
		</dl>
        <dl>
			<dt> 任务量：</dt>
			<dd>
				<input type="text" name="renwuliang_min" id="renwuliang_min" class="inp_one w50" value="" onblur="checkrenwuliang1()"/> -
                <input type="text" name="renwuliang_max" id="renwuliang_max" class="inp_one w50" value="" onblur="checkrenwuliang2()"/>
                <span style=" margin-left:20px;">例如：vip任务量为<b>0</b>，社区工作站为<b>0-800000</b>，区域服务中心为<b>800000-2000000</b>，省级分公司为<b>2000000-10000000</b>，</span>
			</dd>
		</dl>
        <dl>
			<dt> 条件1：</dt>
			<dd>
             <input type="text" name="tiaojian1_min" id="tiaojian1_min" class="inp_one w50" value="" onblur="checktj1_min()"/> -
             <input type="text" name="tiaojian1_max" id="tiaojian1_max"  class="inp_one w50" value="" onblur="checktj1_max()" />
              <span style=" margin-left:20px;">例如：vip条件1为<b>0</b>，社区工作站为<b>0-50000</b>充值积分，区域服务中心为<b>100000以上</b>的充值积分，省级分公司为<b>1000000以上</b>的充值积分，</span>
			</dd>
		</dl>
        <dl>
			<dt> 条件2：</dt>
			<dd>
             <input type="text" name="tiaojian2_min" id="tiaojian2_min" class="inp_one w50" value="" onblur="checktj2_min()" /> -
             <input type="text" name="tiaojian2_max" id="tiaojian2_max" class="inp_one w50" value="" onblur="checktj2_max()" />
             <span style=" margin-left:20px;">例如：vip条件2为<b>0</b>，社区工作站为<b>7个以上含7个vip会员</b>，区域服务中心为<b>7个以上含7个社区工作站</b>，省级分公司为<b>7个以上含7个区域服务中心</b>，</span>
			</dd>
		</dl>
		<dl>
			<dt> 是否显示：</dt>
			<dd>
				<input type="radio" name="is_show" value="1" checked="checked"/>是
				&nbsp;&nbsp;
				<input type="radio" name="is_show" value="2"/>否
			</dd>
		</dl>
		<div class="form_b">
			<input type="submit" class="btn_blue" id="submit" value="提 交">
		</div>
	   </form>
	</div>
</div>
<!--<div style="height:50px;"></div>
<div class="cont-ft">
            <div class="copyright">
                <div class="fl">感谢使用XX商城企业后台管理系统</div>
            </div>
</div>-->
</body>
</html>

<script>
function checkname()
	   {
	  var name=$('#name').val();
      var mag=  /^[\u4e00-\u9fa5]{2,16}$/gi;	
	if(name.trim() == ''){
       alert('名称不能为空');
	  $("#name").val('请输入名称');  
        return false;
    }
    if(!mag.test(name)){
        alert('名称必须是汉字');
		$("#name").val('请输入名称'); 
        return false;
    }
	   }
 function checkticheng()
	   {
	  var ticheng=$('#ticheng').val();
      var tc=/^[-+]?\d+(\.\d+)?$/;	
	if(ticheng.trim() == ''){
       alert('提成不能为空');
	  $("#ticheng").val('请输入提成');  
        return false;
    }
    if(!tc.test(ticheng)){
        alert('提成必须是数字');
		$("#ticheng").val('请输入提成'); 
        return false;
    }
	   }
 function checkrenwuliang1()
	   {
	  var renwuliang_min=$('#renwuliang_min').val();
      var rwl1=/^[0-9]*$/;	
    if(!rwl1.test(renwuliang_min)){
        alert('任务量必须是数字');
        return false;
    }
	   }
 function checkrenwuliang2()
	   {
	  var renwuliang_max=$('#renwuliang_max').val();
      var rwl2=/^[0-9]*$/;	
    if(!rwl2.test(renwuliang_max)){
        alert('任务量必须是数字');
        return false;
    }
	}
//条件1
 function checktj1_min()
	   {
	var tiaojian1_min=$('#tiaojian1_min').val();
      var tj_min=/^[0-9]*$/;	
    if(!tj_min.test(tiaojian1_min)){
        alert('条件1必须是数字');
        return false;
    }
	   }
 function checktj1_max()
	   {
	  var tiaojian1_max=$('#tiaojian1_max').val();
      var tj_max=/^[0-9]*$/;	

    if(!tj_max.test(tiaojian1_max)){
        alert('条件1必须是数字');
        return false;
    }
	   }
//条件2
 function checktj2_min()
	   {
	var tiaojian2_min=$('#tiaojian2_min').val();
      var tj2_min=/^[0-9]*$/;	

    if(!tj2_min.test(tiaojian2_min)){
        alert('条件2必须是数字');
        return false;
    }
	   }
 function checktj2_max()
	   {
	  var tiaojian2_max=$('#tiaojian2_max').val();
      var tj2_max=/^[0-9]*$/;	
    if(!tj2_max.test(tiaojian2_max)){
        alert('条件2必须是数字');
        return false;
    }
	   }	
</script>
<script>
$(document).ready(function() 
{
	$('#submit').click(function() {   
//名称验证
  var name=$('#name').val();
      var mag=  /^[\u4e00-\u9fa5]{2,16}$/gi;	
	if(name.trim() == ''){
       alert('名称不能为空');
	  $("#name").val('请输入名称');  
        return false;
    }
    if(!mag.test(name)){
        alert('名称必须是汉字');
		$("#name").val('请输入名称'); 
        return false;
    }
	if(name=="请输入名称")
	{    
		 alert('名称不正确，请重新输入');
		 $("#trueName").val('请输入名称'); 
        return false;
		}
//提成验证
  var ticheng=$('#ticheng').val();
      var tc=/^[-+]?\d+(\.\d+)?$/;	
	if(ticheng.trim() == ''){
       alert('提成不能为空');
	  $("#ticheng").val('请输入提成');  
        return false;
    }
    if(!tc.test(ticheng)){
        alert('提成必须是数字');
		$("#ticheng").val('请输入提成'); 
        return false;
	}
});
  
});	
</script>