<h1>Editing project</h1>

<?php echo $this->Form->create('Project', ['action'=>'update']); ?>
	<div class="form-group">
		<?php echo $this->Form->hidden('id', ['value'=>$project['Project']['id']]) ?>
  		<?php echo $this->Form->input('name', ['class'=>'form-control', 'value'=>$project['Project']['name'] ]);?>
	</div>

	<div class="form-group">
  		<?php echo $this->Form->input('description', ['label'=>'Description (optional)', 'type'=>'textarea', 'class'=>'form-control', 'value'=>nl2br($project['Project']['description']) ]);?>
	</div>
	<hr>
	<div class="form-group">
		<?php echo $this->Form->input('github_full_name', ['label'=>'GitHub Full Name (optional)', 'class'=>'form-control', 'value'=>$github_full_name ]);?>
	</div>
	<div class="form-group">
		<?php echo $this->Form->input('ruffnote_full_name', ['label'=>'Ruffnote Full Name (optional)', 'class'=>'form-control', 'value'=>$ruffnote_full_name ]);?>
	</div>
	<hr>
	<div class="radio">
		<?php echo $this->Form->radio('is_public', [true=>'Public'], ['legend'=>false, 'default'=>$project['Project']['is_public'] ]); ?><br/>
		<span class="text-muted">Anyone can see this project.</span>
	</div>
	<div class="radio">
		<?php echo $this->Form->radio('is_public', [false=>'Private'], ['legend'=>false, 'default'=>$project['Project']['is_public']] );?><br/>
		<span class="text-muted">You choose who can see to this project.</span>
	</div>
	<hr>
	<div class="form-group">
		<?php echo $this->Form->input('crowdworks_url', ['label'=>'Crowdworks Project URL', 'class'=>'form-control']); ?>
	</div>
	<hr>
<?php echo $this->Form->end(['label'=>'Update Project', 'class'=>'btn btn-success']); ?>
<a href="/projects/<?php echo $project['Project']['id'] ?>" >Back to project</a>
