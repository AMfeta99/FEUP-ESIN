<?php
  require_once('config/init.php');
  $msg=$_SESSION["msg"] ;
  unset($_SESSION["msg"] );

  $doctor_id=$_GET['id'];
  
  $msg_R=$_SESSION["msg_R"] ;
  unset($_SESSION["msg_R"]);

  require_once('database/doctor.php');
  try{
    $result = getDoctorById($doctor_id); 
    $result2 = getDepartmentOfEachDoctor($doctor_id);
    $result3= getDoctorAppointment($doctor_id);
    $result4= getDoctorReservation($doctor_id);
    $result_inpatient=getDoctorinpatient($doctor_id);
    $schedule= getDoctorSchedule($doctor_id);

  } catch(PDOException $e){
    $err = $e-> getMessage();
    exit(0);
  }

  function canMakeAppointment($schedule, $begin_hour, $day){
    foreach ($schedule as $row) {
      $time =  $row["begin_time"] . ' - ' . $row["end_time"];
      
      
      $begin_hour= date( "H:i", strtotime( $begin_hour) );
      
      if($row["week_day"] == $day && $row["begin_time"] == $begin_hour){
          echo "Doing Appointments";
      }

    }
  }
?>

<?php
  include('templates/header_profile.php');
  include('templates/menu_doctor.php');
  include('templates/footer.php');

?>