<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<base href="<?php echo base_url()?>" />
	<title>离校管理</title>
	<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/headroom.min.js"></script>
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
	<div class="wrap">
	<div class="navbar navbar-inverse navbar-fixed-top">
      	<div class="navbar-inner">
        	<div class="container">
          		<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            		<span class="icon-bar"></span>
            		<span class="icon-bar"></span>
            		<span class="icon-bar"></span>
          		</button>
          		<a class="brand" href="index.php/admin"><i class="icon-leaf icon-white"></i> 计算机学院 学生离校系统</a>
          		<div class="nav-collapse collapse">
            		<ul class="nav">
              			<li class="active"><a href="index.php/admin">主页</a></li>
              			<!--<li><a href="#about">About</a></li>-->
              			<li><a href="#" id="all">所有学生</a></li>
              			<li><a href="#" id="allleaveok">可离校学生</a></li>
              			<li><a href="#" id="allleave">已离校学生</a></li>
              			<li><a href="#" id="changepsw">修改密码</a></li>
              			<li><a href="<?php echo site_url("admin/quit")?>" id="quit">退出登录</a></li>
            		</ul>
          		</div><!--/.nav-collapse -->
       		</div>
      	</div>
    </div>

    <div class="container">
    	<h2><?php echo $adminname ?> 管理员：</h2>

	    <div class="input-append">
    		<p> </p>
    		<input id="key" type="text" class="span3" placeholder="姓名"> 
        	<button type="button" class="btn btn-primary" id="search_stu">
        		<!--<span class="btn-label"><i class="icon-search"></i></span>-->
        		<i class="icon-white icon-search"></i> 搜索学生
        	</button>
        	<button type="button" class="btn" id="search_tea">
        		<!--<span class="btn-label"><i class="icon-search"></i></span>-->
        		<i class="icon-search"></i> 搜索老师
        	</button>
		</div>
		<div class="search-result">
			</br>
			<p id="result-title"></p>
			<table id="moban" style="display:none">
				<tr id="00000000">
			            <td class="studentid">学号</td>
			            <td class="studentname">姓名</td>
			            <td class="teachername">老师</td>
			            <td class="paperok">
			            	<button name="paperbtn" class="btn btn-labeled btn-success">
		        				<span name="paperlabel" class="btn-label"><i name="papericon" class="icon-white icon-ok"></i></span>
		        				已通过
	        				</button>
			            </td>
			            <td class="projectok">
			            	<button name="projectbtn" class="btn btn-labeled btn-success">
		        				<span name="projectlabel" class="btn-label"><i name="projecticon" class="icon-white icon-ok"></i></span>
		        				已通过
	        				</button>
			            </td>
			            <td class="leaveok">
			            	<button name="leavebtn" class="btn btn-labeled btn-primary">
		        				<span name="leavelabel" class="btn-label"><i name="leaveicon" class="icon-white icon-thumbs-up"></i></span>
		        				同意离校
	        				</button>
			            </td>
			        </tr>
			</table>

			<table class="table table-striped tablesorter" id="table">
		        <thead>
		          <tr>
		            <th class="header"> &nbsp;&nbsp;&nbsp;学号 </th>
		            <th class="header"> &nbsp;&nbsp;&nbsp;姓名 </th>
		            <th class="header"> &nbsp;&nbsp;&nbsp;老师 </th>
		            <th class="header"> &nbsp;&nbsp;&nbsp;论文是否已经通过 </th>
		            <th class="header"> &nbsp;&nbsp;&nbsp;项目是否已经交接 </th>
		            <th class="header"> &nbsp;&nbsp;&nbsp;是否同意离校 </th>
		          </tr>
		        </thead>
		        <tbody id="table-main">
			        
		      	</tbody>
	    	</table>
		</div>
    </div>
</div>
	<!--
    <div id="footer">
      <div class="container">
        <p class="muted credit">©版权所有 2005-2014 <a href="http://cs.bit.edu.cn/">北京理工大学计算机学院</a></p>
      </div>
    </div>
