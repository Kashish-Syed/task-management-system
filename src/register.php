<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Task Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="login-body">
  <form method="POST" action="../app/Register.php" class="shadow p-4">
    <h3 class="display-4">REGISTER</h3>
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
    <div class="mb-3">
      <label for="exampleInputName1" class="form-label">Full Name</label>
      <input type="text" class="form-control" name="full_name">
    </div>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">User name</label>
      <input type="text" class="form-control" name="username">
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Password</label>
      <input type="password" class="form-control" name="password">
    </div>
    <button type="submit" class="btn btn-primary" name="register">Create Account</button>
    
    <div class="mt-3 text-center">
      <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
  </form>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body> 
</html>