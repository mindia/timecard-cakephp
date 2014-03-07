<div class="panel panel-default">
	<div class="panel-heading">
		<div class="panel-title">
			<h4>New project</h4>
		</div>
	</div>
	<div class="panel-body">
		<?php echo $this->Form->create('Project', ['action'=>'create']); ?>
			<div class="form-group">
		  		<?php echo $this->Form->input('name', ['class'=>'form-control', 'placeholder'=>'Enter project name']);?>
			</div>

			<div class="form-group">
		  		<?php echo $this->Form->input('description', ['label'=>'Description (optional)', 'type'=>'textarea', 'class'=>'form-control']);?>
			</div>
			<div class="radio">
				<?php echo $this->Form->radio('is_public', [true=>'Public'], ['legend'=>false, 'default'=>"1", 'hiddenField'=>false ]); ?><br/>
				<span class="text-muted">Anyone can see this project.</span>
			</div>
			<div class="radio">
				<?php echo $this->Form->radio('is_public', [false=>'Private'], ['legend'=>false, 'hiddenField'=>false ] );?><br/>
				<span class="text-muted">You choose who can see to this project.</span>
			</div>
			<div class="actions">
				<input class="btn btn-default" type="submit" value="Create Project" name="commit"></input>
			</div>
			<br/>	
			<?php echo $this->html->link('Back','/projects') ?>
		</form> 
	</div><!--/panel content-->
</div><!--/panel-->
