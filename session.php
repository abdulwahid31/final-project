<?php
   $koneksi = mysqli_connect("localhost","root","","input");
    session_start();
    $user_check=$_SESSION['userweb'];
    $ses_sql=mysql_query("select username from login where username='$usercheck', $koneksi");
    $row = mysql_fetch_assoc($ses_sql);
    $login_session =$row['username'];

    if(!isset($login_session)){
        mysql_close($koneksi);
        header('location: login.php');
    }
?>