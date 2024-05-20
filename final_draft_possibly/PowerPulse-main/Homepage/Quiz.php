<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db_user = "root";
    $db_pass = "";
    $db_name = "user_base";
    $db_host = "localhost:3307";

    // Create connection
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data (with isset() checks)
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $age = isset($_POST['age']) ? $_POST['age'] : 0;
    $weight = isset($_POST['weight']) ? $_POST['weight'] : 0;
    $goalWeight = isset($_POST['goal_weight']) ? $_POST['goal_weight'] : 0;
    $height = isset($_POST['height']) ? $_POST['height'] : 0;
    $bmi = isset($_POST['bmi']) ? $_POST['bmi'] : 0;
    $plan = isset($_POST['plan']) ? $_POST['plan'] : '';
    $email = $_SESSION['email'];
    $username = $_SESSION['username'];

    // Create the SQL query with placeholders
$sql = "UPDATE user SET Gender=?, Age=?, Current_Weight=?, Goal_Weight=?, Height=?, Bmi=?, Plan=? WHERE UserName=? AND Email=?";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Bind parameters
$stmt->bind_param("siiddisss", $gender, $age, $weight, $goalWeight, $height, $bmi, $plan, $username, $email);
$stmt->execute();

// Close the statement and connection
$stmt->close();
$conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Diet Plan Quiz</title>
<style>
    /* CSS styles */
    body {
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande',
      'Lucida Sans', Arial, sans-serif;        background-color: #f1f1f1;
        margin: 0;
        padding: 0;
        
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .card {
        display: none;
    }

    .card.active {
        display: block;
    }

    h1 {
        text-align: center;
    }

    label {
        display: block;
        margin-bottom: 10px;
    }

    input[type="number"] {
        width: 15%;
        text-align: center;
        padding: 8px;
        margin-top: 5px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }


    .btn {
        display: block;
        width: 100%;
        padding: 10px;
        background-color: #beb58d;
        color: rgb(0, 0, 0);
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 20px;
    }

    .btn:hover {
        background-color: #c1b993;
    }
    nav {
        height: 80px;
        background: #beb58d;
        background-size: cover;
        display: flex;
        justify-content: space-between;
        align-items: center;
       
      }
      nav a {
        text-decoration: none;
        color: #ffffff;
        font-size: larger;
        padding: 20px;
      }
      
      nav a:hover {
        color: #838383;
      }
      .logo {
        color: #ffffff;
        font-size: 1.5rem;
        font-weight: bold;
        font-style: italic;
        padding: 0 2rem;
      }
     
</style>
</head>
<body>
    <nav>
        <a href="http://localhost/PowerPulse-main/Homepage/Home.php" target="_self"><div class="logo">PWRpulse</div></a>
        <div class="nav-items">
           <a href="Exercise.html">Exercises</a> <a href="sign_in.html">Sign In</a><a href="sign_up.html">Sign up</a>
        </div>
      </nav>
<br><br><br><br><br><br><br><br>
<div class="container">
    <h1>Diet Plan Quiz</h1>

    <!-- Gender Card -->
    <div class="card active" id="gender-card">
        <h2>Gender</h2>
        <label style="font-size: 20px;" for="gender-male">
            <input type="radio" name="gender" id="gender-male" value="male">
            Male
        </label>
        <label style="font-size: 20px;"  for="gender-female">
            <input type="radio" name="gender" id="gender-female" value="female">
            Female
        </label>
        <button class="btn" onclick="nextPage('age-card')">Next</button>
    </div>

    <!-- Age Card -->
    <div class="card" id="age-card">
        <h2>Age</h2>
        <label for="age">
            <input type="number" name="age" id="age" min="18">
        </label>
        <button class="btn" onclick="nextPage('weight-card')">Next</button>
    </div>

    <!-- Current Weight Card -->
    <div class="card" id="weight-card">
        <h2>Current Weight</h2>
        <label for="weight">
            <input type="number" name="weight" id="weight">
        </label>
        <button class="btn" onclick="nextPage('goal-weight-card')">Next</button>
    </div>

    <!-- Goal Weight Card -->
    <div class="card" id="goal-weight-card">
        <h2>Goal Weight</h2>
        <label for="goal-weight">
            <input type="number" name="goal-weight" id="goal-weight">
        </label>
        <button class="btn" onclick="nextPage('height-card')">Next</button>
    </div>

    <!-- Height Card -->
    <div class="card" id="height-card">
        <h2>Height</h2>
        <label for="height">
            <input type="number" name="height" id="height">
        </label>
        <button class="btn" onclick="calculatePlan()">Calculate Plan</button>
    </div>
<br>
<br>
    <div id="message-box"></div>

</div>
<form method="Post"  id="hidden-form">
    <!-- Your form inputs and buttons -->
    <!-- Example: -->
    <input type="hidden" name="gender" id="hidden-gender">
    <input type="hidden" name="age" id="hidden-age">
    <input type="hidden" name="weight" id="hidden-weight">
    <input type="hidden" name="goal_weight" id="hidden-goal-weight">
    <input type="hidden" name="height" id="hidden-height">
    <input type="hidden" name="bmi" id="hidden-bmi">
    <input type="hidden" name="plan" id="hidden-plan">
</form>
<script>
    // JavaScript functions
    function nextPage(nextCardId) {
        var currentCard = document.querySelector('.card.active');
        currentCard.classList.remove('active');

        var nextCard = document.getElementById(nextCardId);
        nextCard.classList.add('active');
    }

    function calculatePlan() {
        var gender = document.querySelector('input[name="gender"]:checked').value;
        var age = parseInt(document.getElementById("age").value);
        var weight = parseFloat(document.getElementById("weight").value);
        var goalWeight = parseFloat(document.getElementById("goal-weight").value);
        var height = parseFloat(document.getElementById("height").value);
        var bmi = weight / Math.pow((height / 100), 2);
        var plan = "";
        if (bmi < 18.5) {
            plan = "Underweight Diet Plan";
        } else if (bmi >= 18.5 && bmi < 25) {
            plan = "Healthy Weight Diet Plan";
        } else if (bmi >= 25 && bmi < 30) {
            plan = "Overweight Diet Plan";
        } else {
            plan = "Obesity Diet Plan";
        }

        var messageBox = document.getElementById("message-box");
        messageBox.innerHTML = "<strong>Your Recommended Diet Plan:</strong> " + plan;

        // Set hidden form values
        document.getElementById("hidden-gender").value = gender;
        document.getElementById("hidden-age").value = age;
        document.getElementById("hidden-weight").value = weight;
        document.getElementById("hidden-goal-weight").value = goalWeight;
        document.getElementById("hidden-height").value = height;
        document.getElementById("hidden-bmi").value = bmi;
        document.getElementById("hidden-plan").value = plan;
        // Submit hidden form
        document.getElementById("hidden-form").submit();
    }    
</script>

</body>
</html>
