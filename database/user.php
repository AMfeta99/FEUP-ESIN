<?php

    function saveProfilePicture($name){
        // limit size
        $pic_name = $_FILES['photo']['name'];
        move_uploaded_file($_FILES['photo']['tmp_name'],"images/doctors/$pic_name");
    }

    #verify usermail_address/password
    function Validating($mail_address,$password,$table){

        global $dbh;
        $stmt=$dbh->prepare("SELECT * FROM $table WHERE mail_address=? AND password=?");
        $stmt->execute(array($mail_address,sha1($password)));
        return $stmt->fetch();
    }

?>