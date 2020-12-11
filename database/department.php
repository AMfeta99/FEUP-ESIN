<?php

    function getListDepartments(){
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM Department');
        $stmt->execute();
        return $stmt->fetchAll(); // array of arrays
    }

    function getDepId($dep_name){
        global $dbh;
        $stmt = $dbh->prepare("SELECT Department.number
                                FROM Department 
                                WHERE Department.name=?");
    
        $stmt->execute(array($dep_name));
        return $stmt->fetch();
    }

    function getDepTotalNumberBed($dep_number){
        global $dbh;
        $stmt = $dbh->prepare("SELECT Count(*) as Total_beds, Bed.number
                               FROM Bed JOIN Department 
                               ON id_department= Department.number
                               WHERE id_department=?;");
    
        $stmt->execute(array($dep_number));
        return $stmt->fetch();
    }
// camas ocupadas
    function getDepNumberBedOccupy($dep_number){
        global $dbh;
        $stmt = $dbh->prepare("SELECT Count(*) as occupy, Bed.number as beds
                               FROM Bed JOIN Department 
                               ON id_department= Department.number
                               WHERE Bed.occupy=1 and id_department=?;");
    
        $stmt->execute(array($dep_number));
        return $stmt->fetch();
    }
?>