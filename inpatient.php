<?php require_once('config/init.php');
  $code=$_GET['code'];
  if($code){
    $_SESSION['inpatient']=$code;
  }
  
  require_once('database/inpatient.php');
  require_once('database/nurse.php');

  $msg_Med_imp=$_SESSION["msg_Med_imp"] ;
  unset($_SESSION["msg_Med_imp"] );

  $msg_inpatient=$_SESSION["msg_inpatient"] ;
  unset($_SESSION["msg_inpatient"] );

  try{
    $result = getInpatientByCode($code); 
    $result2 = getInpatientInfo($code);
    $result3 = getDoctorInpatient($code);
    $result4 = getBedDepartment($code);
    $result5 = getMedOfEachInpatient($code); // array of arrays
    $result6 = getReportsOfEachInpatient($code);
    
    $result_nurseD=getDepartmentOfEachNurse($_SESSION["user"]);
    $result7=getDoctorInpatient($code);
 
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