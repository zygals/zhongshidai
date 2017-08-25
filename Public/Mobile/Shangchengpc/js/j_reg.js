//验证码获取
function createCode() {
    $.ajax({
        type: "post", url: "/y.html",
        data: {},
        async: false, dataType: "json", success: function (data) {
            if (data.code == 1) {
                $("#codeMsg").html(data.codeMsg);
            }
        }
    });
}
function GetBJCode() {
    $.ajax({
        type: "post", url: "/m.html",
        data: {},
        async: false, dataType: "json", success: function (data) {
            if (data.code == 1) {
                $("#j_username").val(data.codeMsg);
            }
        }
    });
}
function get_user_reg() {
    var pwd1 = $("#pwd1").val();
	var pwd2 = $("#pwd2").val();
    var pwd1Two = $("#rpwd1").val();
    var phone = $("#mobile").val();
    var tuijianPhone = $("#j_TuiJianNum").val();
    var code = $("#codeMsg").text();
	//alert(code);
    var codeStr = $("#j_usercode").val();
	//alert(codeStr);
    var userName = $("#trueName").val();
	var idcard = $("#idcard").val();
	if (userName.length > 0 && pwd1.length > 0 && pwd2.length > 0 && phone.length > 0 && tuijianPhone.length > 6 &&idcard.length==18) {
        if ((/^1[3|4|5|7|8]\d{9}$/.test(phone))) {
			if (pwd1 == pwd1Two) {
					if(confirm("确认注册吗")){
						$.ajax({
							type: "post", url: "/z.html",
							data: {"pwd1": pwd1, "pwd2": pwd2, "phone": phone, "tuijianPhone": tuijianPhone,"code":code,"trueName": userName ,"idcard":idcard},
							async: false, dataType: "json", success: function (data) {
								if (data.code == 1) {
									alert('您的登陆编号为'+data.bh+'登陆密码为'+data.mm);
									window.location.href = data.url;
								} else {
									alert(data.msg); createCode();
								} 
							}
						});
					}
			}else { alert("一级密码不一致"); }
		}else {
			alert("手机号格式不正确");
			createCode();
		}
	}
}

function get_user_login() {
    var phone = $("#j_userphone").val();
    var pwd1 = $("#j_userpwd1").val();
    var typeStr = $("input[name='login_type']:checked").val();
    //var code = $("#codeMsg").val();
    //var codeStr = $("#checkCode").text();
    if (phone.length > 0 && pwd1.length > 0) {

        //if (code == codeStr) {
        $.ajax({
            type: "post", url: "/app/get_wap_kjt.ashx",
            data: { "por": "100", "phone": phone, "pwd1": pwd1, "cateid": typeStr },
            async: false, dataType: "json", success: function (data) {
                if (data.code == 1) {
                    window.location.href = data.url;
                } else { alert(data.msg); createCode(); }
            }
        });
        //} else {
        //    alert("验证码不正确");
        //    createCode();
        //}
    } else {
        alert("用户名或密码 不能为空");
        //createCode();
    }
    return false;
}

//退出
function loginOut() {

    $.ajax({
        type: "post", url: "/app/get_wap_kjt.ashx",
        data: { "por": 128, "proid": 2 },
        async: false, dataType: "json", success: function (data) {
        }
    });
}


function get_phone_code() {
    if ($("#codeMsg").text() == $("#j_usercode").val()) {
        var phone = $("#j_userphone").val();
        var telReg = /^(0|86|17951)?(13[0-9]|15[012356789]|17[0-9]|18[0-9]|14[57])[0-9]{8}$/; //如果手机号码不能通过验证   
        if (telReg.test(phone) == true) {

            $.ajax({
                type: "post", url: "/app/get_wap_kjt.ashx",
                data: { "por": 1011, "phone": phone },
                async: false, dataType: "json", success: function (data) {
                    if (data.code == 1) {
                        $("#j_send_code").attr("onclick", "").text("已发送");

                    } else { alert(data.msg); }
                }
            });
        } else { alert("手机格式错误！"); }
    } else { alert("验证码错误！"); }
}
