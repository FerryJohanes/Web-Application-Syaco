<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<?php
 include("config.php");
 extract($_SESSION); 
		  $stmt_edit = $DB_con->prepare('SELECT * FROM users WHERE username =:username');
		$stmt_edit->execute(array(':username'=>$username));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
		
		?>
		<?php
 include("config.php");
	$stmt_edit = $DB_con->prepare("select sum(order_total) as total from cart where id=:id and order_status='Ordered'");
		$stmt_edit->execute(array(':id'=>$id));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
		?>
		<?php

	error_reporting( ~E_NOTICE );
	
	require_once 'config.php';
	
	if(isset($_GET['cart']) && !empty($_GET['cart']))
	{
		$id = $_GET['cart'];
		$stmt_edit = $DB_con->prepare('SELECT * FROM produk WHERE id_produk =:id_produk');
		$stmt_edit->execute(array(':id_produk'=>$id));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
	}
	else
	{
		header("Location: shop.php");
	}
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
    <div id="wrapper">
        <div id="page-wrapper">
 <form role="form" method="post" action="save_order.php">
	
    
    <?php
	if(isset($errMSG)){
		?>
       
        <?php
	}
	?>
   
    <div class="alert alert-default" style="color:white;background-color:pink">
         <h3 style="color:black"> Detail Pemesanan</h3>
        </div>
		 <td><input class="form-control" type="hidden" name="order_name" value="<?php echo $nama_produk; ?>" /></td>
		<td><input class="form-control" type="hidden" name="order_price" value="<?php echo $harga_produk; ?>" /></td>
		<td><input class="form-control" type="hidden" name="id" value="<?php echo $id; ?>" /></td>
	<table class="table table-bordered table-responsive">
    <tr>
    	<td><label class="control-label" style="color:white">Nama Produk</label></td>
        <td><input class="form-control" type="text" name="v1" value="<?php echo $nama_produk; ?>" disabled/></td>
    </tr>
	 <tr>
    	<td><label class="control-label" style="color:white">Harga Satuan</label></td>
        <td><input class="form-control" type="text" name="v2" value="Rp.<?php echo $harga_produk; ?>" disabled/></td>
    </tr>
    <tr>
    	<td><label class="control-label" style="color:white"> Gambar</label></td>
        <td>
        	<p><img class="img img-thumbnail" src="https://previews.123rf.com/images/deepbluero/deepbluero2004/deepbluero200400115/145234493-cup-of-turkish-coffee-on-black-background-with-spices-coffee-beans-and-sand-coffee-pot.jpg"
             style="height:250px;width:350px;" /></p>
		</td>
		 <tr>
    	<td><label class="control-label" style="color:white">Jumlah</label></td>
        <td><input class="form-control" type="number" placeholder="Quantity" name="order_quantity" value="0" min="0" max="<?php echo $jumlah_produk; ?>" onkeypress="return isNumber(event)" onpaste="return false"  required />
		</td>
    </tr>
    </tr>
    <tr>
        <td colspan="2"><button type="submit" name="order_save" class="btn btn-primary">
        <span class="glyphicon glyphicon-shopping-cart"></span> OK
        </button>
        <a class="btn btn-danger" href="p_cart.php"> <span class="glyphicon glyphicon-backward"></span> Cancel </a>
        </td>
    </tr>
    </table>
</form><br /><br><br><br><br><br>
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
</html>
