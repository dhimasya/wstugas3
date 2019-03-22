
<?php
$servername = "localhost";
$username = "id8972136_toor";
$password = "toor001";
$database = "id8972136_rujukan";
// Create connection
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$rows = $conn->query("SELECT id, nama, alamat FROM puskesmas LIMIT 5");
$clinics = array();
if ($rows->num_rows > 0) {
    while($row = $rows->fetch_assoc()) {
        $clinics[] = $row;
    }
}

$rows = $conn->query("SELECT u.id, p.nama as puskesmas, u.token as fcm_token, u.email, u.nama, u.alamat FROM user u LEFT JOIN puskesmas p ON u.id_puskesmas=p.id LIMIT 5");
$users = array();
if ($rows->num_rows > 0) {
    while($row = $rows->fetch_assoc()) {
        $users[] = $row;
    }
}

$rows = $conn->query("SELECT r.kode, r.tanggal, r.nik, r.nama, r.jenis_kelamin, r.usia, r.alamat, r.kondisi, p.nama as puskesmas, u.nama as perawat FROM rujukan r LEFT JOIN user u ON r.id_user=u.id LEFT JOIN puskesmas p ON u.id_puskesmas=p.id LIMIT 5");
$docs = array();
if ($rows->num_rows > 0) {
    while($row = $rows->fetch_assoc()) {
        $docs[] = $row;
    }
}

echo "<pre>";
echo json_encode(array('success' => true, 'message' => 'all data limited to 5', 'perawat' => $users, 'puskesmas' => $clinics, 'rujukan' => $docs), JSON_PRETTY_PRINT);
echo "</pre>";

if ($conn){
    $conn->close();
}
