<?php
/* *
 * 功能：支付宝页面跳转同步通知页面
 * 版本：2.0
 * 修改日期：2016-11-01
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。

 *************************页面功能说明*************************
 * 该页面可在本机电脑测试
 * 可放入HTML等美化页面的代码、商户业务逻辑程序代码
 */
require_once("config.php");
require_once 'wappay/service/AlipayTradeService.php';

$arr=$_GET;
$alipaySevice = new AlipayTradeService($config); 
$result = $alipaySevice->check($arr);
define('SITE_URL', "http://s-380954.gotocdn.com/");
echo "<meta charset='utf-8'><script>alert('在线充值成功,查看余额!');window.location.href='" . SITE_URL . "kanyue';</script>";

/* 实际验证过程建议商户添加以下校验。
1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
4、验证app_id是否为该商户本身。
*/
//session_start();
//define('SITE_URL', "http://s-380954.gotocdn.com/");
//$out_trade_no = htmlspecialchars($_GET['out_trade_no']);

//支付宝交易号
//$trade_no = htmlspecialchars($_GET['trade_no']);
//$amount = htmlspecialchars($_GET['total_amount']);
//$user_bh = $_SESSION['bh'];
//$user_true_name = $_SESSION['name'];
//$create_time = time();
//$db = new mysqli('localhost', 'root', 'j28981', 'jjtest');
////添加充值记录
//$sql = "insert into dq_online_chongzhi (`trade_no`,`out_trade_no`,`user_bh`,`total_amount`,`st`,`type`,`create_time`) values ('$out_trade_no','$trade_no','$user_bh','$amount',1,1,'$create_time');";
//$result1 = $db->query($sql);
////改变用户现金
//$sql = "update dq_user  set user_xianjin = user_xianjin + $amount where user_login_bh='$user_bh'";
//$result2 = $db->query($sql);
//if ($result1 === true && $result2===true) {
    //  $sql = "insert into dq_user_jifen (user_login_bh,jifen_laiyuan,jifen_num,jifen_type,jifen_yuanyin,jifen_shengyu,jifen_date) values ($user_bh,'cz','',,)";
    // header("Location:http://localhost/pay");
//    echo "<meta charset='utf-8'><script>alert('在线充值成功,查看余额!');window.location.href='" . SITE_URL . "kanyue';</script>";
//} else {
//    echo "<script>alert('在线充值成功，但记录添加出错!');window.location.href='" . SITE_URL . "pay';</script>";
//}
//$db->close();

//if($result) {//验证成功
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//请在这里加上商户的业务逻辑程序代码
	
	//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
    //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

	//商户订单号

//	$out_trade_no = htmlspecialchars($_GET['out_trade_no']);
//
//	//支付宝交易号
//
//	$trade_no = htmlspecialchars($_GET['trade_no']);
//
//	echo "验证成功<br />外部订单号：".$out_trade_no;

	//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//}
//else {
    //验证失败
   // echo "验证失败";
//}
?>
<title>支付宝手机网站支付接口</title>
	</head>
    <body>
    </body>
</html>