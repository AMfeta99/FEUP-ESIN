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
    $stmt = $dbh->prepare("SELECT Doctor.name, Doctor.photo, Doctor.phone_number, Doctor.mail_address, Department.name as speciality
                            FROM Doctor JOIN Department ON Doctor.speciality= Department.number 
                            WHERE speciality=?");

    $stmt->execute(array($dep_number));
    return $stmt->fetchAll();
}

?>