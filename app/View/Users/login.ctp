<h2>Login</h2>
<?php
    echo $this->Form->create('User');
    echo $this->Form->input('email');
    echo $this->Form->input('password');
    echo $this->Form->submit(__('Login'), array('class'=>'btn'));
    echo $this->Form->end();
?>
