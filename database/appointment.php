<?php 

function InsertAppointmentDiagnosis($id_appointment,$disease){
    global $dbh;
    $stmt= $dbh->prepare("INSERT INTO AppointmentDiagnosis (id_appointment, disease)  VALUES (?,?)");
    $stmt->execute(array($id_appointment,$disease));
}

function getAppointmentDiagnosis($patient_id){
    global $dbh;
    $stmt = $dbh->prepare("SELECT Disease.name as disease_name FROM AppointmentDiagnosis
                            JOIN Disease ON Disease.id = disease
                            JOIN Appointment ON reservation = id_appointment
                            JOIN Reservation ON Reservation.id= reservation
                            JOIN Patient ON patient=Patient.cc
                            WHERE Patient.cc = ?");

    $stmt->execute(array($patient_id));
    return $stmt->fetchALL();
}


function getDepartmentOfAppointment($dep_id){
    global $dbh;
    $stmt = $dbh->prepare("SELECT date, Block_time.begin_time as Hour, Doctor.name as Doctor, Patient.name as patient, Department.name as speciality
                            FROM Appointment JOIN Patient ON patient=Patient.cc
                            JOIN Reservation ON Reservation.id= reservation
                            JOIN Block_time ON code=time
                            JOIN Doctor ON doctor=Doctor.id
                            JOIN Department ON Doctor.speciality= Department.number
                            WHERE Department.number= ?;");
    $stmt->execute(array($dep_id));
    return $stmt->fetchALL();
}
?>