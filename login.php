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
$in_password = validate($_POST["password"]);

// function to validate value of each input
function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// print out valid input
// echo "Email: " . $in_email . "<br>";
// echo "Password: " . $in_password . "<br>";

// connect to database
try {
    $conn = new PDO("mysql:host=$host;dbname=$db;", $db_username, $db_password);
    // set PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected to $db successfully<br>";
}
catch(PDOException $e) {
    echo "Connection Failed: " . $e->getMessage();
}

// run SQL statement to fetch credentials with matching email
$stmt = $conn->prepare('SELECT * FROM auth WHERE email=:email');
$stmt->execute(['email' => $in_email]);

// fetch row, extract and store password value
$fetched_password = $stmt->fetch()['password'];

// check if fetched password is not empty, perform comparison with input
if(!empty($fetched_password)) {
    // if comparison passes, redirect to homepage
    if($in_password == $fetched_password) {
        echo "Login Successful.<br>";
        header("Refresh: 3; url=http://cmsc447/homepage.html");
    }
    // if comparison fails, redirect to authentication page again
    else {
        echo "Login Failed: Wrong Password.<br>";
        header("Refresh: 3; url=http://cmsc447/auth.html");
    }
}
// if email not found in database, redirect to authentication page again
else {
    echo "Incorrect Email.<br>";
    header("Refresh: 3; url=http://cmsc447/auth.html");
}

?>

</body>
</html>