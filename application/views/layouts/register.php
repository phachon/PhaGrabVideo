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
	<link href="/resource/css/register.css" rel="stylesheet">

	<script src="/resource/js/plugins/jquery/jquery.js"></script>
	<script src="/resource/js/plugins/bootstrap/bootstrap.min.js"></script>
	<script src="/resource/js/plugins/jquery/jquery.form.js"></script>
	<script src="/resource/js/plugins/sweetalert/sweetalert.min.js"></script>
	<script src="/resource/js/module/register.js"></script>

</head>
<body>
<div class="register">
	<h1><strong>欢迎注册</strong></h1>
	<div id="failedMessage" class="alert alert-danger" style="display: none" role="alert">
		<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		<strong>失败：</strong><label></label>
	</div>
	<form method="post" class="form-horizontal" action="<?php echo URL::site('author/save');?>" onsubmit="return false">
		<div class="form-group">
			<div class="input-group col-md-12">
				<input class="form-control" type="text" name="name" value="" placeholder="用户名" required="required"/>
				<div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
			</div>
		</div>
		<div class="form-group">
			<div class="input-group col-md-12">
				<input class="form-control" type="text" name="given_name" value="" placeholder="姓名" required="required"/>
				<div class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></div>
			</div>
		</div>
		<div class="form-group">
			<div class="input-group col-md-12">
				<input class="form-control" type="text" name="email" value="" placeholder="邮箱" required="required"/>
				<div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
			</div>
		</div>
		<div class="form-group">
			<div class="input-group col-md-12">
				<input class="form-control" type="text" name="mobile" value="" placeholder="电话" required="required"/>
				<div class="input-group-addon"><span class="glyphicon glyphicon-earphone"></span></div>
			</div>
		</div>
		<div class="form-group">
			<div class="input-group col-md-12">
				<input class="form-control" type="password" name="password" value="" placeholder="密码" required="required"/>
				<div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
			</div>
		</div>
		<div class="form-group">
			<div class="input-group col-md-12">
				<input class="form-control" type="password" name="repass" value="" placeholder="确认密码" required="required"/>
				<div class="input-group-addon"><span class="glyphicon glyphicon-ok"></span></div>
			</div>
		</div>
		<div class="form-group row">
			<div class="input-group col-md-7" style="float: left">
				<input class="form-control" type="text" name="captcha" value="" placeholder="验证码" required="required"/>
				<div class="input-group-addon"><span class="glyphicon glyphicon-question-sign"></span></div>
			</div>
			<label style="width:40px;height:30px;margin-left:30px">
				<a href="javascript:;">
					<img src="<?php echo URL::site('author/captcha');?>" onclick=this.src="<?php echo URL::site('author/captcha?n=');?>"+Math.random() style="display:inline"/>
				</a>
			</label>
		</div>
		<br>
		<button type="submit" class="btn btn-primary btn-block btn-large" onclick="Register.ajaxSubmit(this.form)">提交注册</button>
	</form>
	<div style="margin-top: 20px">
		<p class="text-center" style="font-size: 13px;color: #3d61af; font-family: Arial;"><a href="<?php echo URL::site('author/index')?>">已有账号？》》点击登录</a></p>
	</div>
	<div style="margin-top: 20px">
		<div class="text-center" style="font-size: 11px;color: #949CAF; font-family: Arial;">&copy; 2016 phachon@163.com</div>
		<div class="text-center" style="font-size: 12px;color: #949CAF;">请使用Firefox, Chrome, IE9+浏览器达到更好效果</div>
	</div>
</div>
</body>
</html>
