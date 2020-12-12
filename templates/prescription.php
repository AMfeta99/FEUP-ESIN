<section id= "prescription">

    
    <article class="header">
    <h2>Prescription <?php echo $prescription_id?></h2>
        <h5 class ="atribute">Prescript by:<p><?php echo  $doctor["doctor_name"];?></p></h5>

    </article>

    <div class="data">
        <h6 class= "subatribute"> Date: <?php echo  $prescInfo["date"];?> </h6>
        <h6 class= "subatribute"> Prescription Validity: <?php echo  $prescInfo["date_limit"];?> </h6>

    </div>   
    <div class="list_medicines">
        <h6 class= "subatribute"> List of medication:</h6>
       
    </div>
    <div class = "quantity"> 
        <h6 class= "subatribute"> quantity</h6>
        <?php foreach ($medications as $row) { ?>
            <h6 class= "subatribute"> <?php echo $row["quantity"] ?></h6>
        <?php }?>
    </div>
</section>