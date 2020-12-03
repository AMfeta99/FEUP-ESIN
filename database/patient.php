<?php

function getPatientById($patient_id){
    global $dbh;
    $stmt = $dbh->prepare("SELECT * FROM Patient WHERE Patient.cc=?");
    $stmt->execute(array($patient_id));
    return $stmt->fetch(); // array of arrays
}

?>