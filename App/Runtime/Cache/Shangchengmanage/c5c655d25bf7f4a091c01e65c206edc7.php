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
        <td height="31"><div class="titlebt">编辑下载</div></td>
      </tr>
    </table>
<div class="main">
	<div class="form">
		<form method='post' action="/shangchengmanage/down/do_edit" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo ($data["id"]); ?>">
		<dl>
			<dt> 下载分类：</dt>
			<dd>
				<select name="fid">
					<?php if(is_array($fl)): $i = 0; $__LIST__ = $fl;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>" <?php if($v["id"] == $data["fid"] ): ?>selected<?php endif; ?>><?php echo ($v["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
			</dd>
		</dl>
		<dl>
			<dt> 下载标题：</dt>
			<dd>
				<input type="text" name="title" class="inp_w250" value="<?php echo ($data["title"]); ?>" />
			</dd>
		</dl>

			<dl>
				<dt> 上传文件：</dt>
				<dd>
					<input type="file" name="loadurl" class="inp_w250" value="" />
				</dd>
			</dl>

		<dl>
			<dt> 是否显示：</dt>
			<dd>
				<input type="radio" name="is_show" value="1" <?php if($data['is_show'] == 1): ?>checked="checked"<?php endif; ?> />是
				&nbsp;&nbsp;
				<input type="radio" name="is_show" value="2"<?php if($data['is_show'] == 2): ?>checked="checked"<?php endif; ?> />否
			</dd>
		</dl>
		<dl>
			<dt> 排序：</dt>
			<dd>
				<input type="text" name="paixu" class="inp_w250" value="<?php echo ($data["paixu"]); ?>" />
			</dd>
		</dl>
				
		<!--载入kindeditor编辑器开始-->
		<script type="text/javascript" charset="utf-8" src="/Data/kindeditor/kindeditor.js"></script>
		<script charset="utf-8" src="/Data/kindeditor/lang/zh_CN.js"></script>
		<script language="javascript">
		var editor;
		KindEditor.ready(function(K) {
		editor = K.create('#intro');
		// editor = K.create('#editor_id');多个
		});
		</script>
		<!--<textarea id="editor_id" name="content" style="width:280px;height:160px;"></textarea>-->
		<!--载入kindeditor编辑器结束-->
		<dl>
			<dt> 内容：</dt>
			<dd>
		<div>
		<textarea id="intro" name="content" style="width:700px;height:400px;"/><?php echo ($data["content"]); ?></textarea>
		</div>
			</dd>
		</dl>
		<div class="form_b">
			<input type='hidden' name='user' value="<?php echo ($_SESSION['admin_name']); ?>" />
			<input type="hidden" name="id" value="<?php echo ($data["id"]); ?>" />	
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