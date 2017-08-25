<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<title><?php echo ($config["config_webname"]); ?>-消费服务中心</title>
<meta name="keywords" content="<?php echo ($config["config_webkw"]); ?>"/>
<meta name="description" content="<?php echo ($config["config_cp"]); ?>" />
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/herder.css">
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/service centre.css">
<meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<script src="/Public/Mobile/Shangchengpc/js/jquery-2.1.4.min.js"></script>
</head>
<body>
<div class="box-personal">
	<div class="header">
		<div class="header-1"><a href="javascript:history.go(-1)"></a></div>
		<div class="header-2">消费服务中心</div>
	</div>
	<div class="box-personal-1" style="margin-bottom:120px;">
		<form>
			<div class="a-1">
				<span>会员编号：</span>
				<input type="text" name="mobile" id="j_usernum" readonly="readonly" value="<?php echo ($user["user_login_bh"]); ?>"/>
			</div>
			<div class="a-1">
				<span>会员姓名：</span>
				<input type="text" name="mobile" id="j_username" readonly="readonly" value="<?php echo ($user["user_name"]); ?>"/>
			</div>
			<div class="a-1">
				<span>会员手机号码：</span>
				<input type="text" name="mobile" id="j_userphone" readonly="readonly" value="<?php echo ($user["user_phone"]); ?>"/>
			</div>
			<div class="a-1">
				<span>注册时间：</span>
				<input type="text" name="mobile" id="j_usertime" readonly="readonly" value="<?php echo (date('Y年m月d日 H时i分s秒',$user["user_date"])); ?>"/>
			</div>
			<!--<div class="a-1">
				<span>输入报单积分：</span>
				<input type="number" name="mobile" id="j_dou_money" />
			</div>-->
			<div class="a-4">
				<input type="hidden" name="mobile" id="proid" value="<?php echo ($user["user_login_bh"]); ?>"/>
				<a href="javascript:void(0)" id="j_douNext" onclick="Get_j_douNext()">
					<button type="button">下一步</button></a>
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
function Get_j_douNext() {
    var proid = $("#proid").val();
    //var money = $("#j_dou_money").val();
    //if (money.length > 0) {//alert("/ux3/proid/"+proid+"/point/"+money+".html");
		window.location.href = "/ux3/proid/"+proid+".html";
        //window.location.href = "m_DouThree.html?proid=" + proid + "&point=" + money;
    //} else { alert("请输入积分"); }
}
</script>
</body>
</html>