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

<table width="100%" height="31px" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
      <tr>
        <td height="31"><div class="titlebt">修改信息</div></td>
      </tr>
    </table>

<div class="main">
    
	<div class="form">
		<form method='post' id="form_do" name="form_do" action="/shangchengmanage/personal/modify_admin" onSubmit="return checkMail()">
		
		<dl>
			<dt> 用 户 名：</dt>
			<dd>
				<?php echo ($_SESSION["admin_name"]); ?>
			</dd>			
			<dd class="desc"></dd>
			<dd></dd>
		</dl>
		
		<dl>
			<dt> 登录次数：</dt>
			<dd>
				<?php echo ($v["admin_login"]); ?>
			</dd>			
			<dd class="desc"></dd>
			<dd></dd>
		</dl>
		
		<dl>
			<dt> 上次登录时间：</dt>
			<dd>
				<?php echo (date('Y-m-d H:i:s',$v["admin_olddate"])); ?>
				
			</dd>			
			<dd class="desc"></dd>
			<dd></dd>
		</dl>
		<dl>
			<dt>上次登录IP：</dt>
			<dd>
				<?php echo ($v["admin_oldip"]); ?>
			</dd>
			<dd class="desc"> </dd>
			<dd></dd>
		</dl>	

		
		
		<div class="h3">修改信息</div>
				
		<dl>
			<dt>真实名字：</dt>
			<dd>
				<input type="text" name="admin_myname" class="inp_one inp_w250"  value="<?php echo ($v["admin_myname"]); ?>" />
			</dd>
			<dd class="desc"></dd>
			<dd></dd>
		</dl>
		
		<dl>
			<dt>电子邮箱：</dt>
			<dd>
				<input type="text" name="admin_email" class="inp_one inp_w250"  value="<?php echo ($v["admin_email"]); ?>" />
			</dd>
			<dd class="desc"></dd>
			<dd></dd>
		</dl>

		</div>
		<div class="form_b">
			<input type="submit" class="btn_blue" id="submit" value="提 交">
			<input  type="hidden" name="id" value="<?php echo ($v["id"]); ?>" />
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