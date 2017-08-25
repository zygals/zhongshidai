<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">
<title><?php echo ($config["config_webname"]); ?>-个人中心</title>
<meta name="keywords" content="<?php echo ($config["config_webkw"]); ?>"/>
<meta name="description" content="<?php echo ($config["config_cp"]); ?>" />
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/herder.css">
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/personal center.css">
<meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<script src="/Public/Mobile/Shangchengpc/js/jquery-2.1.4.min.js"></script>
<script type=text/javascript src="/Public/Mobile/Shangchengpc/js/jquery.min.js"></script>
<script>
$(function () {
	/*$.ajax({
		type: "post", url: "/app/get_wap_kjt.ashx",
		data: { "por": 124 },
		async: false, dataType: "json", success: function (data) {
		   if (data["state"] == "1") {
			   if (data["isServer"] == "1") {
				   $("#UserName").html(data["userName"] + "<img src='img/vip_icon_year.png' width='16' style='vertical-align:middle; margin:-2px 0 0 5px;'>"); $("#pro_server").attr("onclick", "javascript:window.location.href = 'm_DouOne.html'").show();
				   $("#pro_work").attr("onclick", "javascript: window.location.href = 'm_wkList.html'").show();
				   $("#pro_workAdd").attr("onclick", "javascript: window.location.href = 'm_wkAdd.html'").show();
				   $("#pro_pointBd").attr("onclick", "javascript: window.location.href = 'm_point.html?proid=6'").show();
				   $("#u_BD").html("<em>报单积分</em><em style='float:right;'>" + data["bd"] + "</em>");
				   $("#pro_BD_Tra").attr("onclick", "javascript:window.location.href = 'm_BDOne.html'").show();
			   } else {
				   $("#UserName").html(data["userName"]);
			   }
			   $("#TJTel").html("推荐人：" + data["tjTel"]);
			   //$("#JF").html(data["ky"]);
			   $("#KY").html("<em>可用积分</em><em style='float:right;'>" + data["ky"]+"</em>");
			   $("#DY").html("<em>待用积分</em><em style='float:right;'>" + data["dy"] + "</em>");
			   $("#FX").html("<em>分享积分</em><em style='float:right;'>" + data["fx"] + "</em>");
			   $("#GW").html("<em>购物积分</em><em style='float:right;'>" + data["gw"] + "</em>");
		   } else {
			   location.href = "m_login.html";
		   }
		}
	});*/
});

function exit() {
	$.ajax({
		type: "post", url: "/ulo.html",
		data: { "por": 128 },
		async: false, dataType: "text", success: function (data) {
		   alert("退出成功");
		   location.href = "/l.html";
		}
	});
}
</script>
</head>
<body>
<div class="box-eleven">
	<div class="header">
		<div class="header-1"><a href="/"></a></div>
		<div class="header-2">个人中心</div>
        <div class="header-3"><a href="/"></a></div>
	</div>
	<div class="box-eleven-1">
		<span class="box-eleven-1a"><img src="/Public/Mobile/Shangchengpc/images/elever-1.gif" height="82" width="82" alt=""></span>
		<span id="UserName" style="color:#fff; font-size:1.2rem;color: #000;   text-transform: uppercase; text-shadow: #fff 0 1px 0; 
