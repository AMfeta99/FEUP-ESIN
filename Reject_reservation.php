<?php
    require_once('config/init.php');
    require_once('database/reservation.php');
    $id= $_POST['R_ID'];
    $Doctor=$_POST['D_ID'];

    try{
        RejectNotification($id);
        $_SESSION["msg_R"]="Reservation Rejected successfull";
        header("Location: Doctor.php?id=$Doctor");
       
     }catch(PDOException $e){
        echo $e-> getMessage();
        $_SESSION["msg_R"]="Reservation Rejected NOT successfull";
        header("Location: Doctor.php?id=$Doctor");
     }
?>