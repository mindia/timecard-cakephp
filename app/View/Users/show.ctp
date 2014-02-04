<div class="row">
<div class="col-md-3">
<div class="avatar">
	<?php echo $this->Html->image('https://www.gravatar.com/avatar/'.md5($user['User']['email']).'/?s=220', ['height' => '220', 'width' => '220']) ?>
</div>
<h1><?php echo $user['User']['name'] ?></h1>
<hr>
<ul class="info">
	<li>
	Email - <?php echo $user['User']['email'] ?>
	</li>
	<?php if ($github) :?>
		<li>
		GitHub - <?php echo $this->Html->link($github['Authentication']['username'], "https://github.com/".$github['Authentication']['username']) ?>
		</li>
	<?php endif ?>
</ul>
</div>
</div>