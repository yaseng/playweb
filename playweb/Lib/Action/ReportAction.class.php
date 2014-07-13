<?php
/**
 * @id       UserAction.php-2014-4-1
 * @desc     扫描报告
 * @author   Yaseng  WwW.Yaseng.Me [Yaseng@UAUC.NET]
 * @project  github.com/yaseng/playweb
 **/

class ReportAction  extends  CommonAction{

	public  function  index(){



	}

	public  function  view(){

		$id=intval($this->_get("id"));
		$project=M("project")->find($id);
		$this->assign("project",$project);
        $this->display();


	}
	
 
	public  function  update(){
		
		$project_hash=$this->_get("project_hash");
		$last_count=intval($this->_get("last_count"));
		$count=M("report")->where(array("project_hash"=>$project_hash))->count();
		if($count >  $last_count){
			
		$data=M("report")->order('id desc')->limit($count-$last_count)->select();
		$reports=array();
		foreach ($data as $item ){
			
			$arr=json_decode($item['content']);
			$report['type']=$item['type'];
			if($report['type'] == "sys_info"){
			
			$report['port']=$arr->port;
			$report['service']=$arr->service;
				
			}

			$report['info']="";
			unset($arr->port);
			unset($arr->service);
			foreach ($arr as $key=>$info){
				
				$report['info'].=$key."=".htmlspecialchars($info)." ";
				
			}
		 
			$reports[]=$report;
			
		}
		
		  // dump($reports);
		  $this->ajaxReturn(($reports));
		
		}

		
		
	}


}




?>