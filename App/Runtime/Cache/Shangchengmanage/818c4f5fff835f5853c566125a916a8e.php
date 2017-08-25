<?php if (!defined('THINK_PATH')) exit();?>

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
<style>
.w50{
	width:50px;
}

</style>


<table width="100%" height="31px" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
      <tr>
        <td height="31"><div class="titlebt">隔代取酬管理</div></td>
      </tr>
</table>

<div class="main">
    <div class="operate">
        <div class="left">
             <a><input type="button" onclick="window.open('/shangchengmanage/gedaiquchou/add','main')" target="main"  class="btn_blue" value="添加隔代取酬"></a>
        </div>
    </div>
    <div class="list">
        <table width="100%">
            <tr>
                <th>编号</th>
                <th>推荐最少人数</th>
				<th>推荐最多人数</th>
				<th>隔代取酬比例</th>
                <th>操作</th>
            </tr>
			<?php if(empty($vlist)): ?><tr>
			<td colspan="10"><div align="center">本区域暂无数据显示...</div></td>
			</tr>
			<?php else: ?> 
			
			<?php if(is_array($vlist)): $i = 0; $__LIST__ = $vlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($v["id"]); ?></td>
                <td><?php echo ($v["min"]); ?>/人 </td>
                <td><?php echo ($v["max"]); ?>/人</td>
                <td><?php echo ($v["jiangli"]); ?>%</td>
                <td><a href="/shangchengmanage/gedaiquchou/edit/id/<?php echo ($v["id"]); ?>" >编辑</a><a href="/shangchengmanage/gedaiquchou/del/id/<?php echo ($v["id"]); ?>" onclick="return confirm('是否确定删除?')">删除</a></td>

				</td>
            </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?> 
			
        </table>
		 <div class="green-black"><?php echo ($page); ?>总共<?php echo ($count); ?>条记录</div>
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