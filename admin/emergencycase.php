<?php
$host = 'localhost'; // Change if necessary
$db_name = 'emergency'; // Replace with your database name
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $resident_name = $_POST['resident_name'];
        $emergency_type = $_POST['emergency_type'];
        $emergency_date = $_POST['emergency_date'];
        
        $stmt = $pdo->prepare("INSERT INTO emergency_cases (resident_name, emergency_type, emergency_date) VALUES (:resident_name, :emergency_type, :emergency_date)");
        $stmt->execute([
            ':resident_name' => $resident_name,
            ':emergency_type' => $emergency_type,
            ':emergency_date' => $emergency_date
        ]);
    }

    // Fetch all cases to display
    $stmt = $pdo->query("SELECT resident_name, emergency_type, emergency_date FROM emergency_cases ORDER BY emergency_date DESC");
    $cases = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Emergency Cases</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('https://online-learning-college.com/wp-content/uploads/2023/12/Crisis-Intervention-in-Social-Care.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #333;
        }
        .container {
            margin: 20px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            animation: fadeIn 1s ease;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"], input[type="datetime-local"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus, input[type="datetime-local"]:focus {
            border-color: #4CAF50;
            outline: none;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .cases {
            margin-top: 20px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .floating-icon {
            position: fixed;
            bottom: 20px;
            right: 20px;
            font-size: 40px;
            background-color: #4CAF50;
            color: white;
            border-radius: 50%;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            animation: bounce 2s infinite;
        }
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Enter Emergency Case Information</h1>
        <form action="" method="POST">
            <label for="resident_name">Resident Name:</label>
            <input type="text" id="resident_name" name="resident_name" required>
            
            <label for="emergency_type">Type of Emergency:</label>
            <input type="text" id="emergency_type" name="emergency_type" required>
            
            <label for="emergency_date">Date and Time of Emergency:</label>
            <input type="datetime-local" id="emergency_date" name="emergency_date" required>
            
            <input type="submit" value="Submit Emergency Case">
        </form>
    </div>

    <div class="cases container">
        <h1>Submitted Emergency Cases</h1>
        <table>
            <tr>
                <th>Resident Name</th>
                <th>Type of Emergency</th>
                <th>Date and Time</th>
            </tr>
            <?php if ($cases): ?>
                <?php foreach ($cases as $case): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($case['resident_name']); ?></td>
                        <td><?php echo htmlspecialchars($case['emergency_type']); ?></td>
                        <td><?php echo htmlspecialchars($case['emergency_date']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No emergency cases found.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>

    <div class="floating-icon" onclick="window.scrollTo(0, 0)">
        <i class="fas fa-arrow-up"></i>
    </div>
</body>
</html>
