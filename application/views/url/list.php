<div class="panel panel-default">
	<div class="panel-body">
		<div class="row">
			<form action="<?php echo URL::site('url/list'); ?>" method="get">
				<div class="col-md-4">
					<div class="input-group">
					</div>
				</div>
				<div class="col-md-3">
					<div class="input-group">
						<span class="input-group-addon">URL来源</span>
						<select class="form-control" name="website_id">
							<option value="">全部</option>
							<?php if(isset($websites)) {
								foreach ($websites as $website) { ?>
									<option value="<?php echo $website->getWebsiteId();?>" <?php echo isset($_GET['website_id']) && $_GET['website_id'] == $website->getWebsiteId() ? "selected" : '';?>><?php echo $website->getName();?>
							<?php }
							}?>
						</select>
					</div>
				</div>
				<div class="col-md-2">
					<div class="input-group">
						<span class="input-group-addon">状态</span>
						<select class="form-control" name="status">
								<option value="">全部</option>
								<option value="1" <?php echo isset($_GET['status']) && $_GET['status'] == '1' ? "selected" : '';?>>已抓取
								<option value="0" <?php echo isset($_GET['status']) && $_GET['status'] == '0' ? "selected" : '';?>>待抓取
								<option value="2" <?php echo isset($_GET['status']) && $_GET['status'] == '2' ? "selected" : '';?>>抓取失败
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="input-group">
						<input class="form-control" name="url" type="text" value="<?php echo isset($_GET['url']) ? $_GET['url'] : ''; ?>" placeholder="URL"/>
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
				<th class="center w6p">ID</th>
				<th class="center w50p">URL</th>
				<th class="center w10p">URL来源</th>
				<th class="center w10p">账号</th>
				<th class="center w8p">状态</th>
				<th class="center w8p">创建时间</th>
				<th class="center">操作</th>
			</tr>
			</thead>
			<tbody>
			<?php if($urls->count() > 0) {
				foreach ($urls as $url) { ?>
					<tr>
						<td class="center"><?php echo $url->getUrlId();?></td>
						<td class="center"><?php echo $url->getUrl();?></td>
						<td class="center"><?php echo $url->getWebsite();?></td>
						<td class="center"><?php echo $url->getAccountName();?></td>
						<td class="center"><?php echo $url->getStatus();?></td>
						<td class="center"><?php echo $url->getCreateTime('Y-m-d H:i');?></td>
						<td class="center">
							<?php if($url->status == Model_Url::STATUS_FAILED) { ?>
								<a name="agin" onclick="Common.confirm('确定要重新抓取？', '<?php echo URL::site('url/again?url_id='. $url->getUrlId());?>')"><i class="glyphicon glyphicon-share-alt"> </i>重新抓取</a>
							<?php }?>
							<?php if($url->status == Model_Url::STATUS_DEFAULT) {?>
								<a name="delete" onclick="Common.confirm('确定要删除？', '<?php echo URL::site('url/delete?url_id='. $url->getUrlId());?>')" data-link="#" ><i class="glyphicon glyphicon-remove"> </i>删除</a>
							<?php }?>
							<a name="log" data-link="<?php echo URL::site('url/log?url_id='. $url->getUrlId());?>"><i class="glyphicon glyphicon-list-alt"> </i>日志</a>
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
	Popup.bindIframe('[name="log"]', '抓取日志信息');
	var pageData = [];
	pageData.push(<?php echo $paginate->pageData();?>);
	Common.paginator("#paginator", pageData);
</script>