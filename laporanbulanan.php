<?php
    session_start();
    include "koneksi.php";
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


    $periode ="$_GET[Tahun]-$_GET[Bulan]-";
?>


<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kegiatan</title>
    <link rel="stylesheet" href="css/laporanbulanan.css?<?php echo time();?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  </head>
  <body>
    <div class="sidebar">
      <ul class="nav">
        <li id="dashboard">
          <a href="dashboard.php">
            <i class="bi bi-house-door"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li id="kegiatan">
          <a href="kegiatan.php">
            <i class="bi bi-briefcase"></i>
            <span>Kegiatan</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="bi bi-image"></i>
            <span>Dokumentasi</span>
          </a>
        </li>
        <li id="laporan">
          <a href="laporan.php">
            <i class="bi bi-journal-text"></i>
            <span>Laporan</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="wrapper">
      <div class="navbar">
            <div class="left">
              <img class="logo" src="images/iconnav.svg"/>
            </div>
            <div class="right">
                <ul>
                  <li>
                    <a href="#"> 
                      <p><?php echo $_SESSION['userweb'] ;?></p>
                      <img src="foto/<?php echo $_SESSION["foto"];?>" id="usericon">
                      <i class="bi bi-caret-down-fill" id="dropicon"></i>
                    </a>
                    <div class="dropdown">
                        <ul>
                          <li id="profilebox">
                            <a href="profile.php">
                              <i class="bi bi-person"></i>
                              <span id="textprofile">Profile</span>
                            </a>
                          </li>
                          <li>
                            <a href="logout.php">
                              <i class="bi bi-box-arrow-right"></i>
                              <span id="textsignout">Sign Out</span>
                            </a>
                          </li>
                      </ul>
                    </div> 
                  </li>
              </ul>
            </div>
        </div>
      </div>
    </div>
    <div class="main">
      <h1>DATA LAPORAN BULANAN</h1>
        <div class="container">
          <div class="info">
            <table class="judul">
              <tbody>
                  <th>Jenis Laporan </th>
                  <td>:</td>
                  <td>Laporan Bulanan</td>
                <tr>
                  <th>Alamat</th>
                  <td>:</td>
                  <td>Jln. </td>
                </tr>
                <tr>
                  <th>Bulan Pelaksanaan</th>
                  <td>:</td>
                  <td><?php echo tgl_indo($periode);?></td>
              </tbody>
            </table>
          </div>
          <h2>Laporan Kegiatan</h2>
          <div class="data">
            <table class="data">
              <thead>
                <tr>
                  <th id="th1">No</th>
                  <th id="th2">Nama Kegitan</th>
                  <th id="th3">Waktu Pelaksanaan</th>
                  <th id="th4">Status Kegitan</th>
                  <th id="th5">Reschedule</th>
                  <th id="th6">Alasan Reschedule</th>
                </tr>
              </thead>
              <tbody>
              <?php
                include "koneksi.php";
                $no=0;
                $qry = mysqli_query($koneksi, "SELECT * FROM kegiatan ORDER BY tanggalmulai DESC");
                if (isset($_GET['Bulan']) && isset($_GET['Tahun'])){
                  $qry = mysqli_query($koneksi, "SELECT * FROM kegiatan WHERE tanggalmulai LIKE '%".$_GET['Tahun']."%%-%%".$_GET['Bulan']."%' ORDER BY tanggalmulai ASC");
                }
                while ($data = mysqli_fetch_array($qry)){
                $no++;
                $alasan=$data['alasan'];
                $yesno=$data['alasan'];
                if($yesno>0){
                  $yesno="Ada";
                }else{
                  $yesno="Tidak Ada";
                }
                $tanggal=$data["tanggalmulai"];
                $tanggalawal= date('Y-n-j', strtotime($tanggal));
                $tanggal5= tgl_indo($tanggalawal);
                $jadwal= date('d F Y', strtotime($tanggal));
                echo "
                <tr>
                  <td>$no</td>
                  <td>$data[nama]</td>
                  <td>$tanggal5</td>
                  <td>$data[status]</td>
                  <td>$yesno</td>
                  <td>$alasan</td>
                </tr>
                ";
                }
              ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    <script>
    document.querySelector(".right ul li").addEventListener("click", function(){
    this.classList.toggle("active");
    });
</script> 
  </body>
</html>