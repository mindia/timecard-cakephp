<h1>New project</h1>

<?php echo $this->Form->create('Project', ['action'=>'create']); ?>
	<div class="form-group">
  		<?php echo $this->Form->input('name', ['class'=>'form-control', 'placeholder'=>'Enter project name']);?>
	</div>

	<div class="form-group">
  		<?php echo $this->Form->input('description', ['label'=>'Description (optional)', 'type'=>'textarea', 'class'=>'form-control']);?>
	</div>
	<hr>
	<div class="radio">
		<?php echo $this->Form->radio('is_public', [true=>'Public'], ['legend'=>false, 'default'=>"1", 'hiddenField'=>false ]); ?><br/>
		<span class="text-muted">Anyone can see this project.</span>
	</div>
	<div class="radio">
		<?php echo $this->Form->radio('is_public', [false=>'Private'], ['legend'=>false, 'hiddenField'=>false ] );?><br/>
		<span class="text-muted">You choose who can see to this project.</span>
	</div>
	<hr>
	<div class="form-group">
		<?php echo $this->Form->input('crowdworks_url', ['label'=>'Crowdworks Project URL', 'class'=>'form-control']); ?>
	</div>
	<hr>
<?php echo $this->Form->end(['label'=>'Create Project', 'class'=>'btn btn-success']); ?>
<?php echo $this->html->link('Back','/projects') ?>
