<div class="dashboardsItems index">
	<h2><?php __('Dashboards Items');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('dashboard_id');?></th>
			<th><?php echo $this->Paginator->sort('item_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($dashboardsItems as $dashboardsItem):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $dashboardsItem['DashboardsItem']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($dashboardsItem['Dashboard']['name'], array('controller' => 'dashboards', 'action' => 'view', $dashboardsItem['Dashboard']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($dashboardsItem['Item']['name'], array('controller' => 'items', 'action' => 'view', $dashboardsItem['Item']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $dashboardsItem['DashboardsItem']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $dashboardsItem['DashboardsItem']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $dashboardsItem['DashboardsItem']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $dashboardsItem['DashboardsItem']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Dashboards Item', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Dashboards', true), array('controller' => 'dashboards', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Dashboard', true), array('controller' => 'dashboards', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>