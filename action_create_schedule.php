<?php
    require_once('config/init.php');
    require_once('database/schedule.php');
   
    if(!empty($_POST['check_list'])) {
        foreach($_POST['check_list'] as $check) {
            
            $string = explode("|", $check );
            
            if($string){
            
                $_SESSION["week_day"]=$string[1];
                $_SESSION["time"] = $string[0];
            }

            $time = $_SESSION["time"];
            $week_day = $_SESSION["week_day"];

            try{
                $code=getBlock_time($time,$week_day);
                insertSchedule($code, $_SESSION["doctor_id"]);
                $id_doc = $_SESSION["doctor_id"];
                $_SESSION["msg"]="Schedule Create Successfully";
                header("Location: Doctor.php?id=$id_doc");
               
             }catch(PDOException $e){
                $_SESSION["msg"]=" Request submission failed";
                header("Location: Doctor.php?id=$id_doc");
             }
        }
    }

?>