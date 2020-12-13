<section id= "prescription">

    
    <article class="header">
    
        <h5 class ="atribute">Patient:<?php echo  $patient["patient_name"];?></h5>
        <h5 class ="atribute">Prescript by:<p><?php echo  $doctor["doctor_name"];?></p></h5>
        <h5 class ="atribute">Mail Address:<?php echo  $doctor["doctor_mail"];?></h5>
    </article>

    <div class="data">
        <p></p>
        <h6 class= "subatribute"> Date: <?php echo  $prescInfo["date"];?> </h6>
        <p></p>
        <h6 class= "subatribute"> Prescription Validity: <?php echo  $prescInfo["date_limit"];?> </h6>

    </div>   
    <div class="list_medicines">
       
        <h6 class= "subatribute"> List of medication:</h6>
        
        <?php foreach ($medications as $row) { ?>
            <div class= "medication">
            <h6 class= "subatribute"> <?php echo $row["name"] ?>,   <?php echo $row["dose"] ?> </h6>
            <h7 class= "instructions"><?php echo $row["instructions"] ?></h7>
            </div>
        <?php }?>
        
    </div>
    <div class = "quantity"> 
        <h6 class= "subatribute"> Quantity</h6>
        
        <?php foreach ($medications as $row) { ?>
            <h6 class= "subatribute"> <?php echo $row["quantity"] ?></h6>
            
        <?php }?>
    </div>
</section>