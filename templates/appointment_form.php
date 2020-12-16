
      <section class= book_appointment>
      <form action="" method="post" class="specialization-select"> <!-- Queria que ficasse a mostrar a especialidade que foi selecionade depois de fazer o submit-->
        <label> Select Specializaton </label>
        
        <select name="dep" required ="required">

        <option value="0" >--Select Specializaton--</option>
          <?php if ($err == null) { ?> 
            <?php foreach ($result as $row) { ?>  
              <option value= "<?php echo $row["number"]?>"><?php echo $row["name"]?></option>
            <?php } ?>
          <?php } ?>
        </select>
        <input type="submit" name="submit" value="Select">
      
        <br>
        <label> Select Doctor </label>
        <select name="doctor" required ="required">
          <option value="<?php echo $i ?>" >--Select Doctor--</option>
          <?php      
          if ($err == null) { ?> 
          <?php foreach ($result2 as $row2) { 
            $i=$i+1; ?>  
          <option value= "<?php echo $row2["id"]?>" > <?php echo $row2["name"]?> </option>
          <?php } ?>
          <?php } ?>
            
        </select>
        <input type="submit" name="submit" value="Select">    
        </form>

        <form action="" method="post" class="specialization-select">
          <br>
          <label>Date:  </label>
          
          <input type="date" name="date" min="<?php echo date("Y-m-d");?>" value="<?php echo $date_select ?>" required ="required"/>
          
          <input type="submit" name="submit" value="Select"/>
          
          <?php $j= date('w', strtotime($date_select)); ?>
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
            
            <?php $result3 = getDoctorScheduleByWeekDay($doctor_id, $week_day);?>
            <select name ="time">
            
            <?php foreach ($result3 as $row3) { ?>
  
              <option value= "<?php echo $row3["begin_time"]?>" > <?php echo $row3["begin_time"]?> </option>
            <?php } ?>
            </select>
            <input type="submit" name="submit" value="Select">

            
        </form>

        

          
    
    </section>