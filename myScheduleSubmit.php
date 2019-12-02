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
        //"if the separator is a slash (/), then the American m/d/y is assumed"
        $startshift = strtotime($_POST["startshift"]);
        $endshift = strtotime($_POST["endshift"]);
        $startsched = strtotime($_POST["startsched"]);
        $endsched = strtotime($_POST["endsched"]);

        //check start-end of times
        if($startsched < $endsched && $startshift < $endshift){
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
                $stmt = $conn->prepare("INSERT INTO schedules(email, days, shiftType, startTime, endTime, repeatFrom, repeatUntil) 
                VALUES ($days, $shiftType, $startshift, $endshift, $startsched, $endsched)");
                if($stmt->execute()){
                    echo("Add schedule for $day, $shiftType, {$_POST["startshift"]} to {$_POST["endshift"]} from {$_POST["startsched"]} to {$_POST["endsched"]}");
                }
                //if couldnt insert redirect to mySchedule
                else {
                    echo ("Could not add schedule to database.<br>");
                    header("Refresh: 3; url=http://cmsc447/mySchedule.html");
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
                        echo("Changed schedule for $days, $shiftType, {$_POST["startshift"]} to {$_POST["endshift"]} from {$_POST["startsched"]} to {$_POST["endsched"]} to 
                            $days2, $shiftType2, {$_POST["startshift2"]} to {$_POST["endshift2"]} from {$_POST["startsched2"]} to {$_POST["endsched2"]}");
                    }
                    //if couldnt insert redirect to mySchedule
                    else {
                        echo ("Could not change schedule in database.<br>");
                        header("Refresh: 3; url=http://cmsc447/mySchedule.html");
                    }
                }
                else{
                    echo("Select the day(s) to edit to.")
                }
            }
            elseif (isset($_POST["delete"])) {
                # delete button was clicked
                // run SQL statement to fetch credentials with matching email
                $stmt = $conn->prepare("DELETE FROM schedules WHERE days = $days and shiftType = $shiftType and startTime = $startshift and endTime = $endshift and repeatFrom = $startsched and repeatUntil = $endsched)
                if($stmt->execute()){
                    echo("Deleted schedule for $day, $shiftType, {$_POST["startshift"]} to {$_POST["endshift"]} from {$_POST["startsched"]} to {$_POST["endsched"]}");
                }
                //if couldnt insert redirect to mySchedule
                else {
                    echo "Could not delete schedule in database.<br>";
                    header("Refresh: 3; url=http://cmsc447/mySchedule.html");
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