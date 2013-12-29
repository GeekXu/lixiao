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
	<link rel="stylesheet" type="text/css" href="css/all.css"/>
</head>
<body>
	<header>
		<img class="headlogo" src="img/logo.png"/>
		<div class="navbar">
	      	<div class="navbar-inner">
          		<div class="nav-collapse collapse">
            		<ul class="nav">
              			<li class="active"><a href="index.php/teacher"><i class="icon-home "></i> 主页</a></li>
              			<li><a href="index.php/teacher/statistics"><i class="icon-list "></i> 离校情况统计</a></li>
              			<li><a href="index.php/teacher/changepsw" id="changepsw"><i class="icon-wrench "></i> 修改密码</a></li>
              			<li><a href="<?php echo site_url("teacher/quit")?>" id="quit"><i class="icon-off "></i> 退出登录</a></li>
            		</ul>
          		</div>
	      	</div>
	    </div>
	</header>

    <div class="container main-container">
    	<div class="personal_info">
			<div class="row-fluid">
				<div class="span2">
					<img class="photo" src="image/stu_head4.jpg">
				</div>

				<div class="span9 student_info_card">
					<legend><h3>姓名：<?php echo $studentdetail->studentname ?></h3></legend>
					<ul class="studentinfolist">
						<li class="studentinfo">
							<span><p>学号：<?php echo $studentdetail->studentid ?></p></span>
						</li>
						<li class="studentinfo">
							<span><p>班级：<?php echo $studentdetail->class ?> 班</p></span>
						</li>
						<li class="studentinfo">
							<span><p>性别：<?php echo $studentdetail->sex ?></p></span>
						</li>
						<li class="studentinfo">
							<span><p>民族：<?php echo $studentdetail->minzu ?></p></span>
						</li>
						<li class="studentinfo">
							<span><p>研究生类：<?php echo $studentdetail->studentdegree ?></p></span>
						</li>
						<li class="studentinfo">
							<span><p>录取专业：<?php echo $studentdetail->admitmajor ?></p></span>
						</li>
						<li class="studentinfo">
							<span><p>录取类别：<?php echo $studentdetail->admittype ?></p></span>
						</li>
						<li class="studentinfo">
							<span><p>学制：<?php echo $studentdetail->xuezhi ?></p></span>
						</li>
						<li id="uid" style="display:none;">
							<?php echo $studentdetail->studentid ?>
						</li>
					</ul>
				</div>
			</div>
  		</div>

  		<div class="divider"></div>
  		<div class="status">
  			<table id="table-main" class="table">
  				<thead>
  					<tr>

  						<th class="header"> 毕设</th>
  						<th class="header"> 实验室</th>
  						<th class="header"> 科研</th>
  						<th class="header"> 学院意见</th>
  					</tr>
  				</thead>
  				<tbody>
  					<tr>

  						<td>
  							<button id="bisheok" name="status-btn" class="btn 
  							<?php 
  								if($studentdetail->bisheok)
  									echo "btn-success";
  								else
  									echo "btn-danger";
  							?>
  							">
  							<?php 
  								if($studentdetail->bisheok)
  									echo "已通过";
  								else
  									echo "未通过";
  							?>
  							</button>
  						</td>
  						<td>
  							<button id="projectok" name="status-btn" class="btn 
							<?php 
								if($studentdetail->projectok)
									echo "btn-success";
								else
									echo "btn-danger";
  							?>
  							">
  							<?php 
  								if($studentdetail->projectok)
  									echo "已通过";
  								else
  									echo "未通过";
  							?>
  							</button>
  						</td>
  						<td>
  							<button id="paperok" name="status-btn" class="btn 
  							<?php 
  								if($studentdetail->paperok)
  									echo "btn-success";
  								else
  									echo "btn-danger";
  							?>
  							">
  							<?php 
  								if($studentdetail->paperok)
  									echo "已通过";
  								else
  									echo "未通过";
  							?>
  							</button>
  						</td>
  						<td>
  							<button id="leaveok" name="status-btn" class="btn 
  							<?php 
  								if($studentdetail->leaveok)
  									echo "btn-success";
  								else
  									echo "btn-danger";
  							?>
  							" disabled>
  							<?php 
  								if($studentdetail->leaveok)
  									echo "已通过";
  								else
  									echo "未通过";
  							?>
  							</button>
  						</td>

  					</tr>
				</tbody>
  			</table>
  			<div class="submit container">
  					<button id="return" class="btn">返回</button>
  					<button id="modify" class="btn btn-primary">提交</button>
  			</div>
  		</div>
  		<div class="divider"></div>

  		<div id="footer">
		    <div class="container">
		      	<br/>
		        <p class="muted credit">
		        	©版权所有 2005-2014 
		        	<a href="http://cs.bit.edu.cn/">北京理工大学计算机学院</a>
		        </p>
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

			$('td > button').click(function(){
				$this=$(this);
				if ($this.hasClass('btn-danger')) {
					$this.removeClass('btn-danger').addClass('btn-success');
					$this.text('已通过');
				}
				else if($this.hasClass('btn-success')){
					$this.removeClass('btn-success').addClass('btn-danger');
					$this.text('未通过');
				}
			})

			$('#return').click(function(){
				window.location="index.php/teacher";
			})

			$('#modify').click(function(){
				var paperok,projectok,bisheok,uid;
				paperok=$('#paperok').hasClass('btn-success');
				projectok=$('#projectok').hasClass('btn-success');
				bisheok=$('#bisheok').hasClass('btn-success');
				uid=$('#uid').text();

				$.post("index.php/teacher/modify", 
					{paperok: paperok, projectok: projectok, bisheok: bisheok, uid: uid}, 
					function(d){
						d=eval('('+d+')');
						if(d.status === undefined)
							d=eval('('+d+')');
						
						//alert(d);
						if (d.status==-1) {
							alert('提交失败，该学生不在您的实验室，请检查。');
							return;
						}
						else if (d.status==0) {
							alert('未知原因失败，请重试，如果重复出现此条信息请联系管理员。');
						}
						else if(d.status==1){
							window.location="index.php/teacher";
						}
						else{
							alert('未知原因失败，请重试，如果重复出现此条信息请联系管理员。');
							return;
						}
				});
			})
		});
	</script>

</body>
