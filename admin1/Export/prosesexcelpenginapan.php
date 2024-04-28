<?php
// Buat koneksi ke database
include '../../database/koneksi.php';

// Ambil data dari tabel
$sql = "SELECT * FROM tbl_pespenginapan";
$result = mysqli_query($konek, $sql);
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Buat variabel HTML dengan kode tabel
// Buat variabel HTML dengan kode tabel dan CSS
$html = '<style>
            table {
                border-collapse: collapse;
                width: 100%;
            }
            th, td {
                text-align: left;
                padding: 8px;
                border: 1px solid #ddd;
            }
            th {
                background-color: #f2f2f2;
            }
        </style>
        <table>
            <tr>
                <th> ID </th>
                <th> Kode User </th>
                <th> Nama </th>
                <th> Email </th>
                <th> Alamat </th>
                <th> No Telepon </th>
                <th> Harga Penginapan </th>
                <th> Nama Penginapan </th>
                <th> Jumlah Orang </th>
                <th> Tanggal Pergi </th>
                <th> Tanggal Pulang </th>
                <th> Bank </th>
                <th> Nomor Rekening </th>
                <th> Total Harga </th>
            </tr>';

foreach ($data as $row) {
    $html .= '<tr>
                <td>'.$row['id_pesnip'].'</td>
                <td>'.$row['id_user'].'</td>
                <td>'.$row['nama'].'</td>
                <td>'.$row['email'].'</td>
                <td>'.$row['alamat'].'</td>
                <td>'.$row['no_telepon'].'</td>
                <td>'.$row['harganip'].'</td>
                <td>'.$row['nama_penginapan'].'</td>
                <td>'.$row['jumlah_orang'].'</td>
                <td>'.$row['tgl_pergi'].'</td>
                <td>'.$row['tgl_pulang'].'</td>
                <td>'.$row['bank'].'</td>
                <td>'.$row['no_rek'].'</td>
                <td>'.$row['total_harga'].'</td>
            </tr>';
}
$html .= '</table>';


// Buat nama file
$filename = 'data.xls';

// Set header untuk membuat file Excel
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$filename");

// Tampilkan kode HTML dalam format Excel
echo $html;
exit;
?>
