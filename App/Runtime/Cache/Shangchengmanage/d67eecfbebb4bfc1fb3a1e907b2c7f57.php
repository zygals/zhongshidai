<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>中时代积分商城后台管理系统</title>
<script language="javascript" type="text/javascript" src="/App/Shangchengmanage/View/Default/js/jquery.js"></script>
<script src="/App/Shangchengmanage/View/Default/js/frame.js" language="javascript" type="text/javascript"></script>
<link href="/App/Shangchengmanage/View/Default/css/frame.css" rel="stylesheet" type="text/css" />
<link href="/App/Shangchengmanage/View/Default/css/style.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script src="/App/Shangchengmanage/View/Default/js/DD_belatedPNG.js" language="javascript" type="text/javascript"></script>
<script>
  DD_belatedPNG.fix('.nav ul li a,.top_link ul li,background');   /* string argument can be any CSS selector */
</script>
<![endif]-->
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
<body class="showmenu">
<div class="pagemask"></div>
<div class="head">
<div style="margin-top:25px;">
<div class="top_logo"></div>

     <div class="nav" id="nav">
      <ul>
          <?php if($_SESSION['admin_type'] == 0): ?><li id="menu_count"><a class="thisclass" href="<?php echo U('User/index');?>" _for="common" target="main"><b>常规管理</b></a></li>
         <?php else: ?>
          
		  <li id="menu_count"><a class="thisclass" href="<?php echo U('Goods/index');?>" _for="common" target="main"><b>常规管理</b></a></li><?php endif; ?>
		<!--  <?php if($_SESSION['admin_type'] != 2): ?><li id="menu_search"><a href="<?php echo U('System/pcruntime');?>" _for="search" target="main"><b>缓存设置</b></a></li>-->
		  <li id="menu_order"><a href="<?php echo U('Personal/index');?>" _for="content" target="main"><b>账户管理</b></a></li>
		  <li id="menu_sys"><span class="nav_fl"></span><a href="<?php echo U('System/index');?>" _for="system" target="main"><b>系统设置</b></a><span class="nav_fr"></span></li>
		  <li id="menu_banner"><a href="<?php echo U('Banner/index');?>" _for="banner" target="main"><b>营销管理</b></a></li><?php endif; ?>
      </ul>
    </div>
    
    
	 <div class="top_link">
      <ul>
	    <li id="i_self">&nbsp;你好<?php echo ($_SESSION["admin_name"]); ?>
		<?php if($_SESSION['admin_type'] != 1): ?><span style="color:#FFFFFF">[超级]</span>
		<?php else: ?>
		<span style="color:#FFFFFF">[商城]</span><?php endif; ?>
		</li>
		<li id="i_hide_menu"><a href="#" id="togglemenu">隐藏菜单</a></li>
        <li id="i_home"><a href="" target="_blank">首页</a></li>  
        <li id="i_exit"><a href="/shangchengmanage/admin/login_out" target="_top">退出</a></li>		
      </ul>
    </div>
</div>
</div>
<!-- header end -->
<?php if($_SESSION['admin_type'] == 0): ?><div class="left">
<div class="span"></div>
<div class="menu" id="menu">
<div id="items_banner">
	
	<dl id="dl_items_1_1">
		<dt>轮播管理</dt>
		<dd>
		<ul>
		<li><a href="<?php echo U('Banner/index');?>" target="main">● 轮播管理</a></li>
		</ul>
		</dd>
	</dl>
	<dl id="dl_items_1_1">
		<dt>图片管理</dt>
		<dd>
		<ul>
		<li><a href="<?php echo U('Banner/tupian');?>" target="main">● 首页图片</a></li>
		</ul>
		</dd>
	</dl>
</div>
<div id="items_system">
	<dl id="dl_items_1_1">
		<dt>系统设置</dt>
		<dd>
		<ul>
		<li><a href="<?php echo U('System/index');?>" target="main">● 网站设置</a></li>
		<li><a href="<?php echo U('System/moban');?>" target="main">● 模板管理</a></li>
		<li><a href="<?php echo U('kefu/index');?>" target="main">● 在线客服设置</a></li>
		<li><a href="<?php echo U('Model/index');?>" target="main">● 模型管理</a></li>
		<li><a href="<?php echo U('Database/index');?>" target="main">● 数据库管理</a></li>
		<li><a href="<?php echo U('System/fenye');?>" target="main">● 数据分页</a></li>
		</ul>
		</dd>
	</dl>
</div><!-- Item End -->
<div id="items_content">
<dl id="dl_items_1_2">
        <dt>我的账户</dt>
        <dd>
          <ul>
		<li><a href="<?php echo U('Personal/index');?>" target="main">● 修改我的信息</a></li>
		<li><a href="<?php echo U('Personal/pass');?>" target="main">● 修改我的密码</a></li>
		<li><a href="<?php echo U('Personal/listadmin');?>" target="main">● 后台管理员列表</a></li>
		</ul>
