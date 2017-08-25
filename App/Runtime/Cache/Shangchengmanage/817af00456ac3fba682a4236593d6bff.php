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
	subform('/shangchengmanage/personal/delall');
   }
  }
 </script>

<table width="100%" height="31px" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
      <tr>
        <td height="31"><div class="titlebt">管理员列表</div></td>
      </tr>
    </table>

<div class="main">

    <div class="operate">
        <div class="left">
            <input type="button" onclick="window.open('/shangchengmanage/personal/add','main')" target="main" class="btn_blue" value="添加管理员">
				<input class="btn_blue" type="button" onClick="return clear_del();" value="删除" />      
        </div>
        <?php if(ACTION_NAME == "index"): ?><div class="left_pad">
            <form method="post" action="/shangchengmanage/personal/search">
                <input type="text" name="user_name" title="关键字" class="inp_default" value="<?php echo ($keyword); ?>">
                <input type="submit" class="btn_blue" value="查  询">
            </form>
        </div><?php endif; ?>
    </div>
    <div class="list">    
    <form action="<?php echo U(GROUP_NAME.'/Member/delAll');?>" method="post" id="form_do" name="form_do">
        <table width="100%">
            <tr>
                <th><input  name="chkall" type="checkbox" id="chkall" onclick="selectall(this.form)"></th>
                <th>编号</th>
				<th>用户名</th>
                <th>邮箱</th>
                <th>真实姓名</th>
                
                <th>登录时间</th>
                <th>登录ip</th>
				<th>登录次数</th>
                <th>权限状态</th>
				<th>锁定</th>
                <th>操作</th>
            </tr>
			<?php if(empty($vlist)): ?><tr>
			<td colspan="11"><div align="center">本区域暂无数据显示...</div></td>
			</tr>
			<?php else: ?> 
			
			<?php if(is_array($vlist)): $i = 0; $__LIST__ = $vlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
                <td><input type="checkbox" name="id[]" value="<?php echo ($v["id"]); ?>" ></td>
                <td><?php echo ($v["id"]); ?></td>
				 <td><?php echo ($v["admin_name"]); ?></td>
                <td><?php echo ($v["admin_email"]); ?></td>
                <td><?php echo ($v["admin_myname"]); ?></td>
                
                <td><?php echo (date('Y-m-d H:i:s',$v["admin_date"])); ?></td>
                <td><?php echo ($v["admin_ip"]); ?></td>
				<td><?php echo ($v["admin_login"]); ?></td>
                <td><?php if($v['admin_type']==1): ?><span style="color:#FF0000">普通管理员</span><?php else: ?><span style="color:#FF0000">超级管理员</span><?php endif; ?></td>
				
				<td><?php if($v['admin_ok']==1): ?><span style="color:#FF0000">是</span><?php else: ?>否<?php endif; ?></td>
                <td>
					<a href="/shangchengmanage/personal/listpass/id/<?php echo ($v["id"]); ?>">改密</a>
                    <a href="/shangchengmanage/personal/edit/id/<?php echo ($v["id"]); ?>">改信</a>
                    <a href="/shangchengmanage/personal/del/id/<?php echo ($v["id"]); ?>" onclick="return confirm('是否确定删除?')">删除</a>
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