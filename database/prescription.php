<?php
function getMedicationFromPrescription($prescription_id){
    global $dbh;
    $stmt = $dbh->prepare("SELECT * FROM Prescription
                            JOIN PrescriptionOfMedicine ON Prescription.id = id_prescription
                            JOIN Medicine ON code = id_medicine
                            WHERE id_prescription= ?");
    $stmt->execute(array($prescription_id));
    return $stmt->fetchALL();                        
}

function getPrescriptionsOfPatient($patient_id){

    global $dbh;
    $stmt = $dbh->prepare("SELECT Prescription.id as id_prescription, date_limit FROM Prescription
                            JOIN Appointment ON id_appointment = reservation
                            JOIN Reservation ON Reservation.id= reservation
                            JOIN Patient ON patient=Patient.cc
                            WHERE Patient.cc = ?");
    $stmt->execute(array($patient_id));
    return $stmt->fetchALL();
}

function getPrescriptionInfo($prescription_id){
    global $dbh;
    $stmt = $dbh->prepare("SELECT * FROM Prescription WHERE Prescription.id = ?");
    $stmt->execute(array($prescription_id));
    return $stmt->fetch();
}

function InsertAppointmentPrescription ($date,$date_limit,$id_appointment){
    global $dbh;
    $stmt= $dbh->prepare("INSERT INTO Prescription  (date, date_limit,id_appointment )  VALUES (?,?,?)");
    $stmt->execute(array($date,$date_limit,$id_appointment));
}

function InsertPrescriptionOfMedicine ($id_Prescription,$Medicine_code,$quantity){
    global $dbh;
    $stmt= $dbh->prepare("INSERT INTO PrescriptionOfMedicine  (id_prescription, id_medicine,quantity )  VALUES (?,?,?)");
    $stmt->execute(array($id_Prescription,$Medicine_code,$quantity));
}

function getAppointmentPrescriptionId($date,$date_limit,$id_appointment){
    global $dbh;
    $stmt = $dbh->prepare("SELECT MAX(id) as id FROM Prescription WHERE date=? AND date_limit=? AND id_appointment=?");
    $stmt->execute(array($date,$date_limit,$id_appointment));
    return $stmt->fetch(); 
}

?>