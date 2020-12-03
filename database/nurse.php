<?php

function getNurseById($nurse_id){
    global $dbh;
    $stmt = $dbh->prepare("SELECT * FROM Nurse WHERE id=?");
    $stmt->execute(array($nurse_id));
    return $stmt->fetch(); 
}

function getDepartmentOfEachNurse($nurse_id){
    global $dbh;
    $stmt = $dbh->prepare("SELECT Department.name as Sname FROM Department JOIN Nurse ON Department.number=Nurse.department WHERE id=?");
    $stmt->execute(array($nurse_id));
    return $stmt->fetch();
}

?>