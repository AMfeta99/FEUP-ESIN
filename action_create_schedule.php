<?php
    require_once('config/init.php');

    function getBlock_time($time ,$week_day){
        global $dbh;

        $stmt = $dbh->prepare("SELECT code FROM Block_time
                                WHERE begin_time=? AND week_day=?");
       $stmt->execute(array($time,$week_day));
       return $stmt->fetch();
    }


    function insertSchedule($code, $doctor_id){
        global $dbh;
        $stmt= $dbh->prepare("INSERT INTO Block_time_and_Doctor(block_time, doctor) VALUES (?, ?);");
        $stmt->execute(array($code, $doctor_id));
    }

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
                insertSchedule($code["code"], $_SESSION["doctor_id"]);
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