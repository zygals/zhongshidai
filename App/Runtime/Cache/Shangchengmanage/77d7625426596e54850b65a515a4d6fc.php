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
<table width="100%" height="31px" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
    <tr>
        <td height="31">
            <div class="titlebt">编辑分类</div>
        </td>
    </tr>
</table>
<div class="main">
    <div class="form">
        <form method='post' action="/shangchengmanage/goodsfenlei/do_edit" enctype="multipart/form-data">
            <?php if($data['fid']!=0){?>
            <dl>
                <dt> 上级分类：</dt>
                <dd>
                    <select name="fid" id="">
                        <option value="0">--顶级--</option>
                        <?php foreach($list_ as $k=>$cate){?>
                        <option value="<?php echo ($cate["id"]); ?>" <?php echo $data['fid']==$cate['id']?'selected':''?> ><?php echo ($cate["name"]); ?></option>
                        <?php }?>
                    </select>
                </dd>
            </dl><?php }?>

            <dl>
                <dt> 分类名称：</dt>
                <dd>
                    <input type="text" name="name" class="inp_w250" value="<?php echo ($data["name"]); ?>"/>
                </dd>
            </dl>

            <dl>
                <dt> 是否显示：</dt>
                <dd>
                    <input type="radio" name="is_show" value="1"
                    <?php if($data['is_show'] == 1): ?>checked="checked"<?php endif; ?>
                    />是
                    &nbsp;&nbsp;
                    <input type="radio" name="is_show" value="2"
                    <?php if($data['is_show'] == 2): ?>checked="checked"<?php endif; ?>
                    />否
                </dd>
            </dl>

            <dl>
                <dt> 排序：</dt>
                <dd>
                    <input type="text" name="paixu" class="inp_w250" value="<?php echo ($data["paixu"]); ?>"/>
                </dd>
            </dl>

            <div class="form_b">

                <input type='hidden' name='user' value="<?php echo ($_SESSION['admin_name']); ?>"/>
                <input type="hidden" name="id" value="<?php echo ($data["id"]); ?>"/>
                <input type="submit" class="btn_blue" id="submit" value="提 交">
            </div>
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