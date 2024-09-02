<header id="default-header">

  <nav>
    <ul>

      <li><a href="index.php">Home</a></li>
      <li><a href="about.php">About</a></li>

      <?php if (!isset($_SESSION['email'])) { ?>
        
        <li><a href="register.php">Register</a></li>
        <li><a href="login.php">Login</a></li>
      
      <?php } else { ?>
        
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="operations/logout.php">Logout</a></li>
              
      <?php } ?>
    
    </ul>
  </nav>

</header>