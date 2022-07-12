<?php
    session_start();
    include "koneksi.php";
    if($_SESSION['userweb']==""){
      header("location: login.php");
    }
    $username=$_SESSION['userweb'];
    $idnama=$_GET['kegiatan'];
    $qry = mysqli_query($koneksi, "SELECT * FROM kegiatan WHERE no='$idnama'");
    $data= mysqli_fetch_array($qry);
   
?>



<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/editkegiatan.css?<?php echo time();?>">
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
      <h2>EDIT KEGIATAN</h2>
        <div class="container">
          <form method="POST">
            <table>
              <tr>
                <td>
                  <label id="judulform">TAMBAH KEGIATAN</label>
                </td>      
                </tr>
              <tr>
                <td>      
                  <label>Nama Kegiatan</label><br>
                  <input type="text" name="nama" autocomplete="current-password" required="" value="<?php echo $data['nama'] ;?>"></input>
                </td>
              </tr>
              <tr>
                <td>      
                  <label>Jenis Kegiatan</label><br>
                  <input type="text" name="jenis" autocomplete="current-password" required="" value="<?php echo $data['jenis'] ;?>"></input>
                </td>
              </tr>
              <tr>
                <td>      
                  <label>Tanggal Pelaksanaan</label><br>
                  <input type="date" name="tanggalmulai" autocomplete="current-password" required="" value="<?php echo $data['tanggalmulai'] ;?>"></input>
                  <span>s/d</span>
                  <input type="date" name="tanggalselesai" autocomplete="current-password" required="" value="<?php echo $data['tanggalselesai'] ;?>"></input>
                </td>
              </tr>
              <tr>
                <td>      
                  <label>Deskripsi Kegiatan</label><br>
                  <input type="text" name="deskripsi" autocomplete="current-password" required="" value="<?php echo $data['deskripsi'] ;?>"></input>
                </td>
              </tr>
              <tr>
                <td>      
                  <label>Tambah Tahapan</label><br>
                  <input type="text" name="tahapan" autocomplete="current-password" required="" placeholder="Tambah Tahapan"></input>
                </td>
              </tr>
              <tr>
                <td>
                <a href="overviewkegiatan.php?kegiatan=<?php echo $data['no'];?>"><button type="button" name="cancel">Cancel</button>
                <button type="submit" name="save">Save</button>
                </td>
              </tr>
            </table>
          </form>
        </div>
    </div>
    <script>
    document.querySelector(".right ul li").addEventListener("click", function(){
    this.classList.toggle("active");
    });
</script> 
<?php
    if(isset($_POST['save'])){
      $nama = $_POST['nama'];
      $jenis = $_POST['jenis'];
      $tanggalmulai = $_POST['tanggalmulai'];
      $tanggalselesai = $_POST['tanggalselesai'];
      $deskripsi = $_POST['deskripsi'];
      $save = mysqli_query($koneksi, "UPDATE kegiatan SET nama='$nama',jenis='$jenis',tanggalmulai='$tanggalmulai',tanggalselesai='$tanggalselesai',deskripsi='$deskripsi' WHERE no='$idnama'");
    if ($save){
    ?>
      <script type="text/javascript">
      alert('Update Berhasil');
      document.location.href="kegiatan.php";
    </script>
    <?php
    } else{
      echo"gagal";
    } 
  }  
?>
  </body>
</html>