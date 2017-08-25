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
<table width="100%" height="31px" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
      <tr>
        <td height="31"><div class="titlebt">会员编辑</div></td>
      </tr>
    </table>
<style>
.anniu{float:left;padding:5px 8px;background:#68CE4A;color:#fff;margin-right:15px;font-size:16px;}
</style>
<div class="main">
	<div class="form" style="">
		<form method='post' id="form_do" name="form_do" action="/shangchengmanage/user/do_detail">


			<dl>
			<dt>用户名：</dt>
			<dd>
				<input type="text" name="user_login_bh" class="inp_one" value="<?php echo ($v["user_login_bh"]); ?>" readonly/>
			</dd>
		</dl>

		<dl>
			<dt>用户名：</dt>
			<dd>
				<input type="text" name="user_name" class="inp_one" value="<?php echo ($v["user_name"]); ?>"/>
			</dd>
		</dl>
		<dl>
			<dt> 会员等级：</dt>
			<dd>
				<select name="user_dengji">
					<?php if(is_array($dj)): foreach($dj as $key=>$dv): ?><option value="<?php echo ($dv["id"]); ?>" <?php if($v['user_dengji'] == $dv['id']): ?>selected="selected"<?php endif; ?>><?php echo ($dv["name"]); ?></option><?php endforeach; endif; ?>
				</select>
			</dd>
		</dl>
		<dl>
			<dt>登陆密码：</dt>
			<dd>
				<input type="text" name="user_pass" class="inp_one"  placeholder="留空默认不修改" value=""/>
			</dd>
		</dl>
		<dl>
			<dt>支付密码：</dt>
			<dd>
				<input type="text" name="user_zfpass" class="inp_one"  placeholder="留空默认不修改" value=""/>
			</dd>
		</dl>
		<dl>
			<dt>上级id：</dt>
			<dd>
				<input type="text" name="user_sjid1" class="inp_one" value='<?php echo ($v["user_sjid1"]); ?>'>
			</dd>
		</dl>
        <dl>
			<dt>身份证号：</dt>
			<dd>
				<input type="text" name="user_idcard" class="inp_one" value='<?php echo ($v["user_idcard"]); ?>'>
				
			</dd>
		</dl>
		<dl>
			<dt>会员手机：</dt>
			<dd>
				<input type="text" name="user_phone" class="inp_one" value="<?php echo ($v["user_phone"]); ?>"/>
			</dd>
		</dl>
		<dl>
			<dt> 状态：</dt>
			<dd>
				<input type="radio" name="user_ok" class="user_ok" value="1" <?php if($v['user_ok'] == 1): ?>checked="checked"<?php endif; ?> />激活
				&nbsp;&nbsp;
				<input type="radio" name="user_ok" class="user_ok"  value="0"<?php if($v['user_ok'] == 0): ?>checked="checked"<?php endif; ?> />禁用
			</dd>
		</dl>
		<dl>
			<dt>可用积分：</dt>
			<dd>
				<input type="text" name="user_keyongjf" class="inp_one" value='<?php echo ($v["user_keyongjf"]); ?>'>
			</dd>
		</dl>
		<dl>
			<dt>待用积分：</dt>
			<dd>
				<input type="text" name="user_daiyongjf" class="inp_one" value='<?php echo ($v["user_daiyongjf"]); ?>'>
			</dd>
		</dl>
		<dl>
			<dt>分享积分：</dt>
			<dd>
				<input type="text" name="user_fenxiangjf" class="inp_one" value='<?php echo ($v["user_fenxiangjf"]); ?>'>
			
			</dd>
		</dl>
            <dl>
                <dt>赠送积分：</dt>
                <dd>
                    <input type="text" name="user_zengsongjifen" class="inp_one" value='<?php echo ($v["user_zengsongjifen"]); ?>'>

                </dd>
            </dl>

		<dl>
			<dt>注册时间：</dt>
			<dd>
				<span style='position:relative;top:6px;'><?php echo (date('Y-m-d H:i:s', $v["user_regdate"])); ?></span>
			</dd>
		</dl>
		<br/>
		<div class="form_b">
            <input type="hidden" id="status_id" name="status_id" value="0" />
            <input type="hidden" name="id" value="<?php echo ($v["id"]); ?>" />
			<input type="submit" class="btn_blue" id="submit" value="提 交">
		</div>
	   </form>
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

    $('.user_ok').change(function(){
        status_value = $(this).val();
        $('#status_id').val(status_value);

    });


</script>