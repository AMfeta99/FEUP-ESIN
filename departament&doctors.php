<?php
  require_once('config/init.php');
  require_once('database/doctor.php');
  $Department_name=$_GET['name'];
  $dep_number=$_GET['dep'];
  $Dname=$_GET["Dname"];

  $n_doctor = getNumberOfDoctorForDepartment($dep_number);
  $n_pages = ceil($n_doctor / 2); // round up
  if(isset($_GET['page'])){
    $page=$_GET['page'];
    if($page <1){
      $page = 1;
    }
    else if($page > $n_pages) {
      $page = $n_pages;
    }
    // limit the increasing of page
  
  }else{
    $page=1;
  }
  var_dump($Dname);
   $dep_number=(int)$dep_number;
   $page=(int)$page;

   var_dump($dep_number);
   var_dump($page);
  
  
  try{
    if(isset($Dname)){
      $result=getDoctorBySearch($dep_number,$Dname);
      // print_r($result);
    }else{
      $result = getDoctorInfo2($dep_number,$page); // array of arrays
    }
   
    // $result = getDoctorInfo($dep_number); // array of arrays
  } catch(PDOException $e){
    echo $e-> getMessage();
    $err = $e-> getMessage();
   
  }
?>

<?php

  include('templates/header.php');
  include('templates/list_doctors.php');
  include('templates/footer.php');

?>

