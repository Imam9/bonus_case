<?php 

require('../koneksi.php');
session_start();

if( !isset($_SESSION['username']) ){
  $_SESSION['msg'] = 'Anda di wajibkan Login';
  header('Location: login.php');
}

if(isset($_POST['delete'])){
    $id_instansi =  mysqli_real_escape_string($con, $_POST['id_instansi']);
    $query = "DELETE FROM `tb_instansi` 
            WHERE id_instansi = '".$id_instansi."'";

    $sql = mysqli_query($con, $query); 
    if($sql){
        echo "<script> 
                alert('Data berhasil di hapus!');
                document.location.href = '../instansi.php';
            </script>
        ";
    }else{
    echo "<script> 
                alert('Gagal di hapus dalam database!');
                document.location.href = '../instansi.php';
            </script>
        ";
    }
}
?>