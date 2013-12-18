<h2>Sign up</h2>

<?php echo $this->Form->create('User'); ?>
	<div class="form-group">
  		<?php echo $this->Form->input('email', ['class'=>'form-control']);?>
	</div>
	<div class="form-group">
  		<?php echo $this->Form->input('name', ['class'=>'form-control']);?>
	</div>
	<div class="form-group">
  		<?php echo $this->Form->input('encrypted_password', ['type'=>'password','class'=>'form-control', 'label'=>'Password']);?>
	</div>
	<div class="form-group">
  		<?php echo $this->Form->input('password_confirmation', ['type'=>'password', 'class'=>'form-control']);?>
	</div>
	<div>
		<?php echo $this->Form->end(__('Sign up', ['class'=>'btn btn-default'])); ?>
	</div>
</div>
