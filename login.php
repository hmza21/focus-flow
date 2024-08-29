<?php

require 'components/connect.php';
require 'components/functions.php';
session_start();

if (isset($_SESSION['email'])) header('Location: dashboard.php');

else if (isset($_POST['login'])) {

  $email = $_REQUEST['email'];
  $password = $_REQUEST['password'];

  $query = "SELECT * FROM account WHERE email = '$email'";
  $users = sql_select($pdo, $query);

  if ($users != null) $user = $users[0];
  else $user = null;

  if (!$user) echo "<script>alert('Email is not registered.')</script>";

  else if ($password === $user['password']) {
    
    $_SESSION['email'] = $user['email'];
    header('Location: dashboard.php');
    
  } else echo "<script>alert('Password is incorrect.')</script>";
  
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Organize your tasks and notes with ease in Focus Flow, completely for free!">

  <link rel="stylesheet" href="css/common/base.css">
  <link rel="stylesheet" href="css/common/structure.css">
  <link rel="stylesheet" href="css/common/boarding.css">
  
  <link href="https://fonts.googleapis.com/css2?family=Fredoka&display=swap" rel="stylesheet">

  <title>Focus Flow</title>

  <link rel="shortcut icon" href="assets/icons/favicon.ico" type="image/x-icon">

</head>

<body>
  
  <img src="assets/images/bg_2.jpg" alt="Background" id="background">
  
  <?php require 'components/header.php'; ?>
  
  <main id="content">
    
    <section>
      <img src="assets/images/bg_1.jpg" alt="Background" class="windowed-background">
      <h1 class="logo"><a href="index.php">Focus Flow</a></h1>
    </section>
    
    <section id="main">
      
      <h2 class="header">Sign in to your account.</h2>
      
      <form action="" method="post">
        
        <input type="email" name="email" id="email" placeholder="Email" required>
        <input type="password" name="password" id="pwd" placeholder="Password" required>
        <button type="submit" class="large-btn primary-btn" name="login">Login</button>
        
      </form>
      
      <div class="button-container">
        <a href="register.php" class="large-btn secondary-btn">Need an account?</a>
      </div>
      
    </section>
    
  </main>
  
  <?php require 'components/footer.php'; ?>

</body>

</html>