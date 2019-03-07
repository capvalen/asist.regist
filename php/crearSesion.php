<?php
header('Content-Type: text/html; charset=utf8');
if( $_POST['usuario']=='admin' && $_POST['pw']=='pcash'){
	$expira=time()+60*30; //sesion de 30min
	setcookie('ckUsuario', $_POST['usuario'], $expira, '/');
   echo 1;
}
?>