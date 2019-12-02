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

//store vars
$day = $_POST["day"];
$shiftType = $_POST["shiftType"];
//"if the separator is a slash (/), then the American m/d/y is assumed"
$startshift = strtotime($_POST["startshift"]);
$endshift = strtotime($_POST["endshift"]);
$startsched = strtotime($_POST["startsched"]);
$endsched = strtotime($_POST["endsched"]);

//check start end of dates
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
    if (isset($_POST['create'])) {
        // create button was clicked

        // run SQL statement to fetch credentials with matching email
        $stmt = $conn->prepare('');//INSERT INTO ?schedules?(day, shiftType, starttime, endtime, startweek, endweek) VALUES ($day, $shiftType, $startshift, $endshift, $startsched, $endsched)
        if($stmt->execute()){
            echo("Add schedule for $day, $shiftType, {$_POST['startshift']} to {$_POST['endshift']} from {$_POST['startsched']} to {$_POST['endsched']}");
        }
        //if couldnt insert redirect to mySchedule
        else {
            echo ("Could not add schedule to database.<br>");
            header("Refresh: 3; url=http://cmsc447/mySchedule.html");
        }
    }
    elseif (isset($_POST['edit'])) {
        # edit button was clicked

        // run SQL statement to fetch credentials with matching email
        $stmt = $conn->prepare('');//UPDATE???
        if($stmt->execute()){
            echo("Changed schedule for $day, $shiftType, {$_POST['startshift']} to {$_POST['endshift']} from {$_POST['startsched']} to {$_POST['endsched']} to .....................................................");
        }
        //if couldnt insert redirect to mySchedule
        else {
            echo ("Could not change schedule in database.<br>");
            header("Refresh: 3; url=http://cmsc447/mySchedule.html");
        }
    }
    elseif (isset($_POST['delete'])) {
        # delete button was clicked
        // run SQL statement to fetch credentials with matching email
        $stmt = $conn->prepare('');//DELETE FROM ?schedules? WHERE day = $day and shifttype = $shiftType and starttime = $startshift and endtime = $endshift and startweek = $startsched and endweek = $endsched)
        if($stmt->execute()){
            echo("Deleted schedule for $day, $shiftType, {$_POST['startshift']} to {$_POST['endshift']} from {$_POST['startsched']} to {$_POST['endsched']}");
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
    echo("End time cannot be before start time");
}
?>

</body>
</html>