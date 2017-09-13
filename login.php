
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="images/favicon.png">
  <title>E-Learning SMPN 1 Srono</title>
  <link href="plugins/bootstrap/bootstrap.min.css" rel="stylesheet">
  <link href="plugins/animate.css/animate.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/main.css">
</head>
<body class="login-page">
  <div class="container">
    <div class="row login">
      <div class="col-md-offset-4 col-md-4">
        <?php include('db.php');
        if(isset($_POST['action']))
        {          
          if($_POST['action']=="login")
          {
            $id = mysqli_real_escape_string($connection,$_POST['id']);
            $password = mysqli_real_escape_string($connection,$_POST['pass']);
            $strSQL = mysqli_query($connection,"select name from siswa where nis='".$id."' and password='".md5($password)."'");
            
            if($strSQL != false)
            {
              $message = $Results['name']." Login Sucessfully!!";
            }
            else
            {
             $id = mysqli_real_escape_string($connection,$_POST['id']);
             $password = mysqli_real_escape_string($connection,$_POST['pass']);
             $strSQL = mysqli_query($connection,"select name from guru where nip='".$id."' and password='".md5($password)."'");
             if ($strSQL != false) {
              $message = $Results['name']." Login Sucessfully!!";
            } else {
              $message = "Invalid email or password!!";
            }
          }        
        }
        elseif($_POST['action']=="signup")
        {
          $nama       = mysqli_real_escape_string($connection,$_POST['nama']);
          $id      = mysqli_real_escape_string($connection,$_POST['id']);
          $pass   = mysqli_real_escape_string($connection,$_POST['pass']);
          $nohp   = mysqli_real_escape_string($connection,$_POST['nohp']);
          $jabatan   = mysqli_real_escape_string($connection,$_POST['jabatan']);
          if($jabatan == "Guru") {
            mysql_query("insert into guru values(".$id.",'".$nama."','".md5($password)."','".$nohp."')");
            $message = "Signup Sucessfully!!";
          } else {

          }
        }
      }
      ?>
      <!-- Login -->
      <div class="login-top-base">
        <h4>Selamat Datang!</h4>
        <p>Silahkan masukan data secara benar</p>
      </div>
      <div class="login-base clearfix">
        <form role="form" class="form">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="id" id="email" placeholder="Username" required>
          </div>
          <div class="form-group">
            <label for="pass">Password</label>
            <input type="password" class="form-control" name="pass" id="password" placeholder="Kata sandi" required>
            <input name="action" type="hidden" value="login"/>
          </div>
          <!--notif for siswa belum bayar spp -->
          <div class="form-group">
            <label for="notif" class="red-text">Jika Anda Belum Mendaftar, daftarkan akun anda <a href="#" data-toggle="modal" data-target="#daftar">disini</a></label>
          </div>
          <!---->
          <button type="submit" class="btn custom btn-primary pull-right" value="Login">Masuk</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Footer -->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-offset-2 col-md-8">
        <img class="pull-left" src="images/rotobot.jpg" alt="Rotobot">
        <p>
          <strong>SMPN 1 Srono </strong><br><br>Copyright &copy; 2017
        </p>
      </div>
    </div>
  </div>
</footer>

<!-- MODAL: modal form pembayaran siswa -->
<div class="modal fade" id="modal_pembayaran" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p class="modal-title" id="myModalLabel">Form Pembayaran</p>
      </div>
      <div class="modal-body">              
        <div class="form-group col-md-8">
          <label for="tambah_username">Username</label>
          <input id="tambah_username" type="text" name="" class="form-control">
        </div>    
        <div class="form-group col-md-8">
          <label for="tambah_nama">Nama Siswa</label>
          <input id="tambah_nama" type="text" name="" class="form-control" disabled>
        </div>         
        <div class="form-group col-md-8">
          <label for="tambah_norek">No Rekening Pengirim</label>
          <input id="tambah_norek" type="text" name="" class="form-control">
        </div>             
        <div class="form-group col-md-8">
          <label for="tambah_nama_pengirim">Nama Pengirim</label>
          <input id="tambah_nama_pengirim" type="text" name="" class="form-control">
        </div>
        <div class="form-group col-md-8">
          <label for="tambah_nominal">Nominal Pembayaran</label>
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon2">Rp</span>
            <input type="number" name="tambah_nominal" id="total_bayar" class="form-control" placeholder="" aria-describedby="basic-addon2">
          </div>
        </div> 
        <div class="form-group col-md-12">
          <label for="tambah_keterangan">Keterangan Pembayaran</label>
          <textarea id="tambah_keterangan" name="" class="form-control"></textarea>
        </div>  
        <div class="form-group col-md-12">
          <label for="tambah_file">Bukti Pembayaran</label>
        </div>  
        <div class="form-group col-md-6">
          <input id="uploadFile" placeholder="Choose Image" class="col-md-4 form-control" disabled="disabled" />
        </div> 
        <div class="form-group col-md-4">
          <div class="fileUpload btn btn-success">
            <span>Browse</span>
            <input id="uploadBtn" type="file" class="upload" accept=".jpg,.gif,.png,.jpeg" multiple/>
          </div>
        </div> 
      </div>
      <div class="modal-footer">
        <div class="form-group col-md-4">
          <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button>
          <button type="button" id="tambah_submit" class="btn btn-primary btn-lg btn-bold pull-right">Simpan</button>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.MODAL -->

<div class="modal fade" id="daftar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">      
    <div class="modal-content">
      <form method="POST" action="">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <p class="modal-title" id="myModalLabel">Form Pendaftaran</p>
        </div>
        <div class="modal-body">
          <div class="form-group col-md-8">
            <label for="tambah_jabatan">Akun</label>
            <select id="tambah_jabatan" name="jabatan" class="form-control selectpicker show-menu-arrow">
              <option selected value="Guru">Guru</option>
              <option value="Siswa">Siswa</option>
            </select>
          </div>
          <div class="form-group col-md-8">
            <label for="ubah_no_hp">NIS / NIP</label>
            <input id="ubah_no_hp" type="text" name="id" class="form-control" value="">
          </div>        
          <div class="form-group col-md-8">
            <label for="ubah_no_hp">Password</label>
            <input id="ubah_no_hp" type="password" name="pass" class="form-control" value="">
          </div>
          <div class="form-group col-md-8">
            <label for="ubah_email">Nama</label>
            <input id="ubah_email" type="text" name="nama" class="form-control" value="">
          </div>
          <div class="form-group col-md-8">
            <label for="ubah_email">N0 Hp</label>
            <input id="ubah_email" type="text" name="nohp" class="form-control" value="">
            <input name="action" type="hidden" value="login"/>
          </div>
          <div class="form-group col-md-8">
            <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button>
            <button type="submit" id="tambah_submit" class="btn btn-primary btn-lg btn-bold pull-right" value="signup">Simpan</button>
          </div>

          <div class="modal-footer">
          </div>
        </div>

      </form>
    </div><!-- /.modal-content -->      
  </div><!-- /.modal-dialog -->
</div><!-- /.MODAL -->
<!-- Scripts -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript">
  document.getElementById("uploadBtn").onchange = function () {
    document.getElementById("uploadFile").value = this.value;
  };
</script>
</body>
</html>
