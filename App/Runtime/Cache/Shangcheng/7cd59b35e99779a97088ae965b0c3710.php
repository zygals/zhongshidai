<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo ($config["config_webname"]); ?>-首页</title>
<meta name="keywords" content="<?php echo ($config["config_webkw"]); ?>"/>
<meta name="description" content="<?php echo ($config["config_cp"]); ?>" />
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/herder.css">
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/first.css">
<meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link href="/Public/Mobile/Shangchengpc/css/swiper.min.css" rel="stylesheet">
<script type="text/javascript" src="/Public/Mobile/Shangchengpc/js/jquery-2.1.4.min.js"></script>
<script src="/Public/Mobile/Shangchengpc/js/swiper.min.js"></script>
<script src="//api.html5media.info/1.1.8/html5media.min.js"></script>
<script>
$(function () {
	var swiper = new Swiper('.swiper-container', {
		pagination: '.swiper-pagination',
		paginationClickable: true,
		spaceBetween: 0,
		centeredSlides: true,
		autoplay: 3500,
		autoplayDisableOnInteraction: false
	});
});
</script>
<style>
.swiper-container {
	width: 100%;
	margin: 0 auto;
}
.swiper-slide {
	text-align: center;
	width: 100%;
	display: -webkit-box;
	display: -ms-flexbox;
	display: -webkit-flex;
	display: flex;
	-webkit-box-pack: center;
	-ms-flex-pack: center;
	-webkit-justify-content: center;
	justify-content: center;
	-webkit-box-align: center;
	-ms-flex-align: center;
	-webkit-align-items: center;
	align-items: center;
}
.swiper-slide a, .swiper-slide img {
	width: 100%;
}
.box-one-51 ul li p{
		height:28px;
		overflow:hidden;
		white-space: nowrap;
		text-overflow: ellipsis;
	}
</style>
	<script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?38d06b2fdb163e085dc218a46182de6a";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
	</script>
</head>
<body>
<div class="box-one">
	<div class="box-one-1">
		<div class="header-one">
		   <ul>
			   <li class="logo">
					<a href="/" title="中时代积分商城"> <img src="<?php echo ($logo); ?>" alt="" width="70" height="40"> </a>
			   </li>

			   <li class="title">
					<?php if($bh): ?><span id="k_userInfo"><img src="/Public/Mobile/Shangchengpc/images/first.png" height="20" width="20" alt="" /><a href="/u.html" style="color:#fff; position:relative; top:5px; left:0px;"><?php echo ($bh); ?></a></span>
					<?php else: ?>
					<span id="k_userInfo"><img src="/Public/Mobile/Shangchengpc/images/first.png" height="25" width="25" alt=""><a href="/l.html" style="color:#fff; position:relative; top:5px; left:3px;">登录</a></span><?php endif; ?>
					<span><img src="/Public/Mobile/Shangchengpc/images/first-1.png" height="20" width="20" alt=""><a href="/q.html" style="color:#fff; position:relative; top:5px; left:3px;">渠道建设</a></span>
			   </li>
		   </ul>
		</div>
	</div>



     <form action="<?php echo U('Search/search'); ?>" method="get">
    <div class="box-one-search">
		<div class="header-one-search">
		   <ul>
			  <!-- <li class="logo">
					<a href="/gz.html" title="中时代积分商城"> <img src="/Public/Mobile/Shangchengpc/images/lanmufenlei.png" alt="" width="30" height="20"> </a>
			   </li>-->
			   <li class="shu-one-search">
              <input type="text" name="keyword" id="search_wd" value="请输入关键词" onfocus="if(value=='请输入关键词') {value=''}" onblur="if (value=='') {value='请输入关键词'}" >




                 <a><input type="submit" value=" " style="cursor:pointer;"></a>
			   </li>
			   <a href="<?php echo U('Search/message'); ?>">
			   <li class="xiaoxi">
                  <?php if($k == 0): ?><span style=" position:relative; top:-12px; text-align:center; right:-30px; font-size:0.8rem;">0          </span><?php endif; ?>
                   <?php if($k != 0): ?><span style=" position:relative; top:-12px; text-align:center; right:-30px; font-size:0.8rem;"><?php echo $k;?></span><?php endif; ?>
			   </li>
               </a>
		   </ul>
		</div>
	</div>
    </form>

	<div class="swiper-container swiper-container-horizontal">
		<div class="swiper-wrapper" style="transition-duration: 0ms; @media only screen and (min-device-width: 375px) and (max-device-width: 667px) and (orientation : portrait) {
        }
        @media only screen and (min-device-width: 375px) and (max-device-width: 667px) and (orientation : landscape) {
        }@media only screen and (min-device-width: 414px) and (max-device-width: 736px) and (orientation : portrait) {
        }
        @media only screen and (min-device-width: 414px) and (max-device-width: 736px) and (orientation : landscape) {
        }
