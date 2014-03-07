<div class="panel panel-default">
	<div class="panel-heading">
		<div class="panel-title">
			<i class="glyphicon glyphicon-wrench pull-right"></i>
			<h4>Edit Issue</h4>
		</div>
	</div>
	<div class="panel-body">
		<?php echo $this->Form->create('Issue', ['action'=>'update']); ?>
			<div class="form-group">
				<?php echo $this->Form->hidden('id', ['value'=>$issue['Issue']['id']]) ?>
				<?php echo $this->Form->hidden('author_id', ['value'=>$current_user['User']['id']]) ?>
				<?php echo $this->Form->hidden('project_id', ['value'=>$issue['Project']['id']]) ?>
				<?php echo $this->Form->hidden('info', ['value'=>$issue['Issue']['info']]) ?>
			</div>

			<div class="form-group">
		  		<?php echo $this->Form->input('subject', ['class'=>'form-control', 'value'=>$issue['Issue']['subject'] ]);?>
			</div>

			<div class="form-group">
		  		<?php echo $this->Form->input('description', ['type'=>'textarea', 'class'=>'form-control', 'value'=>$issue['Issue']['description'] ]);?>
			</div>

			<div class="form-group">
				<?php echo $this->Form->input('assignee_id', ['type'=>'select', 'options'=>$project_member, 'selected'=>$issue['Issue']['assignee_id']]) ;?>
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
				<?php if ($isGitHub): ?>
					<hr>
					<?php echo $this->Form->checkbox('github', ['label' => 'github', 'checked']) ?>
					<?php echo $this->Form->label('github', 'GitHub') ?>
					<br>
					<span class='text-muted'>If checked add/uddate this issue to github.</span>
					<hr>
				<?php endif ?>
			<div class="actions">
				<input class="btn btn-success" type="submit" value="Update Issue" name="commit"></input>
			</div>
		</form>
	</div><!--/panel content-->
</div><!--/panel-->





<a href="/issues/<?php echo $issue['Issue']['id']?>">Back to issue</a>