<?php

    function getListDepartments(){
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM Department');
        $stmt->execute();
        return $stmt->fetchAll(); // array of arrays
    }
?>