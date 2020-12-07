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
?>