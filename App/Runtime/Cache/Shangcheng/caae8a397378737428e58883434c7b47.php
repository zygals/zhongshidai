<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title><?php echo ($config["config_webname"]); ?>-提交订单</title>
    <meta name="keywords" content="<?php echo ($config["config_webkw"]); ?>"/>
    <meta name="description" content="<?php echo ($config["config_cp"]); ?>"/>
    <link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/herder.css">
    <link rel="stylesheet" type="text/css" href="/Public/Mobile/Shangchengpc/css/place order.css">
    <meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no"
          name="viewport">
    <script src="/Public/Mobile/Shangchengpc/js/jquery-2.1.4.min.js"></script>
    <style>
        .goodsItem li {
            padding: 10px;
            background: #f0f0f0;
            border-bottom: 1px solid #fff;
            overflow: hidden;
        }
    </style>
</head>
<body>
<div class="box-place">
    <div class="header">
        <div class="header-1"><a href="/gw.html"></a></div>
        <div class="header-2">提交订单</div>
    </div>
    <div class="box-place-1">
        <label style="display: none;" id="isAddress">0</label>
        <div class="address">
            <?php if(!empty($dz)): ?><a href="/gad.html" id="addressInfo">
                    <div class="name"><h5 style="margin-top:10px;"><?php echo ($dz["name"]); ?></h5><span
                            class="fr"><?php echo ($dz["mobile"]); ?></span></div>
                    <div class="info"><?php echo ($dz["sheng"]); ?> <?php echo ($dz["shi"]); ?> <?php echo ($dz["qu"]); ?> <?php echo ($dz["dizhi"]); ?></div>
                </a>
                <input type="hidden" name="dz" id="dz" value='1'>
                <?php else: ?>
                <div class="step1_a" style="text-align:center;"><a href="/gad.html">添加收件人信息</a><input type="hidden"
                                                                                                      name="dz" id="dz"
                                                                                                      value='0'></
                div><?php endif; ?>
        </div>
    </div>
    <div class="box-place-2">
        <h5>商品列表</h5>
        <ul class="goodsItem" id="order_cart">
            <?php if(is_array($gwc)): foreach($gwc as $key=>$gv): ?><li>
                    <img src="<?php echo ($gv["pic"]); ?>" alt="">
                    <span class="box-place-2a">商品名称: <?php echo ($gv["gname"]); ?></span>
                    <span>需要钱数：<?php echo ($gv["xj"]); ?> 元</span>
                    <span>规格：<?php echo ($gv["guige"]); ?> </span>
                    <span>数量：<?php echo ($gv["num"]); ?></span>
                    <!--<span>限购：<?php echo ($gv["xg"]); ?></span>-->
                    <?php if($gv['pay_type']==1){?>
                    <span>
					<a href="/go.html" class="yanse-11"><?php echo ($gv["jifen"]); ?> 可用积分</a>
				</span>
                    <?php }else{?>
                    <span>
				  			 <a href="/go.html" class="yanse-11"><?php echo ($gv["agxfq"]); ?> 爱国消费积分</a>
					</span>
                    <?php }?>
                </li><?php endforeach; endif; ?>
        </ul>
    </div>
    <div class="box-place-3">
        <span><em>积分支付</em><a href="/go.html"><img src="/Public/Mobile/Shangchengpc/images/0three-1.png" height="17" width="17"
                                                   alt=""></a></span>
    </div>
    <div class="box-place-4">
		<span><em><?php if($pay_type == 2): ?>爱国消费积分<?php else: ?>可用积分<?php endif; ?></em><a href="javascript:void(0)" id="spKY">
		<?php if($pay_type == 2): if($user['user_agxfq']): echo ($user["user_agxfq"]); else: ?>0<?php endif; ?> 积分
			<?php else: ?>
			<?php if($user['user_keyongjf']): echo ($user["user_keyongjf"]); else: ?>0<?php endif; ?> 积分<?php endif; ?>

		</a></span>
        <?php if($xf_fl == 2): ?><!--zyg 奖励积分不要：<span><em>奖励积分</em><a href="javascript:void(0)" id="spJL"><?php echo ($jiangli); ?> 积分</a></span>--><?php endif; ?>
    </div>
    <div class="box-place-3">
        <span><em>现金支付</em><a href="/go.html"><img src="/Public/Mobile/Shangchengpc/images/0three-1.png" height="17" width="17"
                                                   alt=""></a></span>
    </div>
    <div class="box-place-4">
        <span><em>可用现金</em><a href="javascript:void(0)" id="spXJ"><?php if($user['user_xianjin']): echo ($user["user_xianjin"]); else: ?>0<?php endif; ?> 元</a></span>
    </div>
    <div class="box-place-5" style="margin-bottom:135px;">
		<span><em>
			<h5>商品总积分</h5>
		</em><a href="javascript:void(0)" id="order_pro_total"><?php echo ($zjf); ?> 积分</a></span>
        <span><em>
		<h5>商品总钱数</h5>
		</em><a href="javascript:void(0)" id="order_pro_total"><?php echo ($zqs); ?> 元</a></span>
        <span><em>
			<h6>备注</h6>
		</em></span>
        <textarea name="a" style="width: 100%; height: 100px;" placeholder="请输入备注信息" id="order_remark_desc"></textarea>
    </div>
    <div class="box-place-6" style="bottom:52px;position: fixed;max-width: 960px;width: 100%;">
			<span><em id="order_ture_total">实付积分<?php echo ($zjf); ?> + 实付现金<?php echo ($zqs); ?>元</em>
				<?php if($pay_type == 1): ?><a href="javascript:void(0)" onclick="GetOrderReadyAdd()"><button>提交</button></a><?php endif; ?>
				<?php if($pay_type == 2): ?><a href="javascript:void(0)" onclick="GetOrderReadyAdd1()"><button>提交</button></a><?php endif; ?>
			</span>
    </div>

    <input type="hidden" id="spr_money" value="<?php echo ($zqs); ?>">
    <input type="hidden" id="user_xianjin" value="<?php echo ($user["user_xianjin"]); ?>">
    <input type="hidden" id="add_order_Total" value="<?php echo ($zjf); ?>">
    <input type="hidden" id="jianglijifen" value="<?php echo ($zjf); ?>">
    <input type="hidden" id="add_point_Total" value="<?php echo ($user["user_keyongjf"]); ?>">
    <input type="hidden" id="add_point_Total1" value="<?php echo ($user["user_agxfq"]); ?>">
    <input type="hidden" id="add_point_TotalGw" value="0.00">
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
    $(function () {
        //GetReadyOrder();
    })
    function GetOrderReadyAdd() {
        if ($('#dz').val() == 0) {
            window.location.href = '/gad.html';
        }
        var r_total = parseFloat($("#add_order_Total").val());//
        var r_point = parseFloat($("#add_point_Total").val());
        var jl = parseFloat($("#jianglijifen").val());
        var u_xianjin = parseFloat($("#user_xianjin").val());
        var pro_money = parseFloat($("#spr_money").val());//总现金
        if (r_total > 0) {
            if (r_point >= r_total) {
                //判断金额
                if (u_xianjin >= pro_money) {
                    $.ajax({
                        type: "post", url: "/gad2.html", //'Gouwuche/address2
                        data: {
                            "t": "t",
                            "zz": 1,
                            'r_total': r_total,
                            //'jl': jl,
                            "pay_type":"<?php echo $pay_type?>",
                            'pro_money': pro_money,
                            "descriptions": $("#order_remark_desc").val()
                        },
                        async: false, dataType: "json", success: function (data) {
                            if (data.code == 1) {
                                window.location.href = data.url;
                            } else {
                                alert(data.msg);
                            }
                        }
                    });
                } else {
                    alert("您当前账户现金不足1！");
                }
            } else {
                alert("积分不足！");
            }

        } else {
            alert("消费金额不能为0");
        }
    }


    //爱国消费
    function GetOrderReadyAdd1() {

        if ($('#dz').val() == 0) {
            window.location.href = '/gad.html';
        }
        var r_total = parseFloat($("#add_order_Total").val()); //需要总爱国积分
        var r_point = parseFloat($("#add_point_Total1").val());//用户爱国积分
        var r_kypoint = parseFloat($("#add_point_Total").val()); //用户可用积分
        //var jl=parseFloat($("#jianglijifen").val());  奖励积分
        var u_xianjin = parseFloat($("#user_xianjin").val());//用户现金
        var pro_money = parseFloat($("#spr_money").val()); //需要总现金

        if (r_point < r_total) {
            alert("您爱国积分不足！");
            return false;
        }

        if (r_total > 0) {
            //判断金额
            if (pro_money <= u_xianjin) {
                $.ajax({
                    type: "post", url: "/gad2.html",
                    data: {
                        "t": "t",
                        "zz": 2,
                        'r_total': r_total/*,'jl':jl*/,
                        "pay_type":"<?php echo $pay_type?>",
                        'pro_money': pro_money,
                        "descriptions": $("#order_remark_desc").val()
                    },
                    async: false, dataType: "json", success: function (data) {
                        console.log(data);
                        if (data.code == 1) {
                            window.location.href = data.url;
                        } else {
                            alert(data.msg);
                        }
                    }
                });
            } else {
                alert("您当前账户现金不足！");
            }
        } else {
            alert("消费爱国积分不能为0");
        }


    }
</script>
</body>
</html>