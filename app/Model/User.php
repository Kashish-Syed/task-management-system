<?php

function get_all_users($conn) {
  $sql = "SELECT * FROM users WHERE role = ?";
  $stmt = $conn->prepare($sql);
  $role = "employee";
  $stmt->bind_param("s", $role);
  $stmt->execute();

  $result = $stmt->get_result();

  if ($result && $result->num_rows > 0) {
    // returns all rows as associative arrays
    $users = $result->fetch_all(MYSQLI_ASSOC);
  } else {
    $users = [];
  }

  return $users;
}

function insert_user($conn, $data) {
  $sql = "INSERT INTO users (full_name, username, password, role) VALUES (?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);

  $stmt->bind_param("ssss", $data[0], $data[1], $data[2], $data[3]);  $stmt->execute();

  return $stmt->affected_rows > 0;
}

function get_user_by_id($conn, $id) {
  $sql = "SELECT * FROM users WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();

  $result = $stmt->get_result();

  if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
  } else {
    $user = 0;
  }

  return $user;
}

function update_user($conn, $data) {
  $sql = "UPDATE users SET full_name=?, username=?, password=?, role=? WHERE id=? AND role=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssssis", $data[0], $data[1], $data[2], $data[3], $data[4], $data[5]);
  $stmt->execute();

  return $stmt->affected_rows > 0;
}

function delete_user($conn, $data) {
  $sql = "DELETE FROM users WHERE id=? AND role=?";
  $stmt = $conn->prepare($sql);
print_r($data);
  $stmt->bind_param("is", $data[0], $data[1]);
  $stmt->execute();

  return $stmt->affected_rows > 0;
}

