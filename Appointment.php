<?php
    $dbh = new PDO ('sqlite:sql/hospital_manegment1.db');
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<?php

  $i=0;
  
/*isto já está noutro ficheiro*/
    function getListDepartments(){
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM Department');
        $stmt->execute();
        return $stmt->fetchAll(); // array of arrays
    }
    $result =getListDepartments(); 
  

    function getDoctorInfo($dep_number){
      global $dbh;
      $stmt = $dbh->prepare("SELECT Doctor.name, Doctor.photo, Doctor.phone_number, Doctor.mail_address, Department.name as speciality
                              FROM Doctor JOIN Department ON Doctor.speciality= Department.number 
                              WHERE speciality=?");
  
      $stmt->execute(array($dep_number));
      return $stmt->fetchAll();
  }
    $result2 = getDoctorInfo($dep_number); 

  //   function getDepId($dep_name){
  //     global $dbh;
  //     $stmt = $dbh->prepare("SELECT Department.number
  //                             FROM Department 
  //                             WHERE Department.name=?");
  
  //     $stmt->execute(array($dep_name));
  //     return $stmt->fetchAll();
  // }

?>

<!DOCTYPE html>
<html lang="en">
  <head >
      <meta meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="css_files/style.css" rel="stylesheet">
      <link href="css_files/style_buttons.css" rel="stylesheet">
      <link href="css_files/layout.css" rel="stylesheet">
      <link href="css_files/profile.css" rel="stylesheet">

      <link rel="icon" type="imagem/jpg" href="images/Hospital.jpg" />
      <title>Hospital</title>
  </head>

  <body>
      <header id="header_profile">
        <div id="simbolo">
          <h1><a href="index.php">Hospital</a></h1>
          <img src="images/t2.png" alt="" width="30">
        </div>
        <div id="back">
          <h2><a>The best care just a click away!</a></h2>
          <a href="index.php" id="out">Log Out</a>
          
        </div>
      </header> 

      <form action="" method="post" class="specialization-select">
      
        <select name="dep">
          <option value="0">--Select Specialization--</option>

          <?php if ($err == null) { ?> 
            <?php foreach ($result as $row) { ?>  
            <!-- <option value= "<?php echo $row["number"]?>"><button type="submit"  values="Select"><?php echo $row["name"]?></button></option> -->
            <option value= "<?php echo $row["number"]?>"><?php echo $row["name"]?></option>
            
            <?php } ?>
          <?php } ?>
        </select>
        <input type="submit" name="submit" values="Select">
      </form>

      
      <div class="specialization-select" style="width:200px;">
        <select>
          <option value="<?php echo $i ?>" >--Select Doctor--</option>

          <?php      
           $dep=$_POST['dep'];
           $result2 = getDoctorInfo($dep); #ajuda! como achas number do dep
          
          if ($err == null) { ?> 
          <?php foreach ($result2 as $row2) { 
            $i=$i+1; ?>  
          <option  > <?php echo $row2["name"]?> </option>
          <?php } ?>
          <?php } ?>
            
        </select>
      </div>


      <!-- agora de acordo com o departamento selecionado, value, selecionar os medicos que aparecem na lista -->


      <!-- Acho que deve ser tudo feito com o php para aceder à base de dados por causa do bloco de tempo e tudo-->

    <section class ="calendar">
            <form action="" method="post" class ="display_calendar">
              <label>Date:  </label>
              <input type="date" name="date">
            </form>
          
    </section>
  </body>


</html>