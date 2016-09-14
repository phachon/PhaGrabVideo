<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Gome+ Video Grab</title>
	<link rel="stylesheet" href="/resource/css/base.css"/>
	<link rel="stylesheet" href="/resource/css/common.css"/>
	<link rel="stylesheet" href="/resource/css/bootstrap-theme.min.css"/>
<!--	<script type="text/javascript" src="/resource/js/plugins/markdown/MathJax.js?config=TeX-AMS_HTML"></script>-->
</head>
<style type="text/css">
	.container {
		height: 500px;
	}
</style>
<body>
<div class="container">
	<h1 id="gome-video-grab-视频抓站系统">PhaGrabVideo 多用户视频下载系统</h1>
	<ul>
		<li>You-get 工具</li>
		<li>视频管理</li>
	</ul>
	<hr>
	<h2 id="使用">使用</h2>
	<ol>
		<li>添加：进入后台后，点击 》URL管理 》添加URL,将需要抓取的视频填写到对应的表单，最好添加网站来源范围内的视频链接，否则可能会抓取失败。每次最多添加5个url。</li>
		<li>下载：查看 URL 列表是否添加成功，后台定时任务会扫描到该条信息并下载，如果下载失败，可选择重新下载。可查看详细的下载日志。</li>
	</ol>
	<h2 id="you-get-工具">you-get 工具</h2>
	<p>下载采用 you-get 开源 python 脚本</p>
	<ol>
		<li> 官网地址：<a href="https://you-get.org/">https://you-get.org/</a></li>
		<li> github地址：<a href="https://github.com/soimort/you-get/">https://github.com/soimort/you-get/</a></li>
		<li> 中文说明： <br>
			<a href="https://github.com/soimort/you-get/wiki/%E4%B8%AD%E6%96%87%E8%AF%B4%E6%98%8E">https://github.com/soimort/you-get/wiki/%E4%B8%AD%E6%96%87%E8%AF%B4%E6%98%8E</a>
		</li>
	</ol>
	<hr>
	<p>Thanks.<br>© phachon@163.com  2016</p>
</div>
</body>
</html>