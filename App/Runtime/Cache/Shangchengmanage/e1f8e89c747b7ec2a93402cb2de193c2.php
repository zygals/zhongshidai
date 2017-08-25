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
.w50{
	width:50px;
}

#form_tab{ padding-left:140px}
#form_tab table tr td{ background:#FFF;border:none; height:auto; text-align:left; line-height:auto; color:#000; font-size:14px;}
.wenbenyu,.wenbenyu1,.wenbenyu2{ width:100%; margin-top:20px; margin-left:50px;}
.wenbenyu span,.wenbenyu1 span,.wenbenyu2 span{ font-size:16px; color:#094ba7; font-weight:bold;}
.wenbenyu input,.wenbenyu1 input,.wenbenyu2 input{ height:34px; border:solid 1px #d7d3d3; border-radius:5px; line-height:34px;width:500px;  padding-left:10px;}
.wenbenyu textarea{border:solid 1px #d7d3d3; font-size:16px; color:#555555; width:500px; height:163px; padding:5px 10px; line-height:24px}
.wenbenyu input.input-xm{ width:245px; height:34px; font-size:16px; padding-left:5px; margin-top:6px; background:url(../images/icon.png) no-repeat right}
</style>

<table width="100%" height="31px" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
	<tr>
		<td height="31"><div class="titlebt">添加隔代取酬</div></td>
	</tr>
</table>

<div class="main">

	<div class="form">
       <form method='post' id="form_do" name="form_do" action="/shangchengmanage/gedaiquchou/do_add">
          <input type='hidden' name="check" value="1">
            <div class="wenbenyu">
                <span>推荐最少人数&nbsp;</span><input style="width:100px" id="min" name="min" value="" type="text" />&nbsp;&nbsp;/人
            </div>
            <div class="wenbenyu">
                <span>推荐最多人数&nbsp;</span><input style="width:100px" id="max" name="max" value="" type="text" />&nbsp;&nbsp;/人
            </div>
            <div class="wenbenyu">
                <span>隔代取酬比例&nbsp;</span><input style="width:100px" id="jiangli" name="jiangli" value="" type="text" />&nbsp;&nbsp;（%）
            </div>
            <div class="form_b">
			<input type="submit" class="btn_blue" id="submit" value="添 加">
		     </div>
            
          </form>
    
	</div>
<!--<div style="height:50px;"></div>
<div class="cont-ft">
            <div class="copyright">
                <div class="fl">感谢使用XX商城企业后台管理系统</div>
            </div>
</div>-->
</body>
</html>