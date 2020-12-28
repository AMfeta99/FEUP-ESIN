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
                  
                      <li ><a href="#info">Inpatient Info</a></li>
                      <li ><a href="#medication">Medication</a></li>
                      <li ><a href="#reports">Daily Reports</a></li>
                    
                </ul> 
              </label>
              </aside>
         
          </article>

          <div id="info" class="info">
          <span><?php echo $msg_inpatient?></span>
            <h2>Patient Info:</h2>
            
            <article class="info_section">
                <h5 class="atribute">Name: <p><?php echo  $result2["name"] ?></p></h5>
                <h5 class="atribute">Age:  <p><?php echo  $result2["age"] ?></p></h5>
                <h5 class="atribute">CC:  <p><?php echo  $result2["cc"] ?></p></h5> 
                <h5 class="atribute">Mail Address: <p><?php echo  $result2["mail_address"] ?></p></h5>
                <?php if (strlen($result2["phone_number"])>0){?>
                <h5 class="atribute">Phone Number: <p><?php echo  $result2["phone_number"]; }?></p></h5>
                <h5 class="atribute">Diseases already diagnosed: </h5>
                <ul>
                  <?php $i = 0;
                  $sum_null = 0 ?>
                  <?php foreach ($diagnosis as $row) { ?>
                    <?php $i = $i + 1; ?>
                    <?php if (!is_null($row['disease_name'])) { ?>
                      <li><?php echo  $row['disease_name'] ?></li>
                    <?php } else {
                      $sum_null = $sum_null + 1;
                    } ?>
                  <?php } ?>
                  <?php if ($sum_null == $i) { ?>
                    <p> No disease diagnosed until now. </p>
                  <?php } ?>
                </ul>
                
            </article>
            
            <h2>Internment:</h2>
            <article class="info_section">
                <h4 class="info_section">Internment Info: </h4>
               
                <h5 class="atribute">Doctor: <a href ="Doctor_without_login.php?id=<?php echo $result3["doctor_id"] ?>" ><p><?php echo  $result3["doctor_name"]; ?> </p></a></h5> 
                <h5 class="atribute">Doctor mail: <p><?php echo  $result3["doctor_mail"]; ?></p></h5> 
                <h5 class="atribute">Bed: <p><?php echo  $result4["bed"]; ?></p></h5> 
                <h5 class="atribute">Department: <p><?php echo  $result4["dep_name"]; ?></p></h5> 
                <h5 class="atribute">Visiting Hours: <p><?php echo  $result4["visiting_hours"]; ?></p></h5> 
            </article> 

            <section id = "medication">
            <article class="info_section">
                <h4 class="info_section">Medication: </h4>
                <?php $i = 0;
                $sum_null = 0; ?>
                <?php if ($err == null) { ?> 
                <?php foreach ($result5 as $row) { ?> 
                  <?php $i = $i + 1; ?>
                  <?php if (!is_null($row["name_med"])) { ?>
                    <h5 class="atribute">Name: <p><?php echo  $row["name_med"]; ?> <tab></tab> Dose: <?php echo  $row["dose"]; ?></p></h5> 
                    <h5 class="atribute">Instructions: <p><?php echo  $row["instructions"]; ?> </p></h5> 
                  <?php } else {
                    $sum_null = $sum_null + 1;
                  } ?>
                <?php } ?>
                <?php if ($sum_null == $i) { ?>
                  <p> The medication has not been updated yet. </p>
                <?php } ?>
                <?php } else {?> 
                <p><?php echo "There was an error retrieving the categories"; ?></p>
            <?php } ?>
            
            <?php if ( $_SESSION["funtion"]=="Doctor"){?>
              <?php if ($result7["doctor_id"]==$_SESSION["user"]){ ?>
              <form action="Medicine_Inpatient_action.php" method="post" >
              
              <legend>Prescription Of Medicine:</legend>
                <label><b>Instructions</b></label>
                <textarea name="instrutions" rows="10"  cols="140"></textarea>
                <label><b>Name</b></label>
                <input type="text" name="Medicine_name">
                <label><b>Dose</b></label>
                <input type="text" name="dose" placeholder="...mg">
                <input type="hidden" name="inpatient" value="<?php echo $_SESSION['inpatient']?>">
                
                <button type="submit" class="submit_prescription">Submit</button>
                <?php echo $msg_Med_imp ?>
                </form>
              <?php }?>
            <?php }?>
            </article> 
            </section>

            <section id = "reports">
            <article class="info_section">
                <h4 class="info_section">Reports: </h4>
                <?php $i = 0;
                $sum_null = 0; ?>
                <?php foreach ($result6 as $row) { ?>
                  
                  <?php $i = $i + 1; ?>
                  <?php if (!is_null($row["date"])) { ?>
                    <h5 class="atribute">Date: <p><?php echo  $row["date"]; ?> </p></h5> 
                    <h5 class="atribute">Message: <p><?php echo  $row["message"]; ?></p></h5>
                  <?php } else {
                    $sum_null = $sum_null + 1;
                  } ?>
                <?php } ?>
                <?php if ($sum_null == $i) { ?>
                  <p> The patient still doesn't have any report. </p>
                <?php } ?>
            </article>   

            
            <?php if($_SESSION["funtion"]=="Nurse"){ 
                   $dep_id=$result_nurseD["dep_id"];
                  
                  if(Check_InpatientAcess($dep_id, $code)) { ?> <!-- só enfermeiros do mesmo departamento é que podem adicionar reports-->
                  
                    <form action="report_action.php" method="post" class="info_section" id="add_report">
                    <h4 class="info_section">New Reports: </h4>
                    
                    <textarea name="report" rows="15"  cols="100"></textarea>
                    <input type="hidden" name="time" value="<?php echo date('Y-m-d') ?>" > 
                    <input type="hidden" name="inpatient" value="<?php echo  $result2["code"] ?>">
                    
                    <button type="submit" class="enviar">Submit</button>
                    <span><?php echo $msg ?></span>
                  </form>    
            <?php } }?>
            </section>
          </div>

        </section> 