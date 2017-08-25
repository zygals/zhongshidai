<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">
<title>中华时代商城</title>
<meta name="keywords" content="<?php echo ($config["config_webkw"]); ?>"/>
<meta name="description" content="<?php echo ($config["config_cp"]); ?>" />
<!--<link href="/Public/Mobile/Shangchengpc/css/j_corll.css" rel="stylesheet">-->
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/first.css">
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/home.css">
<meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/herder.css">
<script type="text/javascript" src="/Public/Mobile/Shangchengpc/js/jquery-2.1.4.min.js"></script>
</head>
<body>
<div class="box-three">
<div class="box-threea">
	<div class="header">
		<div class="header-1"><a href="/gz.html"></a></div>
		<div class="header-2" id="titleName">搜索结果</div>
	</div>
	<!--<div class="box-three-1">
		<ul>
			<li><a href="javascript:void(0)" id="pro_01" class="yanse-1 up" data_order="1">人气</a><a href="javascript:void(0)"><img src="/Public/Mobile/Shangchengpc/images/0three-2.png" id="pro_icon_01"></a></li>
			<li><a href="javascript:void(0)" id="pro_02" data_order="2">价格</a><a href="javascript:void(0)"><img src="/Public/Mobile/Shangchengpc/images/0three-1.png" id="pro_icon_02"></a></li>
			<li><a href="javascript:void(0)" id="pro_03" data_order="3">销量</a><a href="javascript:void(0)"><img src="/Public/Mobile/Shangchengpc/images/0three-1.png" id="pro_icon_03"></a></li>
		</ul>
	</div>-->
	<script>
		$(function () {
			$('#pro_icon_01').click(function(){
				$('#pro_02').removeClass('yanse-1 up');
				$("#pro_icon_02").attr("src", "/Public/Mobile/Shangchengpc/images/0three-1.png");
				$('#pro_03').removeClass('yanse-1 up');
				$("#pro_icon_03").attr("src", "/Public/Mobile/Shangchengpc/images/0three-1.png");
				$('#pro_01').addClass('yanse-1 up');
				$("#pro_icon_01").attr("src", "/Public/Mobile/Shangchengpc/images/0three-2.png");
				$('#tj').val(1);$("#lblPageIndex").text(1);
				tiaojian(1);
			});
			$('#pro_icon_02').click(function(){
				$('#pro_01').removeClass('yanse-1 up');
				$("#pro_icon_01").attr("src", "/Public/Mobile/Shangchengpc/images/0three-1.png");
				$('#pro_03').removeClass('yanse-1 up');
				$("#pro_icon_03").attr("src", "/Public/Mobile/Shangchengpc/images/0three-1.png");
				$('#pro_02').addClass('yanse-1 up');
				$("#pro_icon_02").attr("src", "/Public/Mobile/Shangchengpc/images/0three-2.png");
				$('#tj').val(2);$("#lblPageIndex").text(1);
				tiaojian(2);
			});
			$('#pro_icon_03').click(function(){
				$('#pro_01').removeClass('yanse-1 up');
				$("#pro_icon_01").attr("src", "/Public/Mobile/Shangchengpc/images/0three-1.png");
				$('#pro_02').removeClass('yanse-1 up');
				$("#pro_icon_02").attr("src", "/Public/Mobile/Shangchengpc/images/0three-1.png");
				$('#pro_03').addClass('yanse-1 up');
				$("#pro_icon_03").attr("src", "/Public/Mobile/Shangchengpc/images/0three-2.png");
				$('#tj').val(3);$("#lblPageIndex").text(1);
				tiaojian(3);
			});
			/*$(".box-three-1 li").click(function () {
				var $t = $(this).children("a");
				if ($t.hasClass('yanse-1 up')) {

					$(".box-three-1 li a").removeClass('yanse-1 up'); $t.addClass('yanse-1 down');

					switch (parseInt($t.attr("data_order"))) {
						case 1: $("#pro_icon_01").attr("src", "/Public/Mobile/Shangchengpc/images/0three-3.png"); break;//1-红色向上 2-灰色向下 3-红色向下
						case 2: $("#pro_icon_02").attr("src", "/Public/Mobile/Shangchengpc/images/0three-3.png"); break;
						case 3: $("#pro_icon_03").attr("src", "/Public/Mobile/Shangchengpc/images/0three-3.png"); break;
					}

					GetOrderStr($t.attr("data_order"));

				} else {
					$(".box-three-1 li a").removeClass('yanse-1 up down');
					$t.addClass('yanse-1 up');

					switch (parseInt($t.attr("data_order"))) {
						case 1: GetOrderStr(4); $("#pro_icon_01").attr("src", "/Public/Mobile/Shangchengpc/images/0three-2.png"); $("#pro_icon_02,#pro_icon_03").attr("src", "/Public/Mobile/Shangchengpc/images/0three-1.png"); break;//1-红色向上 2-灰色向下 3-红色向下
						case 2: GetOrderStr(5); $("#pro_icon_02").attr("src", "/Public/Mobile/Shangchengpc/images/0three-2.png"); $("#pro_icon_01,#pro_icon_03").attr("src", "/Public/Mobile/Shangchengpc/images/0three-1.png"); break;
						case 3: GetOrderStr(6); $("#pro_icon_03").attr("src", "/Public/Mobile/Shangchengpc/images/0three-2.png"); $("#pro_icon_02,#pro_icon_01").attr("src", "/Public/Mobile/Shangchengpc/images/0three-1.png"); break;
					}
				}
			})*/
		})
	</script>
	<div style="height:10px;"></div>
	<div id="wrapper" style="overflow: hidden; left: 0px;">
		<div id="scroller" style="transition-property: transform; transform-origin: 0px 0px 0px; transition-timing-function: cubic-bezier(0.33, 0.66, 0.66, 1); transform: translate(0px, -51px) scale(1) translateZ(0px); transition-duration: 400ms;">
			<!--<div id="pullDown">
				<span class="pullDownIcon"></span><span class="pullDownLabel">Pull down to refresh...</span>
			</div>-->
            
            <div class="box-one-5">
			<p style="font-size:18px; font-weight:700"><a href="" style="color:#bb0000;"></a></p>
			<div class="box-one-51">
				<label id="lblPageIndex" style="display: none;">2</label>
				<ul id="ulHtml" class="ding">
					<?php if(is_array($vlist)): foreach($vlist as $key=>$jx): ?><li onClick="window.location.href='/d/b/<?php echo ($jx["id"]); ?>.html'">
                      <h5>&nbsp;<?php echo (msubstr($jx["name"],0,6)); ?></h5>
						<div style="text-align:center; padding:10px;"><img src="../<?php echo ($jx["pic"]); ?>" alt="" style="vertical-align:middle;" width="100%"></div>
					   <p class="dinggou"><?php if($jx['xianjing'] == 0): echo ($jx["jifen"]); ?>积分<?php else: ?><font style=" font-weight:bold;">￥<?php echo ($jx["xianjing"]); ?></font>+<?php echo ($jx["jifen"]); ?>积分<?php endif; ?></p>
                    </li><?php endforeach; endif; ?>
                   
					
				</ul>
				
			</div>
		</div>
            
			<!--<div class="box-one-5">
				<div class="box-one-51">
					<label id="lblPageIndex" style="display: none;">1</label>
					<ul id="ulHtml" class="ding">
						<?php if(is_array($vlist)): foreach($vlist as $key=>$gv): ?><li>
							<a href="/d/b/<?php echo ($gv["id"]); ?>.html">
								<div class="dummy">
									<p class="tiao-1">
										<img src="../<?php echo ($gv["pic"]); ?>" alt="">
										<i></i>
									</p>
								</div>
							</a>
							<span>
								<span style="width:100%; position:absolute; bottom:170px; text-align:center;"><?php echo ($gv["name"]); ?></span>
								<p class="dinggou"><font style=" font-weight:bold;">￥<?php echo ($gv["xianjing"]); ?></font>+<?php echo ($gv["jifen"]); ?>积分</p>
							</span>
						</li><?php endforeach; endif; ?>
					</ul>
				</div>
			</div>-->
			<div id="pullUp">
				<span class="pullUpIcon"></span><span class="pullUpLabel"><!--Pull up to refresh...--></span>
			</div>
		</div>
	<div style="position: absolute; z-index: 100; width: 7px; bottom: 2px; top: 2px; right: 1px; pointer-events: none; transition-property: opacity; transition-duration: 350ms; overflow: hidden; opacity: 0;"><div style="position: absolute; z-index: 100; border: 1px solid rgba(255, 255, 255, 0.901961); box-sizing: border-box; width: 100%; border-radius: 3px; pointer-events: none; transition-property: transform; transform: translate(0px, 13.0431px) translateZ(0px); transition-timing-function: cubic-bezier(0.33, 0.66, 0.66, 1); height: 97px; transition-duration: 400ms; background: padding-box padding-box rgba(0, 0, 0, 0.498039);"></div></div>
	</div>
	<?php if($gd): ?><div style="text-align: center;" class="loadMore"><a href="javasript:void(0)" onclick="Next()">点击加载更多</a></div>
	<?php else: ?>
	<!--<div style="text-align: center;" class="loadMore"><a href="javasript:void(0)" >暂无商品</a></div>--><?php endif; ?>
	<input id="pro_order" hidden="text" value="0">
	<input id="tj" hidden="hidden" value="1">
	<input id="fid" hidden="hidden" value="<?php echo ($fl["id"]); ?>">
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
/*String.prototype.GetValue = function (para) {
	var reg = new RegExp("(^|&)" + para + "=([^&]*)(&|$)");
	var r = this.substr(this.indexOf("\?") + 1).match(reg);
	if (r != null) return unescape(r[2]); return null;
};
$(function () {
	proStart();
});
function proStart() {
	var str = location.href;
	var id = str.GetValue("id"); var searchValue = $.query.get("word");
	var word = str.GetValue("word"); var orderStr = $("#pro_order").val();
	$.ajax({
		type: "post", url: "/app/get_wap_kjt.ashx",
		data: { "por": 126, "idStr": id, "pageIndex": 1, "word": searchValue, "orderStr": orderStr },
		async: false, dataType: "json", success: function (data) {
			$("#ulHtml").html(data["data"]);
			$("#titleHName").html(data["cateName"]);
			$("#titleName").html(data["cateName"]);
			$("#lblPageIndex").text(2); isMoreInfo = 1; myScroll.refresh(); $(".pullUpLabel").html('Pull up to load more...');
		}
	});
}
var isMoreInfo = 0;*/
function Next() {
	$.ajax({
		type: "post", url: "/p/f/2.html",
		data: {'fid':$('#fid').val(),"pageIndex": $("#lblPageIndex").text(),'tj':$('#tj').val()},
		async: false, dataType: "json", success: function (data) {
			if (data.code == 1) {
				$("#ulHtml").append(data["data"]);
				$("#lblPageIndex").text(parseInt($("#lblPageIndex").text()) + 1);
			} else if (data.code == 2) { $(".loadMore").html("<a href=\"javasript:void(0)\">没有更多信息了</a>");}
		}
	});
}
function tiaojian(a) {
	$.ajax({
		type: "post", url: "/p/f/2.html",
		data: {'fid':$('#fid').val(),'tj':a},
		async: false, dataType: "json", success: function (data) {
			if (data.code == 1) {
				$("#ulHtml").html(data["data"]);
			} else if (data.code == 2) { $(".loadMore").html("<a href=\"javasript:void(0)\">没有更多信息了</a>");}
		}
	});
}
/*function Next() {
	var str = location.href;
	var id = str.GetValue("id");alert(id);
	var word = str.GetValue("word");
	var orderStr = $("#pro_order").val();
	$.ajax({
		type: "post", url: "/app/get_wap_kjt.ashx",
		data: { "por": 126, "idStr": id, "pageIndex": $("#lblPageIndex").text(), "word": word, "orderStr": orderStr },
		async: false, dataType: "json", success: function (data) {
			if (data.code == 1) {
				$("#ulHtml").append(data["data"]);
				$("#titleHName").html(data["cateName"]);
				$("#titleName").html(data["cateName"]);
				$("#lblPageIndex").text(parseInt($("#lblPageIndex").text()) + 1); isMoreInfo = 1;
			} else if (data.code == 2) { $(".loadMore").html("<a href=\"javasript:void(0)\">没有更多信息了</a>"); isMoreInfo = 0; }
		}
	});
}
function GetOrderStr(str) {
	$("#pro_order").attr("value", str);
	proStart();
}*/
</script>
</body>
</html>