<?php
  require_once('config/init.php');
  require_once('database/bed.php');
  require_once('database/nurse.php');
  // require_once('database/department.php');

  if(isset($_SESSION['funtion'])){ 
    if($_SESSION['funtion']=='Nurse'){
      
    $nurse_id=$_GET['id'];

    if($_SESSION['user']== $nurse_id){

      $msg=$_SESSION["msg"] ;
      
      unset($_SESSION["msg"] );
      
      
      
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

        }else{ 
          $_SESSION["msg"]="Access to this page is not allowed!";
          header('Location:index.php');
          die();
        }
      }else{
        $_SESSION["msg"]="Access to this page is allowed just for Nurses!";
        header('Location:index.php');
        die();
      }
}else{
$_SESSION["msg_log"]="Please Login first!";
header('Location:index.php#logins');
die();
}
?>

  