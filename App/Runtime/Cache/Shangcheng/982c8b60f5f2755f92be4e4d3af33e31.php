<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo ($config["config_webname"]); ?>查看金额</title>
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
		<span><font style=" font-size:1.2rem;">◆</font> 查看账户</span>
	</li>
    </ul>
    </div>
   
   <div class="box-member-1">
		<form action="<?php echo U('User/chongzhiwr');?>" method="post">
					<!--id-->
                    <input type="hidden" value="<?php echo ($result[0]['id']); ?>" name="uid">
                    <input type="hidden" value="1" name="ss_type">
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
							余额：<?php echo ($result[0]['user_xianjin']); ?>
           
					</tbody>
				</table>
				</form>
                
                
			<style type="text/css">
			.tit2{height: 30px;padding-top: 10px;font-size: 18px;text-indent: 0.5em;color: #004675;}
			.tab2{width: 95%;text-align: center;}
			.tab2 tr{border-bottom: 1px solid #eee;height: 30px;line-height: 30px;}
			</style>
		
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
</body>
</html>