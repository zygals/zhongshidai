<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo ($config["config_webname"]); ?>-充值</title>
<meta name="keywords" content="<?php echo ($config["config_webkw"]); ?>"/>
<meta name="description" content="<?php echo ($config["config_cp"]); ?>" />
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/herder.css">
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/member.css">
<meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<script src="/Public/Mobile/Shangchengpc/js/jquery-2.1.4.min.js"></script>


<style type="text/css">
	
	</style>

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
		<span><font style=" font-size:1.2rem;">◆</font> 充值</span>
	</li>
    </ul>
    </div>
	<!--<form name=alipayment action=pagepay/pagepay.php method=post target="_blank">
		<div id="body1" class="show" name="divcontent">
			<dl class="content">
				<dt>商户订单号
					：</dt>
				<dd>
					<input id="WIDout_trade_no" name="WIDout_trade_no" />
				</dd>
				<hr class="one_line">
				<dt>订单名称
					：</dt>
				<dd>
					<input id="WIDsubject" name="WIDsubject" />
				</dd>
				<hr class="one_line">
				<dt>付款金额
					：</dt>
				<dd>
					<input id="WIDtotal_amount" name="WIDtotal_amount" />
				</dd>
				<hr class="one_line">
				<dt>商品描述：</dt>
				<dd>
					<input id="WIDbody" name="WIDbody" />
				</dd>
				<hr class="one_line">
				<dt></dt>
				<dd id="btn-dd">
                        <span class="new-btn-login-sp">
                            <button class="new-btn-login" type="submit" style="text-align:center;">付 款</button>
                        </span>
					<span class="note-help">如果您点击“付款”按钮，即表示您同意该次的执行操作。</span>
				</dd>
			</dl>
		</div>

	</form>-->
   <div class="box-member-1">
		   <form name=alipayment action="/alipay/pagepay/pagepay.php" method="post"  onsubmit="return checkchongzhi()" >
					<!--id-->
                    <input type="hidden" value="<?php echo ($result[0]['id']); ?>" name="uid">
                    <input type="hidden" value="1" name="ss_type">
                    <input type="hidden" value="222222" name="trade_no">
                    <input type="hidden" value="chongzhibody" name="body">
                    <table class="table_hover" width="100%">
					<tr class="">
						<td height="30">
							股东姓名：<?php echo ($result[0]['user_name']); ?>
                        </td>
					</tr>
					<tr class="">
						<td height="30">
							股东账户：<?php echo ($result[0]['user_login_bh']); ?>
						</td>
					</tr>
					<tr class="">
						<td height="40">
							充值金额：<input type="text" value="" name="txye" id="txye" style="height:30px;line-height:30px;border-radius:5px;border:1px solid #ccc;" id="remoney" ><span style="margin-left:10px;color:#f00">元</span>
						</td>
					</tr>
						<tr class="">
							<td height="40">
							充值方式：<input type="radio" name="pay_type" value="1" checked> 支付宝 <!--<input type="radio" name="pay_type" value="2"> 微信-->
							</td>
						</tr>
<!--					<tr class="" >
						<td height="20" style="line-height:30px;">
							充值账户：<?php echo ($result[0]['user_yinhangka']); ?>&nbsp;&nbsp;&nbsp;&nbsp;<br/>开户行：<?php echo ($result[0]['user_kaihuhang']); ?>
						</td>
					</tr>-->
					<tr class="">
						<td  height="60">
							<input type="submit" name="submit" id="btn_change1" class="btn btn_orange small" value="充值" style="float:left;font-size:18px;height:35px;line-height:35px;border-radius:5px; background-color:#8b0000; border:none; color:#FFF;padding:0;min-width:100px;"/>
						</td>
					</tr>
					</tbody>
				</table>
				</form>
				<style type="text/css">
			.tit2{height: 30px;padding-top: 10px;font-size: 18px;text-indent: 0.5em;color: #004675;}
			.tab2{width: 95%;text-align: center;}
			.tab2 tr{border-bottom: 1px solid #eee;height: 30px;line-height: 30px;}
			</style>
			<h4 class="tit2" style="padding-left:.25rem;font-size:1.1rem;font-weight:700">充值记录</h4>



	   <!--<table class="tab2">
				<tr style="background:#eee;font-weight:bold;">
					<td width="150">充值时间</td>
					<td width="150">充值金额</td>
					<td width="150">真实姓名</td>
					<td width="110">状态</td>
				</tr>
                <?php if(is_array($result2)): foreach($result2 as $key=>$vo): ?><tr>
    				<td width="150"><?php echo date('Y-m-d',$vo['sq_date']); ?></td>
					<td width="150"><?php echo ($vo["txye"]); ?></td>
					<td width="150"><?php echo ($vo["kaihuren"]); ?></td>
					<td width="110"><?php switch($vo['status']){ case 0: ?>未审核<?php break; case 1: ?><span style="color:#F00;" >已审核</span><?php  break; } ?></td>
			    </tr><?php endforeach; endif; ?>				
			</table>-->
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
<script>
	function checkchongzhi(){
	   
		var r = /^\+?[1-9][0-9]*$/;　　//正整数 
		var money = $("#txye").val();

　　    if(money==""){
		　alert("请输入充值金额！"); 
　　　　　　return false; 
		}else if(!r.test(money)) { 
　　　　　　//alert("金额只允许输入整数数字！");
　　　　　　//return false;
　　　 　 }else if(money < 100){
	    　//alert("最低充值金额100元！");
	    　//return false;
	    }else{
		  return true;
		}
		

    }
		
	function checknumber(String) { 
	　　　　var Letters = "1234567890"; 
	　　　　var i; 
	　　　　var c; 
	　　　　for( i = 0; i < Letters.length(); i ++ )   {   //Letters.length() ->>>>取字符长度
	　　　　　　c = Letters.charAt( i ); 
	　　　　　　if (Letters.indexOf( c ) ==-1)   { //在"Letters"中找不到"c"   见下面的此函数的返回值
	　　　　　　　　return true; 
	　　　   　　} 
	　　　　} 
	　　　　return false; 
	　　} 



</script>