<?php
    require_once('config/init.php');

    $prescription_id= $_GET['id'];
    require_once('database/prescription.php');

    try{
        $prescInfo = getPrescriptionInfo($prescription_id); // id, date-limit, appointment
        $doctor= getDoctorFromPrescription($prescription_id);
        $medications = getMedicationFromPrescription($prescription_id);

    }
    catch(PDOException $e){
        $err = $e-> getMessage();
        exit(0);
    }
?>
<?php
  include('templates/header_profile.php');
  include('templates/prescription.php');
  include('templates/footer.php');

?>