">
			<?php if(is_array($lunbo)): foreach($lunbo as $key=>$l): ?><div class="swiper-slide">
				<a href="/">
					<img src="<?php echo ($l["column_images"]); ?>">
				</a>
			</div><?php endforeach; endif; ?>
		</div>
		<div class="swiper-pagination swiper-pagination-clickable">
			<span class="swiper-pagination-bullet"></span>
			<span class="swiper-pagination-bullet"></span>
			<span class="swiper-pagination-bullet"></span>
			<span class="swiper-pagination-bullet swiper-pagination-bullet-active"></span>
		</div>
	</div>
	<div class="box-one-3">
		<ul>
		   <li class="box-one-31">
				<a href="/p/f/all">
					<i><img src="/Public/Mobile/Shangchengpc/images/0b-1.jpg" height="35" width="35" alt=""></i>
					<span>全部产品</span>
				</a>
		   </li>
		   <li>
				<a href="/p/f/50.html">
					<i><img src="/Public/Mobile/Shangchengpc/images/0b-5.jpg" height="35" width="35" alt=""></i>
					<span>文化元素</span>
				</a>
		   </li>
		   <li>
				<a href="/p/f/51.html">
					<i><img src="/Public/Mobile/Shangchengpc/images/0b-2.jpg" height="35" width="35" alt=""></i>
					<span>健康元素</span>
				</a>
		   </li>
		   <li>
			   <a href="/p/f/52.html">
					<i><img src="/Public/Mobile/Shangchengpc/images/0b-4.jpg" height="35" width="35" alt=""></i>
					<span>稀缺元素</span>
				</a>
		   </li>
		   <li>
			    <a href="/p/f/53.html">
					<i><img src="/Public/Mobile/Shangchengpc/images/0b-5.jpg" height="35" width="35" alt=""></i>
					<span>特色美食</span>
				</a>
		   </li>


            <li>
				<a href="/p/f/54.html">
					<i><img src="/Public/Mobile/Shangchengpc/images/0b-05.jpg" height="35" width="35" alt=""></i>
					<span>时尚元素</span>
				</a>
		   </li>
		   <li>
				<a href="/p/f/55.html">
					<i><img src="/Public/Mobile/Shangchengpc/images/0b-6.jpg" height="35" width="35" alt=""></i>
					<span>服装元素</span>
				</a>
		   </li>
		   <li>
				<a href="/p/f/56.html">
					<i><img src="/Public/Mobile/Shangchengpc/images/0b-7.jpg" height="35" width="35" alt=""></i>
					<span>高科技</span>
				</a>
		   </li>
		   <li>
			   <a href="/p/f/57.html">
					<i><img src="/Public/Mobile/Shangchengpc/images/0b-8.jpg" height="35" width="35" alt=""></i>
					<span>红色元素</span>
				</a>
		   </li>
		   <li>
			    <a href="/p/f/58.html">
					<i><img src="/Public/Mobile/Shangchengpc/images/0b-9.jpg" height="35" width="35" alt=""></i>
					<span>民族艺术</span>
				</a>
		   </li>

		 </ul>
	</div>

<!--
 <table width="100%" border="0">
  <tr>
  <td><img src="/Public/Mobile/Shangchengpc/images/chufa.jpg" width="100%"></td>

  </tr>
</table>-->


<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="20%" height="50"><img src="/Public/Mobile/Shangchengpc/images/index_gonggao.jpg" width="100%"></td>
   <td width="80%" align="left" class="index_gonggao"><span style=" position:relative; top:-3px;">全国受理热线：4001-398-568</span></td>

  </tr>
</table>

 <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="49.8%"><a href="/bz.html"><img src="/Public/Mobile/Shangchengpc/images/help.jpg" width="100%"></a></td>
    <td width="0.04%">&nbsp;</td>
    <td width="49.8%"><a href="/down.html"><img src="/Public/Mobile/Shangchengpc/images/down.jpg" width="100%"></a></td>
  </tr>
