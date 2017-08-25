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
	subform('/shangchengmanage/user/delall');
   }
  }
 </script>
        <style>
            .green-black div { position: relative}
            .input_page { margin-top: 15px;}
            .input_page input { border: 1px solid #dcdcdc;    width: 50px;    height: 23px;   line-height: 24px; vertical-align: middle}

            </style>
<table width="100%" height="31px" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
      <tr>
        <td height="31"><div class="titlebt">会员管理</div></td>
      </tr>
    </table>
<div class="main">
    <div class="operate">
        <div class="left">
            <input type="button" onclick="window.open('/shangchengmanage/user/add','main')" target="main" class="btn_blue" value="添加">
        </div>
       
        <div class="left_pad">
            <form method="get" action="/shangchengmanage/user/search">
                <input type="text" name="keyword" title="关键字" class="inp_default" value="">
                <input type="hidden" name="formhash" value="231cb4d8" />
                <input type="submit" class="btn_blue" value="查  询">
            </form>
        </div>
       
    </div>
    <div class="list">    
    <form action="<?php echo U(GROUP_NAME.'/Member/delAll');?>" method="post" id="form_do" name="form_do">
        <table width="100%">
            <tr>
                <th>编号</th>
                <th>会员名字</th>
               
                <th>会员等级</th>
                <th>上级会员</th>
                <th>上二级会员</th>
				<th>可用积分</th>
				<th>待用积分</th>
				<th>分享积分</th>
				<th>充值积分</th>
                <th>赠送积分</th>
				<th>注册时间</th>
              
                <th>操作</th>
            </tr>
			<?php if(empty($vlist)): ?><tr>
			<td colspan="10"><div align="center">本区域暂无数据显示...</div></td>
			</tr>
			<?php else: ?> 
			
			<?php if(is_array($vlist)): $i = 0; $__LIST__ = $vlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($v["user_login_bh"]); ?></td>
                <td><a href="/u/b/<?php echo ($v["user_login_bh"]); ?>.html" target="_blank"><?php echo ($v["user_name"]); ?></a></td>
               
                <td><?php echo ($v["dj"]); ?></td>
                <td><?php if($v['sj']): echo ($v["sj"]); else: ?>无<?php endif; ?></td>
                <td><?php if($v['sj2']): echo ($v["sj2"]); else: ?>无<?php endif; ?></td>
				<td><?php echo ($v["user_keyongjf"]); ?></td>
				<td><?php echo ($v["user_daiyongjf"]); ?></td>
				<td><?php echo ($v["user_fenxiangjf"]); ?></td>
				<td><?php echo ($v["user_baodanjifen"]); ?></td>
                <td><?php echo ($v["user_zengsongjifen"]); ?></td>
                
				<td><?php echo (date('Y-m-d H:i:s',$v["user_regdate"])); ?></td>
                
                <td>
                    <a href="/shangchengmanage/user/zengsong/id/<?php echo ($v["id"]); ?>">赠送</a>
					<a href="/shangchengmanage/user/chongzhi/id/<?php echo ($v["id"]); ?>">充值</a>
					<a href="/shangchengmanage/user/zhuanru/id/<?php echo ($v["id"]); ?>">转入</a>
                    <a href="/shangchengmanage/user/baodan/id/<?php echo ($v["id"]); ?>">报单</a>
                    
                    <a href="/shangchengmanage/user/detail/id/<?php echo ($v["id"]); ?>">编辑</a>
					<a href="/shangchengmanage/user/jifen/id/<?php echo ($v["id"]); ?>">积分</a>
					<a href="/shangchengmanage/user/del/id/<?php echo ($v["id"]); ?>">删除</a>
				</td>
                
               
              
              
            </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?> 
			
        </table>
		 <div class="green-black"><?php echo ($page); ?><div class='input_page'>请输入页码<input size='6' type='text' id='z'  value="<?php echo $_GET['p']?>" ><a class='tiaozhuan' style="vertical-align:middle;" href="<?php echo $module_name;?>"/p/10 >跳转</a></div></div>
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


<script type="text/javascript">
    module_name = "<?php echo $module_name;?>";
    jQuery(function(){
        $("#z").blur(function(){
         page = $('#z').val();
         m_name = module_name+"/p/"+page;
            $(".tiaozhuan").attr("href",m_name);
        });
    })
</script>