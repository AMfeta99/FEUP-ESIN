    
    <section id="profile_pag">
    <article>
        <header id="dados">

        <img class="circle" src="images/w2.PNG" alt="" width="130">
        <h4><?php echo  $result["name"] ?></h4> 
        <h5><?php echo  $result2["Sname"] ?></h5>
        </header>

        
        <aside class="aside_profile">
          <input type="checkbox" id="hamburger">
          <label class="hamburger" id="prof" for="hamburger">
            <ul id="link_profile">
            <li><a href="">My Profile</a></li>
            <li><a href="">Department</a></li>
            <li><a href="">Inpatient Profile</a></li>
            <li><a href="">Log out</a></li>
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

          <h2>Department</h2>
          <article class="info_section">
                <h4>Beds: </h4>
               
                  <h5 class="atribute"> Total capacity:<p> <?php echo  $result_Tbeds["Total_beds"] ; ?> beds</p></h5> 
                  <h5 class="atribute">Beds Occupy:<p> <?php echo  $result_Occupybeds["occupy"] ;?> </p></h5>
             
            </article> 


            <article class="info_section">
                <h4 class="info_section">Inpatients: </h4>
                
                <?php foreach ($result3 as $row) { ?>
                  <h5 class="atribute"> 
                    <p>Name: <?php echo  $row["patient"] ?></p>
                    <h6 class= "subatribute">
                      <p >code: <?php echo  $row["code"] ?> </p>
                      <p >Bed: <?php echo  $row["bed"] ?></p>
                    </h6>
                  </h5>
                <?php  }?>
            </article> 

            <article class="info_section">
                <h4 class="info_section">Appointments: </h4>
                <?php //if(strlen($result4["patient"])>0) { ?>
               
                <?php foreach ($result4 as $row) { ?>
                  <h5 class="atribute"> 
                    <p>Name: <?php echo  $row["patient"] ?></p>
                    <h6 class= "subatribute"> <!-- Alterar Css -->
                    <p>Alterar Css : margin-left: 4% </p>
                    <p>Doctor: <?php echo  $row["Doctor"] ?></p>
                    <p>Date: <?php echo  $row["date"] ?> </p>
                    <p>Hour: <?php echo  $row["Hour"] ?> </p>
                    </h6>
                  </h5>
                <?php  }?>
                
            </article> 

    </div>

    </section> 