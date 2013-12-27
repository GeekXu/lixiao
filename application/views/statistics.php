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
		<img class="headlogo" src="img/logo.png"/>
		<div class="navbar navbar">
	      	<div class="navbar-inner">
          		<div class="nav-collapse collapse">
            		<ul class="nav">
              			<li><a href="index.php/teacher"><i class="icon-home "></i> 主页</a></li>
              			<li class="active"><a href="index.php/teacher/statistics"><i class="icon-list "></i> 离校情况统计</a></li>
              			<li><a href="index.php/teacher/changepsw" id="changepsw"><i class="icon-wrench "></i> 修改密码</a></li>
              			<li><a href="<?php echo site_url("teacher/quit")?>" id="quit"><i class="icon-off "></i> 退出登录</a></li>
            		</ul>
          		</div>
	      	</div>
	    </div>
	</header>

    <div class="container main-container">
    	<table id="statistics" class="table table-striped table-boarded">
    		<thead>
    			<th>导师</th>
    			<th>硕士生人数</th>
    			<th>已离校硕士生人数</th>
    			<th>博士生人数</th>
    			<th>已离校博士生人数</th>
    		</thead>
    		<tbody>
    			<?php foreach ($results as $key => $value): ?>
    			<tr>
    				<td><?php echo $value->username ?></td>
    				<td><?php echo $value->masternum ?></td>
    				<td><?php echo $value->masterleavenum ?></td>
    				<td><?php echo $value->phdnum ?></td>
    				<td><?php echo $value->phdleavenum ?></td>
    			</tr>
    			<?php endforeach;?>
    		</tbody>
    	</table>
    	<div id="footer">
	        <div class="container">
		      	<br/>
		        <p class="muted credit">©版权所有 2005-2014 <a href="http://cs.bit.edu.cn/">北京理工大学计算机学院</a></p>
	        </div>
	    </div>
    </div>


	
	<script type="text/javascript">
		$(document).ready(function(){

		});
	</script>

</body>
