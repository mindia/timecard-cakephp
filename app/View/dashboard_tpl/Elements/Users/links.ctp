<ul class="nav nav-pills nav-stacked">
	<?php if ($action == 'password'): ?>
	<li><?php echo $this->Html->link('Sign in', ['controller'=>'users', 'action'=>'sign_in'] )  ?></li>
	<?php endif; ?>
	<li><?php echo $this->Html->link('Sign up', ['controller'=>'users', 'action'=>'sign_up'] )  ?></li>
	<?php if ($action != 'password'): ?>
	<li><?php echo $this->Html->link('Forgot your password', ['controller'=>'users', 'action'=>'password'] )  ?></li>
	<?php endif; ?>
	<?php foreach ($auth as $auth_key => $value ): ?>
	<li><?php echo $this->Html->link('Sign in with ' . $auth_key , ['controller'=>'auth', 'action'=> strtolower($auth_key) ]  ) ?></li>
	<?php endforeach;  ?>
</ul>
