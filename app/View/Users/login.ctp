<?php echo $this->Form->create('BoostCake', array(
  'inputDefaults' => array(
    'div' => 'form-group',
    'wrapInput' => false,
    'class' => 'form-control'
  ),
  'class' => 'well'
)); ?>
    <legend>Sign in</legend>
    <?php echo $this->Form->input('text', array(
      'label' => 'Email'
    )); ?>
    <?php echo $this->Form->input('text', array(
      'label' => 'Password'
    )); ?>
    <?php echo $this->Form->input('checkbox', array(
      'type' => 'checkbox',
      'label' => 'Remember me',
      'class' => false
    )); ?>
    <?php echo $this->Form->submit('Sign in', array(
      'div' => false,
      'class' => 'btn btn-default'
    )); ?>
    <br/>
    <?php echo $this->Html->link('Sign up', array('controller'=>'Users', 'action'=>'login')); ?>
    <br/>
    <?php echo $this->Html->link('Forgot your password?', array('controller'=>'Users', 'action'=>'login')); ?>
    <br/>
    <?php echo $this->Html->link('Sign in with Gitub', array('controller'=>'Users', 'action'=>'login')); ?>
    <br/>
    <?php echo $this->Html->link('Sign in with Ruffnote', array('controller'=>'Users', 'action'=>'login')); ?>
<?php echo $this->Form->end(); ?>
