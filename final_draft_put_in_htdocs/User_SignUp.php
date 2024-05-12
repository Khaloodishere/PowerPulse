<?php

$db_user = "root";
$db_pass = "";
$db = "user_base";
$db_host =  "localhost:3307";
$conn = "";
try {
    $conn = new mysqli($db_host, $db_user, $db_pass, $db, 3306);
} catch (mysqli_sql_exception $e) {
    echo "There is an error! " . $e->getMessage();
}

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Hash the password using MD5 before saving to the database
    $hashed_password = md5($password);

    // Insert the user data into the database
    $stmt = $conn->prepare("INSERT INTO user (Email, Password) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $hashed_password);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Sign up successful!";
    } else {
        echo "Error signing up!";
    }
}
?>

