<?php

require 'components/connect.php';
require 'components/functions.php';
session_start();

$is_notes = true;

if (!isset($_SESSION['email'])) header('Location: login.php');
else $email = $_SESSION['email'];

$query = "SELECT * FROM list WHERE owner = '$email'";
$lists = sql_select($pdo, $query);

$query = "SELECT * FROM tag WHERE owner = '$email'";
$tags = sql_select($pdo, $query);

if (isset($_SESSION['task_details'])) {
  unset($_SESSION['task_id']);
  unset($_SESSION['task_details']);
}
  
$list = ['name' => 'Sticky Notes'];

$query = "SELECT * FROM task
LEFT JOIN list ON task.list_id = list.id
WHERE list.owner = '$email'";
$tasks = sql_select($pdo, $query);

if (isset($_POST['add-note'])) {

  $title = $_POST['note-title'];
  $content = $_POST['note-content'];

  if ($title != '') {

    $query = "INSERT INTO note (owner, title, content) VALUES ('$email', '$title', '$content')";
    sql_operation($pdo, $query);

  }

}

if (isset($_POST['delete-note'])) {

  $note_id = $_POST['note-id'];
  $query = "DELETE FROM note WHERE id = $note_id";
  sql_operation($pdo, $query);

}

$query = "SELECT * FROM note WHERE owner = '$email'";
$notes = sql_select($pdo, $query);
  
?>

<!DOCTYPE html>
<html lang="en">
  
<head>
  
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="css/common/base.css">
  <link rel="stylesheet" href="css/common/structure.css">
  <link rel="stylesheet" href="css/common/dashboard.css">
  <link rel="stylesheet" href="css/notes.css">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap" rel="stylesheet">
  
  <script src="js/common/dashboard.js"></script>
  
  <title>Tasks - Focus Flow</title>
  
</head>

<body>
    
  <img src="assets/images/bg_3.jpg" alt="Background" id="background">
  
  <?php require 'components/header.php'; ?>

  <main id="content">

    <section class="sidebar" id="left">

      <div class="top">
        <h3 class="section-header">Focus Flow</h3>
        <i class="bi bi-chevron-double-right"></i>
      </div>

      <div>
        <form action="#" method="get">
          <input type="search" name="search" id="search" placeholder="🔍 Search" class="text-field">
        </form>
      </div>
        
      <div class="section-list">
        
        <h5>TASKS</h5>
        
        <?php
          list_button($pdo, 'dashboard.php', $list['name'], 'All Tasks', $is_notes);
          list_button($pdo, 'dashboard.php?list=Today', $list['name'], 'Today', $is_notes);
          list_button($pdo, 'notes.php', $list['name'], 'Sticky Notes', $is_notes);
        ?>

      </div>

      <br>

      <div class="section-list">

        <h5>LISTS</h5>

        <?php

          foreach($lists as $a_list) {
            list_button($pdo, 'dashboard.php?list='.$a_list['name'], $list['name'], $a_list['name'], $is_notes);
          }

        ?>

      </div>

      <br>

      <div class="tag-list">

        <h5>TAGS</h5>

        <div class="tag-container">
          <?php foreach($tags as $a_tag) tag_button($a_tag['name']); ?>
          <button class="add-tag">+</button>
        </div>

      </div>
    
    </section>

    <section class="sidebar" id="right">
      
      <div class="top">
        <h2 class="section-header">Sticky Notes</h2>
      </div>

      <div class="note-list">

        <?php
        
        foreach($notes as $note) note($note);
        note_form();
        note_create();
        
        ?>

      </div>
      
    </section>

  </main>

  <?php require 'components/footer.php'; ?>

  <script src="js/notes.js"></script>

</body>

</html>