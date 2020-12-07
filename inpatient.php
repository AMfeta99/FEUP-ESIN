<?php
  $code=$_GET['code'];
  require_once('config/init.php');
  require_once('database/inpatient.php');
  

  try{
    $result = getInpatientByCode($code); // array of arrays
    $result2 = getInpatientInfo($code);
  } catch(PDOException $e){
    $err = $e-> getMessage();
    exit(0);
  }
?>

<?php

  include('templates/header_profile.php');
  include('templates/inpatient_pag.php'); //ainda não tem nada aqui 
  include('templates/footer.php');

?>