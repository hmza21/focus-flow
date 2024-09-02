<?php

require 'components/connect.php';
require 'components/functions.php';
session_start();

if (isset($_SESSION['email'])) header('Location: register.php');

else if (isset($_POST['register'])) {

  $first_name = $_REQUEST['first_name'];
  $last_name = $_REQUEST['last_name'];
  $email = $_REQUEST['email'];
  $password = $_REQUEST['password'];
  $confirm_password = $_REQUEST['confirm_password'];

  $query = "SELECT * FROM account WHERE email = '$email'";
  $users = sql_select($pdo, $query);

  if ($users != null) $user = $users[0];
  else $user = null;

  if (!$user) {
    
    if ($password === $confirm_password) {
      
      $query = "INSERT INTO account VALUES ('$email', '$password', '$first_name', '$last_name')";
      sql_operation($pdo, $query);

      $query = "INSERT INTO list (name, owner) VALUES ('Personal', '$email'), ('Work', '$email')";
      sql_operation($pdo, $query);
      
      $_SESSION['email'] = $email;
      header('Location: dashboard.php');
      
    } else echo "<script>alert('Passwords do not match!')</script>";

  } else echo "<script>alert('Email is already registered!')</script>";
  
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="css/common/base.css">
  <link rel="stylesheet" href="css/common/structure.css">
  <link rel="stylesheet" href="css/responsive/boarding.css">
  <link rel="stylesheet" href="css/common/boarding.css">
  
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
      
      <h2 class="header">Create an account.</h2>
      
      <form action="" method="post">

        <div class="field-container">
          <input type="text" name="first_name" id="fname" placeholder="First Name">
          <input type="text" name="last_name" id="lname" placeholder="Last Name">
        </div>

        <input type="email" name="email" id="email" placeholder="Email">

        <div class="field-container">
          <input type="password" name="password" id="pwd" placeholder="Password">
          <input type="password" name="confirm_password" id="conf-pwd" placeholder="Confirm password">
        </div>
        
        <button type="submit" class="large-btn primary-btn" name="register">Register</button>
        
      </form>
      
      <div class="button-container">
        <a href="login.php" class="large-btn secondary-btn">Already have an account?</a>
      </div>
        
    </section>

  </main>
  
  <?php require 'components/footer.php'; ?>

</body>

</html>