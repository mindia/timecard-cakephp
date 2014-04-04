<div class="panel panel-default">
	<div class="panel-heading">
		<div class="panel-title">
			<i class="glyphicon glyphicon-wrench pull-right"></i>
			<h4>Sign in</h4>
		</div>
	</div>
	<div class="panel-body">
		<?php echo $this->Form->create('User'); ?>
			<div class="control-group">
				<?php echo $this->Form->input('email', ['class'=>'form-control']);?>
			</div>      
			<div class="control-group">
				<?php echo $this->Form->input('encrypted_password', ['type'=>'password', 'class'=>'form-control', 'label'=>'Password']);?>
			</div>   
			<div class="control-group">
				<?php echo $this->Form->input('remember_me', ['type'=>'checkbox', 'class'=>'checkbox', 'label'=>'Remember me']);?>
			</div> 
			<div class="control-group">
				<label></label>
				<div class="controls">
					<button type="submit" class="btn btn-primary">
					Sign in
					</button>
				</div>
			</div>
		</form> 
	</div><!--/panel content-->

	<?php echo $this->element('Users/links', ['action'=>$datas['action'], 'auth'=>$datas['auth']]); ?>
</div><!--/panel-->
