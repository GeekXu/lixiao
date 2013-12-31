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
	<link rel="stylesheet" type="text/css" href="css/all.css"/>
</head>
<body>
	<header>
		<img class="headlogo" src="img/logo.png"/>
		<div class="navbar">
	      	<div class="navbar-inner">
          		<div class="nav-collapse collapse">
            		<ul class="nav">
              			<li class="active"><a href="index.php/admin"><i class="icon-home"></i> 主页</a></li>
              			<li><a href="index.php/admin/manageall"><i class="icon-list"></i> 管理所有学生</a></li>
              			<li><a href="index.php/admin/changepsw" id="changepsw"><i class="icon-wrench"></i> 修改密码</a></li>
              			<li><a href="index.php/admin/quit" id="quit"><i class="icon-off"></i> 退出登录</a></li>
              		</ul>
          		</div>	
	      	</div>
	    </div>
	</header>

    <div class="container main-container">
    	<p>抱歉，学生不存在，请检查操作是否有误并重试</p>
    </div>


	
	<script type="text/javascript">
		$(document).ready(function(){
		});
	</script>

</body>
