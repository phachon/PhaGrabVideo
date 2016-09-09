<div class="panel panel-default">
	<div class="panel-body">
		<div class="row">
			<form action="<?php echo URL::site('video/list'); ?>" method="get">
				<div class="col-md-9">
					<div class="input-group">
					</div>
				</div>
				<div class="col-md-3">
					<div class="input-group">
						<input class="form-control" name="url" type="text" value="<?php echo isset($_GET['url']) ? $_GET['url'] : ''; ?>" placeholder="URL/video_id"/>
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
				<th class="center w8p">ID</th>
				<th class="center w10p">video_id</th>
				<th class="center w40p">标题</th>
				<th class="center w8p">url_id</th>
				<th class="center">状态</th>
				<th class="center w10p">创建时间</th>
				<th class="center">操作</th>
			</tr>
			</thead>
			<tbody>
			<?php if($videos->count() > 0) {
				foreach ($videos as $video) { ?>
					<tr>
						<td class="center"><?php echo $video->getGrabVideoId();?></td>
						<td class="center"><?php echo $video->getVideoId();?></td>
						<td class="center"><?php echo $video->getTitle();?></td>
						<td class="center"><?php echo $video->getUrlId();?></td>
						<td class="center"><?php echo $video->getStatus();?></td>
						<td class="center"><?php echo $video->getCreateTime('Y-m-d H:i');?></td>
						<td class="center">
							<?php if($video->status == Model_Video::STATUS_UPLOAD_FAILED) { ?>
								<a name="agin" onclick="Common.confirm('确定要重新上传？', '<?php echo URL::site('video/again?grab_video_id='. $video->getGrabVideoId());?>')"><i class="glyphicon glyphicon-share-alt"> </i>重新上传</a>
							<?php }?>
							<?php if($video->status == Model_Video::STATUS_UPLOAD_DEFAULT) {?>
								<a name="delete" onclick="Common.confirm('确定要删除？', '<?php echo URL::site('video/delete?grab_video_id='. $video->getGrabVideoId());?>')" data-link="#" ><i class="glyphicon glyphicon-remove"> </i>删除</a>
							<?php }?>
							<a name="log" data-link="<?php echo URL::site('video/log?grab_video_id='. $video->getGrabVideoId());?>"><i class="glyphicon glyphicon-list-alt"> </i>日志</a>
						</td>
					</tr>
				<?php }} ?>
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
	Popup.bindIframe('[name="log"]', '上传日志信息');
	var pageData = [];
	pageData.push(<?php echo $paginate->pageData();?>);
	Common.paginator("#paginator", pageData);
</script>