<?php
require('koneksi.php');
session_start();
 
$error = ''; $validate = '';
if( isset($_SESSION['username']) ) header('Location: login.php');
if( isset($_POST['submit']) ){
        
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        
        if(!empty(trim($username)) && !empty(trim($password))){
 
            $query      = "SELECT * FROM tb_users WHERE username = '$username'";
            $hasil     = mysqli_query($con, $query);

            if(!$hasil){
                $error =  'Username tidak ditemukan !!';
            }
            $baris       = mysqli_num_rows($hasil);
          
            if ($baris != 0) {
                $hash   = mysqli_fetch_assoc($hasil)['password'];
                if(password_verify($password, $hash)){
                    $_SESSION['username'] = $username;
                    echo "
                    <script> 
                        alert('Login Berhasil dilakukan!!');
                        document.location.href = 'instansi.php';
                        </script>
                    ";
                }
            } else {
                $error =  'Username dan password Salah !!';
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
    <title>Login</title>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-3 pt-5 mt-5">
            <div class="card shadow">
                <div class="card-header">
                    <center><h2>Login</h2></center>
                </div>
                
                <div class="card-body">
                    <?php if(isset($_SESSION['msg'])){ ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            Anda Belumm Login !!!
                            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>
                    <?php if($error != ''){ ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <?= $error; ?>
                            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>
                        <form action="login.php" method = "post">
                            <div class="row px-3"> 
                                <label class="mb-1"><h6 class="mb-0 text-sm">Username</h6></label> 
                                <input type="text" name="username" placeholder="Username" class ="form-control mb-4"> </div>
                            <div class="row px-3"> 
                                <label class="mb-1">
                                <h6 class="mb-0 text-sm">Password</h6>
                                </label> <input type="password" name="password" placeholder="Enter password" class ="form-control"> 
                            </div>
                        
                            <div class="row mb-3 px-3 mt-5"> 
                                <input type="submit" name = "submit" class = "btn btn-primary text-center" value = "Log In"></input>
                            </div>
                            <div class="row mb-4 px-3"> 
                            <small class="font-weight-bold">Don't have an account? <a href = "register.php" class="text-danger ">Register</a></small> </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>