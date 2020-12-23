<?php
  require_once('config/init.php');

  if(isset($_SESSION['funtion'])){ 
   
    if($_SESSION['funtion']=='Doctor'){

      $appointment=$_SESSION["appointment"];
      $cc=$_SESSION["patient_cc"];
      $msg_disease=$_SESSION["msg_disease"];
      $msg_p=$_SESSION["msg_p"];

      unset($_SESSION["msg_disease"]);
      unset($_SESSION["msg_p"]);

      require_once('database/patient.php');
      
      try{
        $result=getPatientById($cc);
        $result2=getPatientAppointmentbyID($appointment);
        $result3=getPatientAppointment($cc);
      

      } catch(PDOException $e){
        $err = $e-> getMessage();
        exit(0);
      }
?>

<?php
      include('templates/header_profile.php');
      include('templates/add_appointment_info.php');
      include('templates/footer.php');

    }else{ 
      $_SESSION["msg"]="Access to this page is allowed just for Doctors!";
      header('Location:index.php');
      die();
    }
}else{
$_SESSION["msg_log"]="Please Login first!";
header('Location:index.php#logins');
die();
}

?>