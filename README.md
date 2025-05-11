# Task Management System

This is a simple web-based task management system that supports two types of users: **Admins** and **Employees**. The application allows users to manage tasks, update personal details, and track task progress based on their role.

## Features

- **User Authentication**
  - Users can register and log in securely.
  
- **Navigation Bar**
  - Easy navigation to different pages in the app.

- **Role-Based Access**
  - **Admin**:
    - Can add and manage users.
    - Can create tasks for any employee.
    - Can view and edit all tasks.
  - **Employee**:
    - Can only view tasks assigned to them.
    - Can update the status of their tasks to:
      - `Pending`
      - `In Progress`
      - `Completed`
    - Can update their own name and password.

- **Task and User Management**
  - Edit task details.
  - Edit user profile information.

- **Database Integration**
  - All user and task data is stored in a database for easy access and updates.

## Default Login Credentials

- **Admin**
  - Username: `admin`
  - Password: `12345`

- **Employee**
  - Username: `jdoe`
  - Password: `abcde`

> Note: You can register new employees using the **Register** page. By default, all new users are created as employees.  
> To make a user an **admin**, you need to manually change their `role` to `admin` in the database.

## Technologies Used

- PHP (with MySQLi)
- MySQL (for database)
- HTML/CSS
- JavaScript

## How to Run

1. Make sure you have a local server like **MAMP**, **XAMPP**, or **WAMP** installed.
2. Import the provided SQL file into your MySQL server to create the database.
3. Place the project folder inside the server’s root directory (`htdocs` for MAMP/XAMPP).
4. Open the browser and go to `http://localhost/your_project_folder`.

## Future Improvements (Optional Ideas)

- Add email notifications for task updates.
- Use AJAX for smoother interactions.
- Add pagination and search for tasks.
- Improve UI/UX with a modern front-end framework.

## License

This project is for educational purposes.

