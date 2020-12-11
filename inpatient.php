<?php
  require_once('config/init.php');
  $code=$_GET['code'];
  require_once('database/inpatient.php');

  try{
    $result = getInpatientByCode($code); 
    $result2 = getInpatientInfo($code);
    $result3 = getDoctorInpatient($code);
    $result4 = getBedDepartment($code);
    $result5 = getMedOfEachInpatient($code); // array of arrays
    $result6 = getReportsOfEachInpatient($code);
 
  } catch(PDOException $e){
    $err = $e-> getMessage();
    exit(0);
  }
?>

<?php 
  include('templates/header_profile.php');
  include('templates/inpatient_pag.php');
  include('templates/footer.php');
?>
