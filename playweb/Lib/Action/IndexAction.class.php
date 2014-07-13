<?php
/**
 * @id       IndexAction.php-2014-3-2
 * @desc     默认页面
 * @author   Yaseng  WwW.Yaseng.Me [Yaseng@UAUC.NET]
 * @project  github.com/yaseng/playweb
 **/ 
class IndexAction extends CommonAction {
    public function index(){
	
    	$this->_check_priv();
    	
    
    	
    	$this->display();
    	
    	
    }
}