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
        <td height="31"><div class="titlebt">数据分页</div></td>
      </tr>
    </table>

<div class="main">
    
	<div class="form">
		<form method='post' id="form_do" name="form_do" action="/shangchengmanage/system/do_fenye" >
		<dl>
			<dd>
				文章模型：<input type="text" name="PAGE_ARTICLE__HOME" class="inp_one inp_w250" value="<?php echo (C("PAGE_ARTICLE__HOME")); ?>" />
			</dd>

		</dl>
		
		<dl>
			<dd>
				产品模型：<input type="text" name="PAGE_PRODUCT__HOME" class="inp_one inp_w250" value="<?php echo (C("PAGE_PRODUCT__HOME")); ?>" />
			</dd>

		</dl>
		
		<dl>
			<dd>
				图片模型：<input type="text" name="PAGE_PHOTO__HOME" class="inp_one inp_w250" value="<?php echo (C("PAGE_PHOTO__HOME")); ?>" />
			</dd>

		</dl>
		
		
		<dl>
			<dd>
				下载模型：<input type="text" name="PAGE_DOWNLOAD__HOME" class="inp_one inp_w250" value="<?php echo (C("PAGE_DOWNLOAD__HOME")); ?>" />
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