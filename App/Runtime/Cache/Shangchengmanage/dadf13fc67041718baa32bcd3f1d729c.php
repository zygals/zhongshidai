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
        <td height="31"><div class="titlebt">模板管理</div></td>
      </tr>
    </table>

<div class="main">
    
	<div class="form">
		<form method='post' id="form_do" name="form_do" action="/shangchengmanage/system/do_moban" >
		
		<dl>
			<dt>电脑模板默认风格：</dt>
			<dd>
				<?php if(!empty($qtmoban)): if(is_array($qtmoban)): foreach($qtmoban as $key=>$v): ?><span style="margin:0 15px 0 0;"><input type="radio" name="DEFAULT_THEME__HOME" value="<?php echo ($v["name"]); ?>" <?php echo ($v["checked"]); ?>/><?php echo ($v["name"]); ?></span><?php endforeach; endif; endif; ?>
				
			</dd>
			<!--<dd>
				<input type="text" name="DEFAULT_THEME__HOME" value="<?php echo (C("DEFAULT_THEME__HOME")); ?>" />
				说明：首字母要大写
			</dd>-->
		
		</dl>
		
		<dl>
			<dt>手机模板默认风格：</dt>
			<dd>
				<input type="text" name="DEFAULT_THEME__MOBILE" value="<?php echo (C("DEFAULT_THEME__MOBILE")); ?>" />
				说明：首字母要大写
			</dd>
		
		</dl>

		</div>
		<div class="form_b">
			<input type="submit" class="btn_blue" id="submit" value="提 交">
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