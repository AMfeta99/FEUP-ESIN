<section id="profile_pag">
          <article>
            <header id="dados">
              <!-- <img class="circle" src="images/doctors/9.jpg" alt="" width="130"> -->
              <img class="circle" src="<?php echo  $result["photo"] ?>" alt="" width="130">
              <h4><?php echo  $result["name"] ?></h4> 
              <h5><?php echo  $result2["Sname"] ?></h5>

            </header>
          
            <aside class="aside_profile">
              <input type="checkbox" id="hamburger">
              <label class="hamburger" id="prof" for="hamburger">
              <ul id="link_profile">
                <li><a href="">My Profile</a></li>
                <li><a href="">My Appointments</a></li>
                <li><a href="">Schedule</a></li>
                <li><a href="index.php#inpatient">Inpatients</a></li>
                <li><a href="index.php">Home</a></li>
              </ul>
              </label> 
            </aside>
          </article>

          <div class="info">
          <h2>Profile</h2>
          <span><?php echo $msg ?></span>

          <article class="info_section">
                <h4 >Personal identification: </h4>
                <h5 class="atribute">Name: <p><?php echo  $result["name"] ?></p></h5>
                <h5 class="atribute">Department:  <p><?php echo  $result2["Sname"] ?></p></h5>
            </article> 

            <article class="info_section">
                <h4 class="info_section">Contacts: </h4>
                <h5 class="atribute">Mail Address: <p><?php echo  $result["mail_address"] ?></p></h5>
                <?php if (strlen($result["phone_number"])>0){?>
                <h5 class="atribute">Phone Number: <p><?php echo  $result["phone_number"]; }?></p></h5>
            </article> 

            <h2>Appointments</h2>
            <article class="info_section">
                <h4 class="info_section">Scheduled appointments: </h4>
               
                <?php foreach ($result3 as $row) { ?>
                  <h5 class="atribute"> 
                    <p>Name: <?php echo  $row["patient"] ?></p>
                    <h6 class= "subatribute"> <!-- Alterar Css -->
                    <p>Date: <?php echo  $row["date"] ?> </p>
                    <p>Hour: <?php echo  $row["Hour"] ?> </p>
                    </h6>
                  </h5>
                <?php  }?>
                
            </article> 

            <article class="info_section">
                <h4 class="info_section">Reservation without answer: </h4>
                <?php foreach ($result4 as $row) { ?>
                 
                  <h5 class="atribute"> 
                    <p>Name: <?php echo  $row["patient"] ?></p>
                    <h6 class= "subatribute"> <!-- Alterar Css -->
                    <p>Date: <?php echo  $row["date"] ?> </p>
                    <p>Hour: <?php echo  $row["Hour"] ?> </p>
                    </h6>
                  </h5>
                <?php  }?>
                
            </article> 

            <h2>Inpatient</h2>
            <article class="info_section">
                <h4 class="info_section">Monitor inpatients: </h4>
               
                <?php foreach ($result_inpatient as $row) { ?>
                 
                  <h5 class="atribute"> 
                    <p>Name: <?php echo  $row["name"] ?></p>
                    <h6 class= "subatribute"> <!-- Alterar Css -->
                    <p>Bed: <?php echo  $row["bed"] ?> </p>
                    <p>Code: <?php echo  $row["code"] ?> </p>
                    </h6>
                  </h5>
                <?php  }?>
                <p> adicionar link para a pagina de cada paciente</p>
            </article> 
            
            <h2>Schedule</h2>

            <table id= "doctor schedule">
                  <?php $week_days = array('MON', 'TUE', 'WED', 'THU', 'FRI');?>
                  <?php $begin_hours = array('8:00','9:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00');?>
                  <tr> <!-- Linha 1-->
                    <th class ="b"> Hour</th>
                    <!-- for para correr todos os dias da semana -->
                    <th class ="b"> Monday </th>
                    <th class ="b"> Tuesday </th>
                    <th class ="b"> Wednesday </th>
                    <th class ="b"> Thursday </th>
                    <th class ="b"> Friday </th>
                  
                  </tr>
                  <?php foreach($begin_hours as $begin_hour){ ?> <!-- Para cada linha-->
                    <tr> 
                      
                      <th class ="block_time"> <?php echo $begin_hour?> - <?php echo $begin_hour+1;?>:00 </th>

                      <?php foreach($week_days as $day){ ?> <!-- Para cada coluna -->
                        <th class ="mark_appointment"> 
                          <?php canMakeAppointment($schedule, $begin_hour, $day); ?>
                        </th>
                      <?php }?>
                      
                    </tr>

                  <?php }?>
                  

            </table>
          </div>

        </section> 