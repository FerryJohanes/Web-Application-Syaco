<?php
session_start();

include "db.php";

//dapatkan data user dari form register
$user = [
	'id' => $_POST['id'],
	'nama' => $_POST['nama'],
	'username' => $_POST['username'],
	'jenis_kelamin' => $_POST['jenis_kelamin'],
	'email' => $_POST['email'],
	'no_telpon' => $_POST['no_telpon'],
	'alamat' => $_POST['alamat'],
];

//check apakah user dengan username tersebut ada di table users yang kecuali user tersebut.
$query = "SELECT * from users where username = ? and id != ? limit 1";
$stmt = $mysqli->stmt_init();
$stmt->prepare($query);
$stmt->bind_param('si', $user['username'], $user['id']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_array(MYSQLI_ASSOC);

//jika username sudah ada, maka return kembali ke halaman profile.
if($row != null){
	$_SESSION['error'] = 'Username: '.$user['username'].' yang anda masukkan sudah ada di database.';
	$_SESSION['nama'] = $_POST['nama'];
	header("Location: lihat_akun.php");
	return;

}else{


	$stmt = $mysqli->stmt_init();

	//username unik. update data user di database.
	$query = "UPDATE users SET nama = ?, username = ?, jenis_kelamin = ?, email = ?, no_telpon = ?, alamat = ? where id = ?";

	$stmt->prepare($query);

    $stmt->bind_param('ssssssi', $user['nama'],$user['username'],$user['jenis_kelamin'],$user['email'],$user['no_telpon'],$user['alamat'],$user['id']);
    }
	$result = $stmt->execute();
	$result = $stmt->affected_rows;
    if($result){
        $_SESSION['nama'] = $_POST['nama'];
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['jenis_kelamin'] = $_POST['jenis_kelamin'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['no_telpon'] = $_POST['no_telpon'];
        $_SESSION['alamat'] = $_POST['alamat'];
	    $_SESSION['message']  = 'Berhasil mengupdate data profile di sistem.';
        header("Location: lihat_akun.php");
    }else{
        $_SESSION['error'] = 'Gagal update data profile.';
        header("Location: lihat_akun.php");
    }

?>