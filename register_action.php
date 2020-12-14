<?php
    require_once('config/init.php');

    $name=$_POST["name"];
    $phone_number=$_POST["phone_number"];
    $mail_address=$_POST["email"];
    $password=$_POST["password"];
    $departemt=$_POST["department"];
    $cc=$_POST["cc"];
    $age=$_POST["age"];
    $photo=$POST["photo"];
    

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
    
    if(strlen($mail_address)==0){
        $_SESSION["msg"]="Registe Invalid! Please insert your Mail Address!";
        header('Location: register.php');
        die();
    }

    
    function insertNurse($name,$phone_number, $mail_address,$password,$department){
        global $dbh;
        $stmt= $dbh->prepare("INSERT INTO Nurse(name,phone_number, mail_address,password,department) VALUES (?,?,?,?,?)");
        $stmt->execute(array($name,$phone_number,$mail_address,sha1($password),$department));
    }

    function insertPatient($cc,$name,$age,$phone_number,$mail_address,$password){
        global $dbh;
        $stmt= $dbh->prepare("INSERT INTO Patient(cc,name,age,phone_number,mail_address,password) VALUES (?,?,?,?,?,?)");
        $stmt->execute(array($cc,$name,$age,$phone_number,$mail_address,sha1($password)));
    }

    function insertDoctor($name,$photo,$phone_number,$mail_address,$password,$departemt){
        global $dbh;
        $stmt= $dbh->prepare("INSERT INTO Doctor(name,photo,phone_number,mail_address,password,speciality) VALUES (?,?,?,?,?,?,?)");
        $stmt->execute(array($name,$photo,$phone_number,$mail_address,sha1($password),$departemt));
    }

 
    function CheckDepartment($department){
        global $dbh;
        $stmt=$dbh->prepare("SELECT number FROM Department 
                            WHERE Department.name=?");
        $stmt->execute(array(strtolower($department)));
        return $stmt->fetch();
    }



    try{
        if($_SESSION["funtion"]=="Nurse"){
            if(strlen($department)==0){
                $_SESSION["msg"]="Registe Invalid! Please insert your Department!";
                header('Location: register.php');
                die();
            }
            if(!CheckDepartment($department)){
                $_SESSION["msg"]="Registe Invalid! There is no such Department!";
                header('Location: register.php');
                die();
            }

        insertNurse($name,$phone_number, $mail_address,$password,$department);
        $_SESSION["msg"]=" Nurse registe sucessful";
        header("Location: index.php");
        }
        elseif($_SESSION["funtion"]=="Patient"){

            if(strlen($age)==0){
                $_SESSION["msg"]="Registe Invalid! Please insert your age!";
                header('Location: register.php');
                die();
            }
            if(($age)<=0){
                $_SESSION["msg"]="Invalid age!";
                header('Location: register.php');
                die();
            }
            if(strlen($cc)<8){
                $_SESSION["msg"]="Invalid cc!";
                header('Location: register.php');
                die();
            }
            if(strlen($cc)==0){
                $_SESSION["msg"]="Invalid ! Please insert your CC";
                header('Location: register.php');
                die();
            }
            insertPatient($cc,$name,$age,$phone_number,$mail_address,$password);
            // header('Location: index.php');
            $_SESSION["msg"]=" Patient Registe sucessful";
            header('Location: index.php');
        }
        elseif($_SESSION["funtion"]=="Doctor"){
            if(strlen($department)==0){
                $_SESSION["msg"]="Registe Invalid! Please insert your Department!";
                header('Location: register.php');
                die();
            }
            if(!CheckDepartment($department)){
                $_SESSION["msg"]="Registe Invalid! There is no such Department!";
                header('Location: register.php');
                die();
            }

            insertDoctor($name,$photo,$phone_number,$mail_address,$password,$departemt);
            $_SESSION["msg"]=" Doctor Register sucessful";
            header('Location: index.php');
        }

     }catch(PDOException $e){
        
         if(strpos($e->getMessage(), "UNIQUE")){
            $_SESSION["msg"]="This User already exists";
         }
         else{
            //  echo $e->getMessage(); 
            $_SESSION["msg"]=" Register fail";
        }
         header('Location: register.php');
            // echo $e->getMessage(); 
     }
?>