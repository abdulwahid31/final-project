<h2>Format Tanggal PHP | www.malasngoding.com</h2>
<?php
    session_start();
    include "../koneksi.php";
    if($_SESSION['userweb']==""){
      header("location: login.php");
    }

	function tgl_indo($tanggal2){
		$bulan = array (
			1 =>   'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
		);
		$pecahkan = explode('-', $tanggal2);
		
		// variabel pecahkan 0 = tanggal
		// variabel pecahkan 1 = bulan
		// variabel pecahkan 2 = tahun
	
		return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
		<h2>Format Tanggal PHP | www.malasngoding.com</h2>
		<?php
		$qry = mysqli_query($koneksi, "SELECT * FROM kegiatan ORDER BY tanggalmulai DESC");
		$data = mysqli_fetch_array($qry);
		$tanggal1=$data["tanggalmulai"];
    	$tanggalawal= date('Y-n-j', strtotime($tanggal1));
		
		
		echo tgl_indo($tanggalawal); // 21 Oktober 2017
		

		?>

		<?php

		if($data['alasan']>0){
			echo $data['nama'];
		}else{
			echo $data['alasan']="Haloo";
		}
		?>

</body>
</html>