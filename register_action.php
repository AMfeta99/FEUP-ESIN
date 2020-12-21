<?php
    require_once('config/init.php');
    require_once('database/department.php');
    require_once('database/user.php');
    $name=$_POST["name"];
    $phone_number=$_POST["phone_number"];
    $mail_address=$_POST["email"];
    $mail_address=strval($mail_address);

    $password=$_POST["password"];
    $department=$_POST["department"];
    $cc=$_POST["cc"];
    $age=$_POST["age"];

    $photo=$_FILES["photo"];
    //var_dump($photo);
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


    try{
        if($_SESSION["funtion"]=="Nurse"){
            if(strlen($department)==0){
                $_SESSION["msg"]="Registe Invalid! Please insert your Department!";
                header('Location: register_N.php');
                die();
            }
            if(!CheckDepartment($department)){
                $_SESSION["msg"]="Registe Invalid! There is no such Department!";
                header('Location: register_N.php');
                die();
            }

        insertNurse($name,$phone_number, $mail_address,$password,$department);
        $_SESSION["msg"]=" Nurse registe sucessful";
        header("Location: index.php");
        }
        elseif($_SESSION["funtion"]=="Patient"){

            if(strlen($age)==0){
                $_SESSION["msg"]="Registe Invalid! Please insert your age!";
                header('Location: register_P.php');
                die();
            }
            if(($age)<=0){
                $_SESSION["msg"]="Invalid age!";
                header('Location: register_P.php');
                die();
            }
            if($cc==null){
                $_SESSION["msg"]="Invalid ! Please insert your CC";
                header('Location: register_P.php');
                die();
            }
            insertPatient($cc,$name,$age,$phone_number,$mail_address,$password);
            $_SESSION["msg"]=" Patient Registe sucessful";
            header('Location: index.php');
        }
        elseif($_SESSION["funtion"]=="Doctor"){
            if(strlen($department)==0){
                $_SESSION["msg"]="Registe Invalid! Please insert your Department!";
                header('Location: register_D.php');
                die();
            }
            if(!CheckDepartment($department)){
                $_SESSION["msg"]="Registe Invalid! There is no such Department!";
                header('Location: register_D.php');
                die();
            }
            $pic_name = $_FILES['photo']['name'];
            $photo= "images/doctors/$pic_name";
            insertDoctor($name,$photo,$phone_number,$mail_address,$password,$department);
            saveProfilePicture($name);
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

     }
?>