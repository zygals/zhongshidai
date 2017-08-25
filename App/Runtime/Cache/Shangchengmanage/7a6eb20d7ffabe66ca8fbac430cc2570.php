<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo (C("setting.Copyright")); ?> <?php echo (C("setting.Version")); ?> <?php echo (C("setting.Code")); ?></title>
<script language="javascript" type="text/javascript" src="/App/Shangchengmanage/View/Default/js/jquery.js"></script>
<script src="/App/Shangchengmanage/View/Default/js/frame.js" language="javascript" type="text/javascript"></script>
<link href="/App/Shangchengmanage/View/Default/css/style.css" rel="stylesheet" type="text/css" />

<!--[if IE 6]>
<script src="/App/Shangchengmanage/View/Default/Js/DD_belatedPNG.js" language="javascript" type="text/javascript"></script>
<script>
  DD_belatedPNG.fix('.nav ul li a,.top_link ul li,background');   /* string argument can be any CSS selector */
</script>
<![endif]-->
</head>
<body class="showmenu">
<script src="/App/Shangchengmanage/View/Default/js/common.js" type="text/javascript"></script>
 <script type="text/javascript">
  function clear_del()
  {
   if(confirm("确定要删除数据吗？"))
   {
	subform('/shangchengmanage/online_pay/delall');
   }
  }
 </script>
<style>
 .shouye_huizong{  width: 150px; background:#08406f; height: 40px;line-height: 40px;text-align: center; font-size: 18px;color: #FFF; margin-left:10px;}
</style>
  <table width="300" border="0" height="33px" ellpadding="0" cellspacing="0" class="left_topbg" id="table2">
  <tr>
   <td><a href="<?php echo U('User/rmbchongzhi');?>" style="display:block; text-decoration:none;"><div class="shouye_huizong">充值记录</div></a></td>
      <!--<td> <a href="<?php echo U('User/rmbtixian');?>" style=" text-decoration:none;"><div class="shouye_huizong">提现列表</div></a></td>-->
  </tr>
</table>

<div class="main" style=" margin-top:0px;">
    <div class="operate" style="padding-left:0px;">
        <div class="left_pad" style="padding-left:0px; margin-left:8px;" >
            <!--<form method="get" action="<?php echo U('User/rmbchongzhi?sousuo=1');?>" >
                <input type="text" name="keyword" title="关键字" class="inp_default" value="">
                <input type="submit" class="btn_blue" value="查  询">
            </form>-->
        </div>
    </div>
    <div class="list">    
    <form action="" method="post" id="form_do" name="form_do">
       <table width="100%">
            <tr>
               <th>序号</th>
                <th>会员编号</th>
                <th>会员名字</th>
                <th>充值金额</th>
                <th>充值方式</th>
                <th>充值时间</th>
                <th>状态</th>			
            </tr>
             <?php if(is_array($result)): foreach($result as $key=>$vo): ?><tr>
                	<td><?php echo ($key+1); ?></td>
                    <td><?php  echo $vo['user_bh']; ?></td>
                    <td><?php echo ($vo["true_name"]); ?></td>
                    <td><?php echo ($vo["total_amount"]); ?></td>
                    <td><?php echo $vo['type']==1?'支付宝':'微信';?></td>
                    <td><?php echo date('Y-m-d H:i:s',$vo['create_time']); ?></td>
                    <td><?php if($vo['st']==1){echo '成功';}else{echo '失败';} ?></td>
			    </tr><?php endforeach; endif; ?>	
        </table>
        <!--分页-->
		<div class="green-black" >
        	<?php echo ($show); ?>总共<?php echo ($count); ?>条记录
            <!--<div>
            	<span class="current">1</span>
                <a class="num" href="/shangchengmanage/user/index/p/2.html">2</a> 
                <a class="next" href="/shangchengmanage/user/index/p/2.html">>></a>
            </div>-->
        </div>
    </form>
    </div>
</div>
<!--<div style="height:50px;"></div>
<div class="cont-ft">
            <div class="copyright">
                <div class="fl">感谢使用XX商城企业后台管理系统</div>
            </div>
</div>-->
</body>
</html>