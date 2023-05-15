<?php
// Check if the form has been submitted
if(isset($_POST['submit'])) {
  // Get the uploaded file information
  $file_name = $_FILES['item']['name'];
  $file_type = $_FILES['item']['type'];
  $file_size = $_FILES['item']['size'];
  $file_tmp = $_FILES['item']['tmp_name'];

  // Check if the file is an image
  $allowed_extensions = array("jpg", "jpeg", "png", "gif");
  $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
  if(!in_array($file_extension, $allowed_extensions)) {
    echo "Error: Only JPG, JPEG, PNG, and GIF files are allowed.";
    exit;
  }

  // Check if the file size is less than 10 MB
  $max_file_size = 10 * 1024 * 1024;
  if($file_size > $max_file_size) {
    echo "Error: File size must be less than 10 MB.";
    exit;
  }

  // Create the uploads directory if it does not exist
  if (!file_exists('uploads')) {
    mkdir('uploads', 0777, true);
  }

  // Generate a unique file name
  $timestamp = time();
  $new_file_name = $timestamp . '_' . $file_name;

  // Save the file to the server
  $upload_dir = "uploads/";
  $upload_file = $upload_dir . $new_file_name;
  if(file_exists($upload_file)) {
    echo "Error: File already exists.";
    exit;
  }
  if(move_uploaded_file($file_tmp, $upload_file)) {
    echo "File uploaded successfully.";
  } else {
    echo "Error uploading file.";
    exit;
  }

  // Get the recycled item information
  $weight = $_POST['weight'];
  $height = $_POST['height'];
  $material_type = $_POST['material_type'];

  // Save the recycled item information to a database or file
  $conn = mysqli_connect("localhost", "root", "", "adbmsfinal");
  if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  $sql = "INSERT INTO recycled_items (image, weight, height, material_type) VALUES ('$new_file_name', '$weight', '$height', '$material_type')";
  if(mysqli_query($conn, $sql)) {
    echo "Record added successfully.";
  } else {
    echo "Error adding record: " . mysqli_error($conn);
  }
  mysqli_close($conn);

}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Upload a Recycled Item</title>
  <link rel="stylesheet" type="text/css" href="user-upload-recycling-record.css">
</head>
<body>

  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
    <h2>Upload a Recycled Item</h2>
    <label for="item">Select an Image:</label>
    <input type="file" id="item" name="item"><br>
    <label for="weight">Weight:</label>
    <input type="text" id="weight" name="weight"><br>

    <label for="height">Height:</label>
    <input type="text" id="height" name="height"><br>
    <label for="material_type">Material Type:</label>
	<select id="material_type" name="material_type">
    <option value="Paper">Paper</option>
    <option value="Cardboard">Cardboard</option>
    <option value="Plastic">Plastic</option>
    <option value="Glass">Glass</option>
    <option value="Metal">Metal</option>
	</select><br>
		<input type="submit" name="submit" value="Submit">
	</form>
</body>
</html>