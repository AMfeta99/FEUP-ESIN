
--Projeto ESIN FEUP--
/* 
    Hospital Manegment System
    Grupo F
    @authors: 
        Ana Filipa Ferreira, up201705530
        Ana Maria Sousa, up2017
 */

PRAGMA foreign_keys = ON;

-- DROPS--
DROP TABLE IF EXISTS Department;
DROP TABLE IF EXISTS Patient;
DROP TABLE IF EXISTS Doctor;
DROP TABLE IF EXISTS Nurse;
DROP TABLE IF EXISTS Block_time;
DROP TABLE IF EXISTS Reservation;
DROP TABLE IF EXISTS Appointment;
DROP TABLE IF EXISTS Prescription;
DROP TABLE IF EXISTS Medicine;
DROP TABLE IF EXISTS Disease;
DROP TABLE IF EXISTS AppointmentDiagnosis ;
DROP TABLE IF EXISTS Block_time_and_Doctor;
DROP TABLE IF EXISTS PrescriptionOfMedicine;
DROP TABLE IF EXISTS ReceiveNotification;
DROP TABLE IF EXISTS Report;
DROP TABLE IF EXISTS Bed;
DROP TABLE IF EXISTS Inpatient;
DROP TABLE IF EXISTS MedicationAdministered;
DROP TABLE IF EXISTS NursesOfInpatient;
DROP TABLE IF EXISTS Department_Doctor;

CREATE TABLE Department(
    number integer PRIMARY KEY,
    name text NOT NULL,
    total_beds integer NOT NULL,
    n_beds_occupy integer,
    n_beds_available integer
);

CREATE TABLE Patient (
	cc integer PRIMARY KEY,
	name text NOT NULL,
    age integer NOT NULL,
    phone_number integer,
	mail_address text NOT NULL,
    password text NOT NULL
);

CREATE TABLE Doctor (
	id integer PRIMARY KEY AUTOINCREMENT, 
	name text NOT NULL,
    -- photo BLOB -- não sei como por ==> aula min 25
    phone_number integer,
	mail_address text NOT NULL,
    password text NOT NULL,
    speciality integer NOT NULL REFERENCES Department
);

CREATE TABLE Nurse (
	id integer PRIMARY KEY AUTOINCREMENT,
	name text NOT NULL,
    phone_number integer NOT NULL,
	mail_address text ,
    password text NOT NULL,
    department integer NOT NULL REFERENCES Department
);

CREATE TABLE Block_time (
	code integer PRIMARY KEY AUTOINCREMENT,
    begin_time time NOT NULL, -- not sure if the type is datetime --> acho q é text
    end_time time NOT NULL,
    week_day text NOT NULL CHECK (week_day = "MON" OR week_day = "TUE" OR week_day = "WED" OR week_day = "THU" OR week_day = "FRI" ),
    CHECK (time(begin_time) < time(end_time))
    
);

CREATE TABLE Reservation(
    id integer PRIMARY KEY AUTOINCREMENT, 
    date Date NOT NULL, -- tipo 11-11-2021 --- não sei se é assim!
    time integer NOT NULL REFERENCES Block_time, -- the primary key of block time is an integer
    doctor integer NOT NULL REFERENCES Doctor, 
    patient integer NOT NULL REFERENCES Patient
    
);

CREATE TABLE Appointment(
    id integer PRIMARY KEY AUTOINCREMENT, 
    date Date NOT NULL, -- tipo 11-11-2021
    time integer NOT NULL REFERENCES Block_time, -- the primary key of block time is an integer
    doctor integer NOT NULL REFERENCES Doctor, 
    patient integer NOT NULL REFERENCES Patient
    
);

CREATE TABLE Prescription (
    id integer PRIMARY KEY AUTOINCREMENT, 
    date Date NOT NULL, -- tipo 11-11-2021
    date_limit Date NOT NULL, 
    id_appointment integer NOT NULL REFERENCES Appointment,
    CHECK (Date(date_limit)> Date(date))
);

