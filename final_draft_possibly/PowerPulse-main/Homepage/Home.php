<?php
session_start(); // Start the session at the beginning
?>
<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PWRpulse</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<!--nav banner-->
<body>
  <nav>
    <div class="navBackground"></div>
    <a><div class="logo">PWRpulse</div>  
    <div class="nav-items">
      <?php
      if(isset($_SESSION['logged_in'])) {
      ?>
       <a href="Diets.html">Diets</a>
        <a href="Exercise.html" >Exercises</a>
        <a href="http://localhost/logout_PWRplus.php">Log out</a>
        <a href="http://localhost/PowerPulse-main/Homepage/Profile.php" >Profile</a>
       <?php
      }else{      
       ?>
        <a href="Diets.html">Diets</a>
        <a href="Exercise.html">Exercises</a>
            <a href="sign_in.html">Sign In</a>
            <a href="sign_up.html">Sign up</a>
            <?php
      }
            ?>
    </div>
</nav>
  <!--quiz secotion-->
  <section class="hero">
    <div class="hero-container">
      <div class="column-left">
        <br><br><br><br><br><br><br><br><br>
        <h1>Go beyond!</h1>
        <p>
          Unlock your path to wellness with our comprehensive healthcare platform.  <br> Personalized tools, expert guidance, and a supportive community await <br> as you embark on your journey to a healthier you.
        </p>
        <a href="http://localhost/PowerPulse-main/Homepage/Quiz.php" target="_self"><button>Get Started by Taking the Quiz</button> </a>
        
      </div>
      <div class="column-right">
        <div class="logo"> <br> "Don't count the days make the days count"</div>
    </div>
  </section>
  
  <section class="about">
    <div class="about-container">
      <h2>About Us</h2>
      <p>
        At PWRpulse, we believe in empowering individuals to take control of their health and wellness journey. Our team of experts curates personalized diet and exercise plans tailored to your specific needs and goals. Whether you're looking to lose weight, build muscle, or simply improve your overall well-being, we're here to support you every step of the way.
      </p>
    </div>
  </section>

  <section class="services">
    <h2 style="font-size: 75px; padding: 30px; font-family: Arial, Helvetica, sans-serif;">Our Services</h2>
    <br><br>
    
    <div class="services-container">
      
      <div class="service">
        <img src="images/diet-food-icon.svg" alt="diet-icon" class="service-icon">
        <div>
          <h3>Diet Plans</h3>
          <p>Discover nutritious and delicious meal plans designed to fuel your body and promote optimal health.</p>
        </div>
      </div>
      <div class="service">
        <img src="images/run.svg" alt="exercise-icon" class="service-icon">
        <div>
          <h3>Exercise Routines</h3>
          <p>Explore a variety of workout routines suitable for all fitness levels, from beginners to advanced athletes.</p>
        </div>
      </div>
    </div>
    
  </section>
  <hr style="border-top: 4px solid black; width: 100%; ">


  <section class="Customer_feedback">
    <h2 style="font-size: 75px; padding: 30px; font-family: Arial, Helvetica, sans-serif;">Customer feedbacks</h2>
    <div class="Customer_feedback-container">
    
      <div class="Customer_feedback-card">
        <img src="images/user-128.svg" alt="Customer_feedback-1" class="Customer_feedback-image">
        <p>"PWRpulse has completely transformed my approach to health and fitness. I've never felt better both physically and mentally!"</p>
        <p class="Customer_feedback-author">- Sarah</p>
      </div>
      <br>
      <div class="Customer_feedback-card">
        <img src="images/user-128.svg" alt="Customer_feedback-2" class="Customer_feedback-image">
        <p>"The personalized diet plan provided by PWRpulse has helped me achieve my weight loss goals without feeling deprived. Highly recommend!"</p>
        <p class="Customer_feedback-author">- John</p>
      </div>
    </div>
  </section>

  <footer>
    <div class="footer-container">
      <div class="footer-logo">PWRpulse</div>
      <div class="footer-links">
        <a href="/">About</a> <a href="/">Services</a> <a href="/">Contact</a>
      </div>
    </div>
  </footer>
</body>
</html>
