<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo ($config["config_webname"]); ?>-我的订单</title>
<meta name="keywords" content="<?php echo ($config["config_webkw"]); ?>"/>
<meta name="description" content="<?php echo ($config["config_cp"]); ?>" />
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/herder.css">
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/order.css">
<meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<script src="/Public/Mobile/Shangchengpc/js/jquery-2.1.4.min.js"></script>
</head>
<body>
<div class="box-fourteen">
   <div class="header">
		<div class="header-1"><a href="/u.html"></a></div>
		<div class="header-2">我的订单</div>
   </div>
   <div class="box-fourteen-1">
		<ul>
		   <li>
			 <a id="ord_0" href="/md.html">未支付</a>
			 <a id="ord_2" href="/umd.html" class="box-thirteen-1a-1">已完成</a>
			 <a id="ord_1" href="/md.html?id=3">已取消</a>
		   </li>
		</ul>
   </div>
	<div class="box-fourteen-2" id="pro_list">
	</div> 
	<div style="text-align:center;margin-bottom:100px;padding:10px;" class="loadMore">
		<a href="javascript:void(0)" id="m_show_more">查看更多</a><input type="hidden" id="m_indexCount" value="1">
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
var indexCount = 1;
$(function () {
	GetOrderInfo(1);
	$("#m_show_more").click(function () {
		var pageCount = $("#m_indexCount").val();
		if (pageCount > indexCount) {
			GetOrderInfo(pageCount); indexCount += 1;
		} else { $("#m_show_more").html("没有更多信息了"); }
	})
})
function GetOrderInfo(index) {
    //var proid = $.query.get("proid");
    $.ajax({
        type: "post", url: "/gad2.html",
        data: { "t": "y", "pageIndex": index/*, "cateid": proid*/ },
		async: false, dataType: "json", success: function (data) {
            if (data.code == 1) {
				$("#m_indexCount").val(data.count);
				if (index == 1) { $("#pro_list").html(data.data); } else { $("#pro_list").append(data.data); }
            }else if (data.code == 2) {
				$("#m_show_more").html("没有更多信息了");
            } else { alert(data.msg); window.location.href = "/u.html"; }
		}
    });
}
</script>
</body>
</html>