CREATE TABLE Medicine (
    code integer PRIMARY KEY, 
    name text NOT NULL, -- paracetamol
    dose text NOT NULL, -- 1000 mg, 500 mg ....
    instructions text NOT NULL
);

CREATE TABLE Disease(
    id integer PRIMARY KEY AUTOINCREMENT,
    name text
);

CREATE TABLE AppointmentDiagnosis  (
    id_appointment integer REFERENCES Appointment,
	disease text REFERENCES Disease,
	PRIMARY KEY (id_appointment, disease)
);

CREATE TABLE Block_time_and_Doctor(
    block_time integer REFERENCES Block_time,
    doctor integer REFERENCES Doctor,
    PRIMARY KEY (block_time, doctor)
);

CREATE TABLE PrescriptionOfMedicine(
    id_prescription integer REFERENCES Prescription,
    id_medicine integer REFERENCES Medicine,
    quantity integer CHECK (quantity >=1),
    PRIMARY KEY (id_prescription, id_medicine)
);

CREATE TABLE ReceiveNotification (
    id integer,
    doctor integer REFERENCES Doctor,
    patient integer REFERENCES Patient,
    message text NOT NULL CHECK (message ="reservation accept" OR message = "reservation denied"),
    PRIMARY KEY (id, doctor, patient)
);

CREATE TABLE Report (
    id integer PRIMARY KEY AUTOINCREMENT,
    date Date NOT NULL,
    message text NOT NULL
);

CREATE TABLE Bed(
    number integer PRIMARY KEY,
    id_department integer NOT NULL REFERENCES Department
);

CREATE TABLE Inpatient(
    code integer PRIMARY KEY ,
    visiting_hours text,
    patient integer REFERENCES Patient,
    daily_report integer REFERENCES Report,
    bed integer REFERENCES Bed,
    doctor integer REFERENCES Doctor

);

CREATE TABLE MedicationAdministered(
    code_medicine integer REFERENCES Medicine,
    inpatient integer REFERENCES Inpatient,
    PRIMARY KEY(code_medicine, inpatient)
);

CREATE TABLE NursesOfInpatient(
    inpatient integer REFERENCES Inpatient,
    nurse integer REFERENCES Nurse,
    PRIMARY KEY(nurse, inpatient)
);

--acho q aquilo do medico e departmento tem q ser assim e talvez fazer um check para ser pelo menos 1 (não sei ) 
CREATE TABLE Department_Doctor(
    number integer REFERENCES Department,
    doctor integer REFERENCES Doctor,
    PRIMARY KEY (number, doctor)
);

--Insert Data

--Department  (não faço a minima ideia nas do nºd camas)
INSERT INTO Department (number,name, total_beds) VALUES (1,'Cardiology', 10);
INSERT INTO Department (number,name, total_beds) VALUES (2,'Surgery', 15);
INSERT INTO Department (number,name, total_beds) VALUES (3,'Dermatology', 5);
INSERT INTO Department (number,name, total_beds) VALUES (4,'Orthopedics', 20);
INSERT INTO Department (number,name, total_beds) VALUES (5,'Pediatrics', 25);
INSERT INTO Department (number,name, total_beds) VALUES (6,'Pulmonology', 10);
INSERT INTO Department (number,name, total_beds) VALUES (7,'Psychiatry', 0);
INSERT INTO Department (number,name, total_beds) VALUES (8,'Radiology', 0);
INSERT INTO Department (number,name, total_beds) VALUES (9,'Urology', 10);
INSERT INTO Department (number,name, total_beds) VALUES (10,'Rheumatology', 0);

