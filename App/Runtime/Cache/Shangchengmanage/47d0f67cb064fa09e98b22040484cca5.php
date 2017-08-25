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
            subform('/shangchengmanage/futou/delall');
        }
    }
</script>
<table width="100%" height="31px" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
    <tr>
        <td height="31"><div class="titlebt">复投审核</div></td>
    </tr>
</table>
<div class="main">
    <div class="operate">

        <?php if(ACTION_NAME == "index"): ?><div class="left_pad">
                <form method="get" action="/shangchengmanage/futou/search">
                    <input type="text" name="keyword" title="关键字" class="inp_default" value="">
                    <input type="hidden" name="formhash" value="231cb4d8" />
                    <input type="submit" class="btn_blue" value="查  询">
                </form>
            </div><?php endif; ?>
    </div>
    <div class="list">
            <table width="100%">
                <tr>
                    <th>申请者ID</th>
                    <th>积分数</th>
                    <th>返还日期</th>
                    <th>申请日期</th>
                    <th>期次</th>
                    <th>倍增数</th>
                    <th>状态</th>
                </tr>

                <?php if(empty($puser)): ?><tr>
                        <td colspan="10"><div align="center">本区域暂无数据显示...</div></td>
                    </tr>
                    <?php else: ?>
                    <?php if(is_array($puser)): $i = 0; $__LIST__ = $puser;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$kv): $mod = ($i % 2 );++$i;?><tr>
                            <td><?php echo getUserName($kv['bh']);?>(<?php echo ($kv['bh']); ?>)</td>
                            <td><?php echo ($kv['num']); ?></td>
                            <td><?php echo ($kv['fan_date']); ?></td>
                            <td><?php echo (date("Ymd H:i:s",$kv['tijiao_date'])); ?></td>
                            <td><?php echo ($kv['qici']); ?></td>
                            <td><?php echo ($kv['beizeng']); ?></td>
                            <td> <?php if($kv[status] == 0): ?><a href="<?php echo U('futoutongguo',array('id'=>$kv[id]));?>" style='color: red'>未审核</a>
                                <?php else: ?>
                                已审核<?php endif; ?>
                            </td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>

            </table>
            <div class="green-black"><?php echo ($page); ?></div>

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