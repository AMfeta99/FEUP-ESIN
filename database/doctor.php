<?php
function getDoctorById($doctor_id){
    global $dbh;
    $stmt = $dbh->prepare("SELECT * FROM Doctor WHERE id=?");
    $stmt->execute(array($doctor_id));
    return $stmt->fetch(); 
}

function getDepartmentOfEachDoctor($doctor_id){
    global $dbh;
    $stmt = $dbh->prepare("SELECT Department.name as Sname FROM Department JOIN Doctor ON Department.number=speciality WHERE id=?");
    $stmt->execute(array($doctor_id));
    return $stmt->fetch(); 
}

function getDoctorInfo($dep_number){
    global $dbh;
    $stmt = $dbh->prepare("SELECT Doctor.id, Doctor.name, Doctor.photo, Doctor.phone_number, Doctor.mail_address, Department.name as speciality
                            FROM Doctor JOIN Department ON Doctor.speciality= Department.number 
                            WHERE speciality=?");

    $stmt->execute(array($dep_number));
    return $stmt->fetchAll();
}

//for pagination
// function getDoctorInfo($dep_number,$page){
//     global $dbh;
//     $page=$page-1;
//     $offset=$page*2;
//     $limit=2;
//     $stmt = $dbh->prepare("SELECT Doctor.id, Doctor.name, Doctor.photo, Doctor.phone_number, Doctor.mail_address, Department.name as speciality
//                             FROM Doctor JOIN Department ON Doctor.speciality= Department.number 
//                             WHERE speciality=? LIMIT=? OFFSET=?");

//     $stmt->execute(array($dep_number,$limit, $offset));
//     return $stmt->fetchAll();
// }

//Search
// function getDoctorBySearch($dep_number,$Dame){
//     global $dbh;
//     $stmt = $dbh->prepare("SELECT Doctor.id, Doctor.name, Doctor.photo, Doctor.phone_number, Doctor.mail_address, Department.name as speciality
//                             FROM Doctor JOIN Department ON Doctor.speciality= Department.number 
//                             WHERE speciality=? AND Doctor.name LIKE %?%");

//     $stmt->execute(array($dep_number,$Dname));
//     return $stmt->fetchAll();
// }


function getDoctorAppointment($doctor_id){
    global $dbh;
    $stmt = $dbh->prepare("SELECT reservation as id, date, Block_time.begin_time as Hour, Patient.name as patient, Patient.cc as cc
                           FROM Appointment
                           JOIN Reservation ON Reservation.id= reservation
                           JOIN Patient ON patient=Patient.cc
                           JOIN Block_time ON code=time
                           JOIN Doctor ON doctor=Doctor.id
                           WHERE doctor=?");

    $stmt->execute(array($doctor_id));
    return $stmt->fetchAll();
}

function getDoctorReservation($doctor_id){
    global $dbh;
    $stmt = $dbh->prepare("SELECT date, Block_time.begin_time as Hour, Patient.name as patient
                           From Reservation 
                           JOIN Patient ON patient=Patient.cc
                           JOIN Block_time ON code=time
                           JOIN Doctor ON doctor=Doctor.id
                           WHERE doctor=?
                           EXCEPT
                           SELECT date, Block_time.begin_time as Hour, Patient.name as patient
                           FROM Appointment
                           JOIN Reservation ON Reservation.id= reservation
                           JOIN Patient ON patient=Patient.cc
                           JOIN Block_time ON code=time
                           JOIN Doctor ON doctor=Doctor.id
                           WHERE doctor=?");

    $stmt->execute(array($doctor_id,$doctor_id));
    return $stmt->fetchAll();
}

function getDoctorinpatient($doctor_id){
    global $dbh;
    $stmt = $dbh->prepare("SELECT Patient.name as name, bed, code FROM Inpatient
                           JOIN Doctor ON doctor= Doctor.id
                           JOIN Patient ON Inpatient.patient=Patient.cc
                           WHERE doctor=?");

    $stmt->execute(array($doctor_id));
    return $stmt->fetchAll();
}

function getDoctorSchedule($doctor_id){
    global $dbh;
    $stmt = $dbh->prepare("SELECT begin_time, end_time, week_day from Doctor
                            JOIN Block_time_and_Doctor ON doctor= Doctor.id
                            JOIN Block_time ON block_time = Block_time.code
                            WHERE Doctor.id=?");
   $stmt->execute(array($doctor_id));
   return $stmt->fetchAll();
}

function getDoctorScheduleByWeekDay($doctor_id, $week_day){
    global $dbh;
    $stmt = $dbh->prepare("SELECT begin_time, end_time from Block_time_and_Doctor
                            JOIN Doctor ON Block_time_and_Doctor.doctor= Doctor.id
                            JOIN Block_time ON block_time = Block_time.code
                            WHERE Doctor.id=? AND week_day=?");
   $stmt->execute(array($doctor_id,$week_day));
   return $stmt->fetchAll();
}

function canMakeAppointment($schedule, $begin_hour, $day){
    foreach ($schedule as $row) {
      $time =  $row["begin_time"] . ' - ' . $row["end_time"];
      
      
      $begin_hour= date( "H:i", strtotime( $begin_hour) );
      
      if($row["week_day"] == $day && $row["begin_time"] == $begin_hour){
          return 1;
      }
    }
    return 0;
  }

?>