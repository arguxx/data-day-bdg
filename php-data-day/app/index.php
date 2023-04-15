<?php
$servername = "dataday";
$username = "user";
$password = "test";
$dbname = "mydb";

// Membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Memeriksa koneksi
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Mendapatkan data dari database
$sql = "SELECT * FROM user";
$result = mysqli_query($conn, $sql);

// Menampilkan data dalam tabel
if (mysqli_num_rows($result) > 0) {
    echo "<table><tr><th>ID</th><th>Nama</th><th>Email</th></tr>";
    // Output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["email"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

// Form untuk memperbarui data
echo "<form method='post'>";
echo "<label for='id'>ID:</label>";
echo "<input type='text' name='id'><br><br>";
echo "<label for='name'>Nama:</label>";
echo "<input type='text' name='name'><br><br>";
echo "<label for='email'>Email:</label>";
echo "<input type='text' name='email'><br><br>";
echo "<input type='submit' value='Update'>";
echo "</form>";

// Memperbarui data jika formulir dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];

    $sql = "UPDATE user SET name='$name', email='$email' WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        echo "Data berhasil diperbarui";
    } else {
        echo "Error updating data: " . mysqli_error($conn);
    }
}

// Menutup koneksi
mysqli_close($conn);
?>
