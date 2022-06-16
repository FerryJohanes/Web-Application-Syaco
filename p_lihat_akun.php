<?php
session_start();

//include koneksi
include "db.php";

//get user detail
$username = $_SESSION['username'];
$query = "SELECT * from users where username = ? limit 1";
$stmt = $mysqli->stmt_init();
$stmt->prepare($query);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_array(MYSQLI_ASSOC);

?>
<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" mdeia="screen" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
	<script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

	<title>Profil <?php echo htmlspecialchars($_SESSION["username"]); ?></title>
</head>
<body>
    <div class="bg-image img-fluid" 
        style="background-image: url('https://img.besthqwallpapers.com/Uploads/29-9-2020/142270/coffee-beans-background-with-coffee-falling-coffee-grains-coffee-concepts-coffee-background.jpg');
        height: 100vh 
        background-position:top">
        <!-- Background image -->
        <nav class="navbar navbar-expand-lg navbar-dark">
				<div class="container-fluid">
					<a class="navbar-brand" href="#" style="font-size: 28px;font-family:magneto; color:white"><img src="https://mimindonesia.com/wp-content/uploads/2021/07/cropped-Untitled-1.png" alt="logo syaco?" style="height:80px">SyacoMa</a>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="fas fa-bars" style="color:#fff; font-size:28px;"></i>
					</span>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="p_mainpage.php" style="color:white"> <i class="fa-solid fa-boxes-stacked"></i> Katalog Produk</a>
						</li>
						<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="cart_items.php" style="color:white"> <i class="fa-solid fa-cart-shopping"></i> Keranjang Belanja</a>
						</li>
						<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle " style="color:white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="fa-solid fa-gears"></i> Pengaturan
						</a>
						<ul class="dropdown-menu" aria-labelledby="navbarDropdown" style=" border-color: black">
							<li><a class="dropdown-item" href="ulasan.php" style="" >Beri Ulasan</a></li>
							<li><a class="dropdown-item" href="p_lihat_akun.php" style="">Profil Akun</a></li>
							<li><hr class="dropdown-divider" style=""></li>
							<li><a class="dropdown-item" href="logout.php" style="">Logout</a></li>
						</ul>
						</li>
					</ul>
					</div>
				</div>
			</nav>
	<div class="container">
		<div class="main-body">
			<div class="row gutters-sm">
				<div class="col-md-4 mb-3">
				<div class="card" style="background-color:burlywood">
					<div class="card-body">
					<div class="d-flex flex-column align-items-center text-center">
						<img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt="Admin" class="rounded-circle" width="150">
						<div class="mt-3">
						<h4> <?php echo htmlspecialchars($_SESSION["username"]); ?></h4>
						</div>
					</div>
					</div>
				</div>
				</div>
				<div class="col-md-8">
				<div class="card mb-3" style="background-color:burlywood" >
					<div class="card-body">
					<div class="row">
						<div class="col-sm-3">
						<h6 class="mb-0">Nama Lengkap</h6>
						</div>
						<div class="col-sm-9 text-secondary">
						<?php echo @$user['nama']?>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-3">
						<h6 class="mb-0">Email</h6>
						</div>
						<div class="col-sm-9 text-secondary">
							<?php echo @$user['email']?>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-3">
						<h6 class="mb-0">Jenis Kelamin</h6>
						</div>
						<div class="col-sm-9 text-secondary">
						<?php echo @$user['jenis_kelamin']?>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-3">
						<h6 class="mb-0">No. Telpon</h6>
						</div>
						<div class="col-sm-9 text-secondary">
						0<?php echo @$user['no_telpon']?>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-3">
						<h6 class="mb-0">Alamat</h6>
						</div>
						<div class="col-sm-9 text-secondary">
						<?php echo @$user['alamat']?>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-12">
						<a class="btn btn-info " href="p_edit_akun.php">Edit Profil</a>
						</div>
					</div>
					</div>
				</div>
				</div>
			</div>
			<br><br><br><br><br><br>
			<div class="container-fluid px-4">
					<div class="d-flex align-items-center justify-content-between small">
						<div style="color:white">Kelompok B Kelas F</div>
						<div>
							<a href="https://github.com/FerryJohanes/Web-Application-Syaco/">Source Code Github</a>
						</div>
					</div>
				</div>
			</div>
		</div>
</body>
<?php
unset($_SESSION['error']);
unset($_SESSION['message']);
?>