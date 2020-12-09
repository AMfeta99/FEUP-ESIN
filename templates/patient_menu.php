<section id="profile_pag">
        
        <article>
           <header id="dados">
             <img class="circle" src="images/w1.PNG" alt="" width="130">
             <h4><?php echo  $result["name"] ?></h4> 
           </header>
 
          
           <aside>
              <ul id="link_profile">
                <li><a href="">My Profile</a></li>
                <li><a href="">Appointment schedule</a></li>
                <li><a href="">My Appointments </a></li>
                <li><a href="">Medical prescriptions</a></li>
                <li><a href="">Inpatient Profile</a></li>
                </ul> 
             </aside>
            
          </article>
 
          <div class="info">
            <h2>Profile</h2>
            <span><?php echo $msg ?></span>
            
            <article class="info_section">
                <h4 >Personal identification: </h4>
                <h5 class="atribute">Name: <p><?php echo  $result["name"] ?></p></h5>
                <h5 class="atribute">Age:  <p><?php echo  $result["age"] ?></p></h5>
                <h5 class="atribute">CC:  <p><?php echo  $result["cc"] ?></p></h5> 
            </article> 

            <article class="info_section">
                <h4 class="info_section">Contacts: </h4>
                <h5 class="atribute">Mail Address: <p><?php echo  $result["mail_address"] ?></p></h5>
                <?php if (strlen($result["phone_number"])>0){?>
                <h5 class="atribute">Phone Number: <p><?php echo  $result["phone_number"]; }?></p></h5>
            </article> 

            <article class="info_section">
                <h4 class="info_section">Diagnosed disease: </h4>
                
                <?php foreach ($result2 as $row) { ?> 
                  <?php if (strlen($row["disease_name"])>0){?> <!-- Se tiver algum diagnóstico-->
                    <h5 class="atribute">Name: <p><?php echo $row["disease_name"]; ?></p></h5>
                   
                  <?php }else { ?> <!-- não está a entrar neste else-->
                    <h5 class="atribute"> <p> Fortunately, you have no diagnosed disease! (falta subtituir pela query das disease)</p></h5>
                  <?php ; }?>
                <?php } ?> 
            </article> 

            <article class="info_section">
                <h4 class="info_section">Appointments: </h4>
                <!-- estamos a ter um problema pq se o disease_name for null a tabela de retorno é vazia-->
                <?php foreach ($result2 as $row) { ?>
                  <h5 class="atribute"> 
                    <p>Speciality: <?php echo  $row["speciality"] ?></p>
                    <h6 class= "subatribute"> <!-- Alterar Css -->
                    <p>Alterar Css : margin-left: 4% </p>
                    <p>Doctor: <?php echo  $row["doctor"] ?></p>
                    <p>Date: <?php echo  $row["date"] ?> <tab> Hour: <?php echo  $row["Hour"] ?></p>
                    <p>Diagnostic: <?php echo  $row["disease_name"] ?></p>
                    </h6>
                  </h5>
                <?php  }?>
            </article> 

            <article class="info_section">
                <h4 class="info_section">Prescriptions: </h4> <!-- colocar um if para o caso de não ter receitas -->
                <!-- apenas mostrar as receitas que estão dentro da data limit, eliminar da base de dados as que já passaram -->
                <?php foreach ($result3 as $row) { ?>
                  <h5 class="atribute"> <p> Prescription ID: <a href="index.php"> <?php echo  $row["id_prescription"] ?> Este link é suposto enviar para prescription_id (mostrar todos os medicamentos da receita etc) </a><br> Date limit: <?php echo  $row["date_limit"] ?> </p></h5>
                  <?php  }?>
            </article>     
            
            <article class="info_section">
                <h4 class="info_section">Inpatient Profile: </h4> 
                <!-- verificar se o paciente está registado na tabela inpatient -->
                
                  <h5 class="atribute"> <p> pomos a informação básica cama, departamento, etc? ou pomos um link para o inpatient.php?</p></h5>
                  
            </article>  
          
         </div>
 
       </section> 