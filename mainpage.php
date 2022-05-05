<?php
include ("db.php");
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
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
                        <li><a class="dropdown-item" href="#" style="color:white" >Beri Ulasan</a></li>
                        <li><a class="dropdown-item" href="#" style="color:white">Ganti Akun</a></li>
                        <li><hr class="dropdown-divider" style="color:white"></li>
                        <li><a class="dropdown-item" href="logout.php" style="color:white">Logout</a></li>
                    </ul>
                    </li>
                </ul>
                </div>
            </div>
        </nav>

            <div class="bg-img-fluid">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4" style="color:gainsboro">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active" style="color: burlywood">Selamat Datang, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>
                            </li>
                        </ol>
                        <div class="card mb-4"  style="background-color : cornsilk; opacity:0.95">
                            <div class="card-header" style="background-color : navajowhite">
                                <i class="fas fa-table me-1"></i>
                                Data Penjualan
                            </div>
                            <div class="card-body">
                                <table id="example" >
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
                                        <?php
                                        $query = mysqli_query($mysqli,"SELECT * from produk");
                                        while($value = mysqli_fetch_array($query)){
                                        ?>
                                        <tr style="background-color : oldlace">
                                            <td><?=$value["nama_produk"]?></td>
                                            <td><?=$value["jumlah_produk"]?></td>
                                            <td><?=$value["harga_produk"]?></td>
                                            <td><?=$value["tanggal_ditambahkan"]?></td>
                                            <td><?=$value["penjualan"]?></td>
                                            <!-- foreach ($result as $key => $value) { -->
                                            <!-- echo "<tr>"; -->
                                            <!-- echo "<th>".$count++."</th>";
                                            echo "<th>".$value['nama_produk']."</th>";
                                            echo "<th>".$value['jumlah_produk']."</th>";
                                            echo "<th>".$value['harga_produk']."</th>";
                                            echo "<th>".$value['tanggal_ditambahkan']."</th>";
                                            echo "<th>".$value['penjualan']."</th>"; -->
                                        <?php } ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card mb-4" style="background-color : oldlace ; opacity:0.95">
                            <div class="card-header" style="background-color : navajowhite">
                                <i class="fas fa-chart-area "></i>
                                    Grafik Penjualan
                            </div>
                                <div class="card-body">
                                    <canvas id="myChart" style="width:100%;max-width:auto"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div style="color:white">Kelompok B Kelas F</div>
                            <div>
                                <a href="https://github.com/FerryJohanes/Web-Application-Syaco/">Source Code Github</a>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script>
        $(document).ready(function() {
        $('#example').DataTable();
        } );
        </script>
        <?php
        $nama_pr = mysqli_query($mysqli, "SELECT nama_produk FROM produk order by id_produk asc");
        $jual = mysqli_query($mysqli, "SELECT penjualan FROM produk order by id_produk asc");
        ?>
        <script>
            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [<?php while ($nama = mysqli_fetch_array($nama_pr)) { echo '"' . $nama['nama_produk'] . '",';}?>],
                    datasets: [{
                            label: 'Grafik Penjualan Per Produk',
                            data: [<?php while ($p = mysqli_fetch_array($jual)) { echo '"' . $p['penjualan'] . '",';}?>],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderWidth: 2
                        }]
                },
                options: {
                    scales: {
                        yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                    }
                }
            });
        </script>
    </body>
</html>
