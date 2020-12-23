<?php
require_once('config/init.php');
$msg = $_SESSION["msg"];
unset($_SESSION["msg"]);

$msg_N = $_SESSION["msg_N"];
unset($_SESSION["msg_N"]);

$patient_cc = $_GET['cc'];
// $patient_email = $_SESSION['user'];
require_once('database/patient.php');

unset($_SESSION["dep"]);
unset($_SESSION["doctor_name"]);
unset($_SESSION["doctor"]);
unset($_SESSION["doctor_id"]);
unset($_SESSION["date"]);
unset($_SESSION["time"]);
unset($_SESSION["week"]);
unset($_SESSION["b"]);

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

?>

