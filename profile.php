<?php
    session_start();
    include "koneksi.php";
    if($_SESSION['userweb']==""){
      header("location: login.php");
    }
    $username=$_SESSION['userweb'];
    $qry = mysqli_query($koneksi, "SELECT * FROM profile WHERE username='$username'");
    $result = $qry;
?>

<?php
if(mysqli_num_rows($result)>0){
  $data_user = mysqli_fetch_array($result);
  $_SESSION["nama"]=$data_user["username"];
  $_SESSION["nomor"]=$data_user["nomor"];
  $_SESSION["alamat"]=$data_user["alamat"];
  $_SESSION["email"]=$data_user["email"];
  $_SESSION["password"]=$data_user["password"];
  $_SESSION["foto"]=$data_user["foto"];
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile</title>
    <link rel="stylesheet" href="css/profile.css?<?php echo time();?>">
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
        <li>
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
                            <a href="#">
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
      <h2>PROFILE</h2>
      <div class="container">
        <div class="atas">
          <p>UPDATE PROFILE</p>
        </div>
            <form method="post" action"" enctype="multipart/form-data">
            <div class="tengah">  
              <div class="kiri">
                <label>Nama</label>
                <input type="text" name="fnama" autocomplete="current-password" required="" value="<?php echo $_SESSION["nama"];?>"></input>
                <label>No HP</label>
                <input type="text" onkeypress="return event.charCode >= 48 && event.charCode <=57" name="fnomor" autocomplete="current-password" required="" value="<?php echo $_SESSION["nomor"];?>"></input>
                <label>Alamat</label>
                <input type="text" name="falamat" value="<?php echo $_SESSION["alamat"];?>"></input>
              </div>
              <div class="kanan">
                <label>Email</label>
                <input type="text" name="femail" autocomplete="current-password" required="" value="<?php echo $_SESSION["email"];?>"></input>
                <label>Ubah Password</label>
                <input type="password" name="fpassword" autocomplete="current-password" required="" id="id_password" value="<?php echo $_SESSION["password"];?>">
                <span>
                  <i id="togglePassword" class="far fa-eye"></i>
                </span>
                </input>
                <div class="foto">
                <label>Foto Profile</label>
                <input type="file" name="ffoto" ></input>
                <img src="foto/<?php echo $_SESSION["foto"];?>" width="40px">  
              </div>
              </div>
            </div>
          <div class="bawah">
              <button type="submit" name="update">Update</button>
          </div>
          </form>
      </div>
    </div>
    <script>
        const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#id_password');

  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
    </script>
    <script>
    document.querySelector(".right ul li").addEventListener("click", function(){
    this.classList.toggle("active");
    });
</script> 
<?php
    if(isset($_POST['update'])){
      $nama = $_POST['fnama'];
      $nomor = $_POST['fnomor'];
      $alamat = $_POST['falamat'];
      $email = $_POST['femail'];
      $password = $_POST['fpassword'];
      $foto = $_POST['ffoto'];
      $folder = 'foto/';
      $name = $_FILES['ffoto']['name'];
      $sumber = $_FILES['ffoto']['tmp_name'];
      move_uploaded_file($sumber, $folder.$name);
      $update = mysqli_query($koneksi, "UPDATE profile SET username='$nama',nomor='$nomor',alamat='$alamat',email='$email',password='$password',foto='$name'WHERE username='$username'");
    if ($update){
      ?>
    <script type="text/javascript">
      alert('Update Berhasil');
      document.location.href="profile.php";
    </script>
    <?php
    } else{
      echo"gagal";
    }
  }
?>
  </body>
</html>