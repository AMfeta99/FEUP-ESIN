
      <section class= book_appointment>
      <form action="" method="post" class="specialization-select"> <!-- Queria que ficasse a mostrar a especialidade que foi selecionade depois de fazer o submit-->
        <label> Select Specializaton </label>
        <select name="dep" required ="required">
          <?php if ($err == null) { ?> 
            <?php foreach ($result as $row) { ?>  
              <option value= "<?php echo $row["number"]?>"><?php echo $row["name"]?></option>
            <?php } ?>
          <?php } ?>
        </select>
        <input type="submit" name="submit" value="Select">
      
        <br>
        <select>
          <option value="<?php echo $i ?>" >--Select Doctor--</option>

          <?php      
         
          
          if ($err == null) { ?> 
          <?php foreach ($result2 as $row2) { 
            $i=$i+1; ?>  
          <option  > <?php echo $row2["name"]?> </option>
          <?php } ?>
          <?php } ?>
            
        </select>
        <input type="submit" name="submit" value="Select">    
      </form>


    <section class ="calendar">
            <form action="action_date.php" method="post" class ="display_calendar">
              <label>Date:  </label>
              <input type="date" name="date" min="<?php echo date("Y-m-d");?>" value="<?php echo $_SESSION["selected_date"]?>" required ="required">
              <input type="submit" name="submit" value="Select">
            </form>
          
    </section>

    </section>