<nav class="side-bar">
  <div class="user-p">
    <img src="../img/user_white.png">
    <h4>@<?=$_SESSION['username']?></h4>
  </div>
  <!-- Employee Navigation Bar -->
  <?php
    if ($_SESSION['role'] == "employee") {
  ?>
  <ul>
    <li>
      <a href="#">
        <i class="fa fa-tachometer" aria-hidden="true"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <li>
      <a href="#">
        <i class="fa fa-tasks" aria-hidden="true"></i>
        <span>My Tasks</span>
      </a>
    </li>
    <li>
      <a href="#">
        <i class="fa fa-user" aria-hidden="true"></i>
        <span>Profile</span>
      </a>
    </li>
    <li>
      <a href="#">
        <i class="fa fa-bell" aria-hidden="true"></i>
        <span>Notifications</span>
      </a>
    </li>
    <li>
      <a href="logout.php">
        <i class="fa fa-sign-out" aria-hidden="true"></i>
        <span>Logout</span>
      </a>
    </li>
  </ul>

  <?php } else { ?>
  <!-- Admin Navigation Bar -->
  <ul id="navList">
    <li>
      <a href="#">
        <i class="fa fa-tachometer" aria-hidden="true"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <li>
      <a href="user.php">
        <i class="fa fa-users" aria-hidden="true"></i>
        <span>Manage Users</span>
      </a>
    </li>
    <li>
      <a href="create_task.php">
        <i class="fa fa-plus" aria-hidden="true"></i>
        <span>Create Tasks</span>
      </a>
    </li>
    <li>
      <a href="tasks.php">
        <i class="fa fa-tasks" aria-hidden="true"></i>
        <span>All Tasks</span>
      </a>
    </li>
    <li>
      <a href="notifications.php">
        <i class="fa fa-bell" aria-hidden="true"></i>
        <span>Notifications</span>
      </a>
    </li>
    <li>
      <a href="logout.php">
        <i class="fa fa-sign-out" aria-hidden="true"></i>
        <span>Logout</span>
      </a>
    </li>
  </ul>

  <?php } ?>
</nav>