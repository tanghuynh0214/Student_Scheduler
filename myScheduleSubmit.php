<?php
session_start();
?>

<!DOCTYPE html>
<html>
<body>

<?php
//TODOs: 
//check if logged in
//actual sql statements
//better define how edit works


// database information
$host = "localhost:3307";
$db = "Scheduler";
$db_username = "Scheduler";
$db_password = "0q7L3ynn2YLwRJey";

if(!isset($_SESSION["email"])) {
    echo "You're not logged in.<br>";
}
else {
    //store vars
    $days = "";
    if(!empty($_POST["day"])) {
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

        //check times set
        $validM = (strtotime($_POST["startshiftM"]) < strtotime($_POST["endshiftM"]) && strpos($days, "M") !== false) || strpos($days, "M") === false;
        $validT = (strtotime($_POST["startshiftT"]) < strtotime($_POST["endshiftT"]) && strpos($days, "T") !== false) || strpos($days, "T") === false;
        $validW = (strtotime($_POST["startshiftW"]) < strtotime($_POST["endshiftW"]) && strpos($days, "W") !== false) || strpos($days, "W") === false;
        $validH = (strtotime($_POST["startshiftH"]) < strtotime($_POST["endshiftH"]) && strpos($days, "H") !== false) || strpos($days, "H") === false;
        $validF = (strtotime($_POST["startshiftF"]) < strtotime($_POST["endshiftF"]) && strpos($days, "F") !== false) || strpos($days, "F") === false;

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

        //check start-end of times
        if(strtotime($startsched) < strtotime($endsched) && $validM && $validT && $validW && $validH && $validF){
            // connect to database
            try {
                $conn = new PDO("mysql:host=$host;dbname=$db;", $db_username, $db_password);
                // set PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e) {
                echo "Connection Failed: " . $e->getMessage();
            }

            //do one of the three different submit options
            if (isset($_POST["create"])) {
                // create button was clicked

                // run SQL statement to fetch credentials with matching email
                $stmt = $conn->prepare("INSERT INTO " .
                    "Schedules(Email, `Schedule type`, `Start date`, `End date`, " .
                        "`Mon (start time)`, `Mon (end time)`, `Tues (start time)`, `Tues (end time)`, `Wed (start time)`, `Wed (end time)`, `Thurs (start time)`, `Thurs (end time)`, `Fri (start time)`, `Fri (end time)`) " .
                    "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"); //14 ?s
                if($stmt->execute(array($_SESSION["email"], $shiftType, $startsched, $endsched, $startshiftM, $endshiftM, $startshiftT, $endshiftT, $startshiftW, $endshiftW, $startshiftH, $endshiftH, $startshiftF, $endshiftF))){
                    echo("Added schedule {$_SESSION["email"]} $shiftType $startsched to $endsched " .
                        "Mon: $startshiftM - $endshiftM Tues: $startshiftT - $endshiftT Wed: $startshiftW - $endshiftW Thurs: $startshiftH - $endshiftH Fri: $startshiftF -$endshiftF");
                }
                //if couldnt insert redirect to mySchedule
                else {
                    echo ("Could not add schedule to database.<br>");
                    header("Refresh: 3; url=http://cmsc447/mySchedule.php");
                }
            }
            elseif (isset($_POST["edit"])) {
                # edit button was clicked

                //get new sched vars
                $days2 = "";
                if(!empty($_POST["day2"])) {
                    foreach($_POST["day2"] as $dow) {
                            $days2 = $days2 . $dow;
                    }
                    $shiftType = $_POST["shiftType2"];

                    //get times
                    $startshiftM2 = $_POST["startshiftM2"];
                    $endshiftM2 = $_POST["endshiftM2"];
                    $startshiftT2 = $_POST["startshiftT2"];
                    $endshiftT2 = $_POST["endshiftT2"];
                    $startshiftW2 = $_POST["startshiftW2"];
                    $endshiftW2 = $_POST["endshiftW2"];
                    $startshiftH2 = $_POST["startshiftH2"];
                    $endshiftH2 = $_POST["endshiftH2"];
                    $startshiftF2 = $_POST["startshiftF2"];
                    $endshiftF2 = $_POST["endshiftF2"];

                    $startsched2 = $_POST["startsched2"];
                    $endsched2 = $_POST["endsched2"];

                    //check times set
                    $validM = (strtotime($_POST["startshiftM2"]) < strtotime($_POST["endshiftM2"]) && strpos($days2, "M") !== false) || strpos($days2, "M") === false;
                    $validT = (strtotime($_POST["startshiftT2"]) < strtotime($_POST["endshiftT2"]) && strpos($days2, "T") !== false) || strpos($days2, "T") === false;
                    $validW = (strtotime($_POST["startshiftW2"]) < strtotime($_POST["endshiftW2"]) && strpos($days2, "W") !== false) || strpos($days2, "W") === false;
                    $validH = (strtotime($_POST["startshiftH2"]) < strtotime($_POST["endshiftH2"]) && strpos($days2, "H") !== false) || strpos($days2, "H") === false;
                    $validF = (strtotime($_POST["startshiftF2"]) < strtotime($_POST["endshiftF2"]) && strpos($days2, "F") !== false) || strpos($days2, "F") === false;

                    //set times to default value if not set
                    if(strpos($days2, "M") === false){
                        $startshiftM2 = "00:00";
                        $endshiftM2 = "00:00";
                    }
                    if(strpos($days2, "T") === false){
                        $startshiftT2 = "00:00";
                        $endshiftT2 = "00:00";
                    }
                    if(strpos($days2, "W") === false){
                        $startshiftW2 = "00:00";
                        $endshiftW2 = "00:00";
                    }
                    if(strpos($days2, "H") === false){
                        $startshiftH2 = "00:00";
                        $endshiftH2 = "00:00";
                    }
                    if(strpos($days2, "F") === false){
                        $startshiftF2 = "00:00";
                        $endshiftF2 = "00:00";
                    }

                    // run SQL statement to fetch credentials with matching email
                    $stmt = $conn->prepare("UPDATE Schedules " .
                        "SET" . 
                            "Email = ?, `Schedule type` = ?, `Start date` = ?, `End date` = ?," .
                            "`Mon (start time)` = ?, `Mon (end time)` = ?, `Tues (start time)` = ?, `Tues (end time)` = ?, " . 
                            "`Wed (start time)` = ?, `Wed (end time)` = ?, `Thurs (start time)` = ?, `Thurs (end time)` = ?, " . 
                            "`Fri (start time)` = ?, `Fri (end time)` = ?" .
                        "WHERE Email = ? and `Schedule type` = ? and `Start date` = ? and `End date` = ? and " .
                            "`Mon (start time)` = ? and `Mon (end time)` = ? and `Tues (start time)` = ? and `Tues (end time)` = ? and " . 
                            "`Wed (start time)` = ? and `Wed (end time)` = ? and `Thurs (start time)` = ? and `Thurs (end time)` = ? and " . 
                            "`Fri (start time)` = ? and `Fri (end time)` = ?");
                    if($stmt->execute(array(
                        $_SESSION["email"], $shiftType2, $startsched2, $endsched2, 
                        $startshiftM2, $endshiftM2, $startshiftT2, $endshiftT2, $startshiftW2, $endshiftW2, $startshiftH2, $endshiftH2, $startshiftF2, $endshiftF2,
                        $_SESSION["email"], $shiftType, 
                        $startsched, $endsched, $startshiftM, $endshiftM, $startshiftT, $endshiftT, $startshiftW, $endshiftW, $startshiftH, $endshiftH, $startshiftF, $endshiftF))){

                        echo("Changed schedule {$_SESSION["email"]} $shiftType $startsched to $endsched " .
                        "Mon: $startshiftM - $endshiftM Tues: $startshiftT - $endshiftT Wed: $startshiftW - $endshiftW Thurs: $startshiftH - $endshiftH Fri: $startshiftF -$endshiftF to " .
                        "schedule {$_SESSION["email"]} $shiftType2 $startsched2 to $endsched2 " .
                        "Mon: $startshiftM2 - $endshiftM2 Tues: $startshiftT2 - $endshiftT2 Wed: $startshiftW2 - $endshiftW2 Thurs: $startshiftH2 - $endshiftH2 Fri: $startshiftF2 -$endshiftF2");
                    }
                    //if couldnt insert redirect to mySchedule
                    else {
                        echo ("Could not change schedule in database.<br>");
                        header("Refresh: 3; url=http://cmsc447/mySchedule.php");
                    }
                }
                else{
                    echo("Select the day(s) to edit to.");
                }
            }
            elseif (isset($_POST["delete"])) {
                # delete button was clicked
                // run SQL statement to fetch credentials with matching email
                $stmt = $conn->prepare("DELETE FROM Schedules " .
                    "WHERE Email = ? and `Schedule type` = ? and `Start date` = ? and `End date` = ? and " .
                        "`Mon (start time)` = ? and `Mon (end time)` = ? and `Tues (start time)` = ? and `Tues (end time)` = ? and " . 
                        "`Wed (start time)` = ? and `Wed (end time)` = ? and `Thurs (start time)` = ? and `Thurs (end time)` = ? and " . 
                        "`Fri (start time)` = ? and `Fri (end time)` = ?");
                if($stmt->execute(array($_SESSION["email"], $shiftType, $startsched, $endsched, $startshiftM, $endshiftM, $startshiftT, $endshiftT, $startshiftW, $endshiftW, $startshiftH, $endshiftH, $startshiftF, $endshiftF))){
                    echo("Deleted schedule {$_SESSION["email"]} $shiftType, $startsched to $endsched " .
                        "Mon: $startshiftM - $endshiftM Tues: $startshiftT - $endshiftT Wed: $startshiftW - $endshiftW Thurs: $startshiftH - $endshiftH Fri: $startshiftF -$endshiftF");
                }
                //if couldnt insert redirect to mySchedule
                else {
                    echo "Could not delete schedule in database.<br>";
                    header("Refresh: 3; url=http://cmsc447/mySchedule.php");
                }
            }
            else{
                echo("How'd you do that?");
            }
        }
        else{
            echo("Select a day(s).");
        }
    }
    else{
        echo("End time cannot be before start time");
    }
}
?>

</body>
</html>