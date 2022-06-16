
<?php

$dbcon=mysqli_connect("localhost","root","");

mysqli_select_db($dbcon,"syaco");

// include("db_conection.php");
if(isset($_POST['order_save']))
{
$id = $_POST['id'];
$order_name = $_POST['order_name'];
$order_price = $_POST['order_price'];
$order_quantity = $_POST['order_quantity'];
$order_total=$order_price * $order_quantity;
$order_status='Pending';
$save_order_details="insert into cart (id,order_name,order_price,order_quantity,order_total,order_status,order_date) 
VALUE ('9','$order_name','$order_price','$order_quantity','$order_total','$order_status',CURDATE())";
mysqli_query($dbcon,$save_order_details);
echo "<script>alert('Produk Berhasil ditambahkan di Keranjang Belanja!')</script>";
echo "<script>window.open('p_mainpage.php','_self')</script>";

}

?>
