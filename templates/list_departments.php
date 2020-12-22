
<section id="department">
<article>
    <header>
        <h2 class="pagtitle">Departments</h2>
    </header>

    <section class = "departments">
    
        <div id="pagdepartment" class = "departments_block">
        <?php if ($err == null) { ?> <!--if there was no error -->
        <?php foreach ($result as $row) { ?>  

        <div class="col-6">
            <div id="speciality_cards_dep"><a href="departament&doctors.php?dep=<?php echo $row["number"]?>&name=<?php echo $row["name"]?>">
                <img src="images/departments/<?php echo $row["number"]?>.jpg" alt="7" style = "width:100%; height: 250px;" >
                <p><?php echo $row["name"] ?></p>
        </div></a>   
        </div>

            <?php } ?>
            <?php } else {?> 
                <p><?php echo "There was an error retrieving the categories"; ?></p>
            <?php } ?>
        </div>

    </section>
    </article>
</section> 