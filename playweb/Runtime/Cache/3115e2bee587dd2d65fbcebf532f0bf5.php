<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
 <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	
<title>PlayWeb -分布式网络安全扫描系统</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="stylesheet" type="text/css" href="__CSS__/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="__CSS__/bootstrap-responsive.min.css"/>
    <link rel="stylesheet" type="text/css" href="__CSS__/bootstrap-wizard.css"/>
	<link rel="stylesheet" type="text/css" href="__CSS__/style.css"/>
	<script type="text/javascript" src="__JS__/jquery.js"></script>
	<script type="text/javascript" src="__JS__/bootstrap.min.js"></script>
	<script type="text/javascript" src="__JS__/playweb.js"></script>
	<script type="text/javascript" src="__JS__/uauc.js"></script>
	<link rel="shortcut icon" href="favicon.ico">
	
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
 </head>
 <body>
   	<div class="navbar navbar-fixed-top">
	  <div class="navbar-inner">
	    <div class="container"> 
	    	<a href="" class="brand">PlayWeb</a>
	      <div class="nav-collapse" id="">
	        <ul  class="nav">
	        </ul>
	        <ul class="pull-right nav"  >
	        	<li><a href="#myModal"  data-toggle="modal"><i class="icon-cog"></i> 设置</a></li>
	        	<li>
	            <?php if($_g['user']): ?><a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-user"></i> <?php echo ($_g['user']['name']); ?> <b class="caret"></b></a>
                 <ul class="dropdown-menu">
                 	<li><a href="<?php echo U('User/logout');?>"><i class="icon-github"></i> 退出</a></li>
                </ul>
               <?php else: ?> 
      	        <a   href="<?php echo U('User/login');?>"><i class="icon-user"></i> 登录</a><?php endif; ?>
	         </li>
            <li><a href="#aboutModal"  data-toggle="modal"><i class="icon-question-sign"></i> 关于</a></li>
	        </ul>
	      </div>
         </div>
	  </div>
	</div>
    <div class="container" id="page">
      
<div class="container" id="page">
<div id="content">
<div class="hero-unit">
<h1>PlayWeb</h1>
<p class="muted">分布式网络安全扫描系统</p>
<form class="form-search" action="/" method="post"><!-- <select class="selectpicker hide" data-width="10%" name="type">
                    <option value="url">Url</option>
                    <option value="email">Hosts</option>
                    <option value="fuzzy">Fuzzy</option>
                    </select>
                    -->
<div class="input-append"><input name="wd"
	class="input-xlarge search-query" placeholder="" value="" type="text">
<button type="button" class="btn btn-primary" id="btn-scanner">
<i class="icon-search icon-white"> </i> 扫描</button>
</div>
<button type="button" class="btn btn-success hide" onclick=setting()>
<i class="icon-cog"> </i> 设置</button>
</form>
<div id="loader" class="hide span5 offset3"
	style="width: 0px; height: 0px; margin-left: 500px">
<div class="circle"></div>
</div>
<div id="log" class="hide"><img src="static/img/loading.gif">
<span class="label label-success"> Hacking... </span></div>
</div>
<div class="modal hide fade" id="myModal">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"
	aria-hidden="true">&times;</button>
<i class="icon-cog"> </i> <b> 扫描设置 </b></div>
<div class="modal-body">
<table class="table table-bordered .table-hover">
	<tbody>
		<tr>
			<td width="8%"><span class="label label-success"> 扫描插件 </span></td>
			<td><label class="checkbox inline"> <input
				type="checkbox" id="inlineCheckbox3" value="option3"> 信息获取 </label>
			<label class="checkbox inline"> <input type="checkbox"
				id="inlineCheckbox3" value="option3"> 敏感目录 </label> <label
				class="checkbox inline"> <input type="checkbox"
				id="inlineCheckbox1" value="option1"> sql 注入 </label> <label
				class="checkbox inline"> <input type="checkbox"
				id="inlineCheckbox2" value="option2"> xss </label> <label
				class="checkbox inline"> <input type="checkbox"
				id="inlineCheckbox3" value="option3"> 信息获取 </label> <label
				class="checkbox inline"> <input type="checkbox"
				id="inlineCheckbox3" value="option3"> 子域名枚举 </label></td>
		</tr>
		<tr>
			<td><span class="label label-success"> 扫描选项 </span></td>
			<td>web端口 <input type="text" value="80,8080"></td>
		</tr>
		<tr>
			<td><span class="label label-success"> Client </span></td>
			<td></td>
		</tr>
		<tr>
			<td><span class="label label-success"> Cookie </span></td>
			<td><input type="text"></td>
		</tr>
	</tbody>
