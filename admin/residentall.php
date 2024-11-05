
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

// Delete resident record if requested
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    // Prepare statement
    $delete_stmt = $conn->prepare("DELETE FROM elderly_resident WHERE resident_id = ?");
    $delete_stmt->bind_param("i", $delete_id);
    
    if ($delete_stmt->execute()) {
        echo "<script>alert('Record deleted successfully.');</script>";
    } else {
        echo "<script>alert('Error deleting record: " . $conn->error . "');</script>";
    }
    $delete_stmt->close();
}

// Initialize search variable
$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

// Fetch residents data with optional search query
$sql = "SELECT * FROM elderly_resident WHERE nama_penghuni LIKE ?";
$search_param = '%' . $search . '%';
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $search_param);
$stmt->execute();
$result = $stmt->get_result();

// Error handling for the SQL query execution
if (!$result) {
    die("Error executing query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resident Information</title>
    <style>
       body {
    font-family: 'Arial', sans-serif;
    background-image: url('https://t4.ftcdn.net/jpg/03/09/38/09/360_F_309380980_IPZaXZHCXvdkocYpqaOYfxjALOw8syR0.jpg');
    background-size: cover;
    background-position: center;
    color: #333;
    padding: 20px;
    position: relative;
    opacity: 0.95; /* Adjust this value to control the transparency */
}

        h2 {
            text-align: center;
            color: #fff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: center;
        }
        th {
            background-color: #007BFF;
            color: white;
            position: sticky;
            top: 0; /* Stick header to the top */
            z-index: 1; /* Make sure header is above other rows */
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f1f1f1; /* Highlight row on hover */
        }
        a {
            text-decoration: none;
            color: #007BFF;
        }
        a:hover {
            text-decoration: underline;
        }
        .delete-button {
            background-color: red;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
        }
        .delete-button:hover {
            background-color: darkred; /* Darker red on hover */
        }
        .search-form {
            text-align: center;
            margin-bottom: 20px;
        }
        .search-input {
            padding: 5px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        .search-button {
            padding: 5px 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .search-button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
        @media (max-width: 600px) {
            table {
                font-size: 14px; /* Smaller font size for mobile */
            }
        }
    </style>
</head>
<body>

<h2>Resident Information</h2>

<!-- Search Form -->
<div class="search-form">
    <form action="" method="GET">
        <input type="text" name="search" class="search-input" placeholder="Search by Name" value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit" class="search-button">Search</button>
    </form>
</div>

<?php
if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>Resident ID</th>
                <th>Registration Date</th>
                <th>Name</th>
                <th>IC Number</th>
                <th>Date of Birth</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Category</th>
                <th>Status</th>
                <th>Address</th>
                <th>Medical History</th>
                <th>Medication Type</th>
                <th>Current Condition</th>
                <th>Allergy Type</th>
                <th>Allergy Detail</th>
                <th>Previous Treatment Place</th>
                <th>Previous Treatment Name</th>
                <th>Post-Treatment Place</th>
                <th>Post-Treatment Name</th>
                <th>Diaper</th>
                <th>Diet</th>
                <th>Mental Health Screening</th>
                <th>Staff in Charge</th>
                <th>Next of Kin Name</th>
                <th>Relationship</th>
                <th>Phone Number</th>
                <th>Next of Kin Address</th>
                <th>Actions</th>
            </tr>";

    // Output data for each resident
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['resident_id']) . "</td>
                <td>" . htmlspecialchars($row['tarikh_daftar_masuk']) . "</td>
                <td>" . htmlspecialchars($row['nama_penghuni']) . "</td>
                <td>" . htmlspecialchars($row['nokadpengenalan']) . "</td>
                <td>" . htmlspecialchars($row['tarikhlahir']) . "</td>
                <td>" . htmlspecialchars($row['umur']) . "</td>
                <td>" . htmlspecialchars($row['jantina']) . "</td>
                <td>" . htmlspecialchars($row['kategori']) . "</td>
                <td>" . htmlspecialchars($row['status']) . "</td>
                <td>" . htmlspecialchars($row['alamat']) . "</td>
                <td>" . htmlspecialchars($row['sejarah_penyakit']) . "</td>
                <td>" . htmlspecialchars($row['jenis_ubatubatan']) . "</td>
                <td>" . htmlspecialchars($row['keadaan_semasa']) . "</td>
                <td>" . htmlspecialchars($row['jenis_alahan']) . "</td>
                <td>" . htmlspecialchars($row['nyatakan_alahan']) . "</td>
                <td>" . htmlspecialchars($row['tempat_rawatan_sebelum_kemasukkan']) . "</td>
                <td>" . htmlspecialchars($row['nama_tempat_rawatan_sebelum_kemasukkan']) . "</td>
                <td>" . htmlspecialchars($row['tempat_rawatan_selepas_kemasukkan']) . "</td>
                <td>" . htmlspecialchars($row['nama_tempat_rawatan_selepas_kemasukkan']) . "</td>
                <td>" . htmlspecialchars($row['lampin_pakai_buang']) . "</td>
                <td>" . htmlspecialchars($row['diet']) . "</td>
                <td>" . htmlspecialchars($row['saringan_kesihatan_mental']) . "</td>
                <td>" . htmlspecialchars($row['staff_bertugas']) . "</td>
                <td>" . htmlspecialchars($row['nama_waris']) . "</td>
                <td>" . htmlspecialchars($row['hubungan']) . "</td>
                <td>" . htmlspecialchars($row['no_telefon']) . "</td>
                <td>" . htmlspecialchars($row['alamat_waris']) . "</td>
                <td><a href='?delete_id=" . htmlspecialchars($row['resident_id']) . "' class='delete-button' onclick='return confirm(\"Are you sure you want to delete this resident?\");'>Delete</a></td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No residents found.</p>";
}
$stmt->close();
$conn->close();
?>

</body>
</html>
