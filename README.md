 window.location.href="overviewkegiatan.php?kegiatan="+no+"&status="value"";
  
  if(isset($_GET['kegiatan']) && isset($_GET['status'])){
      $id = $_GET['kegiatan'];
      $status =$_GET['status'];
      mysqli_query($koneksi, "UPDATE kegiatan SET status='$status' WHERE no='$id'");
      header("location: overviewkegiatan.php?kegiatan=$id");
      die();
    }


     $qry5 = mysqli_query($koneksi, "SELECT * FROM kegiatan WHERE tanggalmulai>=now() ORDER BY tanggalmulai ASC");


       $qry5 = mysqli_query($koneksi, "SELECT * FROM kegiatan WHERE tanggalmulai>=now() ORDER BY tanggalmulai ASC LIMIT 4");
    if (mysqli_num_rows($qry5)<1){
      $data5 = mysqli_fetch_array($qry5);
      $text5="";
      $data5['tanggalmulai']=$text5;
      $data5['status']=$text5;
      $data5['nama']=$text5;
      $waktu1=$text5;
    }else{
      $data5 = mysqli_fetch_array($qry5);
      $waktu=$data5["tanggalmulai"];
      $waktu1= date('d F Y', strtotime($waktu));

    }

    $tanggal1=$data5["tanggalmulai"];
    $tanggalawal= date('d F Y', strtotime($tanggal1));
    $text="Hari Lagi";
    $future=$data5['tanggalmulai'];
    $d= new DateTime($future);
    $hitung= $d->diff(new DateTime())->format('%R%a');
    $rumus=($hitung*(-2))-(-$hitung);
    if($hitung>=0){
      $hitung=$data5['status'];
    }
      else{
        $hitung=  "$rumus  $text";
    }



    	$('#submit').click(function(){		
		$.ajax({
			url:"name.php",
			method:"POST",
			data:$('#add_name').serialize(),
			success:function(data)
			{
				alert(data);
				$('#add_name')[0].reset();
			}
		});
	});