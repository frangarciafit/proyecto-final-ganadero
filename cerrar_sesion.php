<?php 
  unset($_COOKIE['usuario_logeado']); 
  setcookie('usuario_logeado', null, -1, '/'); 

  header("Location: login.php");
  die;
?>