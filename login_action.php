<?php
    session_start();
    require_once('config/init.php');
    

    // $funtion=$_POST["funtion"]
    $mail_address=$_POST["mail_address"];
    $password=$_POST["password"];

     #verify if is a Doctor
     function IsthatDoctor($mail_address){
        global $dbh;
        $stmt=$dbh->prepare("SELECT * FROM Doctor WHERE mail_address=? ");
        $stmt->execute(array($mail_address));
        return $stmt->fetch();
    }

     #verify if is a Patient
    function IsthatPatient($mail_address){
        global $dbh;
        $stmt=$dbh->prepare("SELECT * FROM Patient WHERE mail_address=? ");
        $stmt->execute(array($mail_address));
        return $stmt->fetch();
    }

    #verify if is a Nurse
    function IsthatNurse($mail_address){
        global $dbh;
        $stmt=$dbh->prepare("SELECT * FROM Nurse WHERE mail_address=? ");
        $stmt->execute(array($mail_address));
        return $stmt->fetch();
    }
    
    #verify usermail_address/password
    function Validating($mail_address,$password,$table){

        global $dbh;
        $stmt=$dbh->prepare("SELECT * FROM $table WHERE mail_address=? AND password=?");
        $stmt->execute(array($mail_address,shal($password)));
        return $stmt->fetch();
    }

    #verify usermail_address and after correspondent password
    function loginValid($mail_address,$password){
        
        if(IsthatDoctor($mail_address)!= FALSE){
            
            if(Validating($mail_address,$password,["Doctor"])){
                header('Location: Doctor.php');
            }else{
                $_SESSION["msg"]="Login failed! Wrong Password.";
                die(header('Location: index.php'));
            }
        }
        elseif(IsthatPatient($mail_address)!= FALSE){
            if(Validating($mail_address,$password,Patient)){
                header('Location: index_f_login.php');
            }else{
                $_SESSION["msg"]="Login failed! Wrong Password.";
                die(header('Location: index.php'));
            }
        }
        elseif(IsthatNurse($mail_address)!= FALSE){

            if(Validating($mail_address,$password,Nurse)){
                header('Location: nurse.php');
            }else{
                $_SESSION["msg"]="Login failed! Wrong Password.";
                die(header('Location: index.php'));
            }
        }
        else{
            $_SESSION["msg"]="Login failed! There is no such user";
            die(header('Location: index.php#logins'));
        }
    }


?>
  