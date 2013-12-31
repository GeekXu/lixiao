<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<base href="<?php echo base_url()?>" />
	<title>离校管理系统 - 北京理工大学计算机学院</title>
	<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<!--
	<script type="text/javascript" src="js/Bubble.js"></script>
	<script type="text/javascript" src="js/jquery.grumble.min.js"></script>	
	<link rel="stylesheet" type="text/css" href="css/grumble.css"/>
	-->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="css/login.css"/>
	
</head>
<body style="padding-top=0px">
	<header>
		<img src="img/logo.png"><br/><br/>
	</header>

    <div class="wrap">
    <div class="container-fluid">
    	<div class="row-fluid">
    		<div class="span8">
    			<div id="myCarousel" class="carousel slide">
    				<ol class="carousel-indicators">
		                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		                <li data-target="#myCarousel" data-slide-to="1" class=""></li>
		                <li data-target="#myCarousel" data-slide-to="2" class=""></li>
		                <li data-target="#myCarousel" data-slide-to="3" class=""></li>
		                <li data-target="#myCarousel" data-slide-to="4" class=""></li>
		              </ol>
      				<div class="carousel-inner">
        				<div class="item active">
          					<img src="img/pic1.jpg" alt="" class="img-rounded">
          					<div class="carousel-caption">
                        		<h4>毕业生宿舍亮灯拼字 惜别大学时代</h4>
                        		<p>新1号学生公寓的北面墙上，208个寝室的学生用灯光在10分钟内分别拼出“再见北理工”5个字。</p>
                    		</div>
        				</div>
        				<div class="item">
          					<img src="img/pic2.jpg" alt="" class="img-rounded">
        				</div>
				        <div class="item">
				         	<img src="img/pic3.jpg" alt="" class="img-rounded">
				        </div>
				        <div class="item">
          					<img src="img/pic4.jpg" alt="" class="img-rounded">
        				</div>
				        <div class="item">
				         	<img src="img/pic5.jpg" alt="" class="img-rounded">
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
				        <!--<h2 class="form-signin-heading">请登录</h2>-->

				        <legend>
				        	<!--<h2 class="form-signin-heading">请登录</h2>-->
				        	<!--<img src="img/loginbox.gif" width="150%">-->
				        	<br/>
				        </legend>
				        <div class="alert alert-info">
							<a class="close" id="error-msg" data-dismiss="alert">×</a>
  							请填写用户名和密码！
						</div>
				        <input type="text" id="login_name" class="input-block-level" placeholder="用户名" >
				        <input type="password" id="login_psw" class="input-block-level" placeholder="密码" >
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
      	<br/>
        <p class="muted credit">©版权所有 2005-2014 <a href="http://cs.bit.edu.cn/">北京理工大学计算机学院</a></p>
      </div>
    </div>



	<script type="text/javascript">
		$(document).ready(function(){

			$('#myCarousel').carousel({
			    interval: 2000
			});

			//$('.alert').hide();

			$('#login').click(function(){
				//$('#example').tooltip('show');
				var uname = $("#login_name").val();
				var psw = $("#login_psw").val();

				if(uname==""||psw==""){
					/*
					$('#login_name').grumble({
						text: '信息不完整',
						angle: 90,
						distance: 100,
						showAfter: 50,
						hideOnClick: true
					});
					*/
					$(".alert").removeClass('alert-info').addClass('alert-error');
					$('.alert').html('<a class="close" id="error-msg" data-dismiss="alert">×</a>请填写用户名和密码！');
					//$('.alert').prepend($error_msg);
					$('.alert').show();
					updatebind();

					return false;
					
				}

				$.post("<?php echo site_url("login/verify")?>", {uname: uname, psw: psw}, function(d){
					d=eval('('+d+')');
					if (d.status==1) {
						//alert(d.info);
						$(".alert").removeClass('alert-error').removeClass('alert-info').addClass('alert-success');
						$('.alert').html('<a class="close" id="error-msg" data-dismiss="alert">×</a>登陆成功！');
						$('.alert').show();
						updatebind();

						window.location.href="<?php echo site_url("teacher")?>";
					}
					else{
						//alert(d.info);
						if (d.status==2) {
							/*
							$('#login_name').grumble({
								text: '用户不存在!', 
								angle: 90, 
								distance: 100, 
								showAfter: 50,
								hideOnClick: true 
							});
							*/
							$(".alert").removeClass('alert-info').addClass('alert-error');
							$('.alert').html('<a class="close" id="error-msg" data-dismiss="alert">×</a>用户不存在！');
							//$('.alert').prepend($error_msg);
							$('.alert').show();
							updatebind();
						}
						else if(d.status==3||d.status==0){
							/*
							$('#login_psw').grumble({
								text: '密码错误!', 
								angle: 90, 
								distance: 100, 
								showAfter: 50,
								hideOnClick: true
							});
							*/
							$(".alert").removeClass('alert-info').addClass('alert-error');
							$('.alert').html('<a class="close" id="error-msg" data-dismiss="alert">×</a>密码错误！');
							$('.alert').show();
							updatebind();
						}
						
					}
				});

			});
			
			/*
			$('input').focus(function(){
				$('.alert').hide();
			})
			*/

			/*
			$('#error-msg').click(function(){
				$(this).parent().hide();
				return false;
			})

			$('.alert').change(function(){
				alert(1);
			})
			*/
			updatebind();


			$('form').submit(function(){
				//$('.alert').hide();
				$(".alert").removeClass('alert-error').addClass('alert-info');
				$('.alert').html('<a class="close" id="error-msg" data-dismiss="alert">×</a>正在验证...');
				$('.alert').show();
				updatebind();
				return false;
			});

			$('#forgetpsw').click(function(){
				/*
				$(this).grumble({
					text: '尚未开通~', 
					angle: 60, 
					distance: 25, 
					showAfter: 50,
					hideOnClick: true
				});
				*/
				$(".alert").removeClass('alert-info').addClass('alert-error');
				$('.alert').html('<a class="close" id="error-msg" data-dismiss="alert">×</a>忘记密码功能尚未开通，请联系管理员。');
				$('.alert').show();
				updatebind();
				return false;
			})
		});

		var updatebind=function(){
			$('#error-msg').click(function(){
				$(this).parent().hide();
				return false;
			});
		} 
	</script>

</body>
