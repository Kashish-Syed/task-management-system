<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == 'employee') {
  include "DB_connection.php";
  include "../app/Model/User.php";
  $user = get_user_by_id($conn, $_SESSION['id']);
?>

  <!DOCTYPE html>
  <html>

  <head>
    <title>Profile</title>
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
        <h4 class="title">Profile<a href="edit-profile.php">Edit Profile</a></h4>
        <table class="main-table" style="max-width: 300px;">
          <tr>
            <td>Full Name</td>
            <td><?= $user['full_name'] ?></td>
          </tr>
          <tr>
            <td>User Name</td>
            <td><?= $user['username'] ?></td>
          </tr>
          <tr>
            <td>Joined At</td>
            <td><?= $user['created_at'] ?></td>
          </tr>
        </table>
      </section>
    </div>

    <script type="text/javascript">
      var active = document.querySelector("#navList li:nth-child(3)");
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