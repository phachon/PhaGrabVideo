<div class="panel panel-default">
	<div class="panel-body">
		<div class="row">
			<form action="<?php echo URL::site('/list'); ?>" method="get">
				<div class="col-md-9">
					<div class="input-group">
					</div>
				</div>
				<div class="col-md-3">
					<div class="input-group">
						<input class="form-control" name="accountId" type="text" value="<?php echo isset($_GET['accountId']) ? $_GET['accountId'] : ''; ?>" placeholder="用户名/account_id"/>
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
				<th class="center w5p">ID</th>
				<th class="center w15p">用户名</th>
				<th class="center w10p">姓名</th>
				<th class="center w16p">邮箱</th>
				<th class="center w16p">Token</th>
				<th class="center w10p">角色</th>
				<th class="center w8p">状态</th>
				<th class="center w10p">操作</th>
			</tr>
			</thead>
			<tbody>
			<?php if($accounts->count() > 0) {
				foreach ($accounts as $account) { ?>
					<tr>
						<td class="center"><?php echo $account->getAccountId();?></td>
						<td class="center"><?php echo $account->getName();?></td>
						<td class="center"><?php echo $account->getGivenName();?></td>
						<td class="center"><?php echo $account->getEmail();?></td>
						<td class="center"><?php echo $account->getToken();?></td>
						<td class="center"><?php echo $account->getRole();?></td>
						<td class="center"><?php echo $account->getStatus();?></td>
						<td class="center">
							<a name="edit" data-link="<?php echo URL::site('account/edit?account_id='. $account->getAccountId());?>"><i class="glyphicon glyphicon-pencil"> </i>修改</a>
							<?php if($account->status == Model_Account::STATUS_DELETE) { ?>
								<a name="review" onclick="Common.confirm('确定要恢复？', '<?php echo URL::site('account/review?account_id='. $account->getAccountId());?>')" data-link="#" ><i class="glyphicon glyphicon-ok"> </i>恢复</a>
							<?php }else { ?>
								<a name="delete" onclick="Common.confirm('确定要屏蔽？', '<?php echo URL::site('account/delete?account_id='. $account->getAccountId());?>')" data-link="#" ><i class="glyphicon glyphicon-remove"> </i>屏蔽</a>
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
	var pageData = [];
	Popup.bindIframe('[name="edit"]', '修改账号信息');
	pageData.push(<?php echo $paginate->pageData();?>);
	Common.paginator("#paginator", pageData);
</script>