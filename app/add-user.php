<?php
session_start();
  if (isset($_POST['username']) && isset($_POST['password']) &&  isset($_POST['full_name']) && $_SESSION['role'] == 'admin') {
    include "../src/DB_connection.php";
    function validate_input($data) {
      $data = trim($data);
      $data = stripcslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    $user_name = validate_input($_POST['username']);
    $password = password_hash(validate_input($_POST['password']), PASSWORD_DEFAULT);
    $full_name = validate_input($_POST['full_name']);

    if (empty($user_name)){
      $em = "User name is required";
      header("Location: ../src/add-user.php?error=$em");
      exit();
    } else if (empty($password)){
      $em = "Password is required";
      header("Location: ../src/add-user.php?error=$em");
      exit();
    } else if (empty($full_name)){
      $em = "Full name is required";
      header("Location: ../src/add-user.php?error=$em");
      exit();
    } else {
      $sql = "SELECT * FROM users WHERE username = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $user_name);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result && $result->num_rows > 0) {
        $em = "Username already taken.";
        header("Location: ../src/add-user.php?error=$em");
        exit();
      }
  
      // Insert new user
      include "Model/User.php";
      $data = array($full_name, $user_name, $password, "employee");
      insert_user($conn, $data);

      $em = "User Created Successfully!";
      header("Location: ../src/add-user.php?success=$em");
      exit();
    }

  } else {
    $em = "First Login";
    header("Location: ../src/add-user.php?error=$em");
    exit();
  }
?>