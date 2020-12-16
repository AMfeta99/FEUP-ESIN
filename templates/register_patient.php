
    <form class="ModalContent" action="register_action.php" method="post">
    <header>
        <h2><a>Patient Register</a></h2>
        <span><?php echo $msg ?></span>
    </header>
    <div class="ModalContent2">
        <?php $_SESSION["funtion"]="Patient"; ?>
        <label><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="name" required>
    
        <label><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>

        <label><b>Email</b></label>
        <input type="email" placeholder="Enter Email" name="email" required>
    
        <label><b>Age</b></label>
        <input type="number" name="age" required>

        <label><b>CC</b></label>
        <input type="number"  name="CC" required>

        <label><b>Phone Number (optional)</b></label>
        <input type="text" name="phone_number">
    
    </div>
    <footer>
        <button type="submit" class="enviar">Submit</button>
        <a href="register.php"><button type="button" class="cancel">Cancel</button></a>
    </footer>
    
    </form>