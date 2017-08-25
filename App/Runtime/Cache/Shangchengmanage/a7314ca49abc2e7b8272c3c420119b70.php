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
<script src="/App/Shangchengmanage/View/Default/js/common.js" type="text/javascript"></script>
 <script type="text/javascript">
  function clear_del()
  {
   if(confirm("确定要删除数据吗？"))
   {
	subform('/shangchengmanage/fenhong/delall');
   }
  }
 </script>
<table width="100%" height="31px" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
      <tr>
        <td height="31"><div class="titlebt">分红管理</div></td>
      </tr>
    </table>
<div class="main">
    <div class="operate">
        <div class="left">
            <input type="hidden" onclick="window.open('/shangchengmanage/fenhong/add')" target="main" class="btn_blue" value="添加">
        </div>
    </div>
    <div class="list">    
    <form action="<?php echo U(GROUP_NAME.'/Member/delAll');?>" method="post" id="form_do" name="form_do">
        <table width="100%">
            <tr>
                <th>编号</th>
                <th>分红种类</th>
                <th>分红比例</th>
                <th>分红金额</th>
                <th>分红状态</th>
                <th>操作</th>
            </tr>
			<?php if(empty($fenhong)): ?><tr>
			<td colspan="10"><div align="center">本区域暂无数据显示...</div></td>
			</tr>
			<?php else: ?> 
			<?php if(is_array($fenhong)): $i = 0; $__LIST__ = $fenhong;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$fh): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($key+1); ?></td>
                <td><?php echo ($fh["name"]); ?></td>
                <td><?php echo ($fh["bili"]); ?></td>
                <td><?php echo ($fh["axjf_min"]); ?></td>
                <td><?php echo ($fh["status"]); ?></td>
                <td>
					<a href="/shangchengmanage/fenhong/fenhong/id/<?php echo ($fh["id"]); ?>">修改</a>
					<a href="/shangchengmanage/fenhong/del/id/<?php echo ($fh["id"]); ?>" style=" display:none;">删除</a>
				</td>
            </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?> 
        </table>
		 <div class="green-black"><?php echo ($page); ?></div>
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