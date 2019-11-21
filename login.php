<!DOCTYPE html>
<html>
<body>

<?php

// database information
$servername = "localhost";
$username = "root";
$password = "";

// connect to database
try {
    $conn = new PDO("mysql:host=$servername;dbname=student_scheduler", $username, $password);
    // set PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully<br>";
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// validate input and store into variables
$email = validate($_POST["email"]);
$password = validate($_POST["password"]);

// function to validate value of each input
function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// print out valid input
echo "Email: " . $email . "<br>";
echo "Password: " . $password . "<br>";

?>

</body>
</html>