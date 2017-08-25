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
	subform('/shangchengmanage/user/delall');
   }
  }
 </script>
<style>
 .shouye_huizong{  width: 150px; background:#08406f; height: 40px;line-height: 40px;text-align: center; font-size: 18px;color: #FFF; margin-left:10px;}
</style>
  <table width="300" border="0" height="33px" ellpadding="0" cellspacing="0" class="left_topbg" id="table2">
  <tr>
    <td><a href="<?php echo U('User/rmbchongzhi');?>" style="display:block; text-decoration:none;"><div class="shouye_huizong">充值列表</div></a></td>
     <td> <a href="<?php echo U('User/rmbtixian');?>" style=" text-decoration:none;"><div class="shouye_huizong">提现列表</div></a></td>
  </tr>
</table>

<div class="main" style=" margin-top:0px;">
    <div class="operate" style="padding-left:0px;">
        <div class="left_pad" style="padding-left:0px; margin-left:8px;" >
            <form method="get" action="<?php echo U('User/rmbchongzhi?sousuo=1');?>" >
                <input type="text" name="keyword" title="关键字" class="inp_default" value="">
                <input type="submit" class="btn_blue" value="查  询">
            </form>
        </div>
    </div>
    <div class="list">    
    <form action="<?php echo U(GROUP_NAME.'/Member/delAll');?>" method="post" id="form_do" name="form_do">
       <table width="100%">
            <tr>
               <th>序号</th>
                <th>会员编号</th>
                <th>会员名字</th>
                <th>充值金额</th>
                <th>申请</th>
                <th>申请时间</th>
                <th>状态</th>			
            </tr>
             <?php if(is_array($result)): foreach($result as $key=>$vo): ?><tr>
                	<td><?php echo ($key+1); ?></td>
                    <td><?php  $id=$vo['uid']; $m=D('User'); $arr=$m->find($id); echo $arr['user_login_bh']; ?></td>
                    <td><?php if($_GET['keyword']){ echo str_replace($_GET['keyword'],'<span style="color:#F00;">'.$_GET['keyword'].'</span>',$vo['kaihuren']); }else{ echo $vo['kaihuren']; }?></td>
                    <td><?php echo ($vo['txye']); ?></td>
                    <td>充值</td>
                    <td><?php echo date('Y-m-d H:i:s',$vo['sq_date']); ?></td>
                    <td><?php switch($vo['status']){ case 0: ?><a href="<?php echo U('User/rmbchongzhi?shen=1&id='.$vo['id']);?>">审核</a>|<a href="<?php echo U('User/rmbchongzhi?del=1&id='.$vo['id']);?>">删除</a><?php break; case 1: ?><span style="color:#F00;" >已审核</span><?php  break; } ?></td>                		
			    </tr><?php endforeach; endif; ?>	
        </table>
        <!--分页-->
		<div class="green-black" >
        	<?php echo ($show); ?>
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