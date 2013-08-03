<h2>Add MySQL data source</h2>
<?php echo $this->Form->create('Source'); ?>
    <?php
        echo $this->Form->input('name');
        echo "<h3>Properties</h3>";
        echo $this->Form->input('Sourceproperty.host');
        echo $this->Form->input('Sourceproperty.user');
        echo $this->Form->input('Sourceproperty.password');
        echo $this->Form->input('Sourceproperty.database');
    ?>
<?php
    echo $this->Form->submit(__('Save'), array('class'=>'btn'));
    echo $this->Form->end();
?>