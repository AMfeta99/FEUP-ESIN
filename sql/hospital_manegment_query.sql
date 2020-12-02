.mode column
.headers ON

SELECT *
FROM Bed;

SELECT *
FROM Inpatient;

SELECT *
FROM Department;
-- pensei em adicionar um DEFAULT para n_beds_occupy , zero, que vai somando sempre que entra um novo paciente internado naquele departamento

-- this tables gives the number of beds occupy for each department
SELECT id_department, COUNT (*) as n_beds_oc
FROM Bed JOIN Inpatient 
    ON Bed.number = inpatient.bed 
GROUP BY id_department;

SELECT n_beds_oc 
FROM (SELECT id_department, COUNT (*) as n_beds_oc
        FROM Bed JOIN Inpatient 
        ON Bed.number = inpatient.bed 
        GROUP BY id_department)
WHERE id_department = 5;

-- I try do update the number of beds occupy in each department so then we can update de number of beds available, but it IS NOT working
UPDATE Department
   SET n_beds_occupy =  (SELECT n_beds_oc
   FROM (SELECT id_department, COUNT (*) as n_beds_oc
        FROM Bed JOIN Inpatient
        WHERE Bed.number = inpatient.bed
        GROUP BY id_department) JOIN Department
   WHERE number = id_department);

UPDATE Department SET n_beds_available=  total_beds-n_beds_occupy;

SELECT *
FROM Department;

/*--------------------------------------------------------------------------------------------------------------------------------------*/
/* Login */
-- Patients that exist in the database
SELECT * 
FROM Patient;

-- To find out if the patient is registered it is necessary to see the names of the patients in the database
-- Name of Patient
SELECT *
FROM Patient
WHERE cc=15991790;

-- To find out if the patient is registered it is necessary to check the name-password correspondence
SELECT name, password
FROM Patient;

/* Pagina do medico sobre um paciente*/
-- patient data
SELECT name, age, mail_address
FROM Patient;

/* Appointment*/
--patients appointments
SELECT date, Block_time.begin_time as Hour, week_day, Doctor.name as Doctor, Patient.name as Patient
FROM Appointment JOIN Doctor ON doctor=Doctor.id
JOIN Block_time ON code=time
JOIN Patient ON patient=Patient.cc;

-- all appointments of the Doctor
SELECT date, Block_time.begin_time as Hour, week_day , Patient.name as Patient
FROM Appointment JOIN Patient ON patient=Patient.cc
JOIN Block_time ON code=time
JOIN Doctor ON doctor=Doctor.id
WHERE doctor=5;

-- all appointments of patient
SELECT date, Block_time.begin_time as Hour, week_day , Doctor.name as Doctor, Department.name as speciality
FROM Appointment JOIN Patient ON patient=Patient.cc
JOIN Block_time ON code=time
JOIN Doctor ON doctor=Doctor.id
JOIN Department ON Doctor.speciality= Department.number
WHERE patient=14511630;

-- all appointments of Department
SELECT date, Block_time.begin_time as Hour, week_day , Doctor.name as Doctor, Patient.name as Patient, Department.name as speciality
FROM Appointment JOIN Patient ON patient=Patient.cc
JOIN Block_time ON code=time
JOIN Doctor ON doctor=Doctor.id
JOIN Department ON Doctor.speciality= Department.number
WHERE speciality= 5;

/* Department*/
-- all Doctors of department --falta adicionar a foto.... não mas deve haver uma forma melhor de fazer isto
SELECT Doctor.name, Doctor.phone_number, Doctor.mail_address, Department.name as speciality
FROM Doctor JOIN Department ON Doctor.speciality= Department.number
WHERE speciality= 5;

-- all department
SELECT *
FROM Department;

SELECT Department.name 
FROM Department JOIN Doctor
ON Department.number = speciality
WHERE id = 3;
---algumas coisas q vamos precisar tbm
-- disease of a patient
-- check that the patient is hospitalized

