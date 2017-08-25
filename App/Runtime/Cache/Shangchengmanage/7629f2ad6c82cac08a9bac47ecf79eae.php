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
	subform('/shangchengmanage/banner/delall');
   }
  }
 </script>

<table width="100%" height="31px" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
      <tr>
	  <?php if($ifid==not): ?><td height="31"><div class="titlebt">查询结果</div></td>
	 <?php else: ?>
        <td height="31"><div class="titlebt">轮播管理</div></td><?php endif; ?>
      </tr>
    </table>

<div class="main">

    <div class="operate">
        <div class="left">
            <input type="button" onclick="window.open('/shangchengmanage/banner/add','main')" target="main" class="btn_blue" value="添加">    
        </div>
    </div>
    <div class="list">    
    <form action="/shangchengmanage/banner/sortcate" method="post" id="form_do" name="form_do">
        <table width="100%">
            <tr>
                <th>编号</th>
                <th>名称</th>
				<th>附件预览</th>
				<th>附件大小</th>            
				<th>开启状态</th>
                <th>操作</th>
            </tr>
			<?php if(empty($vlist)): ?><tr>
			<td colspan="10"><div align="center">本区域暂无数据显示...</div></td>
			</tr>
			<?php else: ?> 
			<?php if(is_array($vlist)): $i = 0; $__LIST__ = $vlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr style="height:95px;">
                <td><?php echo ($v["id"]); ?></td>
                <td><?php echo ($v["column_name"]); ?></td>
				<td>
				<?php if($v['column_images']): ?><a href="/Uploads/<?php echo ($v["column_images"]); ?>" target="_blank"><img src="<?php echo ($v["column_images"]); ?>" width="150px" height="50px" border="0" /></a>
				<?php else: ?>
				<img src="/App/Shangchengmanage/View/Default/Images/nopic.jpg" width="150px" height="50px" border="0" /><?php endif; ?>
				
				
				</td>
				<td><?php echo ($v["column_imgsize"]); ?></td>
                <td>
				<?php if($v['column_show']==1): ?><span style="color:#FF0000">开启</span>
				<?php else: ?>
				不开启<?php endif; ?>
				</td>
                <td>
                    <a href="/shangchengmanage/banner/edit/id/<?php echo ($v["id"]); ?>">编辑</a>
					<a href="/shangchengmanage/banner/del/id/<?php echo ($v["id"]); ?>" onclick="return confirm('是否确定删除?')">删除</a>
				</td>
            </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </table>
    </form>
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