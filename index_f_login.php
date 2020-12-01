<?php
  $patient_cc=$_GET['cc'];
  $dbh = new PDO ('sqlite:hospital_manegment.db');
  
  $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  try{
    $stmt = $dbh->prepare("SELECT * FROM Patient WHERE Patient.cc=?");
    $stmt->execute(array($patient_cc));
    $result = $stmt->fetchAll; // array of arrays
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
      <link href="style.css" rel="stylesheet">
      <link href="style_buttons.css" rel="stylesheet">
      <link href="layout.css" rel="stylesheet">

      <link rel="icon" type="imagem/jpg" href="images/Hospital.jpg" />
      <title>Hospital</title>
  </head>

  <body>
    <header>
        <div id="simbolo"> 
          <h1><a href="index.html">Hospital</a></h1>
          <img src="images/t2.png" alt="" width="30">
        </div>
        <div id="back">
          <h2><a>The best care just a click away!</a></h2>
          <a href="index.html" id="out">Back</a>
        </div>
      </header>
      
      <section id="profile_pag">
        <article>
       
          <header id="dados">
            <img class="circle" src="images/w1.png" alt="" width="130">
            <h4><?php echo  $result["name"] ?> não entendi pq é q isto não dá</h4> 
            <h4><?php echo  $patient_cc ?></h4> 
          </header>

          <aside>
             <ul id="link_profile">
               <li><a href="">Appointment schedule</a></li>
               <li><a href="">My Appointment </a></li>
               <li><a href="">Medical prescriptions</a></li>
               <li><a href="">Impatient Profile</a></li>
               </ul> 
            </aside>

         </article>
      </section> 
      
      <footer>
        <h3>Contacts</h3>
        <p>address: sdfgsjjdhkgzlfg bskfdjsçjhkfjsnflsfsf jsfldgçsg </p>
      </footer>
  </body>
 
</html>