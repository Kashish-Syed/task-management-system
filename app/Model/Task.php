<?php

function insert_task($conn, $data)
{
  $sql = "INSERT INTO tasks (title, description, assigned_to, due_date) VALUES (?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);

  // Destructure values from $data (assuming all strings)
  $stmt->bind_param("ssss", $data[0], $data[1], $data[2], $data[3]);
  $stmt->execute();

  return $stmt->affected_rows > 0;
}

function get_all_tasks($conn)
{
  $sql = "SELECT * FROM tasks ORDER BY id DESC";
  $stmt = $conn->prepare($sql);
  $stmt->execute();

  $result = $stmt->get_result();

  if ($result && $result->num_rows > 0) {
    $tasks = $result->fetch_all(MYSQLI_ASSOC);
  } else {
    $tasks = 0;
  }
  return $tasks;
}

function get_all_tasks_due_today($conn)
{
    $sql = "SELECT * FROM tasks WHERE due_date = CURDATE() AND status != 'completed' ORDER BY id DESC";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $tasks = [];
        while ($row = $result->fetch_assoc()) {
            $tasks[] = $row;
        }
    } else {
        $tasks = 0;
    }

    return $tasks;
}

function count_tasks_due_today($conn)
{
  $sql = "SELECT id FROM tasks WHERE due_date = CURDATE() AND status != 'completed'";
  $result = $conn->query($sql);

  if ($result) {
      return $result->num_rows;
  } else {
      return 0;
  }
}

function get_all_tasks_overdue($conn)
{
    $sql = "SELECT * FROM tasks WHERE due_date < CURDATE() AND status != 'completed' ORDER BY id DESC";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $tasks = [];
        while ($row = $result->fetch_assoc()) {
            $tasks[] = $row;
        }
    } else {
        $tasks = 0;
    }

    return $tasks;
}

function count_tasks_overdue($conn)
{
    $sql = "SELECT id FROM tasks WHERE due_date < CURDATE() AND status != 'completed'";
    $result = $conn->query($sql);

    if ($result) {
        return $result->num_rows;
    } else {
        return 0;
    }
}

function count_tasks_NoDeadline($conn)
{
  $sql = "SELECT id FROM tasks WHERE status != 'completed' AND due_date IS NULL OR due_date = '0000-00-00'";
  $stmt = $conn->prepare($sql);
  $stmt->execute([]);

  return $stmt->rowCount();
}

function delete_task($conn, $data)
{
  $sql = "DELETE FROM tasks WHERE id=? ";
  $stmt = $conn->prepare($sql);
  $stmt->execute($data);
}

function get_task_by_id($conn, $id)
{
  $sql = "SELECT * FROM tasks WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();

  $result = $stmt->get_result();

  if ($result && $result->num_rows > 0) {
    $task = $result->fetch_assoc();
  } else {
    $task = 0;
  }

  return $task;
}

function count_tasks($conn)
{
  $sql = "SELECT id FROM tasks";
  $result = $conn->query($sql);

  if ($result) {
    return $result->num_rows;
  } else {
    // Optionally handle error
    return 0;
  }
}

function update_task($conn, $data)
{
  $sql = "UPDATE tasks SET title=?, description=?, assigned_to=?, due_date=? WHERE id=?";
  $stmt = $conn->prepare($sql);
  $stmt->execute($data);
}

function update_task_status($conn, $data)
{
  $sql = "UPDATE tasks SET status=? WHERE id=?";
  $stmt = $conn->prepare($sql);
  $stmt->execute($data);
}


function get_all_tasks_by_id($conn, $id)
{
  $sql = "SELECT * FROM tasks WHERE assigned_to=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();

  $result = $stmt->get_result();

  if ($result && $result->num_rows > 0) {
    $tasks = $result->fetch_all(MYSQLI_ASSOC);
  } else {
    $tasks = 0;
  }

  return $tasks;
}

function count_pending_tasks($conn)
{
    $sql = "SELECT id FROM tasks WHERE status = 'pending'";
    $result = $conn->query($sql);

    if ($result) {
        return $result->num_rows;
    } else {
        return 0;
    }
}

function count_in_progress_tasks($conn)
{
    $sql = "SELECT id FROM tasks WHERE status = 'in_progress'";
    $result = $conn->query($sql);

    if ($result) {
        return $result->num_rows;
    } else {
        return 0;
    }
}

function count_completed_tasks($conn)
{
    $sql = "SELECT id FROM tasks WHERE status = 'completed'";
    $result = $conn->query($sql);

    if ($result) {
        return $result->num_rows;
    } else {
        return 0;
    }
}

function count_my_tasks($conn, $id)
{
    $sql = "SELECT id FROM tasks WHERE assigned_to = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows;
    } else {
        return 0;
    }
}

function count_my_tasks_overdue($conn, $id)
{
    $sql = "SELECT id FROM tasks WHERE due_date < CURDATE() AND status != 'completed' AND assigned_to = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows;
    } else {
        return 0;
    }
}

function count_my_pending_tasks($conn, $id)
{
    $sql = "SELECT id FROM tasks WHERE status = 'pending' AND assigned_to = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows;
    } else {
        return 0;
    }
}

function count_my_in_progress_tasks($conn, $id)
{
    $sql = "SELECT id FROM tasks WHERE status = 'in_progress' AND assigned_to = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows;
    } else {
        return 0;
    }
}

function count_my_completed_tasks($conn, $id)
{
    $sql = "SELECT id FROM tasks WHERE status = 'completed' AND assigned_to = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows;
    } else {
        return 0;
    }
}
