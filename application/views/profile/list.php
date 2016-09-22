<div class="panel panel-default">
	<div class="panel-body">
		<div class="row">
		</div>
	</div>
	<div class="table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
			<tr>
				<th class="center w10p">ID</th>
				<th class="center w15p">用户名</th>
				<th class="center w15p">姓名</th>
				<th class="center w20p">邮箱</th>
				<th class="center w15p">手机</th>
				<th class="center">创建时间</th>
				<th class="center">操作</th>
			</tr>
			</thead>
			<tbody>
			<?php if($account && is_object($account)) { ?>
				<tr class="gradeX">
					<td class="center"><?php echo $account->getAccountId();?></td>
					<td class="center"><?php echo $account->getname();?></td>
					<td class="center"><?php echo $account->getGivenName();?></td>
					<td class="center"><?php echo $account->getEmail();?></td>
					<td class="center"><?php echo $account->getMobile();?></td>
					<td class="center"><?php echo date('Y-m-d H:i:s', $account->getCreateTime());?></td>
					<td class="center">
						<a name="edit" data-link="<?php echo URL::site('profile/edit?account_id=' . $account->getAccountId());?>" ><i class="glyphicon glyphicon-pencil"> </i>修改</a>
						<a name="editpass" data-link="<?php echo URL::site('profile/editpass?account_id=' . $account->getAccountId());?>" ><i class="glyphicon glyphicon-asterisk"> </i>修改密码</a>
					</td>
				</tr>
				<?php
			}?>
			</tbody>
		</table>
	</div>
	<div class="panel-footer">
		<div class="row">
			<h4 class="text-info">你的Token：<span class="label label-success"><?php echo $account->getToken();?></span></h4>
		</div>
	</div>
</div>
<script type="text/javascript">
	Popup.bindIframe('[name="edit"]', '修改账号信息');
	Popup.bindIframe('[name="editpass"]', '修改密码');
</script>