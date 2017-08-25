<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo ($config["config_webname"]); ?>-爱国消费券</title>
<meta name="keywords" content="<?php echo ($config["config_webkw"]); ?>"/>
<meta name="description" content="<?php echo ($config["config_cp"]); ?>" />
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/herder.css">
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/member.css">
<meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<script src="/Public/Mobile/Shangchengpc/js/jquery-2.1.4.min.js"></script>
<script>
$(function () {
	Next();
});
function Next() {
	$.ajax({
		type: "post", url: "/upp.html",
		data: {"pageIndex": $("#lblPageIndex").html()},
		async: false, dataType: "json", success: function (data) {
			if (data.code == "1") {
				if (data.data_info == "") { $(".loadMore").html("<a href=\"javasript:void(0)\">没有更多信息了</a>"); } else {
					$("#tbody").append(data.data_info);
					$("#lblPageIndex").html(parseInt($("#lblPageIndex").html()) + 1);
					//$("#pro_title").html(data.title);
				}
			} else {
				$(".loadMore").html("<a href=\"javasript:void(0)\">没有更多信息了</a>");
			}
		}
	});
}
</script>
</head>
<body>
<div class="box-member">
   <div class="header">
		<div class="header-1"><a href="/u.html"></a></div>
		<div class="header-2" id="pro_title">爱国消费券明细</div>
   </div>
   <div class="box-member-1">
		<label id="lblPageIndex" style="display:none;">1</label>
		<table class="gridtable" id="tbody">
			<tbody><tr>
				<th>操作时间</th>
				<th>操作明细</th>  
				<th>操作积分</th>
				<th>剩余积分</th>
			</tr></tbody>
		</table>
		<div style="text-align:center" class="loadMore"><a href="javasript:void(0)" onclick="Next()">加载更多</a></div>
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
</body>
</html>