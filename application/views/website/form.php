<div class="panel panel-default">
	<div class="panel-body">
		<form  class="form-horizontal" method="post" action="<?php echo isset($website) ? URL::site('website/modify') : URL::site('website/save');?>">
			<?php if(!isset($website)) { ?>
				<h4>添加支持抓取的网站</h4>
			<?php } ?>
			<hr>
			<input type="hidden" name="website_id" value="<?php echo isset($website) ? $website->getWebsiteId() : 0;?>">
			<div class="form-group">
				<label class="col-md-2 control-label"><span class="text-danger"> * </span>网站名称</label>
				<div class="col-md-6">
					<input class="form-control" type="text" name="name" value="<?php echo isset($website) ? $website->getName() : '';?>" placeholder="网站名称"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2 control-label"><span class="text-danger"> * </span>网站URL</label>
				<div class="col-md-6">
					<input class="form-control" type="text" name="url" value="<?php echo isset($website) ? $website->getUrl() : '';?>" placeholder="网站URL"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2 control-label"><span class="text-danger"></span>key值</label>
				<div class="col-md-6">
					<input class="form-control" type="text" name="issue_key" value="<?php echo isset($website) ? $website->getIssueKey() : '';?>" placeholder="key值"/>
				</div>
			</div>
			<br>
			<div class="form-actions">
				<div class="col-md-offset-2 col-md-10">
					<input type="button" value="提交" class="btn btn-success" onclick="Form.ajaxSubmit(this.form, <?php echo isset($website) && is_object($website) && $website->getWebsiteId() ? 'true' : 'false'; ?>);" />
				</div>
			</div>
		</form>
	</div>
</div>