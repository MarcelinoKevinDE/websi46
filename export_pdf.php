<?php
require 'vendor/autoload.php';
use Dompdf\Dompdf;

$conn = mysqli_connect("localhost", "root", "", "dbakademiksi46");
$query = mysqli_query($conn, "SELECT * FROM tbmahasiswa");

$html = '
<h2 style="text-align:center;">Data Mahasiswa</h2>
<table border="1" cellpadding="5" cellspacing="0" width="100%">
<tr>
  <th>No</th><th>NIM</th><th>Nama</th><th>Kelas</th><th>Prodi</th><th>Alamat</th><th>No HP</th><th>Email</th><th>JKL</th>
</tr>';

$i = 1;
while ($m = mysqli_fetch_assoc($query)) {
  $jkl = $m['jkl'] == 'l' ? 'Laki-laki' : 'Perempuan';
  $html .= "<tr>
    <td>$i</td>
    <td>{$m['nim']}</td>
    <td>{$m['nama']}</td>
    <td>{$m['kelas']}</td>
    <td>{$m['prodi']}</td>
    <td>{$m['alamat']}</td>
    <td>{$m['nohp']}</td>
    <td>{$m['email']}</td>
    <td>$jkl</td>
  </tr>";
  $i++;
}
$html .= '</table>';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();

ob_end_clean();

$dompdf->stream("data_mahasiswa.pdf", ["Attachment" => 1]);
exit;
?>
