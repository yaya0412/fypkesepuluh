<?php
// MySQL connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "residentdata";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch disease data
$sql = "SELECT sejarah_penyakit, COUNT(*) as count FROM elderly_resident GROUP BY sejarah_penyakit";
$result = $conn->query($sql);

$diseases = [];
$counts = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $diseases[] = $row['sejarah_penyakit'];
        $counts[] = $row['count'];
    }
} else {
    echo "No data found.";
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disease Distribution Pie Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS2brUTOzlUORHUgs7J399kBHXmMlVlJ3pjxQ&s');
            background-size: cover; /* Cover the entire background */
            background-position: center; /* Center the background image */
            padding: 20px;
            color: #333; /* Dark text for contrast */
        }
        h2 {
            text-align: center;
            color: #fff; /* Change header text color for visibility */
            margin-top: 20px;
        }
        .chart-container {
            position: relative;
            max-width: 600px;
            margin: 20px auto; /* Adjusted margin for spacing */
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8); /* White background with some transparency */
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            animation: float 5s ease-in-out infinite; /* Animation for floating effect */
        }
        .back-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            width: 200px;
            transition: background-color 0.3s; /* Smooth transition */
        }
        .back-button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }

        /* Floating animation */
        @keyframes float {
            0% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0); }
        }
    </style>
</head>
<body>

<h2>Disease Distribution Pie Chart</h2>
<div class="chart-container">
    <canvas id="diseaseChart"></canvas>
</div>

<a href="../dashboardstaff.php" class="back-button">Back to Dashboard</a>

<script>
    const ctx = document.getElementById('diseaseChart').getContext('2d');
    const diseaseChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode($diseases); ?>,
            datasets: [{
                label: 'Number of Residents by Disease',
                data: <?php echo json_encode($counts); ?>,
                backgroundColor: [
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(153, 102, 255, 0.6)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        color: 'black'  // Legend label color
                    }
                },
                title: {
                    display: true,
                    text: 'Disease Distribution Among Residents',
                    color: 'black'  // Title color
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw; // Custom tooltip display
                        }
                    }
                }
            }
        }
    });
</script>

</body>
</html>
