<footer id="default-footer">
  <p>All Rights Reserved © 2024</p>

  <?php

  require_once 'components/functions.php';
  require_once 'components/connect.php';

  if (isset($_SESSION['email'])) {
    
    $email = $_SESSION['email'];
    $query = "SELECT first_name, last_name FROM account WHERE email = '$email'";
    $account = sql_select($pdo, $query)[0];
    $first_name = $account['first_name'];
    $last_name = $account['last_name'];
    
  ?>

    <p>Logged in as: <?php echo $first_name." ".$last_name ?></p>
    
  <?php } else { ?>
      
    <p>Developed by: Hamza Khattab</p>
  
  <?php } ?>

</footer>