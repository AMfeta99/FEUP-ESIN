<?php

function getPatientById($patient_id){
    global $dbh;
    $stmt = $dbh->prepare("SELECT * FROM Patient WHERE Patient.cc=?");
    $stmt->execute(array($patient_id));
    return $stmt->fetch(); // array of arrays
}

// getting Appointment of a Patient
function getPatientAppointment($patient_id){
        global $dbh;
        $stmt = $dbh->prepare("SELECT date, Block_time.begin_time as Hour ,Patient.name as patient, Doctor.name as Doctor, Department.name as speciality
                                FROM Appointment 
                                JOIN Reservation ON Reservation.id= reservation
                                JOIN Patient ON patient=Patient.cc
                                JOIN Block_time ON code=time
                                JOIN Doctor ON doctor=Doctor.id
                                JOIN Department ON Doctor.speciality= Department.number
                                WHERE patient=?");
        $stmt->execute(array($patient_id));
        return $stmt->fetchALL(); 
    }

// //getting patient's reservation (aprovadas ou ainda não aprovadas ou rejeitadas)
// function getPatientReservation($patient_cc){
//     global $dbh;
//     $stmt = $dbh->prepare("SELECT Reservation.patient, Reservation.id FROM Reservation 
//                            JOIN Patient ON Patient.cc=Reservation.patient
//                            WHERE Patient.cc=? ");
//     $stmt->execute(array($patient_cc));
//     return $stmt->fetchALL(); 
// }
// //All reservation that was aproved
// function getReservattionAproved(){
//     global $dbh;
//     $stmt = $dbh->prepare("SELECT * FROM Appointment
//                            JOIN Reservation 
//                            ON Appointment.reservation= Reservation.id
//                            WHERE Reservation.aproved=1");
//     $stmt->execute();
//     return $stmt->fetchALL(); // array of arrays
// }

// function getAppointmentDiagnosis(){
//     global $dbh;
//     $stmt = $dbh->prepare("SELECT * FROM Disease JOIN AppointementDiagnosis 
//                            ON id_appointment=Appointment");

//     $stmt->execute();
//     return $stmt->fetchALL();
// }

?>