<?php
    session_start();
    include "koneksi.php";
    if($_SESSION['userweb']==""){
      header("location: login.php");
    }
    $username=$_SESSION['userweb'];
    
    $qry = mysqli_query($koneksi, "SELECT * FROM kegiatan");
    ($data = mysqli_num_rows($qry));
    
    $qry2 = mysqli_query($koneksi, "SELECT * FROM tahapan");
    ($data2 = mysqli_num_rows($qry2));
?>



<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="css/tambahkegiatan.css?<?php echo time();?>">
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
      <h1>TAMBAH KEGIATAN</h1>
        <h2><span class="sub">Dashboard>Kegiatan></span><span class="subsub">Tambah Kegiatan</span></h2>
        <div class="container">
          <form method="POST" name="add_name" id="add_name">
            <table class="table table-bordered" id="dynamic_field">
              <thead>
                <tr>
                  <th colspan="3">
                    <label id="judulform"><h3>Detail Kegiatan</h3></label>
                  </th> 
                  <th></th>     
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td colspan="3">      
                    <label>Nama Kegiatan</label><br>
                    <input type="text" name="nama" autocomplete="current-password" required="" placeholder="Nama Kegiatan"></input>
                  </td>
                </tr>
                <tr>
                  <td colspan="3">      
                    <label>Jenis Kegiatan</label><br>
                    <input type="text" name="jenis" autocomplete="current-password" required="" placeholder="Jenis Kegiatan"></input>
                  </td>
                </tr>
                <tr>
                  <td colspan="3">      
                    <label> Tanggal Pelaksanaan</label><br>
                    <input id="in1" type="date" name="tanggalmulai" autocomplete="current-password" required="" placeholder="Y-m-d"></input>
                    s/d
                    <input id="in2"type="date" name="tanggalselesai" autocomplete="current-password" required="" placeholder="tanggal"></input>
                  </td>
                </tr>
                <tr>
                  <td colspan="3">      
                    <label>Deskripsi Kegiatan</label><br>
                    <textarea id="des" type="text" name="deskripsi" autocomplete="current-password" required="" placeholder="Deskripsi Kegiatan"></textarea>
                  </td>
                </tr>
                <tr>
                  <td colspan="3">      
                    <label>Tambah Tahapan</label><br>
                    <input type="text" name="tahapan[]" id="tahapan" placeholder="Tambah Tahapan" class="form-control name_list"></input>
                  </td>
                </tr>
              </body>
              <tfoot>
                <tr>
                  <td>
                    <button type="button" name="add" id="add" class="btn btn-success"><i class="bi bi-plus-lg"></i> Add a Line</button>
                  </td>
                </tr>
                <tr class="button">
                  <td colspan="3">
                    <a href="kegiatan.php"><button type="button" id="cancel" name="cancel">Cancel</button></a>
                    <button type="submit" name="submit" id="submit" class="btn btn-info" value="Submit">Save</button>
                  </td>
                </tr>
              </tfoot>
            </table>
          </form>
        </div>
    </div>
    <script>
    $(document).ready(function(){
	var i=1;
	$('#add').click(function(){
		i++;
		$('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="tahapan[]" id="tahapan" placeholder="Tamabah Tahapan" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
	});
	$(document).on('click', '.btn_remove', function(){
		var button_id = $(this).attr("id"); 
		$('#row'+button_id+'').remove();
	});
	
  });
</script>
    <script>
    document.querySelector(".right ul li").addEventListener("click", function(){
    this.classList.toggle("active");
    });
</script> 
<?php
    if(isset($_POST['submit'])){
      $nomor=$data;
      $no=$nomor+1;
      $nomor2=$data2;
      $no2=$nomor2+1;
      $nama = $_POST['nama'];
      $jenis = $_POST['jenis'];
      $tanggalmulai = $_POST['tanggalmulai'];
      $tanggalselesai = $_POST['tanggalselesai'];
      $deskripsi = $_POST['deskripsi'];
      $status="Dalam Proses";
      $save = mysqli_query($koneksi, "INSERT INTO kegiatan (no,nama,jenis,tanggalmulai,tanggalselesai,deskripsi,status) VALUES ('$no','$nama','$jenis','$tanggalmulai','$tanggalselesai','$deskripsi','$status')");
      $number = count($_POST["tahapan"]);
      if($number > 0)
      {
        for($i=0; $i<$number; $i++)
        {
          if(trim($_POST["tahapan"][$i] != ''))
          {
            $noid=$no2+$i;
            $sql = "INSERT INTO tahapan (id,tahapan,idkegiatan) VALUES('$noid','".mysqli_real_escape_string($koneksi, $_POST["tahapan"][$i])."','$no')";
            mysqli_query($koneksi, $sql);
          }
        }
      }
    if ($save> 0){
    ?>
    <script type="text/javascript">
      alert('Update Berhasil');
      document.location.href="kegiatan.php";
    </script>
    <?php
    } else{
      echo"Update Gagal";
    } 
  } 
?>
  </body>
</html>