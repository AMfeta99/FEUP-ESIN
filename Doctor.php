<?php
  require_once('config/init.php');

  if(isset($_SESSION['funtion'])){ 
   
    if($_SESSION['funtion']=='Doctor'){

      $doctor_id=$_GET['id'];
      $_SESSION["doctor_id"] = $doctor_id;

      if($_SESSION['user']== $doctor_id){

        require_once('database/doctor.php');
        $msg=$_SESSION["msg"] ;
        unset($_SESSION["msg"] );
        
        $msg_R=$_SESSION["msg_R"] ;
        unset($_SESSION["msg_R"]);

        $msg_H=$_SESSION["msg_H"] ;
        unset($_SESSION["msg_H"]);

        $msg_d=$_SESSION["msg_d"] ;
        unset($_SESSION["msg_d"]);

        try{
          $result = getDoctorById($doctor_id); 
          $result2 = getDepartmentOfEachDoctor($doctor_id);
          $result3= getDoctorAppointment($doctor_id);
          $result4= getDoctorReservation($doctor_id);

          $result_inpatient=getDoctorinpatient($doctor_id);
          $schedule= getDoctorSchedule($doctor_id);
          $numRowsSchedule = countNumbersOfRowsSchedule($doctor_id);

        } catch(PDOException $e){
          $err = $e-> getMessage();
          exit(0);
        }
?>

<?php
        include('templates/header_profile.php');
        include('templates/menu_doctor.php');
        include('templates/footer.php');   
        }else{
          $_SESSION["msg"]="Access to this page is not allowed!";
          header('Location:index.php');
          die();
        }
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