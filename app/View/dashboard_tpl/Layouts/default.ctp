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
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js" type="text/javascript" ></script>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('compiled/application');
		echo $this->Html->css('dashboard_tpl/bootstrap.min');
		echo $this->Html->css('dashboard_tpl/bootstrap-glyphicons');
		echo $this->Html->script('bootstrap.min');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body class="<?php echo strtolower($this->name)?>">
	<!-- Header -->
	<div id="top-nav" class="navbar navbar-inverse navbar-static-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon-toggle"></span>
				</button>

				<?php echo $this->Html->link("Timecard", '/', ['class'=>'navbar-brand', 'data-no-turbolink'=>1]); ?>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
			        
					<li class="dropdown">
						<a class="dropdown-toggle" role="button" data-toggle="dropdown" href="#">
					    		<i class="glyphicon glyphicon-user"></i> <?php if($is_login):?><?php echo $current_user['User']['name'] ?><?php else:?>Guest<?php endif; ?> <span class="caret"></span>
						</a>
						<ul id="g-account-menu" class="dropdown-menu" role="menu">
						<?php if($is_login):?>
							<li>
							<?php echo $this->Html->link("Account settings", '/users/edit'); ?>
							</li>
							<li>
							<a href="/users/sign_out"><i class="glyphicon glyphicon-lock"></i> Logout</a>
							</li>
							<?php else:?>
							<li>
							<?php echo $this->Html->link("Projects", '/projects'); ?>
							</li>
							<li>
							<?php echo $this->Html->link("Login", '/users/sign_in'); ?>
							</li>
						<?php endif; ?>
						</ul>
					</li>
				</ul>
			</div>
		</div><!-- /container -->
	</div>
	<!-- /Header -->
	<div class="container">
		<div class="row">
			<?php if( $isSideMenu ):?>
			<div class="col-md-2">
				<!-- left -->
				<a href="#"><strong><i class="glyphicon glyphicon-briefcase"></i> Toolbox</strong></a>
				<hr>
				<ul class="nav nav-pills nav-stacked">
					<li><a href="/projects"><i class="glyphicon glyphicon-list-alt"></i> Project</a></li>
					<?php if($is_login):?>
					<li><a href="/dashboard"><i class="glyphicon glyphicon-dashboard"></i> Me</a></li>
					<li><a href="/dashboard/realtime"><i class="glyphicon glyphicon-time"></i> Real-time</a></li>
					<?php endif; ?>
					<!--<li><a href="#"><i class="glyphicon glyphicon-list-alt"></i> Reports</a></li>
					<li><a href="#"><i class="glyphicon glyphicon-book"></i> Books</a></li>
					<li><a href="#"><i class="glyphicon glyphicon-briefcase"></i> Tools</a></li>
					<li><a href="#"><i class="glyphicon glyphicon-time"></i> Real-time</a></li>
					<li><a href="#"><i class="glyphicon glyphicon-plus"></i> Advanced..</a></li>-->
				</ul>
				<hr>
			</div><!-- /span-2 -->
			<?php endif?>

			<div class="<?php if( $isSideMenu ):?>col-md-10<?php else:?>col-md-12<?php endif?>">
				<?php echo $this->Session->flash('provider'); ?>
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->fetch('content'); ?>
			</div>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
