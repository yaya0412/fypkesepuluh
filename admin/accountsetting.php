<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: adminlogin.php'); // Redirect to login page if not logged in
    exit();
}

// Database configuration
$host = 'localhost'; // Database host
$user = 'root'; // Database username
$password = ''; // Database password
$dbname = 'staffmanagement'; // Database name

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve username from session
$username = $_SESSION['username'] ?? 'User'; // Default to 'User' if username is not set

// Initialize user data array with default values
$user_data = [
    'username' => $username,
    'email' => '',
    'current_password' => '',
    'image' => null,
    'image_type' => null
];

// Fetch current user data
if ($stmt = $conn->prepare("SELECT emailstaff, PASSWORD, image, image_type FROM staff WHERE username = ?")) {
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($email, $current_password, $image, $image_type);

    // Check if a row is returned
    if ($stmt->fetch()) {
        $user_data = [
            'username' => $username,
            'email' => $email,
            'current_password' => $current_password,
            'image' => $image,
            'image_type' => $image_type
        ];
    } else {
        echo "<div class='alert alert-danger'>User data not found.</div>";
    }
    $stmt->close();
}

// Handle form submission to update account information
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_email = $_POST['email'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    
    // Verify if the old password matches
    if ($old_password === $user_data['current_password']) {
        // Prepare and execute the SQL statement to update the email and password
        if ($stmt = $conn->prepare("UPDATE staff SET emailstaff = ?, PASSWORD = ? WHERE username = ?")) {
            $stmt->bind_param("sss", $new_email, $new_password, $username);

            if ($stmt->execute()) {
                echo "<div class='alert alert-success'>Account updated successfully!</div>";
                $user_data['email'] = $new_email; // Update user data
            } else {
                echo "<div class='alert alert-danger'>Error updating account: " . $stmt->error . "</div>";
            }
            $stmt->close();
        }
    } else {
        echo "<div class='alert alert-danger'>Old password is incorrect. Please try again.</div>";
    }

    // Handle image upload
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == UPLOAD_ERR_OK) {
        $image = file_get_contents($_FILES['profile_image']['tmp_name']);
        $image_type = $_FILES['profile_image']['type'];

        // Prepare and execute the SQL statement to update the image
        if ($stmt = $conn->prepare("UPDATE staff SET image = ?, image_type = ? WHERE username = ?")) {
            $stmt->bind_param("bss", $image, $image_type, $username);

            if ($stmt->execute()) {
                echo "<div class='alert alert-success'>Profile image updated successfully!</div>";
            } else {
                echo "<div class='alert alert-danger'>Error updating profile image: " . $stmt->error . "</div>";
            }
            $stmt->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('gambar/backround.jpg'); /* Ensure this path is correct */
            background-size: cover; /* Make the background cover the entire area */
            background-position: center; /* Center the background image */
            background-attachment: fixed; /* Keep the background fixed when scrolling */
            height: 100vh; /* Full viewport height */
            margin: 0; /* No margin */
            display: flex; /* Flexbox for centering */
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
        }

        .container {
            max-width: 500px; /* Maximum width of the container */
            background: rgba(255, 255, 255, 0.9); /* White background with transparency */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2); /* Shadow effect */
            padding: 30px; /* Padding inside the container */
            position: relative; /* For stacking context */
            z-index: 1; /* Ensure container is above background */
        }

        h2 {
            font-size: 1.8em; /* Heading font size */
            margin-bottom: 1rem; /* Space below heading */
            text-align: center; /* Center the heading */
            color: #0062cc; /* Heading color */
        }

        .form-label {
            color: #333; /* Label text color */
            font-weight: bold; /* Bold labels */
        }

        .form-control {
            border-radius: 8px; /* Rounded inputs */
        }

        .btn-primary {
            width: 100%; /* Full-width buttons */
            padding: 10px; /* Padding inside buttons */
            font-size: 1.1em; /* Button font size */
            background-color: #0062cc; /* Button color */
            border: none; /* No border */
        }

        .btn-secondary {
            width: 100%; /* Full-width buttons */
            padding: 10px; /* Padding inside buttons */
            margin-top: 10px; /* Space above secondary button */
            font-size: 1.1em; /* Button font size */
            background-color: #6c757d; /* Secondary button color */
            border: none; /* No border */
        }

        .alert {
            font-size: 0.9em; /* Alert text size */
            margin-top: 10px; /* Space above alerts */
        }

        .profile-image {
            width: 100%; /* Full width for the image */
            max-height: 200px; /* Limit max height */
            object-fit: cover; /* Crop to fit */
            border-radius: 8px; /* Rounded corners */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Account Settings</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" class="form-control" value="<?php echo htmlspecialchars($user_data['username']); ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user_data['email']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="old_password" class="form-label">Current Password</label>
                <input type="password" id="old_password" name="old_password" class="form-control" placeholder="Enter current password" required>
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label">New Password</label>
                <input type="password" id="new_password" name="new_password" class="form-control" placeholder="Enter new password" required>
            </div>
            <div class="mb-3">
                <label for="profile_image" class="form-label">Profile Image</label>
                <input type="file" id="profile_image" name="profile_image" class="form-control" accept="image/*">
                <?php if ($user_data['image']): ?>
                    <img src="data:<?php echo htmlspecialchars($user_data['image_type']); ?>;base64,<?php echo base64_encode($user_data['image']); ?>" class="profile-image mt-2" alt="Profile Image">
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Update Account</button>
        </form>
        <a href="dashboardstaff.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

