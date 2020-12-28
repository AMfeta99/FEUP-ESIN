<?php
require_once('config/init.php');
if(isset($_SESSION['funtion'])){ 
  if($_SESSION['funtion']=='Patient'){

    $patient_cc = $_GET['cc'];
    if($_SESSION['user']==  $patient_cc){

      $msg = $_SESSION["msg"];
      $msg_N = $_SESSION["msg_N"];

      unset($_SESSION["msg"]);
      unset($_SESSION["msg_N"]);
      unset($_SESSION["dep"]);
      unset($_SESSION["doctor_name"]);
      unset($_SESSION["doctor"]);
      unset($_SESSION["doctor_id"]);
      unset($_SESSION["date"]);
      unset($_SESSION["time"]);
      unset($_SESSION["week"]);
      unset($_SESSION["b"]);

      require_once('database/patient.php');
      require_once('database/notification.php');
      require_once('database/prescription.php');
      require_once('database/appointment.php');

      try {
        $result = getPatientById($patient_cc); // array of arrays
        $result2 =  getPatientAppointment($patient_cc); // date, diagnosis, doctor, speciality
        $result3 =  getPrescriptionsOfPatient($patient_cc);
        $result4 = getInpatientFromPatient($patient_cc);
        $result5 =  getPatientNotification($patient_cc);

      } catch (PDOException $e) {
        $err = $e->getMessage();
        exit(0);
      }

      // Define todays date
      date_default_timezone_set('Portugal/Lisbon');
      $today = date('Y-m-d');


?>
<?php
        include('templates/header_profile.php');
        include('templates/patient_menu.php');
        include('templates/footer.php');

        }else{ 
          $_SESSION["msg"]="Access to this page is not allowed!";
          header('Location:index.php');
          die();
        }
    }else{
    $_SESSION["msg"]="Access to this page is allowed just for Patients!";
    header('Location:index.php');
    die();
    }
}else{
$_SESSION["msg_log"]="Please Login first!";
header('Location:index.php#logins');
die();
}

?>

