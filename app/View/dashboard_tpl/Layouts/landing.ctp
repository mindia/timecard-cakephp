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
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('font-awesome.min');
		echo $this->Html->script('bootstrap.min');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body class="<?php echo strtolower($this->name)?>">
	<div class="container-full">
		<div class="row">
			<div class="col-lg-12 text-center v-center">
			<h1>Hello Landing</h1>
			<p class="lead">A sign-up page example for Bootstrap 3</p>
			<br><br><br>
			<form class="col-lg-12">
			<div class="input-group" style="width:340px;text-align:center;margin:0 auto;">
			<input class="form-control input-lg" title="Don't worry. We hate spam, and will not share your email with anyone." placeholder="Enter your email address" type="text">
			<span class="input-group-btn"><button class="btn btn-lg btn-primary" type="button">OK</button></span>
			</div>
			</form>
			</div>
		</div> <!-- /row -->

		<div class="row">
			<div class="col-lg-12 text-center v-center" style="font-size:39pt;">
			<a href="#"><i class="icon-google-plus"></i></a> <a href="#"><i class="icon-facebook"></i></a>  <a href="#"><i class="icon-twitter"></i></a> <a href="#"><i class="icon-github"></i></a> <a href="#"><i class="icon-pinterest"></i></a>
			</div>
		</div>
	</div> <!-- /container full -->

	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<div id="running-users">
					<?php echo $this->element('Workloads/running_users'); ?>
				</div>
				<?php echo $this->Session->flash('provider'); ?>
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->fetch('content'); ?>
			</div>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
