<?php
include('db.php');
// Process delete operation after confirmation
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Include config file
    require_once "db.php";
    
    // Prepare a delete statement
    $sql = "DELETE FROM produk WHERE id_produk = ?";
    
    if($stmt = $mysqli->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_id_produk);
        
        // Set parameters
        $param_id_produk = trim($_POST["id"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            // Records deleted successfully. Redirect to landing page
            header("location: mainpage.php");
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    } else{
        // Check existence of id parameter
        if(empty(trim($_GET["id"]))){
            // URL doesn't contain id parameter. Redirect to error page
            echo "AAA";
        }
    }
    
    
    // Close statement
    $stmt->close();
    
    // Close connection
    $mysqli->close();
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" mdeia="screen" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <!-- Background image -->
    <div class="bg-image " 
        style="background-image: url('https://img.besthqwallpapers.com/Uploads/29-9-2020/142270/coffee-beans-background-with-coffee-falling-coffee-grains-coffee-concepts-coffee-background.jpg');
        height: 100vh ">
    <!-- Background image -->
        <?php
        $id = $_GET["id"];
        $query = mysqli_query($mysqli,"SELECT * from produk WHERE id_produk = $id");
        $value = $query->fetch_array();
        ?>
        <h2 style="color:white">Hapus Data <?=$value['nama_produk']?></h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <table class= "table table-bordered" style="border-color: burlywood; color:white" width="70%">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Stok Produk</th>
                    <th>Harga Produk</th>
                    <th>Tanggal Ditambahkan</th>
                    <th>Penjualan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?=$value['nama_produk']?></td>
                    <td><?=$value['jumlah_produk']?></td>
                    <td><?=$value['harga_produk']?></td>
                    <td><?=$value['tanggal_ditambahkan']?></td>
                    <td><?=$value['penjualan']?></td>
                </tr>
            </tbody>
        </table>
            <div class="alert alert-danger">
                <input type="hidden" name="id" value="<?php echo trim($_GET["id"]);?>"/>
                <p>Anda yakin ingin menghapus data produk <?=$value['nama_produk']?> ?</p>
                <p>
                    <input type="submit" value="Ya" class="btn btn-danger">
                    <a href="mainpage.php" class="btn btn-secondary ml-2">Tidak</a>
                </p>
            </div>
        </form>
    </div>
</body>
</html>