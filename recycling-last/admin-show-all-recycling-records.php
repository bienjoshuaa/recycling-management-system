<!DOCTYPE html>
<html>
<head>
    <title>Recycled Items</title>
    <link rel="stylesheet" href="recycled-items-table.css">
</head>
<body>
    <h1>List of Recycled Items</h1>
    <?php
    // Connect to the database
    $conn = mysqli_connect("localhost", "root", "", "adbmsfinal");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Query the database for all the recycled items with their uploader's name
    $sql = "SELECT * FROM recycled_materials";
    $result = mysqli_query($conn, $sql);

    // Check if there are any recycled items
    if (mysqli_num_rows($result) > 0) {
        // Display the recycled items in an HTML table
        echo "<table>";
        echo "<tr><th>ID</th><th>Image</th><th>Weight</th><th>Height</th><th>Material Type</th><th>User ID</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td><a href='uploads/{$row['image']}' target='_blank'><img src='uploads/{$row['image']}' height='100'></a></td>";
            echo "<td>{$row['weight']}</td>";
            echo "<td>{$row['height']}</td>";
            echo "<td>{$row['material_type']}</td>";
            echo "<td>{$row['user_id']}</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        // Display a message if there are no recycled items
        echo "No recycled items found.";
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
</body>
</html>
