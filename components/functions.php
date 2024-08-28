<?php

function sql_select(PDO &$pdo, String $query) {
  $statement = $pdo->prepare($query);
  $statement->execute();
  return $statement->fetchAll();
}

function sql_operation(PDO &$pdo, String $query) {
  $pdo->exec($query);
}

function all_task_count(PDO &$pdo) {
  $query = "SELECT COUNT(*) FROM task
  LEFT JOIN list ON task.list_id = list.id
  WHERE list.owner = '".$_SESSION['email']."'";
  return (sql_select($pdo, $query))[0][0];
}

function today_task_count(PDO &$pdo) {
  $query = "SELECT COUNT(*) FROM task
  LEFT JOIN list ON task.list_id = list.id
  WHERE due_date = CURDATE() AND list.owner = '".$_SESSION['email']."'";
  return (sql_select($pdo, $query))[0][0];
}

function list_task_count(PDO &$pdo, String $list_name) {
  $query = "SELECT COUNT(*) FROM task
  LEFT JOIN list ON task.list_id = list.id
  WHERE list.name = '$list_name' AND owner = '".$_SESSION['email']."'";
  return (sql_select($pdo, $query))[0][0];
}

function list_button(PDO &$pdo, String $redirect, String $list_name, String $btn_text, $is_notes) {

  if ($is_notes == true) $list_name = "Sticky Notes";
  $class = ($list_name === $btn_text) ? 'selected-btn' : '';

  if ($btn_text === "All Tasks") $count = all_task_count($pdo);
  else if ($btn_text === "Today") $count = today_task_count($pdo);
  else $count = list_task_count($pdo, $btn_text);

  if ($btn_text === "All Tasks") {

    if ($list_name === "") $class = "selected-btn";
    $icon_path = "assets/icons/right-cheveron.png";
  
  } else if ($btn_text === "Today") $icon_path = "assets/icons/list.png";
  else if ($btn_text === "Sticky Notes") $icon_path = "assets/icons/note.png";
  else if ($btn_text === "Personal") $icon_path = "assets/icons/person.png";
  else if ($btn_text === "Work") $icon_path = "assets/icons/briefcase.png";
  else $icon_path = "assets/icons/folder.png"; ?>

  <button onclick="redirect('<?php echo $redirect ?>')" class="<?php echo $class ?>">
        
    <div>
      <img src="<?php echo $icon_path ?>" class="btn-icon">
      <span class="btn-text"><?php echo $btn_text ?></span>
    </div>
  
    <?php if ($btn_text !== "Sticky Notes") { ?>
      <div>
        <span class="counter"><?php echo $count ?></span>
      </div>
    <?php } ?>
  
  </button>

<?php }

function tag_button(String $tag_name) { ?>

  <button class="tag"><?php echo $tag_name ?></button>

<?php }

function task(PDO &$pdo, array $task) {
  
  $due_date = ($task['due_date'] === NULL) ? "" : $task['due_date'];

  $query = "SELECT COUNT(*) FROM subtask WHERE task_id = ".$task['0'];
  $subtask_count = (sql_select($pdo, $query))[0][0];

  $query = "SELECT name FROM list WHERE id = ".$task['5'];
  $list = sql_select($pdo, $query)[0];

  $query = "SELECT name FROM tag
  LEFT JOIN task_tag ON tag.id = task_tag.tag_id
  WHERE task_tag.task_id = ".$task['id'];
  $tags = sql_select($pdo, $query);
  
  ?>

    <div class="task-item">

    <div class="task-head">
      <form action="#" method="post" class="check-grp">
        <input type="checkbox" name="task checkbox" <?php echo $task[4] == 1 ? 'checked' : '' ?> onChange="this.form.submit()">
        <input type="hidden" name="task_id_check" value="<?php echo $task[0] ?>">
      </form>
      <label for="task <?php echo $task[0] ?>"><?php echo $task[1] ?></label>
      <form action="#" method="post">
        <input type='hidden' name='task_id' value='<?php echo $task[0] ?>'></input>
        <button type="submit" name="task_details">></button>
      </form>
    </div>
      
    <div class="task-data">
      
      <?php if ($due_date !== "") { ?>
        <p><?php echo $task['3'] ?></p>
      <?php } ?>
      
      <?php if ($subtask_count !== 0) { ?>
        <p><?php echo $subtask_count ?> Subtasks</p>
      <?php } ?>
      
      <p><?php echo $list['name'] ?></p>
      
      <?php if ($tags !== []) { ?>
        <p>
          <?php
            $i = 0;
            foreach ($tags as $tag) {
              if ($i != 0) echo ', ';
              $i++; 
              echo $tag['name'];
            }
          ?>
        </p>
      <?php } ?>

    </div>

  </div>

<?php }

