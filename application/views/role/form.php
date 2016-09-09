<div class="panel panel-default">
	<div class="panel-body">
		<form  class="form-horizontal" method="post" action="<?php echo isset($role) ? URL::site('role/modify') : URL::site('role/save');?>">
			<br>
			<input type="hidden" name="role_id" value="<?php echo isset($role) ? $role->getRoleId() : 0;?>">
			<div class="form-group">
				<label class="col-md-2 control-label"><span class="text-danger"> * </span>角色名称</label>
				<div class="col-md-6">
					<input class="form-control" type="text" name="name" value="<?php echo isset($role) ? $role->getName() : '';?>" placeholder="角色名称"/>
				</div>
			</div>
			<br>
			<div class="form-actions">
				<div class="col-md-offset-2 col-md-10">
					<input type="button" value="提交" class="btn btn-success" onclick="Form.ajaxSubmit(this.form, <?php echo isset($role) && is_object($role) && $role->getRoleId() ? 'true' : 'false'; ?>);" />
				</div>
			</div>
		</form>
	</div>
</div>