</dd>
</dl>



</div>
<div id="items_search">
<dl id="dl_items_1_3">
	<dt>静态缓存状态</dt>
	<dd>
		<ul>
			<li><a target="main" href="<?php echo U('System/Pcruntime');?>">● 电脑端缓存</a></li>
			<li><a target="main" href="<?php echo U('System/Mbruntime');?>">● 手机端缓存</a></li>
		</ul>
	</dd>
</dl>
<dl id="dl_items_1_3">
	<dt>电脑端缓存更新</dt>
	<dd>
		<ul>
			<li><a target="main" href="<?php echo U('System/clearRuntime');?>">● 清除系统缓存</a></li>
			<li><a target="main" href="<?php echo U('System/clearhtml');?>">● 一键更新全站</a></li>
			<li><a target="main" href="<?php echo U('System/clearhome');?>">● 更新首页</a></li>
			<li><a target="main" href="<?php echo U('System/cleargroup');?>">● 更新栏目</a></li>
			<li><a target="main" href="<?php echo U('System/cleardetail');?>">● 更新文档</a></li>		
		</ul>
	</dd>
</dl>
<dl id="dl_items_1_3">
	<dt>手机端缓存更新</dt>
	<dd>
		<ul>
			<li><a target="main" href="<?php echo U('System/clearRuntime');?>">● 清除系统缓存</a></li>
			<li><a target="main" href="<?php echo U('System/mclearhtml');?>">● 一键更新全站</a></li>
			<li><a target="main" href="<?php echo U('System/mclearhome');?>">● 更新首页</a></li>
			<li><a target="main" href="<?php echo U('System/mcleargroup');?>">● 更新栏目</a></li>
			<li><a target="main" href="<?php echo U('System/mcleardetail');?>">● 更新文档</a></li>		
		</ul>
	</dd>
</dl>
</div>
<div id="items_common">
	<dl id="dl_items_1_1">
		<dt>会员管理</dt>
		<dd>
			<ul>
				<li><a href="<?php echo U('User/index');?>" target="main">● 会员管理</a></li>
                <li><a href="<?php echo U('User/old');?>" target="main">● 老积分</a></li>
                <li><a href="<?php echo U('User/rmbchongzhi');?>" target="main">● 充值/提现审核</a></li>
                <li><a href="<?php echo U('OnlinePay/index');?>" target="main">● 在线充值记录</a></li>
                <li><a href="<?php echo U('Fenhong/index');?>" target="main">● 分红比例</a></li>
				<li><a href="<?php echo U('Dengji/index');?>" target="main">● 会员等级</a></li>
                <li><a href="<?php echo U('User/countjifen');?>" target="main">● 积分统计</a></li>
				
			</ul>
		</dd>
	</dl>
	<dl id="dl_items_1_2">
		<dt>商城管理</dt>
		<dd>
		<ul>
			<li><a href="<?php echo U('Goodsfenlei/index');?>" target="main">● 商品分类</a></li>
			<li><a href="<?php echo U('Goods/index');?>" target="main">● 商品管理</a></li>
			<li><a href="<?php echo U('Gonggao/index');?>" target="main">● 公告管理</a></li>
			<li><a href="<?php echo U('Dingdan/index');?>" target="main">● 订单管理</a></li>
			<li><a href="<?php echo U('Help/index');?>" target="main">● 帮助管理</a></li>
            <li><a href="<?php echo U('Down/index');?>" target="main">● 下载管理</a></li>
            <li><a href="<?php echo U('Message/index');?>" target="main">● 站内信息发送</a></li>
		</ul>
		</dd>
	</dl>
	<dl id="dl_items_1_4">
		<dt>待用返还</dt>
		<dd>
		<ul>
			<li><a href="<?php echo U('Fanhuan/index');?>" target="main">● 待用返还</a></li>
            <li><a href="<?php echo U('Gedaiquchou/index');?>" target="main">● 隔代取酬</a></li>
            <li><a href="<?php echo U('Futou/futoushenhe');?>" target="main">● 复投审核</a></li>

		</ul>
		</dd>
	</dl>
	<dl id="dl_items_1_4">
		<dt>参数设置</dt>
		<dd>
		<ul>
            <li><a href="<?php echo U('Canshu/index');?>" target="main">● 发布新期次</a></li>
            <li><a href="<?php echo U('CanshuManager/index');?>" target="main">● 期次管理</a></li>
		</ul>
		</dd>
	</dl>
</div>
</div>
</div>
<!-- left end -->
<div class="right">
	<div class="rightContent">
    
	<iframe id="main" name="main" frameborder="0" src="<?php echo U('User/index');?>" ></iframe>
	</div>    
</div>
<!-- right end -->
<!--<div class="qucikmenu" id="qucikmenu">
  <ul>
<li><a href="content_list.htm" target="main">数据列表</a></li>
<li><a href="catalog_main.htm" target="main">栏目管理</a></li>
<li><a href="sys_info.htm" target="main">修改系统参数</a></li>
  </ul>
