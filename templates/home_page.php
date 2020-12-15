
   
    <span><?php echo $msg ;?></span>
    <section id="presentation">
        <!--imagens em slides com texto descrivo e funcionalidades do website-->
          <article class="slideContainer">

            <div class="mySlide" id="slide_1" style="display: block">
            <div class="titletext">Welcome ! <a href="#slide_2" class="setas"> ></a></div>
              <img src="http://www.comerciarios.net/img/medico.jpg" alt="1 " style="width:100%">
              <div class="descritext" >The best health professionals at your service come to know! </div>
            </div>
          
            <div class="mySlide" id="slide_2" style="display: block">
              <div class="titletext"><a href="#slide_1"> <</a>Patient Profile <a href="#slide_3"> ></a></div>
              <img src="images/6.jpg" alt="2" style="width:100% ">
              <div class="descritext">The profile allows you to consult scheduled appointments, prescriptions and see your entire medical history</div>
            </div>
        
            <div class="mySlide" id="slide_3" style="display: block">
              <div class="titletext"><a href="#slide_2"> <</a>Departments and Doctors <a href="#slide_4"> ></a></div>
              <img src="http://medintegra.es/wp-content/uploads/2012/09/Medicina-personalizada.jpg" alt="3 " style="width:100%">
              <div class="descritext">Discover the services that we have to offer and our healthcare professionals</div>
            </div>
          
            <div class="mySlide" id="slide_4" style="display: block">
              <div class="titletext"><a href="#slide_3"> <</a> Appointment <a href="#slide_5"> ></a></div>
              <img src="http://neuroser.pt/wp-content/uploads/2015/02/07.-Servi%C3%A7os-Planos-Interven%C3%A7%C3%A3o_filtro.jpg" alt="4 " style="width:100%">
              <div class="descritext">Schedule an appointment with any doctor</div>
            </div>
          
            <div class="mySlide" id="slide_5" style="display: block">
              <div class="titletext"><a href="#slide_4"> <</a>The best care just a click away!<a href="#slide_1"> ></a></div>
              <img src="http://portaldocoracao.com.br/wp-content/uploads/2008/11/cardiologista.jpg" alt="5 " style="width:100%">
              <div class="descritext"><a href="register.php" id="join"  style=" color:white; font-size: 30px; ">Join us</a> </div>
            </div>
          
          </article>

          <br>

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
        <p>Even when you're far away, you can always be around. You can accompany a family member or friend who is hospitalized, consult their status and evolution and always know the service, bed and time of visits. </p>

        <section id = "logins">
        
          <article id="login">
              
              <form action="login_action.php" method="post">
                <header>
                  <h2>Login</h2>
                </header>
                <div>
                  <label><b>Email</b></label>
                  <input type="text" placeholder="Enter email" name="email" required>
              
                  <label><b>Password</b></label>
                  <input type="password" placeholder="Enter Password" name="password" >
    
                  <button type="submit" class="enviar" >Submit</button>
                  <!-- <input class="submit" type="submit"  value="Login" ></input> -->
                </div>
              </form>
              <span><?php echo $msg_log ?></span>

          </article>

          <article id="inpatient">
            <form id="track" action="inpatient_action.php" method="post">
              <header>
                <h2>Inpatient</h2>
              </header>
              <div>
                <label><b>Code</b></label>
                <input type="text" placeholder="Enter code" name="code" required>
            
                <button type="submit" class="enviar">Submit</button>
                <span><?php echo $msg_inpatient?></span>
              </div>
            </form>
          </article>
        </section>
      </section>