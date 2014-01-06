<h1>New Issue</h1>

<?php echo $this->Form->create('Issue', ['url'=>'/projects/'.$project['id'].'/issues/create']); ?>
	<input id="issue_author_id" type="hidden" value="<?php echo $current_user['User']['id']?>" name="data[Issue][author_id]"></input>
	<input id="issue_project_id" type="hidden" value="<?php echo $project['id']?>" name="data[Issue][project_id]"></input>

	<div class="form-group">
  		<?php echo $this->Form->input('subject', ['class'=>'form-control', ]);?>
	</div>

	<div class="form-group">
  		<?php echo $this->Form->input('description', ['type'=>'textarea', 'class'=>'form-control']);?>
	</div>

	<div class="form-group">
		<?php echo $this->Form->input('assignee_id', ['type'=>'select', 'options'=>$project_member]);?>
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
	<div class="actions">
		<input class="btn btn-default" type="submit" value="Create Issue" name="commit"></input>
	</div>
</div>

<a href="/projects/show/<?php echo $project['id']?>">Back to project</a>