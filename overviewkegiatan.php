<?php
    session_start();
    include "koneksi.php";
    if($_SESSION['userweb']==""){
      header("location: login.php");
    }
    $id=$_GET['kegiatan'];
    $qry = mysqli_query($koneksi, "SELECT * FROM kegiatan WHERE no='$id'");
    ($data = mysqli_fetch_array($qry));
    $statuswarna=$data['status'];
    if ($statuswarna=="Dalam Proses"){
      $statuswarna="#FD9F00";
    } else if($statuswarna=="Ditunda"){
      $statuswarna="#777777";
    } else
      $statuswarna="#6DAE43";

    
    $tanggal1=$data["tanggalmulai"];
    $tanggalawal= date('d F Y', strtotime($tanggal1));

    $tanggal2=$data["tanggalselesai"];
    $tanggalakhir= date('d F Y', strtotime($tanggal2));
    $text="Hari Lagi";
    $future=$data['tanggalmulai'];
    $d= new DateTime($future);
    $hitung= $d->diff(new DateTime())->format('%R%a');
    $rumus=($hitung*(-2))-(-$hitung);
    if($hitung>=0){
      $hitung=$data['status'];
    }
      else{
        $hitung=  "$rumus  $text";
    }

    if(isset($_GET['kegiatan']) && isset($_GET['status'])){
      $id = $_GET['kegiatan'];
      $status =$_GET['status'];
      mysqli_query($koneksi, "UPDATE kegiatan SET status='$status' WHERE no='$id'");
      header("location: overviewkegiatan.php?kegiatan=$id");
      die();
    }
    
    if(isset($_GET['kegiatan']) && isset($_GET['tahapan'])){
      $id2 = $_GET['tahapan'];
      $idkegiatan2 =$_GET['kegiatan'];
      mysqli_query($koneksi, "DELETE FROM tahapan WHERE id='$id2'");
      header("location: overviewkegiatan.php?kegiatan=$idkegiatan2");
      die();
    }

    $qry2 = mysqli_query($koneksi, "SELECT * FROM tahapan");
    ($data2 = mysqli_num_rows($qry2));
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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  
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
      <h1>OVERVIEW KEGIATAN</h1>
      <h2><span class="sub">Dashboard>Kegiatan></span><span class="subsub">Overview</span></h2>
        <div class="container">
          <div class="atas">
            <div class="kiri">
              <span class="hari"><?php echo $hitung ; ?></span><br>
              <span><h3><?php echo $data['jenis'] ;?></h3></span>
              <span class="nama"><h4><?php echo $data['nama'] ;?><hr><div class="sub"><?php echo $tanggalawal; echo " s/d "; echo $tanggalakhir;?></div></h4></span>
            </div>
            <div class="kanan">
              <span class="edit"><a href="#popup1"><button>Edit</button></a></span>
              <span>
                <select onchange="status_update(this.options[this.selectedIndex].value,'<?php echo $data['no']; ?>')" style= background-color:<?php echo $statuswarna;?>>
                  <option Value="Proses" id="data1"><?php echo $data['status'];?></option>
                  <option id="option1" Value="Dalam Proses">Dalam Proses</option>
                  <option id="option2" Value="Ditunda">Ditunda</option>
                  <option id="option3" Value="Selesai">Selesai</option>
                </select>
              </span><br>
              <span class="Reschedule"><a href="#popup2"><button>Ajukan Reschedule</button></a></span>
            </div>
          </div>
          <div class="isi">
          <label>Deskripsi Kegiatan</label>
          <p><?php echo $data['deskripsi'] ;?></p>
          </div>

          <table>
            <thead>
              <tr>
                <th>Tahapan</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            <?php
              include "koneksi.php";
              $qry = mysqli_query($koneksi, "SELECT * FROM tahapan WHERE idkegiatan='$id'");
              while ($data8 = mysqli_fetch_array($qry)){
              echo "
              <tr>
                <td>$data8[tahapan]</td>
                <td><a href=overviewkegiatan.php?kegiatan=$data8[idkegiatan]&tahapan=$data8[id]><i class='bi bi-trash'></i></a></td>
              </tr>
              ";
              }
            ?>
    
            </tbody>
          </table>
        </div>

       
  

      <div class="popup1" id="popup1">
        <div class="content">
          <form method="POST" name="add_name" id="add_name">
            <table class="table table-bordered" id="dynamic_field">
              <thead>
                <tr>
                  <th>
                    <div class="judulatas">
                      <div class="kiri">
                        <label id="judulform">EDIT KEGIATAN</label>
                      </div>
                      <div class="kanan">
                        <a href="#" class="close">&times;<a/>
                      </div>
                    </div>
                  </th>      
                </tr>
              </thead>
              <tbody>
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
                    <label>Deskripsi Kegiatan</label><br>
                    <textarea id="des" type="text" name="deskripsi" autocomplete="current-password" required="" "><?php echo $data['deskripsi'] ;?></textarea>
                  </td>
                </tr>
                <tr>
                  <td>      
                    <label>Tambah Tahapan</label><br>
                    <input type="text" name="tahapan[]" id="tahapan" placeholder="Tambah Tahapan" class="form-control name_list"></input>
                  </td>
                </tr>
              </tbody>
              <tadd>
                <tr>
                  <td>
                    <button type="button" name="add" id="add" class="btn btn-success"><i class="bi bi-plus-lg"></i> Add a Line</button>
                  </td>
                </tr>
            </tadd>
              <tfoot>
                <tr>
                  <td>
                  <a href="#" class="close"><button type="button" name="cancel" id="cancel">Cancel</button></a>
                  <button type="submit" name="submit" id="submit" class="btn btn-info" value="Submit">Save</button>
                  </td>
                </tr>
              </tfoot> 
            </table>
          </form>
        </div>
      </div>
      <div class="popup2" id="popup2">
        <div class="content">
          <form method="POST">
            <table>
              <thead>
                <tr>
                  <th>
                    <label id="judulform">RE-SCHECDULE</label>
                    <a href="#" class="close">&times;<a/>
                  </th>      
                </tr>
              </thead>
              </tbody>
                <tr>
                  <td>      
                    <label>Tanggal Pelaksanaan</label><br>
                    <input type="date" name="tanggalmulai2" autocomplete="current-password" required="" value="<?php echo $data['tanggalmulai'] ;?>"></input>
                    <span>s/d</span>
                    <input type="date" name="tanggalselesai2" autocomplete="current-password" required="" value="<?php echo $data['tanggalselesai'] ;?>"></input>
                  </td>
                </tr>
                <tr>
                  <td>      
                    <label>Alasan Reschedule</label><br>
                    <textarea id="des2" type="text" name="alasan" autocomplete="current-password" required="" "><?php echo $data['alasan'] ;?></textarea>
                  </td>
                </tr>
              <tfoot>  
                <tr>
                  <td>
                  <a href="#" class="close"><button type="button" name="cancel" id="cancel">Cancel</button></a>
                  <button type="submit" name="save2" id="submit">Save</button>
                  </td>
                </tr>
              </tfoot> 
            </table>
          </form>
        </div>
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
      $nomor2=$data2;
      $no2=$nomor2+1;
      $nama = $_POST['nama'];
      $jenis = $_POST['jenis'];
      $deskripsi = $_POST['deskripsi'];
      $save = mysqli_query($koneksi, "UPDATE kegiatan SET nama='$nama',jenis='$jenis',deskripsi='$deskripsi' WHERE no='$id'");
      $number = count($_POST["tahapan"]);
      if($number > 0)
      {
        for($i=0; $i<$number; $i++)
        {
          if(trim($_POST["tahapan"][$i] != ''))
          {
            $noid=$no2+$i;
            $sql = "INSERT INTO tahapan (id,tahapan,idkegiatan) VALUES('$noid','".mysqli_real_escape_string($koneksi, $_POST["tahapan"][$i])."','$id')";
            mysqli_query($koneksi, $sql);
          }
        }
      }
    if ($save> 0 ){
    ?>
    <script type="text/javascript">
      alert('Update Berhasil');
      document.location.href="overviewkegiatan.php?kegiatan=<?php echo $data['no'];?>";
    </script>
    <?php
    } else{
      echo"Update Gagal";
    } 
  } 
?>
    <?php
    if(isset($_POST['save2'])){
      $tanggalmulai = $_POST['tanggalmulai2'];
      $tanggalselesai = $_POST['tanggalselesai2'];
      $alasan = $_POST['alasan'];
      $save = mysqli_query($koneksi, "UPDATE kegiatan SET tanggalmulai='$tanggalmulai',tanggalselesai='$tanggalselesai',alasan='$alasan' WHERE no='$id'");
    if ($save){
    ?>
    <script type="text/javascript">
      alert('Update Berhasil');
      document.location.href="overviewkegiatan.php?kegiatan=<?php echo $data['no'];?>";
    </script>
    <?php
    } else{
      echo"gagal";
    } 
  } 
?>
  <script type="text/javascript">
    function status_update(value,no){
      //alert(value);
      let url="overviewkegiatan.php?"
      window.location.href= url +"kegiatan="+no+"&status="+value;
    }
  </script>
  </body>
</html>