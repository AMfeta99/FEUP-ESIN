<?php
    require_once('config/init.php');
    require_once('database/doctor.php');
    require_once('database/department.php');

    $msg=$_SESSION["msg"];
    unset($_SESSION["msg"]);
    
    $dep_name = $_POST['dep'];
    if($dep_name){
      $_SESSION["dep"]=$dep_name;
      unset($_SESSION["doctor_name"]);
    }
    
    $doctor_id_name = $_POST['doctor'];
    $doctor = explode("|", $_POST['doctor'] );
    if($doctor_id_name){
      $_SESSION["doctor"] = $doctor_id_name;
      $_SESSION["doctor_name"]=$doctor[1];
      $_SESSION["doctor_id"] = $doctor[0];
    }
    
    $date_select = $_POST['date'];
    if($date_select){
      $_SESSION["date"]=$date_select ;
    }

    try{
      $result =  getListDepartments();
      $result2 = getDoctorInfoByDepName($dep_name);
      
      
    } catch(PDOException $e){
      $err = $e-> getMessage();
      exit(0);
    }  
?>


<?php
   include('templates/header_profile.php');
   include('templates/appointment_form.php');
   include('templates/footer.php');

   
?>