--Patient  (depois podemos acrescentar mais)
INSERT INTO Patient (cc,name, age, phone_number, mail_address, password) VALUES (15991790,'Ana Marta Silva', 25, 926524200, 'AMarta@gmail.com', 'amart25');
INSERT INTO Patient (cc,name, age, phone_number, mail_address, password) VALUES (14511630,'João Maria Pereira', 62, 917849203, 'jojo@sapo.pt', 'jmp413');
INSERT INTO Patient (cc,name, age, phone_number, mail_address, password) VALUES (15726640,'Rita Faria', 78, 928423651, 'Faria@hotmail.com', 'riarita');
INSERT INTO Patient (cc,name, age, phone_number, mail_address, password) VALUES (12054713,'Maria Madalena Melo', 13, 964566667, 'triM@fe.up.com', 'm1m2m3');
INSERT INTO Patient (cc,name, age, phone_number, mail_address, password) VALUES (84310576,'André Fernandes Gonçalves', 17, 963634263, 'AndFerGon@gmail.com', 'gonçalvesAF');
INSERT INTO Patient (cc,name, age, phone_number, mail_address, password) VALUES (15341150,'Gustavo Machado de Melo', 84, 922222222, 'Gmachado@gmail.com', 'machadomelado');
INSERT INTO Patient (cc,name, age, phone_number, mail_address, password) VALUES (18886451,'Francisco Pinto de Oliveira', 37, 916161336, 'oliveira@sapo.pt', 'pipinto');
INSERT INTO Patient (cc,name, age, phone_number, mail_address, password) VALUES (17213654,'Cláudia Oliveira', 49, 928425411, 'clod@hotmail.com', 'oliva49');
INSERT INTO Patient (cc,name, age, phone_number, mail_address, password) VALUES (15431203,'Diogo José Mendes', 83, 967776667, 'mendes@fe.up.com', 'jandjkmds');
INSERT INTO Patient (cc,name, age, phone_number, mail_address, password) VALUES (15798264,'Carolina de Almeida Peixoto', 96, 961010104, 'Carol@gmail.com', 'caramba96');
-- testar casos de pacientes sem telemovel já q este não é obrigatorio
INSERT INTO Patient (cc,name, age, mail_address, password) VALUES (15431264,'Carolina Lima', 64,'Carolima@gmail.com', 'C95Lima');
INSERT INTO Patient (cc,name, age, mail_address, password) VALUES (18156437,'Abel valerio', 55, 'abelval@gmail.com', 'AiValerio');
INSERT INTO Patient (cc,name, age, mail_address, password) VALUES (16351542,'Carlos Sousa', 11, 'carlitos@gmail.com', 'asdfdc42'); 
INSERT INTO Patient (cc,name, age, mail_address, password) VALUES (15431444,'Helena Lima', 6,'lima@gmail.com', 'Lima');
INSERT INTO Patient (cc,name, age, mail_address, password) VALUES (18156444,'tiago valerio', 25, 'val@gmail.com', 'Valerio');
INSERT INTO Patient (cc,name, age, mail_address, password) VALUES (13351542,'jaime Sousa', 47, 'jiji@gmail.com', 'asc42'); 


--Doctor (tenho q ver como se insere as variaveis do tipo blob)
-- INSERT INTO Doctor (name,photo, phone_number, mail_address, password,speciality ) VALUES ('João Sousa',??? , 966754201,'DoctorJoão@gmail.com', 'joaodopulmao', 6);
-- INSERT INTO Doctor (name,photo, phone_number, mail_address, password,speciality) VALUES ('Ana Magalhães',??? , 966754121,'DoctorAna@gmail.com', 'AnaMag', 4);
-- INSERT INTO Doctor (name,photo, phone_number, mail_address, password,speciality) VALUES ('Maria Machado',??? , 966451201,'DoctorMaria@gmail.com', 'MaMachado', 3);
-- INSERT INTO Doctor (name,photo, phone_number, mail_address, password,speciality) VALUES ('Antonio Gomes',??? , 952154277,'DoctorTo@gmail.com', 'AntGomes45', 8);
-- INSERT INTO Doctor (name,photo, phone_number, mail_address, password,speciality) VALUES ('Filipa Rocha',??? , 969954201,'DoctorPipa@gmail.com', 'FillRocha4', 5);
-- INSERT INTO Doctor (name,photo, phone_number, mail_address, password,speciality) VALUES ('André Pereira',??? , 975462201,'DoctorAndre@gmail.com', '54631Pereira', 3);

