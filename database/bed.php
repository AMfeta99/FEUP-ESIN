<?php 

function UpdateBeds($bed,$id_dep){
    global $dbh;
    $stmt= $dbh->prepare("UPDATE Bed
                            SET occupy = 1
                            WHERE number=? AND id_department=?;");
    $stmt->execute(array($bed,$id_dep));
}


function getDepBedAvailable($dep_number){
    global $dbh;
    $stmt = $dbh->prepare("SELECT Count(*) as occupy, Bed.number as beds
                           FROM Bed JOIN Department 
                           ON id_department= Department.number
                           WHERE Bed.occupy=0 and id_department=?;");

    $stmt->execute(array($dep_number));
    return $stmt->fetch();
}

// camas ocupadas
    function getDepNumberBedOccupy($dep_number){
        global $dbh;
        $stmt = $dbh->prepare("SELECT Count(*) as occupy, Bed.number as beds
                               FROM Bed JOIN Department 
                               ON id_department= Department.number
                               WHERE Bed.occupy=1 and id_department=?;");
    
        $stmt->execute(array($dep_number));
        return $stmt->fetch();
    }

    function getDepTotalNumberBed($dep_number){
        global $dbh;
        $stmt = $dbh->prepare("SELECT Count(*) as Total_beds, Bed.number
                               FROM Bed JOIN Department 
                               ON id_department= Department.number
                               WHERE id_department=?;");
    
        $stmt->execute(array($dep_number));
        return $stmt->fetch();
    }

    function UpdateBedsAvailable($bed,$id_dep){
        global $dbh;
        $stmt= $dbh->prepare("UPDATE Bed
                                SET occupy = 0
                                WHERE number=? AND id_department=?;");
        $stmt->execute(array($bed,$id_dep));
    }
?>