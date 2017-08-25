<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="yes" name="apple-touch-fullscreen">
    <meta content="telephone=no,email=no" name="format-detection">
	<title>立即注册</title>
<meta name="keywords" content="<?php echo ($config["config_webkw"]); ?>"/>
<meta name="description" content="<?php echo ($config["config_cp"]); ?>" />
<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="/Public/Mobile/Shangchengpc/css/zhuce.css" />
	<link rel="stylesheet" href="/Public/Mobile/Shangchengpc/css/default.css" />

<script src="/Public/Mobile/Shangchengpc/js/rem.js"></script>
<script src="/Public/Mobile/Shangchengpc/js/jquery-2.1.4.min.js"></script>
<script src="/Public/Mobile/Shangchengpc/js/j_reg.js"></script>
<script src="/Public/Mobile/Shangchengpc/js/jquery-1.11.3.min.js"></script>
<script src="/Public/Mobile/Shangchengpc/js/jq.js"></script>
<script language="Javascript" type="text/javascript"> 
function ChangeDiv(divId,divName,zDivCount) 
{ 
for(i=0;i<=zDivCount;i++) 
{ 
document.getElementById(divName+i).style.display="none"; 
} 
document.getElementById(divName+divId).style.display="block"; 
} 
</script> 
</head>
<body>
<div class="zc_top">
	<span><a href="l.html"><img src="/Public/Mobile/Shangchengpc/images/zc_top_back.png" alt=""></a></span>
	<h2>会员注册</h2>
	<samp><a href="index"><img src="/Public/Mobile/Shangchengpc/images/zc_top_home.png" alt=""></a></samp>
