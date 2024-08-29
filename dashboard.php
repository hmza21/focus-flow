<?php

require 'components/connect.php';
require 'components/functions.php';
session_start();

$is_notes = false;

if (!isset($_SESSION['email'])) header('Location: login.php');
else $email = $_SESSION['email'];

$query = "SELECT * FROM list WHERE owner = '$email'";
$lists = sql_select($pdo, $query);

$query = "SELECT * FROM tag WHERE owner = '$email'";
$tags = sql_select($pdo, $query);

if (isset($_POST['task_id_check'])) {
  
  $task_id = $_POST['task_id_check'];
  
  $query = "UPDATE task SET is_completed = 1 - is_completed
  WHERE id = $task_id";
  sql_operation($pdo, $query);

}

if (isset($_POST['subtask_id_check'])) {
    
  $subtask_id = $_POST['subtask_id_check'];
    
  $query = "UPDATE subtask SET is_completed = 1 - is_completed
  WHERE id = $subtask_id";
  sql_operation($pdo, $query);

}

if (isset($_POST['add_subtask'])) {
  $name = $_POST['add_subtask'];
  if ($name != '') {
    $task_id = $_POST['task_id'];
    $query = "INSERT INTO subtask (name, task_id) VALUES ('$name', '$task_id')";
    sql_operation($pdo, $query);
  }
}

if (isset($_POST['task_details'])) {
  $_SESSION['task_id'] = $_POST['task_id'];
  $_SESSION['task_details'] = $_POST['task_details'];
}

if (isset($_POST['save'])) {
  
  $task_id = $_POST['delete_task_id'];
  $name = $_POST['taskname'];
  $description = $_POST['task_description'];
  $due_date = $_POST['due_date'];
  $list_id = $_POST['dropdown'];

  if ($due_date == '') {
    $query = "UPDATE task SET name = '$name', description = '$description', list_id = $list_id WHERE id = $task_id";
  } else {
    $query = "UPDATE task SET name = '$name', description = '$description', due_date = '$due_date', list_id = $list_id WHERE id = $task_id";
  }

  sql_operation($pdo, $query);

}

if (isset($_POST['delete'])) {
  $query = "DELETE FROM task WHERE id = ".$_POST['delete_task_id'];
  sql_operation($pdo, $query);
  unset($_SESSION['task_details']);
  unset($_SESSION['task_id']);
}

if (isset($_GET['list'])) {
  
  $queried_list = $_GET['list'];
  
  if ($queried_list === "Today") {
    
    $list = ['name' => 'Today'];
    
  } else {
    
    $query = "SELECT * FROM list
    WHERE owner = '$email' AND name = '".$queried_list."'";
    $list = sql_select($pdo, $query)[0];
    
  }
  
  if (!$list) header('Location: dashboard.php');
  else if ($list['name'] === "Today") {
    
    $query = "SELECT * FROM task
    LEFT JOIN list ON task.list_id = list.id
    WHERE due_date = CURDATE() AND list.owner = '$email'";
    $tasks = sql_select($pdo, $query);
    
  } else {
    
    $query = "SELECT task.* FROM task
    LEFT JOIN list ON task.list_id = list.id
    WHERE list.id = '".$list['id']."'";
    $tasks = sql_select($pdo, $query);
    
  }
  
} else {
  
  $list = ['name' => ''];
  
  $query = "SELECT * FROM task
  LEFT JOIN list ON task.list_id = list.id
  WHERE list.owner = '$email'";
  $tasks = sql_select($pdo, $query);
  
}

if (isset($_POST['add_task'])) {

  $name = $_POST['add_task'];
  if ($name != '') {
    
    if ($list['name'] == 'Today' || $list['name'] == '') {
      $insert_query = "SELECT id FROM list WHERE owner = '$email' AND name = 'Personal'";
      $new_task_list = sql_select($pdo, $insert_query)[0][0];
    } else {
      $new_task_list = $list['id'];
    }
    
    if ($list['name'] == 'Today') $insert_query = "INSERT INTO task (name, list_id, due_date) VALUES ('$name', $new_task_list, CURDATE())";
    else $insert_query = "INSERT INTO task (name, list_id) VALUES ('$name', $new_task_list)";
    sql_operation($pdo, $insert_query);

    $tasks = sql_select($pdo, $query);
    
  }

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
    <link rel="stylesheet" href="css/common/dashboard.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap" rel="stylesheet">
    
    <script src="js/common/dashboard.js"></script>
    
    <title><?php echo ($list['name'] == '' ? 'Dashboard' : $list['name']) ?> - Focus Flow</title>

    <link rel="shortcut icon" href="assets/icons/favicon.ico" type="image/x-icon">
    
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

    <section id="middle">
      
      <div class="top">
        <h2 class="section-header">
          <?php
            if ($list['name'] === "") echo "All Tasks";
            else echo $list['name'];
          ?>
        </h2>
        <p class="counter">
          <?php
            if ($list['name'] === "") $count = all_task_count($pdo);
            else if ($list['name'] === "Today") $count = today_task_count($pdo);
            else $count = list_task_count($pdo, $list["name"]);
            echo $count;
          ?>
        </p>
      </div>

      <form action="#" method="post">
        <input type="text" name="add task" placeholder="+ Add task" class="text-field">
      </form>

      <div id="task-grp">
        
        <?php foreach ($tasks as $task) task($pdo, $task); ?>
      
      </div>

    </section>

    <section class="sidebar" id="right">
      
      <div class="panel-background">
        <img src="assets/icons/search.png" alt="Panel Background">
      </div>

      <?php if (isset($_SESSION['task_details'])) {
        $index = 0;
        foreach ($tasks as $task) {
          if ($task[0] == $_SESSION['task_id']) break;
          $index++;
        }
        if (isset($tasks[$index])){
          echo "<script>showPanel()</script>";
          rightPanel($pdo, $tasks[$index]);
        } else {
          unset($_SESSION['task_details']);
          unset($_SESSION['task_id']);
        }
      } ?>
      
    </section>

  </main>

  <?php require 'components/footer.php'; ?>


</body>

</html>