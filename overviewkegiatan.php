<?php
    session_start();
    include "koneksi.php";
    if($_SESSION['userweb']==""){
      header("location: login.php");
    }
    $id=$_GET['kegiatan'];
    $qry = mysqli_query($koneksi, "SELECT * FROM kegiatan WHERE no='$id'");
    ($data = mysqli_fetch_array($qry));
    $future=$data['tanggalmulai'];
    $d= new DateTime($future);
    $hitung= $d->diff(new DateTime())->format('%R%a');
    if($hitung>0){
      $hitung=0;
    }
      else{
        $hitung= $hitung*(-2)-(-$hitung);
    }
    
?>


<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/overviewkegiatan.css?<?php echo time();?>">
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
      <h2>OVERVIEW KEGIATAN</h2>
      <P>Ini Halaman overview Kegiatan</P>
        <div class="container">
          <div class="atas">
            <span class="hari"><?php echo $hitung; ?> Hari Lagi !</span>
            <span><h3><?php echo $data['jenis'] ;?></span>
            <span><a href=editkegiatan.php?kegiatan=<?php echo $data['no'];?>><button>Edit</button></a></h3></span>
          </div>
          <span><?php echo $data['nama'] ; echo"   "; ?></span>
          <p><?php echo $data['deskripsi'] ;?></p>
        </div>
    </div>
    <script>
    document.querySelector(".right ul li").addEventListener("click", function(){
    this.classList.toggle("active");
    });
</script> 
  </body>
</html>