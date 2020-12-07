<?php
  require_once('config/init.php');
  require_once('database/inpatient.php');
  
  try{
    $result = IsThatAInpatient($code); // array of arrays
  } catch(PDOException $e){
    $err = $e-> getMessage();
    exit(0);
  }
?>

<?php

  include('templates/header.php');
  include('templates/Inpatient_pag.php'); //ainda não tem nada aqui 
  include('templates/footer.php');

?>