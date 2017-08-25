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
	subform('/shangchengmanage/gonggao/delall');
   }
  }
 </script>
<table width="100%" height="31px" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
      <tr>
        <td height="31"><div class="titlebt">公告管理</div></td>
      </tr>
    </table>

<div class="main">
    <div class="operate">
        <div class="left">
            <input type="button" onclick="window.open('/shangchengmanage/gonggao/add','main')" target="main" class="btn_blue" value="添加">
        </div>
    </div>
    <div class="list">
        <table width="100%">
            <tr>
                <th>编号</th>
                <th>分类</th>
                <th>标题</th>
                <th>排序</th>
				<th>是否显示</th>
                <th>操作</th>
            </tr>
			<?php if(empty($vlist)): ?><tr>
			<td colspan="10"><div align="center">本区域暂无数据显示...</div></td>
			</tr>
			<?php else: ?> 
			
			<?php if(is_array($vlist)): $i = 0; $__LIST__ = $vlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($v["id"]); ?></td>
                <td><?php echo ($v["fenlei"]); ?></td>
                <td><?php echo ($v["title"]); ?></td>
                <td><?php echo ($v["paixu"]); ?></td>
                <td><?php if($v['is_show'] == 1): ?>显示<?php else: ?>不显示<?php endif; ?></td>
                <td>
                    <a href="/shangchengmanage/gonggao/edit/id/<?php echo ($v["id"]); ?>">编辑</a>
                    <a href="/shangchengmanage/gonggao/del/id/<?php echo ($v["id"]); ?>" onclick="return confirm('是否确定删除?')">删除</a>
				</td>
            </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </table>
		 <div class="green-black"><?php echo ($page); ?>总共<?php echo ($count); ?>条记录</div>
    
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