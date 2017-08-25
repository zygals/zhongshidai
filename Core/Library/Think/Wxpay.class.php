<?php
namespace Think;
class Wxpay {
	private $appId;
	private $appSecret;
	private $mchid;

	public function __construct() {
		//var_dump($m);
		/*$this->appId = $gongzhonghao['appid'];
		$this->appSecret = $gongzhonghao['secret'];
		$this->mchid=$gongzhonghao['mchid'];*/
	}
	
	public function pay($total_fee,$attach,$url,$openid,$gongzhonghao){
		$input['appid']=$gongzhonghao['appid'];
		$input['attach']=$attach;
		$input['body']='body';
		$input['goods_tag']='';
		$input['mch_id']=$gongzhonghao['mchid'];
		$input['nonce_str']=md5(time());
		$input['notify_url']=$url;
		$input['openid']=$openid;
		$input['out_trade_no']=$this->mchid.date("YmdHis");
		$input['spbill_create_ip']=$_SERVER['REMOTE_ADDR'];
		$input['time_expire']=date("YmdHis", time() + 600);
		$input['time_start']=date("YmdHis");
		$input['total_fee']=$total_fee;
		$input['trade_type']='JSAPI';
		$input['sign']=$this->MakeSign($gongzhonghao['partnerkey'],$input);
		//var_dump($input);die();
		$order=$this->order($input,$openid,$gongzhonghao);
		ksort($order);
		$jsApiParameters = $this->GetJsApiParameters($order,$gongzhonghao['partnerkey'],$input);
		var_dump($jsApiParameters);die("33333333333333");
		/*echo "<script type='text/javascript'>
	//调用微信JS api 支付
	function jsApiCall()
	{
		WeixinJSBridge.invoke(
			'getBrandWCPayRequest',
			".$jsApiParameters.",
			function(res){
				WeixinJSBridge.log(res.err_msg);alert(res.err_msg);
				//window.location.href='/Huodong/u.html';
				
			}
		);
	}

	function callpay()
	{
		if (typeof WeixinJSBridge == 'undefined'){
		    if( document.addEventListener ){
		        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
		    }else if (document.attachEvent){
		        document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
		        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
		    }
		}else{
		    jsApiCall();
		}
	}
	
	callpay();
	</script>";*/
	}
	
	/**
	 * jsapi发起一个微信支付请求
	 */
	public function zhifu($total_fee,$attach,$url,$openid,$gongzhonghao,$signPackage){
		
		$input['appid']=$gongzhonghao['appid'];
		$input['attach']=$attach;
		$input['body']='body';
		$input['goods_tag']='';
		$input['mch_id']=$gongzhonghao['mchid'];
		$input['nonce_str']=md5(time());
		$input['notify_url']=$url;
		$input['openid']=$openid;
		$input['out_trade_no']=$this->mchid.date("YmdHis");
		$input['spbill_create_ip']=$_SERVER['REMOTE_ADDR'];
		$input['time_expire']=date("YmdHis", time() + 600);
		$input['time_start']=date("YmdHis");
		$input['total_fee']=$total_fee;
		$input['trade_type']='JSAPI';
		$input['sign']=$this->MakeSign($gongzhonghao['partnerkey'],$input);
		//var_dump($input);die();
		$order=$this->order($input,$openid,$gongzhonghao);
		ksort($order);
		$signarr['appid']=$gongzhonghao['appid'];
		$signarr['timeStamp']=$signPackage['timeStamp'];
		$signarr['nonceStr']=$signPackage['nonceStr'];
		//var_dump($order);die();
		$jsApiParameters = $this->GetJsApiParameters1($order,$gongzhonghao['partnerkey'],$input,$signPackage);
		return $jsApiParameters;
	}
	
