.mode column
.headers ON

SELECT *
FROM Bed;

SELECT *
FROM Inpatient;

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


SELECT *
FROM Department;