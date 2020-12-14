
<section id="department">
<article>
    <header> <!--não estou a entender pq não está a dar-->
    <h2 class="pagtitle"><?php echo $Department_name ?></h2>
    </header>
    

    <section class = "Doctors_list">
    <p>departamento bla bla bla sxdfcvghbkjngf dfcgvhbkjn dfhjlk .</p>
    <p>só uma mini descrição bla bla bla sxdfcvghbkjngf dfcgvhbkjn dfhjlk .</p>
    <p>não sei se ficou bonita esta pagina podes mudar se quiseres  sxdfcvghbkjngf dfcgvhbkjn dfhjlk .</p>

        <?php if ($err == null) { ?> <!--if there was no error -->
        <?php foreach ($result as $row) { ?>  
        <ul>
        <a href="Doctor_without_login.php?id=<?php echo $row["id"] ?>" ><il class="especialista">

            <h4 id="Dname"> <?php echo $row["name"] ?><br></h4>
            <!-- não sei pq é q isto não está a dar ....-->
            <?php if( $row["photo"] == NULL) { ?>
                <img class="circle" src="images/w3.PNG" alt="16" style="width: 150px;">
            <?php } else { ?>
                <img class="circle" src="<?php echo $row["photo"] ?>" alt="" style="width: 150px;">
            <?php } ?>

            <h4 id="info"> <br><br><?php echo $row["phone_number"] ?><br> <?php echo $row["mail_address"] ?></h4>
            
        </il></a>
        
        </ul>
        
        <?php } ?>
        <?php } else {?> 
        <p><?php echo "There was an error retrieving the categories"; ?></p>
        <?php } ?>
    </section>

</article>
</section> 