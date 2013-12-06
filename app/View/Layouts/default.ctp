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

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('bootstrap.min');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body class="<?php echo $this->name ?>" data-timer="" >
	<nav class="navbar navbar-default" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1=collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<?php echo $this->Html->link("Timecard", '/', array('class'=> 'navbar-brand', 'data-no-turbolink'=>'1')); ?>
			</div>
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav">
					<?php if ($user_signed_in): ?>
						<li><?php echo $this->Html->link("Project", '/projects'); ?></li>
						<li><?php echo $this->Html->link("Me", '/projects'); ?></li>
						<li><?php echo $this->Html->link("Account setting", '/projects'); ?></li>
						<li><?php echo $this->Html->link("Import", '/projects'); ?></li>
						<li><?php echo $this->Html->link("Logout", '/projects', array('method'=>'delete')); ?></li>
					<?php else: ?>
						<li><?php echo $this->Html->link("Login", '/projects'); ?></li>
					<?php endif;?>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container">
		<div class="row">
			<div id='header'></div>
			<div class="col-lg-12 col-md-12">
				<div id="running-user"><?php echo $this->element('running') ?></div>
				<?php if ($notice): ?><div class="aler alert-success"><?php echo $notice ?><?php endif;?></div>
				<?php if ($alert): ?><div class="aler alert-danger"><?php echo $alert ?><?php endif; ?></div>
				<?php echo $this->fetch('content'); ?>
			</div>
		<div id="content">
		</div>
		<div id="footer">
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
