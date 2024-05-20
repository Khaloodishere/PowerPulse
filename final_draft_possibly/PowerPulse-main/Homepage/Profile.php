<?php
session_start(); 

// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}
$db_user = "root";
$db_pass = "";
$db_name = "user_base";
$db_host = "localhost:3307";

// Create connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);


$email = $_SESSION['email'];
$username = $_SESSION['username'];

   
// Create the SQL query with placeholders
$sql = "SELECT * FROM user WHERE UserName='$username' AND Email='$email'";

// Execute the query
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);
    $gender = $row["Gender"];
    $age = $row["Age"];
    $weight = $row["Current_Weight"];
    $goal_weight = $row["Goal_Weight"];
    $height = $row["Height"];
    $bmi = $row["Bmi"];
    $plan = $row["Plan"];
} else {
    echo "No user found.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="Profile_style.css">
</head>
<body>
    <nav>
        <a href="http://localhost/PowerPulse-main/Homepage/Home.php" target="_self"><div class="logo">PWRpulse</div></a>
        <div class="nav-items">
            <a href="Diets.html">Diets</a>
            <a href="Exercise.html">Exercises</a>
            <a href="http://localhost/PowerPulse-main/Homepage/Quiz.php">Take Quiz</a>
        </div>
    </nav>
    <br><br><br>
        <form>
            
            
        </form>
    <div class="center-container">
        <div class="Profile-container">
            <h2>Your information</h2>
            <form>
            <label for="username">Username:</label>
<input type="text" id="username" name="username" value="<?php echo $username ?>" readonly>

<label for="email">Email:</label>
<input type="text" id="email" name="email" value="<?php echo $email ?>" readonly>

<label for="gender">Gender:</label>
<input type="text" id="gender" name="gender" value="<?php echo $gender ?>" readonly>

<label for="age">Age:</label>
<input type="text" id="age" name="age" value="<?php echo $age ?>" readonly>

<label for="weight">Current Weight:</label>
<input type="text" id="weight" name="weight" value="<?php echo $weight ?>kg" readonly>

<label for="goal_weight">Goal Weight:</label>
<input type="text" id="goal_weight" name="goal_weight" value="<?php echo $goal_weight ?>kg" readonly>

<label for="height">Height:</label>
<input type="text" id="height" name="height" value="<?php echo $height ?>cm" readonly>

<label for="bmi">BMI:</label>
<input type="text" id="bmi" name="bmi" value="<?php echo $bmi ?>" readonly>

<label for="plan">Plan:</label>
<input type="text" id="plan" name="plan" value="<?php echo $plan ?>" readonly>
         <br><br><br><br><br><br><br><br><br><br><br>
         
            </form>
        </div>
    </div>
</body>
</html>
