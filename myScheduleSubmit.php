<?php
session_start();
?>

<!DOCTYPE html>
<html>
<body>

<?php
//TODOs: 
//how to use text
//check for 00 not null
//add ids to schedules
//delete/edit based on id
//redirect after submit
//24hr
//css
//id option


// database information
$host = "localhost:3307";
$db = "Scheduler";
$db_username = "Scheduler";
$db_password = "0q7L3ynn2YLwRJey";

if(!isset($_SESSION["email"])) {
    echo "You're not logged in.<br>";
    header("Refresh: 3; url=http://speaksnas1.synology.me/mySchedule.php");
}

// connect to database
try {
    $conn = new PDO("mysql:host=$host;dbname=$db;", $db_username, $db_password);
    // set PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
    echo "Connection Failed: " . $e->getMessage();
}

if (isset($_POST["delete"])) {
    # delete button was clicked

    if(!isset( $_POST["idradio"])){
        echo ("ID not set.<br>");
        header("Refresh: 3; url=http://speaksnas1.synology.me/mySchedule.php");
    }
    $id = $_POST["idradio"];

    // run SQL statement to fetch credentials with matching email
    $stmt = $conn->prepare("DELETE FROM Schedules WHERE Email = ? and `ID` = ?");
    if($stmt->execute(array($_SESSION["email"], $id))){
        echo("Deleted success");
        header("Refresh: 3; url=http://speaksnas1.synology.me/mySchedule.php");
    }
    //if couldnt insert redirect to mySchedule
    else {
        echo "Could not delete schedule in database.<br>";
        header("Refresh: 3; url=http://speaksnas1.synology.me/mySchedule.php");
    }
}
elseif(isset($_POST["create"]) || isset($_POST["edit"])){
    if(empty($_POST["day"])) {
        echo("Select a day.");
        header("Refresh: 3; url=http://speaksnas1.synology.me/mySchedule.php");
    }
    
    //check times set
    $validM = (strtotime($_POST["startshiftM"]) < strtotime($_POST["endshiftM"]) && strpos($days, "M") !== false) || strpos($days, "M") === false;
    $validT = (strtotime($_POST["startshiftT"]) < strtotime($_POST["endshiftT"]) && strpos($days, "T") !== false) || strpos($days, "T") === false;
    $validW = (strtotime($_POST["startshiftW"]) < strtotime($_POST["endshiftW"]) && strpos($days, "W") !== false) || strpos($days, "W") === false;
    $validH = (strtotime($_POST["startshiftH"]) < strtotime($_POST["endshiftH"]) && strpos($days, "H") !== false) || strpos($days, "H") === false;
    $validF = (strtotime($_POST["startshiftF"]) < strtotime($_POST["endshiftF"]) && strpos($days, "F") !== false) || strpos($days, "F") === false;
    
    //check start-end of times
    if(strtotime($startsched) < strtotime($endsched) && $validM && $validT && $validW && $validH && $validF){
        echo("End time cannot be before start time");
        header("Refresh: 3; url=http://speaksnas1.synology.me/mySchedule.php");
    }

    //store vars
    $days = "";
    foreach($_POST["day"] as $dow) {
            $days = $days . $dow;
    }
    $shiftType = $_POST["shiftType"];

    //get times
    $startshiftM = $_POST["startshiftM"];
    $endshiftM = $_POST["endshiftM"];
    $startshiftT = $_POST["startshiftT"];
    $endshiftT = $_POST["endshiftT"];
    $startshiftW = $_POST["startshiftW"];
    $endshiftW = $_POST["endshiftW"];
    $startshiftH = $_POST["startshiftH"];
    $endshiftH = $_POST["endshiftH"];
    $startshiftF = $_POST["startshiftF"];
    $endshiftF = $_POST["endshiftF"];

    $startsched = $_POST["startsched"];
    $endsched = $_POST["endsched"];

    //set times to default value if not set
    if(strpos($days, "M") === false){
        $startshiftM = "00:00";
        $endshiftM = "00:00";
    }
    if(strpos($days, "T") === false){
        $startshiftT = "00:00";
        $endshiftT = "00:00";
    }
    if(strpos($days, "W") === false){
        $startshiftW = "00:00";
        $endshiftW = "00:00";
    }
    if(strpos($days, "H") === false){
        $startshiftH = "00:00";
        $endshiftH = "00:00";
    }
    if(strpos($days, "F") === false){
        $startshiftF = "00:00";
        $endshiftF = "00:00";
    }

    //do one of the three different submit options
    if (isset($_POST["create"])) {
        // create button was clicked

        $id = $_POST["idnum"];

        // run SQL statement to fetch credentials with matching email
        $stmt = $conn->prepare("INSERT INTO " .
            "Schedules(ID, Email, `Schedule type`, `Start date`, `End date`, " .
                "`Mon (start time)`, `Mon (end time)`, `Tues (start time)`, `Tues (end time)`, `Wed (start time)`, `Wed (end time)`, `Thurs (start time)`, `Thurs (end time)`, `Fri (start time)`, `Fri (end time)`) " .
            "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"); //15 ?s
        if($stmt->execute(array($id, $_SESSION["email"], $shiftType, $startsched, $endsched, $startshiftM, $endshiftM, $startshiftT, $endshiftT, $startshiftW, $endshiftW, $startshiftH, $endshiftH, $startshiftF, $endshiftF))){
            echo("Added schedule {$_SESSION["email"]} $shiftType $startsched to $endsched " .
                "Mon: $startshiftM - $endshiftM Tues: $startshiftT - $endshiftT Wed: $startshiftW - $endshiftW Thurs: $startshiftH - $endshiftH Fri: $startshiftF -$endshiftF");
        }
        //if couldnt insert redirect to mySchedule
        else {
            echo ("Could not add schedule to database.<br>");
            header("Refresh: 3; url=http://speaksnas1.synology.me/mySchedule.php");
        }
    }
    elseif (isset($_POST["edit"])) {
        # edit button was clicked

        if(!isset( $_POST["idradio"])){
            echo ("ID not set.<br>");
            header("Refresh: 3; url=http://speaksnas1.synology.me/mySchedule.php");
        }
        $id = $_POST["idradio"];

        // run SQL statement to fetch credentials with matching email
        $stmt = $conn->prepare("UPDATE Schedules " .
            "SET" . 
                "`Schedule type` = ?, `Start date` = ?, `End date` = ?," .
                "`Mon (start time)` = ?, `Mon (end time)` = ?, `Tues (start time)` = ?, `Tues (end time)` = ?, " . 
                "`Wed (start time)` = ?, `Wed (end time)` = ?, `Thurs (start time)` = ?, `Thurs (end time)` = ?, " . 
                "`Fri (start time)` = ?, `Fri (end time)` = ?" .
            "WHERE Email = ? and `ID` = ?");
        if($stmt->execute(array(
            $shiftType, $startsched, $endsched, 
            $startshiftM, $endshiftM, $startshiftT, $endshiftT, $startshiftW, $endshiftW, $startshiftH, $endshiftH, $startshiftF, $endshiftF,
            $_SESSION["email"], $id))){

            echo("Changed success");
            header("Refresh: 3; url=http://speaksnas1.synology.me/mySchedule.php");
        }
        //if couldnt insert redirect to mySchedule
        else {
            echo ("Could not change schedule in database.<br>");
            header("Refresh: 3; url=http://speaksnas1.synology.me/mySchedule.php");
        }
    }
}
else{
    echo("How'd you do that?");
    header("Refresh: 3; url=http://speaksnas1.synology.me/mySchedule.php");
}
?>

</body>
</html>