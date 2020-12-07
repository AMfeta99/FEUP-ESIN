   
<section id= "register_option">
         <h2 class="pagtitle"> Register</h2>
         <span><?php echo $msg ?></span>
         <p>Escrever aqui qualquer coisa e ajustar os espaços==> aqui e nos forms ....sgdhfkjsdks kfsajdnfkn sfkjaskndjbsa nsldfjasl skdfkn jknkjdnfka dfk</p>
         
         <div id="register_choose">
          <button onclick="document.getElementById('doctorModal').style.display='block'">Doctor</button>
          <button onclick="document.getElementById('NurseModal').style.display='block'">Nurse</button>
          <button onclick="document.getElementById('patientModal').style.display='block'">Patient</button>
          </div>
        </section>

        <div id="doctorModal" class="modal">
          <span onclick="document.getElementById('doctorModal').style.display='none'" class="close" title="Close">&times;</span> 
          
          <form id="doctor" class="ModalContent" action="register_action.php" method="post">
            <header>
              <h2><a>Doctor Register</a></h2>
            </header>
            <div class="ModalContent2">
              <?php $_SESSION["funtion"]="Doctor" ?>
              <label><b>Username</b></label>
              <input type="text" placeholder="Enter Username" name="name" required>
          
              <label><b>Password</b></label>
              <input type="password" placeholder="Enter Password" name="password" required>

              <label><b>Email</b></label>
              <input type="email" placeholder="Enter Email" name="email" required>

              <label><b>Department</b></label>
              <input type="text"  name="speciality" required>

              <label><b>Phone Number (optional) </b></label>
              <input type="number"  name="phone_number">
              
              <label><b>Profile Photo (optional) </b></label>
              <input type="file" name="Photo">
              
            </div>

            <footer>
              <button type="submit">Submit</button>
              <button type="button" onclick="document.getElementById('doctorModal').style.display='none'" class="cancel">Cancel</button>
            </footer>
          </form>
          
        </div>

        <div id="NurseModal" class="modal">
          <span onclick="document.getElementById('NurseModal').style.display='none'" class="close" title="Close">&times;</span> 
          
          <form id="Nurse" class="ModalContent" action="register_action.php" method="post">
            <header>
              <h2><a>Nurse Register</a></h2>
            </header>
            <div class="ModalContent2">
              <label><b>Username</b></label>
              <?php $_SESSION["funtion"]="Nurse" ?>

              <input type="text" placeholder="Enter Username" name="name" required>
          
              <label><b>Password</b></label>
              <input type="password" placeholder="Enter Password" name="password" required>

              <label><b>Phone Number</b></label>
              <input type="number"  name="phone_number" required>

              <label><b>Department</b></label>
              <input type="text"  name="department" required> 
            
              <label><b>Email (optional)</b></label>
              <input type="email" placeholder="Enter Email" name="email">
          
            </div> 

            <footer>
              <button type="submit">Submit</button>
              <button type="button" onclick="document.getElementById('NurseModal').style.display='none'" class="cancel">Cancel</button>
            </footer>
          </form>
         
        </div>

        <div id="patientModal" class="modal">
          <span onclick="document.getElementById('patientModal').style.display='none'" class="close" title="Close">&times;</span> 
          
          <form class="ModalContent" action="register_action.php" method="post">
            <header>
              <h2><a>Patient Register</a></h2>
            </header>
            <div class="ModalContent2">
            <?php $_SESSION["funtion"]="Patient" ?>
              <label><b>Username</b></label>
              <input type="text" placeholder="Enter Username" name="name" required>
          
              <label><b>Password</b></label>
              <input type="password" placeholder="Enter Password" name="password" required>

              <label><b>Email</b></label>
              <input type="email" placeholder="Enter Email" name="email" required>
          
              <label><b>Age</b></label>
              <input type="number" name="age" required>

              <label><b>CC</b></label>
              <input type="text" name="CC" required>

              <label><b>Phone Number (optional)</b></label>
              <input type="text" name="phone_number">
            
            </div>
            <footer> 
              <button type="submit" id="regist">Submit</button>
              <button type="button" onclick="document.getElementById('patientModal').style.display='none'" class="cancel">Cancel</button>
            </footer>
            
          </form>
        </div>