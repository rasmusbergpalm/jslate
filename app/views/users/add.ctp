<h2>Sign up</h2>
<?php
        echo $this->Form->create('User');
        echo $this->Form->input('email');
        echo $this->Form->input('password');
        echo $this->Form->input('password2',array('label' => 'Confirm password', 'type' => 'password'));
        echo $this->Form->end('Sign up');
?>