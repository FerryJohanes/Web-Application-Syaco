<?php
// Include db file
require_once "db.php";
 
// Define variables and initialize with empty values
$nama_produk = $tanggal_ditambahkan = $jumlah_produk = $harga_produk = $penjualan = "";
$nama_produk_err = $tanggal_ditambahkan_err = $jumlah_produk_err = $harga_produk_err = $penjualan_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["nama_produk"]))){
        $nama_produk_err = "Mohon masukkan nama produk.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id_produk FROM produk WHERE nama_produk = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_nama_produk);
            
            // Set parameters
            $param_nama_produk = trim($_POST["nama_produk"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $nama_produk_err = "This nama_produk is already taken.";
                } else{
                    $nama_produk = trim($_POST["nama_produk"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Validate tanggal_ditambahkan
    if(empty(trim($_POST["tanggal_ditambahkan"]))){
        $tanggal_ditambahkan_err = "Mohon masukkan tanggal ditambahkan.";
    } else{
        $tanggal_ditambahkan = trim($_POST["tanggal_ditambahkan"]);
    }

    if(empty(trim($_POST["jumlah_produk"]))){
        $jumlah_produk_err = "Mohon masukkan jumlah produk";
    } elseif(!preg_match('/^[0-9]+$/', trim($_POST["jumlah_produk"]))){
        $jumlah_produk_err = "Jumlah produk hanya berupa angka 0-9";
    } else{
        $jumlah_produk = trim($_POST["jumlah_produk"]);
        }

    if(empty(trim($_POST["harga_produk"]))){
        $harga_produk_err = "Mohon masukkan harga produk";
    } elseif(!preg_match('/^[0-9]+$/', trim($_POST["harga_produk"]))){
        $harga_produk_err = "Harga Produk hanya berupa angka 0-9";
    } else{
        $harga_produk = trim($_POST["harga_produk"]);
        }

    if(empty(trim($_POST["penjualan"]))){
        $penjualan_err = "Mohon masukkan penjualan";
    } elseif(!preg_match('/^[0-9]+$/', trim($_POST["penjualan"]))){
        $penjualan_err = "Penjualan hanya berupa angka 0-9";
    } else{
        $penjualan = trim($_POST["penjualan"]);
        }

    // Check input errors before inserting in database
    if(empty($nama_produk_err) && 
    empty($tanggal_ditambahkan_err) && 
    empty($jumlah_produk_err) && 
    empty($harga_produk_err) && 
    empty($penjualan_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO produk (nama_produk, tanggal_ditambahkan, jumlah_produk, harga_produk, penjualan) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sssss", $param_nama_produk, $param_tanggal_ditambahkan, $param_jumlah_produk, $param_harga_produk, $param_penjualan);
            
            // Set parameters
            $param_nama_produk = $nama_produk;
            $param_tanggal_ditambahkan = $tanggal_ditambahkan;
            $param_jumlah_produk = $jumlah_produk;
            $param_harga_produk = $harga_produk;
            $param_penjualan = $penjualan;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: mainpage.php");
            } else{
                echo "Oops! Sepertinya ada yang error! Coba lagi nanti!";
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Close connection
    $mysqli->close();
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Insert Produk</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
        .gradient-custom-2 {
        /* fallback for old browsers */
        background: #fccb90;

        /* Chrome 10-25, Safari 5.1-6 */
        background: -webkit-linear-gradient(to right, navajowhite,  cornsilk, oldlace, white );

        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        background: linear-gradient(to right, navajowhite,  cornsilk, oldlace, white );
        }

        @media (min-width: 769px) {
        .gradient-custom-2 {
        border-top-right-radius: .3rem;
        border-bottom-right-radius: .3rem;
        }
        }
    </style>
</head>
<body>
    <div class="bg-image img-fluid" 
        style="background-image: url('https://img.besthqwallpapers.com/Uploads/29-9-2020/142270/coffee-beans-background-with-coffee-falling-coffee-grains-coffee-concepts-coffee-background.jpg');
        height: 100vh 
        background-position:top">
        <nav class="navbar navbar-expand-lg navbar-light">
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
                    <a class="nav-link active" aria-current="page" href="mainpage.php" style="color:white">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="inventaris.php"style="color:white">Inventaris</a>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle " style="color:white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Pengaturan
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color: transparent; border-color: white">
                        <li><a class="dropdown-item" href="ulasan.php" style="color:white" >Beri Ulasan</a></li>
                        <li><a class="dropdown-item" href="login.php" style="color:white">Ganti Akun</a></li>
                        <li><hr class="dropdown-divider" style="color:white"></li>
                        <li><a class="dropdown-item" href="logout.php" style="color:white">Logout</a></li>
                    </ul>
                    </li>
                </ul>
                </div>
            </div>
        </nav>

        <div class="bg-img-fluid">
            <div class="container-fluid px-4">
                <h1 class="mt-4 text-center" style="color:gainsboro">Tambah Data Produk</h1>
            </div>
        </div>

        <div class="container-fluid">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <p style="color: white">Mohon mengisi formulir berikut untuk menambah data produk</p>
            <div class="form-outline mb-4">
                <label for="nama_produk" style="color: oldlace"> Nama Produk</label>
                <input type="text-oldlace" name="nama_produk" class="form-control <?php echo (!empty($nama_produk_err)) ? 'is-invalid' : ''; ?> gradient-custom-2 mb-3" value="<?php echo $nama_produk; ?>">
                <span class="invalid-feedback"><?php echo $nama_produk_err; ?></span>
            </div>
            <div class="form-outline mb-4">
                <label for="tanggal_ditambahkan" style="color: oldlace"> Tanggal Ditambahkan</label>
                <input class="form-control <?php echo (!empty($tanggal_ditambahkan_err)) ? 'is-invalid' : ''; ?> gradient-custom-2 mb-3" value="<?php echo $tanggal_ditambahkan; ?>" id="tanggal_ditambahkan" name="tanggal_ditambahkan" placeholder="YYYY/MM/DD" type="text"/>
                <span class="invalid-feedback"><?php echo $tanggal_ditambahkan_err; ?></span>
            </div>
            <div class="form-outline mb-4">
                <label for="jumlah_produk" style="color: oldlace"> Jumlah Produk</label>
                <input type="text-oldlace" name="jumlah_produk" class="form-control <?php echo (!empty($jumlah_produk_err)) ? 'is-invalid' : ''; ?> gradient-custom-2 mb-3" value="<?php echo $jumlah_produk; ?>">
                <span class="invalid-feedback"><?php echo $jumlah_produk_err; ?></span>
            </div>
            <div class="form-outline mb-4">
                <label for="harga_produk" style="color: oldlace"> Harga Produk</label>
                <input type="text-oldlace" name="harga_produk" class="form-control <?php echo (!empty($harga_produk_err)) ? 'is-invalid' : ''; ?> gradient-custom-2 mb-3" value="<?php echo $harga_produk; ?>">
                <span class="invalid-feedback"><?php echo $harga_produk_err; ?></span>
            </div>
            <div class="form-outline mb-4">
                <label for="penjualan" style="color: oldlace">Penjualan</label>
                <input type="text-oldlace" name="penjualan" class="form-control <?php echo (!empty($penjualan_err)) ? 'is-invalid' : ''; ?> gradient-custom-2 mb-3" value="<?php echo $penjualan; ?>">
                <span class="invalid-feedback"><?php echo $penjualan_err; ?></span>
            </div>
            <div class="text-center pt-1 mb-5 pb-1">
                <button class="btn btn-primary sm-btn fa-lg gradient-custom-2 mb-3" type="submit" style="color:black" value="submit">Submit</button>
                <a class="btn btn-primary sm-btn fa-lg gradient-custom-2 mb-3" href="mainpage.php" style="color:black">Kembali</a>
            </div>
        <script>
            $(document).ready(function(){
            var date_input=$('input[name="tanggal_ditambahkan"]'); //our date input has the name "date"
            var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
            var options={
                format: 'yyyy/mm/dd',
                container: container,
                todayHighlight: true,
                autoclose: true,
            };
            date_input.datepicker(options);
            })
        </script>
        <p>Kelompok B Kelas F || <a href="https://github.com/FerryJohanes/Web-Application-Syaco/">Source Code Github</a></p>
    </div>
</body>
</html>