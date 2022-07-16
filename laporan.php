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
?>


<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Laporan</title>
    <link rel="stylesheet" href="css/laporan.css?<?php echo time();?>">
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
      <h1>LAPORAN</h1>
      <h2><span class="sub">Dashboard></span><span class="subsub">Laporan</span></h2>
        <div class="container">
          <div class="nav">
            <form method="GET" action="laporanbulanan.php">
              <div class="judul">
                <label>Masukan Periode Pelaksanaan Kegiatan</label>
              </div>
              <div class="isi">
                <select name="Bulan" id="bulan">
                    <option id="option1" Value="01">Januari</option>
                    <option id="option1" Value="02">Februari</option>
                    <option id="option1" Value="03">Maret</option>
                    <option id="option1" Value="04">April</option>
                    <option id="option1" Value="05">Mei</option>
                    <option id="option1" Value="06">Juni</option>
                    <option id="option1" Value="07">Juli</option>
                    <option id="option1" Value="08">Agustus</option>
                    <option id="option1" Value="09">September</option>
                    <option id="option1" Value="10">Oktober</option>
                    <option id="option1" Value="11">November</option>
                    <option id="option1" Value="12">Desember</option>
                </select>
                <select name="Tahun" id="tahun">
                  <?php
                    $qry10 = mysqli_query($koneksi, "SELECT * FROM kegiatan ORDER BY tanggalmulai DESC");
                    $data10 = mysqli_fetch_array($qry10);
                    $tanggal10= $data10['tanggalmulai'];
                    $tahunakhir= date('Y', strtotime($tanggal10));
                    $tahunawal=2022;
                    $tahun10=$tahunakhir-$tahunawal;
                    for ($i=0; $i<=$tahun10; $i++){
                      $tahun=$tahunawal+$i;
                    echo"
                      <option value=$tahun>$tahun</option>
                    ";
                    }
                      ?>
                </select>
              </div>
              <div class="tombol">
              <button type="submit" id="tomboltampil">Tampilkan</button>
              </div>
            </form>
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