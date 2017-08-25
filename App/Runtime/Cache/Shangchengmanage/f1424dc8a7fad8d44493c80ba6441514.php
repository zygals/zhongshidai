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

<script src="/App/Shangchengmanage/View/Default/js/common.js" type="text/javascript"></script>
 <script type="text/javascript">
  function clear_del()
  {
   if(confirm("确定要删除数据吗？"))
   {
	subform('/shangchengmanage/user/delall');
   }
  }
 </script>

<table width="100%" height="31px" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
      <tr>
        <td height="31"><div class="titlebt">商城总积分</div></td>
      </tr>
    </table>
<style type="text/css">
    .main div{height:45px;line-height:45px;border-bottom:1px solid #A5C6E5;}
</style>
<div class="main">
    <?php if(is_array($arrayjf)): $i = 0; $__LIST__ = $arrayjf;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s): $mod = ($i % 2 );++$i;?><div style="margin:10px 0 0 15px;font-size:16px;">
        <?php if($s['jifen_type'] == 1): ?>可用积分<?php endif; ?>
        <?php if($s['jifen_type'] == 4): ?>充值积分<?php endif; ?>
        <?php if($s['jifen_type'] == 3): ?>分享积分<?php endif; ?>
        <?php if($s['jifen_type'] == 2): ?>待用积分<?php endif; ?>
        <?php if($s['jifen_type'] == 5): ?>爱国消费积分<?php endif; ?>
        <?php if($s['jifen_type'] == 7): ?>爱心消费积分<?php endif; ?>
        <?php if($s['jifen_type'] == 6): ?>平台维护积分<?php endif; ?>
        <?php if($s['jifen_type'] == 8): ?>消费激励积分<?php endif; ?>
        <?php if($s['jifen_type'] == 9): ?>现金<?php endif; ?>:<?php echo ($s['sumjf']); ?></div><?php endforeach; endif; else: echo "" ;endif; ?>
    
    
</div>
<!--<div style="height:50px;"></div>
<div class="cont-ft">
            <div class="copyright">
                <div class="fl">感谢使用XX商城企业后台管理系统</div>
            </div>
</div>-->
</body>
</html>