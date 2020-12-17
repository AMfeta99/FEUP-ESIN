<?php  require_once('config/init.php');
       require_once('database/inpatient.php');
    
    $code=$_POST["code"];
    
    if(getInpatientByCode($code)){
    $_SESSION["msg_inpatient"]="welcome! here you can consult the status of a family member or friend who is hospitalized.";
    header("Location: inpatient.php?code=$code"); 
    
    }else{
        $_SESSION["msg_inpatient"]="Something goes wrong :(. There is no such Inpatient";
        header('Location: index.php#inpatient');
    } 
?>