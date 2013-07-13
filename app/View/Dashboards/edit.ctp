<h2> Edit dashboard </h2>
<div class="dashboards form">
    <h4>Public link (read only)</h4>
    <?php echo Router::url(array('action' => 'readonly', $this->request->data['Dashboard']['public_id']), true); ?>
    <h4>Change name</h4>
    <?php echo $this->Form->create('Dashboard');?>
    <?php echo $this->Form->input('name'); ?>
    <?php echo $this->Form->submit(__('Save'), array('class'=>'btn')); ?>
    <?php echo $this->Form->end(); ?>
</div>
