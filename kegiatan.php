<?php
    session_start();
    include "koneksi.php";
    if($_SESSION['userweb']==""){
      header("location: login.php");
    }
?>


<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kegiatan</title>
    <link rel="stylesheet" href="css/kegiatan.css?<?php echo time();?>">
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
        <li>
          <a href="#">
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
      <h1>KEGIATAN</h1>
      <h2><span class="sub">Dashboard></span><span class="subsub">Kegiatan</span></h2>
        <div class="container">
          <div class="nav">
            <i class="bi bi-search" id="search"><form><input type="search"></input></form></i>
            <a href="tambahkegiatan.php">
              <button type="button" class="button" id="tambah">
                <span class="button_icon">
                <i class="bi bi-plus"></i>
                </span>
                <span class="button_text">Tambah Kegiatan</span>
              </button>
            </a>
          </div>
          <table>
            <thead>
              <tr>
                <th>Tanggal</th>
                <th>Jenis Kegiatan</th>
                <th>Nama Kegiatan</th>
                <th>Status</th>
                <th><i class='bi bi-three-dots'></i></th>
              </tr>
            </thead>
            <tbody>
            <?php
              include "koneksi.php";
              $qry = mysqli_query($koneksi, "SELECT * FROM kegiatan ORDER BY tanggalmulai DESC");
              while ($data = mysqli_fetch_array($qry)){
              $tanggal=$data["tanggalmulai"];
              $jadwal= date('d F Y', strtotime($tanggal));
              $statuswarna=$data['status'];
              if ($statuswarna=="Dalam Proses"){
              $statuswarna="#FD9F00";
              } else if($statuswarna=="Ditunda"){
              $statuswarna="#777777";
              } else
              $statuswarna="#6DAE43";
              echo "
              <tr>
                <td>$jadwal</td>
                <td>$data[jenis]</td>
                <td>$data[nama]</td>
                <td><i class='bi bi-circle-fill' id='statuswarna' style='color: $statuswarna' ></i>$data[status]</td>
                <td><a href=overviewkegiatan.php?kegiatan=$data[no]><i class='bi bi-three-dots'></i></a></td>
              </tr>
              ";
              }
            ?>
            </tbody>
          </table>
        </div>
      </div>
    <script>
    document.querySelector(".right ul li").addEventListener("click", function(){
    this.classList.toggle("active");
    });
</script> 
  </body>
</html>