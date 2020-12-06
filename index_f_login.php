<?php
   $patient_cc=$_GET['cc'];
  require_once('config/init.php');
  require_once('database/patient.php');

  try{
    $result = getPatientById($patient_cc); // array of arrays
  } catch(PDOException $e){
    $err = $e-> getMessage();
    exit(0);
  }

?>
<?php
    include('templates/header_profile.php');
    include('templates/patient_menu.php');
    include('templates/footer.php');

?>

