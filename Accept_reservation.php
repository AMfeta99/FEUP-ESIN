<?php
    require_once('config/init.php');
    $id= $_POST['R_ID'];
    $Doctor=$_POST['D_ID'];
   
    //require_once('database/reservation.php');
    function AddAppointment($id){
        global $dbh;
        $stmt= $dbh->prepare("INSERT INTO Appointment(reservation) VALUES (?)");
        $stmt->execute(array($id));
    }

    function AcceptNotification($id){
        global $dbh;
        $stmt= $dbh->prepare("INSERT INTO ReceiveNotification(id,message) VALUES (?,?)");
        $stmt->execute(array($id,"reservation accept"));
    }
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