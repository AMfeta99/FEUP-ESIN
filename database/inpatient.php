<?php function getInpatientByCode($code){
        global $dbh;
        $stmt=$dbh->prepare("SELECT Inpatient.code FROM Inpatient 
                             JOIN Patient ON Inpatient.patient=Patient.cc
                             WHERE Inpatient.code=?");
        $stmt->execute(array($code));
        return $stmt->fetch();
    }

function getInpatientInfo($code){
    global $dbh;
    $stmt=$dbh->prepare("SELECT * FROM Inpatient 
                         JOIN Patient ON Inpatient.patient=Patient.cc
                         WHERE Inpatient.code=?");
    $stmt->execute(array($code));
    return $stmt->fetch();
}


// Doctor of the inpatient
function getDoctorInpatient($code){
    global $dbh;
    $stmt=$dbh->prepare("SELECT Doctor.id as doctor_id, Doctor.name as doctor_name, Doctor.mail_address as doctor_mail FROM Inpatient
                        JOIN Doctor ON doctor= Doctor.id
                        WHERE Inpatient.code=?");
    $stmt->execute(array($code));
    return $stmt->fetch();
}

// Bed and department
function getBedDepartment($code){
    global $dbh;
    $stmt=$dbh->prepare("SELECT bed,visiting_hours, Department.name as dep_name FROM Inpatient
                        JOIN Bed ON bed= Bed.number
                        JOIN Department ON id_department = Department.number
                        WHERE Inpatient.code=?");
    $stmt->execute(array($code));
    return $stmt->fetch();

}

// // Medication of each patient
// function getMedOfEachInpatient($code){
//     global $dbh;
//     $stmt=$dbh->prepare("SELECT Medicine.name as name_med, Medicine.dose as dose, instructions FROM Inpatient
//                         JOIN MedicationAdministered ON Inpatient.code = inpatient
//                         JOIN Medicine ON code_medicine = Medicine.code
//                         WHERE Inpatient.code=?");
//     $stmt->execute(array($code));
//     return $stmt->fetchAll();
// }

// Reports of each patient
// function getReportsOfEachInpatient($code){
//     global $dbh;
//     $stmt=$dbh->prepare("SELECT Report.id as report_id, date, message FROM Inpatient
//                         JOIN Report ON Inpatient.code = inpatient
//                         WHERE Inpatient.code=?");

//     $stmt->execute(array($code));
//     return $stmt->fetchAll();
// }

function getHistoryDiagnosis($code){
    global $dbh;
    $stmt = $dbh->prepare("SELECT Disease.name as disease_name FROM AppointmentDiagnosis
                            JOIN Disease ON Disease.id = disease
                            JOIN Appointment ON reservation = id_appointment
                            JOIN Reservation ON Reservation.id= reservation
                            JOIN Patient ON Reservation.patient=Patient.cc
                            JOIN Inpatient ON Inpatient.patient = Patient.cc
                            WHERE Inpatient.code = ?");

    $stmt->execute(array($code));
    return $stmt->fetchALL();
}

    
function Hospitalize($patient, $bed, $doctor){
    $visiting_hours=' 2pm- 8pm';
    $code=(string)$patient;
    $rand =(string) rand(10,99);
    $code = intval($rand.$code);
    
    global $dbh;
    $stmt= $dbh->prepare("INSERT INTO Inpatient(code,visiting_hours,patient,bed,doctor) VALUES (?,?,?,?,?)");
    $stmt->execute(array($code, $visiting_hours, $patient,$bed,$doctor));
}

function discharge($code){
    global $dbh;
    $stmt= $dbh->prepare("DELETE FROM Inpatient WHERE code=?");
    $stmt->execute(array($code));
}
?>