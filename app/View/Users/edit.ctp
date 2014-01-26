<h2>Edit</h2>
<?php echo $this->Form->create('User',['novalidate'=>true]); ?>
	<div class="form-group">
  		<?php echo $this->Form->input('email', ['class'=>'form-control', 'value'=> $current_user['User']['email']]);?>
  		<?php echo $this->Form->input('id', ['type'=>'hidden', 'value'=> $current_user['User']['id']]);?>
	</div>
	<div class="form-group">
  		<?php echo $this->Form->input('name', ['class'=>'form-control', 'value'=>$current_user['User']['name']]);?>
	</div>
	<div class="form-group">
  		<?php echo $this->Form->input('encrypted_password', ['type'=>'password','class'=>'form-control', 'label'=>'Password']);?>
	</div>
	<div class="form-group">
  		<?php echo $this->Form->input('password_confirmation', ['type'=>'password', 'class'=>'form-control']);?>
	</div>
	<div>
		<?php echo $this->Form->end(__('Update', ['class'=>'btn btn-default'])); ?>
	</div>
</div>
<h2>Service</h2>
<dl>
    <dt><b>Github</b></dt>
    <dd>
      <?php if ($datas['connect_gitHub']):   ?>
      <div>
	<?php echo $datas['github_username'] ?>
      	<?php echo $this->Html->link('Disconnect from Github', ['controller'=>'users', 'action'=>'disconnect', '?' => 'provider=github'] )  ?>
      </div>
      <?php else: ?>
      	<?php echo $this->Html->link('Connect to Github', ['controller'=>'auth', 'action'=>'github'], ['class'=>'btn btn-default'])  ?>
      <?php endif; ?>
      <?php if ( $datas['connect_ruffnote']):  ?>
      <div>
      <?php echo $datas['ruffnote_username'] ?>
      	<?php echo $this->Html->link('Disconnect from Ruffnote', ['controller'=>'users', 'action'=>'disconnect', '?' => 'provider=ruffnote'] )  ?>
      </div>

      <?php else: ?>
      	<?php echo $this->Html->link('Connect to Ruffnote', ['controller'=>'auth', 'action'=>'ruffnote'], ['class'=>'btn btn-default'])  ?>

      <?php endif; ?>

    </dd>
</dl>

<h3>Cancel my account</h3>
<p>Unhappy? <?php echo $this->Html->link('Cancel my accout', [], ['class'=>'btn btn-danger'], 'Are you sure?' ) ?></p>

<?php echo $this->html->link('Back', [],['class'=>'back']) ?>
<?php echo '<a href="'.$refer.'" class="back">Back</a>'; ?> 
