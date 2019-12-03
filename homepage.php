<?php
session_start();
?>

<!DOCTYPE html>
<head>
    <title>Student Scheduler</title>
    <link rel="stylesheet" type = "text/css" href="homepage.css">
    <div id = "header">
        <p> Student Scheduler </p>
       <img src="https://styleguide.umbc.edu/files/2019/01/UMBC-vertical-logo-RGB.png"
       width="3%" 
       height="3%" 
       alt="University of Maryland Baltimore County Logo">
    </div>
</head>

<body style="background-color: #A9A9A9">
    <?php
    if(!isset($_SESSION['email'])) {
        echo "<p id='welcome'> You are not logged in.<br> </p>";
    }
    else {
    	list($user, $domain) = explode('@', $_SESSION['email']);
        echo  "<p id='welcome'> Welcome, " . $user . "<br></p>";
    }
    ?>

    <!-- Buttons -->
    <div class="buttonContent">
        <div class = "button1">
        <a href="http://speaksnas1.synology.me/mySchedule.php"> My Schedules </a>
        </div>
        <div class="button2">
        <a href="http://speaksnas1.synology.me/auth"> Login </a>
        </div>
    </div>

    <!-- Table -->
    <div id="scheduler">
    	<table border = '1' id = 'calender'>
        	<script src="homepage.js"></script>
        	<?php
        	$row = 11;
			$col = 6;
        	$startTime = 8;                //start time variable used for calculations
			$miliTime = 0;
			$actualTime = 0;
			for($i = 0; $i < $row; $i++)
			{
				echo '<tr>';
				for($j = 0; $j < $col; $j++)
				{
    				// Time period
    				if($j==0)
					{
    					$miliTime = ($startTime + j) % 24;
    					$actualTime = $miliTime % 12;
    					if(($miliTime < 12 || $miliTime == 24) && $actualTime < 10)
    					{
        					echo '<td>' . '0' . $actualTime . ':00 AM' . '</td>';
    					}
    					else if(($miliTime < 12 || $miliTime == 24) && $actualTime >= 10)
    					{
        					echo '<td>' . $actualTime . ':00 AM' . '</td>';
    					}
    					else if(($miliTime < 24 || $miliTime == 12)  && $actualTime < 10)
    					{
    						if($actualTime == 0) //This if else statement here is purely so that the time does not output as 00:00 PM instead of 12:00 PM
      							echo '<td>' . '12' . ':00 PM' . '</td>';
      						else
    							echo '<td>' . '0' . $actualTime . ':00 PM' . '</td>';
    					}
    					else if(($miliTime < 24 || $miliTime == 12) && $actualTime >= 10)
    					{
        					echo '<td>' . $actualTime . ':00 PM' . '</td>';
    					}
    					$startTime++;
    				}
    				else
    				{
    					$miliTime = ($startTime + j) % 24 - 1;
    					session_start();

        				$host = "localhost:3307";
        				$db = "Scheduler";
        				$db_username = "Scheduler";
        				$db_password = "0q7L3ynn2YLwRJey";
        				
        				try {
                			$conn = new PDO("mysql:host=$host;dbname=$db;", $db_username, $db_password);
            				 // set PDO error mode to exception
                			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            			}
            			catch(PDOException $e) {
            				echo "Connection Failed: " . $e->getMessage();
            			}
            			echo '<td>';
            			$count = 0;
            			$color = "#C1301C";
            			$calcDay = "";
            			if($j==1)
            				$calcDay = "Mon";
            			else if($j==2)
            				$calcDay = "Tues";
            			else if($j==3)
            				$calcDay = "Wed";
            			else if($j==4)
            				$calcDay = "Thurs";
            			else if($j==5)
            				$calcDay = "Fri";
            				
            			$stmt = $conn->query("SELECT * FROM Schedules");
            			$len = $stmt->rowCount();
            			if ($stmt->rowCount() > 0) { 
                   			while ($val = $stmt->fetch()) {
                   				if($count == 1) $color = "#2E5793"; //Blue
                   				if($count == 2) $color = "#177245"; //Green
                   				if($count == 3) $color = "#C96112"; //Orange
                   				if($count == 4) $color = "#C4A705"; //Yellow
                   				if($count == 5) $color = "#4B2882"; //Purple
                   				
                   				list($user, $domain) = explode('@', $val["Email"]);
                   				if(strtotime($val[$calcDay . ' (start time)']) !== strtotime("00:00") && strtotime($val[$calcDay . ' (start time)']) <= strtotime($miliTime . ":00") && strtotime($val[$calcDay . ' (end time)']) >= strtotime($miliTime. ":00"))
                   					echo '<div style="height: 40px;color:white;float: left;width:calc(100% /' . $len . ');background-color: '. $color .';"><div style="visibility:hidden;">'. $user .'</div></div>';
                   				else
                   					echo '<div style="height: 40px;visibility: hidden;float: left;width:calc(100% /' . $len . ');">'. $user .'</div>';
                   					
                   				$count++;
                   			} 
               			}
           
    					echo '</td>';
    				}
				}
				echo '</tr>';
			}
        	?>
        </table>
        </div>
        <table style="width:80%;margin: auto;"><tr><?php
        $count = 0;
        $color = "#C1301C";
        $stmt = $conn->query("SELECT * FROM Schedules");
        $len = $stmt->rowCount();
        if ($stmt->rowCount() > 0) { 
            while ($val = $stmt->fetch()) {
              	if($count == 1) $color = "#2E5793"; //Blue
		   		if($count == 2) $color = "#177245"; //Green
             	if($count == 3) $color = "#C96112"; //Orange
               	if($count == 4) $color = "#C4A705"; //Yellow
                if($count == 5) $color = "#4B2882"; //Purple
                list($user, $domain) = explode('@', $val["Email"]);
                echo '<th><div style="text-align: center;color:white;margin: auto;padding: 2px;border: 2px solid gray;background-color: '. $color .';">'. $user .'</div></th>'; 							
                $count++;
            } 
        }
        ?></tr></table>
    
    
    <div class="footer">
        <small>&copy;Library Group 5 - Student Scheduler FA2019</small>
    </div>
</body>
</html>