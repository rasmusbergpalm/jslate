<div class="dashboards form">
    <h3>Public link (read only)</h3>
    <?php echo Router::url(array('action' => 'readonly', $this->request->data['Dashboard']['public_id']), true); ?>
    <br />
    <br />
    <h3>Change name</h3>
    <?php echo $this->Form->create('Dashboard');?>
        <?php
            echo $this->Form->input('name');
        ?>
    <?php echo $this->Form->end(__('Submit'));?>
</div>
