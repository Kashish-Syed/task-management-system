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
    <title>Edit Profile</title>
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
        <h4 class="title">Edit Profile<a href="profile.php">Profile</a></h4>
        <form action="../app/update-profile.php" method="POST" class="form-1">

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
            <label for="">Full Name</label>
            <input type="text" name="full_name" value="<?= $user['full_name'] ?>" class="input-1" placeholder="Full Name"><br>
          </div>
          <div class="input-holder">
            <label for="password">Old Password</label>
            <input type="text" id="password" name="password" class="input-1" placeholder="Password"><br>
          </div>

          <div class="input-holder">
            <label for="">New Password</label>
            <input type="text" name="new_password" class="input-1" placeholder="New Password"><br>
          </div>
          <div class="input-holder">
            <label for="">Confirm Password</label>
            <input type="text" name="confirm_password" class="input-1" placeholder="Confirm Password"><br>
          </div>

          <input type="text" name="id" value="<?= $user['id'] ?>" hidden>
          <button class="edit-btn">Change</button>
        </form>
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