<h1 class="page-header">Konfirmasi</h1>
<?php

$this_day = date("d");
$sql = "SELECT*FROM data_absen NATURAL LEFT JOIN tanggal WHERE nama_tgl='$this_day' AND id_user='$_SESSION[id]'";
$query_tday = $conn->query($sql);

// Notifikasi Absen
	if (isset($_GET['ab'])) {
		if ($_GET['ab']==1) {
			echo "<div class='alert alert-warning'><strong>Terimakasih, Konfirmasi berhasil.</strong></div>";
		} elseif($_GET['ab']==2) {
			echo "<div class='alert alert-danger'><strong>Maaf, Konfirmasi Gagal. Silahkan Coba Kembali!</strong></div>";
		}
	}
echo "<div class='table-responsive'>
           <table class='table table-striped'>
            <thead>
               <tr>
                <th>Status</th>
                <th>Keterangan</th>
                <th>Pengambilan Mobil</th>
                <th>Pengembalian Mobil</th>
               </tr>
            </thead>
            <tbody>";

if ($query_tday->num_rows==0) {
       $status='./lib/img/warning.png';
       $message = "Anda Belum Mengisi Konfirmasi";
       $disable_in = "";
       $disable_out = " disabled='disabled'";
} else {
	   
       $disable_in = " disabled='disabled'";
       
       $get_day= $query_tday->fetch_assoc();
       $conn->close();
       
       if ($get_day['jam_klr']!=="") {
       		$status='./lib/img/complete.png';
       		$message = " Konfirmasi selesai! Terimakasih.";
       		$disable_out = " disabled='disable'";
       } else {
       		$status='./lib/img/minus.png';
       		$message = "Konfirmasi Pengambilan Selesai. Jangan Lupa Konfirmasi Pengembalian !";
       		$disable_out = "";
       }
}
echo 	"<tr>
        <td><img src='$status' width='30px'/></td>
        <td><h5>$message</h5></td>
        <td><button type='button' class='btn btn-warning' onclick=\"window.location.href='./model/proses.php?absen=1';\" $disable_in>Pengambilan Mobil</button></td>
        <td><button type='button' class='btn btn-danger' onclick=\"window.location.href='./model/proses.php?absen=2';\" $disable_out>Pengembalian Mobil</button></td>
        </tr>";
echo "</table></div>";
?>