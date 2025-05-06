<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == 'employee') {
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
        <h4 class="title">Edit Tasks <a href="my_task.php">Tasks</a></h4>
        <form action="../app/update-task-employee.php" method="POST" class="form-1">

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
            <p><b>Title: </b><?= $task['title'] ?></p>
          </div>
          <div class="input-holder">
            <p><b>Description: </b><?= $task['description'] ?></p>
          </div>
          <div class="input-holder">
            <lable>Status</lable>
            <select name="status" class="input-1">
              <option <?php if ($task['status'] == "pending") echo "selected"; ?>>pending</option>
              <option <?php if ($task['status'] == "in_progress") echo "selected"; ?>>in_progress</option>
              <option <?php if ($task['status'] == "completed") echo "selected"; ?>>completed</option>
            </select><br>
          </div>
          <input type="text" name="id" value="<?= $task['id'] ?>" hidden>
          <button class="edit-btn">Update</button>
        </form>
      </section>
    </div>

    <script type="text/javascript">
      var active = document.querySelector("#navList li:nth-child(2)");
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