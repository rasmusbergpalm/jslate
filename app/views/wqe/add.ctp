<div class="dashboardsItems form">
<?php echo $this->Form->create('DashboardsItem');?>
	<fieldset>
		<legend><?php __('Add Dashboards Item'); ?></legend>
	<?php
		echo $this->Form->input('dashboard_id');
		echo $this->Form->input('item_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Dashboards Items', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Dashboards', true), array('controller' => 'dashboards', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Dashboard', true), array('controller' => 'dashboards', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>