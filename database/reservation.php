<?php
   

   function AddAppointment($id){
    global $dbh;
    $stmt= $dbh->prepare("INSERT INTO Appointment(reservation) VALUES (?)");
    $stmt->execute(array($id));
    }

    function AcceptNotification($id){
        global $dbh;
        $stmt= $dbh->prepare("INSERT INTO ReceiveNotification(id,message) VALUES (?,?)");
        $stmt->execute(array($id,"accept"));
    }

    function RejectNotification($id){
        global $dbh;
        $stmt= $dbh->prepare("INSERT INTO ReceiveNotification (id,message) VALUES (?,?)");
        $stmt->execute(array($id,"denied"));
    }


    function insertReservation($date_select, $Block_time, $doctor_id,$patient){
        global $dbh;
        $stmt= $dbh->prepare("INSERT INTO Reservation(date, time, doctor,patient)VALUES (?,?,?,?)");
        $stmt->execute(array($date_select, $Block_time, $doctor_id,$patient));
    }

?>