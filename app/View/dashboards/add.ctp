<div class="dashboards form">
<?php echo $this->Form->create('Dashboard');?>
	<fieldset>
		<legend><?php echo __('Add Dashboard'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>