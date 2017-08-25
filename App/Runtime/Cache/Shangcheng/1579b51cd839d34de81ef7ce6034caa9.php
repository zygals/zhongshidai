<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="yes" name="apple-touch-fullscreen">
    <meta content="telephone=no,email=no" name="format-detection">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
	<title>中时代-积分商城--下载中心</title>
	<script type="text/javascript" src="/Public/Mobile/Shangchengpc/js/rem.js"></script>
        <link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/herder.css">
	<link rel="stylesheet" href="/Public/Mobile/Shangchengpc/css/style.css">
</head>
<body>
	<div class="head">
		<div class="head_back"  onclick="window.history.back();"></div>
		<h2>下载中心</h2>
	</div>
	<div class="xizai">
		<div class="xizai_top">◆ 下载列表</div>
		<div class="xizai_con">
			<ul>
				<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><a href="<?php echo ($v['loadurl']); ?>"><li>
					<span></span>
					<div class="xizai_list">
						<h2><?php echo ($v['title']); ?></h2>
						<h3><?php echo (date("Y-m-d",$v['date'])); ?></h3>
					</div>
					<div class="xizai_img"><img src="/Public/Mobile/Shangchengpc/images/xiazai.png" width="100%" alt=""></div>
				</li></a><?php endforeach; endif; else: echo "" ;endif; ?>

			</ul>
		</div>
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