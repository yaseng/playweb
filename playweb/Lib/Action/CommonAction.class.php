<?php
/**
 * @id       Commonction.php-2014-3-2
 * @desc     web server 层所有api  action
 * @author   Yaseng  WwW.Yaseng.Me [Yaseng@UAUC.NET]
 * @project  github.com/yaseng/playweb
 **/
class CommonAction extends Action{
	
	var $_g;
	
	public function  _initialize(){
		
	 
		$this->_g['type']=array(1=>"sql注入",2=>"xss",3=>"代码执行");
		$this->_g['level']=array(1=>array("name"=>"高危","style"=>"important"),2=>array("name"=>"中危","style"=>"warning"),3=>array("name"=>"低危","style"=>"info"));
		$this->_check_user();
        $this->assign('_g',$this->_g);
	}
	
	private  function  _check_user(){
		
		$uid=intval(cookie("uid"));
		$token=cookie("uhash");
		if($uid){

			$this->_g['user']=D("User")->check($uid, $hash);
		}
		
		
	}
	/**
	 *@name    前台消息提示函数
	 *@param   text  提示内容
	 **/
	public function  msg(){
		
		
	}
	/**
	 * @name        查询权限
	 * @param  id   权限表对应的id 默认为0 极为登陆权限
	 * @param  text 
	 * @param  url
	 **/
	public function  _check_priv($id=0,$text="",$url=""){
		
		if($id==0 && !$this->_g['user']){
			
			
		 
			
			 $text="请先登陆"; 
			 $url=U('User/login');
			 $this->error($text,$url);
					
			
		} 
		
		
		return ;
	}
	
	
	
	
	
	
	
}