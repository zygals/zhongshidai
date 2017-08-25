<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<title><?php echo ($config["config_webname"]); ?>-公告资讯</title>
<meta name="keywords" content="<?php echo ($config["config_webkw"]); ?>"/>
<meta name="description" content="<?php echo ($config["config_cp"]); ?>" />
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/herder.css">
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/notice.css">
<meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<script src="/Public/Mobile/Shangchengpc/js/jquery-2.1.4.min.js"></script>
<script>
var cate_new = 1;

function Next() {
	$.ajax({
		type: "post", url: "/gg.html",
		data: {"pageIndex": $("#lblPageIndex").html(), "cateid": cate_new },
		async: false, dataType: "json", success: function (data) {
			if (data.code == 1) {
				if (data["data"].length > 0) {
					$("#ulHtml").append(data["data"]);
					$("#lblPageIndex").html(parseInt($("#lblPageIndex").html()) + 1);
				} else { $(".loadMore").html("<a href=\"javasript:void(0)\">没有更多信息了</a>"); }
			}else{$(".loadMore").html("<a href=\"javasript:void(0)\">没有更多信息了</a>");}
		}
	});
}
function start_new(cate) {
 cate_new = cate;
 $.ajax({
	 type: "post", url: "/gg.html",
	 data: { "cateid": cate },
	 async: false, dataType: "json", success: function (data) {
		if (data["data"].length > 0) {
			$("#ulHtml").html(data["data"]);
			$("#lblPageIndex").html(1);
		} else { $("#ulHtml").html(""); }
	 }
 });
}
/*function start_new(cate) {
 cate_new = cate;
 $.ajax({
	 type: "post", url: "/app/get_wap_kjt.ashx",
	 data: { "por": 122, "pageIndex":1, "cateid": cate },
	 async: false, dataType: "json", success: function (data) {
		 if (data["data"].length > 0) {
			 $("#ulHtml").html(data["data"]);
			 $("#lblPageIndex").html(2);
		 } else { $("#ulHtml").html(""); }
	 }
 });
}*/
</script>
<style>
#ulHtml img{width:147px;height:64px;}
</style>
</head>
<body>
<div class="box-five">
	<div class="box-fivea">
		<div class="header">
			<div class="header-1"><a href="/"></a></div>
			<div class="header-2">公告</div>
            <div class="header-3"><a href="/"></a></div>
            
            
		</div>
		<div class="box-eleven-kyjifen"> 
            <ul>
            <li>
            <span><font style=" font-size:1.4rem;">◆</font>中时代商城公告</span>
            </li>
           
            </ul>
            </div>
		<div class="box-five-3">
			<label id="lblPageIndex" style="display:none;">1</label>
				<ul class="box-five-3a" id="ulHtml">
					<?php if(is_array($gg)): foreach($gg as $key=>$gv): ?><li onClick="window.location.href='/gd/b/<?php echo ($gv["id"]); ?>.html'">
						<span>
							<a href="/gd/b/<?php echo ($gv["id"]); ?>.html">● <?php echo ($gv["title"]); ?></a>
						</span>
					</li><?php endforeach; endif; ?>
				</ul>
                
                
                
                
                
                
			<div style="text-align:center;background-color:#fff;padding-top:10px;" class="loadMore"><a href="javasript:void(0)"  onclick="Next()">加载更多</a></div>
		</div>
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
   $(".box-five-2 ul li").click(function () {
	   $(this).addClass('current').siblings().removeClass('current');
	   $('.news>ul:eq(' + $(this).index() + ')').show().siblings().hide();
	   start_new($(this).attr("data_cate"));
   })
   $(".box-five-3 ul:first-child").css("display", "block");
})
</script>
</body>
</html>