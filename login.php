<!DOCTYPE html>
<html>
<body>

<?php

// database information
$host = "localhost";
$db = "student_scheduler";
$db_username = "root";
$db_password = "";

// validate input and store into variables
$in_email = validate($_POST["email"]);
$in_password = validate($_POST["password"]);

// function to validate value of each input
function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// print out valid input
echo "Email: " . $in_email . "<br>";
echo "Password: " . $in_password . "<br>";

// connect to database
try {
    $conn = new PDO("mysql:host=$host;dbname=$db;", $db_username, $db_password);
    // set PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected to $db successfully<br>";
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// run SQL statement to fetch credentials with matching email
$stmt = $conn->prepare('SELECT * FROM auth WHERE email=:email');
$stmt->execute(['email' => $in_email]);
while ($row = $stmt->fetch())
{
    echo "Password for $in_email is " . $row['password'] . "<br>";
}

?>

</body>
</html>