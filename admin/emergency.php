<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senior Medical Operation - Charts</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('https://online-learning-college.com/wp-content/uploads/2023/12/Crisis-Intervention-in-Social-Care.jpg') no-repeat center center fixed;
            background-size: cover;
            overflow: hidden;
        }
        .header {
            background: rgba(0, 0, 0, 0.5);
            height: 300px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-bottom: 5px solid #00aaff;
        }
        .header h1 {
            color: white;
            font-size: 3.5em;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
            margin: 0;
        }
        .container {
            text-align: center;
            margin: 40px auto;
            max-width: 900px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        .nav-button {
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 15px 30px;
            margin: 20px;
            font-size: 1.5em;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            text-decoration: none;
            display: inline-flex; /* Change to inline-flex */
            align-items: center; /* Center items vertically */
            position: relative;
        }
        .nav-button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
        .nav-button img {
            width: 36px; /* Increased icon size */
            height: auto;
            margin-right: 10px; /* Space between icon and text */
        }
    </style>
</head>
<body>

    <!-- Header Section -->
    <div class="header">
        <h1>Crisis Response</h1>
    </div>

    <!-- Main Container for Navigation -->
    <div class="container">
        <p style="font-size: 1.8em; font-weight: bold;">Senior Citizen Operation</p>

        <!-- Button for Emergency -->
        <a href="emergencycase.php" class="nav-button">
            <img src="https://img.icons8.com/ios-filled/50/ffffff/ambulance.png" alt="Emergency Logo"> <!-- Emergency icon -->
            Emergency
        </a>
        
        <!-- Button for Appointment -->
        <a href="appoiment.php" class="nav-button">
            <img src="https://img.icons8.com/ios-filled/50/ffffff/calendar.png" alt="Appointment Logo"> <!-- Appointment icon -->
            Appointment
        </a>
    </div>

</body>
</html>
