<?php
$config = array (	
		//应用ID,您的APPID。
		'app_id' => "2017072007828608",

		//商户私钥
		'merchant_private_key' => "MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQCiSRN8MYfLJxkkBx1M7o4AbvGeTb7j0WdOiYd/1aZHki38Hhi9MGDhEEpODnDGqvcOx5qLCTvpZAT/aKGqYVXaPoYLZHWFBVeNZli6KFdYVZtKvSJNjQfkOHqKXNNMtbCIz/BD+cfSIwVlo7D9JX1gWXCiN10VP6Mxqj2jHWElUSPTvViTxYBfOKaNn6yRp1/eofyf4OGa2iEn0O/8fj/wpakRkgQpWeDChUas0B6EQBi2L4K+EKzw9tPw9zjRh8ubkLB+d4NSHVaEiM1SjTBmX9yyIu9WKgPKXjHbZI2ZdOwzadFGwEtHQ09nMISpGWP+j+zpLGAUI7FyhnYR06tNAgMBAAECggEBAJEkdm7fBapmX4/fZQ9HVG2CzEpfEllDEfgl/LASb1MXpFUWvd2HBT6FiU9iju7APZJUZx3utky5Ddc4x05RG63DubM6t/iunG10mep05hm1BtzDZ4igl+w/rylMeBblcOwLvcGuBk8kz1DmJAdknkur8pbCmVfFwLlMny/huN7b1DwXvetTZlGcZHIiAFrCmVHnTD7jkVRNtAGJvBDzoK5Jncnjho0qttHgvd+3Uk4rvDR5YT30nrat1/tqeSqXf3InzhDMOQ5x849EdqiX+IFO3pDqCspnMr5txJgkD58U/Pv5B74lgrdu4tWHxyryPyuW1ly2qdNIfJNjDLRDJoECgYEA0oPNzsEB5dZMxSds9fs2YwmTzOIcBNSWsD0UZ16AlA9WCveJQdKjaDUSvHF4BeYot5ml7a6XnUIEiT8YOL+ooVffIw3p0o0kRPbl+O9Ic9ZovCtejR20P7PpyeYl+SIzxICQtf6nRkIsUEKL7lpzhRVTNr36aNqiTo+4pFHgHpECgYEAxVmP2Fsl/SHld/kKyqhaWIo+xUJpmw+OJrKvMmYI/Cf8SwG3+ZFdESt8Kso6WCH9yuSOTyf+Mu7BCBWE8E6YaRbBMjUeVf2/LBXQ/rsh3HdVxcc9BFMpzyOmt0O1iShY+bZ5G+EUPNv+K5glCLC8sfGEnEwax8aVuyDuBD3lFv0CgYEAhxfwVjNEDYPFxmuzn/NzhoDZ6Yxc4Liwby7zTha2Os3QsL8DxUrwdGpCuM20cUyvaotekTYOs+tuz8i+uYQ9KjUiy/Mcz3KmCN/M20BrZXL9yWunhLXAO3UwndFlIwjQ4dSDiVd/bzX+DA94jyBaq9fwi9vEu886g2H14vVr9xECgYAearht+1Z2lmPcwuiz5ZDPNreIBb1rJdGeC0pPdUSLQMp08RXfBFWY0N/5ZGPrs4l/XQzGDH70cLIVweNUenipMdWjHGbJkCuH6vDkYglNBqOUsSmpYfv+rhsDAg+XzT0xd7tg3acV3j5lj7Sdi0f6ESSERoKWKfhn+CJXSwblLQKBgD0rfICLgep5PcMAruvF4ul58QC3xNPPW3B8iz5DxrlGanwUbgO+bAEaHZJO5q8LNzgqilAOLpialn9MBQbGgPQxprmRgSRP5dF5euP0kDFdXI8FIFMtwH62kjHv8ahVQXKNvbHayjjc6jDsEHa/lNUsWOJhJFS1HXKlUnWAiB1g",
		
		//异步通知地址
		'notify_url' => "http://s-380954.gotocdn.com/alipay/notify_url.php",
		
		//同步跳转
		'return_url' => "http://s-380954.gotocdn.com/alipay/return_url.php",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipay.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAokkTfDGHyycZJAcdTO6OAG7xnk2+49FnTomHf9WmR5It/B4YvTBg4RBKTg5wxqr3Dseaiwk76WQE/2ihqmFV2j6GC2R1hQVXjWZYuihXWFWbSr0iTY0H5Dh6ilzTTLWwiM/wQ/nH0iMFZaOw/SV9YFlwojddFT+jMao9ox1hJVEj071Yk8WAXzimjZ+skadf3qH8n+DhmtohJ9Dv/H4/8KWpEZIEKVngwoVGrNAehEAYti+CvhCs8PbT8Pc40YfLm5CwfneDUh1WhIjNUo0wZl/csiLvVioDyl4x22SNmXTsM2nRRsBLR0NPZzCEqRlj/o/s6SxgFCOxcoZ2EdOrTQIDAQAB",
);