INSERT INTO Doctor (name, phone_number, mail_address, password,speciality ) VALUES ('João Sousa' , 966754201,'DoctorJoão@gmail.com', 'joaodopulmao', 6);
INSERT INTO Doctor (name, phone_number, mail_address, password,speciality) VALUES ('Ana Magalhães', 966754121,'DoctorAna@gmail.com', 'AnaMag', 4);
INSERT INTO Doctor (name, phone_number, mail_address, password,speciality) VALUES ('Maria Machado' , 966451201,'DoctorMaria@gmail.com', 'MaMachado', 3);
INSERT INTO Doctor (name, phone_number, mail_address, password,speciality) VALUES ('Antonio Gomes' , 952154277,'DoctorTo@gmail.com', 'AntGomes45', 5);
INSERT INTO Doctor (name, phone_number, mail_address, password,speciality) VALUES ('Filipa Rocha' , 969954201,'DoctorPipa@gmail.com', 'FillRocha4', 5);
INSERT INTO Doctor (name, phone_number, mail_address, password,speciality) VALUES ('André Pereira', 975462201,'DoctorAndre@gmail.com', '54631Pereira', 3);


---Nurse 
INSERT INTO Nurse (name,phone_number, mail_address, password, department) VALUES ('João Silva', 966752221,'NurseJoãoSilva@gmail.com', 'silvinha', 4);
INSERT INTO Nurse (name,phone_number, mail_address, password, department) VALUES ('Matilde Silva', 966788821,'NurseMS@gmail.com', 'matilvaa84', 4);
INSERT INTO Nurse (name,phone_number, mail_address, password, department) VALUES ('Teresa Amaro', 967856621,'Nursetete@gmail.com', 'amteresa', 3);
INSERT INTO Nurse (name,phone_number, mail_address, password, department) VALUES ('Marta cerqueira', 966658881,'NurseMartaC@gmail.com', '982Marta4', 2);
INSERT INTO Nurse (name,phone_number, mail_address, password, department) VALUES ('jose Costa', 966733211,'NursejoseC@gmail.com', 'JCosta6451', 5);
INSERT INTO Nurse (name,phone_number, password, department) VALUES ('Pedro ferreira', 924494571, 'jfjkhy', 8);
INSERT INTO Nurse (name,phone_number, password, department) VALUES ('Paulo Pedra',963524201, 'j5431vhg', 7);
INSERT INTO Nurse (name,phone_number, password, department) VALUES ('Jorge Madureira',911204321, 'hhcjnkj2', 5);
INSERT INTO Nurse (name,phone_number, password, department) VALUES ('Marta Pen',920014201, '543ghgkl', 5);
INSERT INTO Nurse (name,phone_number, password, department) VALUES ('Vitor Carvalho',963444209, 'vitorinhoCarvalhinho', 1);


-- BEDs
INSERT INTO Bed VALUES(201, 2);
INSERT INTO Bed VALUES(202, 2);
INSERT INTO Bed VALUES(203, 2);
INSERT INTO Bed VALUES(204, 2);
INSERT INTO Bed VALUES(301, 3);
INSERT INTO Bed VALUES(302, 3);
INSERT INTO Bed VALUES(303, 3);
INSERT INTO Bed VALUES(304, 3);
INSERT INTO Bed VALUES(401, 4);
INSERT INTO Bed VALUES(402, 4);
INSERT INTO Bed VALUES(403, 4);
INSERT INTO Bed VALUES(404, 4);
INSERT INTO Bed VALUES(501, 5);
INSERT INTO Bed VALUES(502, 5);
INSERT INTO Bed VALUES(503, 5);
INSERT INTO Bed VALUES(504, 5);


-- Report 
INSERT INTO Report( date, message) VALUES ( '2020-11-11', 'The patient had some vomits during the night, but now is more stable');
INSERT INTO Report( date, message) VALUES ( '2020-11-11', 'During the day the patient as done some exams, now we are waiting for the results');

