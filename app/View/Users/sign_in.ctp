<h2>Sign in</h2>

<?php echo $this->Form->create('User'); ?>
	<div class="form-group">
  		<?php echo $this->Form->input('email', ['class'=>'form-control']);?>
	</div>

	<div class="form-group">
  		<?php echo $this->Form->input('encrypted_password', ['type'=>'password', 'class'=>'form-control', 'label'=>'Password']);?>
	</div>
        <div class="form-group">
                <?php echo $this->Form->input('remember_me', ['type'=>'checkbox', 'class'=>'checkbox', 'label'=>'Remember me']);?>
        </div>
	<div>
		<?php echo $this->Form->end(__('Sign in', ['class'=>'btn btn-default'])); ?>
	</div>
<?php echo $this->element('Users/links', ['action'=>$datas['action'], 'auth'=>$datas['auth']]); ?>
</div>
