<!DOCTYPE html>
<html lang="en">
  <head >
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="css_files/style.css" rel="stylesheet">
      <link href="css_files/style_buttons.css" rel="stylesheet">
      <link href="css_files/layout.css" rel="stylesheet">
      <link href="css_files/profile.css" rel="stylesheet">
      <link href="css_files/responsive.css" rel="stylesheet">

      <link rel="icon" type="imagem/jpg" href="images/Hospital.jpg" />
      <title>Hospital</title>
  </head>

  <body>
      <header id="header_profile">
        <div id="simbolo">
          <h1><a href="index.php">Hospital</a></h1>
          <img src="images/t2.png" alt="" width="30">
          <h3 id="username"><a href=""><?php echo $_SESSION["username"] ?></a></h3>
        </div>

        <div id="back">
          <h2><a>The best care just a click away!</a></h2>
         <?php if(isset($_SESSION['user'])) {?>
            <form class="name_back" action="logout_action.php">
              <input class="out" type="submit" value="Log out">
            </form>
            <?php }else{?>
              <p><a href="index.php" class="out">Back</a></p>
          <?php  } ?>

        </div>
      </header> 