</div>-->
<!-- qucikmenu end --><?php endif; ?>
<?php if($_SESSION['admin_type'] == 1): ?><div class="left">
<div class="span"></div>
<div class="menu" id="menu">
<div id="items_banner">
	
	<dl id="dl_items_1_1">
		<dt>轮播管理</dt>
		<dd>
		<ul>
		<li><a href="<?php echo U('Banner/index');?>" target="main">● 轮播管理</a></li>
		</ul>
		</dd>
	</dl>
	<dl id="dl_items_1_1">
		<dt>图片管理</dt>
		<dd>
		<ul>
		<li><a href="<?php echo U('Banner/tupian');?>" target="main">● 首页图片</a></li>
		</ul>
		</dd>
	</dl>
</div>
<div id="items_system">
	<dl id="dl_items_1_1">
		<dt>系统设置</dt>
		<dd>
		<ul>
		<li><a href="<?php echo U('System/index');?>" target="main">● 网站设置</a></li>
		<li><a href="<?php echo U('kefu/index');?>" target="main">● 在线客服设置</a></li>
		</ul>
		</dd>
	</dl>
</div>
<!-- Item End -->
<div id="items_content">
<dl id="dl_items_1_2">
        <dt>我的账户</dt>
        <dd>
          <ul>
		<li><a href="<?php echo U('Personal/index');?>" target="main">● 修改我的信息</a></li>
		<li><a href="<?php echo U('Personal/pass');?>" target="main">● 修改我的密码</a></li>
		
		</ul>
</dd>
</dl>





</div>
<div id="items_search">
<dl id="dl_items_1_3">
	<dt>静态缓存状态</dt>
	<dd>
		<ul>
			<li><a target="main" href="<?php echo U('System/Pcruntime');?>">● 电脑端缓存</a></li>
			<li><a target="main" href="<?php echo U('System/Mbruntime');?>">● 手机端缓存</a></li>
		</ul>
	</dd>
</dl>
<dl id="dl_items_1_3">
	<dt>电脑端缓存更新</dt>
	<dd>
		<ul>
			<li><a target="main" href="<?php echo U('System/clearRuntime');?>">● 清除系统缓存</a></li>
			<li><a target="main" href="<?php echo U('System/clearhtml');?>">● 一键更新全站</a></li>
			<li><a target="main" href="<?php echo U('System/clearhome');?>">● 更新首页</a></li>
			<li><a target="main" href="<?php echo U('System/cleargroup');?>">● 更新栏目</a></li>
			<li><a target="main" href="<?php echo U('System/cleardetail');?>">● 更新文档</a></li>		
		</ul>
	</dd>
</dl>
<dl id="dl_items_1_3">
	<dt>手机端缓存更新</dt>
	<dd>
		<ul>
			<li><a target="main" href="<?php echo U('System/clearRuntime');?>">● 清除系统缓存</a></li>
			<li><a target="main" href="<?php echo U('System/mclearhtml');?>">● 一键更新全站</a></li>
			<li><a target="main" href="<?php echo U('System/mclearhome');?>">● 更新首页</a></li>
			<li><a target="main" href="<?php echo U('System/mcleargroup');?>">● 更新栏目</a></li>
			<li><a target="main" href="<?php echo U('System/mcleardetail');?>">● 更新文档</a></li>		
		</ul>
	</dd>
</dl>
</div>
<div id="items_common">
	
	<dl id="dl_items_1_2">
		<dt>商城管理</dt>
		<dd>
		<ul>
			<li><a href="<?php echo U('Goodsfenlei/index');?>" target="main">● 商品分类</a></li>
			<li><a href="<?php echo U('Goods/index');?>" target="main">● 商品管理</a></li>
			<li><a href="<?php echo U('Gonggao/index');?>" target="main">● 公告管理</a></li>
			<li><a href="<?php echo U('Dingdan/index');?>" target="main">● 订单管理</a></li>
			<li><a href="<?php echo U('Help/index');?>" target="main">● 帮助管理</a></li>
            <li><a href="<?php echo U('Down/index');?>" target="main">● 下载管理</a></li>
            <li><a href="<?php echo U('Message/index');?>" target="main">● 站内信息发送</a></li>
		</ul>
		</dd>
	</dl>
</div>
</div>
</div>
<!-- left end -->
<div class="right">
	<div class="rightContent">
    
    
	    <iframe id="main" name="main" frameborder="0" src="<?php echo U('Goods/index');?>" ></iframe>
    
    
	</div>    
</div>
<!-- right end -->
<!--<div class="qucikmenu" id="qucikmenu">
  <ul>
<li><a href="content_list.htm" target="main">数据列表</a></li>
<li><a href="catalog_main.htm" target="main">栏目管理</a></li>
<li><a href="sys_info.htm" target="main">修改系统参数</a></li>
  </ul>
</div>-->
<!-- qucikmenu end --><?php endif; ?>



</body>
</html>