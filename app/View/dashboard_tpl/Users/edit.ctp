<div class="panel panel-default">
  <div class="panel-heading">
    <div class="panel-title">
      <i class="glyphicon pull-right"></i>
      <h4>User Edit</h4>
    </div>
  </div>
  <div class="panel-body">
    <?php echo $this->Form->create('User',['novalidate'=>true]); ?>
      <div class="control-group">
        <?php echo $this->Form->input('email', ['class'=>'form-control', 'value'=> $current_user['User']['email']]);?>
        <?php echo $this->Form->input('id', ['type'=>'hidden', 'value'=> $current_user['User']['id']]);?>
      </div>      
      <div class="control-group">
        <?php echo $this->Form->input('name', ['class'=>'form-control', 'value'=>$current_user['User']['name']]);?>
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
          Update
          </button>
        </div>
      </div>
    </form>  
  </div><!--/panel content-->
</div><!--/panel-->

<div class="panel panel-default">
  <div class="panel-heading">
    <div class="panel-title">
      <i class="glyphicon pull-right"></i>
      <h4>Service</h4>
    </div>
  </div>
  <div class="panel-body">
      <div class="btn-group btn-group-justified">
  <?php if (isset($datas['connect_gitHub']) && $datas['connect_gitHub']):?>
  <a href="/users/disconnect?provider=github" class="btn btn-danger col-sm-3">
    <i class="glyphicon glyphicon-cloud"></i><br>
    <?php echo $datas['github_username'] ?><br>
    Disconnect from Github
  </a>
  <?php else: ?>
  <a href="/auth/github" class="btn btn-info col-sm-3">
    <i class="glyphicon glyphicon-cloud"></i><br>
    Connect to Ruffnote
  </a>
  <?php endif; ?>

  <?php if (isset($datas['connect_ruffnote']) && $datas['connect_ruffnote']):?>
  <a href="/users/disconnect?provider=ruffnote" class="btn btn-danger col-sm-3">
    <i class="glyphicon glyphicon-cloud"></i><br>
    <?php echo $datas['ruffnote_username'] ?><br>
    Disconnect from Ruffnote
  </a>
  <?php else: ?>
  <a href="/auth/ruffnote" class="btn btn-info col-sm-3">
    <i class="glyphicon glyphicon-cloud"></i><br>
    Connect to Ruffnote
  </a>
  <?php endif; ?>

  <?php if (isset($datas['connect_other']) && $datas['connect_other']):?>
  <a href="/users/disconnect?provider=other" class="btn btn-danger col-sm-3">
    <i class="glyphicon glyphicon-cloud"></i><br>
    <?php echo $datas['other_username'] ?><br>
    Disconnect from Other Authentications
  </a>
  <?php else: ?>
  <a href="/auth/other" class="btn btn-info col-sm-3">
    <i class="glyphicon glyphicon-cloud"></i><br>
    Connect to Other Authentications
  </a>
  <?php endif; ?>
</div>
  </div>
</div><!--/panel--> 


<div class="panel panel-default">
  <div class="panel-heading">
    <div class="panel-title">
      <i class="glyphicon pull-right"></i>
      <h4>Cancel my account</h4>
    </div>
  </div>
  <div class="panel-body">
    <p>Unhappy? <?php echo $this->Html->link('Cancel my accout', [], ['class'=>'btn btn-danger'], 'Are you sure?' ) ?></p>

    <?php echo $this->html->link('Back', [],['class'=>'back']) ?>
    <?php echo '<a href="'.$refer.'" class="back">Back</a>'; ?>  
  </div><!--/panel content-->
</div><!--/panel-->