</table>
</div>
<div class="modal-footer"><a href="#" class="btn"> 关闭 </a> <a
	href="#" class="btn btn-primary"> Save changes </a></div>
</div>
</div>

<div class="wizard" id="project-wizard">
<h1>新建项目</h1>
<div class="wizard-card" data-onValidated="setServerName"
	data-cardname="target"><span style="display: none">
<h3>目标</h3>
</span> <br>
<div class="control-group"><label class="radio"> <input
	type="radio" name="radio-targets" id="radio-single"
	value="option-single" checked> 单个 <br>
</label> <label class="target-input"> &nbsp;&nbsp;&nbsp;&nbsp; <input
	type="text" name="target" value=""  data-validate="check_target"> </label></div>
<div class="control-group"><label class="radio"> <input
	type="radio" name="radio-targets" id="radio-batch"
	value="option-single"> 批量 </label> <label class="target-input">
&nbsp;&nbsp;&nbsp;&nbsp; <textarea rows="3">
                    </textarea> </label></div>
</div>
<div class="wizard-card" data-cardname="node"><span
	style="display: none">
<h3>节点</h3>
</span> <br>
<label class="checkbox"> <input type="checkbox" name="node[1]"
	value="1"> <img width="4%" height="4%"
	src="static/img/windows.png"> <b> 127.0.0.1 </b> </label> <label
	class="checkbox"> <input type="checkbox" name="node[2]"
	value="1"> <img width="4%" height="4%"
	src="static/img/linux.png"> <b> 106.185.222.53 </b> </label></div>
<div class="wizard-card" data-cardname="module"><span
	style="display: none">
<h3>模块</h3>
</span>
<table class="table table-bordered .table-hover">
	<tbody>
		<tr>
			<td width="8%"><span class="label label-success">
			Discovery </span></td>
			<td><label class="checkbox inline"> <input
				type="checkbox" id="inlineCheckbox1" name="moudle[port]" value="1">
			端口服务探测 </label> <label class="checkbox inline"> <input
				type="checkbox" id="inlineCheckbox2" name="moudle[crawler]"
				value="1"> web爬虫 </label> <label class="checkbox inline"> <input
				type="checkbox" id="inlineCheckbox3" name="moudle[whatcms]"
				value="1"> CMS识别 </label></td>
		</tr>
		<tr>
			<td width="8%"><span class="label label-success"> Fuzzing
			</span></td>
			<td><label class="checkbox inline"> <input
				type="checkbox" id="inlineCheckbox1" name="moudle[sqli]" value="1">
			sqli </label> <label class="checkbox inline"> <input type="checkbox"
				id="inlineCheckbox2" name="moudle[xss]" value="1"> xss </label> <label
				class="checkbox inline"> <input type="checkbox"
				id="inlineCheckbox3" name="moudle[lfi]" value="1"> lfi </label></td>
		</tr>
		<tr>
			<td width="8%"><span class="label label-success"> Brute
			Login </span></td>
			<td><label class="checkbox inline"> <input
				type="checkbox" id="inlineCheckbox1" name="moudle[http-brute]"
				value="1"> http </label> <label class="checkbox inline"> <input
				type="checkbox" id="inlineCheckbox2" name="moudle[ftp-brute]"
				value="1"> ftp </label> <label class="checkbox inline"> <input
				type="checkbox" id="inlineCheckbox3" name="moudle[ssh-brute]"
				value="1"> ssh </label> <label class="checkbox inline"> <input
				type="checkbox" id="inlineCheckbox3" value="1"> mysql </label></td>
		</tr>
	</tbody>
</table>
</div>
<div class="wizard-card" data-cardname="setting"><span
	style="display: none">
