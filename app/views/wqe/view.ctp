<div class="dashboardsItems view">
<h2><?php  __('Dashboards Item');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $dashboardsItem['DashboardsItem']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Dashboard'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($dashboardsItem['Dashboard']['name'], array('controller' => 'dashboards', 'action' => 'view', $dashboardsItem['Dashboard']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Item'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($dashboardsItem['Item']['name'], array('controller' => 'items', 'action' => 'view', $dashboardsItem['Item']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Dashboards Item', true), array('action' => 'edit', $dashboardsItem['DashboardsItem']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Dashboards Item', true), array('action' => 'delete', $dashboardsItem['DashboardsItem']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $dashboardsItem['DashboardsItem']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Dashboards Items', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Dashboards Item', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Dashboards', true), array('controller' => 'dashboards', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Dashboard', true), array('controller' => 'dashboards', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>
