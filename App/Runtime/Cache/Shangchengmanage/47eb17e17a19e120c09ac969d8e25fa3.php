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
<script>
    //ajax请求二级分类
    function getCates2(obj) {
        var cateid = obj.value;
        $.ajax({
            url: "/shangchengmanage/goods/reqCate2",
            dataType: "json",
            data: {
                'id': cateid,
            },
            success: function (res) {
                console.log(res);
                var str = '';
                if (res.code == 0) {
                    $.each(res.data,function (i, item) {
                        str += ' <option value="' + item.id + '">' + item.name + '</option>';
                    });
                    $('#cate2').html(str);
                }
            }
        });
    }
</script>
<table width="100%" height="31px" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
    <tr>
        <td height="31">
            <div class="titlebt">添加商品</div>
        </td>
    </tr>
</table>
<div class="main">
    <div class="form">
        <form method='post' id="form_do" name="form_do" action="/shangchengmanage/goods/do_add" enctype="multipart/form-data">

            <dl>
                <dt> 商品分类：</dt>
                <dd>
                    <select name="fid">
                        <?php if(is_array($fl)): foreach($fl as $key=>$fv): ?><option value="<?php echo ($fv["id"]); ?>"><?php echo ($fv["name"]); ?></option><?php endforeach; endif; ?>
                    </select>
                    <!-- zyg <select onchange="getCates2(this)">
                        <?php if(is_array($fl)): foreach($fl as $key=>$fv): ?><option value="<?php echo ($fv["id"]); ?>"><?php echo ($fv["name"]); ?></option><?php endforeach; endif; ?>
                    </select>
                    <?php if($fl2){?>
                    <select name="fid" id="cate2">
                        <?php if(is_array($fl2)): foreach($fl2 as $key=>$fv2): ?><option value="<?php echo ($fv2["id"]); ?>"><?php echo ($fv2["name"]); ?></option><?php endforeach; endif; ?>
                    </select>
                    <?php }?>-->
                </dd>
            </dl>
            <dl>
                <dt> 商品名称：</dt>
                <dd>
                    <input type="text" name="name" class="inp_w250" value=""/>
                </dd>
            </dl>

            <dl>
                <dt> 推荐人编号：</dt>
                <dd>
                    <input type="text" name="tjr_bh" class="inp_w250" value=""/>
                </dd>
            </dl>

            <!--<dl>
                <dt> 消费分类：</dt>
                <dd>
                    <input type="radio" name="xf_fl" value="1"/>&nbsp;爱国消费卷
                    <input type="radio" name="xf_fl" value="2"/>&nbsp;可用积分
                </dd>
            </dl>-->

            <dl>
                <dt> 首页位置：</dt>
                <dd>
                    <input type="radio" name="index_post" value="1"/>&nbsp;精选商品
                    <input type="radio" name="index_post" value="2"/>&nbsp;爱国消费卷
                    <input type="radio" name="index_post" value="3"/>&nbsp;推荐专区
                    <input type="radio" name="index_post" value="4"/>&nbsp;新品专区
                </dd>
            </dl>


            <!--<dl>
                <dt> 限购数量：</dt>
                <dd>
                    <input type="text" name="xgnum" class="inp_w250" value="" />
                </dd>
            </dl>-->
            <dl>
                <dt> 现金：</dt>
                <dd>
                    <input type="text" name="xianjing" class="inp_w250" value=""/>
                </dd>
            </dl>

            <dl>
                <dt> 需可用积分：</dt>
                <dd>
                    <input type="text" name="jifen" class="inp_w250" value=""/>
                </dd>
            </dl>
            <dl>
                <dt> 需爱国消费券：</dt>
                <dd>
                    <input type="text" name="agxfq" class="inp_w250" value=""/>
                </dd>
            </dl>
            <!--<dl>
                <dt> 奖励积分：</dt>
                <dd>
                    <input type="text" name="jiangli" class="inp_w250" value="" />
                </dd>
            </dl>-->
            <dl>
                <dt> 商品库存：</dt>
                <dd>
                    <input type="text" name="kucun" class="inp_w250" value=""/>
                </dd>
            </dl>
            <dl>
                <dt> 商品规格：</dt>
                <dd>
                    <input type="text" name="guige" class="inp_w250" value=""/>
                </dd>
            </dl>
            <div class="pic_suolue">
                <dl>
                    <dt> 商品缩略图：</dt>
                    <dd>
                        <div class="litpic_show">
                            <div>
                                <input name="pic" id="pic" type="file" style="height:30px;"/>
                            </div>

                        </div>
                    </dd>
                </dl>

                <dl>
                    <dt> 商品图组：</dt>
                    <dd>
                        <div>
                            <div><input type="button" id="add_img" value="再来一张" class="btn"/></div>
                        </div>

                        <div class="litpic_show">

                            <input name="pic_arr[]" id="pic" type="file" class="inpFlie"
                                   style="height:30px;margin-left:135px;"/><a class="del" id="del"
                                                                              style="cursor: pointer">X</a>
                            <div class="div_img" style="margin-left:135px; clear:both;"></div>


                        </div>


                    </dd>
                </dl>


                <script>
                    $(function () {
                        $("#add_img").click(function () {
                            $(".div_img").append('<div><input type="file" name="pic_arr[]" class="inpFlie" style="height:30px;"/><a class="del" style="cursor: pointer">X</a></div>');
                        });
                        $(".del").live("click", function () {
                            $(this).parent().remove();
                        });
                    });
                </script>


                <dl>
                    <dt> 排序：</dt>
                    <dd>
                        <input type="text" name="paixu" class="inp_w250" value="0"/>
                    </dd>
                </dl>
                		
		<!--载入kindeditor编辑器开始-->
		<script type="text/javascript" charset="utf-8" src="/Data/kindeditor/kindeditor.js"></script>
		<script charset="utf-8" src="/Data/kindeditor/lang/zh_CN.js"></script>
		<script language="javascript">
		var editor;
		KindEditor.ready(function(K) {
		editor = K.create('#intro');
		// editor = K.create('#editor_id');多个
		});
		</script>
		<!--<textarea id="editor_id" name="content" style="width:280px;height:160px;"></textarea>-->
		<!--载入kindeditor编辑器结束-->
                <dl>
                    <dt> 内容：</dt>
                    <dd>
                        <div>
                            <textarea id="intro" name="content" style="width:700px;height:400px;"/></textarea>
                        </div>
                    </dd>
                </dl>
                <div class="form_b">
                    <input type="submit" class="btn_blue" id="submit" value="提 交">
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