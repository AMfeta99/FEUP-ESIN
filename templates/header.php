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
      <link href="css_files/profile.css" rel="stylesheet">

      <link rel="icon" type="imagem/jpg" href="images/Hospital.jpg" />
      <title>Hospital</title>
  </head>

  <body>
      <header>
        <div id="simbolo">
          <h1><a href="index.php">Hospital</a></h1>
          <img src="images/t2.png" alt="simbolo" width="30">
        </div>
          <h2 id="username"><?php if(isset($_SESSION["username"])) { 
            echo $_SESSION["username"] ;}?></h2>
          
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
            <?php }else{?>
              <li><a href="">Profile</a></li>
              <li><form action="logout_action.php">
                <button class="out" type="submit">Log out</button>
             </form></li>
            <?php } ?>
          </ul> </label>
        </div>
      </header>  