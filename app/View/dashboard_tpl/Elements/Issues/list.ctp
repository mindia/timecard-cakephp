<?php if(count($issues) === 0): ?>
<div class="alert alert-danger">
	You don't have assigned issue.
</div>

<?php else:?>
<table class="table table-striped media-list" id="issues">
	<thead>
		<tr>
			<th>Details</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($issues as $issue):?>
		<tr id="issue_<?php echo $issue['Issue']['id'] ?>" class="issue media">
			<td>
				<div class="issue-subject">
					<?php if (!empty($issue['Issue']['info'])): ?>
						<a href="<?php echo $issue['Issue']['info'] ?>" target="_blank"><b><?php echo "#".substr(strrchr($issue['Issue']['info'], '/'), 1) ?></b></a>
					<?php endif ?>
					<a href="/issues/<?php echo $issue['Issue']['id'] ?>"><b><?php echo h($issue['Issue']['subject']) ?></b></a>
				</div>
				<div class="issue-author">
					Opend by <?php echo $this->Html->link($issue['Author']['name'], '/users/'.$issue['Author']['id']) ?> <?php echo $this->App->timeAgo($issue['Issue']['created_at']) ?>
				</div>
				<div class="issue-status">
				<?php if((int)$issue['Issue']['status'] === 1):?>
					<span class="label label-success">Open</span>
				<?php else:?>
					<span class="label label-danger">Closed</span>
				<?php endif ?>
				</div>
			</td>
			
			<td class="actions">
				<div class="pull-right">
				<?php if((int)$issue['Issue']['status'] === 1):?>
					<a class="btn btn-danger js-hide-issue btn-iss-status" rel="nofollow" href="/issues/<?php echo $issue['Issue']['id'] ?>/close.json" data-remote="true" data-method="patch">Close</a>
				<?php else:?>
					<a class="btn btn-default js-hide-issue btn-iss-status" rel="nofollow" href="/issues/<?php echo $issue['Issue']['id'] ?>/reopen.json" data-remote="true" data-method="patch">Reopen</a>
				<?php endif ?>
				<?php if((int)$issue['Issue']['status'] === 1):?>
					<?php if(is_null($issue['Issue']['will_start_at']) || $issue['Issue']['will_start_at'] <= date('Y-m-d H:i:s')):?>
					<a class="btn btn-default js-hide-issue" rel="nofollow" href="/issues/<?php echo $issue['Issue']['id'] ?>/postpone.json" data-remote="true" data-method="patch">Don't do today</a>
					<?php else:?>
					<a class="btn btn-default js-hide-issue" rel="nofollow" href="/issues/<?php echo $issue['Issue']['id'] ?>/do_today.json" data-remote="true" data-method="patch">Do today</a>
					<?php endif?>

					<?php if( $this->Workload->isWorkInProgress($issue)):?>
					<a class="btn btn-warning js-start-workload-button" rel="nofollow" href="/issues/<?php echo $issue['Issue']['id'] ?>/workloads/stop" data-remote="true" data-method="post">Stop</a>
					<?php else:?>
					<a class="btn btn-primary js-start-workload-button" rel="nofollow" href="/issues/<?php echo $issue['Issue']['id'] ?>/workloads/start" data-remote="true" data-method="post">Start</a>
					<?php endif?>
				<?php endif ?>
				</div>
			</td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>
<?php endif ?>