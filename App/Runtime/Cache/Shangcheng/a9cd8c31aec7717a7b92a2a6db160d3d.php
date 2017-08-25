<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo ($config["config_webname"]); ?>-绑定银行卡</title>
<meta name="keywords" content="<?php echo ($config["config_webkw"]); ?>"/>
<meta name="description" content="<?php echo ($config["config_cp"]); ?>" />
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/herder.css">
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/member.css">
<meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<script src="/Public/Mobile/Shangchengpc/js/jquery-2.1.4.min.js"></script>
<script>
$(function () {
	Next();
});
function Next() {
	$.ajax({
		type: "post", url: "/uk.html",
		data: {"pageIndex": $("#lblPageIndex").html()},
		async: false, dataType: "json", success: function (data) {
			if (data.code == "1") {
				if (data.data_info == "") { $(".loadMore").html("<a href=\"javasript:void(0)\">没有更多信息了</a>"); } else {
					$("#tbody").append(data.data_info);
					$("#lblPageIndex").html(parseInt($("#lblPageIndex").html()) + 1);
					//$("#pro_title").html(data.title);
				}
			} else {
				$(".loadMore").html("<a href=\"javasript:void(0)\">没有更多信息了</a>");
			}
		}
	});
}
</script>
<script type="text/javascript"> 
function check(){
	var bank_kaohao=$('#bank_kaohao').val();
	var kaihu_hang=$('#kaihu_hang').val();
	var kaihu_name=$('#kaihu_name').val();
	var resz1=new RegExp("\\D");
	var retszf=new RegExp("^([\u4e00-\u9fa5a-zA-Z0-9]+|[a-zA-Z0-9]+)$");
	var retszf1=new RegExp("^([\u4e00-\u9fa5a-zA-Z0-9]+)$");
	var rehz=new RegExp("^[\u4e00-\u9faf]+[\u4e00-\u9faf]$");	
	if($.trim(kaihu_name)==''){
		alert("银行卡开户姓名不能为空，请输入!");
		document.form1.kaihu_name.value="";
		document.form1.kaihu_name.focus();
		return false;
	}
	if(!retszf1.test(kaihu_name)){
		alert("银行卡开户姓名不能输入特殊符号，请输入!");
		document.form1.kaihu_name.value="";
		document.form1.kaihu_name.focus();
		return false;
	}
	if(!rehz.test(kaihu_name)){
		alert("银行卡开户姓名必须输入汉字，请重新输入!");
		document.form1.kaihu_name.value="";
		document.form1.kaihu_name.focus();
		return false;
	}
	if($.trim(bank_kaohao)==''){
		alert("银行卡卡号不能为空，请输入!");
		document.form1.bank_kaohao.value="";
		document.form1.bank_kaohao.focus();
		return false;
	}
	if(!retszf1.test(bank_kaohao)){
		alert("银行卡号不能输入特殊符号，请输入!");
		document.form1.bank_kaohao.value="";
		document.form1.bank_kaohao.focus();
		return false;
	}
	if(bank_kaohao.length<13 || bank_kaohao.length>21)
	{
		alert("银行卡号输入错误，请重新输入!");
		document.form1.bank_kaohao.value="";
		document.form1.bank_kaohao.focus();
		return false;
	}
	if(bank_kaohao.length>=13 && bank_kaohao.length<=21){
		var fsz=false;
		for(var $i=1;$i<=bank_kaohao.length;$i++){
			if(resz1.test(bank_kaohao.substr($i-1,1))){
				fsz=true;
				break;
			}
		}
		if(fsz){
			alert("银行卡号输入错误，请重新输入!");
			document.form1.bank_kaohao.value="";
			document.form1.bank_kaohao.focus();
			return false;
		}
	}
	return true;
}
function huifu(){
	document.form1.parent_name.value="请选择";
	document.form1.project_name.value="";
	document.form1.project_file.value="";
	document.form1.project_name.focus();
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
	<span><font style=" font-size:1.4rem;">◆</font>绑定银行卡</span>
	</li>
   
    </ul>
    </div>
   
   <div class="box-member-1">
		<form action="<?php echo U('Bankadd/bangdyhkwr');?>" method="post" name="form1" id="form_hy" onsubmit="return check()">
					<input type="hidden" value="<?php echo ($result[0]['id']); ?>" name="uid">
                    <table class="" width="100%" style="margin-left:10px;font-size:16px;">
					<tr>
						<td>
                        <span>开户姓名：</span>
                        <input name="kaihu_name" type="text" id="kaihu_name"  style="border-radius:5px;min-width:240px; border:1px solid #ccc;height:30px;line-height:30px;"/>
						</td>
					</tr>    
                     <tr class="">
						<td height="40">
							<span style="font-size:16px;">选择银行：</span>
                            <select name="bank_name" id="bank_name" style="border-radius:5px;border:1px solid #ccc;height:30px;line-height:30px;">
                              <option value="中国工商银行">中国工商银行</option>
                              <option value="中国工商银行" >中国工商银行</option>
                              <option value="中国建设银行" >中国建设银行</option>
                              <option value="中国银行" >中国银行</option>
                              <option value="中国农业银行">中国农业银行</option>
                              <option value="中国邮政储蓄银行" >中国邮政储蓄银行</option>
                              <option value="招商银行" >招商银行</option>
                              <option value="交通银行" >交通银行</option>
                              <option value="中信银行" >中信银行</option>
                              <option value="兴业银行">兴业银行</option>
                              <option value="中国光大银行" >中国光大银行</option>
                              <option value="平安银行" >平安银行</option>
                              <option value="浦发银行" >浦发银行</option>
                              <option value="中国民生银行">中国民生银行</option>
                          </select>
						</td>
					</tr>
					<tr>
						<td>
							<span style="float:left;">银行卡号：</span>
                            <input type="text" value="" name="bank_kaohao" style="float:left; height:30px;line-height:30px; border-radius:5px;border:1px solid #ccc;min-width:240px;" id="bank_kaohao">
							<span style="font-size:12px; float:left;  color:#f00; margin:5px 0 0 15px; ">银行卡号为了以后提现使用，请填写后仔细核对！</span>
							<!--<p id="pd4">银行卡号位数不对！</p>-->
                            <div style="clear:both;"></div>
						</td>
					</tr>
					<tr>
						<td  height="30">
							<span>账户类型：</span><input type="radio" name="status" checked value="1">普通<input name="status" type="radio" value="0">默认
						</td>
					</tr>
					<tr class="">
						<td  height="60">
							<input type="submit" name="submit" id="btn_change1" class="btn btn_orange small" value="添加" style="float:left;font-size:18px;height:35px;line-height:35px;border-radius:5px; background-color:#8b0000; border:none; color:#FFF;padding:0;min-width:100px;"/>
						</td>
					</tr>
					</tbody>
				</table>
				</form>
                <style type="text/css">
					.tit2{height: 30px;padding-top: 10px;font-size: 14px;text-indent: 0.5em;color: #004675;}
					.tab2{width: 100%;text-align: center;}
					.tab2 tr{border-bottom: 1px solid #eee;height: 30px;line-height: 30px;}
				</style>
				<h6 class="tit2" style="font-weight:bold; font-size:16px;">已绑定的银行卡：</h6>
			<table class="tab2">
				<tr style="background:#eee;font-size: 14px;">
					<td width="155">银行名称</td>
					<td width="150">银行卡号</td>
					<td width="110">开户姓名</td>
					<td width="100">操作</td>
				</tr>
                <?php if(is_array($result2)): foreach($result2 as $key=>$vo): ?><tr style="font-size: 12px;">
    				<td width="155"><?php echo ($vo["bank_name"]); ?></td>
					<td width="150"><?php echo ($vo["bank_kaohao"]); ?></td>
					<td width="110"><?php echo ($vo["kaihu_name"]); ?></td>
					<td width="100">
                    	<a href="<?php echo U('Bankadd/bangdyhkedit?id='.$vo['id']);?>" style="color:#F00;" >修改</a>
                        <span style="padding:0 2px;">|</span>
                        <a href="<?php echo U('Bankadd/bangdyhk?del=1&id='.$vo['id']);?>">删除</a>
                    </td>
                </tr><?php endforeach; endif; ?>
			</table>
   </div>
   	<div class="last">
		<ul>
			<li>
				<a href="/">
					 <i><img src="/Public/Mobile/Shangchengpc/images/foot1_on.png" height="20" width="20" alt=""></i>
					 <span style="font-size:10px;">首页</span>
				 </a>
			</li>
			<li>
				 <a href="/gz.html">
					 <i><img src="/Public/Mobile/Shangchengpc/images/0a-2.png" height="20" width="20" alt=""></i>
					 <span style="font-size:10px;">商品分类</span>
				 </a>
			</li>
            
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