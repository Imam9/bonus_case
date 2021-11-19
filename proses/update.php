<?php 

require('../koneksi.php');
session_start();


if( !isset($_SESSION['username']) ){
  $_SESSION['msg'] = 'Anda di wajibkan Login';
  header('Location: login.php');
}

if(isset($_POST['update'])){
    $id_instansi =  mysqli_real_escape_string($con, $_POST['id_instansi']);
    $instansi =  mysqli_real_escape_string($con, $_POST['instansi']);
    $deskripsi = mysqli_real_escape_string($con, $_POST['deskripsi']);

    // var_dump($deskripsi);
    // die();

    $query = "UPDATE `tb_instansi` SET 
                `instansi`='".$instansi."',
                `deskripsi`='".$deskripsi."'
                WHERE id_instansi = '".$id_instansi."'";

    $sql = mysqli_query($con, $query); 
    if($sql){ 
        echo "<script> 
                alert('Data berhasil Di Update!');
                document.location.href = '../instansi.php';
            </script>
        ";
    }else{
    echo "<script> 
                alert('Gagal update dalam database!');
                document.location.href = '../instansi.php';
            </script>
        ";
    }
}


?>