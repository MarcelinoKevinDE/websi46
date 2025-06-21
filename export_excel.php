<?php
$conn = mysqli_connect("localhost", "root", "", "dbakademiksi46");

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=data_mahasiswa.xls");

echo "<table border='1'>
<tr>
  <th>No</th><th>NIM</th><th>Nama</th><th>Kelas</th><th>Prodi</th><th>Alamat</th><th>No HP</th><th>Email</th><th>JKL</th>
</tr>";

$i = 1;
$result = mysqli_query($conn, "SELECT * FROM tbmahasiswa");
while ($m = mysqli_fetch_assoc($result)) {
  echo "<tr>
    <td>$i</td>
    <td>{$m['nim']}</td>
    <td>{$m['nama']}</td>
    <td>{$m['kelas']}</td>
    <td>{$m['prodi']}</td>
    <td>{$m['alamat']}</td>
    <td>{$m['nohp']}</td>
    <td>{$m['email']}</td>
    <td>" . ($m['jkl'] == 'l' ? 'Laki-laki' : 'Perempuan') . "</td>
  </tr>";
  $i++;
}
echo "</table>";
?>
