<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Pha Video Grab</title>
	<link href="/resource/css/bootstrap.min.css" rel="stylesheet">
	<link href="/resource/css/bootstrap-theme.min.css" rel="stylesheet">
	<link href="/resource/css/plugins/sweetalert.css" rel="stylesheet">
	<link href="/resource/css/login.css" rel="stylesheet">

	<script src="/resource/js/plugins/jquery/jquery.js"></script>
	<script src="/resource/js/plugins/bootstrap/bootstrap.min.js"></script>
	<script src="/resource/js/plugins/jquery/jquery.form.js"></script>
	<script src="/resource/js/plugins/sweetalert/sweetalert.min.js"></script>
	<script src="/resource/js/module/login.js"></script>

</head>
<body>
<div class="login">
	<h1><strong>Pha Grab Video</strong></h1>
	<br>
	<form method="post" class="form-horizontal" action="<?php echo URL::site('author/login');?>" onsubmit="return false">
		<div class="form-group">
			<div class="col-md-12">
				<input class="form-control" type="text" name="name" value="" placeholder="用户名" required="required"/>
			</div>
			<div class="col-md-12">
				<input class="form-control" type="password" name="password" value="" placeholder="密码" required="required"/>
			</div>
		</div>
		<button type="submit" class="btn btn-primary btn-block btn-large" onclick="Login.ajaxSubmit(this.form)">登录</button>
	</form>
	<div style="margin-top: 80px">
		<div class="text-center" style="font-size: 11px;color: #949CAF; font-family: Arial;">&copy; 2016 phachon@163.com
		</div>
		<div class="text-center" style="font-size: 12px;color: #949CAF;">请使用Firefox, Chrome, IE9+浏览器达到更好效果</div>
	</div>
</div>
</body>
</html>
