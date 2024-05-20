<?php
session_start(); // Start the session at the beginning

$db_user = "root";
$db_pass = "";
$db = "user_base";
$db_host = "localhost:3307";

$conn = new mysqli($db_host, $db_user, $db_pass, $db, 3307);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'], $_POST['password'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

     // Hash the password using MD5
     $hashed_password = md5($password);

     // Sanitize inputs for SQL query
     $email = $conn->real_escape_string($email);
     $hashed_password = $conn->real_escape_string($hashed_password);
 
     // Create the SQL query
     $sql = "SELECT * FROM user WHERE Email = '$email' AND Password = '$hashed_password'";
     $result = mysqli_query($conn,$sql);
    
     if (mysqli_num_rows($result) > 0) {
        // Fetch the result as an associative array
        $row = mysqli_fetch_assoc($result);   

        // Set session variables
        $_SESSION['email'] = $row['Email'];
        $_SESSION['username'] = $row['UserName'];
        $_SESSION['logged_in'] = true;
         header("Location: PowerPulse-main/Homepage/Home.php"); // Redirect to a new page
         exit();
     } else {
         echo "Wrong Username or Password";
     }
 }
$conn->close();
?>