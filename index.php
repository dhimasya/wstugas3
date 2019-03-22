<?php
$servername = "localhost";
$username = "id8972136_root";
$password = "root001";
$database = "id8972136_akademik";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$customers = $conn->query("SELECT * FROM customer");
echo "<style>table, tr, td, th{ border: 1px solid #ddd; border-collapse: collapse; padding: 4px}</style>";
echo "<table><tr><th>Nama</th><th>Jenis Kelamin</th><th>Alamat</th></th>";
if ($customers->num_rows > 0) {
    while($row = $customers->fetch_assoc()) {
        echo "<tr><td>$row[nama]</td><td>$row[gender]</td><td>$row[alamat]</td></tr>";
    }
}
echo "</table><br/>";

$mahasiswas = $conn->query("SELECT * FROM mahasiswa");
echo "<table><tr><th>NIM</th><th>Nama</th><th>Prodi</th></th>";
if ($mahasiswas->num_rows > 0) {
    while($row = $mahasiswas->fetch_assoc()) {
        echo "<tr><td>$row[nim]</td><td>$row[nama]</td><td>$row[prodi]</td></tr>";
    }
}
echo "</table><br/>";

$rows = $conn->query("SELECT n.thakd,n.nim,n.kdmk,n.nilai,m.nama,m.prodi,mk.nmmk,mk.sks FROM nilai n LEFT JOIN mahasiswa m ON n.nim=m.nim LEFT JOIN matakuliah mk ON n.kdmk=mk.kdmk WHERE m.nama IS NOT NULL AND mk.nmmk IS NOT NULL");
echo "<table><tr><th>TH</th><th>NIM</th><th>Nama</th><th>Prodi</th><th>Makul</th><th>SKS</th><th>Nilai</th></th>";
if ($rows->num_rows > 0) {
    while($row = $rows->fetch_assoc()) {
        echo "<tr><td>$row[thakd]</td><td>$row[nim]</td><td>$row[nama]</td><td>$row[prodi]</td><td>$row[nmmk]</td><td>$row[sks]</td><td>$row[nilai]</td></tr>";
    }
}
echo "</table>";

if ($conn){
    $conn->close();
}
