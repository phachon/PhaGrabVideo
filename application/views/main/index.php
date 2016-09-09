<div id="wrapper">
	<!-- Navigation -->
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar">Toggle navigation</span>
				<span class="icon-bar">Toggle navigation</span>
				<span class="icon-bar">Toggle navigation</span>
			</button>
			<a class="navbar-brand" href="javascript:;">Pha Grab Video
				<lable style="font-style: italic">V1.0</lable>
			</a>
		</div>
		<!-- Top Menu Items -->
		<ul class="nav navbar-right top-nav">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo Author::givenName();?> <b
						class="caret"></b></a>
				<ul class="dropdown-menu">
					<li>
						<a href="<?php echo URL::site('profile/info');?>" target="menuFrame"><i class="fa fa-fw fa-user"></i> 个人信息 </a>
					</li>
					<li>
						<a href="#"><i class="fa fa-fw fa-gear"></i> 设置 </a>
					</li>
					<li class="divider"></li>
					<li>
						<a href="<?php echo URL::site('author/logout')?>"><i class="fa fa-fw fa-power-off"></i> 退出 </a>
					</li>
				</ul>
			</li>
		</ul>
		<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav side-nav" id="MenuBox">
				<br>
				<?php if($menus) {
					foreach ($menus as $key => $values) { ?>
				<li data-navigator='<?php echo $key;?>'>
					<a href="javascript:;" data-toggle="collapse" data-target="#<?php echo $key;?>"><span class="<?php echo $values['icon'];?>"> <?php echo $values['name'];?> </span></a>
						<?php if($values['submenu']) { ?>
						<ul id="<?php echo $key;?>" class="collapse">
						<?php foreach ($values['submenu'] as $submenu) { ?>
							<li>
								<a href="<?php echo URL::site($submenu['href']);?>" target="menuFrame"><span class="<?php echo $submenu['icon'];?>"></span><span class="text"> <?php echo $submenu['name']?> </span></a>
							</li>
						<?php }
						echo "</ul>";
						}
						?>
					<?php echo "</li>";
					}
				}?>
			</ul>
		</div>
		<!-- /.navbar-collapse -->
	</nav>
	<div id="page-wrapper">
		<div class="container-fluid">
			<div class="route_bg">
				<a href="javascript:void(0)">主页</a><span class="glyphicon glyphicon-chevron-right"></span>
				<a href="javascript:void(0)">菜单管理</a>
			</div>
			<div class="mian_content">
				<div id="page_content">
					<iframe id="menuFrame" name="menuFrame" src="<?php echo URL::site('profile/index')?>" scrolling="yes" style="overflow-y:auto;"
					        frameborder="yes" width="100%" height="100%"></iframe>
				</div>
			</div>
		</div>
		<!-- /.container-fluid -->
	</div>
	<!-- /#page-wrapper -->
</div>
<script type="text/javascript">
	//var menus = <?php //echo json_encode($menus);?>
</script>