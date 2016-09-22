<div class="panel panel-default">
	<div class="panel-body">
		<div class="row">
			<form action="<?php echo URL::site('role/list'); ?>" method="get">
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
				<th class="center w25p">角色名称</th>
				<th class="center w25p">状态</th>
				<th class="center">创建时间</th>
				<th class="center">操作</th>
			</tr>
			</thead>
			<tbody>
			<?php if($roles->count() > 0) {
				foreach ($roles as $role) { ?>
					<tr>
						<td class="center"><?php echo $role->getRoleId();?></td>
						<td class="center"><?php echo $role->getName();?></td>
						<td class="center"><?php echo $role->getStatus();?></td>
						<td class="center"><?php echo $role->getCreateTime('Y-m-d H:i');?></td>
						<td class="center">
							<a name="edit" data-link="<?php echo URL::site('role/edit?role_id='. $role->getRoleId());?>"><i class="glyphicon glyphicon-pencil"> </i>修改</a>
							<?php if($role->getRoleId() != 1) {?>
							<a name="privilege" data-link="<?php echo URL::site('role/privilege?role_id='. $role->getRoleId());?>"><i class="glyphicon glyphicon-check"> </i>权限</a>
							<?php }?>
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
	Popup.bindIframe('[name="edit"]', '修改角色信息');
	Popup.bindIframe('[name="privilege"]', '修改角色权限');
	var pageData = [];
	pageData.push(<?php echo $paginate->pageData();?>);
	Common.paginator("#paginator", pageData);
</script>