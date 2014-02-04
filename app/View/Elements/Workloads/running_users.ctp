<?php if($is_login && $isRunning):?>
<div class="table-responsive">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>User</th>
				<th>Time</th>
				<th>Project</th>
				<th>Issue</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($runningWorkloadLists as $workload):?>
			<tr>
				<td><a href="/users/<?php echo $workload['User']['id'] ?>"><?php echo $workload['User']['name']?></a></td>
				<td>
					<?php $s = time() - $workload['Workload']['start_at_time'];$h=0;$m=0; ?>
					<?php if((int)$current_user['User']['id'] === (int)$workload['User']['id']):?>
					<span class="my-counter"><?php while($s>=3600){$s-=3600;$h++;}while($s>=60){$s-=60;$m++;}echo"$h:$m:$s" ?></span>
					<?php else:?>
					<span><?php while($s>=3600){$s-=3600;$h++;}while($s>=60){$s-=60;$m++;}echo"$h:$m:$s" ?></span>
					<?php endif?>
				</td>
				<td><a href="/projects/<?php echo $workload['Project']['id'] ?>"><?php echo $workload['Project']['name']?></a></td>
				<td><a href="/issues/<?php echo $workload['Issue']['id'] ?>"><?php echo $workload['Issue']['subject']?></a></td>
			</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>
<?php endif ?>