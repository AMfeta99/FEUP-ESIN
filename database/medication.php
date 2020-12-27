<?php 

function InsertMedicationAdministered ($code_medicine,$inpatient){
    global $dbh;
    $stmt= $dbh->prepare("INSERT INTO MedicationAdministered (code_medicine,inpatient )  VALUES (?,?)");
    $stmt->execute(array($code_medicine,$inpatient));
}

function DeleteMedicationAdministered ($code){
    global $dbh;
    $stmt= $dbh->prepare("DELETE FROM MedicationAdministered  WHERE inpatient=?");
    $stmt->execute(array($code));
}


// Medication of each patient
function getMedOfEachInpatient($code){
    global $dbh;
    $stmt=$dbh->prepare("SELECT Medicine.name as name_med, Medicine.dose as dose, instructions FROM Inpatient
                        JOIN MedicationAdministered ON Inpatient.code = inpatient
                        JOIN Medicine ON code_medicine = Medicine.code
                        WHERE Inpatient.code=?");
    $stmt->execute(array($code));
    return $stmt->fetchAll();
}
?>