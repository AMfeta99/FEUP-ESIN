<?php
  require_once('config/init.php');
  require_once('database/doctor.php');
  $Department_name=$_GET['name'];
  $dep_number=$_GET['dep'];
  $Dname=$_GET["Dname"];

  if(isset($_GET['page'])){
    $page=$_GET["page"];
  
  }else{
    $page=1;
  }
  var_dump($Dname);
   $dep_number=(int)$dep_number;
  //  $page=(int)$page;

   var_dump($dep_number);
   var_dump($page);
  
  
  try{
    if(isset($Dname)){
      $result=getDoctorBySearch($dep_number,$Dname);
      print_r($result);
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

