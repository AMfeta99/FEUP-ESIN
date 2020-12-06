
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
              <div><a href="register.php" id="join" class="descritext" style="font-size: 30px;">Join us</a> </div>
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

        <section id = "about_us" class = "about">
      
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
                <div id="speciality_cards"><a href="departament&doctors.php?dep=<?php echo $row["number"]?>&name=<?php echo $row["name"]?>" >
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
              
              <form action="login_action.php" method="post">
                <header>
                  <h2>Login</h2>
                </header>
                <div>
                  <label><b>Username</b></label>
                  <input type="text" placeholder="Enter Username" name="name" required>
              
                  <label><b>Password</b></label>
                  <input type="password" placeholder="Enter Password" name="password" required>
    
                  <button type="submit" >Submit</button>
                  <!-- <input class="submit" type="submit"  value="Login" ></input> -->
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