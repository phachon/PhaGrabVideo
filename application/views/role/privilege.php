<div class="panel panel-default">
	<div class="panel-body">
		<ul class="nav nav-tabs">
			<h4>角色：<?php echo $role->getName();?></h4>
		</ul>
	</div>
	<div class="panel-body">
		<form class="form-horizontal" method="post" action="<?php echo URL::site('role/privilegeSave');?>">
		<input type="hidden" name="role_id" value="<?php echo $role->getRoleId();?>" />
		<div>
		<?php
		if($menus) {
			$defaultMenus = explode(',', $role->getPrivilegeMenu());
			foreach ($menus as $menu => $values) { ?>
			<ul class="list-group inline-group w240">
				<li class="list-group-item"><strong><?php echo $values['name'];?></strong> (<?php echo $menu;?>) <span class="pull-right"><input name="privilege_menu[]" type="checkbox" value="<?php echo $menu;?>" <?php echo in_array($menu, $defaultMenus) ? 'checked' : '';?>/></span></li>
				<?php if($values['submenu']) {
					foreach ($values['submenu'] as $submenu) { ?>
				<li class="list-group-item"><?php echo $submenu['name'];?><span class="pull-right">
					<?php }
				}?>
			</ul>
			<?php }
		} ?>
		</div>
		<div class="form-group">
			<div class="col-md-8" style="margin-left:10px;">
				<input type="button" value=" 保存 " class="btn btn-success" onclick="Form.ajaxSubmit(this.form, true)"/>
			</div>
		</div>
		</form>
	</div>
</div>