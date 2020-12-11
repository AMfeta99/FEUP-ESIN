
--Projeto ESIN FEUP--
/* 
    Hospital Manegment System
    Grupo F
    @authors: 
        Ana Filipa Ferreira, up201705530
        Ana Maria Sousa, up201707312
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
    name text NOT NULL
);

CREATE TABLE Patient (
	cc integer PRIMARY KEY,
	name text NOT NULL,
    age integer NOT NULL,
    phone_number integer,
	mail_address text NOT NULL UNIQUE,
    password text NOT NULL
);

CREATE TABLE Doctor (
	id integer PRIMARY KEY AUTOINCREMENT, 
	name text NOT NULL,
    photo text, -- não esquecer colocar uma foto como default, para caso um médico não adicione foto
    phone_number integer,
	mail_address text NOT NULL UNIQUE,
    password text NOT NULL UNIQUE,
    speciality integer NOT NULL REFERENCES Department
);

CREATE TABLE Nurse (
	id integer PRIMARY KEY AUTOINCREMENT,
	name text NOT NULL,
    phone_number integer NOT NULL,
	mail_address text UNIQUE ,
    password text NOT NULL UNIQUE,
    department integer NOT NULL REFERENCES Department
);

CREATE TABLE Block_time (
	code integer PRIMARY KEY AUTOINCREMENT,
    begin_time time NOT NULL, 
    end_time time NOT NULL,
    week_day text NOT NULL CHECK (week_day = "MON" OR week_day = "TUE" OR week_day = "WED" OR week_day = "THU" OR week_day = "FRI" ),
    CHECK (time(begin_time) < time(end_time))
    
);

CREATE TABLE Reservation(
    id integer PRIMARY KEY AUTOINCREMENT, 
    date Date NOT NULL, -- tipo 11-11-2021 
    time integer NOT NULL REFERENCES Block_time, -- the primary key of block time is an integer
    doctor integer NOT NULL REFERENCES Doctor, 
    patient integer NOT NULL REFERENCES Patient
    
);

-- relação de 0...1 para 1, ou seja a uma reserva pode estar associada ou não uma consulta
CREATE TABLE Appointment(
    reservation integer PRIMARY KEY REFERENCES Reservation
    
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
	disease integer DEFAULT 1 REFERENCES Disease,
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

-- é melhor associar a consulta , pois pode ter feito pedido de consultas diferentes,
-- e para além disso, é mais fácil para depois associar a reserva à consulta se a mensagem for "reservation accepts"
-- mas se fizermos assim não faz muito ter doctor e patient como atributos, visto que estes já fazem parte do reservation
-- se ficasse assim até fazia mais sentido pq assegurava que estavamos a comunicar entre o doctor e o patient correto
CREATE TABLE ReceiveNotification (
    id integer PRIMARY KEY REFERENCES Reservation,
    message text NOT NULL CHECK (message ="reservation accept" OR message = "reservation denied")
    
);



CREATE TABLE Bed(
    number integer PRIMARY KEY,
    id_department integer NOT NULL REFERENCES Department,
    occupy integer DEFAULT 0 -- not occupy
);

CREATE TABLE Inpatient(
    code integer PRIMARY KEY ,
    visiting_hours text,
    patient integer REFERENCES Patient,
    bed integer REFERENCES Bed,
    doctor integer REFERENCES Doctor

);

-- a relação entre inpatient and report deve ser de 1 para * 
-- Ou seja, cada paciente tem vários daily report mas cada report apenas tem um paciente

CREATE TABLE Report ( 
    id integer PRIMARY KEY AUTOINCREMENT,
    date Date NOT NULL,
    message text NOT NULL,
    inpatient integer REFERENCES Inpatient
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


/*----------------------Insertion of Data -------------------*/

--Department  (não faço a minima ideia nas do nºd camas)
INSERT INTO Department (number,name) VALUES (1,'Cardiology');
INSERT INTO Department (number,name) VALUES (2,'Neurology');
INSERT INTO Department (number,name) VALUES (3,'Dermatology');
INSERT INTO Department (number,name) VALUES (4,'Orthopaedic');
INSERT INTO Department (number,name) VALUES (5,'Paediatrics');
INSERT INTO Department (number,name) VALUES (6,'Pulmonology');
INSERT INTO Department (number,name) VALUES (7,'Psychiatry');
INSERT INTO Department (number,name) VALUES (8,'Surgery');
INSERT INTO Department (number,name) VALUES (9,'Urology');
INSERT INTO Department (number,name) VALUES (10,'Osbtetrics');

