<?php
    require_once('config/init.php');
    $id_reservation= $_POST['reserv_ID'];
    $id_notification= $_POST['notification_ID'];
    $message= $_POST['message'];
    $cc_patient=$_POST['patient_cc'];
    
    function DeleteReservation($id){
        global $dbh;
        $stmt= $dbh->prepare("DELETE FROM Reservation WHERE id=?");
        $stmt->execute(array($id));
    }

    function DeleteNotification($id){
        global $dbh;
        $stmt= $dbh->prepare("DELETE FROM ReceiveNotification WHERE id=?");
        $stmt->execute(array($id));
    }
 
    try{
        if($message=='reservation denied'){
            DeleteNotification($id_notification);
            DeleteReservation($id_reservation);
        }else{
            DeleteNotification($id_notification);
        }
        
        $_SESSION["msg_N"]="view notification";
        header("Location: index_f_login.php?cc=$cc_patient");
       
     }catch(PDOException $e){
        echo $e-> getMessage();
        $_SESSION["msg_N"]="Notification NOT succefull";
        header("Location:index_f_login.php?cc=$cc_patient");
     }
?>