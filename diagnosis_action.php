<?php require_once('config/init.php');

$disease=$_POST["disease_name"];
$disease = strtolower($disease); 

$id_appointment=$_SESSION["appointment"];

function check_disease($disease){
    global $dbh;
    $stmt = $dbh->prepare("SELECT * FROM Disease
                            WHERE Disease.name = ?");

    $stmt->execute(array($disease));
    return $stmt->fetch();
}

function InsertAppointmentDiagnosis($id_appointment,$disease){
    global $dbh;
    $stmt= $dbh->prepare("INSERT INTO AppointmentDiagnosis (id_appointment, disease)  VALUES (?,?)");
    $stmt->execute(array($id_appointment,$disease));
}

if(strlen($disease)==0){
    $_SESSION["msg_disease"]=" Please insert the diagnosed disease !";
    header('Location: appointment_info.php');
    die();
}
 try{
    if(check_disease($disease)){
        $disease_result=check_disease($disease);
        $id_disease= $disease_result["id"];

   
        InsertAppointmentDiagnosis($id_appointment,$id_disease);
        $_SESSION["msg_disease"]="Insert of diagnosis successful !";
        header('Location: appointment_info.php');   
    }else{
        $_SESSION["msg_disease"]="There is no such disease !";
        header('Location: appointment_info.php');}
    }catch(PDOException $e){
        
        if(strpos($e->getMessage(), "UNIQUE")){
            $_SESSION["msg_disease"]="This disease was already diagnosed";
         }
         else{
            $_SESSION["msg_disease"]="Diagnosis fail!";
        }
        header('Location: appointment_info.php');
    }
?>