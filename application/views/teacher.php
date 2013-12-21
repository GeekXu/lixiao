<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<base href="<?php echo base_url()?>" />
	<title>离校管理</title>
	<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
	<!--
	<script type="text/javascript" src="js/bootstrap-select.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-tooltip.min.js"></script>
	-->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="css/tablesorter.css"/>
	<link rel="stylesheet" type="text/css" href="css/login.css"/>
</head>
<body>
	<div class="navbar navbar-inverse navbar-fixed-top">
      	<div class="navbar-inner">
        	<div class="container">
          		<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            		<span class="icon-bar"></span>
            		<span class="icon-bar"></span>
            		<span class="icon-bar"></span>
          		</button>
          		<a class="brand" href="index.php/teacher"><i class="icon-leaf icon-white"></i> 计算机学院 学生离校系统</a>
          		<div class="nav-collapse collapse">
            		<ul class="nav">
              			<li class="active"><a href="index.php/teacher">主页</a></li>
              			<!--<li><a href="#about">About</a></li>-->
              			<li><a href id="changepsw">修改密码</a></li>
              			<li><a href="<?php echo site_url("teacher/quit")?>" id="quit">退出登录</a></li>
            		</ul>
          		</div><!--/.nav-collapse -->
       		</div>
      	</div>
    </div>

    <div class="container">
    	<h2><?php echo $teachername ?> 老师，您目前共有 <?php echo count($students);?> 名在校的学生</h2>

    	<div class="input-append">
    		<p> </p>
    		<input id="key" type="text" class="span4" placeholder="快速定位"> 
    		<span class="add-on"><i class="icon-search"></i></input></span>
        	<p> </p>
		</div>

    	<table class="table table-striped tablesorter" id="table">
	        <thead>
	          <tr>
	            <th class="header">&nbsp;&nbsp;&nbsp;学号</th>
	            <th class="header">&nbsp;&nbsp;&nbsp;姓名</th>
	            <th class="header">&nbsp;&nbsp;&nbsp;论文是否通过</th>
	            <th class="header">&nbsp;&nbsp;&nbsp;项目是否交接</th>
	          </tr>
	        </thead>
	        <tbody>
	        	<?php foreach ($students as $key => $value): ?>
	        	<tr>
	        		<td><?php echo $value->studentid?></td>
	        		<td><?php echo $value->studentname?></td>
	        		<td>
	        			<button name="paperbtn" class="btn btn-labeled <?php if($value->paperok == 0) echo 'btn-danger';else echo 'btn-success'?>">
	        				<span class="btn-label"><i class="icon-white <?php if($value->paperok == 0) echo 'icon-remove';else echo 'icon-ok'?>"></i></span>
	        			<?php if($value->paperok == 0) echo '未通过';else echo '已通过'?>
	        			</button>
	        		</td>
	        		<td>
	        			<button name="projectbtn" class="btn btn-labeled <?php if($value->projectok == 0) echo 'btn-danger';else echo 'btn-success'?>">
	        				<span class="btn-label"><i class="icon-white <?php if($value->projectok == 0) echo 'icon-remove';else echo 'icon-ok'?>"></i></span>
	        			<?php if($value->projectok == 0) echo'未通过';else echo'已通过';?>
	        			</button>
	        		</td>
	        		
	        	</tr>
	        	<?php endforeach; ?>
	        </tbody>
      </table>
    </div>

	
	<script type="text/javascript">
		$(document).ready(function(){

			$("#table").tablesorter({
        		sortList: [[0,0]]
    		});

			/*
			$('#quit').click(function(){
				$.post("<?php echo site_url("teacher/quit")?>");
				return false;
			})
			*/
			
			$('button').click(function(){
				var changeto;
				var changetype;
				if($(this).hasClass('btn-success')){
					//现在状态是已通过
					$(this).removeClass('btn-success');
					$(this).addClass('btn-danger');
					var icon=$(this).children()[0].childNodes[0];
					var $icon=$(icon);
					var $span=$icon.parent();
					$icon.removeClass('icon-ok');
					$icon.addClass('icon-remove');
					//$(this).attr("text",'未通过');
					$(this).text('  未通过  ');
					$(this).prepend($span);

					changeto=0;
				}
				else if($(this).hasClass('btn-danger')){
					$(this).removeClass('btn-danger');
					$(this).addClass('btn-success');
					var icon=$(this).children()[0].childNodes[0];
					var $icon=$(icon);
					var $span=$icon.parent();
					$icon.removeClass('icon-remove');
					$icon.addClass('icon-ok');
					//$(this).attr('text','已通过');
					$(this).text('  已通过  ');
					$(this).prepend($span);
					changeto=1;
				}
				else
					return;

				if($(this).attr('name')=='paperbtn')
					changetype='paperok';
				else
					changetype='projectok';

				var uid=$(this).parent().parent().children()[0].innerText;

				$.post("<?php echo site_url("teacher/modify")?>", 
					{changetype: changetype, changeto: changeto, studentid: uid}, 
					function(d){
					//d=eval('('+d+')');
					//alert(d);
				});
				$("#table").trigger('update');
			});
			
			//快速定位
			
			$('#key').on('input propertychange', function() {
				//alert(1);

				var key=$('#key').val();
				//if (!key) 
				//	key='';
				key=key.replace(' ','');
				
				//console.log(key);
				$('tbody tr').each(function(){
					var $this=$(this);
					var id=$this.children()[0].innerText;
					var name=$this.children()[1].innerText;
					if (id.indexOf(key) == -1 && name.indexOf(key) == -1)
						$this.hide();
					else
						$this.show();
				})
			});

		});
	</script>

</body>
