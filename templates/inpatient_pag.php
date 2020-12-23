<section id="profile_pag">
          <article>
            <header id="dados">

              <h4><?php echo  $result2["name"] ?></h4> 
              <h5>Code: <?php echo  $result2["code"] ?></h5>

            </header>
            
              <aside class="aside_profile">
              <input type="checkbox" id="hamburger">
              <label class="hamburger" id="prof" for="hamburger">
                <ul id="link_profile">
                  
                      <li ><a href="">Inpatient Info</a></li>
                      <li ><a href="">Medication</a></li>
                      <li ><a href="">Daily Reports</a></li>
                    
                </ul> 
              </label>
              </aside>
         
          </article>

          <div class="info">
          <span><?php echo $msg_inpatient?></span>
            <h2>Patient Info:</h2>
            
            <article class="info_section">
                <!-- <h4 >Patient Info: </h4> -->
                <h5 class="atribute">Name: <p><?php echo  $result2["name"] ?></p></h5>
                <h5 class="atribute">Age:  <p><?php echo  $result2["age"] ?></p></h5>
                <h5 class="atribute">CC:  <p><?php echo  $result2["cc"] ?></p></h5> 
                <h5 class="atribute">Mail Address: <p><?php echo  $result2["mail_address"] ?></p></h5>
                <?php if (strlen($result2["phone_number"])>0){?>
                <h5 class="atribute">Phone Number: <p><?php echo  $result2["phone_number"]; }?></p></h5>
                <h5 class="atribute">Diagnosed disease: <p> As doenças estão associadas às appointments do patient</p></h5>
            </article>
            
            <h2>Internment:</h2>
            <article class="info_section">
                <h4 class="info_section">Internment Info: </h4>
               
                <h5 class="atribute">Doctor: <p><?php echo  $result3["doctor_name"]; ?> (  Colocar link que referencie para o doctor )</p></h5> 
                <h5 class="atribute">Doctor mail: <p><?php echo  $result3["doctor_mail"]; ?></p></h5> 
                <h5 class="atribute">Bed: <p><?php echo  $result4["bed"]; ?></p></h5> 
                <h5 class="atribute">Department: <p><?php echo  $result4["dep_name"]; ?></p></h5> 
                <h5 class="atribute">Visiting Hours: <p><?php echo  $result4["visiting_hours"]; ?></p></h5> 
            </article> 

         
            <article class="info_section">
                <h4 class="info_section">Medication: </h4>
                <?php if ($err == null) { ?> <!--if there was no error -->
                <?php foreach ($result5 as $row) { ?> 
                  <h5 class="atribute">Name: <p><?php echo  $row["name_med"]; ?> <tab> Dose: <?php echo  $row["dose"]; ?></p></h5> 
                <?php } ?>
                <?php } else {?> 
                <p><?php echo "There was an error retrieving the categories"; ?></p>
            <?php } ?>
            </article> 
            
            <article class="info_section">
                <h4 class="info_section">Reports: </h4>
                
                <?php foreach ($result6 as $row) { ?> 
                  <h5 class="atribute">Date: <p><?php echo  $row["date"]; ?> </p></h5> 
                  <h5 class="atribute">Message: <p><?php echo  $row["message"]; ?></p></h5>
                <?php } ?>

                </article>   

            <!--criar restrição de só enfermeiras do departamento OU Só a enfermeira responsavel (Tabela NurseOfInpatient)-->
            <?php if($_SESSION["funtion"]=="Nurse"){ 
                   $dep_id=$result_nurseD["dep_id"];
                  
                  if(Check_InpatientAcess($dep_id, $code)) { ?>
                  
                    <form action="report_action.php" method="post" class="info_section" id="add_report">
                    <h4 class="info_section">New Reports: </h4>
                    
                    <textarea name="report" rows="15"  cols="100"></textarea>
                    <input type="hidden" name="time" value="<?php echo date('Y-m-d') ?>" > <!--não tenho a certeza deste time, queria q fosse buscar a data-->
                    <input type="hidden" name="inpatient" value="<?php echo  $result2["code"] ?>">
                    
                    <button type="submit" class="enviar">Submit</button>
                    <span><?php echo $msg ?></span>
                  </form>    
            <?php } }?>
            
          </div>

        </section> 