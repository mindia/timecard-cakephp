<h2>Forgot your Password?</h2>

<?php echo $this->Form->create('User'); ?>
	<div class="form-group">
  		<?php echo $this->Form->input('email', ['class'=>'form-control']);?>
	</div>
	<div>
		<?php echo $this->Form->end(__('Send me reset password instructions', ['class'=>'btn btn-default'])); ?>
	</div>
<?php echo $this->element('Users/links', ['action'=>$datas['action'], 'auth'=>$datas['auth']]); ?>
</div>
