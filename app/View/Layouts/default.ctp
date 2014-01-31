<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title><?php echo $title_for_layout; ?></title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js" type="text/javascript" ></script>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('bootstrap-theme.min');
		echo $this->Html->css('main');
		echo $this->Html->script('bootstrap.min');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body class="<?php echo strtolower($this->name)?>">
	<nav class="navbar navbar-default" role="navigation">
		<div class="container">
		    <div class="navbar-header">
		       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
		      </button>
		      <?php echo $this->Html->link("Timecard", '/projects', ['class'=>'navbar-brand', 'data-no-turbolink'=>1]); ?>
		    </div>
		    <div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav">
					<?php if($is_login):?>
					<li>
						<?php echo $this->Html->link("Projects", '/projects'); ?>
					</li>
					<li>
						<?php echo $this->Html->link("Me", '/dashboard'); ?>
					</li>
					<li>
						<?php echo $this->Html->link("Account settings", '/users/edit'); ?>
					</li>
					<li>
						<?php echo $this->Html->link("Import", '/data'); ?>
					</li>
					<li>
						<?php echo $this->Html->link("Logout", '/users/sign_out'); ?>
					</li>
					<?php else:?>
					<li>
						<?php echo $this->Html->link("Login", '/users/sign_in'); ?>
					</li>
					<?php endif; ?>
				</ul>
		    </div>
		</div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<div id="running-users">

				</div>
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->fetch('content'); ?>
			</div>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
