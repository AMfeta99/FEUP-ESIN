<section >

          <div class="info">
            <h2>Patient Info:</h2>
            
            <article class="info_section">
                <!-- <h4 >Patient Info: </h4> -->
                <h5 class="atribute">Name: <p><?php echo  $result["name"] ?></p></h5>
                <h5 class="atribute">Age:  <p><?php echo  $result["age"] ?></p></h5>
                <h5 class="atribute">CC:  <p><?php echo  $result["cc"] ?></p></h5> 
               
            </article>
            
            <h2>Appointment:</h2>
            <article class="info_section">
                <h5 class="atribute">Appointment id: <?php echo  $appointment ?></h5> 
            </article>

           
            <form action="diagnosis_action.php" method="post" class="info_section" id="add_report">
            <h4 class="info_section">Diagnosis: </h4>
                
                <h5 class="atribute">Diseases already diagnosed:
                <?php foreach ($result3 as $row) { ?>
                 <p><?php echo  $row['disease_name'] ?></p></h5>
                 <?php } ?>

                <label><b>Diseases</b></label>
                <input type="text" name="disease_name" >
                <input type="hidden" name="appointment_id" value="<?php  echo  $appointment ?>" >
                
                <button type="submit" class="enviar">Submit</button>
                <?php echo $msg_disease ?>
            </form>    
               

    
            <form action="Medicine_action.php" method="post" class="info_section" id="add_report">
            <h4 class="info_section">Prescription Of Medicine: </h4>

            <fieldset>
                <legend>Medicine:</legend>
                <label><b>Name</b></label>
                <input type="text" name="Medicine_name" >
                <label><b>Dose</b></label>
                <input type="text" name="dose" placeholder="...mg"> 
                <label><b>Quantity</b></label>
                <input type="text" name="quantity">
            </fieldset>
                

            <label><b>date limit:</b></label>
            <input type="text" name="date_limit" >
            <b class="atribute">date: <?php echo  $result2["date"] ?></b> 
            
            <?php $_SESSION["appointment_id"]=$appointment; ?>
                
                <button type="submit" class="enviar">Submit</button>
                <?php echo $msg_p?>
            </form>    
            
          </div>

        </section> 