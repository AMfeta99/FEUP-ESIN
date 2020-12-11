<?php
  //  session_start();
   $msg=$_SESSION["msg"] ;
   unset($_SESSION["msg"] );

  $nurse_id=$_GET['id'];
  require_once('config/init.php');
  require_once('database/nurse.php');
  require_once('database/department.php');
  
  try{
    $result = getNurseById($nurse_id); 
    $result2 = getDepartmentOfEachNurse($nurse_id);
    
    $dep_id=$result2["dep_id"];
    $result3=getInpatientofDepartment($dep_id);
    $result4=getDepartmentOfAppointment($dep_id);

    $result_Tbeds=getDepTotalNumberBed($dep_id);
    $result_Occupybeds=getDepNumberBedOccupy($dep_id);

  } catch(PDOException $e){
    $err = $e-> getMessage();
    exit(0);
  }
?>

<?php
    include('templates/header_profile.php');
    include('templates/menu_nurse.php');
    include('templates/footer.php');

?>

  