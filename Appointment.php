<?php
    require_once('config/init.php');
    require_once('database/doctor.php');
    require_once('database/department.php');

    
    $dep_number = $_POST['dep'];
    if($dep_number){
      $_SESSION["dep"]=$dep_number;
    }
    
    $doctor_id = $_POST['doctor'];
    if($doctor_id){
      $_SESSION["doctor"]=$doctor_id;
    }
    
    $date_select = $_POST['date'];
    if($date_select){
      $_SESSION["date"]=$date_select ;
    }

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
  $date_select="y-m-d";
?>

<?php
   include('templates/header_profile.php');
   include('templates/appointment_form.php');
   include('templates/footer.php');

?>
