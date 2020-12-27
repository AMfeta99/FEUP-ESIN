<?php
    // function insertNurse($name,$phone_number, $mail_address,$password,$department){
    //     global $dbh;
    //     $department_number = getDepId(strtolower($department))["number"];
    //     $stmt= $dbh->prepare("INSERT INTO Nurse(name,phone_number, mail_address,password,department) VALUES (?,?,?,?,?)");
    //     $stmt->execute(array($name,$phone_number,$mail_address,sha1($password),$department_number));
    // }

    // function insertPatient($cc,$name,$age,$phone_number,$mail_address,$password){
    //     global $dbh;
    //     $stmt= $dbh->prepare("INSERT INTO Patient(cc,name,age,phone_number,mail_address,password) VALUES (?,?,?,?,?,?)");
    //     $stmt->execute(array($cc,$name,$age,$phone_number,$mail_address,sha1($password)));
    // }

    // function insertDoctor($name,$photo,$phone_number,$mail_address,$password,$department){
    //     global $dbh;
    //     $department_number = getDepId(strtolower($department))["number"];
    //     $stmt= $dbh->prepare("INSERT INTO Doctor(name,photo,phone_number,mail_address,password,speciality) VALUES (?,?,?,?,?,?)");
    //     $stmt->execute(array($name,$photo,$phone_number,$mail_address,sha1($password),$department_number));
    // }

 
    // function CheckDepartment($department){
    //     global $dbh;
    //     $stmt=$dbh->prepare("SELECT number FROM Department 
    //                         WHERE Department.name=?");
    //     $stmt->execute(array(strtolower($department)));
    //     return $stmt->fetch();
    // }

    function saveProfilePicture($name){
        // limit size
        $pic_name = $_FILES['photo']['name'];
        move_uploaded_file($_FILES['photo']['tmp_name'],"images/doctors/$pic_name");
    }

    #verify usermail_address/password
    function Validating($mail_address,$password,$table){

        global $dbh;
        $stmt=$dbh->prepare("SELECT * FROM $table WHERE mail_address=? AND password=?");
        $stmt->execute(array($mail_address,sha1($password)));
        return $stmt->fetch();
    }

?>