<!DOCTYPE html>
<head>
  <title>Student Scheduler</title>
  <link rel="stylesheet" type = "text/css" href="homepage.css">
  <div id = "header">
    <p> Student Scheduler </p>
  </div>
</head>
<script>
  function displayEdit() {
    // Get the checkbox
    var checkBox = document.getElementById("cedit");
    // Get the output text
    var editoptions = document.getElementById("editoptions");

    // If the checkbox is checked, display the output text
    if (checkBox.checked == true){
        editoptions.style.display = "block";
    } else {
        editoptions.style.display = "none";
    }
  }
</script>
<body>
  <!--Display current schedule-->
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
            if ($res->rowCount() > 0) { 
                while ($row = $res->fetch()) { 
                    $currSched = $row['Email'] . " " . $row['Schedule type'] . " " . $row['Start date'] . " " . $row['End date'];
                    //check for default times
                    if (is_null($row['Mon (start time)'])){
                        $currSched = $currSched . " Mon:" . $row['Mon (start time)'] . "-" . $row['Mon (end time)'];
                    }
                    if (is_null($row['Tues (start time)'])){
                        $currSched = $currSched . " Tues:" . $row['Tues (start time)'] . "-" . $row['Tues (end time)'];
                    }
                    if (is_null($row['Wed (start time)'])){
                        $currSched = $currSched . " Wed:" . $row['Wed (start time)'] . "-" . $row['Wed (end time)'];
                    }
                    if (is_null($row['Thurs (start time)'])){
                        $currSched = $currSched . " Thurs:" . $row['Thurs (start time)'] . "-" .$row['Thurs (end time)'];
                    }
                    if (is_null($row['Fri (start time)'])){
                        $currSched = $currSched . " Fri:" . $row['Fri (start time)'] . "-" .$row['Fri (end time)'];
                    }
                    echo $currSched . "<br>";
                } 
            }
            else{
                echo "You have no current schedules.";
            }
        }
    }
  ?>
  <input type="checkbox" name="Check to edit" id="cedit" onclick="displayEdit()"> Check to edit<br>
  <form id="mySchedForm" action="myScheduleSubmit.php" method="POST">
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

      <!--Submits: create/edit/delete-->
      <input type="submit" name="create" value="Create" id="c">
      <input type="submit" name="delete" value="Delete" id="s">

      <div id='editoptions' style="display:none">
          New Schedule: <br>
        <input type="radio" name="shiftType2" value="regular"> Regular<br>
        <input type="radio" name="shiftType2" value="temporary"> Temporary<br>
        <input type="radio" name="shiftType2" value="absent"> Absent<br>

        <input type="checkbox" name="day2[]" value="M"> M<br>
      <input type="time" name="startshiftM2" id="shift-start"
          value="8:00"
          min="08:00" max="18:00">
      <input type="time" name="endshiftM2" id="shift-end"
          value="18:00"
          min="08:00" max="18:00"><br>

      <input type="checkbox" name="day2[]" value="T"> T<br>
      <input type="time" name="startshiftT2" id="shift-start"
          value="8:00"
          min="08:00" max="18:00">
      <input type="time" name="endshiftT2" id="shift-end"
          value="18:00"
          min="08:00" max="18:00"><br>

      <input type="checkbox" name="day2[]" value="W"> W<br>
      <input type="time" name="startshiftW2" id="shift-start"
          value="8:00"
          min="08:00" max="18:00">
      <input type="time" name="endshiftW2" id="shift-end"
          value="18:00"
          min="08:00" max="18:00"><br>

      <input type="checkbox" name="day2[]" value="H"> TH<br>
      <input type="time" name="startshiftH2" id="shift-start"
          value="8:00"
          min="08:00" max="18:00">
      <input type="time" name="endshiftH2" id="shift-end"
          value="18:00"
          min="08:00" max="18:00"><br>

      <input type="checkbox" name="day2[]" value="F"> F<br>
      <input type="time" name="startshiftF2" id="shift-start"
          value="8:00"
          min="08:00" max="18:00">
      <input type="time" name="endshiftF2" id="shift-end"
          value="18:00"
          min="08:00" max="18:00"><br>

        <input type="date" name="startsched2" id="sched-start"
            value="2020-01-12"
            min="2019-01-01" max="2099-12-31">
        <input type="date" name="endsched2" id="sched-end"
            value="2020-01-12"
            min="2019-01-01" max="2099-12-31"><br>

          <input type="submit" name="edit" value="Edit">
      </div>
    </form>
</body>
</html>