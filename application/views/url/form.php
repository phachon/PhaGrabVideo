<div class="panel panel-default">
	<div class="panel-body">
		<form  class="form-horizontal" method="post" action="<?php echo URL::site('url/save')?>">
			<div class="form-group">
				<label class="col-md-2 control-label"><span class="text-danger">*</span> 抓取URL </label>
				<div class="col-md-6">
					<textarea class="form-control" rows="8" name="urls"></textarea>
				</div>
				<span class="text-danger"> 注意：每个 url 一行,最多 5 个</span>
			</div>
			<div class="form-group">
				<label class="col-md-2 control-label"><span class="text-danger">*</span> URL来源 </label>
				<div class="col-md-10">
					<input type="hidden" name="website_id" value="" />
					<div class="panel panel-default inline-group w160">
						<div class="panel-heading"> URL来源 </div>
						<div name="source" class="panel-body" style="padding:2px;height:135px;overflow-y: scroll;">
							<?php if(isset($websites)) {
								foreach ($websites as $website) {
									echo "<a name=\"source\", data=\"{$website->getWebsiteId()}\"class=\"list-group-item\" onclick=\"Url.add.source(this)\" style=\"padding:5px;\">{$website->getName()}</a>";
								}
							}?>
						</div>
					</div>
				</div>
			</div>
			<br>
			<div class="form-actions">
				<div class="col-md-offset-2 col-md-10">
					<input type="button" value="提交" class="btn btn-success" onclick="Form.ajaxSubmit(this.form, false);" />
				</div>
			</div>
		</form>
	</div>
</div>