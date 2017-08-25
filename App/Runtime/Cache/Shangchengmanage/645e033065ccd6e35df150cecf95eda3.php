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
<style>
.form dt {line-height: 8px;}
.form  input { margin-left:12px;}
</style>
<table width="100%" height="31px" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
      <tr>
        <td height="31"><div class="titlebt">添加分类</div></td>
      </tr>
    </table>
<div class="main">
<form method="post" name="zzjs_net">
<input type="hidden" name="id" value="<?php echo ($data["id"]); ?>" />
	<div class="form">
		<dl>
			<dt> 订单号：</dt>
			<dd>
				<?php echo ($data["dingdanhao"]); ?>
			</dd>
		</dl>
		<dl>
			<dt> 会员：</dt>
			<dd>
				<?php echo ($user["user_name"]); ?>
			</dd>
		</dl>
		<dl>
			<dt> 会员编号：</dt>
			<dd>
				<?php echo ($user["user_login_bh"]); ?>
			</dd>
		</dl>
		<dl>
			<dt> 商品：</dt>
			<dd>
				<?php if(is_array($goods)): foreach($goods as $key=>$v): ?><div>
					<div style="float:left;"><img src="<?php echo ($v["pic1"]); ?>" style="width:72px;height:72px;"></div>
					<div style="float:left;margin-left:10px;line-height:35px;">
						<div><?php echo ($v["name"]); ?>:<?php echo ($v["guige"]); ?></div>
						<div><?php echo ($v["jifen"]); ?>*<?php echo ($v["num"]); ?></div>
					</div>
				</div><?php endforeach; endif; ?>
			</dd>
		</dl>
		<dl>
			<dt> 订单总额：</dt>
			<dd>
				<?php echo ($data["yingfukuan"]); ?>积分
			</dd>
		</dl>
		<dl>
			<dt> 奖励积分：</dt>
			<dd>
				<?php echo ($data["jianglijifen"]); ?>积分
			</dd>
		</dl>
		<dl>
			<dt> 收货人姓名：</dt>
			<dd>
				<?php echo ($dizhi["name"]); ?>
			</dd>
		</dl>
		<dl>
			<dt> 收货电话：</dt>
			<dd>
				<?php echo ($dizhi["mobile"]); ?>
			</dd>
		</dl>
		<dl>
			<dt> 收货人邮编：</dt>
			<dd>
				<?php echo ($dizhi["youbian"]); ?>
			</dd>
		</dl>
		<dl>
			<dt> 收货地址：</dt>
			<dd>
				<?php echo ($dizhi["sheng"]); ?> <?php echo ($dizhi["shi"]); ?> <?php echo ($dizhi["qu"]); ?> <?php echo ($dizhi["dizhi"]); ?> 
			</dd>
		</dl>
		<dl>
			<dt> 订单状态：</dt>
			<dd>
				<?php echo ($data["dtype"]); ?>
			</dd>
		</dl>
		<dl>
			<dt> 商品状态：</dt>
			<dd>
            <input type="radio" name="box[]"  value="0" <?php if($data['good_type'] == 0): ?>checked="checked"<?php endif; ?>/>待发货
            <input type="radio" name="box[]"  value="1"<?php if($data['good_type'] == 1): ?>checked="checked"<?php endif; ?>/>待收货
            <input type="radio" name="box[]"  value="2"<?php if($data['good_type'] == 2): ?>checked="checked"<?php endif; ?>/>已完成
            <input type="radio" name="box[]"  value="3" <?php if($data['good_type'] == 3): ?>checked="checked"<?php endif; ?>/>退货
			</dd>
		</dl>
        <dl>
			<dt> 备注信息：</dt>
			<dd>
				<?php echo ($data["beizhu"]); ?>
			</dd>
		</dl>
		<dl>
			<dt> 提交时间：</dt>
			<dd>
				<?php echo (date('Y-m-d H:i:s',$data["date"])); ?>
			</dd>
		</dl>
		<div class="form_b">
			<input type="submit" class="btn_blue"  value="发 货">
		</div>
	</div>
    </form>
</div>
<!--<div style="height:50px;"></div>
<div class="cont-ft">
            <div class="copyright">
                <div class="fl">感谢使用XX商城企业后台管理系统</div>
            </div>
</div>-->
<script>
function fh(a){
	window.location.href='/shangchengmanage/dingdan/fahuo/id/'+a;
}
</script>
</body>
</html>