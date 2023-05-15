<?php
// Start the session
session_start();

// Connect to the database
$mysqli = new mysqli("localhost", "root", "", "adbmsfinal");

// Check for errors
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

// Get the form data
    $name = isset($_POST["name"]) ? $_POST["name"] : '';
    $username = isset($_POST["username"]) ? $_POST["username"] : '';
    $password = isset($_POST["password"]) ? $_POST["password"] : '';
    $email = isset($_POST["email"]) ? $_POST["email"] : '';
    $confirm_password = isset($_POST["confirm_password"]) ? $_POST["confirm_password"] : '';
    $role = isset($_POST["role"]) ? $_POST["role"] : '';


    // Validate the form data
    $errors = array();

    if (empty($name)) {
        $errors[] = "Name is required";
    }

    if (empty($username)) {
        $errors[] = "Username is required";
    }

    if (empty($email)) {
        $errors[] = "Email is required";
    }

    if (empty($password)) {
        $errors[] = "Password is required";
    }

    if (empty($confirm_password)) {
        $errors[] = "Confirm Password is required";
    }

    if ($password != $confirm_password) {
        $errors[] = "Passwords do not match";
    }

    // Check if the username or email is already taken
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE username=? OR email=?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        $errors[] = "Username or Email is already taken";
    }

    // If there are no errors, insert the user into the database
    if (count($errors) == 0) {

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert the user into the database
        $stmt = $mysqli->prepare("INSERT INTO users (name, username, email, password, role) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $username, $email, $hashed_password, $role);

        if ($stmt->execute()) {
            // Redirect to the login page
            header("Location: loginform.php");
            exit();
        } else {
            $errors[] = "Error inserting user into database";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="registerform.css">
</head>
<body>
    <h1>Register</h1>

    <?php if (!empty($errors)): ?>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name"><br>

        <label>Username:</label>
        <input type="text" name="username"><br>

        <label>Email:</label>
        <input type="email" name="email"><br>

        <label>Password:</label>
        <input type="password" name="password"><br>

        <label>Confirm Password:</label>
        <input type="password" name="confirm_password">


        <label>Role:</label>
        <select name="role">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select><br>

        <input type="submit" value="Register">
    </form>
</body>
</html>
