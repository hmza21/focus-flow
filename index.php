<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="css/common/base.css">
  <link rel="stylesheet" href="css/common/structure.css">
  <link rel="stylesheet" href="css/common/boarding.css">
  <link rel="stylesheet" href="css/responsive/boarding.css">
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fredoka&display=swap" rel="stylesheet">

  <title>Focus Flow</title>

  <link rel="shortcut icon" href="assets/icons/favicon.ico" type="image/x-icon">

</head>

<body>
  
  <img src="assets/images/bg_2.jpg" alt="Background" id="background">
  
  <?php require 'components/header.php'; ?>
  
  <main id="content">

    <section id="logo-container">
      <img src="assets/images/bg_1.jpg" alt="Background" class="windowed-background">
      <h1 class="logo"><a href="index.php">Focus Flow</a></h1>
    </section>

    <section id="main">
      
      <h2 class="header">Welcome to a new productivity experience!</h2>
      
      <p class="paragraph">Focus Flow is a simple application with one mission: to boost productivity of its users. Sign up to try it now!</p>
      
      <div class="button-container">
        <a href="register.php" class="large-btn primary-btn">Register</a>
        <a href="login.php" class="large-btn secondary-btn">Login</a>
      </div>
        
    </section>

  </main>
  
  <?php require 'components/footer.php'; ?>

</body>

</html>