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
?>