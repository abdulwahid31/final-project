<?php
    session_start();
    include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css?<?php echo time();?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <title>Halaman Login</title>
</head>
<body>
    <div class="container">
        <h1>
        <img src="images/imglogin.jpg" style="width: 120px;border-radius: 10px;"/>
        </h1>
            <form method="post">
                <label>Username</label>
                <input type="text" name="fusername" autofocus="" autocapitalize="none" autocomplete="username" required="" id="id_username"placeholder="Username">
                </input>
                <br>
                <br>
                <label>Password</label>
                <input type="password" name="fpassword" autocomplete="current-password" required="" id="id_password"placeholder="Password">
                    <span>
                        <i id="togglePassword" class="far fa-eye"></i>
                    </span>
                </input>
                <button type="submit" name="fmasuk">Masuk</button>
            </form>
        <h2>
        Lupa Password?
        <a href="https://google.com">klik disini</a>
        </h2>
        
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

        <?php
        if (isset($_POST['fmasuk'])) {
            $username = $_POST['fusername'];
            $password = $_POST['fpassword'];
            $qry = mysqli_query($koneksi,"SELECT * FROM profile WHERE username = '$username' AND password = '$password'");
            $cek = mysqli_num_rows($qry);
            if ($cek==1) {
                $_SESSION['userweb']=$username;
                header ("location: dashboard.php");
                exit;
            }
            else{
                echo "<center><font color= red>Maaf username atau password anda salah !</font></center>";
            }
        }
        ?>
    </div>
    </body>
</html>