
    <form id="Nurse" class="ModalContent" action="register_action.php" method="post">
    <header>
        <h2><a>Nurse Register</a></h2>
        <span><?php echo $msg ?></span>
    </header>
    <div class="ModalContent2">
        <?php $_SESSION["funtion"]="Nurse"; ?>
        <label><b>Username</b></label>

        <input type="text" placeholder="Enter Username" name="name" required>
    
        <label><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>

        <label><b>Phone Number</b></label>
        <input type="number"  name="phone_number" required>

        <label><b>Department</b></label>
        <input type="text"  name="department" required> 
    
        <label><b>Email</b></label>
        <input type="email" placeholder="Enter Email" name="email">
    
    </div> 

    <footer>
        <button type="submit" class="enviar">Submit</button>
        <a href="register.php"><button type="button" class="cancel">Cancel</button></a>
    </footer>
    </form>
    

        