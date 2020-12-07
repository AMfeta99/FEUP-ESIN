.mode column
.headers ON

-- SELECT *
-- FROM Bed;

-- SELECT *
-- FROM Inpatient;

-- SELECT *
-- FROM Department;

-- -- count number of total beds for each department

-- SELECT id_department, COUNT (*) as n_total_beds
-- FROM Bed
-- GROUP BY id_department;

-- -- count number of beds available for each department

-- SELECT id_department, COUNT (*) as n_beds_available
-- FROM Bed WHERE occupy = 0
-- GROUP BY id_department;


/*--------------------------------------------------------------------------------------------------------------------------------------*/
/* Login */
-- Patients that exist in the database
-- SELECT * 
-- FROM Patient;

-- To find out if the patient is registered it is necessary to see the names of the patients in the database
-- Name of Patient
-- SELECT *
-- FROM Patient
-- WHERE cc=15991790;

-- To find out if the patient is registered it is necessary to check the name-password correspondence
-- SELECT name, password
-- FROM Patient;

/* Pagina do medico sobre um paciente*/
-- patient data
-- SELECT name, age, mail_address
-- FROM Patient;

/* Appointment*/
--patients appointments
SELECT date, Block_time.begin_time as Hour, Doctor.name as Doctor, Patient.name as Patient 
FROM Appointment 
JOIN Reservation ON Reservation.id= reservation
JOIN Doctor ON doctor=Doctor.id
JOIN Block_time ON code=time
JOIN Patient ON patient=Patient.cc;



-- all appointments of the Doctor
SELECT date, Block_time.begin_time as Hour, Patient.name as Patient
FROM Appointment 
JOIN Reservation ON Reservation.id= reservation
JOIN Patient ON patient=Patient.cc
JOIN Block_time ON code=time
JOIN Doctor ON doctor=Doctor.id
WHERE doctor=5;

-- -- all appointments of patient
SELECT date, Block_time.begin_time as Hour ,Patient.name as patient, Doctor.name as Doctor, Department.name as speciality
FROM Appointment 
JOIN Reservation ON Reservation.id= reservation
JOIN Patient ON patient=Patient.cc
JOIN Block_time ON code=time
JOIN Doctor ON doctor=Doctor.id
JOIN Department ON Doctor.speciality= Department.number
WHERE patient=14511630;

SELECT date, Block_time.begin_time as Hour ,Disease.name , Doctor.name as Doctor, Department.name as speciality
FROM Appointment 
JOIN Reservation ON Reservation.id= reservation
JOIN Patient ON patient=Patient.cc
JOIN Block_time ON code=time
JOIN Doctor ON doctor=Doctor.id
JOIN Department ON Doctor.speciality= Department.number
JOIN AppointmentDiagnosis ON id_appointment=Appointment.reservation
JOIN Disease ON AppointmentDiagnosis.disease =Disease.id

WHERE patient=14511630;

-- -- all appointments of Department
-- SELECT date, Block_time.begin_time as Hour, week_day , Doctor.name as Doctor, Patient.name as Patient, Department.name as speciality
-- FROM Appointment JOIN Patient ON patient=Patient.cc
-- JOIN Block_time ON code=time
-- JOIN Doctor ON doctor=Doctor.id
-- JOIN Department ON Doctor.speciality= Department.number
-- WHERE speciality= 5;

/* Department*/

---algumas coisas q vamos precisar tbm
-- disease of a patient
-- check that the patient is hospitalized

/* Inpatient */
SELECT * FROM Inpatient 
JOIN Patient ON Inpatient.patient=Patient.cc
WHERE Inpatient.code=2020110901";