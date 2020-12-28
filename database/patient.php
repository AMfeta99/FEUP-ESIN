<?php

function getPatientById($patient_id){
    global $dbh;
    $stmt = $dbh->prepare("SELECT * FROM Patient WHERE Patient.cc=?");
    $stmt->execute(array($patient_id));
    return $stmt->fetch(); // array of arrays
}

  #verify if is a Patient
  function IsthatPatient($mail_address){
    global $dbh;
    $stmt=$dbh->prepare("SELECT * FROM Patient WHERE mail_address=? ");
    $stmt->execute(array($mail_address));
    return $stmt->fetch();
}

function insertPatient($cc,$name,$age,$phone_number,$mail_address,$password){
    global $dbh;
    $stmt= $dbh->prepare("INSERT INTO Patient(cc,name,age,phone_number,mail_address,password) VALUES (?,?,?,?,?,?)");
    $stmt->execute(array($cc,$name,$age,$phone_number,$mail_address,sha1($password)));
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

function getPatientFromPrescription($prescription_id){
    global $dbh;
    $stmt = $dbh->prepare( "SELECT Patient.name as patient_name FROM Prescription
                        JOIN Appointment ON id_appointment= reservation
                        JOIN Reservation ON Reservation.id = reservation
                        JOIN Patient ON Patient.cc = patient
                        WHERE Prescription.id =?");
    $stmt->execute(array($prescription_id));
    return $stmt->fetch();                    
}

?>