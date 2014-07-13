<?php
/**
 * @id       UserAction.php-2014-3-24
 * @desc     用户中心
 * @author   Yaseng  WwW.Yaseng.Me [Yaseng@UAUC.NET]
 * @project  github.com/yaseng/playweb
 **/
class UserAction extends CommonAction {

	/**
	 * @desc 用户中心
	 **/
	public  function  index(){

		$this->_check_priv(); //是否登陆

		dump($this->_g['user']);
			
	}
	/**
	 * @desc 注册
	 **/
	public  function  reg(){

       $this->display();
		
	}

	public function  on_reg(){

		if($this->_post("password") == $this->_post("password2")){
			
			$ret=D("user")->add($_post("username"),$_post("password"),$_post("email"));
		}


	}



	/**
	 * @desc 登陆
	 **/
	public  function  login(){

 
		$time=time();

		$this->display();

	}

	public function  on_login(){
			
		$ret=D("User")->login($this->_post('username'),$this->_post('password'));
		$this->ajaxReturn($ret);

	}
	public  function logout(){

		setcookie("cv_uid", "", time() - 3600, "/", "", FALSE, TRUE);
		setcookie("cv_uhash", "", time() - 3600, "/", "", FALSE, TRUE);
		$this->success("退出成功",U('index/index'));

	}



}

?>