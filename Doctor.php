<?php
  $doctor_id=$_GET['id'];
  $dbh = new PDO ('sqlite:hospital_manegment.db');
  
  $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  try{
    $stmt = $dbh->prepare("SELECT * FROM Doctor WHERE id=?");
    $stmt->execute(array($doctor_id));
    $result = $stmt->fetch(); 

    $stmt = $dbh->prepare("SELECT Department.name as Sname FROM Department JOIN Doctor ON Department.number=speciality WHERE id=?");
    $stmt->execute(array($doctor_id));
    $result2 = $stmt->fetch(); 

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
      <header id="header_profile">
        <div id="simbolo">
          <h1><a href="index.php">Hospital</a></h1>
          <img src="images/t2.png" alt="" width="30">
        </div>
        <div id="back">
          <h2><a>The best care just a click away!</a></h2>
          <a href="index.php" id="out">Log Out</a>
          
        </div>
      </header>  
      
      <section id="profile_pag">
        <article>
          <header id="dados">
            <img class="circle" src="images/w3.PNG" alt="" width="130">
            <h4><?php echo  $result["name"] ?></h4> 
            <h5><?php echo  $result2["Sname"] ?></h5>

          </header>
        
          <aside>
             <ul id="link_profile">
               <li><a href="">My Profile</a></li>
               <li><a href="">Schedule</a></li>
               <li><a href="">My Appointments</a></li>
               <li><a href="">Inpatients</a></li>
               <li><a href="index.html">Log out</a></li>
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