<?php if (!defined('THINK_PATH')) exit();?>﻿<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>欢迎您登录中时代积分商城管理平台</title>
		<LINK rel=stylesheet type=text/css href="/App/Shangchengmanage/View/Default/css/login.css">
		<LINK rel=stylesheet type=text/css href="/App/Shangchengmanage/View/Default/css/blue_color.css">
		<!--[if lt IE 9]>
    <script type="text/javascript" src="__STATIC__/jquery-1.10.2.min.js"></script>
    <![endif]-->
    <!--[if gte IE 9]><!-->
    <script type="text/javascript" src="/App/Shangchengmanage/View/Default/js/jquery-2.0.3.min.js"></script>
    <!--<![endif]-->
        <!--<link rel="stylesheet" type="text/css" href="__CSS__/login.css?v={:SITE_VERSION}" media="all">
       	<link rel="stylesheet" type="text/css" href="__CSS__/{$Think.config.COLOR_STYLE}.css?v={:SITE_VERSION}" media="all">-->


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
    <body id="login-page">
        <div id="main-content">
            <!-- 主体 -->
            <div class="login-body">
                <table width="390" border="0" cellpadding="0" cellspacing="0" align="center" style="margin:auto;">
                      <tr>
                        <td>
                           
                           <div class="login-main pr">
                              <div class="login-bodyffff"> 
                                <form action="/shangchengmanage/login/do_login" method="post">
                                     <div class="login-logo ">
                                     
                                        <table width="290" border="0" cellpadding="0" cellspacing="0" align="center" style="margin:auto;">
                                          <tr>
                                            <td align="center"><img src="/App/Shangchengmanage/View/Default/images/logo_title.png"></td>
                                          </tr>
                                          <tr>
                                            <td align="center" >
                                             
                                            
                                            <input type="text" name="admin_name" id="user" class="yonghuming" value="请填写用户名" onfocus="if(value=='请填写用户名') {value=''}" onblur="if (value=='') {value='请填写用户名'}"></td>
                                          </tr>
                                          <tr>
                                            <td align="center" ><input type="text"  id= 'password' class="mima"  name="admin_pass" value="请填写密码" onfocus="if(value=='请填写密码') {value=''}" onblur="if (value=='') {value='请填写密码'}"></td>
                                          </tr>
                                          <tr>
                                            <td>
                                                <table width="290" border="0" cellpadding="0" cellspacing="0"  align="center" style="margin:auto;">
                                                  <tr>
                                                    <td align="center" style="margin:auto;"><input type="text" class="yanzhengma" id="num" name="verify"  value="请填写验证码"  onfocus="if(value=='请填写验证码') {value=''}" onblur="if (value=='') {value='请填写验证码'}"></td>
                                                     <td align="center"><img class="verifyimg reloadverify"  alt="点击切换" src="/Shangchengmanage/Login/verify.html" style="margin-left:10px; position:relative; top:10px; width:90px;"></td>
                                                  </tr>
                                                </table>
              
                                            </td>
                                          </tr>
                                         
                                        </table>
              
                                      
                                       <div style="width:290px; margin:20px auto; clear:both;"><input type="submit" value=" " class="tijao"></div>
                                       
                                     </div>
                                </form>
                                </div>
                </div>
                         
                        </td>
                      </tr>
                    </table>

            </div>
        </div>
	<!--[if lt IE 9]>
    <script type="text/javascript" src="__STATIC__/jquery-1.10.2.min.js"></script>
    <![endif]-->
    <!--[if gte IE 9]><!
    <script type="text/javascript" src="/Weizhuan/Weizhuanadmin/View/js/jquery-2.0.3.min.js"></script>-->
    <!--<![endif]-->
    <script type="text/javascript">
    	/* 登陆表单获取焦点变色 */
    	$(".login-form").on("focus", "input", function(){
            $(this).closest('.item').addClass('focus');
        }).on("blur","input",function(){
            $(this).closest('.item').removeClass('focus');
        });
    	//表单提交
    	$(document)
	    	.ajaxStart(function(){
	    		$("button:submit").addClass("log-in").attr("disabled", true);
	    	})
	    	.ajaxStop(function(){
	    		$("button:submit").removeClass("log-in").attr("disabled", false);
	    	});
    	$("form").submit(function(){
    		var self = $(this);
			if($('#user').val()==""){
				success('placeholder_un');
				$('#user').focus();
				return false
			}
			if($('#pass').val()==""){
				success('placeholder_pwd');
				$('#pass').focus();
				return false
			}
			if($('#num').val()==""){
				success('placeholder_check');
				$('#num').focus();
				return false
			}
			//return false;
    		function success(data){
				self.find(".check-tips").text($('.'+data).text());
				//刷新验证码
				$(".reloadverify").click();
    			/*if(data.status){
    				window.location.href = data.url;
    			} else {
    				self.find(".check-tips").text(data.info);
    				//刷新验证码
    				$(".reloadverify").click();
    			}*/
    		}
    	});
		$(function(){
			//初始化选中用户名输入框
			$("#itemBox").find("input[name=admin_name]").focus();
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
		
		$(function(){
			$('#password').focus(function(){
				$('#password').attr('type','password');
				
				});
			});
    </script>
</body>
</html>