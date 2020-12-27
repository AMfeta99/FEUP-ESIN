<?php
    require_once('config/init.php');
    // require_once('database/department.php');
    require_once('database/patient.php');
    require_once('database/bed.php');
    require_once('database/inpatient.php');
    $id_dep= $_POST['Dep_ID'];
    $Doctor= $_SESSION["doctor_id"];
    $patient_cc=$_POST['cc'];
    
    // function Hospitalize($patient, $bed, $doctor){
    //     $visiting_hours=' 2pm- 8pm';
    //     $code=(string)$patient;
    //     $rand =(string) rand(10,99);
    //     $code = intval($rand.$code);
        
    //     global $dbh;
    //     $stmt= $dbh->prepare("INSERT INTO Inpatient(code,visiting_hours,patient,bed,doctor) VALUES (?,?,?,?,?)");
    //     $stmt->execute(array($code, $visiting_hours, $patient,$bed,$doctor));
    // }

    // function UpdateBeds($bed,$id_dep){
    //     global $dbh;
    //     $stmt= $dbh->prepare("UPDATE Bed
    //                             SET occupy = 1
    //                             WHERE number=? AND id_department=?;");
    //     $stmt->execute(array($bed,$id_dep));
    // }

    try{
        if(getPatientById($patient_cc)){

            if( getDepBedAvailable($id_dep)==0){
                $_SESSION["msg_H"]="Hospitalization is not possible. There are no beds available in this department.";
                header("Location: Doctor.php?id=$Doctor");
           
    
            }else{
                $result=getDepBedAvailable($id_dep);
                $bed=$result["beds"];
    
                Hospitalize($patient_cc, $bed, $Doctor);
                UpdateBeds($bed,$id_dep);

                $_SESSION["msg_H"]="Hospitalization succefull";
                header("Location: Doctor.php?id=$Doctor");    
        } 
    }else{
        $_SESSION["msg_H"]="There is no such Patient register";
        header("Location: Doctor.php?id=$Doctor");
    }
       
     }catch(PDOException $e){
        if(strpos($e->getMessage(), "UNIQUE")){
            $_SESSION["msg_H"]="This patient is already hospitalized.";
         }else{
            $_SESSION["msg_H"]="Hospitalization NOT succefull";
        
         }
       header("Location: Doctor.php?id=$Doctor");
     }
?>