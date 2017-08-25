<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<title><?php echo ($config["config_webname"]); ?>-收货地址</title>
<meta name="keywords" content="<?php echo ($config["config_webkw"]); ?>"/>
<meta name="description" content="<?php echo ($config["config_cp"]); ?>" />
<meta name="description" content="">
<meta name="keywords" content="">
<link href="/Public/Mobile/Shangchengpc/css/commstyle.css" rel="stylesheet">
<link href="/Public/Mobile/Shangchengpc/css/m_adr.css" rel="stylesheet">
<link href="/Public/Mobile/Shangchengpc/css/herder.css" rel="stylesheet">
<script src="/Public/Mobile/Shangchengpc/js/jquery-2.1.4.min.js"></script>
<script>
 $(function () {
	 $.ajax({
		 type: "post", url: "/gad2.html",
		 data: { "t": 'd'},
		 async: false, dataType: "json", success: function (data) {
			 if (data["state"] == "1") {
				 if (data["data"].length > 0) {
					 $("#ulHtml").append(data["data"]);
				 }
			 }
		 }
	 });
 });
</script>
</head>
<body>
<div class="all_head ">
	<div class="header">
			<div class="header-1"><a href="javascript:history.go(-1)"></a></div>
			<div class="header-2">地址管理</div>
             <samp style=" position:relative; top:20px;"><a href="/"><img src="/Public/Mobile/Shangchengpc/images/zc_top_home.png" alt=""></a></samp>
	</div>
</div>
<div style="height:20px;"></div>
<ul class="address_list" id="ulHtml">
</ul>
<div class="address_addbtn"><a href="/gad1.html">添加收货地址</a></div><br />
</body>
</html>