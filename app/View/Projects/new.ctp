<h1>New project</h1>

<?php echo $this->Form->create('Project', ['action'=>'create']); ?>
	<div class="form-group">
  		<?php echo $this->Form->input('name', ['class'=>'form-control', 'placeholder'=>'Enter project name']);?>
	</div>

	<div class="form-group">
  		<?php echo $this->Form->input('description', ['type'=>'textarea', 'class'=>'form-control']);?>
	</div>
<!--
<% if @project.persisted? %>
<div class="form-group">
<%= f.label :github_full_name %><br>
<%= f.text_field :github_full_name, class: "form-control" %>
</div>
<div class="form-group">
<%= f.label :ruffnote_full_name %><br>
<%= f.text_field :ruffnote_full_name, class: "form-control" %>
</div>
<% end %>
-->
	<div class="checkbox">
		<?php echo $this->Form->input('is_public', ['type'=>'checkbox']);?>
	</div>

	<div class="actions">
		<input class="btn btn-default" type="submit" value="Create Project" name="commit"></input>
	</div>
</div>