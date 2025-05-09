<?php
session_start();

if (isset($_SESSION['role']) && isset($_SESSION['id'])) {
  if (
    isset($_POST['confirm_password']) &&
    isset($_POST['new_password']) &&
    isset($_POST['password']) &&
    isset($_POST['full_name']) &&
    $_SESSION['role'] == 'employee'
  ) {
    include "../src/DB_connection.php";

    function validate_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    $password = validate_input($_POST['password']);
    $full_name = validate_input($_POST['full_name']);
    $new_password = validate_input($_POST['new_password']);
    $confirm_password = validate_input($_POST['confirm_password']);
    $id = validate_input($_POST['id']);

    if (empty($password) || empty($new_password) || empty($confirm_password)) {
      $em = "Password is required";
      header("Location: ../src/edit-profile.php?error=$em");
      exit();
    } else if (empty($full_name)) {
      $em = "Full name is required";
      header("Location: ../src/edit-profile.php?error=$em");
      exit();
    } else if ($confirm_password != $new_password) {
      $em = "New and Confirm passwords do not match";
      header("Location: ../src/edit-profile.php?error=$em");
      exit();
    } else {
      include "Model/User.php";

      $user = get_user_by_id($conn, $id);
      if ($user) {
        if (password_verify($password, $user['password'])) {
          $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
          $data = array($full_name, $new_password_hashed, $id);
          update_profile($conn, $data);

          $em = "Profile updated successfully!";
          header("Location: ../src/edit-profile.php?success=$em");
          exit();
        } else {
          $em = "Incorrect current password";
          header("Location: ../src/edit-profile.php?error=$em");
          exit();
        }
      } else {
        $em = "User not found";
        header("Location: ../src/edit-profile.php?error=$em");
        exit();
      }
    }

  } else {
    $em = "Invalid request";
    header("Location: ../edit-profile.php?error=$em");
    exit();
  }

} else {
  $em = "First login required";
  header("Location: ../src/login.php?error=$em");
  exit();
}
?>