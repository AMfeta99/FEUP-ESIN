<?php
    session_start();
    // session_abort();
    // die();
    $dbh = new PDO ('sqlite:sql/hospital_manegment1.db');
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>