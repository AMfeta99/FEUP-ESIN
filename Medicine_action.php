<?php require_once('config/init.php');
require_once('database/patient.php');
require_once('database/prescription.php');
require_once('database/medicine.php');

$dname=$_POST["Medicine_name"];
$dname = strtolower($dname); 

$Dose=$_POST["dose"];
$quantity=$_POST["quantity"];


$date_limit=$_POST["date_limit"];

$id_appointment=$_SESSION["appointment_id"];

$result=getPatientAppointmentbyID($id_appointment);
$date=$result["date"];


if(strlen($dname)==0){
    $_SESSION["msg_p"]=" Please insert the name of the Medicine !";
    header('Location: appointment_info.php');
    die();
}

 try{
    
    if(check_Medicine($dname,$Dose)){
        $Medicine_result=check_Medicine($dname,$Dose);
        $Medicine_code= $Medicine_result["code"];

        if($date_limit>$date){
            if($quantity>=1){

            InsertAppointmentPrescription ($date,$date_limit,$id_appointment);
            $Result_idAP=getAppointmentPrescriptionId($date,$date_limit,$id_appointment);

            $id_Prescription= $Result_idAP["id"];
            InsertPrescriptionOfMedicine ($id_Prescription,$Medicine_code,$quantity);
            $_SESSION["msg_p"]="Insert of Prescription successful !";
            header('Location: appointment_info.php'); 
        
            }else{
                $_SESSION["msg_p"]="Quantity need to be more than 1 !";
                header('Location: appointment_info.php');}
        }else{
            $_SESSION["msg_p"]="Date limit has to be after date!";
            header('Location: appointment_info.php');}

    }else{
        $_SESSION["msg_p"]="There is no such medicine";
        header('Location: appointment_info.php');}
    }catch(PDOException $e){
        echo $e->getMessage();
        $_SESSION["msg_p"]="Prescription Of Medicine fail!";
        header('Location: appointment_info.php');
    }
?>