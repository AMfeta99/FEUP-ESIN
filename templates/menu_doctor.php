<section id="profile_pag">
          <article>
            <header id="dados">
              <!-- <img class="circle" src="images/doctors/9.jpg" alt="" width="130"> -->
              <img class="circle" src="<?php echo  $result["photo"] ?>" alt="" width="130">
              <h4><?php echo  $result["name"] ?></h4> 
              <h5><?php echo  $result2["Sname"] ?></h5>

            </header>
          
            <aside>
              <ul id="link_profile">
                <li><a href="">My Profile</a></li>
                <li><a href="">Schedule</a></li>
                <li><a href="">My Appointments</a></li>
                <li><a href="">Inpatients</a></li>
                <li><a href="index.php">Log out</a></li>
              </ul> 
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

          </div>

        </section> 