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

    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?38d06b2fdb163e085dc218a46182de6a";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
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
        <td height="31"><div class="titlebt">会员积分</div></td>
      </tr>
    </table>

<div class="main">
     <div style="margin:10px 0 0 15px;font-size:16px;">可用现金:<?php if($u['user_xianjin']): echo ($u["user_xianjin"]); else: ?>0<?php endif; ?></div>
    <div class="list">
        <table width="100%">
            <tr>
                <th>操作时间</th>
                <th>操作明细</th>
                <th>操作现金</th>
                <th>剩余现金</th>
            </tr>
            <?php if(empty($cash)): ?><tr>
            <td colspan="10"><div align="center">本区域暂无数据显示...</div></td>
            </tr>
            <?php else: ?> 
            
            <?php if(is_array($cash)): $i = 0; $__LIST__ = $cash;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ca): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo (date('Y-m-d H:i:s',$ca["jifen_date"])); ?></td>
                <td><?php echo ($ca["ly"]); ?></td>
                <td><?php echo ($ca["jf"]); ?></td>
                <td><?php echo ($ca["jifen_shengyu"]); ?></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?> 
            
        </table>
    </div>
    <div style="margin:10px 0 0 15px;font-size:16px;">可用积分:<?php if($u['user_keyongjf']): echo ($u["user_keyongjf"]); else: ?>0<?php endif; ?></div>
    <div class="list">
        <table width="100%">
            <tr>
                <th>操作时间</th>
                <th>操作明细</th>
                <th>操作积分</th>
                <th>剩余积分</th>
            </tr>
            <?php if(empty($k)): ?><tr>
            <td colspan="10"><div align="center">本区域暂无数据显示...</div></td>
            </tr>
            <?php else: ?> 
            
            <?php if(is_array($k)): $i = 0; $__LIST__ = $k;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$kv): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo (date('Y-m-d H:i:s',$kv["jifen_date"])); ?></td>
                <td><?php echo ($kv["ly"]); ?></td>
                <td><?php echo ($kv["jf"]); ?></td>
                <td><?php echo ($kv["jifen_shengyu"]); ?></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?> 
            
        </table>
    </div>
    <div style="margin:10px 0 0 15px;font-size:16px;">充值积分:<?php if($u['user_baodanjifen']): echo ($u["user_baodanjifen"]); else: ?>0<?php endif; ?></div>
    <div class="list">
        <table width="100%">
            <tr>
                <th>操作时间</th>
                <th>操作明细</th>
                <th>操作积分</th>
                <th>剩余积分</th>
            </tr>
            <?php if(empty($cz)): ?><tr>
            <td colspan="10"><div align="center">本区域暂无数据显示...</div></td>
            </tr>
            <?php else: ?> 
            
            <?php if(is_array($cz)): $i = 0; $__LIST__ = $cz;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cv): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo (date('Y-m-d H:i:s',$cv["jifen_date"])); ?></td>
                <td><?php echo ($cv["ly"]); ?></td>
                <td><?php echo ($cv["jf"]); ?></td>
                <td><?php echo ($cv["jifen_shengyu"]); ?></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?> 
            
        </table>
    </div>
    <div style="margin:10px 0 0 15px;font-size:16px;">分享积分:<?php if($u['user_fenxiangjf']): echo ($u["user_fenxiangjf"]); else: ?>0<?php endif; ?></div>
    <div class="list">
        <table width="100%">
            <tr>
                <th>操作时间</th>
                <th>操作明细</th>
                <th>操作积分</th>
                <th>剩余积分</th>
            </tr>
            <?php if(empty($f)): ?><tr>
            <td colspan="10"><div align="center">本区域暂无数据显示...</div></td>
            </tr>
            <?php else: ?> 
            
            <?php if(is_array($f)): $i = 0; $__LIST__ = $f;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$fv): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo (date('Y-m-d H:i:s',$fv["jifen_date"])); ?></td>
                <td><?php echo ($fv["ly"]); ?></td>
                <td><?php echo ($fv["jf"]); ?></td>
                <td><?php echo ($fv["jifen_shengyu"]); ?></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?> 
            
        </table>
    </div>
    <div style="margin:10px 0 0 15px;font-size:16px;">待用积分:<?php if($u['user_daiyongjf']): echo ($u["user_daiyongjf"]); else: ?>0<?php endif; ?></div>
    <div class="list">
        <table width="100%">
            <tr>
                <th>操作时间</th>
                <th>操作明细</th>
                <th>操作积分</th>
                <th>剩余积分</th>
            </tr>
            <?php if(empty($d)): ?><tr>
            <td colspan="10"><div align="center">本区域暂无数据显示...</div></td>
            </tr>
            <?php else: ?> 
            
            <?php if(is_array($d)): $i = 0; $__LIST__ = $d;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dv): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo (date('Y-m-d H:i:s',$dv["jifen_date"])); ?></td>
                <td><?php echo ($dv["ly"]); ?></td>
                <td><?php echo ($dv["jf"]); ?></td>
                <td><?php echo ($dv["jifen_shengyu"]); ?></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?> 
            
        </table>
    </div>
    
    
     <div style="margin:10px 0 0 15px;font-size:16px;">赠送积分:<?php if($u['user_zengsongjifen']): echo ($u["user_zengsongjifen"]); else: ?>0<?php endif; ?></div>
    <div class="list">
        <table width="100%">
            <tr>
                <th>操作时间</th>
                <th>操作明细</th>
                <th>操作积分</th>
                <th>剩余积分</th>
            </tr>
            <?php if(empty($d)): ?><tr>
            <td colspan="10"><div align="center">本区域暂无数据显示...</div></td>
            </tr>
            <?php else: ?> 
            
            <?php if(is_array($zengsong)): $i = 0; $__LIST__ = $zengsong;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dv): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo (date('Y-m-d H:i:s',$dv["jifen_date"])); ?></td>
                <td><?php echo ($dv["ly"]); ?></td>
                <td><?php echo ($dv["jf"]); ?></td>
                <td><?php echo ($dv["jifen_shengyu"]); ?></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?> 
            
        </table>
    </div>
    
    
    
    
    <div style="margin:10px 0 0 15px;font-size:16px;">爱国消费积分:<?php if($u['user_agxfq']): echo ($u["user_agxfq"]); else: ?>0<?php endif; ?></div>
    <div class="list">
        <table width="100%">
            <tr>
                <th>操作时间</th>
                <th>操作明细</th>
                <th>操作积分</th>
                <th>剩余积分</th>
            </tr>
            <?php if(empty($ag)): ?><tr>
            <td colspan="10"><div align="center">本区域暂无数据显示...</div></td>
            </tr>
            <?php else: ?> 
            
            <?php if(is_array($ag)): $i = 0; $__LIST__ = $ag;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$agv): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo (date('Y-m-d H:i:s',$agv["jifen_date"])); ?></td>
                <td><?php echo ($agv["ly"]); ?></td>
                <td><?php echo ($agv["jf"]); ?></td>
                <td><?php echo ($agv["jifen_shengyu"]); ?></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?> 
            
        </table>
    </div>
    <div style="margin:10px 0 0 15px;font-size:16px;">爱心消费积分:<?php if($u['user_axxfq']): echo ($u["user_axxfq"]); else: ?>0<?php endif; ?></div>
    <div class="list">
        <table width="100%">
            <tr>
                <th>操作时间</th>
                <th>操作明细</th>
                <th>操作积分</th>
                <th>剩余积分</th>
            </tr>
            <?php if(empty($d)): ?><tr>
            <td colspan="10"><div align="center">本区域暂无数据显示...</div></td>
            </tr>
            <?php else: ?> 
            
            <?php if(is_array($ax)): $i = 0; $__LIST__ = $ax;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$axv): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo (date('Y-m-d H:i:s',$axv["jifen_date"])); ?></td>
                <td><?php echo ($axv["ly"]); ?></td>
                <td><?php echo ($axv["jf"]); ?></td>
                <td><?php echo ($axv["jifen_shengyu"]); ?></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?> 
            
        </table>
    </div>
    <div style="margin:10px 0 0 15px;font-size:16px;">平台维护积分:<?php if($u['user_ptwhf']): echo ($u["user_ptwhf"]); else: ?>0<?php endif; ?></div>
    <div class="list">
        <table width="100%">
            <tr>
                <th>操作时间</th>
                <th>操作明细</th>
                <th>操作积分</th>
                <th>剩余积分</th>
            </tr>
            <?php if(empty($d)): ?><tr>
            <td colspan="10"><div align="center">本区域暂无数据显示...</div></td>
            </tr>
            <?php else: ?> 
            
            <?php if(is_array($px)): $i = 0; $__LIST__ = $px;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pv): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo (date('Y-m-d H:i:s',$pv["jifen_date"])); ?></td>
                <td><?php echo ($pv["ly"]); ?></td>
                <td><?php echo ($pv["jf"]); ?></td>
                <td><?php echo ($pv["jifen_shengyu"]); ?></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?> 
            
        </table>
    </div>
    <div style="margin:10px 0 0 15px;font-size:16px;">消费奖励积分:<?php if($u['user_xfjl']): echo ($u["user_xfjl"]); else: ?>0<?php endif; ?></div>
    <div class="list">
        <table width="100%">
            <tr>
                <th>操作时间</th>
                <th>操作明细</th>
                <th>操作积分</th>
                <th>剩余积分</th>
            </tr>
            <?php if(empty($d)): ?><tr>
            <td colspan="10"><div align="center">本区域暂无数据显示...</div></td>
            </tr>
            <?php else: ?> 
            
            <?php if(is_array($xx)): $i = 0; $__LIST__ = $xx;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$xv): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo (date('Y-m-d H:i:s',$xv["jifen_date"])); ?></td>
                <td><?php echo ($xv["ly"]); ?></td>
                <td><?php echo ($xv["jf"]); ?></td>
                <td><?php echo ($xv["jifen_shengyu"]); ?></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?> 
            
        </table>
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