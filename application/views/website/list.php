<div class="panel panel-default">
	<div class="panel-body">
		<div class="row">
			<form action="<?php echo URL::site('website/list'); ?>" method="get">
				<div class="col-md-3 col-md-offset-9">
					<div class="input-group">
						<input class="form-control" name="keyword" type="text" value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>" placeholder="名称"/>
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
				<th class="center w10p">ID</th>
				<th class="center w15p">网站名</th>
				<th class="center w25p">网站url</th>
				<th class="center w20p">key</th>
				<th class="center">状态</th>
				<th class="center">操作</th>
			</tr>
			</thead>
			<tbody>
			<?php if($websites->count() > 0) {
				foreach ($websites as $website) { ?>
					<tr>
						<td class="center"><?php echo $website->getWebsiteId();?></td>
						<td class="center"><?php echo $website->getName();?></td>
						<td class="center"><?php echo $website->getUrl();?></td>
						<td class="center"><?php echo $website->getIssueKey();?></td>
						<td class="center"><?php echo $website->getStatus();?></td>
						<td class="center">
							<a name="edit" data-link="<?php echo URL::site('website/edit?website_id='. $website->getWebsiteId());?>"><i class="glyphicon glyphicon-pencil"> </i>修改</a>
							<a name="delete" onclick="Common.confirm('确定要删除？', '<?php echo URL::site('website/delete?website_id='. $website->getwebsiteId());?>')" data-link="#" ><i class="glyphicon glyphicon-remove"> </i>删除</a>
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
	Popup.bindIframe('[name="edit"]', '修改网站信息');
	var pageData = [];
	pageData.push(<?php echo $paginate->pageData();?>);
	Common.paginator("#paginator", pageData);
</script>