<?php
function getMedicationFromPrescription($prescription_id){
    global $dbh;
    $stmt = $dbh->prepare("SELECT * FROM Prescription
                            JOIN PrescriptionOfMedicine ON Prescription.id = id_prescription
                            JOIN Medicine ON code = id_medicine
                            WHERE Prescription.id = ?");
    $stmt->execute(array($prescription_id));
    return $stmt->fetchALL();                        
}

function getDoctorFromPrescription($prescription_id){
    global $dbh;
    $stmt = $dbh->prepare( "SELECT Doctor.name as doctor_name FROM Prescription
                        JOIN Appointment ON id_appointment= reservation
                        JOIN Reservation ON Reservation.id = reservation
                        JOIN Doctor ON Doctor.id=doctor
                        WHERE Prescription.id =?");
    $stmt->execute(array($prescription_id));
    return $stmt->fetch();                    
}

function getPrescriptionInfo($prescription_id){
    global $dbh;
    $stmt = $dbh->prepare("SELECT * FROM Prescription WHERE Prescription.id = ?");
    $stmt->execute(array($prescription_id));
    return $stmt->fetch();
}

?>