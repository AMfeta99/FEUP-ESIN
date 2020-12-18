<?php
  require_once('config/init.php');
  require_once('database/doctor.php');
  $Department_name=$_GET['name'];
  $dep_number=$_GET['dep'];
  $Dname=$_GET["Dname"];

  if(isset($_GET['page'])){
    $page=$_GET['page'];
  
  }else{
    $page=1;
  }
  
  
  try{
    if(isset($Dname)){
      // $result=getDoctorBySearch($dep_number,$Dame);
    }else{
      // $result = getDoctorInfo($dep_number,$page); // array of arrays
    }
   
    $result = getDoctorInfo($dep_number); // array of arrays
  } catch(PDOException $e){
    $err = $e-> getMessage();
    exit(0);
  }
?>

<?php

  include('templates/header.php');
  include('templates/list_doctors.php');
  include('templates/footer.php');

?>

