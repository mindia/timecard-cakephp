<?php $this->Html->script( 'issues', array( 'inline' => false ) ); ?>

<h1>New Issue</h1>

<?php echo $this->Form->create('Issue', ['url'=>'/projects/'.$project['id'].'/issues/create']); ?>
	<?php echo $this->Form->hidden('author_id', ['value'=>$current_user['User']['id']]) ?>
	<?php echo $this->Form->hidden('project_id', ['value'=>$project['id']]) ?>

	<div class="form-group">
  		<?php echo $this->Form->input('subject', ['class'=>'form-control', ]);?>
	</div>

	<div class="form-group">
  		<?php echo $this->Form->input('description', ['type'=>'textarea', 'class'=>'form-control']);?>
	</div>

	<div class="form-group">
		<div id="assignee-select-box">
			<?php echo $this->Form->input('assignee_id', ['type'=>'select', 'options'=>$project_member]);?>
		</div>
	</div>

		<?php
			echo $this->Form->input('will_start_at', [
                                       'type' => 'datetime',
                                       'dateFormat' => 'YMD',
                                       'monthNames' => false,
                                       'timeFormat' => '24',
                                       'empty' => true,
                                       'minYear' => date('Y')-1,
                                       'maxYear' => date('Y')+4,
     					]);
		?>
		<?php if ($isGitHub): ?>
			<hr>
			<?php echo $this->Form->checkbox('github', ['label' => 'github', 'checked']) ?>
			<?php echo $this->Form->label('github', 'GitHub') ?>
			<br>
			<span class='text-muted'>If checked add this issue to github.</span>
			<hr>
		<?php endif ?>
	<div class="actions">
		<input class="btn btn-success" type="submit" value="Create Issue" name="commit"></input>
	</div>
</div>

<a href="/projects/show/<?php echo $project['id']?>">Back to project</a>