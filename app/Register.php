<?php
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['full_name'])) {
    include "../src/DB_connection.php";

    $username = trim($_POST['username']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
    $full_name = trim($_POST['full_name']);
    $role = 'employee';

    if (empty($username) || empty($full_name) || empty($password)) {
      $em = "All fields are required.";
      header("Location: ../src/register.php?error=$em");
      exit();
    }

    // Check if username already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
      $em = "Username already taken.";
      header("Location: ../src/register.php?error=$em");
      exit();
    }

    // Insert new user
    $sql = "INSERT INTO users (full_name, username, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$full_name, $username, $password]);

    header("Location: ../src/index.php?success=Account created successfully");
    exit();
} else {
    $em = "Invalid request.";
    header("Location: ../src/register.php?error=$em");
    exit();
}
?>
