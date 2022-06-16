<?php
// Include db file
require_once "db.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = $nama = $jenis_kelamin = $email = $alamat = $no_telpon = "";
$username_err = $password_err = $confirm_password_err = $nama_err = $jenis_kelamin_err = $email_err = $alamat_err = $no_telpon_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    if(empty(trim($_POST["nama"]))){
        $nama_err = "Please enter a nama.";     
    } elseif(strlen(trim($_POST["nama"])) < 6){
        $nama_err = "nama must have atleast 6 characters.";
    } else{
        $nama = trim($_POST["nama"]);
    }
    if(empty(trim($_POST["jenis_kelamin"]))){
        $jenis_kelamin_err = "Please enter a jenis_kelamin.";
    } else{
        $jenis_kelamin = trim($_POST["jenis_kelamin"]);
    }
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter a email.";     
    } elseif(strlen(trim($_POST["email"])) < 6){
        $email_err = "email must have atleast 6 characters.";
    } else{
        $email = trim($_POST["email"]);
    }
    if(empty(trim($_POST["alamat"]))){
        $alamat_err = "Please enter a alamat.";     
    } elseif(strlen(trim($_POST["alamat"])) < 6){
        $alamat_err = "alamat must have atleast 6 characters.";
    } else{
        $alamat = trim($_POST["alamat"]);
    }
    if(empty(trim($_POST["no_telpon"]))){
        $no_telpon_err = "Please enter a no_telpon.";
    } elseif(!ctype_digit($input_harga_produk)){
        $no_telpon_err = "Masukkan hanya angka";
    } elseif(strlen(trim($_POST["alamat"])) > 12){
        $no_telpon_err = "Maksimal 12 digit angka";
    } else{
        $no_telpon = trim($_POST["no_telpon"]);
    }
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)&& empty($nama_err)&& empty($jenis_kelamin_err)&& empty($email_err)&& empty($alamat_err)&& empty($no_telpon_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password, nama, jenis_kelamin, email, alamat, no_telpon) VALUES (?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssssssi", $param_username, $param_password, $param_nama, $param_jenis_kelamin, $param_email, $param_alamat, $param_no_telpon);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_nama = $nama;
            $param_jenis_kelamin = $jenis_kelamin;
            $param_email = $email;
            $param_alamat = $alamat;
            $param_no_telpon = $no_telpon;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
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
    <title>Registrasi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
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
        <section class="h-100 gradient-form">
            <div class="container py-2 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-xl-10">
                        <div class="card rounded-3 text-black" style="background-color:navajowhite">
                            <div class="row g-0">
                                <div class="col-lg-6">
                                    <div class="card-body p-md-5 mx-md-4">
                                        <div class="text-center">
                                        <img src="https://mimindonesia.com/wp-content/uploads/2021/07/cropped-Untitled-1.png"
                                            style="width: 100px;" alt="logo">
                                        <h4 class="mt-1 mb-5 pb-1">Kopi Rempah Syaco</h4>
                                        </div>

                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                            <p>Mohon mengisi formulir berikut untuk membuat akun</p>

                                            <div class="form-outline mb-4">
                                                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">Username</label>
                                                <span class="invalid-feedback"><?php echo $username_err; ?></span>
                                            </div>

                                            <div class="form-outline mb-4">
                                                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                                                <span class="invalid-feedback"><?php echo $password_err; ?></span>
                                                <label class="form-label" for="form2Example22">Password</label>
                                            </div>
                                            <div class="form-outline mb-4">
                                                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                                                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                                                <label>Konfirmasi Password</label>
                                            </div>

                                            <div class="form-outline mb-4">
                                                <input type="text" name="nama" class="form-control <?php echo (!empty($nama_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nama; ?>">Nama Lengkap</label>
                                                <span class="invalid-feedback"><?php echo $nama_err; ?></span>
                                            </div>

                                            <div class="form-outline mb-4">
                                                <input type="text" name="jenis_kelamin" class="form-control <?php echo (!empty($jenis_kelamin_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $jenis_kelamin; ?>">jenis_kelamin</label>
                                                <span class="invalid-feedback"><?php echo $jenis_kelamin_err; ?></span>
                                            </div>

                                            <div class="form-outline mb-4">
                                                <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">email</label>
                                                <span class="invalid-feedback"><?php echo $email_err; ?></span>
                                            </div>

                                            <div class="form-outline mb-4">
                                                <input type="text" name="alamat" class="form-control <?php echo (!empty($alamat_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $alamat; ?>">alamat</label>
                                                <span class="invalid-feedback"><?php echo $alamat_err; ?></span>
                                            </div>

                                            <div class="form-outline mb-4">
                                                <input type="number" name="no_telpon" class="form-control <?php echo (!empty($no_telpon_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $no_telpon; ?>">no_telpon</label>
                                                <span class="invalid-feedback"><?php echo $no_telpon_err; ?></span>
                                            </div>

                                            <div class="text-center pt-1 mb-5 pb-1">
                                                <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit" style="color:black" value="submit">Daftar</button>
                                                <a class="text-muted" href="lupa_pw.php">Lupa password?</a>
                                            </div>
                                            <p class="text-center">Sudah memiliki akun? <a href="login.php">Login disini</a>.</p>
                                        </form>

                                    </div>
                                    </div>
                                    <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                    <div class="text-black px-3 py-4 p-md-5 mx-md-4">
                                        <h2 class="mb-4">Bukan Sekedar Kopi</h2>
                                        <h3 class="mb-0"><i class="fa-solid fa-mug-hot"></i> Biji Kopi Pilihan <br>
                                        <i class="fa-solid fa-mug-hot"></i> Kapulogo <br>
                                        <i class="fa-solid fa-mug-hot"></i> Habatussaudah <br>
                                        <i class="fa-solid fa-mug-hot"></i> Jahe Jawa <br>
                                        <i class="fa-solid fa-mug-hot"></i> Bahan Herba Lainnya</h3> <br>
                                        <br><br>
                                        <h4 class="mb-0">Manfaat Bubuk Kopi Syaco</h4>
                                        <p class="small mb-0"><i class="fa-solid fa-angles-right"></i>Menghangatkan badan</p>
                                        <p class="small mb-0"><i class="fa-solid fa-bacon"></i>Melegakan nafas</p>
                                        <p class="small mb-0"><i class="fa-solid fa-hand-holding-medical"></i>Mencegah perut kembung atau masuk angin</p>
                                        <p class="small mb-0"><i class="fa-solid fa-briefcase-medical"></i>Sangat baik untuk vitalitas</p>
                                    </div>
                                </div>
                            </div>
                            <p>Kelompok B Kelas F || <a href="https://github.com/FerryJohanes/Web-Application-Syaco/">Source Code Github</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>