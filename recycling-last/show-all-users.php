<!DOCTYPE html>
<html>
<head>
	<title>User Roles</title>
	<link rel="stylesheet" href="show-all-account.css">
</head>
<body>
	<h1>List of User Roles</h1>

	<form method="POST">
		<label for="filter">Filter by:</label>
		<select name="filter" id="filter">
			<option value="all">All</option>
			<option value="admin">Admin</option>
			<option value="user">User</option>
		</select>
		<button type="submit">Filter</button>
	</form>

	<?php
	// Connect to the database
	$conn = mysqli_connect("localhost", "root", "", "adbmsfinal");
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}

	// Check if the filter form was submitted
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$filter = $_POST['filter'];

		if ($filter == 'admin') {
			// Query the database for all admin user roles
			$sql = "SELECT * FROM users WHERE role = 'admin'";
		} elseif ($filter == 'users') {
			// Query the database for all user user roles
			$sql = "SELECT * FROM users WHERE role = 'user'";
		} else {
			// Query the database for all user roles
			$sql = "SELECT * FROM users";
		}
	} else {
		// Query the database for all user roles
		$sql = "SELECT * FROM users";
	}

	$result = mysqli_query($conn, $sql);

	// Check if there are any user roles
	if (mysqli_num_rows($result) > 0) {
	    // Display the user roles in an HTML table
	    echo "<table>";
	    echo "<tr><th>ID</th><th>Name</th><th>Role</th></tr>";
	    while ($row = mysqli_fetch_assoc($result)) {
	        echo "<tr>";
	        echo "<td>{$row['id']}</td>";
	        echo "<td>{$row['name']}</td>";
	        echo "<td>{$row['role']}</td>";
	        echo "</tr>";
	    }
	    echo "</table>";
	} else {
	    // Display a message if there are no user roles
	    echo "No user roles found.";
	}

	// Close the database connection
	mysqli_close($conn);
	?>
</body>
</html>
