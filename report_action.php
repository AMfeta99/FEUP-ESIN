<?php
    require_once('config/init.php');
    require_once('database/report.php');

    $report=$_POST["report"];
    $date=$_POST["time"];
    
    $inpatient_code=$_POST["inpatient"];
    // $nurse=$_SESSION["user"];

    if(strlen($report)==0){
        $_SESSION["msg"]="The Report is empty!";
        header("Location: inpatient.php?code=$inpatient_code");
        die();
    }
    
    // function insertReport($date,$report, $inpatient_code){
    //     global $dbh;
    //     $stmt= $dbh->prepare("INSERT INTO Report(date,message, inpatient) VALUES (?,?,?)");
    //     $stmt->execute(array($date,$report, $inpatient_code));
    // }
 
    try{
        insertReport($date,$report, $inpatient_code);
        $_SESSION["msg"]="The Report was submited with sucess!";
        header("Location: inpatient.php?code=$inpatient_code");

     }catch(PDOException $e){
        $_SESSION["msg"]="Report submission failed!";
        header("Location: inpatient.php?code=$inpatient_code");
     }
?>