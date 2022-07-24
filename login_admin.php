<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Admin | Login</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>
<style>
  .alert{
    color: red;
    text-align: center;
    font-weight: bold;
  }
</style>

<body>

<section class="vh-100" style="background-color: rgba(126, 217, 87, 0.9);">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="assets/img/loginimg.png" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <form action="cek_login_admin.php" method="post">

                  <div class="d-flex justify-content-center align-items-center mb-3 pb-1">
                    <!-- <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i> -->
                    <h3 class="h3 fw-bold mb-0">Silahkan Masuk Sebagai Admin</h3>
                  </div>

                  <?php 
                    if(isset($_GET['pesan'])){
                      if($_GET['pesan']=="gagal"){
                        echo "<p class='alert'>Nomer Telephone dan Password tidak sesuai!</p>";
                      }
                    }
                  ?>

                  <div class="form-outline mb-4">
                    <input style="font-size:12pt;" type="text" name="no_telepon" id="form2Example17" placeholder="Masukkan Nomer Telephone..." required="required" class="form-control form-control-lg" />
                    <label class="form-label" for="form2Example17">Nomer Telephone</label>
                  </div>

                  <div class="form-outline mb-4">
                    <input style="font-size:12pt;" type="password" name="password" id="form2Example27" placeholder="Masukkan password .." required="required" class="form-control form-control-lg" />
                    <label class="form-label" for="form2Example27">Password</label>
                  </div>

                  <div class="d-flex justify-content-center pt-1 mb-4">
                    <input class="btnRegister w-75 mt-4 py-3 border-0 border-radius-lg" style="color:white; background-color:rgba(86,152,61, 0.9);; max-width: 200px; max-height: 54px; border-radius: 1.5rem; cursor: pointer;" type="submit" value="LOGIN">
                  </div>

                  <div class="text-center">
                    <a class="small text-muted" href="#!">Lupa password?</a>
                    <p class="mb-5 pb-lg-2" style="color: #393f81;">Belum punya akun? <a href="#!"
                        style="color: #393f81;">Daftar disini!</a></p>
                    <a href="index.php" class="small text-muted">Kembali</a>
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>
</html>