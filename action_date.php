<?php
    require_once('config/init.php');
    require_once('database/schedule.php');
    require_once('database/reservation.php');
    $doctor_id=$_SESSION["doctor_id"];
    $date_select =$_SESSION["date"];
    $patient=$_SESSION["user"];

    $time = $_POST['time'];
    $_SESSION["time"]=$time;

    $week_day=$_POST['week_day'];
    $_SESSION["week"]=$week_day;



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