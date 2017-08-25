<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="yes" name="apple-touch-fullscreen">
    <meta content="telephone=no,email=no" name="format-detection">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
	<title>中时代-积分商城-帮助中心</title>
	<script type="text/javascript" src="/Public/Mobile/Shangchengpc/js/rem.js"></script>
	<link rel="stylesheet" href="/Public/Mobile/Shangchengpc/css/style.css">
    <link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/herder.css">
</head>
<body>
	<div class="head">
		<div class="head_back"   onclick="window.location.href='/index.html'"></div>
		<h2>帮助中心</h2>
	</div>
	<div class="banner"><img src="/Public/Mobile/Shangchengpc/images/banner.jpg" alt=""></div>
	<div class="grxx fix">
		<div class="grxx_top">个人信息</div>
		<div class="grxx_bot">
			<ul>
				<?php if(is_array($geren)): $i = 0; $__LIST__ = $geren;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li><a href="/bzc/b/<?php echo ($v["id"]); ?>.html"><img src="<?php echo strippoit($v['img']); ?>" ><h3><?php echo ($v["title"]); ?></h3></a></li><?php endforeach; endif; else: echo "" ;endif; ?>

			</ul>
		</div>
	</div>
	<div class="grxx fix">
		<div class="grxx_top">个人中心</div>
		<div class="grxx_bot">
			<ul>
				<?php if(is_array($zhongxin)): $i = 0; $__LIST__ = $zhongxin;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li><a href="/bzc/b/<?php echo ($v["id"]); ?>.html"><img src="<?php echo strippoit($v['img']); ?>" alt=""><h3><?php echo ($v["title"]); ?></h3></a></li><?php endforeach; endif; else: echo "" ;endif; ?>

			</ul>
		</div>
	</div>

	<div class="grxx fix">
		<div class="grxx_top">帮助</div>
		<div class="grxx_bot">
			<ul>
				<?php if(is_array($bangzhu)): $i = 0; $__LIST__ = $bangzhu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li><a href="/bzc/b/<?php echo ($v["id"]); ?>.html"><img src="<?php echo strippoit($v['img']); ?>" alt=""><h3><?php echo ($v["title"]); ?></h3></a></li><?php endforeach; endif; else: echo "" ;endif; ?>

			</ul>
		</div>
	</div>
	<div class="grxx fix">
		<div class="grxx_top">购物</div>
		<div class="grxx_bot">
			<ul>
				<?php if(is_array($gouwu)): $i = 0; $__LIST__ = $gouwu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li><a href="/bzc/b/<?php echo ($v["id"]); ?>.html"><img src="<?php echo strippoit($v['img']); ?>" alt=""><h3><?php echo ($v["title"]); ?></h3></a></li><?php endforeach; endif; else: echo "" ;endif; ?>

			</ul>
		</div>
	</div>
	<div class="grxx fix">
		<div class="grxx_top">会员奖励</div>
		<div class="grxx_bot">
			<ul>
				<?php if(is_array($jiangli)): $i = 0; $__LIST__ = $jiangli;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li><a href="/bzc/b/<?php echo ($v["id"]); ?>.html"><img src="<?php echo strippoit($v['img']); ?>" alt=""><h3><?php echo ($v["title"]); ?></h3></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
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