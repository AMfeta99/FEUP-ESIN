<?php 

function check_disease($disease){
    global $dbh;
    $stmt = $dbh->prepare("SELECT * FROM Disease
                            WHERE Disease.name = ?");

    $stmt->execute(array($disease));
    return $stmt->fetch();
}
?>