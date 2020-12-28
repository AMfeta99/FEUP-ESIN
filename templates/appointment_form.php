
      <section class= book_appointment>
        <h2>Book Appointment</h2>
      <form action="Appointment.php" method="post" class="specialization-select"> 
        <label> Select Specialization: </label>
        
        <select name="dep" id="id_dep" required ="required">

        <option value="<?php echo $_SESSION["dep"]?>" > -- Select --</option>
          <?php if ($err == null) { ?> 
            <?php foreach ($result as $row) { ?>  
             
              <option value= "<?php echo $row["name"];?>" 
                <?php if(isset($_SESSION['dep']) && $_SESSION['dep']== $row["name"] )
                echo 'selected = "selected"'; ?>
              ><?php echo $row["name"];?></option>
              
            <?php } ?>
          <?php } ?>
        </select>
        <input  class ="confirm" type="submit"  value="Confirm">
        </form>
      
        <br>
        <form action="Appointment.php" method="post" class="specialization-select"> 
        <label> Select Doctor: </label>
        <select name="doctor" required ="required">
          <option value="<?php echo $_SESSION["doctor_id"]?>" ><?php echo $_SESSION["doctor_name"] ?></option>
          <?php      
          if ($err == null) { ?> 
          <?php foreach ($result2 as $row2) {  ?>  
          <option value= "<?php echo $row2["id"].'|'.$row2["name"]?>" > <?php echo $row2["name"]?> </option>
          
          <?php } ?>

          <?php } ?>
            
        </select>
        <input class ="confirm" type="submit"  value="Confirm">    
        </form>

        <form action="Appointment.php" method="post" class="specialization-select">
          <br>
          <label>Date:  </label>
          
          <input type="date" name="date" min="<?php echo date("Y-m-d");?>" value="<?php echo $_SESSION["date"]?>" required ="required"/>
          
          <input  class ="confirm" type="submit" value="Confirm"/>
        </form>
          
        <form action="action_date.php" method="post" class="specialization-select">
        <?php if(isset($_SESSION["date"])){ ?>
          <?php $j= date('w', strtotime($_SESSION["date"])); ?>
          <?php switch ($j) {
                case 0:
                    $week_day ="SUN";
                    break;
                case 1:
                    $week_day ="MON";
                    break;
                case 2:
                    $week_day ="TUE";
                    break;
                case 3:
                    $week_day ="WED";
                    break;
                case 4:
                    $week_day ="THU";
                    break;
                case 5:
                    $week_day ="FRI";
                    break;
                case 6:
                    $week_day ="SAT";
                    break;
              
            }?>

          <?php } ?>
            <br>
            <label>Time:  </label>
            
            <?php $result3 = getDoctorScheduleByWeekDay($_SESSION["doctor_id"], $week_day);?>
            <select name ="time">
            
            <?php foreach ($result3 as $row3) { ?>
  
              <option value= "<?php echo $row3["begin_time"]?>" 
              <?php if(isset($_SESSION['time']) && $_SESSION['time']== $row3["begin_time"] )
                echo 'selected = "selected"'; ?>
              > <?php echo $row3["begin_time"]?> </option>
            <?php } ?>
            </select>
            <input type="Hidden" name="week_day" value=<?php echo $week_day?> >
            <p></p>
            <input class="request_reservation" type="submit" value="Submit">
            
        </form>
        <?php echo $msg ?>

    </section>