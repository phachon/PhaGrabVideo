<div class="panel panel-default">
	<div class="panel-body"></div>
	<div class="panel-body">
		<form class="form-horizontal" method="post" action="<?php echo URL::site('profile/modify');?>">
			<input type="hidden" name="account_id" value="<?php echo isset($account) && is_object($account) ? $account->getAccountId() : ''; ?>" />
			<div class="form-group">
				<label class="col-md-2 control-label"><span class="text-danger"> * </span>姓名</label>
				<div class="col-md-6">
					<input class="form-control" type="text" name="given_name" value="<?php echo isset($account) && is_object($account) ? $account->getGivenName() : ''; ?>" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2 control-label"><span class="text-danger"> * </span>用户名</label>
				<div class="col-md-6">
					<input class="form-control" type="text" name="name" <?php echo isset($account) && is_object($account) ? "value='{$account->getName()}' disabled='disabled'" : ''; ?> />
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2 control-label"><span class="text-danger"></span>电子邮件</label>
				<div class="col-md-6">
					<input class="form-control" type="text" name="email" value="<?php echo isset($account) && is_object($account) ? $account->getEmail() : ''; ?>" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2 control-label"><span class="text-danger"> * </span>手机号码</label>
				<div class="col-md-6">
					<input class="form-control" type="text" name="mobile" value="<?php echo isset($account) && is_object($account) ? $account->getMobile() : ''; ?>" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2 control-label"><span class="text-danger"></span>电话号码</label>
				<div class="col-md-6">
					<input class="form-control" type="text" name="phone" value="<?php echo isset($account) && is_object($account) ? $account->getPhone() : ''; ?>" />
				</div>
			</div>
			<input type="hidden" name="role_id" value="<?php echo isset($account) && is_object($account) ? $account->getRoleId() : ''; ?>">
			<div class="form-group">
				<label class="col-md-2 control-label"><span class="text-danger"> * </span>角色</label>
				<div class="col-md-6">
					<select class="form-control" name="role_id" disabled>
						<option value="">未选择角色</option>
						<?php foreach ($roles as $role) { ?>
							<option value="<?php echo $role->getRoleId();?>" <?php echo isset($account) && ($account->getRoleId() == $role->getRoleId()) ? 'selected' : '';?>><?php echo $role->getName();?></option>
						<?php }?>
					</select>
				</div>
			</div>
			<div class="form-actions">
				<div class="col-md-offset-2 col-md-10">
					<input type="button" value=" 保存 " class="btn btn-success" onclick="Form.ajaxSubmit(this.form, 'true')"/>
				</div>
			</div>
		</form>
	</div>
</div>