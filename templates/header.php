<!DOCTYPE html>
<html lang="en">
  <head >
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="css_files/style.css" rel="stylesheet">
      <link href="css_files/style_buttons.css" rel="stylesheet">
      <link href="css_files/layout.css" rel="stylesheet">
      <link href="css_files/forms.css" rel="stylesheet">
      <link href="css_files/slicer.css" rel="stylesheet">
      <link href="css_files/responsive.css" rel="stylesheet">
      <link href="css_files/profile.css" rel="stylesheet">

      <link rel="icon" type="imagem/jpg" href="images/Hospital.jpg" />
      <title>Hospital</title>
  </head>

  <body>
      <header>
        <div id="simbolo">
          <h1><a href="index.php">Hospital</a></h1>
          <img src="images/t2.png" alt="simbolo" width="30">
          <?php if ($_SESSION["funtion"] == "Doctor") {
            $ref = "Doctor.php?id=" . $_SESSION["user"];
          } else if ($_SESSION["funtion"] == "Nurse")
            $ref = "nurse.php?id=" . $_SESSION["user"];
          else if ($_SESSION["funtion"] == "Patient")
            $ref = "index_f_login.php?cc=" . $_SESSION["user"];
          ?>
          <h3 id="username"><a href="<?php echo $ref ?>"><?php echo $_SESSION["username"] ?></a></h3>
        </div>
          
          
        <div id="frase_menu">
          
          <h2><a>The best care just a click away!</a></h2>
          

          <input type="checkbox" id="hamburger">
          <label class="hamburger" for="hamburger">
            <ul id="links">
              <li><a href="index.php#about_us">About us</a></li>
              <li><a href="index.php#logins">Track Inpatient</a></li>
              <li><a href="department.php">Departments&Doctors</a></li>

                <?php if(!isset($_SESSION["user"])) { ?>
                <li><a href="index.php#logins">Login</a></li>
                <li><a href="register.php">Register</a></li>
                <?php }else{ 
                            $id=$_SESSION["user"]; ?>

                  <?php if($_SESSION["funtion"]=="Doctor"){?>
                   <li><a href='Doctor.php?id=<?php echo $id ?>'>Profile</a></li>
                  <?php }elseif($_SESSION["funtion"]=="Nurse"){ ?>
                    <li><a href=' nurse.php?id=<?php echo $id ?>'>Profile</a></li>
                  <?php }elseif($_SESSION["funtion"]=="Patient"){ ?>
                    <li><a href=' index_f_login.php?cc=<?php echo $id ?>'>Profile</a></li>
                 <?php } ?>
                  <li><form action="logout_action.php">
                    <button class="out" type="submit">Log out</button>
                </form></li>
                <?php } ?>
            </ul>
         </label>
        </div>
      </header>  