function rightPanel(PDO $pdo, array $task) {

  $task_name = $task['1'];
  $task_description = $task['2'];
  $due_date = $task['3'];
  $list_id = $task['5'];

  $query = "SELECT * FROM list WHERE owner = '".$_SESSION['email']."'";
  $lists = sql_select($pdo, $query);

  $query = "SELECT * FROM tag WHERE owner = '".$_SESSION['email']."'";
  $tags = sql_select($pdo, $query);

  $query = "SELECT * FROM subtask WHERE task_id = ".$task['0'];
  $subtasks = sql_select($pdo, $query);

  ?>

  <div class="panel-section">
    <form action="#" method="post" id="task-data-form">

      <input type="hidden" name="delete_task_id" value="<?php echo $task[0] ?>">
    
      <div class="top">
        <button type="button" onclick="hidePanel()"><img class="left-btn" src="assets/icons/cross.png"></button>
        <input type="text" name="taskname" placeholder="Task Name" class="text-field" value="<?php echo $task_name ?>">
      </div>

      <textarea name="task description" placeholder="Description" class="text-field large-field"><?php echo $task_description ?></textarea>

      <div class="labelled-input">
        <label for="due date">Due Date</label>
        <input type="date" class="small-input" name="due date" id="due date" value="<?php echo $due_date ?>">
      </div>
      
      <div class="labelled-input">
        <label for="dropdown">List</label>
        <select class="small-input" id="dropdown" name="dropdown">
            <?php foreach($lists as $list) {
              $selected = ($list['id'] === $list_id) ? 'selected' : '';
              echo "<option value='".$list['id']."' ".$selected.">".$list['name']."</option>";
            } ?>
        </select>
      </div>
      
      <div class="labelled-input tag-container">
        <label>Tags</label>
        <?php foreach($tags as $tag) tag_button($tag['name']); ?>
        <button class="add-tag">+</button>
      </div>
    
      <div action="#" method="post" class="solid-button-group">
        <button type="submit" name="save" class="solid-button">Save</button>
        <button type="submit" name="delete" class="solid-button danger-button">Delete</button>
      </div>
    
    </form>
  </div>

  <div class="panel-section">

    <h5>SUBTASKS</h5>
    
    <form action="#" method="post">
      <input type="text" name="add_subtask" placeholder="+ Add subtask" class="text-field">
      <input type="hidden" name="task_id" value="<?php echo $task[0] ?>">
    </form>

    <?php foreach ($subtasks as $subtask) { ?>

      <div class="check-grp">
        <form action="#" method="post">
          <input type="checkbox" name="subtask checkbox" <?php echo $subtask[2] == 1 ? 'checked' : '' ?> onChange="this.form.submit()"">
          <input type="hidden" name="subtask_id_check" value="<?php echo $subtask[0] ?>">
        </form>
        <label for="Subtask <?php   echo $subtask[0] ?>"><?php echo $subtask[1] ?></label>
      </div>
    
    <?php } ?>

  </div>

<?php }

function note(array $note) {
  
  $title = $note['title'];
  $content = $note['content'];
  
  ?>

  <form class="note" action="#" method="post">
    <h3 class="note-title"><?php echo $title ?></h3>
    <p class="note-content"><?php echo $content ?></p>
    <input type="hidden" value="<?php echo $note['id'] ?>" name="note-id">
    <button type="submit" class="delete-note" name="delete-note">❌</button>
  </form>

<?php }

function note_form() { ?>

  <form id="note-form" action="#" method="post">
    <input type="text" name="note-title" placeholder="Title" class="small-input">
    <textarea name="note-content" placeholder="Content" class="small-input"></textarea>
    <button type="submit" class="add-note" name="add-note">✔️</button>
  </form>

<?php }

function note_create() { ?>

  <div id="create-note">
    <button type="button" onclick="showForm()">➕</button>
  </div>

<?php }