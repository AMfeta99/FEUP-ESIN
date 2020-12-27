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

function Check_InpatientAcess($dep_id, $code){
    global $dbh;
    $stmt= $dbh-> prepare("SELECT * FROM Inpatient
                            JOIN Bed ON bed= Bed.number
                            JOIN Patient ON Patient.cc=patient
                            JOIN Department ON id_department = Department.number
                            WHERE Department.number=? AND code=?");
    $stmt->execute(array($dep_id, $code));
    return $stmt->fetchAll(); 

}

function insertNurse($name,$phone_number, $mail_address,$password,$department){
    global $dbh;
    $department_number = getDepId(strtolower($department))["number"];
    $stmt= $dbh->prepare("INSERT INTO Nurse(name,phone_number, mail_address,password,department) VALUES (?,?,?,?,?)");
    $stmt->execute(array($name,$phone_number,$mail_address,sha1($password),$department_number));
}

#verify if is a Nurse
function IsthatNurse($mail_address){
    global $dbh;
    $stmt=$dbh->prepare("SELECT * FROM Nurse WHERE mail_address=? ");
    $stmt->execute(array($mail_address));
    return $stmt->fetch();
}
?>