-->

	
	<script type="text/javascript">
		$(document).ready(function(){
			
			$("#table").tablesorter();
			$('#table').hide();

			var str='，您可以在搜索栏里直接输入姓名或学号进行快速定位。';
			var hasData = false;

			/*
			//让quit直接跳转到 /quit
			$('#quit').click(function(){
				$.post("<?php echo site_url("admin/quit")?>");
			});
			*/

			$('#search_stu').click(function(){
				var key=$('#key').val();
				$.post("<?php echo site_url("admin/search")?>",{type: 'student', key: key},function(d){
					d=eval('('+d+')');
					//alert(d);
					//console.log(d);
					//$('#result-title').attr('text','123123123');
					$('#result-title').text(' 查找到 '+d.length+' 个姓名中包含 '+key+' 的学生 ');

					addtotable(d);
				});
			})

			$('#search_tea').click(function(){
				var key=$('#key').val();
				$.post("<?php echo site_url("admin/search")?>", {type: 'teacher', key: key}, function(d){
					d=eval('('+d+')');
					//alert(d);
					//console.log(d);
					$('#result-title').text(' 查找到 '+d.length+' 个老师姓名中包含 '+key+' 的学生 ');
					addtotable(d);
				});
			})

			function addtotable(data){
				if(data.length){
					$('#table').show();
					$('#key').attr({'placeholder':'搜索 快速定位'});
					$('#result-title').text($('#result-title').text()+str);
					hasData = true;
				}
				else{
					$('#table').hide();
					$('#key').attr({'placeholder':'搜索'});
					hasData = false;
				}

				var firstTr=$('#00000000');	
				//var firstTr=$('#table-main tr:eq(0)');//加入排序之后模版行已经不是第一行了，写代码不能偷懒啊T^T
				//firstTr.hide();	//隐藏模版行  //模版行被移到单独的table中

				//$("#table-main tr:not([id='00000000'])").remove(); //移除现有行，保留模版行
				$("#table-main tr").remove();	//表中已经没有模版行了
				//$("#table").trigger("update"); //变更的最后更新一次就行了

				//alert(data);
				for(var i=0;i<data.length;i++){
					var newTr=firstTr.clone(true);
					newTr[0].id=data[i].studentid;
					newTr.find('.studentid').text(data[i].studentid);
					newTr.find('.studentname').text(data[i].studentname);
					newTr.find('.teachername').text(data[i].teachername);
					if(data[i].leaveok == 1){
						//已同意过离校。
						var span=newTr.find("[name=leavelabel]");
						var btn=newTr.find("[name=leavebtn]");
						var icon=newTr.find("[name=leaveicon]");

						btn.removeClass('btn-primary').addClass('btn-info');
						icon.removeClass('icon-thumbs-up').addClass('icon-off');
						btn.text(' 已同意离校 ');
						btn.prepend(span);
					}
					//else //就算同意离校也有可能论文和项目未通过
					{	

						//论文列
						var span=newTr.find("[name=paperlabel]");
						var btn=newTr.find("[name=paperbtn]");
						var icon=newTr.find("[name=papericon]");

						if(data[i].paperok == 0){				
							btn.removeClass('btn-success').addClass('btn-danger');
							icon.removeClass('icon-ok').addClass('icon-remove');
							btn.text(' 未通过 ');
							btn.prepend(span);
						}
						else{				
							btn.removeClass('btn-danger').addClass('btn-success');
							icon.removeClass('icon-remove').addClass('icon-ok');
							btn.text(' 已通过 ');
							btn.prepend(span);
						}

						//项目列

						var span=newTr.find("[name=projectlabel]");
						var btn=newTr.find("[name=projectbtn]");
						var icon=newTr.find("[name=projecticon]");

						if(data[i].projectok == 0){				
							btn.removeClass('btn-success').addClass('btn-danger');
							icon.removeClass('icon-ok').addClass('icon-remove');
							btn.text(' 未通过 ');
							btn.prepend(span);
						}
						else{				
							btn.removeClass('btn-danger').addClass('btn-success');
							icon.removeClass('icon-remove').addClass('icon-ok');
							btn.text(' 已通过 ');
							btn.prepend(span);
						}
					}
					$('#table-main').append(newTr);
					newTr.show();
				}
				$("#table").trigger("update");
				
				setTimeout(function(){ //not working
					var sorting = [[0,0]];
					$("#table").trigger("sorton",[sorting]);
				},3)
				
			}

			$('[name=leavebtn]').click(function(){
				var $this=$(this);
				if($this.hasClass('btn-info')){
					//alert(1);
					//已同意离校
				}
				else{
					var span=$this.find("[name=leavelabel]");
					var icon=$this.find("[name=leaveicon]");

					$this.removeClass('btn-primary').addClass('btn-info');
					icon.removeClass('icon-thumbs-up').addClass('icon-off');
					$this.text(' 已同意离校 ');
					$this.prepend(span);

					var studentid=$this.parent().parent()[0].id;
					//alert(studentid);
					$.post("<?php echo site_url("admin/agreetoleave")?>",{studentid: studentid});
					$("table").trigger('update');

				}
			});

			$('#all').click(function(event){
				$.post("<?php echo site_url("admin/search")?>", {type: 'all', key: ''}, function(d){
					d=eval('('+d+')');
					//alert(d);
					//console.log(d);
					$('#result-title').text(' 查找到 '+d.length+' 个学生 ');
					addtotable(d);
				});
				//return false;
				event.preventDefault();
			})

			$('#allleaveok').click(function(event){
				$.post("<?php echo site_url("admin/search")?>", {type: 'leaveok', key: ''}, function(d){
					d=eval('('+d+')');
					//alert(d);
					//console.log(d);
					$('#result-title').text(' 查找到 '+d.length+' 个可以离校的学生 ');
					addtotable(d);
				});
				event.preventDefault();
				//return false;
			})

			$('#allleave').click(function(event){
				$.post("<?php echo site_url("admin/search")?>", {type: 'allleave', key: ''}, function(d){
					d=eval('('+d+')');
					//alert(d);
					//console.log(d);
					$('#result-title').text(' 查找到 '+d.length+' 个已经离校的学生 ');
					addtotable(d);
				});
				event.preventDefault();
				//return false;
			})

			//快速定位
			//先不在管理员界面加入了，因为没搜索学生和已搜索学生但是跟快速匹配栏里不符合的时候很让人疑惑
			//撤销上句
			$('#key').on('input propertychange', function() {
				/*
				if($('#table').is(':hidden')){
					return false;
				}
				*/
				if(!hasData)
					return false;
				var key=$('#key').val();
				//if (!key)
				//	key='';
				key=key.replace(' ','');


				$('#table-main tr').each(function(){
					
					var $this=$(this);
					var id=$this.children()[0].innerText;
					var name=$this.children()[1].innerText;
					if (id.indexOf(key) == -1 && name.indexOf(key) == -1) {
						$this.hide();
					}
					else{
						$this.show();
					}
				})
			});
			

		});
	</script>

</body>
