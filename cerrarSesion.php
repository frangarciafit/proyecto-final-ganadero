<?php 
  unset($_COOKIE['usuarioLogeado']); 
  setcookie('usuarioLogeado', null, -1, '/'); 

  header("Location: login.php");
  die;
?>