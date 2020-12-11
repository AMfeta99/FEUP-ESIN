<?php
    require_once('config/init.php');
    require_once('database/inpatient.php');
    

    $code=$_POST["code"];


    // #verify if is There is a Inpatient with this Code
    // function IsThatAInpatient($code){
    //     global $dbh;
    //     $stmt=$dbh->prepare("SELECT Inpatient.code FROM Inpatient 
    //                          JOIN Patient ON Inpatient.patient=Patient.cc
    //                          WHERE Inpatient.code=?");
    //     $stmt->execute(array($code));
    //     return $stmt->fetch();
    // }
    
    if(getInpatientByCode($code)){
        header("Location: inpatient.php?code=$code");
        //header("location: ", $_SERVER['HTTP_REFERER']);
    }
    else{
        $_SESSION["msg_inpatient"]="Something goes wrong :(. There is no such Inpatient";
    }
    

?>
  