<div class="panel panel-default">
  <div class="panel-body">
    <div class="row">
    </div>
  </div>
  <div class="table-responsive">
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th class="w8p">ID</th>
          <th class="w8p">Level</th>
          <th class="w40p">Message</th>
          <th class="w9p">Url_id</th>
          <th class="w8p">Video_id</th>
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
          <td class="center"><?php echo $log->getVideoId(); ?></td>
          <td class="center"><?php echo $log->getCreateTime('Y-m-d H:i'); ?></td>
        </tr>
        <tr class="collapse" id="<?php echo $log->getLogVideoId();?>">
          <td colspan="6">
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
<!--      <div class="col-md-8 m-pagination" id="paginator">-->
<!--      </div>-->
    </div>
  </div>
</div>
<script type="text/javascript">
//    var pageData = [];
//    pageData.push(<?php //echo $paginate->pageData();?>//);
//    Common.paginator("#paginator", pageData);
</script>
