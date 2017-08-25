<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title><?php echo ($config["config_webname"]); ?>-积分复投</title>
<meta name="keywords" content="<?php echo ($config["config_webkw"]); ?>"/>
<meta name="description" content="<?php echo ($config["config_cp"]); ?>" />
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/herder.css">
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/service centre1.css">
<meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<script src="/Public/Mobile/Shangchengpc/js/jquery-2.1.4.min.js"></script>
</head>
<body>
<div class="box-personal1">
   <div class="header">
		<div class="header-1"><a href="javascript:history.go(-1)"></a></div>
		<div class="header-2">积分复投</div>
   </div>
   <div class="box-personal1-1">
       <!--<?php if($dengji >= 2){ echo '/zjft.html'; }else{ echo '/ftzs.html';}?>-->
		<form method='post' id="form" action="/ftzs.html">
            <input type="hidden" value="<?php echo ($bh); ?>" name="fid"/>
			<div class="a-1">
				<span>输入复投积分：</span>
				<input type="text" name="futou" id="j_dou_money" placeholder="请输入复投积分" />
			</div>
			<div class="a-1">
				<span>输支付密码：</span>
				<input type="password" name="zfpassword" id="zf" placeholder="输入支付密码" />
			</div>
			<div class="a-4">
				<input type="hidden" name="proid" value="<?php echo ($ftbh); ?>"/>
				<a href="javascript:void(0)"  onclick="Get_tra_point()"  id="tra_point_sure"><button type="button">完成</button></a>
				<p  style="text-align:center;"> <img src="/Public/Mobile/Shangchengpc/images/loading.gif"  id="account_load"  style="display:none;" alt=""></p>
			</div>
		</form> 
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
<script>
//确定
function Get_tra_point() {
	if($('#j_dou_money').val()==''){
		alert('请输入可用积分');
		return false;
	}
	if($('#zf').val().length<5){
		alert('请核对支付密码');
		return false;
	}
	$('#form').submit();
}
</script>
</body>
</html>