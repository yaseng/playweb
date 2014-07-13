<?php 
class UserModel extends Model{
	
	
	/**
	 * cookie 认证
	 * uid     用户id                   http only
 	 * token   token 已经加密的hash      http only 
	 * 
	 */
	
	
	/**
	 *@desc hash 加密算法
	 * 
	 **/
	public function tmd5($pw,$time){


		return substr(md5(md5($time).md5($pw)),-22);

	}

    /*
     * 研究 tmd5
     */
	private function checkmd5($password,$regtime)
	{

		return  (substr(md5(md5($regtime).md5($password)),-22));
	}
	
	/*
	 * @name 用户数据得到hash
	 */
	public function make_hash($user){
		
	 return substr(md5($user['name'].$user['uid'].$user['password']),-25);
		
	}
	
	
	/*
	 *@name    根据 uid 和 hash 得到 user 数组
	 *@param   uid  用户的id
	 *@param   hash hash
	 *@return  验证通过 返回user数组 否则返回null
	 */
	public function check($uid,$hash){
		
	    
		$user=$this->where(array("uid"=> $uid))->find();
		// return  (make_hash($user) == $hash ) ? $user : null; 
		return $user;
		
		
	}
	
	
	function  add($username,$password,$email){
		
		
		
	}
	
	
	function login($username,$password){
		
		$ret['status']=0;
		$ret['info']="用户名或密码错误";
		$user=$this->where(array("name"=> $username))->find();
		if($user){

			 if($this->checkmd5($password,$user['key']) == $user['password']){
			 	
			 	$ret['status']=1;
			 	$ret['info']="登陆成功";
			 	setcookie("cv_uid", $user['uid'], time()+60 * 60 * 24 * 10, "/", "", FALSE, TRUE);
			 	setcookie("cv_uhash",$this->make_hash($user), time()+60 * 60 * 24 * 10, "/", "", FALSE, TRUE);
			 	
			 }			
		}
	   return  $ret;
		
		
	}
	
	
	
	
	
	
	
	
}

?>