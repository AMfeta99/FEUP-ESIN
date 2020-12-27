<?php 

function insertReport($date,$report, $inpatient_code){
    global $dbh;
    $stmt= $dbh->prepare("INSERT INTO Report(date,message, inpatient) VALUES (?,?,?)");
    $stmt->execute(array($date,$report, $inpatient_code));
}


function DeleteReports($code){
    global $dbh;
    $stmt= $dbh->prepare("DELETE FROM Report WHERE inpatient=?");
    $stmt->execute(array($code));
}

function getReportsOfEachInpatient($code){
    global $dbh;
    $stmt=$dbh->prepare("SELECT Report.id as report_id, date, message FROM Inpatient
                        JOIN Report ON Inpatient.code = inpatient
                        WHERE Inpatient.code=?");

    $stmt->execute(array($code));
    return $stmt->fetchAll();
}
?>