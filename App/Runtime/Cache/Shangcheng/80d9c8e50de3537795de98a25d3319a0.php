<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title id="mem_title"><?php echo ($zj); ?> 的直推会员</title>
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/herder.css">
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/member.css">
<meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<script src="/Public/Mobile/Shangchengpc/js/jquery-2.1.4.min.js"></script>
<!--<script src="/Public/Mobile/Shangchengpc/js/jquery.params.js"></script>-->
<script>
$(function () {
	/*var proid = $.query.get("proid");
	$.ajax({
		type: "post", url: "/app/get_wap_kjt.ashx",
		data: { "por": 125, "proid": proid },
		async: false, dataType: "json", success: function (data) {
			if (data["state"] == "1") {
				$("#mem_title,.header-2").html(data.name);
				$("#tbody").html(data["data"]);
			}
		}
	});*/
});
</script>
</head>
<body>
<div class="box-member">
	<div class="header">
		<div class="header-1"><a href="javascript:history.go(-1)"></a></div>
		<div class="header-2"><span style="color:#fff;"><?php echo ($zj); ?></span> 的直推会员</div>
	</div>
	<div class="box-member-1">

		<table class="gridtable" id="tbody"> 
			<tr><th>会员序号</th><th>会员编号</th> <th>会员姓名</th><th>手机号码</th><th>直推会员</th></tr>
			<?php if(is_array($zt)): foreach($zt as $key=>$v): ?><tr>
				<td><?php echo ($v["xh"]); ?></td>
				<td><?php echo ($v["user_login_bh"]); ?></td>
				<td><?php echo ($v["user_name"]); ?></td>
				<td><?php echo ($v["user_phone"]); ?></td>
				<td onclick="javascript:window.location.href='/uxz/bh/<?php echo ($v["user_login_bh"]); ?>.html'" style="color:#0C73AA;cursor:pointer;">直推会员</td></tr><?php endforeach; endif; ?>
		</table>
	 
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
</body>
</html>