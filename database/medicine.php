<?php 

function check_Medicine($dname,$Dose){
    global $dbh;
    $stmt = $dbh->prepare("SELECT * FROM Medicine
                            WHERE Medicine.name = ? and Medicine.dose=?");

    $stmt->execute(array($dname,$Dose));
    return $stmt->fetch();
}


function InsertMedicine($name, $dose, $instrutions){
    global $dbh;
    $stmt = $dbh->prepare("INSERT INTO  Medicine ( name, dose, instructions) VALUES (?,?,?) ");

    $stmt->execute(array( $name, $dose, $instrutions));
}

function getMedicinecode($name,$dose){
    global $dbh;
    $stmt = $dbh->prepare("SELECT code FROM Medicine
                            WHERE Medicine.name = ? and Medicine.dose=?");

    $stmt->execute(array($name,$dose));
    return $stmt->fetch();
}

?>