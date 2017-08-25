<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">
<title><?php echo ($config["config_webname"]); ?>-订单详情</title>
<meta name="keywords" content="<?php echo ($config["config_webkw"]); ?>"/>
<meta name="description" content="<?php echo ($config["config_cp"]); ?>" />
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/herder.css">
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/order details.css">
<meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<script src="/Public/Mobile/Shangchengpc/js/jquery-2.1.4.min.js"></script>
</head>
<body>
<div class="box-placea">
	<div class="header">
		<div class="header-1"><a href="/umd.html"></a></div>
		<div class="header-2">订单详情</div>
	</div>
	<div id="detail">
		
	</div>
		<div class="last">
		<ul>
			<li>
				<a href="/">
					 <i><img src="/Public/Mobile/Shangchengpc/images/foot1_on.png" height="20" width="20" alt=""></i>
					 <span style="font-size:10px;">首页</span>
				 </a>
			</li>
			<li>
				 <a href="/gz.html">
					 <i><img src="/Public/Mobile/Shangchengpc/images/0a-2.png" height="20" width="20" alt=""></i>
					 <span style="font-size:10px;">商品分类</span>
				 </a>
			</li>
            
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
$(function () {
	GetOrderPage();
})
String.prototype.GetValue = function (para) {
	var reg = new RegExp("(^|&)" + para + "=([^&]*)(&|$)");
	var r = this.substr(this.indexOf("\?") + 1).match(reg);
	if (r != null) return unescape(r[2]); return null;
};
function GetOrderPage() {
	var str = location.href;
	var id = str.GetValue("id");
    $.ajax({
        type: "post", url: "/gad2.html",
        data: { "t": "dt", "proid": id },
		async: false, dataType: "json", success: function (data) {//alert(data);
			if (data.code == 1) {
				$("#detail").html(data.data);
			} else { alert(data.msg); window.location.href = "/umd.html"; }
		}
        
    });
}
function GetProIsStateChange(proStr, proid) {
    if(confirm("确认收货吗")){
		$.ajax({
			type: "post", url: "/gad2.html",
			data: { "t": "s", "proid": proid},
			async: false, dataType: "json", success: function (data) {
				if (data.code == 1) {
					//$(proStr).html(GetIsStateName(data.isstate)).attr("onclick", "");
					$(proStr).html('订单完成').attr("onclick", "");
					alert("状态修改成功");
				} else { alert(data.msg); }
			}
		});
	}
}
</script>
</body>
</html>