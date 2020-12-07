<?php 

function IsThatAInpatient($code){
        global $dbh;
        $stmt=$dbh->prepare("SELECT Inpatient.code FROM Inpatient 
                             JOIN Patient ON Inpatient.patient=Patient.cc
                             WHERE Inpatient.code=?");
        $stmt->execute(array($code));
        return $stmt->fetch();
    }
?>