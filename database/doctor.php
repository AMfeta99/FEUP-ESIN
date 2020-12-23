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

function getDoctorInfoByDepName($dep_name){
    global $dbh;
    $stmt = $dbh->prepare("SELECT Doctor.id, Doctor.name
                            FROM Doctor JOIN Department ON Doctor.speciality= Department.number 
                            WHERE Department.name=?");

    $stmt->execute(array($dep_name));
    return $stmt->fetchAll();
}

#pagination
function getDoctorInfo2($dep_number,$page){
    global $dbh;
    $offset=($page-1)*2;
    
    $stmt = $dbh->prepare("SELECT Doctor.id, Doctor.name, Doctor.photo, Doctor.phone_number, Doctor.mail_address, Department.name as speciality
                            FROM Doctor JOIN Department ON Doctor.speciality= Department.number 
                            WHERE Doctor.speciality=? LIMIT 2  OFFSET ?;");

    $stmt->execute(array($dep_number, $offset));
    return $stmt->fetchAll();
}

function getDoctorBySearch($dep_number,$Dname){
    global $dbh;
    $stmt = $dbh->prepare("SELECT Doctor.id, Doctor.name, Doctor.photo, Doctor.phone_number, Doctor.mail_address, Department.name as speciality
                            FROM Doctor JOIN Department ON Doctor.speciality= Department.number 
                            WHERE Doctor.speciality=? AND Doctor.name LIKE ?");

    $stmt->execute(array($dep_number,"%$Dname%"));
    return $stmt->fetchAll();
}

function getNumberOfDoctorForDepartment($dep_number){
    global $dbh;
    $stmt = $dbh->prepare("SELECT COUNT(*) as n_doctors 
                            FROM Doctor JOIN Department ON Doctor.speciality= Department.number 
                            WHERE number=? ");

    $stmt->execute(array($dep_number));
    return $stmt->fetch()["n_doctors"];
}

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
    $stmt = $dbh->prepare("SELECT Reservation.id as id, date, Block_time.begin_time as Hour, Patient.name as patient
                           From Reservation 
                           JOIN Patient ON patient=Patient.cc
                           JOIN Block_time ON code=time
                           JOIN Doctor ON doctor=Doctor.id
                           WHERE doctor=?
                           EXCEPT
                           SELECT Reservation.id as id, date, Block_time.begin_time as Hour, Patient.name as patient
                           FROM Appointment
                           JOIN Reservation ON Reservation.id= reservation
                           JOIN Patient ON patient=Patient.cc
                           JOIN Block_time ON code=time
                           JOIN Doctor ON doctor=Doctor.id
                           WHERE doctor=?");

    $stmt->execute(array($doctor_id,$doctor_id));
    return $stmt->fetchAll();
}

function getDoctorReservationWithAnswer($reservation_id,$doctor_id){
    global $dbh;
    $stmt = $dbh->prepare("SELECT Reservation.id as id
                           From Reservation 
                           JOIN Doctor ON doctor=Doctor.id
                           JOIN ReceiveNotification ON ReceiveNotification.id=Reservation.id
                           WHERE Reservation.id=? AND doctor=?");

    $stmt->execute(array($reservation_id,$doctor_id));
    return $stmt->fetch();
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

function countNumbersOfRowsSchedule($doctor_id){
    global $dbh;
    $stmt = $dbh->prepare("SELECT COUNT(*) as num FROM (SELECT begin_time, end_time, week_day from Doctor
                            JOIN Block_time_and_Doctor ON doctor= Doctor.id
                            JOIN Block_time ON block_time = Block_time.code
                            WHERE Doctor.id=?)");
   $stmt->execute(array($doctor_id));
   return $stmt->fetch();
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