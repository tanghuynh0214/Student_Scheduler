<!DOCTYPE html>
<head>
  <title>My Schedules</title>
  <link rel="stylesheet" type = "text/css" href="mySchedule.css">
  <div id = "header">
    <p> My Schedules </p>
  </div>
</head>
<body style="background-color: #A9A9A9">
	<table id="header" style="width:50%;margin:auto"><tr><td>
	<div class="buttonContent">
    	<input class="button1" type="button" name="return_to_main" value="return to homepage" onclick="window.location.href = 'http://speaksnas1.synology.me/homepage.php';">
	</div>
	</td></tr></table>

	<form id="mySchedForm" action="myScheduleSubmit.php" method="POST">
	
	<!--schedule type buttons-->
	<table id="header" style="width:50%;margin:auto"><tr>
	
		<th><input style="background-color: #4CAF50;
  border: 1px solid green;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  cursor: pointer;
  float: right;
  margin-bottom: 10px;" type="submit" name="create" value="Create"></th>
		<th><input style="background-color: #4CAF50;
  border: 1px solid green;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  cursor: pointer;
  
  margin-bottom: 10px;" type="submit" name="edit" value="Edit"></th> <!--Choose from current schedules, then set new values. -->
		<th><input style="background-color: #4CAF50;
  border: 1px solid green;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  cursor: pointer;
  float: left;
  margin-bottom: 10px;" type="submit" name="delete" value="Delete"></th> <!--Choose from above. -->
		
	</tr></table>
	<p style="clear:both"></p>
	
	<!--Display current schedules-->
	<table border="1" id="calender">
	<tr>
		<td> ID # </td>
		<td> Student </td>	
		<td> Type </td>
		<td> Start date </td>
		<td> End date </td>
		<td> Monday </td>
		<td> Tuesday </td>
		<td> Wednesday </td>
		<td> Thursday </td>
		<td> Friday </td>
	</tr>
	
    <?php
        session_start();

        $host = "localhost:3307";
        $db = "Scheduler";
        $db_username = "Scheduler";
        $db_password = "0q7L3ynn2YLwRJey";

        if(!isset($_SESSION['email'])) {
        echo "<p style=text-align:center> You are not logged in.</p><br>";
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
                        $radioScheds = "<input type='radio' name='idradio' value='{$row['ID']}'>";
                        echo  "<tr>
                    	<td>" . $radioScheds . 
                    	"{$row['ID']}</td>
                    	<td>{$row['Email']}</td>
                    	<td>{$row['Schedule type']}</td>
                    	<td>{$row['Start date']}</td>
                    	<td>{$row['End date']}</td>";
                        //check for default times
                        if (strtotime($row['Mon (start time)']) !== strtotime("00:00")){
                            $currSched = $currSched . " Mon:" . $row['Mon (start time)'] . "-" . $row['Mon (end time)'];
                            echo "<td>{$row['Mon (start time)']}</td>";
                        }
                        else{
                            echo "<td> N/A </td>";                        	
                        }
                        if (strtotime($row['Tues (start time)']) !== strtotime("00:00")){
                            $currSched = $currSched . " Tues:" . $row['Tues (start time)'] . "-" . $row['Tues (end time)'];
                            echo "<td>{$row['Tues (start time)']}</td>";
                        }
                        else{
                        	echo "<td> N/A </td>"; 
                        }
                        if (strtotime($row['Wed (start time)']) !== strtotime("00:00")){
                            $currSched = $currSched . " Wed:" . $row['Wed (start time)'] . "-" . $row['Wed (end time)'];
                            echo "<td>{$row['Wed (start time)']}</td>";
                        }
                        else{
                        	echo "<td> N/A </td>"; 
                        }                        
                        if (strtotime($row['Thurs (start time)']) !== strtotime("00:00")){
                            $currSched = $currSched . " Thurs:" . $row['Thurs (start time)'] . "-" .$row['Thurs (end time)'];
                            echo "<td>{$row['Thurs (start time)']}</td>";
                        }
                        else{
                        	echo "<td> N/A </td>"; 
                        }                        
                        if (strtotime($row['Fri (start time)']) !== strtotime("00:00")){
                            $currSched = $currSched . " Fri:" . $row['Fri (start time)'] . "-" .$row['Fri (end time)'];
                            echo "<td>{$row['Fri (start time)']}</td>";
                        }
                        else{
                        	echo "<td> N/A </td>"; 
                        }                        
                        //echo $radioScheds . $currSched . "<br>";
                    } 
                }
                else{
                    echo "<p style=text-align:center> You have no current schedules.</p><br>";
                }
            }
        }
    ?>
	</table>
<div class = "content">
      <!--Options: MTWThF/(reg/temp/absent)/shift(start,end)/days(start,end)-->
<hr>
<div class="schedgroup">
      <input class="raidopad" type="radio" name="shiftType" value="regular"> Regular
      <input class="raidopad" type="radio" name="shiftType" value="temporary"> Temporary
      <input class="raidopad" type="radio" name="shiftType" value="absent"> Absent <br>

      <input type="checkbox" name="day[]" value="M"> M: &nbsp
      <input type="time" name="startshiftM" id="shift-start"
          value="08:00"
          min="08:00" max="18:00">
      <input type="time" name="endshiftM" id="shift-end"
          value="18:00"
          min="08:00" max="18:00"><br>
<div style="padding-left:5px">
      <input type="checkbox" name="day[]" value="T"> T: &nbsp
      <input type="time" name="startshiftT" id="shift-start"
          value="08:00"
          min="08:00" max="18:00">
      <input type="time" name="endshiftT" id="shift-end"
          value="18:00"
          min="08:00" max="18:00"><br>
</div>
      <input type="checkbox" name="day[]" value="W"> W: &nbsp
      <input type="time" name="startshiftW" id="shift-start"
          value="08:00"
          min="08:00" max="18:00">
      <input type="time" name="endshiftW" id="shift-end"
          value="18:00"
          min="08:00" max="18:00"><br>
<div style="padding-right:8px">
      <input type="checkbox" name="day[]" value="H"> TH: &nbsp
      <input type="time" name="startshiftH" id="shift-start"
          value="08:00"
          min="08:00" max="18:00">
      <input type="time" name="endshiftH" id="shift-end"
          value="18:00"
          min="08:00" max="18:00"><br>
</div>
<div style="padding-left:5px">
      <input type="checkbox" name="day[]" value="F"> F: &nbsp
      <input type="time" name="startshiftF" id="shift-start"
          value="08:00"
          min="08:00" max="18:00">
      <input type="time" name="endshiftF" id="shift-end"
          value="18:00"
          min="08:00" max="18:00"><br>
</div>     
</div>          
<hr>
<div class="dategroup">
      Start Date: <input type="date" name="startsched" id="sched-start"

          min="2019-01-01" max="2099-12-31"><br>
<div style="padding-left:5px">          
      End Date: <input type="date" name="endsched" id="sched-end"

          min="2019-01-01" max="2099-12-31"><br>
</div>             
</div>
<hr>
<div class="idgroup">
    Schedule ID: <input type="number" name="idnum" min="1" max="99999999999"> (must be unique) <br>
</div>
      <!--Submits: create/edit/delete-->

    </form>
    </div>
</body>
</html>