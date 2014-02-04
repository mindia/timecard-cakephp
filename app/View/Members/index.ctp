<?php $this->Html->script( 'members', array( 'inline' => false ) ); ?>

<a href="/projects/<?php echo $project['Project']['id']?>">Back to project</a>
<h2 id="project" data-projectid="<?php echo $project['Project']['id']?>"><?php echo h($project['Project']['name'])?></h2>

<div class="row">
	<div class="col-md-6">
		<h3>Project Member</h3>
		<ul>
			<?php foreach($members as $member):?>
			<li>
				<?php echo $this->Html->link($member['User']['name'], '/users/'.$member['User']['id']) ?>
				<?php if(!$this->App->is_admin($member['User'], $project['Member'])):?>
				<a href="/members/<?php echo $member['User']['id']?>" class="btn btn-xs btn-danger btn-delete-member" confirm="Are you sure?" data-id="<?php echo $member['Member']['id']?>">Delete</a>
				<?php endif ?>
			</li>
			<?php endforeach ?>
		</ul>
	</div>

	<div class="col-md-6">
		<h3>All User</h3>
		<ul>
			<?php foreach($users as $user):?>
			<li>
				<?php echo $this->Html->link($user['User']['name'], '/users/'.$user['User']['id']) ?>
				<a href="/projects/<?php echo $project['Project']['id']?>/members/?user_id=<?php echo $user['User']['id']?>" class="btn btn-xs btn-success" data-method="post">Add</a>
			</li>
			<?php endforeach ?>
		</ul>
	</div>
</div>