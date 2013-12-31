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
	<link rel="stylesheet" type="text/css" href="css/changepsw.css"/>
	<link rel="stylesheet" type="text/css" href="css/all.css"/>
</head>
<body>
	<header>
		<img class="headlogo" src="img/logo.png"/>
		<div class="navbar navbar">
	      	<div class="navbar-inner">
          		<div class="nav-collapse collapse">
            		<ul class="nav">
              			<li><a href="index.php/admin"><i class="icon-home "></i> 主页</a></li>
              			<li><a href="index.php/admin/manageall"><i class="icon-list "></i> 管理所有学生</a></li>
              			<li class="active"><a href="index.php/admin/changepsw" id="changepsw"><i class="icon-wrench "></i> 修改密码</a></li>
              			<li><a href="<?php echo site_url("admin/quit")?>" id="quit"><i class="icon-off "></i> 退出登录</a></li>
            		</ul>
          		</div>
	      	</div>
	    </div>
	</header>

    <div class="container main-container">
    	<form class="form-horizontal">
			<div class="control-group">
				<label class="control-label" for="inputPassword">原密码：</label>
				<div class="controls">
					<input type="password" id="inputOripsw" placeholder="输入原密码" required>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="inputPassword">新密码：</label>
				<div class="controls">
					<input type="password" id="inputPassword" placeholder="输入新密码" required>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="inputPassword">新密码：</label>
				<div class="controls">
					<input type="password" id="reinputPassword" placeholder="重复新密码" required>
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<button type="reset" class="btn ">重置</button>
					<button id="doChangePsw" type="submit" class="btn btn-primary">修改</button>
				</div>
			</div>
		</form>

    	<div id="footer">
	        <div class="container">
		      	<br/>
		        <p class="muted credit">©版权所有 2005-2014 <a href="http://cs.bit.edu.cn/">北京理工大学计算机学院</a></p>
	        </div>
	    </div>
    </div>


	
	<script type="text/javascript">
		$(document).ready(function(){
			$('#doChangePsw').click(function(){
				var oriPsw=$('#inputOripsw').val();
				var newPsw=$('#inputPassword').val();
				var renewPsw=$('#reinputPassword').val();

				if(!oriPsw || !newPsw || !renewPsw)
					return;

				if (newPsw != renewPsw) {
					alert('两次输入的密码不一致，请检查。');
					return false;
				}
				$.post("index.php/admin/doChangePsw",{oriPsw: oriPsw, newPsw: newPsw},function(d){
					//alert(d);
					
					d=eval('('+d+')');
					if (d.status==-1) {
						alert('密码错误！');
					}
					else if(d.status==1){
						alert('修改成功！');
					}
					else{
						alert('未知错误，请重试！');
					}

				});
				return false;
			})
		});
	</script>

</body>
