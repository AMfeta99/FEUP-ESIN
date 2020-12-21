<?php
  require_once('config/init.php');
  require_once('database/doctor.php');

  $Department_name = $_GET['name'];
  $dep_number = $_GET['dep'];

  $Dname = $_GET["Dname"];

  $n_doctor = getNumberOfDoctorForDepartment($dep_number);
  $n_pages = ceil($n_doctor / 2); // round up
  if (isset($_GET['page'])) {
    $page = $_GET['page'];
    if ($page < 1) {
      $page = 1;
    } else if ($page > $n_pages) { // limit the increasing of page
      $page = $n_pages;
    }
  } else {
    $page = 1;
  }

  try {
    if (isset($Dname)) {
      $result = getDoctorBySearch($dep_number, $Dname);
    } else {
      $result = getDoctorInfo2($dep_number, $page);
    }
  } catch (PDOException $e) {
    echo $e->getMessage();
    $err = $e->getMessage();
  }

  include('templates/header.php');
  include('templates/list_doctors.php');
  include('templates/footer.php');

?>

