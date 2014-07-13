<?php
/**
 * @id       NodeAction.php-2014-3-28
 * @desc     扫描节点api接口
 * @author   Yaseng  WwW.Yaseng.Me [Yaseng@UAUC.NET]
 * @project  github.com/yaseng/playweb
 **/
class NodeAction  extends  CommonAction{

	private    $node_key="a88b92531ba974f68bc1fd5938fc77";

	public function  index(){


		echo  substr(md5(rand_str().time()),0,15);


	}


	private  function  node_return($data){


		echo str_encode(json_encode($data),$this->node_key);


	}


	/**
	 * @desc  所有节点列表
	 **/
	function listing(){


		$this->_check_priv();
		$nodes=M("Node")->where(array("status"=> 1,"user_hash"=> $this->_g['user']['user_hash']))->select();
		$online_nodes=array();
		foreach ($nodes as $node) {
				
			/* if(time() - $node['time'] < 10 ){  //断线延时 10秒

			$online_nodes[]=$node;

			}
			*/
			$online_nodes[]=$node;
		}
		 
		$this->ajaxReturn($online_nodes);


	}

	/**
	 * @desc    Node   节点
	 * @return  hash   节点的hash
	 **/
	public  function login(){

		$os=$this->_get("os");
		$user_hash=$this->_get("user_hash");
		$ip=get_client_ip();
		$node_hash=get_hash();
		M("Node")->add(array("ip"=> $ip, "os"=> $os,"user_hash"=> $user_hash,"node_hash"=> $node_hash,"time"=>time(),"status"=> 1));
		echo $node_hash;


	}

	/**
	 * @desc    获取扫描项目
	 * @param   $hash 节点hash
	 * @return
	 **/
	public  function  get_project(){

		$nodes=M("Node")->select();
		$online_nodes=array();
		foreach ($nodes as $node) {
				
			/* if(time() - $node['time'] < 10 ){  //断线延时 10秒

			$online_nodes[]=$node;

			}
			*/
			$online_nodes[]=$node;
		}
		 
		$this->ajaxReturn($online_nodes);

	}



	/**
	 * @desc 获取任务
	 * @param $nodeid
	 **/
	public function get_task(){

		$node_hash="68bc1fd5938fc77";
		//$node_hash=$this->_post("node_hash");
		$project=M("project")->where(array("status"=>0))->find();
		// M("project")->where(array("id"=>$project['id']))->save(array("status"=>1));
		if($project){
				
			$project=array_merge($project,unserialize($project['setting']));
			unset($project['setting']);
			//dump($project);

			//$this->node_key=$project['project_hash'].$node_hash;
		 
			 $this->node_return($project);
		}



	}

	function  update(){

	 $node_hash=$this->_get("node_hash");
	 // M("Node")->where(array("node_hash"=> $node_hash))->save(array("time"=> time()));

	}

	/*
	 * 扫描报告
	 */
	function  report(){


		$post=$this->_post();

		//file_put_contents("1.txt", str_decode($post['content'], $this->node_key)."\r\n",FILE_APPEND);
		$report=(array)json_decode(str_decode($post['content'], $this->node_key));
        $arr_type=array("sys_info","sqli","xss");
		if(in_array($report['type'], $arr_type)){
			
			M("report")->add($report);
			
		}
		
		
		
		
	}

	
	
	
	
	
	
	
	
	
	
	



}


?>