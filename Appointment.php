<?php
    require_once('config/init.php');
    require_once('database/doctor.php');
    require_once('database/department.php');

    $dep_number = $_POST['dep'];
    try{
      $result =  getListDepartments();
      $result2 = getDoctorInfo($dep_number);
    } catch(PDOException $e){
      $err = $e-> getMessage();
      exit(0);
    }  
?>
<?php

  $i=0;

?>

<?php
   include('templates/header_profile.php');
   include('templates/appointment_form.php');
   include('templates/footer.php');

?>
