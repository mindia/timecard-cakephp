<?php if ($action == 'password'): ?>
  <?php echo $this->Html->link('Sign in', ['controller'=>'users', 'action'=>'sign_in'] )  ?><br/>
<?php endif; ?>

  <?php echo $this->Html->link('Sign up', ['controller'=>'users', 'action'=>'sign_up'] )  ?><br/>

<?php if ($action != 'password'): ?>
  <?php echo $this->Html->link('Forgot your password', ['controller'=>'users', 'action'=>'password'] )  ?><br/>
<?php endif; ?>

<?php foreach ($auth as $auth_key => $value ): ?>
  <?php echo $this->Html->link('Sign in with ' . $auth_key , ['controller'=>'auth', 'action'=> strtolower($auth_key) ]  ) ?><br/>
<?php endforeach;  ?>
