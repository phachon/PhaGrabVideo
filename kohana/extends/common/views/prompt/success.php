<!DOCTYPE html>
<html class="login-bg">
<head>
    <title>Pha Grab Video</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="/resource/css/bootstrap.css" rel="stylesheet" />
    <link href="/resource/css/bootstrap-theme.min.css" rel="stylesheet"/>
</head>
<body>
<br/><br/><br/><br/><br/>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="col-md-4 col-md-offset-4">
      <div class="panel panel-default">
        <div class="panel-body center">
          <h3 align="center"><?php echo $message; ?></h3>
          <hr/>
          <div align="center">
            <a class="btn btn-success btn-big"  href="<?php echo $redirect; ?>"> 返回>> </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">setTimeout('(function(uri) {location.href = uri;})("<?php echo $redirect; ?>")', <?php echo $timeout * 1000; ?>);</script>
</body>
</html>