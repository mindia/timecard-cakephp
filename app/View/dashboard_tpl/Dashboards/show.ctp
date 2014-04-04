<?php $this->Html->script( 'workloads', array( 'inline' => false ) ); ?>

<a href="#"><strong><i class="glyphicon glyphicon-dashboard"></i> Work Hours Report</strong></a>  
<hr>

<input type="hidden" name="user-name" id="user-name" data-user-id="<?php echo $current_user_id; ?>" value="<?php echo $current_user_name; ?>">
<ul class="nav nav-tabs">
	<?php foreach($this->Dashboard->getThisWeekDays() as $val):?>
	<li class="<?php if($val === date('Y-m-d')):?>active<?php endif?>">
		<a href="#" class="js-workloads-on-day-link" data-day="<?php echo date('d',strtotime($val)) ?>" data-month="<?php echo date('n',strtotime($val)) ?>" data-year="<?php echo date('Y',strtotime($val)) ?>" href="#"><?php echo $val ?></a>
	</li>
	<?php endforeach ?>
</ul>

<table class="table table-workload-complete">
	<thead>
		<th>Project</th>
		<th>Issue</th>
		<th>Work Hours</th>
		<th>Time</th>
	</thead>
	<tbody>

	</tbody>
</table>
