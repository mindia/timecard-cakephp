<?php $this->Html->script( 'home', array( 'inline' => false ) ); ?>
<?php $this->Html->script( 'issues', array( 'inline' => false ) ); ?>
<div id="page">
  <?php if(count($projects) > 0):?>
  <ul class="nav nav-pills project-nav">
    <?php foreach($projects as $key=>$val):?>
      <li id="project-<?php echo $val['Project']['id']?>" class="<?php if($key==0):?>active<?php endif ?>">
        <a href="#users/<?php echo $current_user['User']['id']?>/projects/<?php echo $val['Project']['id']?>/issues/open">
          <?php echo h($val['Project']['name'])?>
          <span class="badge"><?php echo h($val[0]['issues_count'])?></span>
        </a>
      </li>
    <?php endforeach ?>
  </ul>
  <hr>
  <div class="btn-group btn-group-sm" style="margin-bottom:10px">
    <a href="/issues/?project_id=<?php echo $projects[0]['Project']['id']?>&status=open" class="btn btn-default btn-iss-status" data-remote="true">Open</a>
    <a href="/issues/?project_id=<?php echo $projects[0]['Project']['id']?>&status=closed" class="btn btn-default btn-iss-status" data-remote="true">Closed</a>
    <a href="/issues/?project_id=<?php echo $projects[0]['Project']['id']?>&status=not_do_today" class="btn btn-default btn-iss-status" data-remote="true">Don't do today</a>
  </div>
  <?php endif ?>
  <div id="issues" class="media-list">
  </div>
</div>