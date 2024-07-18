<?php 
session_start();

if (isset($_SESSION['Admin'])) {
    // Replace 'your_db_host', 'your_db_name', 'your_db_user', and 'your_db_password' with your actual database credentials
    $dsn = "mysql:host=localhost;dbname=listrik_taufik";
    $username = "root";
    $password = "";

    try {
        // Initialize and establish the PDO database connection
        $pdo = new PDO($dsn, $username, $password);

        // Set PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $kode = $_GET['kode'];

        // Prepare the DELETE query using a prepared statement to prevent SQL injection
        $query = "DELETE FROM tblogin WHERE KodeLogin = :kode";
        $stmt = $pdo->prepare($query);

        // Bind the value of $kode to the prepared statement
        $stmt->bindParam(':kode', $kode, PDO::PARAM_STR);

        // Execute the prepared statement
        if ($stmt->execute()) {
            echo "<script>
            alert('Data Berhasil Dihapus');
            location.href='tampil-petugas.php';
            </script>";
        } else {
            echo "<script>
            alert('Data GAGAL Dihapus');
            location.href='tampil-petugas.php';
            </script>";
        }
    } catch (PDOException $e) {
        echo "<script>
        alert('Error: ' . " . $e->getMessage() . ");
        location.href='tampil-petugas.php';
        </script>";
    }
} else {
    echo "<script>
    alert('Anda Tidak Boleh Masuk');
    location.href='../home.php';
    </script>";
}
?>