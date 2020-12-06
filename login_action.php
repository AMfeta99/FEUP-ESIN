<?php
    require_once('config/init.php');
    session_start();

    // $funtion=$_POST["funtion"]
    $name=$_POST["name"];
    $password=$_POST["password"];

     #verify if is a Doctor
     function IsthatDoctor($name){
        global $dbh;
        $stmt=$dbh->prepare("SELECT * FROM Doctor WHERE name=? ");
        $stmt->execute(array($name));
        return $stmt->fetch();
    }

     #verify if is a Patient
    function IsthatPatient($name){
        global $dbh;
        $stmt=$dbh->prepare("SELECT * FROM Patient WHERE name=? ");
        $stmt->execute(array($name));
        return $stmt->fetch();
    }

    #verify if is a Nurse
    function IsthatNurse($name){
        global $dbh;
        $stmt=$dbh->prepare("SELECT * FROM Nurse WHERE name=? ");
        $stmt->execute(array($name));
        return $stmt->fetch();
    }
    
    #verify username/password
    function Validating($name,$password,$table){

        global $dbh;
        $stmt=$dbh->prepare("SELECT * FROM $table WHERE name=? AND password=?");
        $stmt->execute(array($name,shal($password)));
        return $stmt->fetch();
    }

    #verify username and after correspondent password
    function loginValid($name,$password){

        if(IsthatDoctor($name)!= FALSE){
            if(Validating($name,$password,Doctor)){
                header('Location: Doctor.php');
            }else{
                $_SESSION["msg"]="Login failed! Wrong Password.";
                // die(header('Location: index.php'));
            }
        }
        elseif(IsthatPatient($name)!= FALSE){
            if(Validating($name,$password,Patient)){
                header('Location: index_f_login.php');
            }else{
                $_SESSION["msg"]="Login failed! Wrong Password.";
                // die(header('Location: index.php'));
            }
        }
        elseif(IsthatNurse($name)!= FALSE){

            if(Validating($name,$password,Nurse)){
                header('Location: nurse.php');
            }else{
                $_SESSION["msg"]="Login failed! Wrong Password.";
                // die(header('Location: index.php'));
            }
        }
        else{
            $_SESSION["msg"]="Login failed! There is such username";
            die(header('Location: index.php'));
        }
    }


?>
  