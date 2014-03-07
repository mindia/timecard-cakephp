<div class="panel panel-default">
	<div class="panel-heading">
		<div class="panel-title">
			<i class="glyphicon glyphicon-wrench pull-right"></i>
			<h4>Forgot your Password?</h4>
		</div>
	</div>
	<div class="panel-body">
		<?php echo $this->Form->create('User'); ?>
			<div class="form-group">
		  		<?php echo $this->Form->input('email', ['class'=>'form-control']);?>
			</div>

			<div class="control-group">
				<label></label>
				<div class="controls">
					<button type="submit" class="btn btn-primary">
					Send me reset password instructions
					</button>
				</div>
			</div>
		</form> 
	</div><!--/panel content-->

	<?php echo $this->element('Users/links', ['action'=>$datas['action'], 'auth'=>$datas['auth']]); ?>
</div><!--/panel-->