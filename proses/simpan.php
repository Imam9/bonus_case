<?php

require('../koneksi.php');
session_start();

if( !isset($_SESSION['username']) ){
  $_SESSION['msg'] = 'Anda di wajibkan Login';
  header('Location: login.php');
}

if(isset($_POST['simpan'])){
    $instansi =  mysqli_real_escape_string($con, $_POST['instansi']);
    $deskripsi = mysqli_real_escape_string($con, $_POST['deskripsi']);


    if(!empty(trim($instansi)) && !empty(trim($deskripsi))){ 
        $query = "INSERT INTO `tb_instansi` (`instansi`, `deskripsi`) VALUES ('".$instansi."', '".$deskripsi."');";
   
        $sql = mysqli_query($con, $query); 
        if($sql){ 
            echo "<script> 
                    alert('Data Berhasil di simpan');
                    document.location.href = '../instansi.php';
                </script>
            ";
        }else{
        echo "<script> 
                    alert('Gagal disimpan');
                    document.location.href = '../instansi.php';
                </script>
            ";
        }
    }else{
        echo "<script> 
                alert('data tidak boleh kosong');
                document.location.href = '../instansi.php';
            </script>
        ";
    }
}
