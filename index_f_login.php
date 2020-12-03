<?php
  $patient_cc=$_GET['cc'];
  require_once('config/init.php');
  require_once('database/patient.php');
  try{
    $result = getPatientById($patient_cc); // array of arrays
  } catch(PDOException $e){
    $err = $e-> getMessage();
    exit(0);
  }
?>


<!DOCTYPE html>

<html lang="en">
  <head >
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="css/style.css" rel="stylesheet">
      <link href="css/style_buttons.css" rel="stylesheet">
      <link href="css/layout.css" rel="stylesheet">

      <link rel="icon" type="imagem/jpg" href="images/Hospital.jpg" />
      <title>Hospital</title>
  </head>

  <body>
    <header>
        <div id="simbolo"> 
          <h1><a href="index.php">Hospital</a></h1>
          <img src="images/t2.png" alt="" width="30">
        </div>
        <div id="back">
          <h2><a>The best care just a click away!</a></h2>
          <a href="index.php" id="out">Back</a>
        </div>
      </header>
      
      <section id="profile_pag">
        
       <article>
          <header id="dados">
            <img class="circle" src="images/w1.PNG" alt="" width="130">
            <h4><?php echo  $result["name"] ?></h4> 
          </header>

         
          <aside>
             <ul id="link_profile">
               <li><a href="">My Profile</a></li>
               <li><a href="">Appointment schedule</a></li>
               <li><a href="">My Appointment </a></li>
               <li><a href="">Medical prescriptions</a></li>
               <li><a href="">Inpatient Profile</a></li>
               </ul> 
            </aside>
           
         </article>

         <div class="info">
         <p> ghvbsdkaskldfj asfhaskdjfoi </p>
        </div>

      </section> 
      
      <footer>
        <h3>Contacts</h3>
        <p>address: sdfgsjjdhkgzlfg bskfdjsçjhkfjsnflsfsf jsfldgçsg </p>
      </footer>
  </body>
 
</html>
