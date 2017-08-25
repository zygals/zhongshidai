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
        <td height="31"><div class="titlebt">网站设置	</div></td>
      </tr>
    </table>

<div class="main">
    
	<div class="form">
		<form method='post' id="form_do" name="form_do" action="/shangchengmanage/kefu/do_kefu">
		
		<input type="hidden" name="id" class="inp_one inp_w250" value="<?php echo ($v["id"]); ?>" />
		<dl>
			<dt> 显示状态：</dt>
			<dd>
				<input type="radio" name='kefu_if' value='1'  <?php if($v['kefu_if'] == 1): ?>checked="checked"<?php endif; ?>/>开启
				<input type="radio" name='kefu_if' value='0' <?php if($v['kefu_if'] == 0): ?>checked="checked"<?php endif; ?> />关闭
			</dd>			
			<dd class="desc"></dd>
			<dd></dd>
		</dl>
		

		<dl>
			<dt> 客服号码：</dt>
			<dd>
				<textarea name="kefu_qq" class="tarea_default"><?php echo ($v["kefu_qq"]); ?></textarea><br/>
				
			</dd>
		</dl>
		
	
		<dl>
			<dt> 电话号码：</dt>
			<dd>
				<textarea name="kefu_tel" class="tarea_default"><?php echo ($v["kefu_tel"]); ?></textarea><br/>
				
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