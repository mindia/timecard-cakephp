<?php if(count($issues) === 0): ?>
You don't have assigned issue.
<?php else:?>
<?php foreach($issues as $issue):?>
	<div is="issues" class="media-list">
		<div id="issue_<?php echo $issue['Issue']['id'] ?>" class="issue media">
			<div class="pull-left">
				<div class="issue-subject">
<<<<<<< HEAD
					<a href="/issues/<?php echo $issue['Issue']['id'] ?>"><b><?php echo h($issue['Issue']['subject']) ?></b></a>
				</div>
				<div class="issue-author">
					Opend by <?php echo $issue['Author']['name'] ?> <?php echo $this->App->timeAgo($issue['Issue']['created_at']) ?>
=======
					<a href="/issues/<?php echo $issue['Issue']['id'] ?>"><?php echo h($issue['Issue']['subject']) ?></a>
				</div>
				<div class="issue-author">
					Opend by <?php echo $issue['Author']['username'] ?> <?php echo $this->App->timeAgo($issue['Issue']['created_at']) ?>
>>>>>>> iss-14 projectにissueを登録できるようにする
				</div>
				<div class="issue-status">
				<?php if((int)$issue['Issue']['status'] === 1):?>
					<span class="label label-success">Open</span>
				<?php else:?>
					<span class="label label-danger">Closed</span>
				<?php endif ?>
				</div>
			</div>

			<div class="actions pull-right">
			<?php if((int)$issue['Issue']['status'] === 1):?>
				<a class="btn btn-danger js-hide-issue" rel="nofollow" href="/issues/<?php echo $issue['Issue']['id'] ?>/close.json" data-remote="true" data-method="patch">Close</a>
				<?php if(is_null($issue['Issue']['will_start_at']) || $issue['Issue']['will_start_at'] <= date('Y-m-d H:i:s')):?>
				<a class="btn btn-default js-hide-issue" rel="nofollow" href="/issues/<?php echo $issue['Issue']['id'] ?>/postpone.json" data-remote="true" data-method="patch">Don't do today</a>
				<?php else:?>
				<a class="btn btn-default js-hide-issue" rel="nofollow" href="/issues/<?php echo $issue['Issue']['id'] ?>/do_today.json" data-remote="true" data-method="patch">Do today</a>
					<?php if($issue['Issue']['will_start_at']): //todo 条件確認?>
					<a class="btn btn-warning js-start-workload-button" rel="nofollow" href="/issues/<?php echo $issue['Issue']['id'] ?>/workloads/start" data-remote="true" data-method="post">Stop</a>
					<?php else:?>
					<a class="btn btn-primary js-start-workload-button" rel="nofollow" href="/issues/<?php echo $issue['Issue']['id'] ?>/workloads/start" data-remote="true" data-method="post">Start</a>
					<?php endif?>
				<?php endif?>
			<?php else:?>
				<a class="btn btn-default js-hide-issue" rel="nofollow" href="/issues/<?php echo $issue['Issue']['id'] ?>/reopen.json" data-remote="true" data-method="patch">Reopen</a>
			<?php endif ?>
			</div>
		</div>
	</div>
<?php endforeach ?>
<?php endif ?>