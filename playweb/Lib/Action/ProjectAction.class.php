<?php
/**
 * @id       UserAction.php-2014-4-1
 * @desc     扫描项目 action 类
 * @author   Yaseng  WwW.Yaseng.Me [Yaseng@UAUC.NET]
 * @project  github.com/yaseng/playweb
 **/
class  ProjectAction  extends  CommonAction{
	public  function  index(){



	}
	/**
	 * @desc 添加扫描任务
	 **/
	public  function  on_add(){

		$this->_check_priv();
		$ret['target']=$this->_post("target");
		$arr_setting=array("web_ports"=>"80,8080","start_time"=>time());
		$ret['setting']=serialize($arr_setting);
        $ret['project_hash']=get_hash();
        //异常处理    !!!
        $ret['id']=M("project")->add($ret);
	    if($ret['id']){
	    	
	    	$this->ajaxReturn($ret);
	    	
	    }
		
      

	}
	
	function   test(){
		
	 	$post=$this->_post();
	 	$ret['target']=$post["target"];
	 	$module="";
	 	foreach ($post['moudle'] as $k=>$v){
	 		
	 		$module.=$k.",";
	 	}
	 	$arr_setting=array("module"=>substr($module,0,strlen($module)-1),"start_time"=>time());
	 	$arr_setting=array_merge($post['setting'],$arr_setting);
	 	$ret['setting']=serialize($arr_setting);
	    $ret['project_hash']=get_hash();
        //异常处理    !!!
        $ret['id']=M("project")->add($ret);
	    if($ret['id']){
	    	
	    	$this->ajaxReturn($ret);
	    	
	    }
		
	}



}

?>