<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo ($config["config_webname"]); ?>-充值积分</title>
<meta name="keywords" content="<?php echo ($config["config_webkw"]); ?>"/>
<meta name="description" content="<?php echo ($config["config_cp"]); ?>" />
<title>世通易物商城</title>
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/herder.css">
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/integral transfer.css">
<meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<script src="/Public/Mobile/Shangchengpc/js/jquery-2.1.4.min.js"></script>
<!--<script src="/Public/Mobile/Shangchengpc/css/jquery.params.js"></script>
<script src="/Public/Mobile/Shangchengpc/css/j_bd.js"></script>-->
</head>
<body>
<div class="box-ten">
   <div class="header">
		<div class="header-1"><a href="/u.html"></a></div>
		<div class="header-2">充值积分转账</div>
   </div>
   <div class="box-ten-1">
		<form>
			<div class="a-1">
				<span>请输入接受会员编号</span>
			</div>
			 <div class="a-2">
				<input type="text" id="j_usernum" style="padding-left:5px;" placeholder="请输入接收会员编号">
			</div>
			<div class="a-4" onclick="Get_isBD_user()">
				<button type="button">下一步</button>
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
function Get_isBD_user() {
    var proid = $("#j_usernum").val();
    if (proid.length > 0) {
       window.location.href = "/ubjz2/proid/"+proid+".html";
    } else { alert("请输入会员编号"); }
}
</script>
</body>
</html>