<?php
   

    function insertSchedule($code, $doctor_id){
        global $dbh;
        $stmt= $dbh->prepare("INSERT INTO Block_time_and_Doctor(block_time, doctor) VALUES (?, ?);");
        $stmt->execute(array($code, $doctor_id));
    }


    function getBlock_time($time ,$week_day){
        global $dbh;
        $stmt = $dbh->prepare("SELECT code FROM Block_time
                                WHERE begin_time=? AND week_day=?");
       $stmt->execute(array($time,$week_day));
       return $stmt->fetch()['code'];
    }



?>