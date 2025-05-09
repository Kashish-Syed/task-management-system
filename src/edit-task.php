<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin") {
  include "DB_connection.php";
  include "../app/Model/Task.php";
  include "../app/Model/User.php";

  if (!isset($_GET['id'])) {
    header("Location: tasks.php");
    exit();
  }
  $id = $_GET['id'];
  $task = get_task_by_id($conn, $id);
  $users = get_all_users($conn);

  if ($task == 0) {
    header("Location: tasks.php");
    exit();
  }
?>

  <!DOCTYPE html>
  <html>

  <head>
    <title>Edit Task</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
  </head>

  <body>
    <input type="checkbox" id="checkbox">
    <?php include "../inc/header.php" ?>
    <div class="body">
      <?php include "../inc/nav.php" ?>
      <section class="section-1">
        <h4 class="title">Edit Tasks <a href="tasks.php">Tasks</a></h4>
        <form action="../app/update-task.php" method="POST" class="form-1">

          <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger" role="alert">
              <?php echo stripslashes($_GET['error']); ?>
            </div>
          <?php } ?>
          <?php if (isset($_GET['success'])) { ?>
            <div class="alert alert-success" role="alert">
              <?php echo stripslashes($_GET['success']); ?>
            </div>
          <?php } ?>

          <div class="input-holder">
            <label for="">Title</label>
            <input type="text" name="title" value="<?= $task['title'] ?>" class="input-1" placeholder="Title"><br>
          </div>
          <div class="input-holder">
            <label for="">Description</label>
            <textarea name="description" rows="4" class="input-1" placeholder="Description"><?= $task['description'] ?></textarea><br>
          </div>
          <div class="input-holder">
            <label for="">Due date</label>
            <input type="date" name="due_date" value="<?= date('Y-m-d', strtotime($task['due_date'])) ?>" class="input-1" placeholder="Due date"><br>
          </div>
          <div class="input-holder">
            <label for="">Assigned to</label>
            <select name="assigned_to" class="input-1">
              <option value="0">select employee</option>
              <?php if ($users != 0) {
                foreach ($users as $user) {
                  if ($task['assigned_to'] == $user['id']) { ?>
                    <option selected value="<?= $user['id'] ?>"><?= $user['full_name'] ?></option>
                  <?php } else { ?>
                    <option value="<?= $user['id'] ?>"><?= $user['full_name'] ?></option>
              <?php }
                }
              } ?>
            </select><br>
          </div>

          <input type="text" name="id" value="<?= $task['id'] ?>" hidden>
          <button class="edit-btn">Update</button>
        </form>
      </section>
    </div>

    <script type="text/javascript">
      var active = document.querySelector("#navList li:nth-child(4)");
      active.classList.add("active");
    </script>
  </body>

  </html>

<?php } else {
  $em = "First Login";
  header("Location: login.php?error=$em");
  exit();
}
?>