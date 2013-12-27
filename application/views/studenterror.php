<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<base href="<?php echo base_url()?>" />
	<title>离校管理</title>
	<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>

	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="css/studentdetail.css"/>
</head>
<body>
	<header>
		<div class="navbar navbar-inverse">
	      	<div class="navbar-inner">
	        	<div class="container">
	        		<img class="headlogo" src="img/logo.png"/>
	        		
	          		<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
	            		<span class="icon-bar"></span>
	            		<span class="icon-bar"></span>
	            		<span class="icon-bar"></span>
	          		</button>
	          		<div class="nav-collapse collapse">
	            		<ul class="nav">
	              			<li class="active"><a href="index.php/teacher"><i class="icon-home icon-white"></i> 主页</a></li>
	              			<li><a ><i class="icon-list icon-white"></i> 离校情况统计</a></li>
	              			<li><a href id="changepsw"><i class="icon-wrench icon-white"></i> 修改密码</a></li>
	              			<li><a href="<?php echo site_url("teacher/quit")?>" id="quit"><i class="icon-off icon-white"></i> 退出登录</a></li>
	            		</ul>
	          		</div>
	          	
	       		</div>
	       		
	      	</div>
	    </div>
	</header>

    <div class="container main-container">
    	<p>抱歉，这个学生不在您的实验室，请检查操作是否有误并重试</p>
    </div>


	
	<script type="text/javascript">
		$(document).ready(function(){
		});
	</script>

</body>
