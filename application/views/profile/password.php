<div class="panel panel-default">
	<div class="panel-body"></div>
	<div class="panel-body">
		<form  class="form-horizontal" method="post" action="<?php echo URL::site('profile/modifypass');?>">
			<div class="form-group">
				<label class="col-md-2 control-label"><span class="text-danger"> * </span> 当前密码 </label>
				<div class="col-md-6">
					<input class="form-control" type="hidden" name="account_id" value="<?php echo $accountId ? $accountId : '';?>"/>
					<input class="form-control" type="password" name="old_password" value="" placeholder="输入当前密码"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2 control-label"><span class="text-danger"> * </span> 新密码 </label>
				<div class="col-md-6">
					<input class="form-control" type="password" name="new_password" value="" placeholder="输入新密码"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2 control-label"><span class="text-danger"> * </span> 确认密码 </label>
				<div class="col-md-6">
					<input class="form-control" type="password" name="renew_password" value="" placeholder="重新输入新密码"/>
				</div>
			</div>
			<div class="form-actions">
				<div class="col-md-offset-2 col-md-10">
					<input type="button" value="保存" class="btn btn-success" onclick="Form.ajaxSubmit(this.form,true)" />
				</div>
			</div>
		</form>
	</div>
</div>