<?php

require('koneksi.php');
session_start();

if( !isset($_SESSION['username']) ){
    $_SESSION['msg'] = 'Anda di wajibkan Login';
    header('Location: login.php');
}

if(isset($_GET['cari'])){
	$cari = $_GET['cari'];
}

include('template/header.php');
include('template/navbar.php');
?>

<style>
    @import url(https://fonts.googleapis.com/css?family=Roboto:400,100,900);

    html,
    body {
        -moz-box-sizing: border-box;
            box-sizing: border-box;
        height: 100%;
        width: 100%; 
        background: #FFF;
        font-family: 'Roboto', sans-serif;
        font-weight: 400;
    }
    
    .wrapper {
        display: table;
        height: 100%;
        width: 100%;
    }

    .container-fostrap {
        display: table-cell;
        padding: 1em;
        text-align: center;
        vertical-align: middle;
    }
    .fostrap-logo {
        width: 100px;
        margin-bottom:15px
    }
    h1.heading {
        color: #fff;
        font-size: 1.15em;
        font-weight: 900;
        margin: 0 0 0.5em;
        color: #505050;
    }
    @media (min-width: 450px) {
        h1.heading {
            font-size: 3.55em;
    }
    }
    @media (min-width: 760px) {
        h1.heading {
            font-size: 3.05em;
        }
    }
    @media (min-width: 900px) {
        h1.heading {
            font-size: 3.25em;
            margin: 0 0 0.3em;
        }
    } 
    .card {
        display: block; 
        margin-bottom: 20px;
        line-height: 1.42857143;
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12); 
        transition: box-shadow .25s; 
    }
    .card:hover {
        box-shadow: 0 8px 17px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    }
    .img-card {
        width: 100%;
        height:200px;
        border-top-left-radius:2px;
        border-top-right-radius:2px;
        display:block;
        overflow: hidden;
    }
    .img-card img{
        width: 100%;
        height: 200px;
        object-fit:cover; 
        transition: all .25s ease;
    } 
    .card-content {
        padding:15px;
        text-align:left;
    }
    .card-title {
        margin-top:0px;
        font-weight: 700;
        font-size: 1.65em;
    }
    .card-title a {
        color: #000;
        text-decoration: none !important;
    }
    .card-read-more {
        border-top: 1px solid #D4D4D4;
    }
    .card-read-more a {
        text-decoration: none !important;
        padding:10px;
        font-weight:600;
        text-transform: uppercase;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <h2>Data Instansi</h2>
                </div>
                <div class="card-body">
                    <form action="instansi.php" method="get">
                    <div class="row">
                            <div class="col-md-4">
                                <label for="">Instansi</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name = "cari" class ="form-control">
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 offset-4 mt-4">
                            <input type="submit" value="Cari" class ="btn btn-primary">
                            <a href="instansi.php" class ="btn btn-danger">Reset</a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#myModal">
               <i class ="fas fa-plus "></i> Tambah Data
            </button>
            <div class="card">
                <div class="card-body">
                    <table class ="table table-hover table-bordered">
                        <thead>
                            <th width = "5%">No</th>
                            <th width = "15%">Aksi</th>
                            <th>Instansi</th>
                            <th>Deskripsi</th>
                        </thead>
                        <tbody>
                        <?php 
                            if(isset($_GET['cari'])){
                                $cari = $_GET['cari'];
                                $query = "SELECT * FROM tb_instansi where instansi like '%".$cari."%'";				
                            }else{
                                $query = "SELECT * FROM tb_instansi";		
                            }
                            $no = 1;
                            $sql = mysqli_query($con, $query);
                            while ($data = mysqli_fetch_array($sql)) {?>
                                <tr>
                                    <td><?= $no++?></td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#update<?= $data['id_instansi']?>">
                                            <i class ="fas fa-edit"></i>
                                        </button>
                                        <div class="modal text-left" id="update<?= $data['id_instansi']?>">
                                            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Update Data</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <form action="proses/update.php" method="post" enctype="multipart/form-data">
                                                   <div class="card-body">
                                                   <input type="hidden" name = "id_instansi" class = "form-control" value = "<?= $data['id_instansi']?>">
                                                   <div class="row">
                                                        <div class="col-md-4">
                                                            <label for=""> Instansi</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" name = "instansi" class ="form-control" value = "<?= $data['instansi']?>">
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3 mb-2">
                                                            <div class="col-md-4">
                                                                Deskripsi
                                                            </div>
                                                            <div class="col-md-8">
                                                                <textarea name="deskripsi" id="" cols="30" rows="10" value = "<?= $data['deskripsi']?>" class ="form-control"><?= $data['deskripsi']?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                            <input type="submit" name = "update" class = "btn btn-primary" value = "Update">
                                                        </div>
                                                    </div>
                                                   </div>
                                                </form>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?= $data['id_instansi']?>">
                                            <i class ="fas fa-trash"></i>
                                        </button>
                                        <div class="modal" id="delete<?= $data['id_instansi']?>">
                                            <div class="modal-dialog modal-dialog-scrollable modal-sm">
                                                <div class="modal-content">

                                                    <form action="proses/hapus.php" method="post" enctype="multipart/form-data">
                                                        <div class="modal-body">    
                                                            <input type="hidden" name = "id_instansi" class = "form-control" value = "<?= $data['id_instansi']?>">
                                                            <h5>hapus data ?</h5>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                            <input type="submit" name = "delete" class = "btn btn-primary" value = "Hapus">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?= $data['instansi']?></td>
                                    <td><?= $data['deskripsi']?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
  
</div>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Tambah</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <form action="proses/simpan.php" method="post" enctype="multipart/form-data">
        <div class="modal-body">    
            <div class="row">
                <div class="col-md-4">
                   <label for=""> Instansi</label>
                </div>
                <div class="col-md-8">
                    <input type="text" name = "instansi" class ="form-control" required>
                </div>
            </div>
            <div class="row mt-3 mb-2">
                <div class="col-md-4">
                    Deskripsi
                </div>
                <div class="col-md-8">
                    <textarea name="deskripsi" id="" cols="30" rows="10" class ="form-control"></textarea>
                </div>
            </div>
        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <input type="submit" name = "simpan" class = "btn btn-primary" value = "Save">
        </div>
      </form>
    </div>
  </div>
</div>





<?php include('template/footer.php')?>
