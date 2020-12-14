<?php
  require_once('config/init.php');
  $msg=$_SESSION["msg"] ;
  unset($_SESSION["msg"] );

  $doctor_id=$_GET['id'];
  // require_once('config/init.php');
  require_once('database/doctor.php');
  try{
    $result = getDoctorById($doctor_id); 
    $result2 = getDepartmentOfEachDoctor($doctor_id);
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
  include('templates/header.php');
  include('templates/doctor_info.php');
  include('templates/footer.php');

?>