--Patient  (depois podemos acrescentar mais)
INSERT INTO Patient (cc,name, age, phone_number, mail_address, password) VALUES (15991790,'Ana Marta Silva', 12, 926524200, 'AMarta@gmail.com', 'amart25');
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
INSERT INTO Doctor (name, photo, phone_number, mail_address, password,speciality) VALUES ('Ana Sousa','images/doctors/1.png', 966754201,'DoctorAFsousa@gmail.com', 'anafsousa', 1);
INSERT INTO Doctor (name, photo, phone_number, mail_address, password,speciality) VALUES ('Ana Barrias','images/doctors/2.jpg', 964754121,'DoctorACbarrias@gmail.com', 'anacbarrias', 1);
INSERT INTO Doctor (name, photo, phone_number, mail_address, password,speciality) VALUES ('Maria Ribeiro','images/doctors/3.jpg', 966751201,'DoctorMRibeiro@gmail.com', 'MaRibeiro', 1);
INSERT INTO Doctor (name, photo, phone_number, mail_address, password,speciality) VALUES ('João Ferreira','images/doctors/4.png', 952144277,'DoctorJFerreira@gmail.com', 'jferreira1', 1);
INSERT INTO Doctor (name, photo, phone_number, mail_address, password,speciality) VALUES ('Carolina Rocha', 'images/doctors/5.jpg', 969953201,'DoctorCarol@gmail.com', 'carolR', 1);

INSERT INTO Doctor (name, phone_number, mail_address, password,speciality) VALUES ('André Oliveira', 935442201,'DoctorAndreO@gmail.com', 'andreO25', 2);
INSERT INTO Doctor (name, phone_number, mail_address, password,speciality) VALUES ('Sofia Sousa', 926754201,'DoctorSofsousa@gmail.com', 'sofia_sousa', 2);
INSERT INTO Doctor (name, phone_number, mail_address, password,speciality) VALUES ('Anabela Silva', 964754111,'DoctorASilva@gmail.com', 'anabela1999', 2);
INSERT INTO Doctor (name, photo, phone_number, mail_address, password,speciality) VALUES ('João Ribeiro', 'images/doctors/9.jpg', 966711201,'DoctorJRibeiro@gmail.com', 'JRibeiro1', 2);
INSERT INTO Doctor (name, phone_number, mail_address, password,speciality) VALUES ('José Ferreira', 922144477,'DoctorJoseFerreira@gmail.com', 'jferr1', 2);

INSERT INTO Doctor (name, phone_number, mail_address, password,speciality) VALUES ('Maria Machado', 924451201,'DoctorMaria@gmail.com', 'MaMachado', 3);
INSERT INTO Doctor (name, phone_number, mail_address, password,speciality) VALUES ('André Pereira', 927462201,'DoctorAndre@gmail.com', '54631Pereira', 3);
INSERT INTO Doctor (name, phone_number, mail_address, password,speciality) VALUES ('Jorge Ribeiro', 966571201,'DoctorJorgeRibeiro@gmail.com', 'JRibeiro1999', 3);

INSERT INTO Doctor (name, phone_number, mail_address, password,speciality) VALUES ('André Silva', 935842201,'DoctorAndreSilva@gmail.com', 'andreS28', 4);
INSERT INTO Doctor (name, phone_number, mail_address, password,speciality) VALUES ('Benedita Antunes', 926749201,'DoctorBenedita@gmail.com', 'BenAnt2', 4);
INSERT INTO Doctor (name, phone_number, mail_address, password,speciality) VALUES ('Joana Silva', 964844121,'DoctorJoanaSilva@gmail.com', 'jSilva', 4);
INSERT INTO Doctor (name, phone_number, mail_address, password,speciality) VALUES ('João Magalhães', 966713211,'DoctorJMagalhaes@gmail.com', 'JMagalhaes1', 4);
INSERT INTO Doctor (name, phone_number, mail_address, password,speciality) VALUES ('Maria Sousa', 922148477,'DoctorMariaS@gmail.com', 'MarSousa', 4);
INSERT INTO Doctor (name, phone_number, mail_address, password,speciality) VALUES ('Ana Magalhães', 966754121,'DoctorAna@gmail.com', 'AnaMag', 4);

