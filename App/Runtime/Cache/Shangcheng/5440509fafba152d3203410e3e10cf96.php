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
<title><?php echo ($config["config_webname"]); ?>-添加收货地址</title>
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
	$.ajax({
		type: "post", url: "/gad2.html",
		data: { "t":'p' },
		async: false, dataType: "json", success: function (data) {
			if (data["state"] == "1") {
				if (data["data"].length > 0) {
					$("#selProvince").append(data["data"]);
				}
			}
		}
	});
});
function getArea(state,value){
	var value ;
	if (state == 1) {
		value = jQuery("#selProvince  option:selected").attr("data_id");
	} else {
		value = jQuery("#selCity  option:selected").attr("data_id");
	}
	if (value != "0") {
		$.ajax({
			type: "post", url: "/gad2.html",
			data: {"state": state, "idStr": value },
			async: false, dataType: "json", success: function (data) {
				if (state == 1) {
					jQuery("#selCity option[value!=0]").remove();
					$("#selCity").append(data["data"]);
				} else {
					jQuery("#selArea option[value!=0]").remove();
					$("#selArea").append(data["data"]);
				}
			}
		});
	}
}
function addAddress(){
	if($("#txtUserName").val().length >0 && $("#txtUserTel").val().length >0&& $("#txtAddress").val().length >0) {
		if ((/^1[3|4|5|7|8]\d{9}$/.test($("#txtUserTel").val()))) {
			$.ajax({
				type: "post", url: "/gad2.html",
				data: { "t": 'a', "userName": $("#txtUserName").val(), "userTel": $("#txtUserTel").val(), "userCode": $("#txtUserCode").val(), "userAddress": $("#txtAddress").val(), "proID": jQuery("#selProvince  option:selected").text(), "cityID": jQuery("#selCity  option:selected").text(), "areaID": jQuery("#selArea  option:selected").text(), "useKahao": $("#txt_kh").val(), "useKaihuhang": $("#txt_khh").val(), "useKaihuming": $("#txt_khm").val() },
				async: false, dataType: "json", success: function (data) {
					if (data["state"] == "1") {
						alert("添加成功");
						location.href = "/gad.html";
					} else {
						alert("登录失效，请先登录");
						location.href = "/l.html";
					}
				}
			});
		} else {
			alert("手机号格式有误");
		}
	} else {
		alert("信息请输入完整");
	}
}
</script>
</head>
<body>
<div class="all_head">
	<div class="header">
		<div class="header-1"><a href="javascript:history.go(-1)"></a></div>
		<div class="header-2">新增地址</div>
	</div>
</div>
<div class="addnew_addr fl">
	<form>
		<input type="text" placeholder="收货人姓名" class="addnew_addr_inp" id="txtUserName">
		<input type="text" placeholder="手机号" class="addnew_addr_inp" id="txtUserTel">
		<input type="text" placeholder="邮编" class="addnew_addr_inp" id="txtUserCode">
		<select name="" class="addnew_addr_select" id="selProvince" onchange="getArea(1,this)">
			<option selected="" value="0">请选择省份</option>
		</select>
		<select name="" class="addnew_addr_select" id="selCity" onchange="getArea(2,this)">
			<option selected="" value="0">请选择城市</option>
		</select>
		<select name="" class="addnew_addr_select" id="selArea">
			<option selected="" value="0">请选择区县</option>
		</select>
		<textarea name="" cols="" rows="" class="addnew_addr_txt" placeholder="请输入详细地址" id="txtAddress"></textarea>

		<!-- <input type="text" placeholder="银行卡号" class="addnew_addr_inp" id="txt_kh">
		<input type="text" placeholder="开户名" class="addnew_addr_inp" id="txt_khm">
		<input type="text" placeholder="开户行" class="addnew_addr_inp" id="txt_khh">-->
	</form>
</div>
<div class="addnew_addr_btn" onclick="addAddress()">保存</div>
</body>
</html>