
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

// Fetch residents data
$sql = "SELECT * FROM elderly_resident";
$result = $conn->query($sql);
?>

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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form inputs
    $tarikh_daftar_masuk = mysqli_real_escape_string($conn, $_POST['tarikh_daftar_masuk']);
    $nama_penghuni = mysqli_real_escape_string($conn, $_POST['nama_penghuni']);
    $nokadpengenalan = mysqli_real_escape_string($conn, $_POST['nokadpengenalan']);
    $tarikhlahir = mysqli_real_escape_string($conn, $_POST['tarikhlahir']);
    $umur = mysqli_real_escape_string($conn, $_POST['umur']);
    $jantina = mysqli_real_escape_string($conn, $_POST['jantina']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $sejarah_penyakit = mysqli_real_escape_string($conn, $_POST['sejarah_penyakit']);
    $jenis_ubatubatan = mysqli_real_escape_string($conn, $_POST['jenis_ubatubatan']);
    $keadaan_semasa = mysqli_real_escape_string($conn, $_POST['keadaan_semasa']);
    $jenis_alahan = mysqli_real_escape_string($conn, $_POST['jenis_alahan']);
    $nyatakan_alahan = mysqli_real_escape_string($conn, $_POST['nyatakan_alahan']);
    $tempat_rawatan_sebelum_kemasukkan = mysqli_real_escape_string($conn, $_POST['tempat_rawatan_sebelum_kemasukkan']);
    $nama_tempat_rawatan_sebelum_kemasukkan = mysqli_real_escape_string($conn, $_POST['nama_tempat_rawatan_sebelum_kemasukkan']);
    $tempat_rawatan_selepas_kemasukkan = mysqli_real_escape_string($conn, $_POST['tempat_rawatan_selepas_kemasukkan']);
    $nama_tempat_rawatan_selepas_kemasukkan = mysqli_real_escape_string($conn, $_POST['nama_tempat_rawatan_selepas_kemasukkan']);
    $lampin_pakai_buang = mysqli_real_escape_string($conn, $_POST['lampin_pakai_buang']);
    $diet = mysqli_real_escape_string($conn, $_POST['diet']);
    $saringan_kesihatan_mental = mysqli_real_escape_string($conn, $_POST['saringan_kesihatan_mental']);
    $staff_bertugas = mysqli_real_escape_string($conn, $_POST['staff_bertugas']);
    $nama_waris = mysqli_real_escape_string($conn, $_POST['nama_waris']);
    $hubungan = mysqli_real_escape_string($conn, $_POST['hubungan']);
    $no_telefon = mysqli_real_escape_string($conn, $_POST['no_telefon']);
    $alamat_waris = mysqli_real_escape_string($conn, $_POST['alamat_waris']);

    // SQL query to insert the data
    $sql = "INSERT INTO elderly_resident (
        tarikh_daftar_masuk, nama_penghuni, nokadpengenalan, tarikhlahir, umur, jantina, kategori, status, alamat,
        sejarah_penyakit, jenis_ubatubatan, keadaan_semasa, jenis_alahan, nyatakan_alahan, tempat_rawatan_sebelum_kemasukkan,
        nama_tempat_rawatan_sebelum_kemasukkan, tempat_rawatan_selepas_kemasukkan, nama_tempat_rawatan_selepas_kemasukkan,
        lampin_pakai_buang, diet, saringan_kesihatan_mental, staff_bertugas, nama_waris, hubungan, no_telefon, alamat_waris
    ) VALUES (
        '$tarikh_daftar_masuk', '$nama_penghuni', '$nokadpengenalan', '$tarikhlahir', '$umur', '$jantina', '$kategori',
        '$status', '$alamat', '$sejarah_penyakit', '$jenis_ubatubatan', '$keadaan_semasa', '$jenis_alahan', '$nyatakan_alahan',
        '$tempat_rawatan_sebelum_kemasukkan', '$nama_tempat_rawatan_sebelum_kemasukkan', '$tempat_rawatan_selepas_kemasukkan',
        '$nama_tempat_rawatan_selepas_kemasukkan', '$lampin_pakai_buang', '$diet', '$saringan_kesihatan_mental', '$staff_bertugas',
        '$nama_waris', '$hubungan', '$no_telefon', '$alamat_waris'
    )";

    // Execute the query and check if the record was inserted
    if ($conn->query($sql) === TRUE) {
        echo "New resident data inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Insert Resident Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgba(173, 216, 230, 0.8); /* Soft blue background */
            background-image: url('https://www.healthxchange.sg/sites/hexassets/Assets/seniors/caregiver-tips-to-prevent-falls-in-the-elderly.jpg');
            background-size: cover;
            background-position: center;
            color: black; /* Black font color */
            padding: 20px;
            position: relative;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            margin: 50px auto;
            border-radius: 10px;
            max-width: 400px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="text"], input[type="number"], input[type="date"], select {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .button-link {
            display: inline-block;
            padding: 10px 15px;
            margin: 20px 0;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .button-link:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<h2>Insert Resident Data</h2>

<form method="POST">
    <!-- Input fields for resident data -->

    <input type="date" name="tarikh_daftar_masuk" placeholder="Admission Date" required>

    <input type="text" name="nama_penghuni" placeholder="Resident Name" required>
    <input type="text" name="nokadpengenalan" placeholder="Identification Card No." required>
    <input type="date" name="tarikhlahir" placeholder="Birth Date" required>
    <input type="number" name="umur" placeholder="Age" required>

    <select name="jantina" required>
        <option value="" disabled selected>Select Gender</option>
        <option value="MALE">Male</option>
        <option value="FEMALE">Female</option>
    </select>
    
    <select name="kategori" required>
        <option value="" disabled selected>Select Category</option>
        <option value="ASNAF">Asnaf</option>
        <option value="HEALTHY">Healthy</option>
        <option value="PAID">Paid</option>
        <option value="BEDRIDDEN">Bedridden</option>
    </select>
    
    <select name="status" required>
        <option value="" disabled selected>Select Status</option>
        <option value="BERKAHWIN">Married</option>
        <option value="BUJANG">Single</option>
        <option value="DUDA">Widower</option>
        <option value="JANDA">Widow</option>
    </select>

    <input type="text" name="alamat" placeholder="Address" required>

    <select id="sejarah_penyakit" name="sejarah_penyakit" required>
    <option value="" disabled selected>Medical History</option>
    <option value="hypertension">Hypertension</option>
    <option value="diabetes">Diabetes</option>
    <option value="gout">Gout</option>
    <option value="cholesterol">Cholesterol</option>
</select>

    
    <select name="jenis_ubatubatan" required>
        <option value="" disabled selected>Medicine</option>
        <option value="felodipine">Felodipine</option>
        <option value="glicladine">glicladine</option>
        <option value="allopurinol">Allopurinol</option>
        <option value="simvastatin">Simvastatin</option>
    </select>
    



<select id="keadaan_semasa" name="keadaan_semasa" onchange="this.options[this.selectedIndex].value === 'other' ? document.getElementById('other_input').style.display = 'block' : document.getElementById('other_input').style.display = 'none'">
    <option value="" disabled selected>Current Condition</option>
    <option value="walking">Walking (healthy)</option>
    <option value="not_walking">Not Walking (disabled)</option>
    <option value="other">Other</option>
</select>

<!-- Input for other option -->
<input type="text" id="other_input" name="other_input" placeholder="Specify here..." style="display: none;">


<select id="jenis_alahan" name="jenis_alahan" onchange="handleSelection()">
    <option value="" disabled selected>Type Of Allergy</option>
    <option value="none">None</option>
    <option value="yes">Yes</option>
    <option value="other">Other</option>
</select>

<!-- Input field for specifying the type of allergy for "Yes" -->
<input type="text" id="yes_input" name="yes_input" placeholder="Specify here..." style="display: none;">

<!-- Input field for specifying the type of allergy for "Other" -->
<input type="text" id="other_input" name="other_input" placeholder="Specify here..." style="display: none;">

<script>
function handleSelection() {
    const selectedValue = document.getElementById('jenis_alahan').value;
    const yesInput = document.getElementById('yes_input');
    const otherInput = document.getElementById('other_input');

    // Reset both inputs
    yesInput.style.display = 'none';
    otherInput.style.display = 'none';

    // Show the appropriate input based on the selection
    if (selectedValue === 'yes') {
        yesInput.style.display = 'block';
    } else if (selectedValue === 'other') {
        otherInput.style.display = 'block';
    }
}
</script>



    <select name="tempat_rawatan_sebelum_kemasukkan" required>
    <option value="">Select Type of Pre-Admission Treatment</option>
    <option value="private">PRIVATE</option>
    <option value="goverment">GOVERNMENT</option>
</select>

    <input type="text" name="nama_tempat_rawatan_sebelum_kemasukkan" placeholder="Pre-Admission Treatment Name" required>

   
    <select name="tempat_rawatan_selepas_kemasukkan" required>
    <option value="">Select Type of Post-Admission Treatment </option> 
    <option value="private">PRIVATE</option>
    <option value="goverment">GOVERNMENT</option>
</select>
    

    <input type="text" name="nama_tempat_rawatan_selepas_kemasukkan" placeholder="Post-Admission Treatment Name" required>

    <select name="lampin_pakai_buang" required>
    <option value="">Select Diaper Usage</option>
    <option value="yes">Yes</option>
    <option value="no">No</option>
</select>

    
<select name="diet" required>
        <option value="" disabled selected>Select Diet Type</option>
        <option value="solid">Solid Diet</option>
        <option value="blend">Blended Diet</option>
        <option value="soft">Soft Diet</option>
    </select>

    <select name="saringan_kesihatan_mental" required>
        <option value="" disabled selected>Select Rating Mental Health(1-5)</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
    </select>

    <input type="text" name="staff_bertugas" placeholder="Assigned Staff" required>
    <input type="text" name="nama_waris" placeholder="Next of Kin Name" required>
    <input type="text" name="hubungan" placeholder="Relationship" required>
    <input type="text" name="no_telefon" placeholder="Next of Kin Phone No." required>
    <input type="text" name="alamat_waris" placeholder="Next of Kin Address" required>
    <input type="submit" value="Submit">
</form>
<!-- Button to view all residents -->
<a href="../residentall.php" class="button-link">View Resident List</a>


</body>
</html>