<?php
  
  require_once('config/init.php');
  $msg=$_SESSION["msg"] ;
  unset($_SESSION["msg"] );

  // require_once('config/init.php');

?> 
<?php

  include('templates/header_register.php');
  include('templates/register_pag.php'); // content
  include('templates/footer.php');
?>
