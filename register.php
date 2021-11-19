<?php
require('koneksi.php');
session_start();
 
$error = '';
$validate = '';

function cek_username($username,$con){
    $username = mysqli_real_escape_string($con, $username);
    $query = "SELECT * FROM tb_users WHERE username = '$username'";
    if( $result = mysqli_query($con, $query) ) return mysqli_num_rows($result);
}

if( isset($_POST['submit']) ){
    $username = mysqli_real_escape_string($con, ($_POST['username']));
    $nama = mysqli_real_escape_string($con, $_POST['nama']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $alamat = mysqli_real_escape_string($con, $_POST['alamat']);
    $no_telepon = mysqli_real_escape_string($con, $_POST['no_telepon']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $ulangi_password = mysqli_real_escape_string($con, $_POST['ulangi_password']);
    if(!empty(trim($nama)) && !empty(trim($username)) && !empty(trim($alamat)) && !empty(trim($no_telepon)) && !empty(trim($email)) && !empty(trim($password)) && !empty(trim($ulangi_password))){
        if($password == $ulangi_password){
            if(cek_username($username,$con) == 0 ){
                $pass  = password_hash($password, PASSWORD_DEFAULT);
                $query = "INSERT INTO tb_users(nama, username, password, email, alamat, no_telepon) VALUES ('$nama','$username','$pass','$email', '$alamat', '$no_telepon')";
                $result   = mysqli_query($con, $query);
                if ($result) {
                    echo "
                        <script> 
                        alert('Regitrasi Berhasil!!, silagkan lakukan login');
                        document.location.href = 'login.php';
                        </script>
                        ";

                } else {
                    $error =  'Register User Gagal !!';
                }
            }else{
                echo "
                <script> 
                    alert('Regitrasi gagal username sudah terdaftar!!');
                    document.location.href = 'register.php';
                </script>
                ";

            }
        }else{
            $validate = 'Password harus sama  !!';
        }
            
    }else {
        $error =  'Data tidak boleh kosong !!';
        
    }
} 
    
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Bootstrap CSS -->
    <title>Register</title>
</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-2 mt-5 ">
           <div class="card shadow">
               <div class="card-header">
                   <h2>Register</h2>
               </div>
               <div class="card-body">
                    <form action="" method ="POST">
                        <div class="form-group">
                            <input type="text" class="form-control" name = "nama" placeholder="nama *" id=""
                                placeholder="Nama Lengkap" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name = "username" placeholder="Username *" id=""
                                placeholder="Username">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name = "email" id="" placeholder="Email *"
                                placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" name = "no_telepon" id="" placeholder="No Telepon *"
                                placeholder="No Telepon">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name = "alamat" id=""
                                placeholder="Alamat *">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name = "password" id=""
                                placeholder="Password *">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="InputRePassword" name="ulangi_password" placeholder="Ulangi Password *">
                            <?php if($validate != '') {?>
                                <p class="text-danger"><?= $validate; ?></p>
                            <?php }?>
                        </div>
                        <div class="text-right">
                            <a href="login.php" class ="btn btn-info">Kembali</a>
                            <input type="submit" name = "submit" class="btn btn-primary"  value="Register"/>
                        </div>
                    </form>
               </div>
           </div>
        </div>
    </div>

</div>				                            
</body>

</html>