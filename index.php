<?php
include ("db.php");

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
        <link rel="stylesheet" type="text/css" mdeia="screen" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <link href="css/styles.css" rel="stylesheet" />
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Syaco</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </head>
    <body>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">SELAMAT DATANG</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">NAMA KARYAWAN</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Data Penjualan
                        </div>
                        <div class="card-body">
                            <table id="example">
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
                                    $query = mysqli_query($conn,"SELECT * from produk");
                                    $count = 1;
                                    while($value = mysqli_fetch_array($query)){
                                    ?>
                                    <tr>
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
                    <div class="card mb-4" style="background-color : bisque ">
                        <div class="card-header" style="background-color : ">
                            <i class="fas fa-chart-area "></i>
                                Data Penjualan
                        </div>
                            <div class="card-body">
                                <canvas id="myChart" style="width:100%;max-width:700px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Kelompok B Kelas F</div>
                        <div>
                            <a href="#">Link Source Code Github</a>
                        </div>
                    </div>
                </div>
            </footer>

        </div>
        <script>
        $(document).ready(function() {
        $('#example').DataTable();
        } );
        </script>
        <?php
        $nama_pr = mysqli_query($conn, "SELECT nama_produk FROM produk order by id_produk asc");
        $jual = mysqli_query($conn, "SELECT penjualan FROM produk order by id_produk asc");
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    </body>
</html>
