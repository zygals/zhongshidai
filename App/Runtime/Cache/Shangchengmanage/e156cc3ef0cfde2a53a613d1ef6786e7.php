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
        <td height="31"><div class="titlebt">可用积分转入</div></td>
      </tr>
    </table>
<style>
.anniu{float:left;padding:5px 8px;background:#68CE4A;color:#fff;margin-right:15px;font-size:16px;}
</style>
<div class="main">

	<div class="form" style="">
		<form method='post' id="form_do" name="form_do" action="/shangchengmanage/user/do_zhuanru">
            <input type="hidden" name="dengji_max" id="dengji_max" value="<?php echo ($v['dengji']['tiaojian1_max']); ?>">
            <input type="hidden" name="dengji_min" id="dengji_min" value="<?php echo ($v['dengji']['tiaojian1_min']); ?>">
            <input type="hidden" name="user_dengji" id="user_dengji" value="<?php echo ($v[user_dengji]); ?>">

		<dl>
			<dt>用户名：</dt>
			<dd>
				<?php echo ($v["user_name"]); ?>  &nbsp;&nbsp;您的充值积分：<span style="color: red">(<?php echo ($v["user_baodanjifen"]); ?>)</span>
			</dd>
		</dl>
		
		<dl>
			<dt>可用积分转入：</dt>
			<dd>
				<!--<input type="text" name="user_keyongjf" id="user_keyongjf" class="inp_one" onblur="return dj()" value=""/>-->
                <input type="text" name="user_keyongjf" id="user_keyongjf" class="inp_one" value=""/>
			</dd>
		</dl>
		
		<br/>
		<div class="form_b">
			<input type="hidden" name="id" value="<?php echo ($v["id"]); ?>" />			
			<input type="submit" class="btn_blue"   id="submit" value="提 交">
		</div>
	   </form>
	</div>

<!--<div style="height:50px;"></div>
<div class="cont-ft">
            <div class="copyright">
                <div class="fl">感谢使用XX商城企业后台管理系统</div>
            </div>
</div>-->
</div>
</body>
</html>

<!--<script>
    function dj(){
        var dengji_min=parseFloat($('#dengji_min').val());
        var dengji_max=parseFloat($('#dengji_max').val());
        var user_dengji=$('#user_dengji').val();
        var user_baodanjifen=parseFloat($('#user_keyongjf').val());

        if(user_dengji == 1){
            if(dengji_min  > user_baodanjifen  || user_baodanjifen >= dengji_max){
                alert('VIP会员充值不能大于5万积分 ');
                return false;
            }
        }else if(user_dengji == 2){
            console.log(dengji_min+'>'+user_baodanjifen);
            if( dengji_min > user_baodanjifen || user_baodanjifen >= dengji_max){
                alert('社区工作站充值大于5万小于10万的积分 ');
                return false;
            }
        }else if(user_dengji == 3){
            if(dengji_min  > user_baodanjifen || user_baodanjifen >= dengji_max){
                alert('区域服务中心充值大于10万小于100万的积分 ');
                return false;
            }
        }else if(user_dengji == 4){
            if( dengji_min > user_baodanjifen){
                alert('省级分公司充值大于100万的积分 ');
                return false;
            }
        }


        return true;
    }
</script>-->