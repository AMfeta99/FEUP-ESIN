<?php
  $nurse_id=$_GET['id'];
  $dbh = new PDO ('sqlite:hospital_manegment.db');
  
  $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  try{
    $stmt = $dbh->prepare("SELECT * FROM Nurse WHERE id=?");
    $stmt->execute(array($nurse_id));
    $result = $stmt->fetch(); 
    
    $stmt = $dbh->prepare("SELECT Department.name as Sname FROM Department JOIN Nurse ON Department.number=Nurse.department WHERE id=?");
    $stmt->execute(array($nurse_id));
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

            <img class="circle" src="images/w2.PNG" alt="" width="130">
            <h4><?php echo  $result["name"] ?></h4> 
            <h5><?php echo  $result2["Sname"] ?></h5>
          </header>

          <!--
          <input type="checkbox" id="hamburger"> 
          <label class="hamburger" for="hamburger"></label>-->
          <aside>
             <ul id="link_profile">
               <li><a href="">My Profile</a></li>
               <li><a href="">Department</a></li><ul>
                   <li><a href="">Beds</a></li>
                   <li><a href="">Appointments</a></li>
                </ul>
               <li><a href="">Inpatient Profile</a></li>
               <li><a href="">Log out</a></li>
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