</table>


	  <!--<div class="rukou">
		<a href="/" target="_blank"><img src="<?php echo ($lianjie); ?>" width="100%" alt=""></a>
	 </div>-->
	<div class="box-onea">
		<div class="box-one-5">
			<p style="font-size:16px; font-weight:700"><!--<a href="" style="color:#bb0000;">-->中时代精选产品<!--</a>--></p>
			<div class="box-one-51">
				<label id="lblPageIndex" style="display: none;">2</label>
				<ul id="ulHtml" class="ding">
					<?php if(is_array($jxlist)): foreach($jxlist as $key=>$jx): ?><li onClick="window.location.href='/d/b/<?php echo ($jx["id"]); ?>.html'">
                      <h5>&nbsp;<?php echo (msubstr($jx["name"],0,6)); ?></h5>
						<div style="text-align:center; padding:5px;"><img src="<?php echo ($jx["pic"]); ?>" alt="" style="vertical-align:middle;" width="100%"></div>
					   <p><?php if($jx['xianjing'] == 0): echo ($jx["jifen"]); ?>积分<?php else: ?><font style=" ">￥<?php echo ($jx["xianjing"]); ?></font>+<?php echo ($jx["jifen"]); ?>积分<?php endif; ?></p>
                    </li><?php endforeach; endif; ?>


				</ul>
				<!--<div class="jz_box">
					<img src="/Public/Mobile/Shangchengpc/images/loading.gif">
				</div>-->
			</div>
		</div>

        <!--<div class="box-one1-6">
			<p style="font-size:16px; font-weight:700"><a href="" style="color:#72afe8;">爱国消费卷</a></p>
			<div class="box-one-51">
				<label id="lblPageIndex" style="display: none;">2</label>
				<ul id="ulHtml" class="ding">
					<?php if(is_array($aglist)): foreach($aglist as $key=>$ag): ?><li onClick="window.location.href='/d/b/<?php echo ($ag["id"]); ?>.html'">
                      <h5>&nbsp;<?php echo (msubstr($ag["name"],0,6)); ?></h5>
						<div style="text-align:center;padding:5px;"><img src="<?php echo ($ag["pic"]); ?>" alt="" style="vertical-align:middle;" width="100%"></div>
							<p><?php if($ag['xianjing'] == 0): echo ($ag["jifen"]); ?>积分<?php else: ?><font style="">￥<?php echo ($ag["xianjing"]); ?></font>+<?php echo ($ag["jifen"]); ?>积分<?php endif; ?></p>
                    </li><?php endforeach; endif; ?>
				</ul>

			</div>
		</div>-->

         <div class="box-one1-7">
			<p style="font-size:16px; font-weight:700"><a href="" style="color:#37b00b;">推荐专区</a></p>

            <div class="box-one-71">
				<label id="lblPageIndex" style="display: none;">2</label>
				<ul id="ulHtml" class="ding">
                    <?php if(is_array($tjblist)): foreach($tjblist as $key=>$tjb): ?><li onClick="window.location.href='/d/b/<?php echo ($tjb["id"]); ?>.html'">
                        <h5>&nbsp;<?php echo (msubstr($tjb["name"],0,6)); ?></h5>
						<div style="text-align:center;padding:5px;"><img src="<?php echo ($tjb["pic"]); ?>" alt="" style="vertical-align:middle;" width="100%"></div>
							<p><?php if($tjb['xianjing'] == 0): echo ($tjb["jifen"]); ?>积分<?php else: ?><font style=" font-weight:bold;">￥<?php echo ($tjb["xianjing"]); ?></font>+<?php echo ($tjb["jifen"]); ?>积分<?php endif; ?></p>
                    </li><?php endforeach; endif; ?>
				</ul>

			</div>

			<div class="box-one-51">
				<label id="lblPageIndex" style="display: none;">2</label>
				<ul id="ulHtml" class="ding">
					<?php if(is_array($tjlist)): foreach($tjlist as $key=>$tj): ?><li onClick="window.location.href='/d/b/<?php echo ($tj["id"]); ?>.html'">
                        <h5>&nbsp;<?php echo (msubstr($tj["name"],0,6)); ?></h5>
							<div style="text-align:center;padding:5px;"><img src="<?php echo ($tj["pic"]); ?>" alt="" style="vertical-align:middle;" width="100%"></div>
							<p><?php if($tj['xianjing'] == 0): echo ($tj["jifen"]); ?>积分<?php else: ?><font style="">￥<?php echo ($tj["xianjing"]); ?></font>+<?php echo ($tj["jifen"]); ?>积分<?php endif; ?></p>


                    </li><?php endforeach; endif; ?>
				</ul>

			</div>
		</div>


        <div class="box-one1-8">
			<p style="font-size:18px; font-weight:700"><a href="" style="color:#b773e4;">新品专区</a></p>


            <div class="box-one-71">
				<label id="lblPageIndex" style="display: none;">2</label>
				<ul id="ulHtml" class="ding">
                    <?php if(is_array($xpblist)): foreach($xpblist as $key=>$xpb): ?><li onClick="window.location.href='/d/b/<?php echo ($xpb["id"]); ?>.html'">
                         <h5>&nbsp;<?php echo (msubstr($xpb["name"],0,6)); ?></h5>
						<div style="text-align:center;padding:5px;"><img src="<?php echo ($xpb["pic"]); ?>" alt="" style="vertical-align:middle;" width="100%"></div>
							<p><?php if($xpb['xianjing'] == 0): echo ($xpb["jifen"]); ?>积分<?php else: ?><font style=" ">￥<?php echo ($xpb["xianjing"]); ?></font>+<?php echo ($xpb["jifen"]); ?>积分<?php endif; ?></p>
                    </li><?php endforeach; endif; ?>
				</ul>

			</div>
			<div class="box-one-51">
				<label id="lblPageIndex" style="display: none;">2</label>
				<ul id="ulHtml" class="ding">
					<?php if(is_array($xplist)): foreach($xplist as $key=>$xp): ?><li onClick="window.location.href='/d/b/<?php echo ($xp["id"]); ?>.html'">
                         <h5>&nbsp;<?php echo (msubstr($xp["name"],0,6)); ?></h5>
							<div style="text-align:center;padding:5px;"><img src="<?php echo ($xp["pic"]); ?>" alt="" style="vertical-align:middle;" width="100%"></div>
							<p><?php if($xp['xianjing'] == 0): echo ($xp["jifen"]); ?>积分<?php else: ?><font style="">￥<?php echo ($xp["xianjing"]); ?></font>+<?php echo ($xp["jifen"]); ?>积分<?php endif; ?></p>

                    </li><?php endforeach; endif; ?>
				</ul>

			</div>
		</div>

	</div>
