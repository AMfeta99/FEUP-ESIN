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



/* Appointment*/
-- --patients appointments
-- SELECT date, Block_time.begin_time as Hour, Doctor.name as Doctor, Patient.name as Patient 
-- FROM Appointment 
-- JOIN Reservation ON Reservation.id= reservation
-- JOIN Doctor ON doctor=Doctor.id
-- JOIN Block_time ON code=time
-- JOIN Patient ON patient=Patient.cc;



-- -- all appointments of the Doctor
-- SELECT date, Block_time.begin_time as Hour, Patient.name as Patient
-- FROM Appointment 
-- JOIN Reservation ON Reservation.id= reservation
-- JOIN Patient ON patient=Patient.cc
-- JOIN Block_time ON code=time
-- JOIN Doctor ON doctor=Doctor.id
-- WHERE doctor=5;

-- -- -- all appointments of patient
-- SELECT date, Block_time.begin_time as Hour ,Patient.name as patient, Doctor.name as Doctor, Department.name as speciality
-- FROM Appointment 
-- JOIN Reservation ON Reservation.id= reservation
-- JOIN Patient ON patient=Patient.cc
-- JOIN Block_time ON code=time
-- JOIN Doctor ON doctor=Doctor.id
-- JOIN Department ON Doctor.speciality= Department.number
-- WHERE patient=14511630;

-- Appointment Diagnosis

SELECT date, Block_time.begin_time as Hour ,Disease.name as disease_name, Doctor.name as doctor, Department.name as speciality
FROM Appointment 
JOIN Reservation ON Reservation.id= reservation
JOIN Patient ON patient=Patient.cc
JOIN Block_time ON code=time
JOIN Doctor ON doctor=Doctor.id
JOIN Department ON Doctor.speciality= Department.number
LEFT JOIN AppointmentDiagnosis ON id_appointment=Appointment.reservation
JOIN Disease ON AppointmentDiagnosis.disease =Disease.id
WHERE patient=14511630;

-- disease of a patient
SELECT Disease.name as disease_name, id_appointment FROM AppointmentDiagnosis
FULL JOIN Disease ON Disease.id = disease
JOIN Appointment ON reservation = id_appointment
JOIN Reservation ON Reservation.id= reservation
JOIN Patient ON patient=Patient.cc
WHERE Patient.cc = 14511630 ;

-- -- all appointments of Department
-- SELECT date, Block_time.begin_time as Hour, Doctor.name as Doctor, Patient.name as Patient, Department.name as speciality
-- FROM Appointment JOIN Patient ON patient=Patient.cc
-- JOIN Reservation ON Reservation.id= reservation
-- JOIN Block_time ON code=time
-- JOIN Doctor ON doctor=Doctor.id
-- JOIN Department ON Doctor.speciality= Department.number
-- WHERE speciality= 5;

--ALL Prescriptions of each doctor
-- SELECT Prescription.id as id_prescription, date_limit FROM Prescription
-- JOIN Appointment ON id_appointment = reservation
-- JOIN Reservation ON Reservation.id= reservation
-- JOIN Patient ON patient=Patient.cc
-- WHERE Patient.cc = 15991790 ;

/* Department*/

---algumas coisas q vamos precisar tbm


-- check that the patient is hospitalized

/* Inpatient */
-- -- Inpatient Info
-- SELECT * FROM Inpatient 
-- JOIN Patient ON Inpatient.patient=Patient.cc
-- WHERE Inpatient.code=2020110901;

-- -- Doctor of the inpatient
-- SELECT * FROM Inpatient
-- JOIN Doctor ON doctor= Doctor.id
-- WHERE Inpatient.code=2020110901;

-- -- Todos as disease resultante dos appointments


-- -- Bed and department
-- SELECT bed, Department.name FROM Inpatient
-- JOIN Bed ON bed= Bed.number
-- JOIN Department ON id_department = Department.number
-- WHERE Inpatient.code=2020110901;

-- -- Medication Administered
-- SELECT Medicine.name as name_med, Medicine.dose as dose FROM Inpatient
-- JOIN MedicationAdministered ON Inpatient.code = inpatient
-- JOIN Medicine ON code_medicine = Medicine.code
-- WHERE Inpatient.code=2020110901;

-- -- Reports of each patient
-- SELECT Report.id as report_id, date, message FROM Inpatient
-- JOIN Report ON Inpatient.code = inpatient
-- WHERE Inpatient.code=2020110901;