<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
 <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	
<title><?php echo ($project['target']); ?> -扫描报告</title>

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
      
<style>
#xxx{

 

}
</style>
<script>
	var project_hash = "<?php echo ($project['project_hash']); ?>";
	var isScanning = 1;
	$(function() {

		setTimeout(getReport, 2000);
		
		 $('#chart').highcharts({
	            chart: {
	                plotBackgroundColor: null,
	                plotBorderWidth: null,
	                plotShadow: false,
	                height:180,
	                marginTop:-11
	            },
	            title: {
	                text: ''
	            },
	            tooltip: {
	        	    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
	            },
	            credits: {
	            	enabled: false
	            },
	            plotOptions: {
	                pie: {
	                    allowPointSelect: true,
	                    cursor: 'pointer',
	                    dataLabels: {
	                        enabled: false
	                    },
	                    showInLegend: true
	                }
	            },
	            series: [{
	                type: 'pie',
	                name: '漏洞类型',
	                data: [
	                    ['高危',   45],
	                    ['中危',       26.8],
	                    {
	                        name: '低危',
	                        y: 12.8,
	                        sliced: true,
	                        selected: true
	                    },
	                    ['提示',    15.4]
	              
	                ]
	            }]
	        });
 

	});
	function getReport() {

		if (isScanning == 1) {

			setTimeout(getReport, 2000);
			last_count = $("#vul-info tr").length + $("#sys-info tr").length - 2;
			//last_count=1
			$.get("?m=report&a=update&project_hash=" + project_hash
					+ "&last_count=" + last_count, function(reports) {

				if (typeof reports[0] == "object") {

					for (i in reports) {

						if(reports[i].type == "sys_info"){
							$("#sys-info").append(
									"<tr><td><span class=\"label label-info\">"
											+ reports[i].port + "</span></td><td>"
											+ reports[i].service + "</td><td>"
											+ reports[i].info + "</td></tr>");		
							
						}else {
							
							$("#vul-info").append(
									"<tr><td><span class=\"label label-important\">高危</span></td><td>"
									+reports[i].type+"</td><td>"
									+reports[i].info+"</td></tr>");
							
						}


					}
				}

			});
		}

	}
	function isEmpty(obj) {
		for ( var name in obj) {
			return false;
		}
		return true;
	};
</script>
<div class="row"  id="xxx">
<div class="span9">
<div class="accordion-group" id="container-onfo">
<div class="accordion-heading"><a href="#info"
	data-parent="#accordionDetails" data-toggle="collapse"
	class="accordion-toggle"><i class="icon-info-sign"></i> 任务信息</a></div>
<div class="accordion-body in collapse" id="collapseAbstract"
	style="height: auto;">
<table class="table table-bordered table-hover  table-condensed">
	<tbody>
		<tr>
			<td width="8%"><span class="label label-success">目标</span></td>
			<td><?php echo ($project['target']); ?></td>
		</tr>

		<tr>
			<td><span class="label label-success">进度</span></td>
			<td id="xxx">20%</td>
		</tr>
		<tr>
			<td><span class="label label-success">设置</span></td>
			<td id="xxx"></td>
		</tr>
		<tr>
			<td><span class="label label-success">操作</span></td>
			<td>
			<button type="button" class="btn btn-mini  btn-danger"
				onclick=setting()>停止</button>
			&nbsp;&nbsp;
			<button type="button" class="btn btn-mini  btn-info"
				onclick=setting()>打印</button>
			&nbsp;&nbsp;

			<button type="button" class="btn  btn-mini  btn-primary"
				onclick=setting()>导出word</button>
			&nbsp;&nbsp;

			<button type="button" class="btn btn-mini  btn-success"
				onclick=setting()>导出html</button>


			</td>
		</tr>
	</tbody>
</table>
</div>
</div>
</div>
<div class="span3" id="chart"   >表格</div>
</div>

<br>
<table class="table table-bordered table-hover  table-condensed"
	id="vul-info" class="table-report">
	<thead>
		<tr>
			<th width="8%">等级</th>
			<th width="10%">类型</th>
			<th>详细信息</th>

		</tr>
	</thead>
	<tbody>

	</tbody>
</table>



<div class="accordion-group" id="container-sys-onfo">
<div class="accordion-heading"><a href="#sys-info"
	data-parent="#accordionDetails" data-toggle="collapse"
	class="accordion-toggle"><i class="icon-info-sign"></i> 系统信息</a></div>
<div class="accordion-body in collapse" id="collapseAbstract"
	style="height: auto;">
<table class="table table-bordered table-hover  table-condensed"
	id="sys-info" class="table-report">
	<thead>
		<tr>
			<th width="8%">端口</th>
			<th width="10%">服务</th>
			<th>详细信息</th>
		</tr>
	</thead>
	<tbody>
		<!-- 	<tr>
			<td><span class="label label-info">21</span></td>
			<td>ftp</td>
			<td>xxx ftp login</td>
		</tr>
		<tr>
			<td><span class="label label-info">80</span></td>
			<td>web</td>
			<td>server:iis 6.0 lang:asp</td>
		</tr>
		<tr>
			<td><span class="label label-info">3306</span></td>
			<td>mysql</td>
			<td>mysql 5.6.1 log</td>
		</tr>
	 -->
	</tbody>
</table>
</div>
</div>


<script type="text/javascript" src="__JS__/highcharts.js"></script>

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