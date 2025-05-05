<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id'])) {
  include "DB_connection.php";
  include "../app/Model/User.php";

  if (!isset($_GET['id'])) {
    header("Location: user.php");
    exit();
  }
  $id = $_GET['id'];
  $user = get_user_by_id($conn, $id);

  if ($user == 0) {
    header("Location: user.php");
    exit();
  }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit Users</title>
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
      <h4 class="title">Edit Users <a href="user.php">Users</a></h4>
      <form action="../app/update-user.php" method="POST" class="form-1">

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
          <input type="text" name="full_name" value="<?=$user['full_name']?>" class="input-1" placeholder="Full Name"><br>
        </div>
        <div class="input-holder">
          <label for="">Username</label>
          <input type="text" name="username" value="<?=$user['username']?>" class="input-1" placeholder="Username"><br>
        </div>
        <div class="input-holder">
          <label for="">Password</label>
          <input type="text" name="password" value="*******" class="input-1" placeholder="Password"><br>
        </div>

        <input type="text" name="id" value="<?=$user['id']?>" hidden>
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