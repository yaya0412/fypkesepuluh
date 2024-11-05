<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: adminlogin.php'); // Redirect to login page if not logged in
    exit();
}

// Handle logout
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    $_SESSION = []; // Unset all session variables
    session_destroy(); // Destroy the session
    header('Location: adminlogin.php'); // Redirect to login page
    exit();
}

// Retrieve username and profile picture from session
$username = $_SESSION['username'] ?? 'User'; // Default to 'User' if username is not set
$profilePicture = $_SESSION['profilePicture'] ?? 'path/to/default-profile.jpg'; // Default profile picture
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senior Citizen Operation - DARUL HANAN</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-image: url('gambar/backround.jpg'); /* Update to use the correct path */
            background-size: cover;
            background-position: center;
            height: 100vh;
            margin: 0;
            font-family: 'Roboto', sans-serif;
            color: #333;
        }

        .header {
            height: 300px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            position: relative;
            text-align: center;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            margin-bottom: 30px;
        }

        .header h1 {
            color: #2c3e50;
            font-size: 3em;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.6);
        }

        .header .welcome-message {
            font-size: 1.5em;
            margin-top: 10px;
            font-weight: 500;
        }

        .nav {
            background-color: rgba(0, 0, 0, 0.85);
            padding: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            border-radius: 10px;
            margin-bottom: 20px;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav a {
            color: white;
            text-decoration: none;
            margin: 0 20px;
            font-size: 1.1em;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .nav a:hover {
            background-color: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
        }

        .button-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
            padding: 20px;
        }

        .button {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.15);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            width: 180px;
            position: relative;
            overflow: hidden;
            border: 2px solid transparent;
        }

        .button img {
            width: 80px;
            height: 80px;
            margin-bottom: 10px;
        }

        .button h3 {
            font-size: 1.2em;
            color: #333;
            margin: 10px 0;
        }

        .button:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            border-color: #3498db;
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
        }

        @media (max-width: 768px) {
            .button-container {
                flex-direction: column;
                gap: 15px;
            }
            .button {
                width: 90%;
            }
        }
    </style>
</head>
<body>

    <!-- Logo Section -->
    <div style="text-align: left; margin-top: 10px; margin-left: 20px;">
        <a href="info.php">
            <img src="https://png.pngtree.com/png-vector/20190916/ourmid/pngtree-info-icon-for-your-project-png-image_1731084.jpg" alt="Info Logo" style="width: 50px; height: auto;">
        </a>
    </div>

    <!-- Header Section -->
    <div class="header">
        <div class="dropdown-container">
            <img src="<?php echo htmlspecialchars($profilePicture); ?>" alt="Profile Picture" class="rounded-circle" width="40" height="40" style="margin-right: 10px;">
            
            <div class="btn-group">
                <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Manage Account
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="accountsetting.php">Account Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="?action=logout">Logout</a></li>
                </ul>
            </div>
        </div>
        
        <h1>Senior Citizen Operation - DARUL HANAN</h1>
        <div class="welcome-message">
            Welcome, <?php echo htmlspecialchars($username); ?>!
        </div>

        <!-- Navigation Bar -->
        <div class="nav">
            <div style="display: inline-block; text-align: center;">
                <?php
                    $current_page = basename($_SERVER['PHP_SELF']);
                    $nav_links = [
                        "resident.php" => "Residents",
                        "../chart/dashboardchart.php" => "Statistics",
                        "organizationchart.php" => "Organization Chart",
                        "emergency.php" => "Emergency & Check-Up"
                    ];

                    foreach ($nav_links as $page => $title) {
                        $active_class = ($current_page == basename($page)) ? 'active' : '';
                        echo "<a href='$page' class='$active_class'>$title</a>";
                    }
                ?>
            </div>
        </div>
    </div>

    <!-- Button Container -->
    <div class="container">
        <div class="button-container">
            <div class="button">
                <a href="staffmedic/resident.php">
                    <img src="gambar/list.png" alt="Resident list">
                    <h3>Resident</h3>
                </a>
            </div>
            <div class="button">
                <a href="chart/dashboardchart.php">
                    <img src="https://cdn3.vectorstock.com/i/1000x1000/96/57/statistic-graphic-isolated-icon-vector-17079657.jpg" alt="View statistics">
                    <h3>Statistic</h3>
                </a>
            </div>
            <div class="button">
                <a href="organizationchartstaff.php">
                    <img src="https://img.kyodonews.net/english/public/images/posts/7c65d61449699fe38d2f5191c0ff1149/cropped_image_l.jpg" alt="Organization chart">
                    <h3>Organization Chart</h3>
                </a>
            </div>
            <div class="button">
                <a href="emergency.php">
                    <img src="https://www.weinmann-emergency.com/fileadmin/_processed_/3/f/csm_EKG_mit_MEDUCORE_Standard2_e6ce64da1e.jpg" alt="Emergency and check-up">
                    <h3>Emergency & Check-Up</h3>
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
