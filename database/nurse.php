<?php

function getNurseById($nurse_id){
    global $dbh;
    $stmt = $dbh->prepare("SELECT * FROM Nurse WHERE id=?");
    $stmt->execute(array($nurse_id));
    return $stmt->fetch(); 
}

function getDepartmentOfEachNurse($nurse_id){
    global $dbh;
    $stmt = $dbh->prepare("SELECT Department.name as Sname , Department.number as dep_id 
                           FROM Department 
                           JOIN Nurse ON Department.number=Nurse.department 
                           WHERE id=?");
    $stmt->execute(array($nurse_id));
    return $stmt->fetch();
}

function getInpatientofDepartment($dep_id){
    global $dbh;
    $stmt= $dbh-> prepare("SELECT bed, Department.name, code , Patient.name as patient
                            FROM Inpatient
                            JOIN Bed ON bed= Bed.number
                            JOIN Patient ON Patient.cc=patient
                            JOIN Department ON id_department = Department.number
                            WHERE Department.number=?");
    $stmt->execute(array($dep_id));
    return $stmt->fetchAll(); 

}

function getDepartmentOfAppointment($dep_id){
    global $dbh;
    $stmt = $dbh->prepare("SELECT date, Block_time.begin_time as Hour, Doctor.name as Doctor, Patient.name as patient, Department.name as speciality
                            FROM Appointment JOIN Patient ON patient=Patient.cc
                            JOIN Reservation ON Reservation.id= reservation
                            JOIN Block_time ON code=time
                            JOIN Doctor ON doctor=Doctor.id
                            JOIN Department ON Doctor.speciality= Department.number
                            WHERE Department.number= ?;");
    $stmt->execute(array($dep_id));
    return $stmt->fetchALL();
}


?>