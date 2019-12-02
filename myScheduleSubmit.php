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
$db = "student_scheduler";
$db_username = "root";
$db_password = "";

if(!isset($_SESSION['email'])) {
    echo "You're not logged in.<br>";
}
else {
    //store vars
    $days = "";
    if(!empty($_POST['day'])) {
        foreach($_POST['day'] as $dow) {
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
        $validM = (strtotime($_POST["startshiftM"]) < strtotime($_POST["endshiftM"]) && strpos($days, 'M') !== false) || strpos($days, 'M') === false;
        $validT = (strtotime($_POST["startshiftT"]) < strtotime($_POST["endshiftT"]) && strpos($days, 'T') !== false) || strpos($days, 'T') === false;
        $validW = (strtotime($_POST["startshiftW"]) < strtotime($_POST["endshiftW"]) && strpos($days, 'W') !== false) || strpos($days, 'W') === false;
        $validH = (strtotime($_POST["startshiftH"]) < strtotime($_POST["endshiftH"]) && strpos($days, 'H') !== false) || strpos($days, 'H') === false;
        $validF = (strtotime($_POST["startshiftF"]) < strtotime($_POST["endshiftF"]) && strpos($days, 'F') !== false) || strpos($days, 'F') === false;

        //set times to default value if not set
        if(strpos($days, 'M') === false){
            $startshiftM = null;
            $endshiftM = null;
        }
        if(strpos($days, 'T') === false){
            $startshiftT = null;
            $endshiftT = null;
        }
        if(strpos($days, 'W') === false){
            $startshiftW = null;
            $endshiftW = null;
        }
        if(strpos($days, 'H') === false){
            $startshiftH = null;
            $endshiftH = null;
        }
        if(strpos($days, 'F') === false){
            $startshiftF = null;
            $endshiftF = null;
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
                    "Schedules(Email, Schedule type, Start date, End date, " .
                        "Mon (start time), Mon (end time), Tues (start time), Tues (end time), Wed (start time), Wed (end time), Thurs (start time), Thurs (end time), Fri (start time), Fri (end time)) " .
                    "VALUES " .
                        "({$_SESSION["email"]}, $shiftType, " .
                            "$startshiftM, $endshiftM, $startshiftT, $endshiftT, $startshiftW, $endshiftW, $startshiftH, $endshiftH, $startshiftF, $endshiftF)");
                if($stmt->execute()){
                    echo("Added schedule {$_SESSION["email"]} $shiftType " .
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
                if(!empty($_POST['day2'])) {
                    foreach($_POST['day2'] as $dow) {
                            $days = $days . $dow;
                    }
                    $shiftType = $_POST["shiftType2"];
                    //"if the separator is a slash (/), then the American m/d/y is assumed"
                    $startshift = strtotime($_POST["startshift2"]);
                    $endshift = strtotime($_POST["endshift2"]);
                    $startsched = strtotime($_POST["startsched2"]);
                    $endsched = strtotime($_POST["endsched2"]);

                    // run SQL statement to fetch credentials with matching email
                    $stmt = $conn->prepare("");//UPDATE???
                    if($stmt->execute()){
                        echo("Changed schedule for $days, $shiftType, {$_POST["startshift"]} to {$_POST["endshift"]} from {$_POST["startsched"]} to {$_POST["endsched"]} to " .
                            "$days2, $shiftType2, {$_POST["startshift2"]} to {$_POST["endshift2"]} from {$_POST["startsched2"]} to {$_POST["endsched2"]}");
                    }
                    //if couldnt insert redirect to mySchedule
                    else {
                        echo ("Could not change schedule in database.<br>");
                        header("Refresh: 3; url=http://cmsc447/mySchedule.php");
                    }
                }
                else{
                    echo("Select the day(s) to edit to.")
                }
            }
            elseif (isset($_POST["delete"])) {
                # delete button was clicked
                // run SQL statement to fetch credentials with matching email
                $stmt = $conn->prepare("DELETE FROM Schedules " .
                    "WHERE Email = {$_SESSION['email']} and Schedule type = $shiftType and " .
                        "Mon (start time) = $startshiftM and Mon (end time) = $endshiftM and Tues (start time) = $startshiftT and Tues (end time) = $endshiftT and " . 
                        "Wed (start time) = $startshiftW and Wed (end time) = $endshiftW and Thurs (start time) = $startshiftH and Thurs (end time) = $endshiftH and " . 
                        "Fri (start time) = $startshiftF and Fri (end time) = $endshiftF");
                if($stmt->execute()){
                    echo("Deleted schedule {$_SESSION["email"]} $shiftType " .
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
            echo("Select a day(s).")
        }
    }
    else{
        echo("End time cannot be before start time");
    }
}
?>

</body>
</html>