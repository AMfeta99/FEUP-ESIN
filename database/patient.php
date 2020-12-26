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
        $stmt = $dbh->prepare("SELECT date, Block_time.begin_time as Hour ,Disease.name as disease_name , Doctor.name as doctor, Department.name as speciality
                                FROM Appointment 
                                JOIN Reservation ON Reservation.id= reservation
                                JOIN Patient ON patient=Patient.cc
                                JOIN Block_time ON code=time
                                JOIN Doctor ON doctor=Doctor.id
                                JOIN Department ON Doctor.speciality= Department.number
                                LEFT JOIN AppointmentDiagnosis ON id_appointment=Appointment.reservation
                                LEFT JOIN Disease ON AppointmentDiagnosis.disease =Disease.id
                                WHERE patient=?");
        $stmt->execute(array($patient_id));
        return $stmt->fetchALL(); 
    }

        // getting  info Appointment
function getPatientAppointmentbyID($appointment_id){
    global $dbh;
    $stmt = $dbh->prepare("SELECT date, Block_time.begin_time as Hour, Doctor.name as doctor, Department.name as speciality
                            FROM Appointment 
                            JOIN Reservation ON Reservation.id= reservation
                            JOIN Patient ON patient=Patient.cc
                            JOIN Block_time ON code=time
                            JOIN Doctor ON doctor=Doctor.id
                            JOIN Department ON Doctor.speciality= Department.number
                            WHERE reservation=?");
    $stmt->execute(array($appointment_id));
    return $stmt->fetch(); 
}


function getAppointmentDiagnosis($patient_id){
    global $dbh;
    $stmt = $dbh->prepare("SELECT Disease.name as disease_name FROM AppointmentDiagnosis
                            JOIN Disease ON Disease.id = disease
                            JOIN Appointment ON reservation = id_appointment
                            JOIN Reservation ON Reservation.id= reservation
                            JOIN Patient ON patient=Patient.cc
                            WHERE Patient.cc = ?");

    $stmt->execute(array($patient_id));
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

function  getInpatientFromPatient($patient_id){
    global $dbh;
    $stmt = $dbh->prepare("SELECT code, bed, Department.name as depart_name FROM Patient
                            JOIN Inpatient ON patient = Patient.cc
                            JOIN Bed ON Bed = Bed.number
                            JOIN Department ON id_department = Department.number
                            WHERE Patient.cc = ?");
    $stmt->execute(array($patient_id));
    return $stmt->fetch();
}

#NOTIFICATION
function  getPatientNotification($patient_id){
    global $dbh;
    $stmt = $dbh->prepare("SELECT message, ReceiveNotification.id as id, Reservation.id as reservation, Doctor.name as doctor, Department.name as department, Reservation.date as date, Reservation.time as time, begin_time
                            FROM ReceiveNotification
                            JOIN Reservation ON ReceiveNotification.id = Reservation.id
                            JOIN Block_time ON Block_time.code=Reservation.time
                            JOIN Doctor ON Doctor.id=Reservation.doctor
                            JOIN Department ON Department.number=Doctor.speciality
                            JOIN Patient ON Reservation.patient = Patient.cc
                            WHERE Patient.cc = ?");
    $stmt->execute(array($patient_id));
    return $stmt->fetchALL();
}


?>