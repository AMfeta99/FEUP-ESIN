<?php
    require_once('config/init.php');
    require_once('database/reservation.php');
    $id= $_POST['R_ID'];
    $Doctor=$_POST['D_ID'];
   
    try{
        
        AcceptNotification($id);
        AddAppointment($id);
        $_SESSION["msg_R"]="Reservation Accepted succefull";
        header("Location: Doctor.php?id=$Doctor");
       
     }catch(PDOException $e){
        echo $e-> getMessage();
        $_SESSION["msg_R"]="Accept Reservation NOT succefull";
        header("Location: Doctor.php?id=$Doctor");
     }
?>