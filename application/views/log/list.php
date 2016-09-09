<div class="panel panel-default">
  <div class="panel-body">
    <div class="row">
      <form action="<?php echo URL::site('log/list'); ?>" method="get">
        <div class="col-md-3 col-md-offset-9">
          <div class="input-group">
            <input class="form-control" name="keywords" type="text" value="<?php echo isset($_GET['keywords']) ? $_GET['keywords'] : ''; ?>" placeholder="日志描述/用户名/ip"/>
            <span class="input-group-btn">
              <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
            </span>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="table-responsive">
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th class="w5p">ID</th>
          <th class="w10p">帐号</th>
          <th class="w40p">描述</th>
          <th class="w10p">IP</th>
          <th class="w15p">时间</th>
        </tr>
      </thead>
      <tbody>
        <?php
          if(is_object($logs)) {
            foreach($logs as $log) {
        ?>
        <tr class="gradeX">
          <td class="center"><?php echo $log->getLogId(); ?></td>
          <td class="center"><?php echo $log->getAccountName(); ?></td>
          <td><?php echo $log->getMessage(); ?></td>
          <td class="center"><?php echo $log->getIp(); ?></td>
          <td class="center"><?php echo date('Y-m-d H:i:s', $log->getCreateTime()); ?></td>
        </tr>
        <?php
          }
        }
        ?>
      </tbody>
    </table>
  </div>
  <div class="panel-footer">
    <div class="row">
      <div class="col-md-8 m-pagination" id="paginator">
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    var pageData = [];
    pageData.push(<?php echo $paginate->pageData();?>);
    Common.paginator("#paginator", pageData);
</script>
