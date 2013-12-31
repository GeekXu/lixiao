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
	<link rel="stylesheet" type="text/css" href="css/teacher_index.css"/>
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
  		<div class="personal_info">
				<div class="row-fluid">
					<div class="span3">
						<img class="photo" src="image/teacher_head.png">
					</div>

					<div class="span8 teacher_info">
						<legend><h3><?php echo $teacherinfo[0]->username;?> 导师</h3></legend>
						<span><p class="teacher_title"><?php echo $teacherinfo[0]->title;?></p></span>
						<span><p>计算机学院</p></span>
						<span>共有硕士 <strong><?php echo count($studentmaster)?></strong> 名，博士 <strong><?php echo count($studentphd)?></strong> 名，已离校硕士 <strong><?php echo $studentmasterleavenum;?></strong> 名，已离校博士 <strong><?php echo $studentphdleavenum;?></strong> 名</span>
					</div>
				</div>
  		</div>
  		
  		<div class="studentlist">
  			<div class="divider">
  			</div>

			
			<div class="container inner-container">
				<div class="t">
					硕士：
				</div>
				<ul class="list-body">

					<?php foreach ($studentmaster as $key => $value): ?>
						<li class="student btn" id="<?php echo $value->studentid;?>">
							<a class="" href="index.php/admin/student/<?php echo $value->studentid;?>" target="">
							<!--<button type="button" class="button" id="<?php echo $value->studentid;?>">-->
								<img src="image/stu_head.jpg" class="student_pic">
								<div class="student_info">
	  								
	  									<strong><?php echo $value->studentname; ?></strong>
	  								
	  								<br/>
									<p class="student_id"><?php echo $value->studentid; ?></p>
								</div>
							</a>
							<!--</button>-->
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>

		<div class="studentlist">
	  		<div class="divider">
	  		</div>

			<div class="container inner-container">
				<div class="t">
					博士：
				</div>
				<ul class="list-body">

					<?php foreach ($studentphd as $key => $value): ?>
						<li class="student btn" id="<?php echo $value->studentid;?>">
							<a class="" href="index.php/admin/student/<?php echo $value->studentid;?>" target="">
							<!--<button type="button" class="button" id="<?php echo $value->studentid;?>">-->
								<img src="image/stu_head.jpg" class="student_pic">
								<div class="student_info">
	  								
	  									<strong><?php echo $value->studentname; ?></strong>
	  								
	  								<br/>
									<p class="student_id"><?php echo $value->studentid; ?></p>
								</div>
							</a>
							<!--</button>-->
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<div class="divider">
  			</div>
  		</div>

  			<div id="footer">
		      <div class="container">
		      	<br/>
		        <p class="muted credit">©版权所有 2005-2014 <a href="http://cs.bit.edu.cn/">北京理工大学计算机学院</a></p>
		      </div>
		    </div>
    </div>


	
	<script type="text/javascript">
		$(document).ready(function(){
			/*
			$('#quit').click(function(){
				$.post("<?php echo site_url("teacher/quit")?>");
				return false;
			})
			*/
			$('.list-body > .btn').click(function(){
				//alert(1);
				$this=$(this);
				$this.children()[0].click();
				//window.open("index.php/teacher/detail/1120101828");
				//window.location="index.php/teacher/detail/1120101828";
			})

			$('.list-body a').click(function(e){
				e.stopPropagation();//停止冒泡，防止btn点击两次
			})
		});
	</script>

</body>
