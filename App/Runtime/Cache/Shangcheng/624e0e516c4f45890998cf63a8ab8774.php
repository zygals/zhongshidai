<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">
<title><?php echo ($config["config_webname"]); ?>-地址详情</title>
<meta name="keywords" content="<?php echo ($config["config_webkw"]); ?>"/>
<meta name="description" content="<?php echo ($config["config_cp"]); ?>" />
<meta name="description" content="">
<meta name="keywords" content="">
<link href="/Public/Mobile/Shangchengpc/css/commstyle.css" rel="stylesheet">
<link href="/Public/Mobile/Shangchengpc/css/herder.css" rel="stylesheet">
<link href="/Public/Mobile/Shangchengpc/css/m_adr.css" rel="stylesheet"> 
<script src="/Public/Mobile/Shangchengpc/js/jquery-2.1.4.min.js"></script>
<script>
$(function () {
	var str = location.href;
	var id = str.GetValue("id");
	$.ajax({
		type: "post", url: "/gad2.html",
		data: { "t": 'de', "idStr": id },
		async: false, dataType: "json", success: function (data) {
			if (data["state"] != "2") {
				$("#spUserName").html(data["userName"]);
				$("#spUserTel").html(data["userTel"]);
				$("#spUserArea").html( data["userArea"]);
				$("#spUserAddress").html(data["userAddress"]);
				$("#spUserKh").html(data["kh"]);
				$("#spUserKhm").html(data["khm"]);
				$("#spUserKhh").html(data["khh"]);
			} else {
				window.location.href = "/gad.html";
			}
		}
	});
})
String.prototype.GetValue = function (para) {
	var reg = new RegExp("(^|&)" + para + "=([^&]*)(&|$)");
	var r = this.substr(this.indexOf("\?") + 1).match(reg);
	if (r != null) return unescape(r[2]); return null;
};
function chkAddress(state){
	var str = location.href;
	var id = str.GetValue("id");
	if (state < 3) {
		if (confirm("是否确认修改？")) {
		$.ajax({
			type: "post", url: "/gad2.html",
			data: { "t": 'm', "idStr": id, "state": state },
			async: false, dataType: "json", success: function (data) {
				if (data["state"] == "1") {
					alert("处理成功");
					window.location.href = "/gad.html";
				} else {
					alert("设置失败，请重新登录尝试");
				}
			}
		});
		}
	} else {
		window.location.href = "/gea.html?id=" + id;
	}
}
</script>
<script>
function back(){
location.href=history.go(-1);
}
</script>
</head>
<body>


<div class="all_head">
	<div class="header">
		<div class="header-1"><a href="javascript:void(0)"  onclick='back()'></a></div>
		<div class="header-2">地址详情</div>
        <samp style=" position:relative; top:20px;"><a href="/"><img src="/Public/Mobile/Shangchengpc/images/zc_top_home.png" alt=""></a></samp>
	</div>
</div>
<div style="height:50px;"></div>
<div class="" style="line-height:30px;">
	<p><b class="fl">收货人:</b><span id="spUserName"></span></p>
	<p><b class="fl">手机号码:</b><span id="spUserTel"></span></p>
	<p><b class="fl">所在地区:</b><span id="spUserArea"></span></p>
	<p><b class="fl">详细地址:</b><span id="spUserAddress"></span></p>
	<!--<p><b class="fl">银行卡号:</b><span id="spUserKh"></span></p>
	<p><b class="fl">开户名:</b><span id="spUserKhm"></span></p>
	<p><b class="fl">开户行:</b><span id="spUserKhh"></span></p>-->
</div>
<ul class="address_delbtn">
	<li><a href="javascript:void(0)" onclick="chkAddress(3)">编辑</a></li>
	<li><a href="javascript:void(0)" onclick="chkAddress(2)">删除收货地址</a></li>
</ul>
<div class="address_addbtn">
	<a href="javascript:void(0)" onclick="chkAddress(1)">设为默认收货地址</a>
</div><!-- 不是默认地址的时候才出现 -->
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

</body></html>