	/**
	 * 
	 * 获取jsapi支付的参数
	 * @param array $UnifiedOrderResult 统一支付接口返回的数据
	 * @throws WxPayException
	 * 
	 * @return json数据，可直接填入js函数作为参数
	 */
	public function GetJsApiParameters1($UnifiedOrderResult,$key,$input,$signPackage){
		if(!array_key_exists("appid", $UnifiedOrderResult)
		|| !array_key_exists("prepay_id", $UnifiedOrderResult)
		|| $UnifiedOrderResult['prepay_id'] == "")
		{
			return "参数错误";
		}
		//die("dddd");
		$val['appId']=$UnifiedOrderResult['appid'];
		$val['nonceStr']=$signPackage['nonceStr'];
		$val['package']="prepay_id=" . $UnifiedOrderResult['prepay_id'];
		$val['signType']='MD5';
		$val['timeStamp']=$signPackage['timestamp'];
		$val['paySign']=$this->MakeSign($key,$input);
		//var_dump($val);die();
		$parameters = json_encode($val);
		return $parameters;
	}
	
	
	/**
	 * 
	 * 获取jsapi支付的参数
	 * @param array $UnifiedOrderResult 统一支付接口返回的数据
	 * @throws WxPayException
	 * 
	 * @return json数据，可直接填入js函数作为参数
	 */
	public function GetJsApiParameters($UnifiedOrderResult,$key,$input){//var_dump($UnifiedOrderResult);die();
		if(!array_key_exists("appid", $UnifiedOrderResult)
		|| !array_key_exists("prepay_id", $UnifiedOrderResult)
		|| $UnifiedOrderResult['prepay_id'] == "")
		{
			return "参数错误";
		}
		
		$val['appId']=$UnifiedOrderResult['appid'];
		$val['nonceStr']=$this->getNonceStr();
		$val['package']="prepay_id=" . $UnifiedOrderResult['prepay_id'];
		$val['signType']='MD5';
		$val['timeStamp']=time();
		$val['paySign']=$this->MakeSign($key,$input);
		//var_dump($val);die();
		$parameters = json_encode($val);
		return $parameters;
	}
	
	/**
	 * 
	 * 产生随机字符串，不长于32位
	 * @param int $length
	 * @return 产生的随机字符串
	 */
	public function getNonceStr($length = 32) 
	{
		$chars = "abcdefghijklmnopqrstuvwxyz0123456789";  
		$str ="";
		for ( $i = 0; $i < $length; $i++ )  {  
			$str .= substr($chars, mt_rand(0, strlen($chars)-1), 1);  
		} 
		return $str;
	}
	
	public function order($input,$openid,$data,$timeOut = 6){
		$url = "https://api.mch.weixin.qq.com/pay/unifiedorder";
		$xml =$this->ToXml($input);
		$startTimeStamp = $this->getMillisecond();
		$response = $this->postXmlCurl($xml, $url, false, $timeOut,$data);
		$result = $this->Init($response,$input,$data);
		//$this->reportCostTime($url, $startTimeStamp, $result,$data);//上报请求花费时间
		return $result;
	}
	
	/**
     * 将xml转为array
     * @param string $xml
     * @throws WxPayException
     */
	public function Init($xml,$input,$data=''){	
		//$obj = new self();
		$values=$this->FromXml($xml);//var_dump($data['partnerkey']);die("111");
		//var_dump($values['return_code']);die();
		//fix bug 2015-06-29
		if($values['return_code'] != 'SUCCESS'){
			 return $input;
		}//var_dump($data);die();
		$this->CheckSign($data['partnerkey'],$values,$input);
        return $values;
	}
	
	
	
	/**
	* 判断签名，详见签名生成算法是否存在
	* @return true 或 false
	**/
	public function IsSignSet($values){//var_dump($values);die();
		return array_key_exists('sign', $values);
	}
	
	/**
	 * 
	 * 检测签名
	 */
	public function CheckSign($key='',$values,$input){
		
		//fix异常
		if(!$this->IsSignSet($values)){
			return "签名错误！";
		}
		
		$sign = $this->MakeSign($key,$input);//echo $input['sign'];echo "<br/>";echo $sign;die("aaaaaaaaaa");
		if($input['sign'] == $sign){
			return true;
		}
		return "签名错误！";
	}
	
