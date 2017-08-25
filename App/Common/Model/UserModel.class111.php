<?php 

namespace Common\Model;
use Think\Model\RelationModel;
class UserModel extends RelationModel{//继承relation
		/**
		 * 自动验证
		 */
		protected $_validate=array(
				//array(验证字段,验证规则,错误提示,[验证条件,附加规则,验证时间]),
				//array('username','require','用户必须填写!'), //成功验证用户名是否填写
				//array('user_email','require','登录邮箱必须填写'),
				//array('user_email','','该邮箱已经注册过！',0,'unique',1), //验证是否存在邮箱
				//array('user_email','checkemail','登录邮箱检测失败',0,'callback',3),
				
				//array('nickname','require','用户名必须填写'),
				//array('nickname','','该用户名已经存在！',0,'unique',1), //验证是否存在用户名
				
				//array('password','require','密码必须填写'),
				//array('user_repass','user_pass','确认密码不正确',0,'confirm'),
				
				//array('verify','require','验证码必须填写!'),
				//array('verify','checkCode','验证码错误!',0,'callback',1),
				//array('username','/^\w{2,}$/','用户名必须6个字母以上',0,'regex',1), //成功验证
		
				//array('sex','checksex','性别检测失败','m','callback','f'),
				//array('user_tel','checktel','电话检测失败',0,'callback',1),
				//array('user_qq','checkqq','QQ检测失败',0,'callback',1),
				//array('user_cpwebsite','checkurl','公司网址检测失败',0,'callback',1),
				//array('user_cpcode','checkcpcode','邮编检测失败',0,'callback',1),
				//array('user_cpcode','checkcpcode','邮编检测失败',0,'callback',3),
		);
		
		/**
		 * 处理checkemail回调函数
		 */
		protected function checkemail(){
			$email=$_POST['user_email'];
			if(!preg_match("/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/", $email)){
				return false;
			}else{
				return true;
			}
		}
		
		/**
		 * 处理checkcpcode回调函数
		 */
		protected function checkcpcode(){
			$content=$_POST['user_cpcode'];
			$content=trim($content);
			if (strlen($content) == 6){
				if(!ereg("^[+]?[_0-9]*$",$content)){
					return true;
				}
			}
			else{
				return false;
			}
		}
		
		/**
		 * 处理checkurl回调函数
		 */
		protected function checkurl(){
			$content=$_POST['user_cpwebsite'];
			if(preg_match("/^http:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\’:+!]*([^<>\"])*$/", $content)){
				return true;
			}else{
				return false;
			}
		}
		/**
		 * 处理checktel回调函数
		 */
		protected function checktel(){
			$content=$_POST['user_tel'];
			if(!preg_match("/1[3458]{1}\d{9}$/",$content)){
				return false;
			}else{
				return true;
			}
		}
		
		/**
		 * 处理checksex回调函数
		 */
		protected function checksex(){
			$content=$_POST['user_sex'];
			if(!preg_match("/^\d+$/i", $content)){
				return false;
			}else{
				return true;
			}
		}
		/**
		 * 处理checkqq回调函数
		 */
		protected function checkqq(){
			$content=$_POST['user_qq'];
			if(!preg_match("/^\d+$/i", $content)){
				return false;
			}else{
				return true;
			}
		}
		
		/**
		 * 判断验证码是否正确
		 */
		protected function checkCode($verify){
			if(!check_verify($verify)){
				return false;
			}else{
				return true;
			}
		}
		
		
		/**
		 * 自动完成，在create时自动执行
		 * array('填充字段','填充内容','填充条件','附加规则');
		 */
		protected $_auto=array(
				//array('gb_addtime','time',1,'function'),
				//array('status','1'),  // 新增的时候把status字段设置为1
				/*array('nickname','htmlspecialchars',1,'function'), 
				array('password','md5',1,'function'),
				array('email','htmlspecialchars',2,'function'),
				array('user_ok','htmlspecialchars',2,'function'),
				array('phone','htmlspecialchars',2,'function'),
				array('sex','htmlspecialchars',2,'function'),
				array('byear','htmlspecialchars',2,'function'),
				//array('user_name','htmlspecialchars',1,'function'),
				//对content字段在新增的时候使md5函数处理
				array('bmonth','htmlspecialchars',2,'function') , 
				
				//array('id','htmlspecialchars',2,'function'),
				array('bday','htmlspecialchars',2,'function'),
				array('province','htmlspecialchars',2,'function'),
				array('city','htmlspecialchars',2,'function'),
				array('height','htmlspecialchars',2,'function'),
				//array('user_login','htmlspecialchars',2,'function'),
				array('marriage','htmlspecialchars',2,'function'),
				array('education','htmlspecialchars',2,'function'),
				array('income','htmlspecialchars',2,'function'),
				array('sol','htmlspecialchars',2,'function'),
				array('user_note','htmlspecialchars',2,'function'),
				array('v','htmlspecialchars',2,'function'),
				array('random_note','htmlspecialchars',2,'function'),
				//array('user_date','htmlspecialchars',2,'function'),*/
		);

		
	}

?>