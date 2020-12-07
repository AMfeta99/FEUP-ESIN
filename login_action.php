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
        $stmt->execute(array($mail_address,sha1($password)));
        return $stmt->fetch();
    }

    #verify usermail_address and after correspondent password
    function loginValid($mail_address,$password){
        
        if(IsthatDoctor($mail_address)!= FALSE){
            $table=["Doctor"];
            if(Validating($mail_address,$password,$table)){
                $_SESSION["user"]=$mail_address;
                header('Location: Doctor.php');
            }else{
                $_SESSION["msg_log"]="Login failed! Wrong Password.";
                header('Location: index.php#logins');
                // die();
            }
        }
        elseif(IsthatPatient($mail_address)!= FALSE){
            $table=["Patient"];
            if(Validating($mail_address,$password,$table)){
                $_SESSION["user"]=$mail_address;
                header('Location: index_f_login.php');
            }else{
                $_SESSION["msg_log"]="Login failed! Wrong Password.";
                header('Location: index.php#logins');
                die();
            }
        }
        elseif(IsthatNurse($mail_address)!= FALSE){
            $table=["Nurse"];
            if(Validating($mail_address,$password, $table)){
                $_SESSION["user"]=$mail_address;
                header('Location: nurse.php');
            }else{
                $_SESSION["msg_log"]="Login failed! Wrong Password.";
                header('Location: index.php#logins');
                die();
            }
        }
        else{
            $_SESSION["msg_log"]="Login failed! There is no such user";
            header('Location: index.php#logins');
            die();
        }
    }

    loginValid($mail_address,$password);

?>
  