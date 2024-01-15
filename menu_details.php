<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
    <title>MAHAAD KOPI || COFFE SHOP</title>
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
                        <li><a href="mailto:example@gmail.com"><i class="fas fa-envelope"></i> examplemail@gmail.com</a>
                        </li>
                        <li class="d-none d-md-block"><a href="callto:123456789"><i class="fas fa-phone-alt"></i>
                                +62 81296986101</a></li>
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
        BREADCRUMB START
    ==============================-->
    <section class="tf__breadcrumb" style="background-color: #212121 ;">
        <div class="tf__breadcrumb_overlay">
            <div class="container">
                <div class="tf__breadcrumb_text">
                    <h1>menu Details</h1>
                    <ul>
                        <li><a href="index.php">home</a></li>
                        <li><a href="#">menu Details</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
        BREADCRUMB END
    ==============================-->


    <!--=============================
        MENU DETAILS START
    ==============================-->
    <section class="tf__menu_details mt_100 xs_mt_75 mb_95 xs_mb_65">
        <div class="container">
            <div class="row">
                <?php
                include('backend/koneksi.php');
                $id_menu = $_GET['id_menu'];
                $query = mysqli_query($koneksi, "SELECT * FROM tb_menu WHERE id_menu = '$id_menu'");
                while ($m = mysqli_fetch_array($query)) {
                    $hargaMenu = $m['harga'];
                ?>
                    <div class="col-lg-5 col-sm-10 col-md-9 wow fadeInUp" data-wow-duration="1s">
                        <div class="exzoom hidden">
                            <div class="exzoom_img_box tf__menu_details_images">
                                <ul class='exzoom_img_ul'>
                                    <li><img class="zoom ing-fluid w-100" src="admin/img/menu/<?= $m['img_menu']; ?>" alt="product"></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 wow fadeInUp" data-wow-duration="1s">
                        <div class="tf__menu_details_text">
                            <h2><?= $m['nama_menu']; ?></h2>
                            <h3 class="price">Rp. <?= number_format($m['harga']) ?></h3>
                            <p class="rating">

                            </p>
                            <p class="short_description"><?= $m['deskripsi']; ?>.</p>

                            <div class="details_quentity">
                                <h5>select quantity</h5>
                                <div class="quentity_btn_area d-flex flex-wrapa align-items-center">
                                    <div class="quentity_btn">
                                        <button class="btn btn-danger" onclick="minusProduct()"><i class="fal fa-minus"></i></button>
                                        <input disabled="" type="text" value="1" id="qtyProduct" class="valueJml" name="jumlah">
                                        <button class="btn btn-success" onclick="plusProduct()"><i class="fal fa-plus"></i></button>
                                    </div>
                                    <h3 id="totalPrice">Rp. <?= number_format($hargaMenu) ?></h3>
                                </div>
                            </div>
                            <ul class="details_button_area d-flex flex-wrap">
                                <li>
                                    <a class="common_btn addToCart" href="#" data-id_menu="<?= $id_menu; ?>">add to cart</a>
                                </li>
                            </ul>
                        </div>
                    </div>
            </div>
        <?php } ?>
        </div>
    </section>

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
                            <p class="info"><i class="fas fa-phone-alt"></i> +62 81296986101</p>
                            <p class="info"><i class="fas fa-envelope"></i> examplemail@gmail.com</p>
                            <p class="info"><i class="far fa-map-marker-alt"></i> Pd. Jagung Tim., Kec. Serpong Utara, Kota Tangerang Selatan, Banten</p>
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
                            <p>Copyright ©<b> RegFood</b> 2023. All Rights Reserved</p>
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
        function plusProduct() {
            let inputJml = parseInt($("input.valueJml").val());
            var harga = parseInt(<?= $hargaMenu ?>);

            inputJml = inputJml + 1;
            $("input.valueJml").val(inputJml);
            updateTotalPrice(inputJml, harga);
        }

        function minusProduct() {
            let inputJml = parseInt($("input.valueJml").val());
            var harga = parseInt(<?= $hargaMenu ?>);

            if (inputJml > 0) {
                inputJml = inputJml - 1;
                $("input.valueJml").val(inputJml);
                updateTotalPrice(inputJml, harga);
            }
        }

        function updateTotalPrice(quantity, harga) {
            const newPrice = quantity * harga;
            const formatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            });
            const formattedPrice = formatter.format(newPrice);
            $("#totalPrice").text(formattedPrice);
        }

        $(document).ready(function() {
            $('.addToCart').on('click', function(event) {
                event.preventDefault();

                var id_menu = $(this).data('id_menu');
                var qty = parseInt($("#qtyProduct").val()); // Mengambil nilai kuantitas dari input

                $.ajax({
                    url: 'add_to_cart_ajax.php',
                    type: 'POST',
                    data: {
                        id_menu: id_menu,
                        qty: qty // Mengirim nilai kuantitas ke server
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

    <!-- <script>
        function plusProduct() {
            let inputJml = parseInt($("input.valueJml").val());
            var harga = parseInt(<?= $hargaMenu ?>);

            inputJml = inputJml + 1;
            $("input.valueJml").val(inputJml);
            const newPrice = inputJml * harga;

            // Format angka dengan menggunakan Intl.NumberFormat
            const formatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0, // Hapus desimal
                maximumFractionDigits: 0 // Hapus desimal
            });
            const formattedPrice = formatter.format(newPrice);

            $("#totalPrice").text(formattedPrice);
        }

        function minusProduct() {
            let inputJml = parseInt($("input.valueJml").val());
            var harga = parseInt(<?= $hargaMenu ?>);

            if (inputJml > 0) {
                inputJml = inputJml - 1;
                $("input.valueJml").val(inputJml);
                const newPrice = inputJml * harga;

                // Format angka dengan menggunakan Intl.NumberFormat
                const formatter = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0, // Hapus desimal
                    maximumFractionDigits: 0 // Hapus desimal
                });
                const formattedPrice = formatter.format(newPrice);

                $("#totalPrice").text(formattedPrice);
            }
        }
    </script> -->
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


<!-- Mirrored from html.themefax.com/regfood/menu_details.php by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 10 Aug 2023 02:11:37 GMT -->

</html>