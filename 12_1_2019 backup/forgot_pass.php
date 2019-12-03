<!DOCTYPE html>
<html>
<body>

<?php

// database information
$host = "localhost:3307";
$db = "student_scheduler";
$db_username = "root";
$db_password = "";

// validate input and store into variables
$in_email = validate($_POST["email"]);

// function to validate value of each input
function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// connect to database
try {
    $conn = new PDO("mysql:host=$host;dbname=$db;", $db_username, $db_password);
    // set PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
    echo "Connection Failed: " . $e->getMessage();
}

// run SQL statement to fetch credentials with matching email
$stmt = $conn->prepare('SELECT * FROM auth WHERE email=:email');
$stmt->execute(['email' => $in_email]);

// fetch row, extract and store password value
$fetched_password = $stmt->fetch()['password'];

// check if fetched password is not empty
if(!empty($fetched_password)) {
    $to = $in_email;
    $subject = "Student Scheduler Password Reset";
    $msg = "Your Student Scheduler password is: " . $fetched_password;
    $headers = "From: student_scheduler@umbc.edu";

    mail($to, $subject, $msg, $headers);
}
// if email not found in database, redirect to reset page again
else {
    echo "Incorrect Email.<br>";
    header("Refresh: 3; url=http://cmsc447/passreset.html");
}

?>

</body>
</html>