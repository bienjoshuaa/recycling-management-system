<?php
// Start session
session_start();

require_once("db_conn.php");

// Check if user has submitted the login form
if (isset($_POST['submit'])) {
    // Get username and password from form
    $username = $_POST['username'];
    $password = $_POST['password'];


    $sql = "SELECT * FROM users where username = '$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $db_password = $row["password"];
            if(password_verify($password, $db_password)){
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $row['role'];

                // Redirect user to appropriate page based on role
                if ($row['role'] == 'admin') {
                    header('Location: admin_dashboard.php');
                    exit(); // Stop script execution after redirect
                } else if ($row['role'] == 'user') {
                    header('Location: user_dashboard.php');
                    exit(); // Stop script execution after redirect
                } else {
                    echo "Invalid user role.";
                }
            }
        }
    } else {
    echo "Incorrect Username Or Password";
    }

mysqli_close($conn);


    // // Prepare and execute query to check if username and password are correct
    // $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    // $stmt->bind_param("s", $username);
    // $stmt->execute();
    // $result = $stmt->get_result();
    
    // while($row = $result->fetch_assoc()){
    //     $db_password = $row["password"];

    //     if(password_verify($password, $db_password)){
    //         // Check if username and password are correct
    //         if ($result->num_rows == 1) {
    //             // If username and password are correct, set session variables
    //             $row = $result->fetch_assoc();
    //             $_SESSION['username'] = $username;
    //             $_SESSION['role'] = $row['role'];
    
    //             // Redirect user to appropriate page based on role
    //             if ($row['role'] == 'admin') {
    //                 header('Location: admin_dashboard.php');
    //                 exit(); // Stop script execution after redirect
    //             } else if ($row['role'] == 'user') {
    //                 header('Location: user_dashboard.php');
    //                 exit(); // Stop script execution after redirect
    //             } else {
    //                 echo "Invalid user role.";
    //             }
    //         } 
    
    //     }else { 
    //         // If username and password are incorrect, display error message
    //         echo "Invalid username or password.";
    //     }
    // }
  
    // // Close database connection
    // $stmt->close();
    // $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <h2>Login</h2>
    <form method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" name="submit" value="Login">
    </form>
    <div class="create-account">
        <p>Don't have an account yet?</p>
        <form action="registerform.php">
            <button type="submit">Create Account</button>
        </form>
    </div>
</body>
</html>