"><?php echo ($bh); ?>
        
       
		</span>
        <span  id="UserName" style="color:#fff; font-size:1.2rem;color: #000;   text-transform: uppercase; text-shadow: #fff 0 1px 0; ">
         <?php if($user['user_dengji'] == 1): ?>VIP会员<?php endif; ?>
		<?php if($user['user_dengji'] == 2): ?>社区工作站<?php endif; ?>
        <?php if($user['user_dengji'] == 3): ?>区域服务中心<?php endif; ?>
        <?php if($user['user_dengji'] == 4): ?>省级分公司<?php endif; ?></span>
        
		<span id="TJTel" style="color:#fff; font-size:1.2rem;color: #000;   text-transform: uppercase; text-shadow: #fff 0 1px 0; ">推荐人：<?php echo ($user["user_sjid1"]); ?></span>
	</div>
	<!--  <div class="box-eleven-2">
	<ul>
	<li><a href="">待付款<span>（1）</span></a></li>
	<li><a href="">待收货<span>（0）</span></a></li>
	<li><a href="">已收货<span>（0）</span></a></li>

	</ul>
	</div>-->
    <div id="firstpane" class="menu_list">
    <p class="menu_head">&nbsp;&nbsp;查看积分</p>
    <div style="display:none" class=menu_body >
     <div class="box-eleven-3">
	<ul>
	<li>
	<a href="/uk.html">
	<i><img src="/Public/Mobile/Shangchengpc/images/elever-01.gif" height="18" width="18" alt=""></i>
	<span id="KY">可用积分<em style="float:right;"><?php if($user['user_keyongjf']): echo ($user["user_keyongjf"]); else: ?>0<?php endif; ?></em></span>
	</a>
	</li> 
	<li>
	<a href="/ud.html">
	<i><img src="/Public/Mobile/Shangchengpc/images/elever-02.gif" height="18" width="18" alt=""></i>
	<span id="DY">待用积分<em style="float:right;"><?php if($user['user_daiyongjf']): echo ($user["user_daiyongjf"]); else: ?>0<?php endif; ?></em></span>
	</a>
	</li>
	<li>
	<a href="/uf.html">
	<i><img src="/Public/Mobile/Shangchengpc/images/elever-03.gif" height="18" width="18" alt=""></i>
	<span id="FX">分享积分<em style="float:right;"><?php if($user['user_fenxiangjf']): echo ($user["user_fenxiangjf"]); else: ?>0<?php endif; ?></em></span>
	</a>
	</li>
    
    <?php if($user['user_dengji'] != 1): ?><li id="pro_pointBd" style="" onClick="javascript: window.location.href = '/ub.html'">
	<a href="javascript:void(0)">
	<i><img src="/Public/Mobile/Shangchengpc/images/elever-04.gif" height="18" width="18" alt=""></i>
	<span id="u_BD">充值积分<em style="float:right;"><?php if($user['user_baodanjifen']): echo ($user["user_baodanjifen"]); else: ?>0<?php endif; ?></em></span>
	</a>
	</li><?php endif; ?>
     <li>
	<a href="/zs.html">
	<i><img src="/Public/Mobile/Shangchengpc/images/elever-03.gif" height="18" width="18" alt=""></i>
	<span id="FX">赠送积分<em style="float:right;"><?php if($user['user_zengsongjifen']): echo ($user["user_zengsongjifen"]); else: ?>0<?php endif; ?></em></span>
	</a>
	</li>
    
    <?php if(($user['user_zs_keyongjf'] != 0) OR ($user['user_zs_daiyongjf'] != 0) OR ($user['user_zs_fenxiangjf'] != 0) OR ($user['user_zs_baodanjifen'] != 0) ): ?><li>
	<a href="/uk.html">
	<i><img src="/Public/Mobile/Shangchengpc/images/elever-01.gif" height="18" width="18" alt=""></i>
	<span id="KY">老会员可用积分<em style="float:right;"><?php if($user['user_zs_keyongjf']): echo ($user["user_zs_keyongjf"]); else: ?>0<?php endif; ?></em></span>
	</a>
	</li> 
	<li>
	<a href="/ud.html">
	<i><img src="/Public/Mobile/Shangchengpc/images/elever-02.gif" height="18" width="18" alt=""></i>
	<span id="DY">老会员待用积分<em style="float:right;"><?php if($user['user_zs_daiyongjf']): echo ($user["user_zs_daiyongjf"]); else: ?>0<?php endif; ?></em></span>
	</a>
	</li>
	<li>
	<a href="/uf.html">
	<i><img src="/Public/Mobile/Shangchengpc/images/elever-03.gif" height="18" width="18" alt=""></i>
	<span id="FX">老会员分享积分<em style="float:right;"><?php if($user['user_zs_fenxiangjf']): echo ($user["user_zs_fenxiangjf"]); else: ?>0<?php endif; ?></em></span>
	</a>
	</li>
    
    <?php if($user['user_dengji'] != 1): ?><li id="pro_pointBd" style="" onClick="javascript: window.location.href = '/ub.html'">
	<a href="javascript:void(0)">
	<i><img src="/Public/Mobile/Shangchengpc/images/elever-04.gif" height="18" width="18" alt=""></i>
	<span id="u_BD">老会员充值积分<em style="float:right;"><if condition="$user['user_zs_baodanjf']"><?php echo ($user["user_zs_baodanjf"]); else: ?>0<?php endif; ?></em></span>
	</a>
	</li><?php endif; ?>
     </if>
    <?php if($user['user_ok'] == 0): ?><li>
    <a>
	<i><img src="/Public/Mobile/Shangchengpc/images/elever-05.gif" height="18" width="18" alt=""></i>
	<span>可用积分互转</span>
	</a>
	</li>
    <?php else: ?>
     <li>
    <a href="/ujz.html">
	<i><img src="/Public/Mobile/Shangchengpc/images/elever-05.gif" height="18" width="18" alt=""></i>
	<span>可用积分互转</span>
	</a>
	</li><?php endif; ?>
   
   
  
   
   
    <li>
	<a href="/upp.html">
	<i><img src="/Public/Mobile/Shangchengpc/images/elever-04.gif" height="18" width="18" alt=""></i>
	<span id="FX">爱国消费券<em style="float:right;"><?php if($user['user_fenxiangjf']): echo ($user["user_agxfq"]); else: ?>0<?php endif; ?></em></span>
	</a>
	</li>
	<li>
	<a href="/ubp.html">
	<i><img src="/Public/Mobile/Shangchengpc/images/elever-04.gif" height="18" width="18" alt=""></i>
	<span id="FX">爱心消费券<em style="float:right;"><?php if($user['user_fenxiangjf']): echo ($user["user_axxfq"]); else: ?>0<?php endif; ?></em></span>
	</a>
	</li>
    
    
	<li>
	<a href="/umc.html">
	<i><img src="/Public/Mobile/Shangchengpc/images/elever-04.gif" height="18" width="18" alt=""></i>
	<span id="FX">平台维护<em style="float:right;"><?php if($user['user_fenxiangjf']): echo ($user["user_ptwhf"]); else: ?>0<?php endif; ?></em></span>
	</a>
	</li>
    </ul>
    </div>
    
    </div>
    <p class="menu_head">&nbsp;&nbsp;个人中心</p>
    <div style="display:none" class=menu_body >
        <div class="box-eleven-3">
         <ul>
            <li>
            <a href="/kanyue.html">
            <i><img src="/Public/Mobile/Shangchengpc/images/elever-08.gif" height="18" width="18" alt=""></i>
            <span>查看余额</span>
            </a>
            </li>
            <li>
            <a href="/gw.html">
            <i><img src="/Public/Mobile/Shangchengpc/images/elever-07.gif" height="18" width="18" alt=""></i>
            <span>我的购物车</span>
            </a>
            </li>
            <li>
            <a href="/gw1.html">
            <i><img src="/Public/Mobile/Shangchengpc/images/elever-07.gif" height="18" width="18" alt=""></i>
            <span>爱国消费购物车</span>
            </a>
            </li>
            <li>
            <a href="/umd.html">
            <i><img src="/Public/Mobile/Shangchengpc/images/elever-08.gif" height="18" width="18" alt=""></i>
            <span>我的订单</span>
            </a>
            </li>
            <li>
            <a href="/uu.html">
            <i><img src="/Public/Mobile/Shangchengpc/images/elever-09.gif" height="18" width="18" alt=""></i>
            <span>修改个人信息</span>
            </a>
            </li>
            
            <li>
            <a href="/gad.html">
            <i><img src="/Public/Mobile/Shangchengpc/images/elever-09.gif" height="18" width="18" alt=""></i>
            <span>收货地址管理</span>
            </a>
            </li>
                 
            <li>
            <a href="/ubdyhk.html">
            <i><img src="/Public/Mobile/Shangchengpc/images/elever-03.gif" height="18" width="18" alt=""></i>
            <span id="FX">添加（绑定）银行卡</span>
            </a>
            </li>
            
            <li>
            <a href="/pay.html">
            <i><img src="/Public/Mobile/Shangchengpc/images/elever-03.gif" height="18" width="18" alt=""></i>
            <span id="FX">充值</span>
            </a>
            </li>
             <!-- <li>
           <a href="/tx.html">
            <i><img src="/Public/Mobile/Shangchengpc/images/elever-03.gif" height="18" width="18" alt=""></i>
            <span id="FX">提现</span>
            </a>
            </li>-->
      </ul>
    </div>
    
    </div>
    
    
    
  <?php if($user['user_dengji'] != 1): if($user['user_ok'] == 0): ?><p class="menu_head">&nbsp;&nbsp;报单</p>
    <div style="display:none" class=menu_body >
        <div class="box-eleven-3">
         <ul>
            <li id="pro_BD_Tra" style="">
                <a>
               
                <i><img src="/Public/Mobile/Shangchengpc/images/elever-05.gif" height="18" width="18" alt=""></i>
                <span>充值积分互转</span>
               </a>
                </li>
            
                 <li id="pro_server" style="">
                
                  <a>
                    <i><img src="/Public/Mobile/Shangchengpc/images/elever-03.gif" height="18" width="18" alt=""></i>
                    <span>消费服务中心</span>
                   </a>
                 </li>
         
      </ul>
    </div>
    
    </div>
    <?php else: ?>
      <p class="menu_head">&nbsp;&nbsp;报单</p>
    <div style="display:none" class=menu_body >
        <div class="box-eleven-3">
         <ul>
           
              <li id="pro_BD_Tra" style="" onClick="javascript:window.location.href = '/ubjz.html'">
                <a href="javascript:void(0)">
                <i><img src="/Public/Mobile/Shangchengpc/images/elever-05.gif" height="18" width="18" alt=""></i>
                <span>充值积分互转</span>
               </a>
                </li>
            
                 <li id="pro_server" style="" onClick="javascript:window.location.href = '/ux.html'">
                
                  <a href="javascript:void(0)">
                    <i><img src="/Public/Mobile/Shangchengpc/images/elever-03.gif" height="18" width="18" alt=""></i>
                    <span>消费服务中心</span>
                   </a>
                 </li>
           
           
             
         
      </ul>
    </div>
    
    </div><?php endif; endif; ?>
    
    
  
   

