<?php
  // session_start();
  $msg=$_SESSION["msg"] ;
  unset($_SESSION["msg"] );

  $doctor_id=$_GET['id'];
  require_once('config/init.php');
  require_once('database/doctor.php');
  try{
    $result = getDoctorById($doctor_id); 
    $result2 = getDepartmentOfEachDoctor($doctor_id);

  } catch(PDOException $e){
    $err = $e-> getMessage();
    exit(0);
  }
?>

<?php
  include('templates/header_profile.php');
  include('templates/menu_doctor.php');
  include('templates/footer.php');

?>