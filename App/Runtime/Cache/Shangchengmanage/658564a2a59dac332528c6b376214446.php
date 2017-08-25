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
            subform('/shangchengmanage/goods/delall');
        }
    }
</script>
<table width="100%" height="31px" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
    <tr>
        <td height="31"><div class="titlebt">商品管理</div></td>
    </tr>
</table>

<div class="main">
    <div class="operate">
        <div class="left">
            <input type="button" onclick="window.open('/shangchengmanage/goods/add','main')" target="main" class="btn_blue" value="添加">
        </div>


        <div class="left_pad">
            <form method="get" action="/shangchengmanage/goods/search">
                <span> 商品分类：</span>
                <select name="fid">
                    <option value="">请选择</option>
                    <?php if(is_array($fl)): foreach($fl as $key=>$fl): ?><option value="<?php echo ($fl["id"]); ?>"><?php echo ($fl["name"]); ?></option><?php endforeach; endif; ?>
                </select>
                <input type="text" name="keyword" title="关键字" class="inp_default" >
                <input type="hidden" name="formhash" value="231cb4d8" />
                <input type="submit" class="btn_blue" value="查  询">
            </form>
        </div>

    </div>
    <div class="list">
        <table width="100%">
            <tr>
                <th>编号</th>
                <th>分类</th>
                <th>名字</th>
                <th>购买积分</th>
                <th>奖励积分</th>
                <th>库存</th>
                <th>限购数量</th>
                <th>系统预留</th>
                <th>销售数量</th>
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
                        <td><?php echo ($v["name"]); ?></td>
                        <td><?php echo ($v["jifen"]); ?></td>
                        <td><?php echo ($v["jiangli"]); ?></td>
                        <td><?php echo ($v["kucun"]); ?></td>
                        <td><?php echo ($v["xgnum"]); ?></td>
                        <td><?php echo ($v["xtyuliu"]); ?></td>
                        <td><?php echo ($v["xiaoshou"]); ?></td>
                        <td><?php if($v['is_show'] == 1): ?>显示<?php else: ?>不显示<?php endif; ?></td>
                        <td>
                            <a href="/shangchengmanage/goods/edit/id/<?php echo ($v["id"]); ?>">编辑</a>
                            <a href="/shangchengmanage/goods/del/id/<?php echo ($v["id"]); ?>" onclick="return confirm('是否确定删除?')">删除</a>
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