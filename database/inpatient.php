<?php 

function getInpatientByCode($code){
        global $dbh;
        $stmt=$dbh->prepare("SELECT Inpatient.code FROM Inpatient 
                             JOIN Patient ON Inpatient.patient=Patient.cc
                             WHERE Inpatient.code=?");
        $stmt->execute(array($code));
        return $stmt->fetch();
    }

function getInpatientInfo($code){
    global $dbh;
    $stmt=$dbh->prepare("SELECT Patient.name as patient_name FROM Inpatient 
                         JOIN Patient ON Inpatient.patient=Patient.cc
                         WHERE Inpatient.code=?");
    $stmt->execute(array($code));
    return $stmt->fetchAll();
}
?>



