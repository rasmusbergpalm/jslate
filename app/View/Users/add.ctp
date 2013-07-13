<h2>Sign up</h2>
<?php
    echo $this->Form->create('User', array(
        'inputDefaults' => array(
            'label' => array(
                'class' => 'control-label'
            ),
            'div' => array(
                'class' => 'control-group'
            ),
            'error' => array(
                'attributes' => array('class'=>'help-inline')
            )
        )
    ));
    echo $this->Form->input('email');
    echo $this->Form->input('password');
    echo $this->Form->input('password2',array('label' => 'Confirm password', 'type' => 'password'));
    echo $this->Form->submit(__('Sign up'), array('class'=>'btn'));
    echo $this->Form->end();
?>