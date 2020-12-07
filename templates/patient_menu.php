<section id="profile_pag">
        
        <article>
           <header id="dados">
             <img class="circle" src="images/w1.PNG" alt="" width="130">
             <h4><?php echo  $result["name"] ?></h4> 
           </header>
 
          
           <aside>
              <ul id="link_profile">
                <li><a href="">My Profile</a></li>
                <li><a href="">Appointment schedule</a></li>
                <li><a href="">My Appointment </a></li>
                <li><a href="">Medical prescriptions</a></li>
                <li><a href="">Inpatient Profile</a></li>
                </ul> 
             </aside>
            
          </article>
 
          <div class="info">
            <h2>Profile</h2>
            <span><?php echo $msg ?></span>
            
            <article class="info_section">
                <h4 >Personal identification: </h4>
                <h5 class="atribute">Name: <p><?php echo  $result["name"] ?></p></h5>
                <h5 class="atribute">Age:  <p><?php echo  $result["age"] ?></p></h5>
                <h5 class="atribute">CC:  <p><?php echo  $result["cc"] ?></p></h5> 
            </article> 

            <article class="info_section">
                <h4 class="info_section">Contacts: </h4>
                <h5 class="atribute">Mail Address: <p><?php echo  $result["mail_address"] ?></p></h5>
                <?php if (strlen($result["phone_number"])>0){?>
                <h5 class="atribute">Phone Number: <p><?php echo  $result["phone_number"]; }?></p></h5>
            </article> 

            <article class="info_section">
                <h4 class="info_section">Diagnosed disease: </h4>
                <?php if (strlen($result2["patient"])>0){?>
                <h5 class="atribute">Name: <p><?php echo  $result2['patient']; ?></p></h5>
                
                <?php }else { ?>
                  <h5 class="atribute"> <p> Fortunately, you have no diagnosed disease! (falta subtituir pela query das disease)</p></h5>
                <?php ; }?>
            </article> 
           
         </div>
 
       </section> 