	/**
     * 将xml转为array
     * @param string $xml
     * @throws WxPayException
     */
	public function FromXml($xml){
		if(!$xml){
			return "xml数据异常！";
		}
        //将XML转为array
        //禁止引用外部xml实体
        libxml_disable_entity_loader(true);
        $values = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
		
		return $values;
	}
	/**
	 * 以post方式提交xml到对应的接口url
	 * 
	 * @param string $xml  需要post的xml数据
	 * @param string $url  url
	 * @param bool $useCert 是否需要证书，默认不需要
	 * @param int $second   url执行超时时间，默认30s
	 * @throws WxPayException
	 */
	private static function postXmlCurl($xml, $url, $useCert = false, $second = 30,$shinfo=''){
		//var_dump($shinfo);die();
		$ch = curl_init();
		//设置超时
		curl_setopt($ch, CURLOPT_TIMEOUT, $second);
		
		//如果有配置代理这里就设置代理
		/*if(WxPayConfig::CURL_PROXY_HOST != "0.0.0.0" 
			&& WxPayConfig::CURL_PROXY_PORT != 0){die("aaa");
			curl_setopt($ch,CURLOPT_PROXY, WxPayConfig::CURL_PROXY_HOST);
			curl_setopt($ch,CURLOPT_PROXYPORT, WxPayConfig::CURL_PROXY_PORT);
		}*/
		curl_setopt($ch,CURLOPT_URL, $url);
		//curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,TRUE);
		//curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,2);//严格校验
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
		curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);//严格校验
		//设置header
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		//要求结果为字符串且输出到屏幕上
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		//$_path=dirname(dirname(dirname(dirname(__FILE__)))).DIRECTORY_SEPARATOR.'Uploads';
		$_path=$_SERVER['DOCUMENT_ROOT'].'/Uploads';
		//var_dump($shinfo);echo "<br/>";echo "<br/>";echo $_path.$shinfo['apiclient_cert'];echo "<br/>";echo "<br/>";echo $_path.$shinfo['apiclient_key'];echo "<br/>";var_dump($_SERVER['DOCUMENT_ROOT']);die();
		if($useCert == true){
			//设置证书
			//使用证书：cert 与 key 分别属于两个.pem文件
			curl_setopt($ch,CURLOPT_SSLCERTTYPE,'PEM');
			//curl_setopt($ch,CURLOPT_SSLCERT, WxPayConfig::SSLCERT_PATH);
			curl_setopt($ch,CURLOPT_SSLCERT, $_path.$shinfo['apiclient_cert']);
			curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
			//curl_setopt($ch,CURLOPT_SSLKEY, WxPayConfig::SSLKEY_PATH);
			curl_setopt($ch,CURLOPT_SSLKEY, $_path.$shinfo['apiclient_key']);
		}
		//post提交方式
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
		//运行curl
		$data = curl_exec($ch);
		//var_dump($data);die();
		//返回结果
		if($data){
			curl_close($ch);
			
			return $data;
		} else {
			$error = curl_errno($ch);
			curl_close($ch);
			return "curl出错，错误码:$error";
		}
	}
	/**
	 * 获取毫秒级别的时间戳
	 */
	private static function getMillisecond(){
		
		//获取毫秒的时间戳
		$time = explode ( " ", microtime () );
		$time = $time[1] . ($time[0] * 1000);
		$time2 = explode( ".", $time );
		$time = $time2[0];
		return $time;
	}
	/**
	 * 输出xml字符
	 * @throws WxPayException
	**/
	public function ToXml($input){
		if(!is_array($input) || count($input) <= 0){
    		return "数组数据异常！";
    	}
    	//var_dump($input);die("ssssssss");
    	$xml = "<xml>";
    	foreach ($input as $key=>$val)
    	{
    		if (is_numeric($val)){
    			$xml.="<".$key.">".$val."</".$key.">";
    		}else{
    			$xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
    		}
        }
        $xml.="</xml>";
        return $xml; 
	}
	
	/**
	 * 生成签名
	 * @return 签名，本函数不覆盖sign成员变量，如要设置签名需要调用SetSign方法赋值
	 */
	public function MakeSign($key='',$input=''){
		//echo $key;die();
		//$jian=WxPayConfig::KEY;
		$jian=$key;
		//echo $key;die();
		//签名步骤一：按字典序排序参数
		ksort($input);
		$string = $this->ToUrlParams($input);
		//var_dump($string);die();
		//签名步骤二：在string后加入KEY---
		//$string = $string . "&key=".WxPayConfig::KEY;
		//$string = $string . "&key=".$jian;
		$string = $string . "&key=".$key;
		//签名步骤三：MD5加密
		
		$string = md5($string);
		//签名步骤四：所有字符转为大写
		$result = strtoupper($string);//echo $result;die();
		return $result;
	}
	/**
	 * 格式化参数格式化成url参数
	 */
	public function ToUrlParams($input){//var_dump($this->values);die();
		$buff = "";
		foreach ($input as $k => $v){
			if($k != "sign" && $v != "" && !is_array($v)){
				$buff .= $k . "=" . $v . "&";
			}
		}
		
		$buff = trim($buff, "&");
		return $buff;
	}
	
	
	
	
}

