<?php
// Include db file
require_once "db.php";
 
// Define variables and initialize with empty values
$modal = $tanggal = $pemasukan = $pengeluaran ="";
$modal_err = $tanggal_err = $pemasukan_err = $pengeluaran ="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate tanggal
    if(empty(trim($_POST["tanggal"]))){
        $tanggal_err = "Mohon masukkan tanggal dibeli.";
    } else{
        $tanggal = trim($_POST["tanggal"]);
    }

    if(!preg_match('/^[0-9]+$/', trim($_POST["pemasukan"]))){
        $pemasukan_err = "Pemasukan hanya berupa angka 0-9";
    } else{
        $pemasukan = trim($_POST["pemasukan"]);
        }

    if(!preg_match('/^[0-9]+$/', trim($_POST["pengeluaran"]))){
        $pengeluaran_err = "Pengeluaran hanya berupa angka 0-9";
    } else{
        $pengeluaran = trim($_POST["pengeluaran"]);
        }

    // Check input errors before inserting in database
    if(empty($modal_err) && 
    empty($tanggal_err) && 
    empty($pengeluaran_err) && 
    empty($pemasukan_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO keuangan (modal, tanggal, pemasukan, pengeluaran) VALUES (?, ?, ?, ?)";
         
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssss", $param_modal, $param_tanggal, $param_pemasukan, $param_pengeluaran);
            
            // Set parameters
            $param_modal = $modal;
            $param_tanggal = $tanggal;
            $param_pemasukan = $pemasukan;
            $param_pengeluaran = $pengeluaran;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: keuangan.php");
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
    <title>Insert barang</title>
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
                <h1 class="mt-4 text-center" style="color:gainsboro">Tambah Data Keuangan</h1>
            </div>
        </div>

        <div class="container-fluid">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <p style="color: white">Mohon mengisi formulir berikut untuk menambah data keuangan</p>
            <div class="form-outline mb-4">
                <label for="tanggal" style="color: oldlace"> Tanggal </label>
                <input class="form-control <?php echo (!empty($tanggal_err)) ? 'is-invalid' : ''; ?> gradient-custom-2 mb-3" value="<?php echo $tanggal; ?>" id="tanggal" name="tanggal" placeholder="YYYY/MM/DD" type="text"/>
                <span class="invalid-feedback"><?php echo $tanggal_err; ?></span>
            </div>
            <div class="form-outline mb-4">
                <label for="modal" style="color: oldlace"> Modal</label>
                <input type="number-oldlace" name="modal"  value="0" class="form-control gradient-custom-2 mb-3" value="<?php echo $modal; ?>">
                <span class="invalid-feedback"><?php echo $modal_err; ?></span>
            </div>
            <div class="form-outline mb-4">
                <label for="pemasukan" style="color: oldlace">Pemasukan</label>
                <input type="number-oldlace" name="pemasukan"  value="0" class="form-control gradient-custom-2 mb-3" value="<?php echo $pemasukan; ?>">
                <span class="invalid-feedback"><?php echo $pemasukan_err; ?></span>
            </div>
            <div class="form-outline mb-4">
                <label for="pengeluaran" style="color: oldlace">Pengeluaran</label>
                <input type="number-oldlace" name="pengeluaran" value="0" class="form-control gradient-custom-2 mb-3" value="<?php echo $pengeluaran; ?>">
                <span class="invalid-feedback"><?php echo $pengeluaran_err; ?></span>
            </div>

            <div class="text-center pt-1 mb-5 pb-1">
                <button class="btn btn-primary sm-btn fa-lg gradient-custom-2 mb-3" type="submit" style="color:black" value="submit">Submit</button>
                <a class="btn btn-primary sm-btn fa-lg gradient-custom-2 mb-3" href="keuangan.php" style="color:black">Kembali</a>
            </div>
        <script>
            $(document).ready(function(){
            var date_input=$('input[name="tanggal"]'); //our date input has the name "date"
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
        <br><br><br><br><br>
        <p>Kelompok B Kelas F || <a href="https://github.com/FerryJohanes/Web-Application-Syaco/">Source Code Github</a></p>
    </div>
</body>
</html>