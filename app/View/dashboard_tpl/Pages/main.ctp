<div class="col-md-12">
<div class="welcome">
<div class="jumbotron">
<h1>Timecard</h1>
<p class="lead">
Time tracking for your project.
</p>

<div class="row">
<div class="col-md-3 col-md-offset-2">
<?php echo $this->Html->link('Sign in with Github', ['controller'=>'auth', 'action'=>'github'], ['class'=>'btn btn-black btn-block'])  ?>
</div>
<div class="col-md-3">
<?php echo $this->Html->link('Sign in with Ruffnote', ['controller'=>'auth', 'action'=>'ruffnote'], ['class'=>'btn btn-primary btn-block'])  ?>
</div>
<div class="col-md-3">
<?php echo $this->Html->link('Sign up', ['controller'=>'users', 'action'=>'signUp'], ['class'=>'btn btn-default btn-block'])  ?>
</div>
</div>
</div>
<section>
<h2>
It is possible to time tracking in connection with the Github Issue.
</h2>
</section>
<section>
<h2>
Project owner can see at a glance the working hours of project members.
</h2>
</section>
</div>
</div>