<h3>参数</h3>
</span>
<table class="table table-bordered .table-hover">
	<tbody>
		<tr>
			<td width="8%"><span class="label label-success"> web端口 </span>
			</td>
			<td><input type="text" name="setting[web-ports]" value="80,8080">
			</td>
		</tr>
		<tr>
			<td><span class="label label-success"> app端口 </span></td>
			<td><input type="text" name="setting[app-ports]"
				value="21,22,1433,3389,3306"></td>
		</tr>
		<tr>
			<td><span class="label label-success"> 文件后缀 </span></td>
			<td><input type="text" name="setting[file-ext]"
				class="input-xlarge"
				value="cgi, cfm, asp, aspx, jsp, php, htm, html, do"></td>
		</tr>
		<tr>
			<td><span class="label label-success"> 用户字典 </span></td>
			<td><input type="text" name="setting[userlist]"
				class="input-xlarge" value="admin,root,administrator"></td>
		</tr>
		<tr>
			<td><span class="label label-success"> 密码字典 </span></td>
			<td><input type="text" name="setting[passlist]"
				class="input-xlarge" value="admin,root,123456"></td>
		</tr>
		<tr>
			<td><span class="label label-success"> 目录列表 </span></td>
			<td><input type="text" name="setting[dirlist]"
				class="input-xlarge" value="admin,web,data"></td>
		</tr>
		<tr>
			<td><span class="label label-success"> http头 </span></td>
			<td><input type="text" name="setting[client]"
				style="width: 400px"
				value="Referer:http://www.google.com User-Agent:Googlebot/2.1 (+http://www.googlebot.com/bot.html) Cookie:">
			</td>
		</tr>
		<tr>
			<td><span class="label label-success"> 其他 </span></td>
			<td>线程: <input type="text" name="setting[thread]" value="10"
				style="width: 30px"> 爬行深度: <input type="text"
				name="setting[depth]" value="10" style="width: 30px"></td>
		</tr>
	</tbody>
</table>
</div>
</div>

<div class="accordion-group" id="container-onfo">
<div class="accordion-heading"><a href="#info"
	data-parent="#accordionDetails" data-toggle="collapse"
	class="accordion-toggle"> <i class="icon-info-sign"> </i> 系统信息 </a></div>
<div class="accordion-body in collapse" id="collapseAbstract"
	style="height: auto;">
<table class="table table-bordered .table-hover">
	<tbody>
		<tr>
			<td width="8%"><span class="label label-success"> 模块 </span></td>
			<td><span class="badge badge-info"> 1 </span> 端口服务探测 <span
				class="badge badge-info"> 2 </span> web爬虫</td>
		</tr>
		<tr>
			<td><span class="label label-success"> 插件 </span></td>
			<td><span class="badge badge-warning"> 1 </span> xss检测引擎 <span
				class="badge badge-warning"> 2 </span> sql注入引擎 <span
				class="badge badge-warning"> 3 </span> 弱口令</td>
		</tr>
		<tr>
			<td><span class="label label-success"> 节点 </span></td>
			<td id="node_list">查询在线扫描节点中...</td>
		</tr>
		<tr>
			<td><span class="label label-success"> 设置 </span></td>
			<td id="lable-setting"></td>
		</tr>
		<tr>
			<td><span class="label label-success"> 历史记录 </span></td>
			<td>2014-3-23</td>
		</tr>
	</tbody>
</table>
</div>
</div>
<div class="accordion-group hide" id="container-result">
<div class="accordion-heading"><a href="#project-list"
	data-parent="#accordionDetails" data-toggle="collapse"
	class="accordion-toggle"> <i class="icon-info-sign"> </i> 项目列表 </a></div>
<table class="table table-striped table-bordered bootstrap-datatable"
	id="project-list">
	<thead>
		<tr>
			<th width="3%">No</th>
			<th width="30%">目标</th>
			<th>状态</th>
			<th width="20%">操作</th>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>
</div>
</div>


<script type="text/javascript" src="__JS__/bootstrap-wizard.js">
    </script>
<script type="text/javascript" src="__JS__/index.js">
    </script>

    </div>
            <div class="modal hide fade" id="aboutModal">
			<div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			  <i class="icon-question-sign"></i><b>关于PlayWeb</b>
		  </div>
		  <div class="modal-body">
		  	<table class="table table-bordered .table-hover">
        	<tbody>
		    			<tr>
		    				<td width="20%"><span class="label label-success">名称</span></td>
		    				<td>PlayWeb</td>
		    			 </tr>
		    			 <tr>
		    			    <td><span class="label label-success">主页</span></td>
		    			    <td><a href="https://github.com/yaseng/playweb">https://github.com/yaseng/playweb</a></td>
		    			 </tr>
		    			 <tr>
		    			 	<td><span class="label label-success">作者</span></td>
		    			 	<td>高剑锋(Yaseng)</td>
		    			 </tr> 
		    			 <tr>
		    			 	<td><span class="label label-success">帮助</span></td>
		    			 	<td>1</td>
		    			 </tr> 
       　            	</tbody>
       　		</table>
		    </div>
		    </div>
 </body>
</html>