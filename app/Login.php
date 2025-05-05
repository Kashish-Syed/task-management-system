<?php
session_start();
  if (isset($_POST['username']) && isset($_POST['password'])) {
    include "../src/DB_connection.php";
    function validate_input($data) {
      $data = trim($data);
      $data = stripcslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    $user_name = validate_input($_POST['username']);
    $password = validate_input($_POST['password']);

    if (empty($user_name)){
      $em = "User name is required";
      header("Location: ../src/login.php?error=$em");
      exit();
    } else if (empty($password)){
      $em = "Password is required";
      header("Location: ../src/login.php?error=$em");
      exit();
    } else {
      $sql = "SELECT * FROM users WHERE username = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $user_name);
      $stmt->execute();

      $result = $stmt->get_result();

      if($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $usernameDb = $user['username'];
        $passwordDb = $user['password'];
        $role = $user['role'];
        $id = $user['id'];

        if($user_name === $usernameDb) {
          if(password_verify($password, $passwordDb)) {
            if ($role === "admin") {
              $_SESSION['role'] = $role;
              $_SESSION['id'] = $id;
              $_SESSION['username'] = $usernameDb;
              header("Location: ../src/index.php");
            } else if ($role === "employee") {
              $_SESSION['role'] = $role;
              $_SESSION['id'] = $id;
              $_SESSION['username'] = $usernameDb;
              header("Location: ../src/index.php");
            } else {
              $em = "unknown error occured";
              header("Location: ../src/login.php?error=$em");
              exit();
            }
          } else {
            $em = "Incorrect username or password";
            header("Location: ../src/login.php?error=$em");
            exit();
          }
        } else {
          $em = "Incorrect username or password";
          header("Location: ../src/login.php?error=$em");
          exit();
        }
      }
    }

  } else {
    $em = "unknown error occured";
    header("Location: ../src/login.php?error=$em");
    exit();
  }
?>