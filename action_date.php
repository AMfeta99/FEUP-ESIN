<?php
    require_once('config/init.php');

    $doctor_id=$_SESSION["doctor"];
    $date_select =$_SESSION["date"];
    $patient=$_SESSION["user"];

    $time = $_POST['time'];
    $_SESSION["time"]=$time;

    $week_day=$_POST['week_day'];
    $_SESSION["week"]=$week_day;


    function getBlock_time($time ,$week_day){
        global $dbh;
        $stmt = $dbh->prepare("SELECT code FROM Block_time
                                WHERE begin_time=? AND week_day=?");
       $stmt->execute(array($time,$week_day));
       return $stmt->fetch()['code'];
    }


    function insertReservation($date_select, $Block_time, $doctor_id,$patient){
        global $dbh;
        $stmt= $dbh->prepare("INSERT INTO Reservation(date, time, doctor,patient)VALUES (?,?,?,?)");
        $stmt->execute(array($date_select, $Block_time, $doctor_id,$patient));
    }

    try{
        $Block_time=getBlock_time($time,$week_day);
        $_SESSION["b"]=$Block_time;

        insertReservation($date_select, $Block_time, $doctor_id,$patient);
        $_SESSION["msg"]="Appointments request sent successfully";
        header('Location: Appointment.php');
       
     }catch(PDOException $e){
        $_SESSION["msg"]=" Request submission failed";
        header('Location: Appointment.php');
     }

?>