<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="yes" name="apple-touch-fullscreen">
    <meta content="telephone=no,email=no" name="format-detection">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
	<title>中时代-积分商城-<?php echo ($dt["title"]); ?></title>
	<script type="text/javascript" src="/Public/Mobile/Shangchengpc/js/rem.js"></script>
	<link rel="stylesheet" href="/Public/Mobile/Shangchengpc/css/style.css">
        <link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/herder.css">

</head>
<body>
	<div class="head">
		<div class="head_back" onclick="window.location.href='/bz.html'"></div>
		<h2 >帮助中心</h2>
	</div>
	<div class="zhongji_top" style="height: 0.9rem; ">
		<h3  style="font-size:0.4rem"><?php echo ($dt["title"]); ?></h3>
	
	</div>
	<div class="zhongji_con" style="font-size:0.3rem" >
		<p><?php echo ($dt["content"]); ?></p>
	</div>





	<div style="height: 1.5rem"></div>
	<!-- 底部导航 -->
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

</body>
</html>