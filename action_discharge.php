<?php
    require_once('config/init.php');
    require_once('database/inpatient.php');
    require_once('database/bed.php');
    require_once('database/report.php');
    require_once('database/medication.php');
    $id_dep= $_POST['Dep_ID'];
    $Doctor= $_SESSION["doctor_id"];
    $code=$_POST['code'];
    
    // function discharge($code){
    //     global $dbh;
    //     $stmt= $dbh->prepare("DELETE FROM Inpatient WHERE code=?");
    //     $stmt->execute(array($code));
    // }

    // function UpdateBedsAvailable($bed,$id_dep){
    //     global $dbh;
    //     $stmt= $dbh->prepare("UPDATE Bed
    //                             SET occupy = 0
    //                             WHERE number=? AND id_department=?;");
    //     $stmt->execute(array($bed,$id_dep));
    // }

    // function DeleteReports($code){
    //     global $dbh;
    //     $stmt= $dbh->prepare("DELETE FROM Report WHERE inpatient=?");
    //     $stmt->execute(array($code));
    // }

    // function DeleteMedicationAdministered ($code){
    //     global $dbh;
    //     $stmt= $dbh->prepare("DELETE FROM MedicationAdministered  WHERE inpatient=?");
    //     $stmt->execute(array($code));
    // }

    try{
        if(getInpatientInfo($code)){

            $result=getInpatientInfo($code);
            $bed=$result["bed"];

            DeleteMedicationAdministered ($code);
            DeleteReports($code);
            discharge($code);
            UpdateBedsAvailable($bed,$id_dep);

            $_SESSION["msg_d"]="Discharge succefull";
            header("Location: Doctor.php?id=$Doctor");    
        }else{
        $_SESSION["msg_d"]="There is no such Inpatient";
        header("Location: Doctor.php?id=$Doctor");
        }
       
     }catch(PDOException $e){
       
        $_SESSION["msg_d"]="Hospitalization NOT succefull";
       header("Location: Doctor.php?id=$Doctor");
     }
?>