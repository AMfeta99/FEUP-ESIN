<?php require_once('config/init.php');
require_once('database/patient.php');

$dname=$_POST["Medicine_name"];
$name = strtolower($dname); 

$dose=$_POST["dose"];
$instrutions=$_POST["instrutions"];
$inpatient= $_POST['inpatient'];


function check_Medicine($name,$dose){
    global $dbh;
    $stmt = $dbh->prepare("SELECT * FROM Medicine
                            WHERE Medicine.name = ? and Medicine.dose=?");

    $stmt->execute(array($name,$dose));
    return $stmt->fetch();
}

function InsertMedicine($name, $dose, $instrutions){
    global $dbh;
    $stmt = $dbh->prepare("INSERT INTO  Medicine ( name, dose, instructions) VALUES (?,?,?) ");

    $stmt->execute(array( $name, $dose, $instrutions));
}

function getMedicinecode($name,$dose){
    global $dbh;
    $stmt = $dbh->prepare("SELECT code FROM Medicine
                            WHERE Medicine.name = ? and Medicine.dose=?");

    $stmt->execute(array($name,$dose));
    return $stmt->fetch();
}


function InsertMedicationAdministered ($code_medicine,$inpatient){
    global $dbh;
    $stmt= $dbh->prepare("INSERT INTO MedicationAdministered (code_medicine,inpatient )  VALUES (?,?)");
    $stmt->execute(array($code_medicine,$inpatient));
}


if(strlen($dname)==0){
    $_SESSION["msg_Med_imp"]=" Please insert the name of the Medicine !";
    header("Location: inpatient.php?code=$inpatient");
    die();
}

 try{
    
    if(check_Medicine($name,$dose)){
        $Medicine_result=check_Medicine($name,$dose);
        $code= $Medicine_result["code"];
        InsertMedicationAdministered ($code,$inpatient);
        $_SESSION["msg_Med_imp"]="Medicine found in the system.Prescription Of Medicine sucefull!";
        header("Location: inpatient.php?code=$inpatient");

    }else{
        InsertMedicine($name, $dose, $instrutions);
        $Mcode=getMedicinecode($name,$dose);
        $code=$Mcode['code'];
        InsertMedicationAdministered ($code,$inpatient);
        $_SESSION["msg_Med_imp"]="This medication was added to the system,Prescription Of Medicine sucefull!";
        header("Location: inpatient.php?code=$inpatient");
    }
    

    }catch(PDOException $e){
        $_SESSION["msg_Med_imp"]="Prescription Of Medicine fail!";
        header("Location: inpatient.php?code=$inpatient");
    }
?>