<?php

    require_once('config/init.php');

    $date_select = $_POST["date"];
    $_SESSION["selected_date"] = $date_select;
?>