INSERT INTO Doctor (name, phone_number, mail_address, password,speciality) VALUES ('Antonio Gomes' , 952154277,'DoctorTo@gmail.com', 'AntGomes45', 5);
INSERT INTO Doctor (name, phone_number, mail_address, password,speciality) VALUES ('Filipa Rocha' , 969954201,'DoctorPipa@gmail.com', 'FillRocha4', 5);

INSERT INTO Doctor (name, phone_number, mail_address, password,speciality) VALUES ('João Sousa' , 966754201,'DoctorJoao@gmail.com', 'joaodopulmao', 6);
INSERT INTO Doctor (name, phone_number, mail_address, password,speciality) VALUES ('André Silva', 935782201,'DoctorAndreSilva11@gmail.com', 'andreSil11', 6);
INSERT INTO Doctor (name, phone_number, mail_address, password,speciality) VALUES ('Isabel Sousa', 926738201,'DoctorIsabel@gmail.com', 'iSaBelSousa', 6);
INSERT INTO Doctor (name, phone_number, mail_address, password,speciality) VALUES ('Jorge Ferreira', 964844121,'DoctorJorgeF@gmail.com', 'jFerr1', 6);

INSERT INTO Doctor (name, phone_number, mail_address, password,speciality) VALUES ('Joana Gomes' , 922124577,'DoctorJo@gmail.com', 'JoGomes32', 7);
INSERT INTO Doctor (name, phone_number, mail_address, password,speciality) VALUES ('Filipa Coelho' , 969454201,'DoctorPipaCoelho@gmail.com', 'FilCoelho', 7);
INSERT INTO Doctor (name, phone_number, mail_address, password,speciality) VALUES ('Vítor Sousa' , 925954201,'DoctorVsousa@gmail.com', 'Vsousa24', 7);

INSERT INTO Doctor (name, phone_number, mail_address, password,speciality) VALUES ('Vanessa Sousa' , 966754289,'DoctorVanessa@gmail.com', 'vanSousa1', 8);
INSERT INTO Doctor (name, phone_number, mail_address, password,speciality) VALUES ('Carlos Silva', 935782401,'DoctorCarloSilva11@gmail.com', 'carloSil2', 8);
INSERT INTO Doctor (name, phone_number, mail_address, password,speciality) VALUES ('Cátia Sousa', 926739401,'DoctorCatSousa@gmail.com', 'catSousa21', 8);
INSERT INTO Doctor (name, phone_number, mail_address, password,speciality) VALUES ('Juliana Sousa', 967844121,'DoctorJuSousa@gmail.com', 'juSousa3', 8);

INSERT INTO Doctor (name, phone_number, mail_address, password,speciality) VALUES ('João Ferreira', 951244277,'DoctorJFerreira2@gmail.com', 'jfer1980', 9);
INSERT INTO Doctor (name, phone_number, mail_address, password,speciality) VALUES ('Patrícia Rocha', 969955201,'DoctorPRocha@gmail.com', 'pRocha11', 9);

INSERT INTO Doctor (name, phone_number, mail_address, password,speciality) VALUES ('Eduarda Carvalho' , 966755889,'DoctorDuda@gmail.com', 'dudaCarvalho11', 10);
INSERT INTO Doctor (name, phone_number, mail_address, password,speciality) VALUES ('Beatriz Moreira', 935784901,'DoctorBeaMor@gmail.com', 'beasmoreira', 10);
INSERT INTO Doctor (name, phone_number, mail_address, password,speciality) VALUES ('Carina Oliveira', 926479401,'DoctorCarinaOl@gmail.com', 'oliveira21', 10);
INSERT INTO Doctor (name, phone_number, mail_address, password,speciality) VALUES ('Catarina Sousa', 963844121,'DoctorCatarinaSousa@gmail.com', 'cat1999Sousa', 10);


