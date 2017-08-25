<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>个人中心-复投审核列表</title>
    <meta name="keywords" content="<?php echo ($config["config_webkw"]); ?>"/>
    <meta name="description" content="<?php echo ($config["config_cp"]); ?>"/>
    <link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/herder.css">
    <link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/member.css">
    <meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no"
          name="viewport">
    <script src="/Public/Mobile/Shangchengpc/js/jquery-2.1.4.min.js"></script>
    <script>
        function shenhetongguo(id,obj) {
            $.ajax({
                type: "get", url: "/futoutongguo.html",
                data: {"id": id},
                //  async: true,//ajax请求是异步的
                dataType: "json", success: function (data) {
                    if (data.code == "0") {
                        //alert(data.msg)
                        $(obj).parent().html('已审核');
                    } else {
                        alert(data.msg)
                    }
                }
            });

        }
        $(function () {
            Next();
        });
        function Next() {
            $.ajax({
                type: "post", url: "/futoushenhe.html",
                data: {"pageIndex": $("#lblPageIndex").html()},
              //  async: true,//ajax请求是异步的
                dataType: "json", success: function (data) {
                    if (data.code == "1") {
                        $("#tbody").append(data.data_info);
                        $("#lblPageIndex").html(parseInt($("#lblPageIndex").html()) + 1);
                    } else {
                        $(".loadMore").html("<a href=\"javasript:void(0)\">没有更多信息了</a>");
                    }
                }
                ,error:function (data) {
                    $("#lblPageIndex").html(parseInt($("#lblPageIndex").html()) + 1);
                }
            });
        }
    </script>
</head>
<body>
<div class="box-member">
    <div class="header">
        <div class="header-1"><a href="/u.html"></a></div>
        <div class="header-2" id="pro_title">个人中心</div>
        <div class="header-3"><a href="/"></a></div>
    </div>

    <div class="box-eleven-kyjifen">
        <ul>
            <li>
                <span><font style=" font-size:1.4rem;">◆</font> 下级会员复投申请</span>
            </li>

        </ul>
    </div>
    <?php echo ($html); ?>
    <div class="box-member-1">
        <label id="lblPageIndex" style="display:none;">1</label>
        <table class="gridtable" id="tbody">
            <tbody>
            <tr>
                <th>申请者ID</th>
                <th>积分数</th>
                <th>返还日期</th>
                <th>申请日期</th>
                <th>期次</th>
                <th>倍增数</th>
                <th>状态</th>
            </tr>
            </tbody>
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