</div>
<div class="zc_con">
	<div class="zc_con_top">◆ 手机注册</div>
	<div class="zc_con_con">
		<form method="post" action="<?php echo U('Index/zhuce'); ?>"  onsubmit="return checktwo()" enctype="multipart/form-data">
		<div class="zc_list">
           <input type="text" value="请输入真实姓名" name="trueName" id="trueName" onfocus="if(value=='请输入真实姓名') {value=''}" >
           </div>
            <div class="zc_list">
            <input type="text" value="请输入身份证" name="idcard" id="idcard" onfocus="if(value=='请输入身份证') {value=''}">
            </div>
		  <div class="zc_list">
           <input type="text" value="请输入手机号码" name="mobile" id="mobile" onfocus="if(value=='请输入手机号码') {value=''}" >
          <span><input type="submit"  id="hqyzm"  value="获取验证码" style=" cursor:pointer;"></span>
      </div>
			<div class="zc_list code_txt">
            <input type="text" value="请输入验证码" name="code" id="j_usercode" onfocus="if(value=='请输入验证码') {value=''}" >
            </div>
			<div class="zc_list">
           <input type="password" value="111111" name="user_pass" readonly>
            </div>
			<div class="zc_list">
           <input type="password" value="111111" name="user_zfpass" readonly>
            </div>
			<div class="zc_list">
           <input type="password" value="222222"  name="user_zfpass" readonly>
            </div>
            
            <script type="text/javascript">
   function getval(){
    var j_TuiJianming=$("#j_TuiJianming").val();
        $.ajax({
            type:"POST",
            url:"<?php echo U('Index/do_reg');?>",
            //data: {"j_TuiJianming":j_TuiJianming},
			data:"j_TuiJianming="+j_TuiJianming,
             success:function(data){
					 $("#j_TuiJianNum2").empty();
                        var count = data.length;
                        var i = 0;
                        var b="";
                           for(i=0;i<count;i++){
                               b+="<option value='"+data[i].user_login_bh+"'>"+data[i].user_login_bh+"</option>";
                           }
                        $("#j_TuiJianNum2").append(b);
						  }
        });
    }
  </script>
  <style>
     .zc_list label{ font-size:.28rem;color: #858585;}
	 #radio1{ width:.25rem; height:.2rem;}
	 #radio2{ width:.25rem; height:.2rem;}
	 #xieyi{ width:.25rem; height:.2rem;}
  </style>
        <div class="zc_list">
           <input type="radio" name="radio1" id="radio1"  value="1" onclick="Javascript:ChangeDiv('0','JKDiv_',1)" style="cursor:hand;" checked="checked"/><label for="radio1">直接输入编号</label> 
           <input type="radio" name="radio1"  id="radio2" value="2"  onclick="Javascript:ChangeDiv('1','JKDiv_',1)" style="cursor:hand;"/><label for="radio2">输入姓名查找编号</label> 
            </div>
            
            <div id="JKDiv_0" >
            <div class="zc_list">
            <input type="text" value="请输入推荐人编号" name="j_TuiJianNum" id="j_TuiJianNum" onfocus="if(value=='请输入推荐人编号') {value=''}" >
            </div>
            </div>
            
            
            
            <div id="JKDiv_1" style="display:none;">
            <div class="zc_list">
         <input type="text" value="请输入推荐人姓名" name="j_TuiJianming" id="j_TuiJianming" onfocus="if(value=='请输入推荐人姓名') {value=''}">
            </div>
			<div class="zc_list">
               <select name="j_TuiJianNum"  id="j_TuiJianNum2" style="height:71px; width:270px;line-height:30px;border-radius:5px;"></select>
               </div>
			</div>
            
			<div class="yuedu">
				<input name="xieyi" type="checkbox" value=""  id="xieyi"/>
				我已阅读并同意<a href="#" id="syxdz" style=" cursor:pointer;">《中华时代用户协议》</a>
			</div>
			<div class="zhuce_sj">
				<input type="submit" id="sub" value="注册" style=" cursor:pointer;" >
			</div>
			<div class="zhdl">已有账号？<a href="/l.html" style=" cursor:pointer;">直接登录</a></div>
		</form>
	</div>
</div>
<div class="heibeijing"> 
	<div class="syxdz">
    	<div class="syxdz_m">
        	<div class="syxdz_gb"><img src="/Public/Mobile/Shangchengpc/images/gb.png" style=" cursor:pointer;"></div>
        	<p style=" color:red;">中华时代用户协议</p>
            <div style=" margin-left:0.2rem;margin-top:0.2rem;margin-bottom:0.4rem;height:460px; overflow:auto;" >
            	   <p style="font-size: .2rem; text-indent: .5rem; line-height:.3rem; letter-spacing:0.0175rem;">牡丹江政府把链接客服你说的话政府把链接客服你说的话政府把链接客服你说的话比较少扥会明白就开始让他你们好看人面桃花积极思考位让他还没生日卡通漫画今年的烤肉饭还没牡丹江政府把链接客服你说的话政府把链接客服你说的话政府把链接客服你说的话比较少扥会明白就开始让他你们好看人面桃花积极思考位让他还没生日卡通漫画今年的烤肉饭还没牡丹江政府把链接客服你说的话政府把链接客服你说的话政府把链接客服你说的话比较少扥会明白就开始让他你们好看人面桃花积极思考位让他还没生日卡通漫画今年的烤肉饭还没牡丹江政府把链接客服你说的话政府把链接客服你说的话政府把链接客服你说的话比较少扥会明白就开始让他你们好看人面桃花积极思考位让他还没生日卡通漫画今年的烤肉饭还没牡丹江政府把链接客服你说的话政府把链接客服你说的话政府把链接客服你说的话比较少扥会明白就开始让他你们好看人面桃花积极思考位让他还没生日卡通漫画今年的烤肉饭还没牡丹江政府把链接客服你说的话政府把链接客服你说的话政府把链接客服你说的话比较少扥会明白就开始让他你们好看人面桃花积极思考位让他还没生日卡通漫画今年的烤肉饭还没牡丹江政府把链接客服你说的话政府把链接客服你说的话政府把链接客服你说的话比较少扥会明白就开始让他你们好看人面桃花积极思考位让他还没生日卡通漫画今年的烤肉饭还没通漫画今年的烤肉饭还没通漫画今年的烤肉饭还没通漫画今年的烤肉饭还没通漫画今年的烤肉饭还没通漫画今年的烤肉饭还没通漫画今年的烤肉饭还没通漫画今年的烤肉饭还没通漫画今年的烤肉饭还没通漫画今年的烤肉饭还没通漫画今年的烤肉饭还没通漫画今年的烤肉饭还没通漫画今年的烤肉饭还没</p> 
          </div>
        </div>
    </div>
</div>
</body>
</html>

<script type="text/javascript">
$(function(){
	  $('#pwd1').focus(function(){
		  $('#pwd1').attr('type','password');
		  });
	});
$(function(){
	$('#rpwd1').focus(function(){
		$('#rpwd1').attr('type','password');
		});
});
$(function(){
	  $('#pwd2').focus(function(){
		  $('#pwd2').attr('type','password');
		  });
});
</script>
<script type="text/javascript">

    $('#hqyzm').click(function(){
        var logincheck = /^1[3458]\d{9}$/;
        if(!logincheck.test($("#mobile").val())){
            $("#mobile_check").attr("class","tip_false");
            $('#mobile').focus();
            return false;
        }else{
            $("#mobile_check").attr("class","tip_true");
            time(this);
        };
       var mobile = $('#mobile').val(); 
      $.post("<?php echo U('Index/setCode'); ?>",{mobile:mobile},function(result){
      console.log(result);  
    $("span").html();
  });
     });
    var wait=60;
    function time(o) {
        if (wait == 0) {
            o.removeAttribute("disabled");
            o.value="发送验证码";
            wait = 60;
        } else {
            o.setAttribute("disabled", true);
            o.value="重新发送(" + wait + ")";
            wait--;
            setTimeout(function() {
                    time(o)
                },
                1000)
        }
    }
</script>
<script>
function checkname(){
    var mag=/^[\u4e00-\u9fa5·]{2,16}$/gi;
    var trueName = $("#trueName").val();
    if(trueName.trim() == ''){
       alert('姓名不能为空we');
	  $("#trueName").val('请输入真实姓名');  
        return false;
    
       }else if(trueName=="请输入真实姓名")
	      {    
		 alert('姓名不正确，请重新输入');
		 $("#trueName").val('请输入真实姓名'); 
        return false;
	 }else
	    {
		return true;
		}
}
function checkidcard(){
   var shenfenzheng = $("#idcard").val();
   var cksfz=/^(\d{15}$|^\d{18}$|^\d{17}(\d|X|x))$/;
    if(shenfenzheng.trim() == '')
    {
        alert('身份证不能为空');
	  $("#idcard").val('请输入身份证');  
        return false;
    }else if(!cksfz.test($("#idcard").val()))
    {
        alert('身份证格式不正确');
		$("#idcard").val('请输入身份证');  
        return false;
    }else
	{
		return true;
		}
}
function checkmobile()
	   {
		 var mobile=$('#mobile').val();
		   var reg=/^1(3|4|5|7|8)\d{9}$/i;
	 if(mobile.trim() == ''){
       alert('手机号码不能为空');
	  $("#mobile").val('请输入手机号码');  
        return false;
    } else if(!reg.test(mobile)){
        alert('手机号码格式不正确');
		$("#mobile").val('请输入手机号码'); 
        return false;
    }else
	      {
		return true;
		}
	 }
function checkcode()
	   {
		 var code=$('#j_usercode').val();
		 var yzm=/^\d{5}$/;
	 if(code.trim() == ''){
       alert('验证码不能为空');
	  $("#j_usercode").val('请输入验证码');  
        return false;
    } else
	{
		return true;
		}
	 if(!yzm.test(code)){
        alert('验证码必须是5位数字');
		$("#j_usercode").val('请输入验证码'); 
        return false;
    }else
	{
		return true;
		}
	   }
function checkmm(){
    var mm = $("#pwd1").val();
	var mm2 = $("#rpwd1").val();
  if(mm.trim() == ''){
       alert('一级密码不能为空');
	  $('#pwd1').attr('type','text');
	  $("#pwd1").val('请输入一级密码'); 
        return false;
    }else if(mm.length<6 || mm.length>16){
      alert('一级密码必须在6-16位之间');
	  $('#pwd1').attr('type','text');
	  $("#pwd1").val('请输入一级密码'); 
        return false;
    }else if(mm=="请输入一级密码")
	      {    
		 alert('一级密码不正确，请重新输入');
		 $("#pwd1").val('请输入一级密码'); 
          return false;
	 }else
	   {
		return true;
		}
}
function checkmima(){
    var mm = $("#pwd1").val();
	var mm2 = $("#rpwd1").val();
 if(mm2.trim() == ''){
       alert('确认一级密码不能为空');
	  $('#pwd1').attr('type','text');
	  $("#pwd1").val('请确认一级密码'); 
        return false;
    }else if(mm!=mm2){
	  alert('请再次输入一级密码');
	  $('#rpwd1').attr('type','text');
	  $("#rpwd1").val('请确认一级密码'); 
        return false;
	 }else
	{
		return true;
		}
}
function checkzifimima(){
    var zfmm = $("#pwd2").val();
 if(zfmm.trim() == ''){
       alert('二级密码不能为空');
	  $('#pwd2').attr('type','text');
	  $("#pwd2").val('请输入二级密码'); 
        return false;
    }else if(zfmm.length<6 || zfmm.length>16){
	   //alert(mm.length);
       alert('二级密码必须在6-16位之间');
	  $('#pwd2').attr('type','text');
	  $("#pwd2").val('请输入二级密码'); 
        return false;
    }else if(zfmm=="请输入二级密码")
	      {    
		 alert('二级密码不正确，请重新输入');
		 $("#pwd2").val('请输入二级密码'); 
          return false;
	 }else
	{
		return true;
		}
}
function checktjrbh(){
	var  tjrbh=/^[A-Ha-h0-9]+$/;
    var TuiJianNum = $("#j_TuiJianNum").val();
 if(TuiJianNum.trim() == ''){
       alert('推荐人编号不能为空');
	  $("#j_TuiJianNum").val('请输入推荐人编号'); 
        return false;
    }else if(!tjrbh.test($("#j_TuiJianNum").val())){
       alert('推荐人编号格式不正确');
	  $("#j_TuiJianNum").val('请输入推荐人编号'); 
        return false;
    }else
	{
		return true;
		}
}
function checkxieyi(){
	var chk =document.getElementById("xieyi");
	if(chk.checked)
	{ 
	//alert('您已阅读并同意《中华时代用户协议》');
	       return true;
		}else{
			  alert('请您阅读并同意《中华时代用户协议》');
            return false;
			}
}
</script>
<script>
function checktwo()
{
return checkname()&& checkidcard()&&checkmobile()&&checkcode()&&checkmm()&&checkmima()&&checkzifimima()&&checkxieyi();
	
	}
</script>