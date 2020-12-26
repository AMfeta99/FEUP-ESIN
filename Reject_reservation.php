<?php
    require_once('config/init.php');
    require_once('database/reservation.php');
    $id= $_POST['R_ID'];
    $Doctor=$_POST['D_ID'];
    
    // function DeleteReservation($id){
    //     global $dbh;
    //     $stmt= $dbh->prepare("DELETE FROM Reservation WHERE id=?");
    //     $stmt->execute(array($id));
    // }
   
    // function RejectNotification($id){
    //     global $dbh;
    //     $stmt= $dbh->prepare("INSERT INTO ReceiveNotification (id,message) VALUES (?,?)");
    //     $stmt->execute(array($id,"denied"));
    // }

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