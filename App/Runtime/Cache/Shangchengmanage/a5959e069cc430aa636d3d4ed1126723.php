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
        <td height="31"><div class="titlebt">模型管理</div></td>
      </tr>
    </table>

<div class="main">    
    <div class="operate">
        <div class="left"><input type="button" onclick="window.open('/<?php echo ($module); ?>/Model/add','main')" class="btn_blue" value="添加模型">
        </div>
    </div>
    <div class="list">    
    <form action="{:U(GROUP_NAME.'/Model/sort')}" method="post" id="form_do" name="form_do">
        <table width="100%">
            <tr>
                <th>编号</th>
                <th>名称</th>
                <th>控制器名称</th>
				<th>添加时间</th>
                <th>操作</th>
            </tr>
			<?php if(is_array($vlist)): foreach($vlist as $key=>$v): ?><tr>
                <td><?php echo ($v["id"]); ?></td>
                <td><?php echo ($v["model_name"]); ?></td>
                <td><?php echo ($v["model_table"]); ?></td>
				<td><?php echo (date('Y-m-d H:i:s',$v["model_addtime"])); ?></td>
                <td>
                <a href="/<?php echo ($module); ?>/Model/edit/id/<?php echo ($v["id"]); ?>">修改</a>
				<a href="/shangchengmanage/model/del/id/<?php echo ($v["id"]); ?>" onClick="return confirm('是否确定删除?')">删除</a>
                
				</td>
            </tr><?php endforeach; endif; ?>
        </table>
        <div class="th" style="clear: both;color:#FF0000">注意：非网站技术开发人员，不要随意更改删除模型！！</div>
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