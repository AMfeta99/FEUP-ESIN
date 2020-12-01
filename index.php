<!-- Pagina inicial-->
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
      <link href="slicer.css" rel="stylesheet">
      <link href="forms.css" rel="stylesheet">

      <link rel="icon" type="imagem/jpg" href="images/Hospital.jpg" />
      <title>Hospital</title>
  </head>

  <body>
      <header>
        <div id="simbolo">
          <h1><a href="index.html">Hospital</a></h1>
          <img src="images/t2.png" alt="simbolo" width="30">
          <!-- barra de pesquisa ... ainda não sei fazer mas seria fixe se conseguirmos
          <input type="text" name="search" placeholder="Search..">-->
        </div>
        <div id="frase_menu">
          <h2><a>The best care just a click away!</a></h2>
          
          <ul id="links">
            <li><a href="index.html">About us</a></li>
            <li><a href="#logins">Track Inpatient</a></li>
            <li><a href="department.php">Departments&Doctors</a></li>
            <li><a href="register.html">Register</a></li>
            <li><a href="#logins">Login</a></li>
          </ul> </div>
      </header>  
      
      <section id="presentation">
        <!--imagens em slides com texto descrivo e funcionalidades do website-->
          <article class="slideContainer">

            <div class="mySlide">
              <img src="http://www.comerciarios.net/img/medico.jpg" alt="1 " style="width:100%">
              <div class="descritext" >The best health professionals at your service come to know!</div>
            </div>
          
            <div class="mySlide">
              <div class="titletext">Patient Profile</div>
              <img src="images/6.jpg" alt="2" style="width:100%">
              <div class="descritext">The profile allows you to consult scheduled appointments, prescriptions and see your entire medical history</div>
            </div>
          
            <div class="mySlide">
              <div class="titletext">Departments and Doctors</div>
              <img src="images/5.png" alt="3 " style="width:100%">
              <div class="descritext">Discover the services that we have to offer and our healthcare professionals</div>
            </div>
          
            <div class="mySlide">
              <div class="titletext">Appointment</div>
              <img src="https://saudebusiness.com/wp-content/uploads/2019/03/consultas-medicas.jpg" alt="4 " style="width:100%">
              <div class="descritext">Schedule an appointment with any doctor</div>
            </div>
          
            <div class="mySlide">
              <div class="titletext">The best care just a click away!</div>
              <img src="http://portaldocoracao.com.br/wp-content/uploads/2008/11/cardiologista.jpg" alt="5 " style="width:100%">
              <div><a href="register.html" id="join" class="descritext" style="font-size: 30px;">Join us</a> </div>
            </div>
          
          </article>
          <br>
          
          <!---pontos/bolas do slicer-->
          <div style="text-align:center">
            <span class="dot" onclick="currentSlide(1)"></span> 
            <span class="dot" onclick="currentSlide(2)"></span> 
            <span class="dot" onclick="currentSlide(3)"></span> 
            <span class="dot" onclick="currentSlide(4)"></span> 
            <span class="dot" onclick="currentSlide(5)"></span> 
          </div>

        <section class = "about">
      
          <h2 class="heading">ABOUT US</h2>
          <div class = "hospital-img" >
            <img src="images/hos.jpg" class="img-fluid" alt="6" style="width:100%">
          </div>

          <div class = "text-block">
          <h3>We make a Difference in your lives</h3>
            <p>introdução</p>
            <br>
            <p> Falar dos departamentos e da equipa médica bla bla bla</p>
          </div>
          
        </section>

        <!-- Departments -->
        <section id = "departments">

          <h2 class="heading">Departments</h2>
          <p>Our hospital has about 10 different services </p>

          <section class = "departments">
           
            <div id="indexdepartment" class = "departments_block">

               <?php if ($err == null) { ?> <!--if there was no error -->
               <?php foreach ($result as $row) { ?> 

              <div class="col-6 ">
                <div id="speciality_cards"><a href="departament&doctors.html" >
                      <div>
                      <img src="images/departments/<?php echo $row["number"]?>.jpg" alt="7" style = "width: 100%; height: 160px;" >
                      <p><?php echo $row["name"] ?></p>
                    </a></div>
               </div>
              </div> 

              <?php } ?>
              <?php } else {?> 
                <p><?php echo "There was an error retrieving the categories"; ?></p>
              <?php } ?>

            </div>
          </section>

 
        </section>
        <p>asfzdxgtchgfdesdfghjkjhgfdes escrever alguma coisa informativa sobre impatient </p>

        <section id = "logins">
          <article id="login">
              
              <form id="doctor" action="login.php" method="get">
                <header>
                  <h2>Login</h2>
                </header>
                <div>
                  <label><b>Username</b></label>
                  <input type="text" placeholder="Enter Username" name="name" required>
              
                  <label><b>Password</b></label>
                  <input type="password" placeholder="Enter Password" name="password" required>
    
                  <button type="submit" >Submit</button>
                </div>
              </form>

          </article>

        

          <article id="inpatient">
            <!---<img src="https://s.hdnux.com/photos/73/01/67/15474130/3/920x920.jpg" alt="" >-->
            <form id="track" action="inpatient.php" method="get">
              <header>
                <h2>Inpatient</h2>
              </header>
              <div>
                <label><b>Username</b></label>
                <input type="text" placeholder="Enter code" name="code" required>
            
                <button type="submit" >Submit</button>

              </div>
            </form>
          </article>
        </section>
      </section>  

    <footer>
      <h3>Contacts</h3>
      <p>address: sdfgsjjdhkgzlfg bskfdjsçjhkfjsnflsfsf jsfldgçsg </p>
    </footer>


    <script>
  //este script permite passar os slides
      var slideIndex = 1;
      showSlides(slideIndex);
      
      function currentSlide(n) {
        showSlides(slideIndex = n);
      }
      
      function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlide");
        var dots = document.getElementsByClassName("dot");
        if (n > slides.length) {slideIndex = 1}    
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";  
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block";  
        dots[slideIndex-1].className += " active";
      }
      </script>

  </body>

</html>