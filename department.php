<?php

  $dbh = new PDO ('sqlite:hospital_manegment.db');
  
  $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  try{
    $stmt = $dbh->prepare('SELECT * FROM Department');
    $stmt->execute();
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

      <link rel="icon" type="imagem/jpg" href="images/Hospital.jpg" />
      <title>Hospital</title>
  </head>

  <body>
      <header>
        <div id="simbolo">
          <h1><a href="index.php">Hospital</a></h1>
          <img src="images/t2.png" alt="" width="30">
        </div>
        <div id="frase_menu">
          <h2><a>The best care just a click away!</a></h2>
          
          <ul id="links">
            <li><a href="index.php">Home</a></li>
            <li><a href="index.php">Track Inpatient</a></li>
            <li><a href="register.html">Register</a></li>
            <li><a href="index.php">Login</a></li>
          </ul> </div>
      </header>  
      
      <section id="department">
        <article>
            <header>
              <h2 class="pagtitle">Departments</h2>
            </header>
            <p>departamentos bla bla bla.</p>

            <section class = "departments">
            
              <div id="pagdepartment" class = "departments_block">
                <?php if ($err == null) { ?> <!--if there was no error -->
                <?php foreach ($result as $row) { ?>  

                <div class="col-6">
                  <div id="speciality_cards_dep"><a href="departament&doctors.php?dep=<?php echo $row["number"]?>&name=<?php echo $row["name"]?>">
                      <img src="images/departments/<?php echo $row["number"]?>.jpg" alt="7" style = "width:100%; height: 250px;" >
                      <p><?php echo $row["name"] ?></p>
                </div></a>   
                </div>

                    <?php } ?>
                    <?php } else {?> 
                      <p><?php echo "There was an error retrieving the categories"; ?></p>
                    <?php } ?>
              </div>

            </section>
          </article>
      </section> 

      <footer>
        <h3>Contacts</h3>
        <p>address: sdfgsjjdhkgzlfg bskfdjsçjhkfjsnflsfsf jsfldgçsg </p>
      </footer>
  </body>
 
</html>