<?php
    require_once('config/init.php');
    $id= $_POST['R_ID'];
    $Doctor=$_POST['D_ID'];
    
    function DeleteReservation($id){
        global $dbh;
        $stmt= $dbh->prepare("DELETE FROM Reservation WHERE id=?");
        $stmt->execute(array($id));
    }

    function RejectNotification($id){
        global $dbh;
        $stmt= $dbh->prepare("INSERT INTO (id,message) ReceiveNotification VALUE (?,?");
        $stmt->execute(array($id,"reservation denied"));
    }
 
    try{
        RejectNotification($id);
        DeleteReservation($id);
        $_SESSION["msg_R"]="Reservation Rejected succefull";
        header("Location: Doctor.php?id=$Doctor");
       
     }catch(PDOException $e){
        $_SESSION["msg_R"]="Reservation Rejected NOT succefull";
        header("Location: Doctor.php?id=$Doctor");
     }
?>