<?php
	echo "<h1>Silahkan Login</h1>";
	echo validation_errors();
   	echo form_open('perpus/login');
    $data=array(
    		'name'	=> 'username',
    		'type'  => 'text',
    		'size'	=> '20',
    		'value'	=> set_value('username')
    );
    echo form_label('Username: ', 'username');
    echo form_input($data);
    echo "<br/>";
    $data=array(
    		'name'	=> 'password',
    		'type'  => 'password',
    		'size'	=> '20',
    		'value'	=> set_value('password')
    );
    echo form_label('Password: ', 'password');
    echo form_input($data);
    echo "<br/>";
    echo form_submit('btn_simpan','Login');
    echo form_close();
?>