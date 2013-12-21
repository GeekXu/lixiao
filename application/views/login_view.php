<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<base href="<?php echo base_url()?>" />
	<title>登录</title>
	<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/Bubble.js"></script>
	<script type="text/javascript" src="js/jquery.grumble.js"></script>
	<script type="text/javascript" src="js/jquery.grumble.min.js"></script>
	
	<!--
	<script type="text/javascript" src="js/bootstrap-select.js"></script>
	<script type="text/javascript" src="js/bootstrap-tooltip.js"></script>
	-->
	

	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="css/login.css"/>
	<link rel="stylesheet" type="text/css" href="css/grumble.css"/>
</head>
<body>
	<div class="navbar navbar-inverse navbar-fixed-top">
      	<div class="navbar-inner">
        	<div class="container">
          		<a class="brand" href="#"><i class="icon-leaf icon-white"></i> 计算机学院 学生离校系统</a>
       		</div>
      	</div>
    </div>

    <div class="wrap">
    <div class="container-fluid">
    	<div class="row-fluid">
    		<div class="span8">
    			<div id="myCarousel" class="carousel slide">
      				<div class="carousel-inner">
        				<div class="item active">
          					<img src="img/pic1.jpg" alt="">
        				</div>
        				<div class="item">
          					<img src="img/pic2.jpg" alt="">
        				</div>
				        <div class="item">
				         	<img src="img/pic3.jpg" alt="">
				        </div>
				        <div class="item">
          					<img src="img/pic4.jpg" alt="">
        				</div>
				        <div class="item">
				         	<img src="img/pic5.jpg" alt="">
				        </div>
      				</div>
      				<a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
      				<a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
    			</div>
			</div>
			<div class="span3">
				<div >
			      	<form class="form-signin">
			      		<div>
				        <h2 class="form-signin-heading">请登录</h2>
				        <input type="text" id="login_name" class="input-block-level" placeholder="用户名或工号">
				        <input type="password" id="login_psw" class="input-block-level" placeholder="密码">
				        <label class="checkbox">
				         	<input type="checkbox" value="remember-me"> 自动登录&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<a href id="forgetpsw">忘记密码?</a>
				        </label>
						
				        <button class="btn btn-success btn-sm span5" id="login">登录</button>
				        <button class="btn btn-default btn-sm span5" id="reset" type="reset">重置</button>
			      		</br>
			      	</div>
			      		
			      	</form>
			      	
			    </div>
			</div>
		</div>
	</div>
	<div id="push"></div>
</div>
	<!--<a id="example" href="#" rel="tooltip" title="first tooltip">hover over me</a>-->
	<div id="footer">
      <div class="container">
        <p class="muted credit">©版权所有 2005-2014 <a href="http://cs.bit.edu.cn/">北京理工大学计算机学院</a></p>
      </div>
    </div>



	<script type="text/javascript">
		$(document).ready(function(){

			

			$('#login').click(function(){
				//$('#example').tooltip('show');
				var uname = $("#login_name").val();
				var psw = $("#login_psw").val();

				if(uname==""||psw==""){
					$('#login_name').grumble({
						text: '信息不完整', 
						angle: 90, 
						distance: 100, 
						showAfter: 50,
						hideOnClick: true
					});
					return ;
				}

				$.post("<?php echo site_url("login/verify")?>", {uname: uname, psw: psw}, function(d){
					d=eval('('+d+')');
					if (d.status==1) {
						//alert(d.info);
						window.location.href="<?php echo site_url("teacher")?>";
					}
					else{
						//alert(d.info);
						if (d.status==2) {
							$('#login_name').grumble({
								text: '用户不存在!', 
								angle: 90, 
								distance: 100, 
								showAfter: 50,
								hideOnClick: true 
							});
						}
						else if(d.status==3){
							$('#login_psw').grumble({
								text: '密码错误!', 
								angle: 90, 
								distance: 100, 
								showAfter: 50,
								hideOnClick: true
							});
						}
						
					}
				});

			});

			$('form').submit(function(){
				return false;
			});

			$('#forgetpsw').click(function(){
				$(this).grumble({
					text: '尚未开通~', 
					angle: 60, 
					distance: 25, 
					showAfter: 50,
					hideOnClick: true
				});
				return false;
			})
		});
	</script>

</body>
