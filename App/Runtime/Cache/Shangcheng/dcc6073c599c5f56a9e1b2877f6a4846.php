<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo ($config["config_webname"]); ?>-商品详情</title>
<meta name="keywords" content="<?php echo ($config["config_webkw"]); ?>"/>
<meta name="description" content="<?php echo ($config["config_cp"]); ?>" />
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/herder.css">
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/details.css">
<meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<script src="/Public/Mobile/Shangchengpc/js/jquery-2.1.4.min.js"></script>
<link href="/Public/Mobile/Shangchengpc/css/commstyle.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/herder.css">
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/details.css">
<style>
.pro_box li {
	color: #ff5000;
}
.product_size h5 {
	padding: 0 10px;
	line-height: 40px;
	font-size: 14px;
	color: #666;
	font-weight: normal;
}
.product_size .product_size_choice {
	padding: 0 10px;
}
.product_size .product_size_choice a {
	color: #333;
	border: 1px solid #ccc;
	line-height: 30px;
	padding: 0 10px;
	margin: 5px;
	display: block;
	float: left;
	font-size: 12px;
	border-radius: 5px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
}
.product_size .product_size_choice .select {
	background: #ff3300;
	color: #fff;
	text-decoration: none;
}
.productll img{ width:100%}
</style>
</head>
<body>
<div class="box-four">
	<div class="box-foura">
		<div class="header">
			<div class="header-1"><a href="javascript:history.go(-1)"></a></div>
			<div class="header-2">商品详情</div>
		</div>
		<div class="box-four-1">
			<div class="hezi" id="pro_img"><p><img src="<?php echo ($d["pic_arr"]); ?>"><i></i></p></div>
		</div>
		<span class="box-four-2" id="pro_name"><?php echo ($d["name"]); ?></span>
		<div class="box-four-4">
			<ul class="pro_box">
				<li >
					<label><input type="radio" name="buy_type" value="1" checked>
						可用积分：<?php echo ($d["jifen"]); ?> + 现金：<?php echo ($d["xianjing"]); ?>元</label></li>
				<li >
					<label><input type="radio" name="buy_type" value="2">
						爱国消费积分：<?php echo ($d["agxfq"]); ?> + 现金：<?php echo ($d["xianjing"]); ?>元</label></li>
                <?php if($d["xf_fl"] == 2): ?><!--	<li id="pro_ProDaiYong">奖励积分：<?php echo ($d["jifen"]); ?> 积分</li>--><?php endif; ?>
				<li id="pro_ProCount">库存剩余：<?php echo ($d["sy"]); ?></li>
				<li id="pro_ProSoldCount">已售：<?php echo ($d["xiaoshou"]); ?></li>
			</ul>
		</div>
		<div class="product_size hidden_add">
			<h5>商品规格</h5>
			<div class="product_size_choice hidden_add"><a href="javascript:void(0)" data_sizeprice="3600" data_psguid="<?php echo ($d["id"]); ?>" class="select"><?php echo ($d["guige"]); ?></a></div>
		</div>
		<div class="box-four-4">
			<ul>
				<li>
					<a href="javascript:void(0)">商家详情</a>
					<a href="javascript:void(0)" class="r-a">
						<img src="/Public/Mobile/Shangchengpc/images/elever-2.gif" height="18" width="10" alt="">
					</a>
				</li>
			</ul>
		</div>
		<div class="box-four-5">
			<ul>
				<li class="box-four-5a">
					<a href="javascript:void(0)" onclick="GetCartAdd(1)">加入购物车</a>
				</li>
				<li>
					<a href="javascript:void(0)" onclick="GetCartAdd(2)">去结算</a>
				</li>
			</ul>
		</div>
		<span class="box-four-6">商品详情 
		</span>
		<div class="box-four-7" id="pro_desc" ><div class="productll"><?php echo ($d["content"]); ?></div></div>
		<input type="hidden" id="bh" value="<?php echo ($bh); ?>"><input type="hidden" id="kc" value="<?php echo ($d["sy"]); ?>">
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
function GetCartAdd(add_type) {
    var bh = $("#bh").val();
	var kc=$('#kc').val();  //库存量
	var buy_type = $('input[name="buy_type"]:checked').val();
	if(bh==''){
		alert('请先登陆');
		window.location.href = "/l.html";
	}
	if(kc<1){
		alert('该商品暂时无货，敬请期待');
		return false;
	}
    $.ajax({
        type: "post", url: "/ga.html",
        data: {"bh": bh, "countStr": 1, "idStr": $(".product_size_choice .select").attr("data_psGuid"),pay_type:buy_type },
        async: false, dataType: "json", success: function (data) {
            if (data.code == 1) {
                if(add_type==1){
                    alert("加入成功！");
                }else{
                    alert("去购物车结算");
                    if(buy_type==1){ //积分+现金 购物车
                        window.location.href = "/gw.html";
                    }else{
                        window.location.href = "/gw1.html";
                    }
				}
            } else {
                alert(data.msg);
            }
        }
    });

}/*
function GoCartAdd() {
    var bh = $("#bh").val();
	var kc=$('#kc').val();
	if(bh==''){
		alert('请先登陆');
		window.location.href = "/l.html";
	}
	if(kc<1){
		alert('该商品暂时无货，敬请期待');
		return false;
	}
    $.ajax({
        type: "post", url: "/ga.html",
        data: {"bh": bh, "countStr": 1, "idStr": $(".product_size_choice .select").attr("data_psGuid") },
        async: false, dataType: "json", success: function (data) {                         
            if (data.code == 1) {
                alert("去购物车结算");
 				if(data.xf_fl==1){
                	window.location.href = "/gw1.html";
                }else{
                	window.location.href = "/gw.html";
                }


            } else { alert(data.msg); }
        }
    });

}*/
</script>
</body>
</html>