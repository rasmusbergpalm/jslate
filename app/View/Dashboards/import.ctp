<h2><?php echo __('Import Dashboard'); ?></h2>
<div class="dashboards form">
    <?php echo $this->Form->create('Dashboard', array('type' => 'file'));?>
	<?php echo $this->Form->file('Dashboard.import'); ?>
    <?php echo $this->Form->submit(__('Import'), array('class'=>'btn')); ?>
    <?php echo $this->Form->end(); ?>
</div>