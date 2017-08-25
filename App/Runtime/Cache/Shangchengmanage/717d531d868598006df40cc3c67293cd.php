<?php if (!defined('THINK_PATH')) exit();?><script src="/App/Shangchengmanage/View/Default/js/common.js" type="text/javascript"></script>

 <script type="text/javascript">
  function clear_del()
  {
   if(confirm("确定全部数据库备份？"))
   {
	subform("<?php echo U('Database/backup');?>");
   }
  }
 </script>
 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
        <td height="31"><div class="titlebt">数据库管理</div></td>
      </tr>
    </table>

<div class="main">
    <div class="operate">
        <div class="left">
            <?php if(ACTION_NAME == "index"): ?><input type="button" onClick="return clear_del();" target="main" class="btn_blue" value="数据库备份">
                
				<input type="button" onClick="subform('/<?php echo ($module); ?>/Database/optimize/batchFlag/1')" class="btn_blue" value="数据表优化">
				<input type="button" onClick="subform('/<?php echo ($module); ?>/Database/repair/batchFlag/1')" class="btn_blue" value="数据表修复">
				
                <input type="button" onClick="window.open('/<?php echo ($module); ?>/Database/restore','main')" class="btn_green" value="还原管理">
            <?php else: ?>
                <input type="button" onClick="goUrl('{:U(GROUP_NAME. '/Database/index')}')" class="btn_blue" value="返回">
                <input type="button" onClick="doGoBatch('{:U(GROUP_NAME.'/Database/restore')}')" class="btn_green" value="还原">
                <input type="button" onClick="doConfirmBatch('{:U(GROUP_NAME.'/Database/clear')}', '确实要彻底删除选择项吗？')" class="btn_orange" value="彻底删除"><?php endif; ?>


            
        </div>
    </div>
    <div class="list">    
    <form action="/<?php echo ($module); ?>/Database/backup" method="post" id="form_do" name="form_do">
        <table width="100%">
            <tr>
				<th><input  name="chkall" type="checkbox" id="chkall" onClick="selectall(this.form)"></th>
                <th>表名</th>
                <th>表用途</th>
                <th>记录行数</th>
                <th>引擎</th>
                <th>字符集</th>
                <th>表大小</th>
                <th>操作</th>
            </tr>
			<?php if(is_array($vlist)): foreach($vlist as $key=>$v): ?><tr>
                <td><input type="checkbox" name="key[]" value="<?php echo ($v["name"]); ?>"></td>
                <td class="aleft"><?php echo ($v["name"]); ?></td>
                <td><?php echo ($v["comment"]); ?></td>
                <td><?php echo ($v["rows"]); ?></td>
                <td><?php echo ($v["engine"]); ?></td>
                <td><?php echo ($v["collation"]); ?></td>
                <td><?php echo ($v["size"]); ?></td>
                <td>
				
				<a href="/<?php echo ($module); ?>/Database/optimize/tablename/<?php echo ($v["name"]); ?>">优化</a>
				<a href="/<?php echo ($module); ?>/Database/repair/tablename/<?php echo ($v["name"]); ?>">修复</a>       
				</td>
            </tr><?php endforeach; endif; ?>
        </table>
        <div class="th" style="clear: both;">数据库中共有<?php echo ($tableNum); ?>张表，共计<?php echo ($total); ?></div>
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