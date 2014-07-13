<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
 <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	
<title>用户登陆 -PlayWeb</title>

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
	
<script>
 
function login(){
	
  
   $('#user-login').ajaxForm(function(d) {   
   
   if(d.status){
	   
	   u.msg(d.info,4,"index.php");
	   
   }else{
	   
	   u.msg(d.info,5);
	   
   }
 
	  
  });  
	
}



</script>



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
      
<div  style="">
 <form class="form-horizontal" method="post" action="<?php echo U('User/on_login');?>" id="user-login">
 <div class="control-group"><label class="control-label">用户名</label>
 <div class="controls"><input type="text" name="username"></div>
 </div>
 <div class="control-group"><label class="control-label">密码</label>
 <div class="controls"><input type="password" name="password"></div>
 </div>
 <div class="control-group">
 <div class="controls">
 <button type="submit"  class="btn  btn btn-success" onclick="login()">登陆</button>
 </div>
 </div>
</form>

</div>

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