<?php 
    require_once('config/init.php');
    require_once('database/inpatient.php');
    
    $code=$_POST["code"];

    try{
        echo "antes do if";
        if(getInpatientByCode($code)){
        echo "dentro do if";
        header('Location: inpatient.php');
    }
       

    }catch(PDOException $e){
        $_SESSION["msg_inpatient"]="Something goes wrong :(. There is no such Inpatient";
        header('Location: /project_esin/index.php');
        
        //  echo $e->getMessage(); 
    }
    

?>
  