<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo ($config["config_webname"]); ?>-复投中心</title>
<meta name="keywords" content="<?php echo ($config["config_webkw"]); ?>"/>
<meta name="description" content="<?php echo ($config["config_cp"]); ?>" />
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/herder.css">
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/integral transfer.css">
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/member.css">
<meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<script src="/Public/Mobile/Shangchengpc/js/jquery-2.1.4.min.js"></script>
<!--<script src="/Public/Mobile/Shangchengpc/js/jquery.params.js"></script>
<script src="/Public/Mobile/Shangchengpc/js/j_dou.js"></script>-->
</head>
<body>
<div class="box-ten">
   <div class="header">
		<div class="header-1"><a href="/u.html"></a></div>
		<div class="header-2">复投中心</div>
   </div>
   <div class="box-ten-1">
		<form>
			<div class="a-1">
					<span>您的会员编号</span>
			</div>
			 <div class="a-2">
				  <input type="text" id="j_usernum" style="padding-left:5px;" value="<?php echo ($bh); ?>" placeholder="请输入会员编号" readonly>
			</div>
			<div class="a-4">
					<button type="button" onclick="Get_isTra_user()">下一步</button>
			</div>
		</form>


   </div>
    <?php if(1): ?><table class="gridtable" id="tbody">
        <thead style="line-height: 35px;"><span style="font-weight: 900; font-size: 18px">已提交复投</span></thead>
        <tbody><tr style="line-height: 35px; background: #ccc">

            <th>积分数</th>
            <th>返还日期</th>
            <th>申请日期</th>
            <th>期次</th>
            <th>倍增数</th>
            <th>审核者</th>
            <th>状态</th>
        </tr>


        <?php if(is_array($jfzs)): $i = 0; $__LIST__ = $jfzs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr style="line-height: 30px; background: #ccc">

            <td><?php echo ($data["num"]); ?></td>
            <td><?php echo ($data["fan_date"]); ?></td>
            <td><?php echo date('Ymd',$data[tijiao_date]);?></td>
            <td><?php echo ($data["qici"]); ?></td>
            <td><?php echo ($data["beizeng"]); ?></td>
            <td><?php if($data['shenhe_bh'] == 'A00001'): ?>管理员<?php else: echo getUserName($data['shenhe_bh']); endif; ?></td>
            <td><?php if($data[status] == 0): ?><span style="color:red">未审核</span><?php else: ?><span style="color:green">已审核</span><?php endif; ?></a></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table><?php endif; ?>
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
<script>

function Get_isTra_user() {
    var proid = $("#j_usernum").val();
    if (proid.length > 0) {
       window.location.href = "/ft/proid/"+proid+".html";
    } else { alert("请输入会员编号"); }
}

</script>
</body>
</html>