<!--	<?php if($v['pos'] == 1): ?><a href=<?php echo U("CanshuEdit/index",array('id'=>$v[id]));?> >编辑</a><?php else: ?><a href="/shangcheng/index/del/id/<?php echo ($v["id"]); ?>" onclick="return confirm('是否确定删除?')">删除</a><?php endif; ?></td><div class="fixad">
		<p class="clos"><font>关闭</font></p>
		<p class="clos hov"><font>显示</font></p>
		<span id="add"><a href="notice.html"><img src="/Public/Mobile/Shangchengpc/images/gaad.jpg"></a></span>
	</div>
	<style type="text/css">
		.fixad{position: fixed;bottom: 4rem;right: 0.5rem;text-align: right;}
		.fixad span img{width: 75%;}
		.fixad .clos{display: block;text-align: right;}
		.fixad .clos font{display: inline-block;width:3rem;line-height: 1.5rem;background: #a6937c;color: #fff;height:1.5rem;text-align: center;font-size: .45rem;}
		.fixad .clos.hov{display: none;}
		.fixad #add{display: inline-block;float: right;}
	</style>-->
<script type="text/javascript">
	$(function(){
		$(".clos").click(function(){
			//$(".clos font").html("显示");
			$("#add").toggle();
			$(this).addClass("hov");
			$(this).siblings().removeClass("hov");

		});

	})
	//对图片处理，使所有高度一致。。
//	var img_first= $('.box-one-51').find('img')[0];
//	var first_height = img_first.height;
//	console.log(first_height);
//    $('.box-one-51').find('img').each(function (i,item) {
//		item.style.height = first_height+'px';
//    });
//
//	var dev_width = window.innerWidth;
//	if(dev_width>='414'){
//        $('.box-one-51').find('img').each(function (i,item) {
//            item.height = 95;
//        });
//	}
</script>
	<span class="box-one-7">
	   <?php echo ($config["config_powerby"]); ?>&nbsp;&nbsp;
	  <script type="text/javascript">
        var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1260828942'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s4.cnzz.com/z_stat.php%3Fid%3D1260828942%26show%3Dpic1' type='text/javascript'%3E%3C/script%3E"));
	  </script>
	</span>
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
<!--<div class="toTop" id="roll_top">返回</div>-->
</body>
</html>