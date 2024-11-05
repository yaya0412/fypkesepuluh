
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

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: adminlogin.php');
    exit();
}

// Fetch today's appointments
$today = date('Y-m-d');
$sql = "SELECT * FROM appointments WHERE appointment_date = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $today);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Today's Appointments</title>
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
            border-radius: 8px; /* Rounded corners for the container */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5); /* Add shadow for depth */
        }
        h2 {
            text-align: center; /* Center align the heading */
            margin-bottom: 20px; /* Space below the heading */
        }
        .table {
            background-color: rgba(255, 255, 255, 0.9); /* White background for the table */
            color: #333; /* Dark text for better readability */
        }
        .table th {
            background-color: #007bff; /* Bootstrap primary color */
            color: white; /* White text for table headers */
        }
        .btn-secondary {
            background-color: #6c757d; /* Custom background color for button */
            border-color: #5a6268; /* Custom border color for button */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Today's Appointments</h2>

        <?php if ($result->num_rows > 0): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Resident Name</th>
                        <th>Appointment Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['resident_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['appointment_date']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info">No appointments for today.</div>
        <?php endif; ?>

        <div class="text-center mt-3">
            <a href="dashboardstaff.php" class="btn btn-secondary">Back to Dashboard</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
