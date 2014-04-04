<div class="panel panel-default">
	<div class="panel-heading">
		<div class="panel-title">
			<i class="glyphicon glyphicon-wrench pull-right"></i>
			<h4>Sign up</h4>
		</div>
	</div>
	<div class="panel-body">
		<?php echo $this->Form->create('User'); ?>
			<div class="control-group">
				<?php echo $this->Form->input('email', ['class'=>'form-control']);?>
			</div>      
			<div class="control-group">
				<?php echo $this->Form->input('name', ['class'=>'form-control']);?>
			</div>   
			<div class="control-group">
				<?php echo $this->Form->input('encrypted_password', ['type'=>'password','class'=>'form-control', 'label'=>'Password']);?>
			</div> 
			<div class="control-group">
				<?php echo $this->Form->input('password_confirmation', ['type'=>'password', 'class'=>'form-control']);?>
			</div>    
			<div class="control-group">
				<label></label>
				<div class="controls">
					<button type="submit" class="btn btn-primary">
					Sign up
					</button>
				</div>
			</div>
		</form>  
	</div><!--/panel content-->
</div><!--/panel-->
