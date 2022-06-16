<?php
// Include db file
require_once "db.php";
 
// Define variables and initialize with empty values
$nama_produk = $tanggal_ditambahkan = $jumlah_produk = $harga_produk = $penjualan = "";
$nama_produk_err = $tanggal_ditambahkan_err = $jumlah_produk_err = $harga_produk_err = $penjualan_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hid_produkden input value
    $id_produk = $_POST["id"];
    
    // Validate nama_produk
    $input_nama_produk = trim($_POST["nama_produk"]);
    if(empty($input_nama_produk)){
        $nama_produk_err = "Mohon masukkan nama produk.";
    } else{
        $nama_produk = $input_nama_produk;
    }
    
    // Validate tanggal_ditambahkan tanggal_ditambahkan
    $input_tanggal_ditambahkan = trim($_POST["tanggal_ditambahkan"]);
    if(empty($input_tanggal_ditambahkan)){
        $tanggal_ditambahkan_err = "Mohon masukkan tanggal ditambahkan.";
    } else{
        $tanggal_ditambahkan = $input_tanggal_ditambahkan;
    }
    
    // Validate jumlah_produk
    $input_jumlah_produk = trim($_POST["jumlah_produk"]);
    if(empty($input_jumlah_produk)){
        $jumlah_produk_err = "Mohon masukkan jumlah produk.";
    } elseif(!ctype_digit($input_jumlah_produk)){
        $jumlah_produk_err = "Mohon masukkan angka.";
    } else{
        $jumlah_produk = $input_jumlah_produk;
    }
    
    // Validate harga_produk
    $input_harga_produk = trim($_POST["harga_produk"]);
    if(empty($input_harga_produk)){
        $harga_produk_err = "Mohon masukkan harga produk .";
    } elseif(!ctype_digit($input_harga_produk)){
        $harga_produk_err = "Mohon masukkan angka.";
    } else{
        $harga_produk = $input_harga_produk;
    }
    
    // Validate penjualan
    $input_penjualan = trim($_POST["penjualan"]);
    if(empty($input_penjualan)){
        $penjualan_err = "Mohon masukkan penjualan .";
    } elseif(!ctype_digit($input_penjualan)){
        $penjualan_err = "Mohon masukkan angka.";
    } else{
        $penjualan = $input_penjualan;
    }

    // Check input errors before inserting in database
    if(empty($nama_produk_err) && 
    empty($tanggal_ditambahkan_err) && 
    empty($jumlah_produk_err) && 
    empty($harga_produk_err) && 
    empty($penjualan_err)){
        // Prepare an update statement
        $sql = "UPDATE produk SET nama_produk=?, tanggal_ditambahkan=?, jumlah_produk=?, harga_produk=?, penjualan=? WHERE id_produk=?";
 
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sssssi", $param_nama_produk, $param_tanggal_ditambahkan, $param_jumlah_produk, $param_harga_produk, $param_penjualan, $param_id_produk);
            
            // Set parameters
            $param_nama_produk = $nama_produk;
            $param_tanggal_ditambahkan = $tanggal_ditambahkan;
            $param_jumlah_produk = $jumlah_produk;
            $param_harga_produk = $harga_produk;
            $param_penjualan = $penjualan;
            $param_id_produk = $id_produk;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records updated successfully. Redirect to landing page
                header("location: mainpage.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        $stmt->close();
    }
    
    // Close connection
    $mysqli->close();
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id_produk =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM produk WHERE id_produk = ?";
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("i", $param_id_produk);
            
            // Set parameters
            $param_id_produk = $id_produk;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                $result = $stmt->get_result();
                
                if($result->num_rows == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $nama_produk = $row["nama_produk"];
                    $tanggal_ditambahkan = $row["tanggal_ditambahkan"];
                    $jumlah_produk = $row["jumlah_produk"];
                    $harga_produk = $row["harga_produk"];
                    $penjualan = $row["penjualan"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            }
        }
        
        // Close statement
        $stmt->close();
        
        // Close connection
        $mysqli->close();
    } 
}
?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5" style="color: oldlace">Edit Produk</h2>
                    <p style="color: oldlace">Mohon masukkan data yang ingin diubah</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label style="color: oldlace"> Nama Produk</label>
                            <input type="text" name="nama_produk" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nama_produk; ?>">
                            <span class="invalid-feedback"><?php echo $nama_produk_err;?></span>
                        </div>
                        <div class="form-outline mb-4">
                            <label for="tanggal_ditambahkan" style="color: oldlace"> Tanggal Ditambahkan</label>
                            <input class="form-control <?php echo (!empty($tanggal_ditambahkan_err)) ? 'is-invalid' : ''; ?> gradient-custom-2 mb-3" value="<?php echo $tanggal_ditambahkan; ?>" id="tanggal_ditambahkan" name="tanggal_ditambahkan" placeholder="YYYY/MM/DD" type="text"/>
                            <span class="invalid-feedback"><?php echo $tanggal_ditambahkan_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label style="color: oldlace">Jumlah Produk</label>
                            <input type="text" name="jumlah_produk" class="form-control <?php echo (!empty($jumlah_produk_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $jumlah_produk; ?>">
                            <span class="invalid-feedback"><?php echo $jumlah_produk_err;?></span>
                        </div>
                        <div class="form-group">
                            <label style="color: oldlace">Harga Produk</label>
                            <input type="text" name="harga_produk" class="form-control <?php echo (!empty($harga_produk_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $harga_produk; ?>">
                            <span class="invalid-feedback"><?php echo $harga_produk_err;?></span>
                        </div>

                        <div class="form-group">
                            <label style="color: oldlace">Penjualan</label>
                            <input type="text" name="penjualan" class="form-control <?php echo (!empty($penjualan_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $penjualan; ?>">
                            <span class="invalid-feedback"><?php echo $penjualan_err;?></span>
                        </div>

                        <input type="hidden" name="id" value="<?php echo $id_produk; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="mainpage.php" onClick="return confirm('Yakin ingin membuang perubahan?')" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
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
</body>
</html>