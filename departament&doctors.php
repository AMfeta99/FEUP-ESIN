<?php

  $Department_name=$_GET['name'];
  $dep_number=$_GET['dep'];
  require_once('config/init.php');
  require_once('database/doctor.php');
  try{
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

