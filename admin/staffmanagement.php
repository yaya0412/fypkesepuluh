<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "staffmanagement";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle create staff action
if (isset($_POST['create'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password']; // Not hashed
    $phonenumber = $conn->real_escape_string($_POST['phonenumber']);
    
    $sql = "INSERT INTO staff (username, emailstaff, PASSWORD, phonenumber) VALUES ('$username', '$email', '$password', '$phonenumber')";
    
    if (!$conn->query($sql)) {
        die("Error creating staff: " . $conn->error);
    }
}

// Handle delete staff action
if (isset($_POST['delete'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $sql = "DELETE FROM staff WHERE username='$username'";
    
    if (!$conn->query($sql)) {
        die("Error deleting staff: " . $conn->error);
    } else {
        echo "<script>alert('Staff deleted successfully');</script>";
    }
}

// Handle update staff action
if (isset($_POST['update'])) {
    $username = $conn->real_escape_string($_POST['edit_username']);
    $email = $conn->real_escape_string($_POST['edit_email']);
    $phonenumber = $conn->real_escape_string($_POST['edit_phonenumber']);
    
    $sql = "UPDATE staff SET emailstaff='$email', phonenumber='$phonenumber' WHERE username='$username'";
    
    if (!$conn->query($sql)) {
        die("Error updating staff: " . $conn->error);
    } else {
        echo "<script>alert('Staff updated successfully');</script>";
    }
}

// Fetching staff data
$sql = "SELECT username, emailstaff, PASSWORD, phonenumber FROM staff";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Management</title>
    <style>
        body {
            background-image: url('https://www.fouroakshealthcare.co.uk/wp-content/uploads/2022/07/iStock-1380983332-1170x740.jpg');
            background-size: cover;
            font-family: 'Arial', sans-serif;
            color: #333;
        }
        h1 {
            text-align: center;
            color: #006064;
            margin-top: 20px;
        }
        form {
            margin: 20px auto;
            max-width: 400px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: #00796b;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #004d40;
        }
        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 80%;
            background-color: rgba(255, 255, 255, 0.8);
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #009688;
            color: white;
        }
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Manage Staff Accounts</h1>

    <!-- Form for creating a new staff account -->
    <form action="staffmanagement.php" method="POST">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="text" name="phonenumber" placeholder="Phone Number" required><br>
        <button type="submit" name="create">Create Staff</button>
    </form>

    <hr>

    <!-- List of all staff accounts with options to delete or edit -->
    <table border="1">
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Password</th> <!-- Displaying password directly -->
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo htmlspecialchars($row['username']); ?></td>
            <td><?php echo htmlspecialchars($row['emailstaff']); ?></td>
            <td><?php echo htmlspecialchars($row['phonenumber']); ?></td>
            <td><?php echo htmlspecialchars($row['PASSWORD']); ?></td> <!-- Displaying plain text password -->
            <td>
                <button onclick="openEditModal('<?php echo $row['username']; ?>', '<?php echo htmlspecialchars($row['emailstaff']); ?>', '<?php echo htmlspecialchars($row['phonenumber']); ?>')">Edit</button>
                <button onclick="openDeleteModal('<?php echo $row['username']; ?>')">Delete</button>
            </td>
        </tr>
        <?php } ?>
    </table>

    <!-- Edit Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEditModal()">&times;</span>
            <h2>Edit Staff Details</h2>
            <form id="editForm" method="POST" action="staffmanagement.php">
                <input type="hidden" name="edit_username" id="editUsername">
                <input type="email" name="edit_email" id="editEmail" placeholder="Email" required>
                <input type="text" name="edit_phonenumber" id="editPhoneNumber" placeholder="Phone Number" required>
                <button type="submit" name="update">Update Staff</button>
                <button type="button" onclick="closeEditModal()">Cancel</button>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeDeleteModal()">&times;</span>
            <h2>Are you sure you want to delete this staff member?</h2>
            <form id="deleteForm" method="POST" action="staffmanagement.php">
                <input type="hidden" name="username" id="deleteUsername">
                <button type="submit" name="delete">Yes, Delete</button>
                <button type="button" onclick="closeDeleteModal()">Cancel</button>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(username, email, phone) {
            document.getElementById("editUsername").value = username;
            document.getElementById("editEmail").value = email;
            document.getElementById("editPhoneNumber").value = phone;
            document.getElementById("editModal").style.display = "block";
        }

        function closeEditModal() {
            document.getElementById("editModal").style.display = "none";
        }

        function openDeleteModal(username) {
            document.getElementById("deleteUsername").value = username;
            document.getElementById("deleteModal").style.display = "block";
        }

        function closeDeleteModal() {
            document.getElementById("deleteModal").style.display = "none";
        }
    </script>
</body>
</html>
