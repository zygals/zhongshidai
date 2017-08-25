<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo ($config["config_webname"]); ?>-我的购物车</title>
<meta name="keywords" content="<?php echo ($config["config_webkw"]); ?>"/>
<meta name="description" content="<?php echo ($config["config_cp"]); ?>" />
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/herder.css">
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/shopping cart.css">
<meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<script src="/Public/Mobile/Shangchengpc/js/jquery-2.1.4.min.js"></script>
<style>
.cart_pro_count{margin-left:2%;vertical-align: middle;float:left; width: 80px; height: 28px; border: 1px solid #f0f0f0; border-radius: 5px; -webkit-border-radius: 5px; -moz-border-radius: 5px; overflow: hidden;}
.cart_pro_count input[type="button"]{width: 20px; height: 28px; background: none; border: none;}
.cart_pro_count input[type="text"]{width: 40px; height: 28px; text-align: center; border-left: 1px solid #f0f0f0; border-right: 1px solid #f0f0f0; box-sizing: border-box; border-top: none; border-bottom: none;}
.check {
font-size: 10px;
color: #ccc;
background: url(/Public/Mobile/Shangchengpc/images/check.png) 0 0 no-repeat;
background-size: 100%;
-webkit-appearance: none;
-moz-appearance: none;
border: 0;
border: none;
vertical-align: middle;
width: 15px;
height: 15px;
}
.checked{font-size:10px; color:#ccc; background:url(/Public/Mobile/Shangchengpc/images/checked.png) 0 0 no-repeat; background-size:100%; -webkit-appearance:none; -moz-appearance:none; border:0; border:none; vertical-align:middle; width:15px; height:15px;}
.fl {
float: left;
}
.delete{float: left;margin-left:20px;cursor:pointer;font-size: 1.2rem; color: #ff3300;}
</style>
</head>
<body>
<div class="box-vehicle" style="background-color:#eeeeee;">
	<div class="header">
		<div class="header-1"><a href="javascript:history.go(-1)"></a></div>
		<div class="header-2">我的购物车</div>
        <div class="header-3"><a href="/"></a></div>
	</div>
    
    <div class="box-eleven-gowuceh"> 
    <ul>
    <li>
	<span style=" font-size:1.0rem;"><font style=" font-size:1.0rem;">◆</font> <a href="/gw.html" style="color:#8c0001"><?php echo ($config["config_webname"]); ?>购物车</a></span>
	<span>----<a href="/gw1.html" style="color:#8c0001"><font style=" font-size:1.0rem;">◆</font>爱国消费购物车</a></span>
	</li>
   
    </ul>
    </div>
    
	<div class="box-vehicle-2ab">
		<div class="box-vehicle-2 " id="pro_car_list">
			<?php if(is_array($gwc1)): foreach($gwc1 as $key=>$gv): ?><div class="box-vehicle-2a" data_pro="<?php echo ($gv["id"]); ?>">
				<span class="box-vehicle-1b">
					<i>
						<form>
							<input class="check fl" type="checkbox" value="<?php echo ($gv["id"]); ?>" name="check_item">
						</form>
					</i>
					<a href="/d/b/<?php echo ($gv["gid"]); ?>">
						<img src="<?php echo ($gv["pic"]); ?>" alt="">
					</a>
					<div class="box-vehicle-1ba">
						<p><?php echo ($gv["gname"]); ?></p>
						<p>
							<a href="javascipt:void(0)" class="box-vehicle-1ba-1">爱国消费积分:<?php echo ($gv["agxfq"]); ?> + 现金:<?php echo ($gv["xj"]); ?> 元</a>
						</p>
						
					</div>
					<div class="cart_pro_count" style="margin-left:10px; margin-top:15px;">
						<input type="button" onclick="GetCartProCount(-1,<?php echo ($gv["id"]); ?>)" value="-" class="fl">
						<input type="text" data_cart="<?php echo ($gv["id"]); ?>" data_price="<?php echo ($gv["agxfq"]); ?>" data_xj="<?php echo ($gv["xj"]); ?>" value="<?php echo ($gv["num"]); ?>" onchange="GetCartChangeCount(-1,<?php echo ($gv["id"]); ?>)" class="fl">
						<input type="button" value="+" class="fl" onclick="GetCartProCount(1,<?php echo ($gv["id"]); ?>)"> 
					</div>
					<b class="fl" style="color:red; cursor:pointer;"></b>
					<b class="fl" style="color:red; cursor:pointer;"></b>
					<span style="color:red; margin-top:20px;" class="delete" onclick="GetCartProDel(<?php echo ($gv["id"]); ?>)">删除</span>
				</span>
			</div><?php endforeach; endif; ?>
		</div> 
	</div>
	<div class="box-vehicle2-2">
		<form>
			<input class="check_all check" type="checkbox">
			全选
			<a href="javascript:void(0)" onclick="GetCartSure()"><i class="box-vehicle2-2-2"><button type="button">结算</button></i></a>
			<em class="box-vehicle2-2-1" id="price_total">0.00积分</em>
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
<!--<script src="/Public/Mobile/Shangchengpc/js/j_pro.js"></script>-->
<script>
$(function () {
	//GetCartList();
	//单独选择某一个
	$("input[name='check_item']").click(function () {
		if ($(this).is(".checked")) {
			$(this).removeClass("checked");
			$(".check_all").removeClass("checked");
		} else {
			$(this).addClass("checked");
		}
		GetCartTotal();
	});
	//全选
	$(".check_all").click(function () {
		if ($(this).is(".checked")) { $("input[name='check_item'],.check_all").removeClass("checked"); } else { $("input[name='check_item'],.check_all").addClass("checked"); }
		GetCartTotal();
	});
})
</script>
<script>
function GetCartSure() {
    if ($("input[name='check_item'].checked").is(".checked")) {
        var idStr = "";
        $("input[name='check_item'].checked").each(function () {
            idStr += $(this).val() + ",";
        });
        if (idStr.length > 1) {
            $.ajax({
                type: "post", url: "/gb.html",
                data: {"idStr": idStr },
                async: false,
				dataType: "json",
				success: function (data) {
                    if (data.code == 1) {
                        window.location.href = data.url;
                    } else if (data.code == 2) { alert(data.msg); GetCartList(); }
                }
            });
        }

    } else { alert("没有选择中商品"); }
}


function GetCartProCount(countStr, idStr) {
	
	
    var proCount = parseInt($("input[data_cart=" + idStr + "]").val());
	console.log(proCount);	

    switch (countStr) {
        case -1: if (proCount > 1) { proCount += countStr }; break;
        case 1: proCount += countStr; break;
    }


    $.ajax({
        type: "post", url: "/gb.html",
        data: {"proid": idStr, "countStr": countStr },
        async: false, dataType: "json", success: function (data) {
            if (data.code == 1) {
                $("input[data_cart=" + idStr + "]").val(data.count);
				GetCartTotal();
            }else if(data.code<1){
				$("input[data_cart=" + idStr + "]").val(1);
				GetCartTotal();} 
				
				else { alert(data.msg); }
        }
    });
}
function GetCartTotal() {
    var totalStr = 0;
    var totalxj = 0;
    $("input[name='check_item'].checked").each(function () {
        var idStr = $(this).val();
        totalStr += parseInt($("input[data_cart=" + idStr + "]").val()) * parseFloat($("input[data_cart=" + idStr + "]").attr("data_price"));
        totalxj +=parseInt($("input[data_cart=" + idStr + "]").val()) * parseFloat($("input[data_cart=" + idStr + "]").attr("data_xj"));

    });
    $("#price_total").html("" + totalStr.toFixed(2) + " 爱国消费积分+" + totalxj.toFixed(2) + " 元");
}
function GetCartProDel(idStr) {//alert(idStr.length);
    //if (idStr.length > 0) {
	if (idStr) {
        if (confirm("确定删除该商品！")) {
            $.ajax({
                type: "post", url: "/gad2.html",
                data: { "t": "sc", "proid": idStr },
				async: false, dataType: "json", success: function (data) {
                    if (data.code == 1) {
                        $("div[data_pro=" + idStr + "]").remove(); GetCartTotal();
                    } else { alert(data.msg); }
                }
            });
        }
    }
}
</script>
</body>
</html>