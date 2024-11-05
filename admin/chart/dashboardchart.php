<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senior Medical Operation - Charts</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #ffffff, #e0f7fa);
            color: #333;
            overflow-x: hidden;
        }
        .header {
            background-color: rgba(0, 150, 136, 0.8); /* Transparent teal color for the header */
            height: 300px;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            text-align: center;
            overflow: hidden;
        }
        .header h1 {
            color: white;
            font-size: 3.5em;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            margin: 0;
            animation: fadeIn 1s ease-in; /* Fade-in animation */
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .chart-icon {
            position: absolute;
            top: 20px;
            right: 20px;
            animation: bounce 2s infinite;
        }
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
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
            z-index: 1;
        }
        .container p {
            font-size: 1.2em;
            color: #555;
            margin-bottom: 20px;
            animation: fadeIn 1s ease-in; /* Fade-in animation for text */
        }
        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }
        .nav-card {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2);
            width: 250px;
            text-decoration: none;
            color: #333;
            transition: transform 0.3s, box-shadow 0.3s, background-color 0.3s;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        .nav-card:hover {
            transform: translateY(-5px) scale(1.03);
            box-shadow: 0px 8px 30px rgba(0, 0, 0, 0.3);
            background-color: #e0f7fa; /* Light background on hover */
        }
        .nav-card img {
            width: 120px;
            height: 120px;
            margin-bottom: 15px;
            border-radius: 50%;
            object-fit: cover;
            transition: transform 0.3s;
        }
        .nav-card:hover img {
            transform: scale(1.1);
        }
        .nav-card h2 {
            font-family: 'Montserrat', sans-serif; /* Different font for headings */
            font-size: 1.5em;
            font-weight: bold;
            margin: 10px 0;
            color: #00796b; /* Darker teal color for headings */
        }
        .nav-card i {
            margin-bottom: 10px; /* Space between icon and title */
            font-size: 24px; /* Icon size */
            color: #009688; /* Matching color with header */
        }
        footer {
            text-align: center;
            padding: 20px;
            background-color: rgba(0, 150, 136, 0.9); /* Footer color */
            color: white;
            position: relative;
            bottom: 0;
            width: 100%;
            animation: slideUp 1s ease-in-out; /* Slide-up animation */
        }
        @keyframes slideUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
    </style>
</head>
<body>

    <!-- Header Section -->
    <div class="header">
        <h1>Senior Citizen Operation - Charts</h1>
        <img src="https://img.icons8.com/ios/452/bar-chart.png" class="chart-icon" alt="Chart Icon" width="50" height="50">
    </div>

    <!-- Main Container for Navigation -->
    <div class="container">
        <p>Select an option below to view detailed information:</p>

        <!-- Cards Container -->
        <div class="card-container">
            <!-- Link to Medication Prevalence Rate -->
            <a href="medication.php" class="nav-card">
                <i class="fas fa-pills"></i> <!-- Medication icon -->
                <img src="https://www.careworkshealthservices.com/wp-content/uploads/2020/04/senior-man-looking-at-medications.jpg" alt="Medication Prevalence Rate">
                <h2>Medication</h2>
            </a>

            <!-- Link to Prevalence of Diseases Rate -->
            <a href="diseases.php" class="nav-card">
                <i class="fas fa-virus"></i> <!-- Disease icon -->
                <img src="https://www.shutterstock.com/image-photo/caucasian-woman-elderly-asian-discuss-600nw-2459571037.jpg" alt="Prevalence of Diseases Rate">
                <h2>Disease</h2>
            </a>

            <!-- Link to Functional Ability Rate -->
            <a href="ability.php" class="nav-card">
                <i class="fas fa-user-check"></i> <!-- Ability icon -->
                <img src="https://24373520.fs1.hubspotusercontent-na1.net/hubfs/24373520/Imported_Blog_Media/Cognitive-Games-for-Seniors-1.jpg" alt="Functional Ability Rate">
                <h2>Ability</h2>
            </a>
        </div>
    </div>

    
</body>
</html>
