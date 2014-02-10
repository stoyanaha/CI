
<p>  
        <?php echo $this->session->flashdata('errmsg');  ?>
</p>

<div id="login">

    <fieldset><legend>LoGiN </legend>

        <?php
        echo form_open('login/validate');
        echo form_input('username',  set_value('username', 'name'));
        echo form_password('password', 'Password');
        echo form_submit('submit', 'Login');
        echo form_close();
        echo validation_errors('<p class="validation_err">' )
        ?>

    </fieldset>
    
    
    <?php echo anchor('login/register', 'neuer Benutzer register');  ?>




</div>



<?php
//$input_username = array(
//  'name' => 'username',
//  'value' => 'Username',
//  'id' => 'user_imput',
//  'class' => 'imput'
//);
//
//form_input($input_username);
//
?>



