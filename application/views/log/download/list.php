<div class="panel panel-default">
  <div class="panel-body">
    <div class="row">
      <form action="<?php echo URL::site('log_video/list'); ?>" method="get">
        <div class="col-md-6">
          <div class="input-group">
          </div>
        </div>
        <div class="col-md-3">
          <div class="input-group">
            <span class="input-group-addon">搜索</span>
            <select class="form-control" name="search_type">
              <option value="">全部</option>
              <option value="url_id" <?php echo isset($_GET['search_type']) && ($_GET['search_type'] == 'url_id') ? 'selected' : '';?>>url_id </option>
            </select>
          </div>
        </div>
        <div class="col-md-3">
          <div class="input-group">
            <input class="form-control" name="keyword" type="text" value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>" placeholder="url_id"/>
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
          <th class="w8p">ID</th>
          <th class="w10p">Level</th>
          <th class="w40p">Message</th>
          <th class="w8p">Url_id</th>
          <th class="w10p">Time</th>
        </tr>
      </thead>
      <tbody>
        <?php
          if(isset($logs) && is_object($logs)) {
            foreach($logs as $log) {
        ?>
        <tr class="gradeX">
          <td class="center"><?php echo $log->getLogVideoId(); ?></td>
          <td class="center"><?php echo $log->getLevel(); ?></td>
          <td>
            <a data-toggle="collapse" data-target="#<?php echo $log->getLogVideoId();?>"><?php echo $log->getMessage(); ?></a>
          </td>
          <td class="center"><?php echo $log->getUrlId(); ?></td>
          <td class="center"><?php echo $log->getCreateTime('Y-m-d H:i'); ?></td>
        </tr>
        <tr class="collapse" id="<?php echo $log->getLogVideoId();?>">
          <td colspan="7">
            <div class="well well-sm" style="margin-bottom:0">
              <label>
              <?php
              $data = json_decode($log->getExtra(), true);
              if($data === null) {
                echo $log->getExtra();
              }else {
                var_dump($data);
              }
              ?>
              </label>
            </div>
          </td>
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
