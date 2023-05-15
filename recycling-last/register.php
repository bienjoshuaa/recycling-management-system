<?php
// Define the database connection variables
$host = "localhost";
$user = "root";
$password = "";
$database = "adbmsfinal";

// Create a new MySQLi object and connect to the database
$conn = new mysqli($host, $user, $password, $database);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the registration data from the HTTP POST request
$name = $_POST["name"];
$email = $_POST["email"];
$username = $_POST["username"];
$password = $_POST["password"];
$role = $_POST["role"];

// Prepare a SQL statement to insert the data into the database
$stmt = $conn->prepare("INSERT INTO users (name, email, username, password, role) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $name, $email, $username, $password, $role);

// Execute the SQL statement
if ($stmt->execute()) {
  // Display a success message using the popup window
echo "<script>alert('Registration successful!'); window.location.href='loginform.php';</script>";

} else {
    // Display an error message if the SQL statement failed
    echo "Error: " . $stmt->error;
}

// Close the prepared statement and the database connection
$stmt->close();
$conn->close();
?>