---Nurse 
INSERT INTO Nurse (name,phone_number, mail_address, password, department) VALUES ('João Silva', 966752221,'NurseJoãoSilva@gmail.com', 'silvinha', 4);
INSERT INTO Nurse (name,phone_number, mail_address, password, department) VALUES ('Matilde Silva', 966788821,'NurseMS@gmail.com', 'matilvaa84', 9);
INSERT INTO Nurse (name,phone_number, mail_address, password, department) VALUES ('Teresa Amaro', 967856621,'Nursetete@gmail.com', 'amteresa', 3);
INSERT INTO Nurse (name,phone_number, mail_address, password, department) VALUES ('Marta cerqueira', 966658881,'NurseMartaC@gmail.com', '982Marta4', 2);
INSERT INTO Nurse (name,phone_number, mail_address, password, department) VALUES ('jose Costa', 966733211,'NursejoseC@gmail.com', 'JCosta6451', 10);
INSERT INTO Nurse (name,phone_number, password, department) VALUES ('Pedro Ferreira', 924494571, 'jfjkhy', 8);
INSERT INTO Nurse (name,phone_number, password, department) VALUES ('Paulo Pedra',963524201, 'j5431vhg', 7);
INSERT INTO Nurse (name,phone_number, password, department) VALUES ('Jorge Madureira',911204321, 'hhcjnkj2', 5);
INSERT INTO Nurse (name,phone_number, password, department) VALUES ('Marta Pereira',920014201, '543ghgkl', 6);
INSERT INTO Nurse (name,phone_number, password, department) VALUES ('Vitor Carvalho',963444209, 'vitorinhoCarvalhinho', 1);


-- BEDs
INSERT INTO Bed(number, id_department, occupy) VALUES(101, 1, 0);
INSERT INTO Bed VALUES(102, 1, 0);
INSERT INTO Bed VALUES(103, 1, 0);
INSERT INTO Bed VALUES(104, 1, 1);

INSERT INTO Bed VALUES(201, 2, 0);
INSERT INTO Bed VALUES(202, 2, 0);
INSERT INTO Bed VALUES(203, 2, 0);
INSERT INTO Bed VALUES(204, 2, 1);
INSERT INTO Bed VALUES(205, 2, 1);

INSERT INTO Bed VALUES(301, 3, 0);
INSERT INTO Bed VALUES(302, 3, 0);
INSERT INTO Bed VALUES(303, 3, 0);
INSERT INTO Bed VALUES(304, 3, 1);

INSERT INTO Bed VALUES(401, 4, 0);
INSERT INTO Bed VALUES(402, 4, 1);
INSERT INTO Bed VALUES(403, 4, 0);
INSERT INTO Bed VALUES(404, 4, 1);

INSERT INTO Bed VALUES(501, 5, 0);
INSERT INTO Bed VALUES(502, 5, 0);
INSERT INTO Bed VALUES(503, 5, 1);
INSERT INTO Bed VALUES(504, 5, 0);

INSERT INTO Bed VALUES(601, 6, 0);
INSERT INTO Bed VALUES(602, 6, 0);
INSERT INTO Bed VALUES(603, 6, 0);
INSERT INTO Bed VALUES(604, 6, 1);

INSERT INTO Bed VALUES(701, 7, 0);
INSERT INTO Bed VALUES(702, 7, 1);
INSERT INTO Bed VALUES(703, 7, 0);
INSERT INTO Bed VALUES(704, 7, 1);

INSERT INTO Bed VALUES(801, 8, 0);
INSERT INTO Bed VALUES(802, 8, 0);
INSERT INTO Bed VALUES(803, 8, 1);
INSERT INTO Bed VALUES(804, 8, 0);

INSERT INTO Bed VALUES(901, 9, 1);
INSERT INTO Bed VALUES(902, 9, 0);
INSERT INTO Bed VALUES(903, 9, 0);
INSERT INTO Bed VALUES(904, 9, 1);

INSERT INTO Bed VALUES(1001, 10, 0);
INSERT INTO Bed VALUES(1002, 10, 0);
INSERT INTO Bed VALUES(1003, 10, 1);
INSERT INTO Bed VALUES(1004, 10, 1);

-- Inpatient -- temos de ter cuidado em adicionar um médico que trabalhe no departamento em que o paciente está internado

INSERT INTO Inpatient(code, visiting_hours, patient, bed, doctor) VALUES ( 2020110901,' 2pm- 8pm', 15991790, 501, 2 );
INSERT INTO Inpatient(code, visiting_hours, patient, bed, doctor) VALUES ( 2020110902,' 2pm- 8pm', 84310576, 502, 2 );
INSERT INTO Inpatient(code, visiting_hours, patient, bed, doctor) VALUES ( 2020110903,' 2pm- 8pm', 18886451, 401, 4 );
INSERT INTO Inpatient(code, visiting_hours, patient, bed, doctor) VALUES ( 2020110904,' 2pm- 8pm', 17213654, 301, 3 ); 

