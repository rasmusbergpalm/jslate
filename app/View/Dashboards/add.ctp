<h2><?php echo __('Add Dashboard'); ?></h2>
<div class="dashboards form">
    <?php echo $this->Form->create('Dashboard');?>
	<?php echo $this->Form->input('name'); ?>
    <?php echo $this->Form->submit(__('Save'), array('class'=>'btn')); ?>
    <?php echo $this->Form->end(); ?>
</div>