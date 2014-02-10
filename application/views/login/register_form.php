<style type="text/css">
p.validation_err{
    color: red;
    font:bold 14px;
    margin: 1px 0 5px;
    
}

fieldset{
    width: 300px;
    margin: 0;
    margin-left: 10px;
    padding: 0 50px;
    background-color: #D0D0D0;
    
}

input{
    width: 270px;
    padding: 5px 2px;
    font-size: 15px;
}
    
 </style>

<?php



$username = array(
  'name' => 'username',
  'id' => 'username',
  'value' => set_value('username')
);

$password = array(
  'name' => 'password',
  'id' => 'password',
);

$password2 = array(
  'name' => 'password2',
  'id' => 'password2',
);

$email = array(
  'name' => 'email',
  'id' => 'email',
  'value' => set_value('email')
);


echo form_open('login/vaidate_register');
echo form_fieldset('Register neuer Benutzer');
?>

<dl>
    <dt><?php echo form_label('username', $username['name']); ?></dt>
    <dd> <?php echo form_input($username); ?> 

        <?php
        // Vika greshkata samo za input poleto username
        echo form_error($username['name']);
        ?>
    </dd>
    
    
    <dt><?php echo form_label('password', $password['name']); ?></dt>
    <dd> <?php echo form_input($password); ?> 

        <?php
        // Vika greshkata samo za input poleto username
        echo form_error($password['name']);
        ?>
    </dd>
    
     <dt><?php echo form_label('Bestätige password', $password2['name']); ?></dt>
    <dd> <?php echo form_input($password2); ?> 

        <?php
        // Vika greshkata samo za input poleto username
        echo form_error($password2['name']);
        ?>
    </dd>
    
    
     <dt><?php echo form_label('Email', $email['name']); ?></dt>
    <dd> <?php echo form_input($email); ?> 

        <?php
        // Vika greshkata samo za input poleto username
        echo form_error($email['name']);
        ?>
    </dd>
    
    <dd> <?php echo form_submit('register', 'neuer benutzer registrieren')   ?></dd>


</dl>

<?php
echo form_fieldset_close();
echo form_close();
?>



