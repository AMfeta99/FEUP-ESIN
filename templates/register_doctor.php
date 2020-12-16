
    <form id="doctor" class="ModalContent" action="register_action.php" method="post">
    <header>
        <h2><a>Doctor Register</a></h2>
        <span><?php echo $msg ?></span>
    </header>
    <div class="ModalContent2">
        <?php $_SESSION["funtion"]="Doctor"; ?>
        <label><b>Username</b></label>
        <input type="text" placeholder="Enter Your Name" name="name" required>
    
        <label><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>

        <label><b>Email</b></label>
        <input type="email" placeholder="Enter Email" name="email" required>

        <label><b>Department</b></label>
        <input type="text" placeholder="Choose your speciality: cardiology, neurology, urology, ..."  name="speciality" required>

        <label><b>Phone Number (optional) </b></label>
        <input type="number"  name="phone_number">
        
        <label><b>Profile Photo (optional) </b></label>
        <input type="file" name="Photo">
        
    </div>

    <footer>
        <button type="submit" class="enviar">Submit</button>
        <a href="register.php"><button type="button" class="cancel">Cancel</button></a>
    </footer>
    </form>
    

