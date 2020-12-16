<?php
    require_once('config/init.php');
    // $funtion=$_POST["funtion"]
    $mail_address=$_POST["email"];
    $mail_address=strval($mail_address);
    $password=$_POST["password"];

    if(strlen(strval($password))<2){
        $_SESSION["msg_log"]="Please Insert your Password!";
        header('Location: index.php#logins');
        die();
    }
    if(strlen($mail_address)==0){
        $_SESSION["msg_log"]="Please Insert your Mail Address!";
        header('Location: index.php#logins');
        die();
    }

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
        $stmt->execute(array($mail_address,$password));
        return $stmt->fetch();
    }

    #verify usermail_address and after correspondent password
    function loginValid($mail_address,$password){
        
        if(IsthatDoctor($mail_address)){
            $table="Doctor";
            if(Validating($mail_address,$password,$table)){
                $result=IsthatDoctor($mail_address);
                $id=$result["id"];
                $_SESSION["user"]=$id;
                $_SESSION["funtion"]="Doctor";
                $_SESSION["username"]=$result["name"];
                header("Location: Doctor.php?id=$id");
            }else{
                $_SESSION["msg_log"]="Login failed! Wrong Password.";
                header('Location: index.php#logins');
                die();
            }
        }
        elseif(IsthatPatient($mail_address)){
            $table="Patient";
            if(Validating($mail_address,$password,$table)){
                $result=IsthatPatient($mail_address);
                $cc=$result["cc"];
                $_SESSION["user"]=$cc;
                $_SESSION["funtion"]="Patient";
                $_SESSION["username"]=$result["name"];

                header("Location: index_f_login.php?cc=$cc");
            }else{
                $_SESSION["msg_log"]="Login failed! Wrong Password.";
                header('Location: index.php#logins');
                die();
            }
        }
        elseif(IsthatNurse($mail_address)){
            $table="Nurse";
            if(Validating($mail_address,$password, $table)){
                $result=IsthatNurse($mail_address);
                $id=$result["id"];
                $_SESSION["user"]=$id;
                $_SESSION["funtion"]="Nurse";
                $_SESSION["username"]=$result["name"];
                
                header("Location: nurse.php?id=$id");
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
  