-- Inpatient -- temos de ter cuidado em adicionar um médico que trabalhe no departamento em que o paciente está internado
INSERT INTO Inpatient(code, visiting_hours, patient, daily_report, bed, doctor) VALUES ( 2020110901,' 2pm- 8pm', 15991790, 1, 501, 2 );
INSERT INTO Inpatient(code, visiting_hours, patient, daily_report, bed, doctor) VALUES ( 2020110902,' 2pm- 8pm', 84310576, 1, 502, 2 );
INSERT INTO Inpatient(code, visiting_hours, patient, daily_report, bed, doctor) VALUES ( 2020110903,' 2pm- 8pm', 18886451, 2, 401, 4 );
INSERT INTO Inpatient(code, visiting_hours, patient, daily_report, bed, doctor) VALUES ( 2020110904,' 2pm- 8pm', 17213654, 2, 301, 3 ); 

--Disease
INSERT INTO Disease (name) VALUES ('Alzheimer');
INSERT INTO Disease (name) VALUES ('Autism');
INSERT INTO Disease (name) VALUES ('Asthma');
INSERT INTO Disease (name) VALUES ('Cancer');
INSERT INTO Disease (name) VALUES ('Anemia');
INSERT INTO Disease (name) VALUES ('Diabetes');
INSERT INTO Disease (name) VALUES ('HIV/AIDS');
INSERT INTO Disease (name) VALUES ('Epilepsy');
INSERT INTO Disease (name) VALUES ('Stroke');
INSERT INTO Disease (name) VALUES ('Hepatitis');
INSERT INTO Disease (name) VALUES ('Ebola');


--- Block_time 
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '08:00', '09:00', 'MON');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '09:00','10:00', 'MON');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '10:00','11:00', 'MON');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '11:00','12:00', 'MON');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '13:00','14:00', 'MON');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '14:00','15:00', 'MON');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '15:00','16:00', 'MON');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '16:00','17:00', 'MON');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '17:00','18:00', 'MON');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '08:00', '09:00', 'TUE');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '09:00','10:00', 'TUE');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '10:00','11:00', 'TUE');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '11:00','12:00', 'TUE');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '13:00','14:00', 'TUE');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '14:00','15:00', 'TUE');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '15:00','16:00', 'TUE');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '16:00','17:00', 'TUE');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '17:00','18:00', 'TUE');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '08:00', '09:00', 'WED');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '09:00','10:00', 'WED');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '10:00','11:00', 'WED');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '11:00','12:00', 'WED');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '13:00','14:00', 'WED');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '14:00','15:00', 'WED');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '15:00','16:00', 'WED');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '16:00','17:00', 'WED');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '17:00','18:00', 'WED');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '08:00', '09:00', 'THU');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '09:00','10:00', 'THU');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '10:00','11:00', 'THU');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '11:00','12:00', 'THU');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '13:00','14:00', 'THU');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '14:00','15:00', 'THU');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '15:00','16:00', 'THU');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '16:00','17:00', 'THU');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '17:00','18:00', 'THU');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '08:00', '09:00', 'FRI');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '09:00','10:00', 'FRI');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '10:00','11:00', 'FRI');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '11:00','12:00', 'FRI');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '13:00','14:00', 'FRI');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '14:00','15:00', 'FRI');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '15:00','16:00', 'FRI');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '16:00','17:00', 'FRI');
INSERT INTO Block_time(begin_time,end_time,week_day) VALUES ( '17:00','18:00', 'FRI');


-- Appointment
INSERT INTO Appointment (date, time, doctor,patient) VALUES ('2020-11-11', 2 , 5, 15431264);
INSERT INTO Appointment (date, time, doctor,patient) VALUES ('2020-11-11', 3 , 5, 15726640);
INSERT INTO Appointment (date, time, doctor,patient) VALUES ('2020-11-11', 2 , 6, 14511630);
INSERT INTO Appointment (date, time, doctor,patient) VALUES ('2020-11-11', 2 , 3, 12054713);
INSERT INTO Appointment (date, time, doctor,patient) VALUES ('2020-11-11', 4 , 5, 14511630);
INSERT INTO Appointment (date, time, doctor,patient) VALUES ('2020-11-11', 5 , 5, 15341150);
INSERT INTO Appointment (date, time, doctor,patient) VALUES ('2020-11-11', 2 , 4, 15991790);

