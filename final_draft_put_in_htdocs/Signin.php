<?php
session_start(); // Start the session at the beginning

$db_user = "root";
$db_pass = "";
$db = "user_base";
$db_host = "localhost:3307";

$conn = new mysqli($db_host, $db_user, $db_pass, $db, 3306);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'], $_POST['password'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT Password FROM user WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Verify the password using MD5
        if (md5($password) === $row['Password']) { // Assuming passwords stored are MD5 hashes
            $_SESSION['email'] = $email;
            header("Location: PowerPulse-main\Homepage\Home.html"); // Redirect to a new page
            exit();
        } else {
            echo "Wrong Username or Password";
        }
    } else {
        echo "Wrong Username or Password";
    }
    $stmt->close();
}
$conn->close();
?>