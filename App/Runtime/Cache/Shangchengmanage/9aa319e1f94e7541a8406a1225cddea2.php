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
<script src="/App/Shangchengmanage/View/Default/js/common.js" type="text/javascript"></script>
 <script type="text/javascript">
  function clear_del()
  {
   if(confirm("确定要删除数据吗？"))
   {
	subform('/shangchengmanage/dingdan/delall');
   }
  }
 </script>
<table width="100%" height="31px" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
      <tr>
        <td height="31"><div class="titlebt">订单列表</div></td>
      </tr>
    </table>

<div class="main">
    <div class="operate">
        <div class="left">
            <input type="button" onclick="window.open('/shangchengmanage/dingdan/daochu','main')" target="main" class="btn_blue" value="全部订单导出excel"> 
			<input type="button" onclick="window.open('/shangchengmanage/dingdan/daochu1','main')" target="main" class="btn_blue" value="全部订单导出CSV"> 
			<input type="button" onclick="window.open('/shangchengmanage/dingdan/daochu2','main')" target="main" class="btn_blue" value="未发货订单导出CSV">
        </div>
    </div>
    <div class="list">
    <form  action="<?php echo U('dingdan/index',array('fahuo'=>1));?>" method="post" >
        <table width="100%">
            <tr>
                <th>全选<input name='chkall' type='checkbox' id='chkall' onclick='selectcheckbox(this.form)' value='check'></th>
                <th>编号</th>
                <th>会员</th>
                <th>会员编号</th>
                <th>订单号</th>
                <th>商品</th>
                <th>应付现金/元</th>
				<th>订单总额/积分</th>
				<th>奖励积分</th>
				<th>订单状态</th>
				<th>商品状态</th>
                <th>操作</th>
            </tr>
			<?php if(empty($vlist)): ?><tr>
			<td colspan="10"><div align="center">本区域暂无数据显示...</div></td>
			</tr>
			<?php else: ?> 
			<?php if(is_array($vlist)): $i = 0; $__LIST__ = $vlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
           <td><input class="sele" name="seleid[]"   value="<?php echo $v['id'];?>" type="checkbox"></td>
           
                <td><?php echo ($v["id"]); ?></td>
                <td><?php echo ($v["uname"]); ?></td>
                <td><?php echo ($v["bh"]); ?></td>
                <td><?php echo ($v["dingdanhao"]); ?></td>
                <td><?php echo ($v["goodstr"]); ?></td>
                <td><?php echo ($v["yingkouxianjin"]); ?></td>
                <td><?php echo ($v["yingfukuan"]); ?></td>
                <td><?php echo ($v["jianglijifen"]); ?></td>
                <td><?php echo ($v["dtype"]); ?></td>
                <td><?php echo ($v["gtype"]); ?></td>
                <td>
                    <a href="/shangchengmanage/dingdan/detail/id/<?php echo ($v["id"]); ?>">详情</a>
                    
				</td>
            </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?> 
             <tr>
           <td>  <div style=" font-size:16px;">	<input class="sele" value="批量发货" type="submit" style=" width:80px; height:30px; color:#FFF;background-color:#013C6C; border:none; border-radius:3px;"></div></td>
           
                <td colspan="11">&nbsp;</td>
            </tr>
		
        </table>
      
		 <div class="green-black"><?php echo ($page); ?>总共<?php echo ($count); ?>条记录</div>
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
<script>
function selectcheckbox(form){
    for (var i = 0; i < form.elements.length; i++) {
        var e = form.elements[i];
        if (e.name != 'chkall' && e.disabled != true){
         e.checked = form.chkall.checked;
        }
    }
}
</script>
<script type="text/javascript"> 
          var checkall=document.getElementsByName("seleid[]"); 
            function select(){                          //全选  
                for(var $i=0;$i<checkall.length;$i++){ 
                    checkall[$i].checked=true; 
                } 
            } 
</script>