-- Medicine -- the instructions should be add by the doctor
INSERT INTO Medicine(code, name, dose, instructions) VALUES(10001824, 'Paracetamol', '1000 mg', '8 em 8 horas');
INSERT INTO Medicine(code, name, dose, instructions) VALUES(10001825, 'Paracetamol', '500 mg', '8 em 8 horas');
INSERT INTO Medicine(code, name, dose, instructions) VALUES(10001826, 'Ibuprofeno', '400 mg', '8 em 8 horas');
INSERT INTO Medicine(code, name, dose, instructions) VALUES(10001827, 'Ibuprofeno', '200 mg', '8 em 8 horas');

-- MedicationAdministered
INSERT INTO MedicationAdministered(code_medicine, inpatient) VALUES(10001825, 2020110901);
INSERT INTO MedicationAdministered(code_medicine, inpatient) VALUES(10001827, 2020110901);
INSERT INTO MedicationAdministered(code_medicine, inpatient) VALUES(10001827, 2020110902);


-- Report 
INSERT INTO Report( date, message, inpatient) VALUES ( '2020-11-11', 'The patient had some vomits during the night, but now is more stable',2020110901);
INSERT INTO Report( date, message, inpatient) VALUES ( '2020-11-12', 'The patient is stable, will probably be discharged tomorrow',2020110901);
INSERT INTO Report( date, message, inpatient) VALUES ( '2020-11-11', 'During the day the patient as done some exams, now we are waiting for the results',2020110902);
INSERT INTO Report( date, message, inpatient) VALUES ( '2020-11-23', 'The patient was submitted to an ECG', 2020110903);

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


-- Reservation
-- acho que deviamos de fazer um check qualquer porque a data da consulta e o block_time tem de coincidir com o mesmo dia da semana
INSERT INTO Reservation (date, time, doctor,patient) VALUES ('2020-11-11', 2 , 5, 15431264);
INSERT INTO Reservation (date, time, doctor,patient) VALUES ('2020-11-11', 3 , 5, 15726640);
INSERT INTO Reservation (date, time, doctor,patient) VALUES ('2020-11-11', 2 , 6, 14511630);
INSERT INTO Reservation (date, time, doctor,patient) VALUES ('2020-11-11', 2 , 3, 12054713);
INSERT INTO Reservation (date, time, doctor,patient) VALUES ('2020-11-11', 4 , 5, 14511630);
INSERT INTO Reservation (date, time, doctor,patient) VALUES ('2020-11-11', 5 , 5, 15341150);
INSERT INTO Reservation (date, time, doctor,patient) VALUES ('2020-11-11', 2 , 20, 15991790);
INSERT INTO Reservation (date, time, doctor,patient) VALUES ('2020-12-27', 2 , 20, 15991790);

-- Receive Notification
INSERT INTO ReceiveNotification (id, message) VALUES (7, "reservation accept");
-- Appointments

INSERT INTO Appointment (reservation) VALUES(1);
INSERT INTO Appointment (reservation) VALUES(3);
INSERT INTO Appointment (reservation) VALUES(5);
INSERT INTO Appointment (reservation) VALUES(7);
INSERT INTO Appointment (reservation) VALUES(8);

-- Prescription 
INSERT INTO Prescription(date, date_limit, id_appointment) VALUES('2020-11-11','2021-02-11', 1); -- same id as reservation
INSERT INTO Prescription(date, date_limit, id_appointment) VALUES('2020-11-11','2021-02-11', 3);
INSERT INTO Prescription(date, date_limit, id_appointment) VALUES('2020-11-11','2021-02-11', 7);
INSERT INTO Prescription(date, date_limit, id_appointment) VALUES('2020-10-11','2020-11-11', 8);

-- Prescription Medicine
INSERT INTO PrescriptionOfMedicine (id_prescription, id_medicine, quantity) VALUES(1, 10001824, 3);
INSERT INTO PrescriptionOfMedicine (id_prescription, id_medicine, quantity) VALUES(1, 10001826, 2);
INSERT INTO PrescriptionOfMedicine (id_prescription, id_medicine, quantity) VALUES(3, 10001825, 2);

-- AppointmentDiagnosis
INSERT INTO AppointmentDiagnosis (id_appointment, disease) VALUES(7, 2);
INSERT INTO AppointmentDiagnosis (id_appointment, disease) VALUES(8, 3);