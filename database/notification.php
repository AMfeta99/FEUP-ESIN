<?php 

   function DeleteNotification($id){
    global $dbh;
    $stmt= $dbh->prepare("DELETE FROM ReceiveNotification WHERE id=?");
    $stmt->execute(array($id));
}

#NOTIFICATION
function  getPatientNotification($patient_id){
    global $dbh;
    $stmt = $dbh->prepare("SELECT message, ReceiveNotification.id as id, Reservation.id as reservation, Doctor.name as doctor, Department.name as department, Reservation.date as date, Reservation.time as time, begin_time
                            FROM ReceiveNotification
                            JOIN Reservation ON ReceiveNotification.id = Reservation.id
                            JOIN Block_time ON Block_time.code=Reservation.time
                            JOIN Doctor ON Doctor.id=Reservation.doctor
                            JOIN Department ON Department.number=Doctor.speciality
                            JOIN Patient ON Reservation.patient = Patient.cc
                            WHERE Patient.cc = ?");
    $stmt->execute(array($patient_id));
    return $stmt->fetchALL();
}
?>