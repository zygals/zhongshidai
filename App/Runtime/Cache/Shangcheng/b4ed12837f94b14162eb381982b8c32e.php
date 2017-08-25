<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo ($config["config_webname"]); ?>-购物中心</title>
<meta name="keywords" content="<?php echo ($config["config_webkw"]); ?>"/>
<meta name="description" content="<?php echo ($config["config_cp"]); ?>" />
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/herder.css">

<link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/shopping.css">
<meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<script type="text/javascript" src="/Public/Mobile/Shangchengpc/js/jquery-2.1.4.min.js"></script>
</head>
<body>
<div class="box-two">
	<div class="box-twoa" style="margin-bottom:80px;">
		<div class="header">
			<div class="header-1"><a href="/"></a></div>
			<div class="header-2">购物中心</div>
		</div>
		<label id="lblPageIndex" style="display:none;">2</label>
		<div id="divHtml">
			<span class="box-two-1">
				<i></i>
				<h5>商品分类 </h5>
			</span>
			<div class="box-two-2">
				<img src="/Public/Mobile/Shangchengpc/images/20160922130914.jpg" alt="" width="100%" height="auto">
			</div>
			<div class="box-two-3">
				<ul>
					<?php if(is_array($fl)): foreach($fl as $key=>$v): ?><li><a href="/p/f/<?php echo ($v["id"]); ?>.html"><?php echo ($v["name"]); ?></a></li><?php endforeach; endif; ?>
				</ul>
			</div>
		</div>
	</div>
		<div class="last">
		<ul>
			<li>
				<a href="/">
					 <i><img src="/Public/Mobile/Shangchengpc/images/foot1_on.png" height="20" width="20" alt=""></i>
					 <span style="font-size:10px;">首页</span>
				 </a>
			</li>
			<!--<li>
				 <a href="/gz.html">
					 <i><img src="/Public/Mobile/Shangchengpc/images/0a-2.png" height="20" width="20" alt=""></i>
					 <span style="font-size:10px;">商品分类</span>
				 </a>
			</li>-->
            
            <li>
				 <a href="/gg.html">
					 <i><img src="/Public/Mobile/Shangchengpc/images/0a-5.png" height="20" width="20" alt=""></i>
					 <span style="font-size:10px;">公告资讯</span>
				 </a>
			</li>
            
			<li>
				 <a href="/gw.html">
					 <i><img src="/Public/Mobile/Shangchengpc/images/0a-3.png" height="20" width="20" alt=""></i>
					 <span style="font-size:10px;">购物车</span>
				 </a>
			</li>
			<li>
				 <a href="/u.html">
					 <i><img src="/Public/Mobile/Shangchengpc/images/0a-4.png" height="20" width="20" alt=""></i>
					 <span style="font-size:10px;">会员中心</span>
				 </a>
			</li>
		</ul>
	</div>
</div>
</body>
</html>