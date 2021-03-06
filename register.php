<!DOCTYPE html>
<html>
<body style="background-color: #A9A9A9">

<?php

// database information
$host = "localhost";
$port = "3307";
$db = "Scheduler";
$db_username = "Scheduler";
$db_password = "0q7L3ynn2YLwRJey";

// validate input and store into variables
$in_email = validate($_POST["email"]);
$in_password = validate($_POST["password"]);
$in_password2 = validate($_POST["password2"]);

// function to validate value of each input
function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// if entered passwords don't match, return to auth page
if($in_password != $in_password2) {
    echo "Passwords don't match, please try again.";
    header("Refresh: 3; url=http://speaksnas1.synology.me/auth");
}
else {
    // connect to database
    try {
        $conn = new PDO("mysql:host=$host:$port;dbname=$db", $db_username, $db_password);
        // set PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e) {
        echo "Connection Failed: " . $e->getMessage();
    }

    // run SQL statement to check whether email has been used
    $stmt = $conn->prepare('SELECT * FROM auth WHERE email=:email');
    $stmt->execute(['email' => $in_email]);
    // fetch email
    $fetched_email = $stmt->fetch()['email'];

    // if nothing returned, proceed with registration
    if(empty($fetched_email)) {
        // run SQL statement to insert email and password into auth table
        $stmt = $conn->prepare('INSERT INTO auth VALUES (:email, :password)');
        $stmt->execute(['email' => $in_email, 'password' => $in_password]);

        // jump back to auth page for login
        echo "Registration successful, please login.";
        header("Refresh: 3; url=http://speaksnas1.synology.me/auth");
    }
    // if email returned, display message
    else {
        echo "Email already in system, please login.";
        header("Refresh: 3; url=http://speaksnas1.synology.me/auth");
    }
}

?>

</body>
</html>