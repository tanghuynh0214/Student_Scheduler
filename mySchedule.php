<!DOCTYPE html>
<head>
  <title>Student Scheduler</title>
  <link rel="stylesheet" type = "text/css" href="homepage.css">
  <div id = "header">
    <p> Student Scheduler </p>
  </div>
</head>
<body>

    <input type="button" text="Go back" onclick="window.location.href = 'http://speaksnas1.synology.me/homepage.html';">

  <!--Display current schedule-->
  <form id="mySchedForm" action="myScheduleSubmit.php" method="POST">
    <?php
        session_start();

        $host = "localhost:3307";
        $db = "Scheduler";
        $db_username = "Scheduler";
        $db_password = "0q7L3ynn2YLwRJey";

        if(!isset($_SESSION['email'])) {
        echo "You're not logged in.<br>";
        }
        else {
            //Get your schedules
            // connect to database
            try {
                $conn = new PDO("mysql:host=$host;dbname=$db;", $db_username, $db_password);
                // set PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e) {
                echo "Connection Failed: " . $e->getMessage();
            }

            $stmt = $conn->prepare("SELECT * FROM Schedules WHERE Email = ?");
            if($stmt->execute(array($_SESSION['email']))){
                if ($stmt->rowCount() > 0) { 
                    while ($row = $stmt->fetch()) { 
                        $currSched = "ID: " . $row['ID'] . " " . $row['Email'] . " " . $row['Schedule type'] . " " . $row['Start date'] . " " . $row['End date'];
                        //check for default times
                        if (strtotime($row['Mon (start time)']) !== strtotime("00:00")){
                            $currSched = $currSched . " Mon:" . $row['Mon (start time)'] . "-" . $row['Mon (end time)'];
                        }
                        if (strtotime($row['Tues (start time)']) !== strtotime("00:00")){
                            $currSched = $currSched . " Tues:" . $row['Tues (start time)'] . "-" . $row['Tues (end time)'];
                        }
                        if (strtotime($row['Wed (start time)']) !== strtotime("00:00")){
                            $currSched = $currSched . " Wed:" . $row['Wed (start time)'] . "-" . $row['Wed (end time)'];
                        }
                        if (strtotime($row['Thurs (start time)']) !== strtotime("00:00")){
                            $currSched = $currSched . " Thurs:" . $row['Thurs (start time)'] . "-" .$row['Thurs (end time)'];
                        }
                        if (strtotime($row['Fri (start time)']) !== strtotime("00:00")){
                            $currSched = $currSched . " Fri:" . $row['Fri (start time)'] . "-" .$row['Fri (end time)'];
                        }
                        $radioScheds = "<input type='radio' name='idradio' value='{$row['ID']}'>";
                        echo $radioScheds . $currSched . "<br>";
                    } 
                }
                else{
                    echo "You have no current schedules.<br>";
                }
            }
        }
    ?>

<input type="submit" name="delete" value="Delete" id="s"> Choose from above. <br>

      <!--Options: MTWThF/(reg/temp/absent)/shift(start,end)/days(start,end)-->

      <input type="radio" name="shiftType" value="regular"> Regular<br>
      <input type="radio" name="shiftType" value="temporary"> Temporary<br>
      <input type="radio" name="shiftType" value="absent"> Absent<br>

      <input type="checkbox" name="day[]" value="M"> M<br>
      <input type="time" name="startshiftM" id="shift-start"
          value="8:00"
          min="08:00" max="18:00">
      <input type="time" name="endshiftM" id="shift-end"
          value="18:00"
          min="08:00" max="18:00"><br>

      <input type="checkbox" name="day[]" value="T"> T<br>
      <input type="time" name="startshiftT" id="shift-start"
          value="8:00"
          min="08:00" max="18:00">
      <input type="time" name="endshiftT" id="shift-end"
          value="18:00"
          min="08:00" max="18:00"><br>

      <input type="checkbox" name="day[]" value="W"> W<br>
      <input type="time" name="startshiftW" id="shift-start"
          value="8:00"
          min="08:00" max="18:00">
      <input type="time" name="endshiftW" id="shift-end"
          value="18:00"
          min="08:00" max="18:00"><br>

      <input type="checkbox" name="day[]" value="H"> TH<br>
      <input type="time" name="startshiftH" id="shift-start"
          value="8:00"
          min="08:00" max="18:00">
      <input type="time" name="endshiftH" id="shift-end"
          value="18:00"
          min="08:00" max="18:00"><br>

      <input type="checkbox" name="day[]" value="F"> F<br>
      <input type="time" name="startshiftF" id="shift-start"
          value="8:00"
          min="08:00" max="18:00">
      <input type="time" name="endshiftF" id="shift-end"
          value="18:00"
          min="08:00" max="18:00"><br>

      <input type="date" name="startsched" id="sched-start"
          value="2020-01-12"
          min="2019-01-01" max="2099-12-31">
      <input type="date" name="endsched" id="sched-end"
          value="2020-01-12"
          min="2019-01-01" max="2099-12-31"><br>

    <input type="number" name="idnum" min="1" max="99999999999"> ID for schedule. Must be unique. <br>

      <!--Submits: create/edit/delete-->
        <input type="submit" name="create" value="Create" id="c"> <br>
        <input type="submit" name="edit" value="Edit"> Choose from current schedules, then set new values. <br>
    </form>
</body>
</html>