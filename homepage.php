<?php
session_start();
?>

<!DOCTYPE html>
<head>
  <title>Student Scheduler</title>
  <link rel="stylesheet" type = "text/css" href="homepage.css">
  <div id = "header">
    <p> Student Scheduler </p>
  </div>
</head>
<body>
  <?php
  echo "Email: " . $_SESSION['email'] . "<br>";
  ?>

  <!-- Button row -->
  <div class="buttonContent">
    <div class = "button1">
      <a href="mySchedule.html"> My Schedules </a>
    </div>
    <div class="button2">
      <a href="http://speaksnas1.synology.me/auth"> Login </a>
    </div>
  </div>
  <div id="scheduler">
    <script src="homepage.js">
    </script>

  </div>
  <div class="footer">
    <small>&copy;Library Group 5 - Student Scheduler FA2019</small>
  </div>
</body>
</html>
