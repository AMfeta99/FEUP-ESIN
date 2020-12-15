<?php require_once('config/init.php');
// session_start();
  
  $msg=$_SESSION["msg"] ;
  unset($_SESSION["msg"] );

?> 
<?php

  include('templates/header_register.php');
  include('templates/register_doctor.php'); 
  include('templates/footer.php');
?>