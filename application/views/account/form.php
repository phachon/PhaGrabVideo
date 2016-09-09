<div class="panel panel-default">
<div class="panel-body">
	<form  class="form-horizontal" method="post" action="<?php echo isset($account) ? URL::site('account/modify') : URL::site('account/save');?>">
		<br>
		<input type="hidden" value="<?php echo isset($account) ? $account->getAccountId() : '';?>" name="account_id">
		<div class="form-group">
			<label class="col-md-2 control-label"><span class="text-danger"> * </span>姓名</label>
			<div class="col-md-6">
				<input class="form-control" type="text" name="given_name" value="<?php echo isset($account) ? $account->getGivenName() : '';?>" placeholder="输入姓名"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label"><span class="text-danger"> * </span>用户名</label>
			<div class="col-md-6">
				<input class="form-control" type="text" name="name" value="<?php echo isset($account) ? $account->getName() : '';?>" <?php echo isset($account) ? 'disabled' : '';?> placeholder="输入用户名"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label"><span class="text-danger"> * </span>电子邮件</label>
			<div class="col-md-6">
				<input class="form-control" type="text" name="email" value="<?php echo isset($account) ? $account->getEmail() : '';?>" placeholder="输入邮箱"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label"><span class="text-danger"> * </span>手机号码</label>
			<div class="col-md-6">
				<input class="form-control" type="text" name="mobile" value="<?php echo isset($account) ? $account->getMobile() : '';?>" placeholder="输入手机号码"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">电话号码</label>
			<div class="col-md-6">
				<input class="form-control" type="text" name="phone" value="<?php echo isset($account) ? $account->getPhone() : '';?>" placeholder="输入电话号码"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label"><span class="text-danger"> * </span>角色</label>
			<div class="col-md-6">
				<select class="form-control" name="role_id">
					<option value="">未选择角色</option>
					<?php foreach ($roles as $role) { ?>
						<option value="<?php echo $role->getRoleId();?>" <?php echo isset($account) && ($account->getRoleId() == $role->getRoleId()) ? 'selected' : '';?>><?php echo $role->getName();?></option>
					<?php }?>
				</select>
			</div>
		</div>
		<div class="form-actions">
			<div class="col-md-offset-2 col-md-10">
				<input type="button" value="提交" class="btn btn-success" onclick="Form.ajaxSubmit(this.form, <?php echo isset($account) && is_object($account) && $account->getAccountId() ? 'true' : 'false'; ?>)" />
			</div>
		</div>
	</form>
</div>
</div>