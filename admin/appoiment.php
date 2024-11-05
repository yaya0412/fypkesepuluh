<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start the session
session_start();

// Database configuration
$host = 'localhost'; // Database host
$user = 'root'; // Database username
$password = ''; // Database password
$dbname = 'resident2'; // Database name

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert appointment details if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resident_name = $_POST['resident_name'];
    $appointment_date = $_POST['appointment_date'];

    // Prepare and execute the SQL statement
    $insert_sql = "INSERT INTO appointments (resident_name, appointment_date) VALUES (?, ?)";
    $stmt = $conn->prepare($insert_sql);
    $stmt->bind_param("ss", $resident_name, $appointment_date);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Appointment added successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error adding appointment: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Appointment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('https://online-learning-college.com/wp-content/uploads/2023/12/Crisis-Intervention-in-Social-Care.jpg');
            background-size: cover; /* Cover the entire page */
            background-repeat: no-repeat; /* Prevent repeating the image */
            background-attachment: fixed; /* Keep the background fixed on scroll */
            color: #fff; /* Change text color to white for better contrast */
        }
        .container {
            background-color: rgba(0, 0, 0, 0.7); /* Add a semi-transparent background for readability */
            padding: 20px;
            border-radius: 8px; /* Optional: rounded corners for the container */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Add Appointment</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="resident_name" class="form-label">Resident Name</label>
                <input type="text" id="resident_name" name="resident_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="appointment_date" class="form-label">Appointment Date</label>
                <input type="date" id="appointment_date" name="appointment_date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Appointment</button>
        </form>
        <a href="appoimentdate.php" class="btn btn-success mt-3">View Appointments</a> <!-- Added button for viewing appointments -->
        <a href="dashboardstaff.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
