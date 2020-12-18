<?php

function getDoctorById($doctor_id){
    global $dbh;
    $stmt = $dbh->prepare("SELECT * FROM Doctor WHERE id=?");
    $stmt->execute(array($doctor_id));
    return $stmt->fetch(); 
}

function getDepartmentOfEachDoctor($doctor_id){
    global $dbh;
    $stmt = $dbh->prepare("SELECT Department.name as Sname FROM Department JOIN Doctor ON Department.number=speciality WHERE id=?");
    $stmt->execute(array($doctor_id));
    return $stmt->fetch(); 
}

function getDoctorInfo($dep_number){
    global $dbh;
    $stmt = $dbh->prepare("SELECT Doctor.id, Doctor.name, Doctor.photo, Doctor.phone_number, Doctor.mail_address, Department.name as speciality
                            FROM Doctor JOIN Department ON Doctor.speciality= Department.number 
                            WHERE speciality=?");

    $stmt->execute(array($dep_number));
    return $stmt->fetchAll();
}


function getDoctorAppointment($doctor_id){
    global $dbh;
    $stmt = $dbh->prepare("SELECT reservation as id, date, Block_time.begin_time as Hour, Patient.name as patient, Patient.cc as cc
                           FROM Appointment
                           JOIN Reservation ON Reservation.id= reservation
                           JOIN Patient ON patient=Patient.cc
                           JOIN Block_time ON code=time
                           JOIN Doctor ON doctor=Doctor.id
                           WHERE doctor=?");

    $stmt->execute(array($doctor_id));
    return $stmt->fetchAll();
}

function getDoctorReservation($doctor_id){
    global $dbh;
    $stmt = $dbh->prepare("SELECT date, Block_time.begin_time as Hour, Patient.name as patient
                           From Reservation 
                           JOIN Patient ON patient=Patient.cc
                           JOIN Block_time ON code=time
                           JOIN Doctor ON doctor=Doctor.id
                           WHERE doctor=?
                           EXCEPT
                           SELECT date, Block_time.begin_time as Hour, Patient.name as patient
                           FROM Appointment
                           JOIN Reservation ON Reservation.id= reservation
                           JOIN Patient ON patient=Patient.cc
                           JOIN Block_time ON code=time
                           JOIN Doctor ON doctor=Doctor.id
                           WHERE doctor=?");

    $stmt->execute(array($doctor_id,$doctor_id));
    return $stmt->fetchAll();
}

function getDoctorinpatient($doctor_id){
    global $dbh;
    $stmt = $dbh->prepare("SELECT Patient.name as name, bed, code FROM Inpatient
                           JOIN Doctor ON doctor= Doctor.id
                           JOIN Patient ON Inpatient.patient=Patient.cc
                           WHERE doctor=?");

    $stmt->execute(array($doctor_id));
    return $stmt->fetchAll();
}

function getDoctorSchedule($doctor_id){
    global $dbh;
    $stmt = $dbh->prepare("SELECT begin_time, end_time, week_day from Doctor
                            JOIN Block_time_and_Doctor ON doctor= Doctor.id
                            JOIN Block_time ON block_time = Block_time.code
                            WHERE Doctor.id=?");
   $stmt->execute(array($doctor_id));
   return $stmt->fetchAll();
}

function getDoctorScheduleByWeekDay($doctor_id, $week_day){
    global $dbh;
    $stmt = $dbh->prepare("SELECT begin_time, end_time from Block_time_and_Doctor
                            JOIN Doctor ON Block_time_and_Doctor.doctor= Doctor.id
                            JOIN Block_time ON block_time = Block_time.code
                            WHERE Doctor.id=? AND week_day=?");
   $stmt->execute(array($doctor_id,$week_day));
   return $stmt->fetchAll();
}


?>