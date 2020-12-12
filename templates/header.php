<!DOCTYPE html>
<html lang="en">
  <head >
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="css_files/style.css" rel="stylesheet">
      <link href="css_files/style_buttons.css" rel="stylesheet">
      <link href="css_files/layout.css" rel="stylesheet">
      <link href="css_files/forms.css" rel="stylesheet">
      <link href="templates/slicer.css" rel="stylesheet">
      <link href="css_files/responsive.css" rel="stylesheet">

      <link rel="icon" type="imagem/jpg" href="images/Hospital.jpg" />
      <title>Hospital</title>
  </head>

  <body>
      <header>
        <div id="simbolo">
          <h1><a href="index.php">Hospital</a></h1>
          <img src="images/t2.png" alt="simbolo" width="30">
          <!-- barra de pesquisa ... ainda não sei fazer mas seria fixe se conseguirmos
          <input type="text" name="search" placeholder="Search..">-->
        </div>
          
        <div id="frase_menu">
          
          <h2><a>The best care just a click away!</a></h2>

          <input type="checkbox" id="hamburger">
          <label class="hamburger" for="hamburger">
          <ul id="links">
            <li><a href="index.php#about_us">About us</a></li>
            <li><a href="index.php#logins">Track Inpatient</a></li>
            <li><a href="department.php">Departments&Doctors</a></li>
            <li><a href="register.php">Register</a></li>

            <?php if(!isset($_SESSION["user"])) { ?>
            <li><a href="index.php#logins">Login</a></li>
            <?php }else{?>
            <!-- acrecentar buttons para Log out -->
            <!-- <li><a href="index.php#logins">Logout</a></li> -->
            <?php } ?>
          </ul> </label>
        </div>
      </header>  