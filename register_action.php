<?php
    $name=$_POST["name"];
    $phone_number=$_POST["phone_number"];
    $mail_address=$_POST["email"];
    $password=$_POST["password"];
    $departemt=$_POST["department"];
    $cc=$_POST["cc"];
    $age=$_POST["age"];
    $photo=$POST["photo"];
    require_once('config/init.php');

    if(strlen($name)==0){
        $_SESSION["msg"]="Invalid Username!";
        header('Location: register.php');
        die();
    }
    if(strlen($password)<7){
        $_SESSION["msg"]="Password too short!";
        header('Location: register.php');
        die();
    }

    
    function insertNurse($name,$phone_number, $mail_address,$password,$department){
        global $dbh;
        $stmt= $dbh->prepare("INSERT INTO Nurse(name,phone_number, email,password,department) VALUES (?,?,?,?,?)");
        $stmt->execute(array($name,$phone_number,$mail_address,shal($password),$department));
    }

    function insertPatient($cc,$name,$age,$phone_number,$mail_address,$password){
        global $dbh;
        $stmt= $dbh->prepare("INSERT INTO Patient(cc,name,age,phone_number,email,password) VALUES (?,?,?,?,?,?)");
        $stmt->execute(array($cc,$name,$age,$phone_number,$mail_address,shal($password)));
    }

    function insertDoctor($name,$photo,$phone_number,$email,$password,$departemt){
        global $dbh;
        $stmt= $dbh->prepare("INSERT INTO Doctor(name,photo,phone_number,mail_address,password,speciality) VALUES (?,?,?,?,?,?,?)");
        $stmt->execute(array($name,$photo,$phone_number,$email,shal($password),$departemt));
    }



    try{
        if($_SESSION["funtion"]=="Nurse"){
        insertNurse($name,$phone_number, $mail_address,$password,$department);
        $_SESSION["msg"]=" Nurse registe sucessful";
        die(header("Location: register.php"));
        }
        elseif($_SESSION["funtion"]=="Patient"){
            insertPatient($cc,$name,$age,$phone_number,$mail_address,$password);
            // header('Location: index.php');
            $_SESSION["msg"]=" Patient Registe sucessful";
            die(header('Location: index.php'));
        }
        elseif($_SESSION["funtion"]=="Doctor"){
            insertDoctor($name,$photo,$phone_number,$mail_address,$password,$departemt);
            $_SESSION["msg"]=" Doctor Register sucessful";
            die(header('Location: index.php'));
        }

     }catch(PDOException $e){
        
         if(strpos($e->getMessage(), "UNIQUE")){
            $_SESSION["msg"]="This User already exists";
         }
         else{
            $_SESSION["msg"]=" Register fail";
        }
         header('Location: register.php');
            // echo $e->getMessage(); 
     }
?>