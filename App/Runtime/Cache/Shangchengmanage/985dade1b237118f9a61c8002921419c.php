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
<link rel="stylesheet" type="text/css" href="/App/Shangchengmanage/View/Default/css/date.css">
<script src="/App/Shangchengmanage/View/Default/js/common.js" type="text/javascript"></script>
<script src="/App/Shangchengmanage/View/Default/js/laydate.js" type="text/javascript"></script>
<style>
 .shouye_huizong{  width: 230px; background:#08406F;height: 46px; text-decoration:none;line-height: 46px;text-align: center; font-size: 18px;color: #FFF; margin-left:10px;}
</style>
  <table width="300" border="0" height="33px" ellpadding="0" cellspacing="0" class="left_topbg" id="table2">
  <tr>
    <td><a href="<?php echo U('User/rmbchongzhi');?>" style="display:block; text-decoration:none;"><div class="shouye_huizong">充值列表</div></a></td>
     <td> <a href="<?php echo U('User/rmbtixian');?>" style="display:block; text-decoration:none;"><div class="shouye_huizong" style="background:#09547E;">提现列表</div></a></td>
  </tr>
</table>
<div class="main" style=" margin-top:0px;">
    <div class="operate" style="padding-left:0px;">
        <div class="left_pad" style="padding-left:0px; margin-left:8px;" >
            <form method="get" action="<?php echo U('User/rmbtixian?sousuo=1');?>" >
                <input type="text" name="keyword" title="关键字" class="inp_default" value="">
                <input type="submit" class="btn_blue" value="查  询">
           </form>
           
         </div>
         
          <div class="left_pad" style="padding-left:0px; margin-left:8px; float:left;" >   
           <form method="get" action="<?php echo U('User/rmbtixian');?>">
           <input type="hidden"  name="hidd" value="8"/>
           <select  name="sele"> 
           <option value="" >请选择类型</option>
           <option value="0" >未审核</option>
           <option value="1" >已审核</option>
           <option value="3" >已打款</option>
           <option value="2" >已驳回</option>
           </select>
                <input type="text" name="date" title="" class="inp_default" value="" onClick="laydate({istime: true, format: 'YYYY-MM-DD'})">
                <input type="submit" class="btn_blue" value="搜索">
           </form>
           </div>
       
     </div>
    <div class="list">    
    <form action="" method="post" id="form_do" name="form_do">
       <!--  <button class="btn_blue" name="shenhe" value="1">未审核</button>
         <button class="btn_blue" name="shenhe" value="2">已审核</button>
         <button class="btn_blue" name="shenhe" value="3">已打款</button>
         <button class="btn_blue" name="shenhe" value="4">已驳回</button>-->
       <table width="100%">
            <tr>
                <th width="5%">全选<input name='chkall' type='checkbox' id='chkall' onclick='selectcheckbox(this.form)' value='check'></th>
                <th width="5%">序号</th>
                <th width="13%">编号姓名</th>
                <th width="30%">开户信息</th>
                <th width="11%">提现金额</th>
                <th width="6%">申请</th>
                <th width="15%">申请时间</th>
                <th width="15%">状态</th>			
            </tr>
            <?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
             <td><input class="sele" name="intid[]"   value="<?php echo $vo['id'];?>" type="checkbox"></td>
             <td><?php echo ($key+1); ?></td>
             <td><?php  $id=$vo['uid']; $m=D('User'); $arr=$m->find($id); echo $arr['user_login_bh']; echo $arr['user_name']; ?></td>
             <td>
             
             <?php echo ($vo['kahao']); ?>--<?php echo ($vo['kaihuhang']); ?>--<?php if($_GET['keyword']){ echo str_replace($_GET['keyword'], '<span style="color:#F00;">'.$_GET['keyword'].'</span>',$vo['kaihuren']); } else{ echo ($vo['kaihuren']); }?></td>
             <td><?php echo ($vo['txye']); ?>元</td>
             <td><?php if($vo["ss_type"] == 2): ?>提现<?php endif; ?></td>
             <td><?php echo date('Y-m-d H:i:s',$vo['sq_date']);?>
             </td>
             <td>
             <?php if($vo["status"] == 0): ?><a href="<?php echo U('User/rmbtixian?shen=1&id='.$vo['id']);?>" style=" color:red;">审核</a><?php endif; ?>
              <?php if($vo["status"] == 1): ?><a href="<?php echo U('User/rmbtixian?yishenhe=1&id='.$vo['id']);?>"style=" color:#999">已审核</a>|<a href="<?php echo U('User/rmbtixian?bh=1&id='.$vo['id']);?>">驳回</a>|<a href="<?php echo U('User/rmbtixian?dkcg=1&id='.$vo['id']);?>">打款</a><?php endif; ?>
              <?php if($vo["status"] == 2): ?><span style=" color:#00F;">驳回成功</span><?php endif; ?>
              <?php if($vo["status"] == 3): ?><span style=" color:green;">打款成功</span><?php endif; ?>
             </td>
            </tr><?php endforeach; endif; ?>	
             <tr>
                <td colspan="2">
             <div style=" margin-top:20px; font-size:16px;">	
              <button value="1" name="button" style=" height:30px; color:#FFF;background-color:#013C6C; border:none; border-radius:5px;">批量审核</button> 
              <button value="2" name="button" style=" height:30px; color:#FFF;background-color:#013C6C; border:none; border-radius:5px;">批量打款</button>
             </div>
               </td>
             <td colspan="5">&nbsp;</td>
           <td>
           <div style=" margin-top:20px;background-color:#013C6C; border-radius:5px;width:120px; height:30px;">
            <?php if(is_array($list)): $i = 0; $__LIST__ = array_slice($list,0,1,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="../../../../test.php?sele=<?php echo ($vo['status']); ?>&date=<?php echo date('Y-m-d',$vo['sq_date']);?>" target="main" style=" color:#FFF; text-align:center">导出已审核数据</a><?php endforeach; endif; else: echo "" ;endif; ?>
          
           </div>
           </td>
            </tr>
        </table>
        <!--分页-->
		<div class="green-black" >
        	<?php echo ($page); ?>
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