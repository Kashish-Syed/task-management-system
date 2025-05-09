<?php
session_start();
if (isset($_POST['title']) && isset($_POST['description']) &&  isset($_POST['assigned_to']) && isset($_POST['due_date']) && $_SESSION['role'] == 'admin') {
  include "../src/DB_connection.php";
  function validate_input($data)
  {
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $title = validate_input($_POST['title']);
  $description = validate_input($_POST['description']);
  $assigned_to = validate_input($_POST['assigned_to']);
  $due_date = validate_input($_POST['due_date']);

  if (empty($title)) {
    $em = "Title is required";
    header("Location: ../src/create_task.php?error=$em");
    exit();
  } else if (empty($description)) {
    $em = "Description is required";
    header("Location: ../src/create_task.php?error=$em");
    exit();
  } else if ($assigned_to == 0) {
    $em = "You must assign the task to someone";
    header("Location: ../src/create_task.php?error=$em");
    exit();
  } else {
    // Insert new task
    include "Model/Task.php";
    $data = array($title, $description, $assigned_to, $due_date);
    insert_task($conn, $data);

    $em = "Task Created Successfully!";
    header("Location: ../src/create_task.php?success=$em");
    exit();
  }
} else {
  $em = "First Login";
  header("Location: ../src/create_task.php?error=$em");
  exit();
}
