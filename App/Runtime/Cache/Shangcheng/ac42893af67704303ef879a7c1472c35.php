<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="yes" name="apple-touch-fullscreen">
    <meta content="telephone=no,email=no" name="format-detection">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
	<title><?php echo ($config["config_webname"]); ?>-登录</title>
	<link rel="stylesheet" href="/Public/Mobile/Shangchengpc/css/denglu.css" />
	<link rel="stylesheet" href="/Public/Mobile/Shangchengpc/css/default.css" />
	<style>
		body{ background: url(/Public/Mobile/Shangchengpc/images/denglu_bg.jpg) no-repeat; background-size: 100% }
	</style>
    <script src="/Public/Mobile/Shangchengpc/js/jquery-2.1.4.min.js"></script> 
	<script src="/Public/Mobile/Shangchengpc/js/rem2.js"></script>
</head>
<body>
<!-- 会员登录 -->
<div class="denglu">
	<h1>会员登录</h1>
	<div class="denglu_con">
		<form method='post' id="form" action="/l.html">
			<div class="dlbh">
            <span class="dl_span"></span>
            <input class="dl_bh" type="text" name="bh" id="bh" value="<?php echo ($bh); ?>" placeholder="登录编号"/>
            </div>
            
			<div class="dlbh">
            <span class="mm_span"></span>
            <input class="dl_bh" type="password" name="pass"  id="pass"  placeholder="请输入密码"/>
            </div>
			
            <div class="dlbh"><span class="yzm_span"></span><input class="yzm_bh" name="verify" id="num" type="text" placeholder="请输验证码"/><div class="yzm"><a href="#"><img class="verifyimg reloadverify" src="/Shangchengmanage/Login/verify.html" alt=""></a></div></div>
			<div class="denglu_an">
            <input type="button" value="登录" onclick="get_user_login()">
            </div>
			<div class="zhuce">
				<span class="zhuce_zi"><a href="/r.html">立即注册</a></span>
				<span class="zc_mm"><a href="/wj1.html">忘记密码？</a></span>
			</div>
		</form>
	</div>
</div>    

<script>
	/*$(function () {
		loginOut();
		createCode();
	})*/
function get_user_login(){

	
	if($('#bh').val()==''){

		alert('登录编号不能为空');
		return false;
	}
	if($('#pass').val()==''){
		alert('密码不能为空');
		return false;
	}
	if($('#num').val()==''){
		alert('验证码不能为空');
		return false;
	}
	
	$('#form').submit();
}


</script>
<script type="text/javascript">

		$(function(){
			
			//刷新验证码
			var verifyimg = $(".verifyimg").attr("src");
            $(".reloadverify").click(function(){
                if( verifyimg.indexOf('?')>0){
                    $(".verifyimg").attr("src", verifyimg+'&random='+Math.random());
                }else{
                    $(".verifyimg").attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random());
                }
            });
		});
		
	
    </script>
</body>
</html>