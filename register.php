<?php
	@ob_start();
	session_start();
	if(isset($_POST['proses'])){
		require 'config.php';
			
		$id = strip_tags($_POST['id']);
$nama = strip_tags($_POST['nama']);
$pass = strip_tags($_POST['pass']); // Hash the password
$alamat = strip_tags($_POST['alamat']);
$telepon = strip_tags($_POST['telepon']);
$email = strip_tags($_POST['email']);
$gambar = strip_tags($_POST['gambar']);
$nik = strip_tags($_POST['nik']);

// Assuming $config is the PDO connection
$sqlMember = "INSERT INTO member (id_member, nm_member, alamat_member, telepon, email, gambar, NIK) VALUES (?, ?, ?, ?, ?, ?, ?)";
$sqlLogin = "INSERT INTO login (id_login, user, pass, id_member) VALUES (NULL, ?, md5(?), ?)";

$config->beginTransaction();

try {
    $stmtMember = $config->prepare($sqlMember);
    $stmtMember->execute([$id, $nama, $alamat, $telepon, $email, $gambar, $nik]);

    $lastInsertId = $config->lastInsertId(); // Get the last inserted ID

    $stmtLogin = $config->prepare($sqlLogin);
    $stmtLogin->execute([$nama, $pass, $lastInsertId]);

    $config->commit();
    echo '';
} catch (Exception $e) {
    $config->rollBack();
    echo '';
}
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login - POS Codekop</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="sb-admin/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary">
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-md-5 mt-5">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
						<div class="p-5">
							<div class="text-center">
								<h4 class="h4 text-gray-900 mb-4"><b>Buat Akun Kids</b></h4>
							</div>
							<form class="form-login" method="POST">
								<div class="form-group">
									<input type="text" class="form-control form-control-user" name="id"
										placeholder="User ID" autofocus>
								</div>
								<div class="form-group">
									<input type="text" class="form-control form-control-user" name="nama"
										placeholder="nama lengkap">
								</div>
								<div class="form-group">
									<input type="password" class="form-control form-control-user" name="pass"
										placeholder="Password">
								</div>
                                <div class="form-group">
									<input type="text" class="form-control form-control-user" name="alamat"
										placeholder="Alamat">
								</div>
								<div class="form-group">
									<input type="text" class="form-control form-control-user" name="telepon"
										placeholder="Nomor Telepon">
								</div>
                                <div class="form-group">
									<input type="email" class="form-control form-control-user" name="email"
										placeholder="Email">
								</div>
                                <div class="form-group">
									<input type="text" class="form-control form-control-user" name="gambar"
										placeholder="" value="unnamed.jpg" hidden>
								</div>
								<div class="form-group">
									<input type="text" class="form-control form-control-user" name="nik"
										placeholder="NIK">
								</div>
								
                                    <P>udah punyaaku?<a href="login.php">Login azza!</a></p>
								<button class="btn btn-primary btn-block" name="proses" type="submit"><i
										class="fa fa-lock"></i>
									buat akun</button>
							</form>

							<!-- <hr>
							<div class="text-center">
								<a class="small" href="forgot-password.html">Forgot Password?</a>
							</div>
							<div class="text-center">
								<a class="small" href="register.html">Create an Account!</a>
							</div> -->
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="sb-admin/vendor/jquery/jquery.min.js"></script>
    <script src="sb-admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="sb-admin/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="sb-admin/js/sb-admin-2.min.js"></script>
</body>
</html>