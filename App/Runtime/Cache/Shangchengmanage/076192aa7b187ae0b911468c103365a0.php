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
        <td height="31"><div class="titlebt">修改</div></td>
      </tr>
    </table>

<div class="main">
    
	<div class="form">
		<form method='post' id="form_do" name="form_do" action="/shangchengmanage/banner/do_edit" enctype="multipart/form-data">
		<dl>
			<dt> 名称：</dt>
			<dt>
				<input type="text" name="column_name" class="inp_w250" value="<?php echo ($v["column_name"]); ?>" />
			</dt>
		</dl>
		
		<dl>
			<dd></dd>
		</dl>
		
		<dl>
			<dt> 图片附件：</dt>
			<dd>
				<input name="column_images" id="image" type="file" />
				<img src="<?php echo ($v["column_images"]); ?>" width="180px" height="50px" border="0"/>
			</dd>
		</dl>

		<dl>
			<dt> 显示状态：</dt>
			<dd>
				<label><input type="radio" name="column_show" value="1" <?php if(1 == $v['column_show']): ?>checked="checked"<?php endif; ?>/>开启</label>
				<label><input type="radio" name="column_show" value="2" <?php if(2 == $v['column_show']): ?>checked="checked"<?php endif; ?>/>不开启</label>
				
			</dd>
		</dl>
		
		<dl>
			<dt> 排序：</dt>
			<dt>
				<input type="text" name="column_sort" class="inp_w250" value="<?php echo ($v["column_sort"]); ?>" />
			</dt>
		</dl>
		
		<div class="form_b">
			<input type="hidden" name="column_type" value="1">
			<input type="hidden" name="id" value="<?php echo ($v["id"]); ?>" />	
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