</div>
    
   <script type=text/javascript>
$(document).ready(function(){
	$("#firstpane .menu_body:eq(3)").show();
	$("#firstpane p.menu_head").click(function(){
		$(this).addClass("current").next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("slow");
		$(this).siblings().removeClass("current");
	});
	$("#secondpane .menu_body:eq(3)").show();
	$("#secondpane p.menu_head").mouseover(function(){
		$(this).addClass("current").next("div.menu_body").slideDown(500).siblings("div.menu_body").slideUp("slow");
		$(this).siblings().removeClass("current");
	});
	
});
</script> 
    
    
	<div class="box-eleven-4">
	<ul>
    
    
    
    <?php if($user['user_ok'] == 0): ?><li id="pro_server" style="">
	<span>复投中心</span>
	</li>
   <?php if($user['user_dengji'] != 1): ?><li id="pro_server" style="">
            <span>复投审核</span>
        </li><?php endif; ?>

<?php else: ?>
<li id="pro_server" style="" onClick="javascript:window.location.href = '/f.html'">
	<span>复投中心</span>
	</li>
   <?php if($user['user_dengji'] != 1): ?><li id="pro_server" style="" onClick="javascript:window.location.href = '/futoushenhe.html'">
            <span>复投审核</span>
        </li><?php endif; endif; ?>


	
	<li>
	<a href="/uz.html">
	<span>直推会员</span>
	
	</a>
	</li>
	
    <li>
	<!--<a href="/uup.html">-->
	
	<span>安全管理</span>
	<!--</a>-->
	</li>
    
	</ul>
    </div>
    
   <div class="box-eleven-safty"> 
    <ul>
    <li>
	<a href="/uup.html" class="hover">
	<span>修改密码</span>
	</a>
	</li>
    <li>
  
	<span><a onClick="exit()" style="cursor:pointer;">退出登录</a></span>
	</li>
    </ul>
    </div>
    
	

	<div class="box-eleven-11">
	
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