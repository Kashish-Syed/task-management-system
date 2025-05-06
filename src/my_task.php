<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id'])) {
  include "DB_connection.php";
  include "../app/Model/Task.php";
  include "../app/Model/User.php";

  $tasks = get_all_tasks_by_id($conn, $_SESSION['id']);
?>

  <!DOCTYPE html>
  <html>

  <head>
    <title>My Tasks</title>
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
        <h4 class="title">My Tasks</h4>
        <?php if (isset($_GET['success'])) { ?>
          <div class="alert alert-success" role="alert">
            <?php echo stripslashes($_GET['success']); ?>
          </div>
        <?php } ?>
        <?php if ($tasks != 0) { ?>
          <table class="main-table">
            <tr>
              <th>#</th>
              <th>Title</th>
              <th>Description</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            <?php $i = 0;
            foreach ($tasks as $task) { ?>
              <tr>
                <td><?= ++$i ?></td>
                <td><?= $task['title'] ?></td>
                <td><?= $task['description'] ?></td>
                <td><?= $task['status'] ?></td>
                <td>
                  <a href="edit-task-employee.php?id=<?= $task['id'] ?>" class="edit-btn">Edit</a>
                </td>
              </tr>
            <?php } ?>
          </table>
        <?php } else { ?>
          <h3>Empty</h3>
        <?php } ?>
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