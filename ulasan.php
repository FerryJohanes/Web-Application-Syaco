<?php
include_once ("db.php");
session_start();

if(isset($_POST["ulasan"])) {
    $query = "INSERT INTO ulasan(ulasan) VALUES(?)";
    $stmt = $mysqli->prepare($query);
    $stmt->execute([$_POST["ulasan"]]);
    header("Location: mainpage.php");
} else {
    http_response_code(400);
}
sleep(2);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Syaco-Admin</title>
        <!-- Script Start -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" mdeia="screen" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Script End -->
    </head>
    <body>
        <!-- Background image -->
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

        
            <div class="bg-img-fluid">
                <div class="container-fluid px-4">
                    <h3 id="terimakasih" style="color:white"></h3>
                    <h1 class="mt-4" style="color:gainsboro">Ulasan</h1>
                </div>
            </div>
            <form action="ulasan.php" method="POST" id="form" enctype="multipart/form-data">
            <div class="mb-3 ">
                <div class="container-fluid px-4" >
                    <label for="ulasan" class="form-label" style="color:white">Masukkan ulasan Anda mengenai aplikasi ini</label>
                    <textarea class="form-control" id="ulasan" name="ulasan" rows="6"></textarea>
                    <div id="ulasan" class="form-text"></div>
                    <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                    
                </div>
            </div>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div style="color:white">Kelompok B Kelas F</div>
                    <div>
                        <a href="https://github.com/FerryJohanes/Web-Application-Syaco/">Source Code Github</a>
                    </div>
                </div>
            </div>
        <script>
            $(document).ready(function () {
                $("#submit").click(function () {
                    $("#terimakasih").append("Terima kasih atas ulasan anda");
                });
            });
        </script>
    </body>
</html>