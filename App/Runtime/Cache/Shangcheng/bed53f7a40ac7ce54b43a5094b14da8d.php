<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo ($config["config_webname"]); ?>-提交成功</title>
<meta name="keywords" content="<?php echo ($config["config_webkw"]); ?>"/>
<meta name="description" content="<?php echo ($config["config_cp"]); ?>" />
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/herder.css">
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/submit successfully.css">
<meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<script src="/Public/Mobile/Shangchengpc/js/jquery-2.1.4.min.js"></script>
</head>
<body>
<div class="box-submit ">
   <div class="header">
		<div class="header-1"><a href="/md.html"></a></div>
		<div class="header-2">提交成功</div>
   </div>
   <div class="box-submit-1">
	 <span>感谢您在本店购物！</span>
	 <span>您的订单已经提交成功</span>
	 <span>您的订单号为：<i id="order_Num"></i></span>
   <span>您的应扣积分为：<i id="order_total"></i></span>
   <span>您的应扣现金为：<i id="order_xianjin"></i></span>
<!--	 <span>您的奖励积分为：<i id="order_jiangli"></i></span>-->
   <span id="order_ky"></span>
   </div>
   <div class="box-submit-2">
		<span>
		   <input type="password" placeholder="请输入二级密码" id="order_code">
		</span> 
   </div>
   <div class="box-submit-3">
		<button onclick="GetReadyOrderPay()">确认支付</button>
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

$(function () {
	GetPayReadyOrderPage();
})
String.prototype.GetValue = function (para) {
	var reg = new RegExp("(^|&)" + para + "=([^&]*)(&|$)");
	var r = this.substr(this.indexOf("\?") + 1).match(reg);
	if (r != null) return unescape(r[2]); return null;
};
function GetPayReadyOrderPage() {
	var str = location.href;
	var id = str.GetValue("id");
    $.ajax({
        type: "post", url: "/gad2.html",
        data: { "t": "dd", "proid": id },
		async: false, dataType: "json", success: function (data) {
            if (data.code == 1) {
                $("#order_Num").html(data.OrderNum);
                $("#order_total").html(data.OrderTotal+' 积分');
                $("#order_xianjin").html(data.yingkouxianjin+' 元');
               // $("#order_jiangli").html(data.jianglijifen+' 积分');
                if(data.shop_type==2){
                  $("#order_ky").html("注：应扣积分为爱国积分！");
                }
                if(data.shop_type==1){$("#order_ky").html("注：应扣积分为可用积分！");}
            } else { alert(data.msg); window.location.href = "/u.html"; }
        }
    });
}
function GetReadyOrderPay() {
	var str = location.href;
	var id = str.GetValue("id");//alert(id);
	var sendCode = $("#order_code").val(); //二级密码

    if (sendCode.length > 0) {
        if (confirm("是否确认支付？")) {
            $.ajax({
                type: "post", url: "/gad2.html",
                data: { "t": "z", "proid": id, "sendCode": sendCode },
				async: false, dataType: "json", success: function (data) {
                    if (data.code == 1) {
                        alert(data.msg);
                        window.location.href = data.url;
                    } else { alert(data.msg); }
                }
            });
        } 
    }else { alert("请输入二级密码"); }
}
</script> 
</body>
</html>