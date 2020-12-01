<?php

  $Department_name=$_GET['name'];
  $dep_number=$_GET['dep'];
  $dbh = new PDO ('sqlite:hospital_manegment.db');
  
  $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  try{
    $stmt = $dbh->prepare("SELECT Doctor.name, Doctor.phone_number, Doctor.mail_address, Department.name as speciality
    FROM Doctor JOIN Department ON Doctor.speciality= Department.number WHERE speciality=?");

    $stmt->execute(array($dep_number));
    $result = $stmt->fetchAll(); // array of arrays
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

      <link rel="icon" type="imagem/jpg" href="Hospital.jpg" />
      <title>Hospital</title>
  </head>

  <body>
      <header>
        <div id="simbolo">
          <h1><a href="index.html">Hospital</a></h1>
          <img src="t2.png" alt="" width="30">
        </div>
        <div id="frase_menu">
          <h2><a>The best care just a click away!</a></h2>
          
          <ul id="links">
            <li><a href="index.php">Home</a></li>
            <li><a href="department.php">Departments</a></li>
            <li><a href="index.php">Track Inpatient</a></li>
            <li><a href="register.html">Register</a></li>
            <li><a href="index.php">Login</a></li>
          </ul> </div>
      </header>  
      
      <section id="department">
      <article>
          <header> <!--não estou a entender pq não está a dar-->
            <h2 class="pagtitle"><?php echo $Department_name ?></h2>
          </header>
         

          <section class = "Doctors_list">
           <p>departamento bla bla bla sxdfcvghbkjngf dfcgvhbkjn dfhjlk .</p>
           <p>só uma mini descrição bla bla bla sxdfcvghbkjngf dfcgvhbkjn dfhjlk .</p>
           <p>não sei se ficou bonita esta pagina podes mudar se quiseres  sxdfcvghbkjngf dfcgvhbkjn dfhjlk .</p>

              <?php if ($err == null) { ?> <!--if there was no error -->
              <?php foreach ($result as $row) { ?>  
               <ul>
                <a href="index.html" ><il class="especialista">

                    <h4> <?php echo $row["name"] ?><br></h4>
                    <img class="circle" src="w3.PNG" alt="16" style="width: 150px;">
                    <h4> <br><br><?php echo $row["phone_number"] ?><br> <?php echo $row["mail_address"] ?></h4>
                    
                </il></a>
               
              </ul>
              
              <?php } ?>
              <?php } else {?> 
                <p><?php echo "There was an error retrieving the categories"; ?></p>
              <?php } ?>
          </section>

        </article>
      </section> 

      <footer>
        <h3>Contacts</h3>
        <p>address: sdfgsjjdhkgzlfg bskfdjsçjhkfjsnflsfsf jsfldgçsg </p>
      </footer>
  </body>
 
</html>