
      <section class= book_appointment>
      <form action="Appointment.php" method="post" class="specialization-select"> <!-- Queria que ficasse a mostrar a especialidade que foi selecionade depois de fazer o submit-->
        <label> Select Specialization </label>
        
        <select name="dep" required ="required">

        <option value="0" ><?php echo $_SESSION["dep"] ?></option>
          <?php if ($err == null) { ?> 
            <?php foreach ($result as $row) { ?>  
              <?php if($row["name"] != $_SESSION["dep"] ) {?>
              <option value= "<?php echo $row["name"]?>"><?php echo $row["name"]?></option>
              <?php } ?>
            <?php } ?>
          <?php } ?>
        </select>
        <input type="submit"  value="Select">
        </form>
      
        <br>
        <form action="Appointment.php" method="post" class="specialization-select"> 
        <label> Select Doctor </label>
        <select name="doctor" required ="required">
          <option value="<?php echo $i ?>" ><?php echo $_SESSION["doctor"] ?></option>
          <?php      
          if ($err == null) { ?> 
          <?php foreach ($result2 as $row2) { 
            $i=$i+1; ?>  
          <option value= "<?php echo $row2["id"]?>" > <?php echo $row2["name"]?> </option>
          
          <?php } ?>

          <?php } ?>
            
        </select>
        <input type="submit"  value="Select">    
        </form>

        <form action="Appointment.php" method="post" class="specialization-select">
          <br>
          <label>Date:  </label>
          
          <input type="date" name="date" min="<?php echo date("Y-m-d");?>" value="<?php echo $date_select ?>" required ="required"/>
          
          <input type="submit" value="Select"/>
        </form>
          
        <form action="action_date.php" method="post" class="specialization-select">
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
            <br>
            <label>Time:  </label>
            <?php echo  $week_day?>
            <?php $result3 = getDoctorScheduleByWeekDay($_SESSION["id_doctor"], $week_day);?>
            <select name ="time">
            
            <?php foreach ($result3 as $row3) { ?>
  
              <option value= "<?php echo $row3["begin_time"]?>" > <?php echo $row3["begin_time"]?> </option>
            <?php } ?>
            </select>
            <input type="Hidden" name="week_day" value=<?php echo $week_day?> >
            <input type="submit" value="Select">
            
        </form>
        <?php echo $msg ?>
        <?php echo $_SESSION["id_doctor"] ?>
        <?php echo $_SESSION["date"] ?>
        <?php echo $_SESSION["week"] ?>
        <?php echo $_SESSION["b"] ?>

    </section>