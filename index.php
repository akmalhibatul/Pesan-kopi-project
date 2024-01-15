<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
    <title>MAHAAD KOPI</title>
    <link rel="icon" type="image/png" href="images/icon.png">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/venobox.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/jquery.exzoom.css">

    <link rel="stylesheet" href="css/spacing.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>

<body>

    <!--=============================
        TOPBAR START
    ==============================-->
    <section class="tf__topbar">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-sm-6 col-md-8">
                    <ul class="tf__topbar_info d-flex flex-wrap d-none d-sm-flex">
                        <li><a href="mailto:example@gmail.com"><i class="fas fa-envelope"></i> mahadkopi@gmail.com</a>
                        </li>
                        <li class="d-none d-md-block"><a href="callto:123456789"><i class="fas fa-phone-alt"></i>
                        +62 878-5595-2576</a></li>
                    </ul>
                </div>
                <div class="col-xl-6 col-sm-6 col-md-4">
                    <ul class="topbar_icon d-flex flex-wrap">
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a> </li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a> </li>
                        <li><a href="#"><i class="fab fa-instagram"></i></a> </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
        TOPBAR END
    ==============================-->


    <!--=============================
        MENU START
    ==============================-->
    <nav class="navbar navbar-expand-lg main_menu">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="images/logo-maahadkopi.png" alt="RegFood" class="img-fluid">
            </a>
            <ul class="menu_icon d-flex flex-wrap">
                <?php
                // Hitung jumlah item dalam keranjang
                $jumlah_item_keranjang = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
                ?>

                <li>
                    <a class="cart_icon" href="cart_view.php"><i class="fas fa-shopping-basket"></i>
                        <span><?php echo $jumlah_item_keranjang; ?></span></a>
                </li>

            </ul>
        </div>
    </nav>
    <!--=============================
        MENU END
    ==============================-->


    <!--=============================
        BANNER START
    ==============================-->
    <section class="tf__banner">
        <div class="tf__banner_overlay">
            <div class="col-12">
                <div class="tf__banner_slider" style="background: url(images/bg-kopi.jpg);">
                    <div class="tf__banner_slider_overlay">
                        <div class=" container">
                            <div class="row justify-content-center">
                                <div class="col-xxl-6 col-xl-6 col-md-10 col-lg-6">
                                    <div class="tf__banner_text wow fadeInLeft" data-wow-duration="1s">
                                        <h3>Kopi Aroma Nikmat</h3>
                                        <h1>Kisah Hangat di Setiap Gigitan, Coffee Shop Impian.</h1>
                                        <p>Selamat datang di Coffee Shop Kami, tempat di mana rasa dan senyum selalu berkumpul dalam harmoni yang sempurna.</p>

                                    </div>
                                </div>
                                <div class="col-xxl-5 col-xl-6 col-sm-10 col-md-9 col-lg-6">
                                    <div class="tf__banner_img wow fadeInRight" data-wow-duration="1s">
                                        <div class="img">
                                            <img src="images/b.JPG" alt="food item" class="img-fluid w-100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
        BANNER END
    ==============================-->
    <!--=============================
        OFFER ITEM END
    ==============================-->

    <!--=============================
        MENU ITEM START
    ==============================-->
    <section class="tf__menu mt_95 xs_mt_65 mb-7">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 wow">
                    <div class="tf__section_heading mb_25">
                        <h4>Daftar Menu</h4>
                        <h2>Menu Rekomendasi</h2>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 wow">
                    <div class="menu_filter d-flex flex-wrap">
                        <button class=" active" data-filter="*">Semua Menu</button>
                        <?php
                        include 'backend/koneksi.php';
                        $sql = "SELECT * FROM tb_kategori";
                        $query = mysqli_query($koneksi, $sql);
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                            <button data-filter=".<?= $data['nama_kategori']; ?>"><?= $data['nama_kategori']; ?></button>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="row grid">
                <?php
                $sql = "SELECT * FROM `tb_menu` INNER JOIN tb_kategori ON tb_kategori.id_kategori = tb_menu.id_kategori";
                $query = mysqli_query($koneksi, $sql);
                while ($data = mysqli_fetch_array($query)) {
                ?>
                    <div class="col-xxl-3 col-sm-6 col-lg-4 <?= $data['nama_kategori']; ?> wow">
                        <div class="tf__menu_item">
                            <div class="tf__menu_item_img">
                                <img src="admin/img/menu/<?= $data['img_menu']; ?>" alt="menu" class="img-fluid w-100">
                            </div>
                            <div class="tf__menu_item_text">
                                <a class="category" href="#"><?= $data['nama_kategori']; ?></a>
                                <a class="title" href="menu_details.php?id_menu=<?= $data['id_menu']; ?>"><?= $data['nama_menu']; ?></a>
                                <h5 class="price">Rp. <?= number_format($data['harga']); ?></h5>
                                <a class="tf__add_to_cart" href="add_to_cart_ajax.php" data-id_menu="<?= $data['id_menu']; ?>">Tambah Pesanan</a>
                                <ul class="d-flex flex-wrap justify-content-end">
                                    <li><a href="menu_details.php?id_menu=<?= $data['id_menu']; ?>"><i class="far fa-eye"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </section>
    <!--=============================
        MENU ITEM END
    ==============================-->

    <!--=============================
        FOOTER START
    ==============================-->
    <footer style="background-color: #3C2A21 ;">
        <div class="footer_overlay pt_100 xs_pt_70 pb_100 xs_pb_20">
            <div class="container wow">
                <div class="row justify-content-between">
                    <div class="col-xxl-4 col-lg-4 col-sm-9 col-md-7">
                        <div class="tf__footer_content">
                            <a class="footer_logo" href="index.php">
                                <img src="images/footer-logo.jpg" alt="RegFood" class="img-fluid w-100">
                            </a>
                            <span>Selamat datang di Mahhad Kopi, destinasi utama bagi pecinta kopi. Temukan ragam biji kopi pilihan dan nikmati pengalaman kopi yang luar biasa. Dari Espresso yang kuat hingga Cappuccino yang lembut, rasa dan aroma kami tak tertandingi. Selamat datang dalam dunia cita rasa yang menggugah di Mahhad Kopi!.</span>
                            <ul class="social_link d-flex flex-wrap">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-lg-4 col-sm-9 col-md-7 order-lg-4">
                        <div class="tf__footer_content">
                            <h3>contact us</h3>
                            <p class="info"><i class="fas fa-phone-alt"></i> +62 878-5595-2576</p>
                            <p class="info"><i class="fas fa-envelope"></i> mahadkopi@gmail.com</p>
                            <p class="info"><i class="far fa-map-marker-alt"></i> Pd. Jagung Timur, Kec. Serpong Utara, Kota Tangerang Selatan, Banten</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tf__footer_bottom d-flex flex-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="tf__footer_bottom_text">
                            <p>Copyright ©<b> Maahad Kopi</b> 2023. All Rights Reserved</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--=============================
        FOOTER END
    ==============================-->


    <!--jquery library js-->
    <script src="js/jquery-3.6.0.min.js"></script>

    <script src="sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('.tf__add_to_cart').on('click', function(event) {
                event.preventDefault();

                var id_menu = $(this).data('id_menu');
                var qty = 1;

                $.ajax({
                    url: 'add_to_cart_ajax.php',
                    type: 'POST',
                    data: {
                        id_menu: id_menu,
                        qty: qty
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: "Sukses!",
                                text: "Menu Berhasil Masuk ke Keranjang!",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: "Gagal!",
                                text: "Menu Gagal Masuk ke Keranjang.",
                                icon: "error",
                                confirmButtonText: "Ok"
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>

    <!--bootstrap js-->
    <script src="js/bootstrap.bundle.min.js"></script>
    <!--font-awesome js-->
    <script src="js/Font-Awesome.js"></script>
    <!-- slick slider -->
    <script src="js/slick.min.js"></script>
    <!-- isotop js -->
    <script src="js/isotope.pkgd.min.js"></script>
    <!-- counter up js -->
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.countup.min.js"></script>
    <!-- nice select js -->
    <script src="js/jquery.nice-select.min.js"></script>
    <!-- venobox js -->
    <script src="js/venobox.min.js"></script>
    <!-- sticky sidebar js -->
    <script src="js/sticky_sidebar.js"></script>
    <!-- wow js -->
    <script src="js/wow.min.js"></script>
    <!-- ex zoom js -->
    <script src="js/jquery.exzoom.js"></script>

    <!--main/custom js-->
    <script src="js/main.js"></script>

</body>


<!-- Mirrored from html.themefax.com/regfood/index.php by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 10 Aug 2023 02:11:28 GMT -->

</html>