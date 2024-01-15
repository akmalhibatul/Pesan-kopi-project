<!-- /.content-wrapper -->
<footer class="main-footer">
    <strong>Copyright &copy; MAAHAD KOPI 2023.</strong>
    All rights reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="../../plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Page specific script -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- kategori -->

<script>
    //tambah Kategori
    $(document).ready(function() {
        $("#kategoriForm").submit(function(e) {
            e.preventDefault();

            // Membuat objek FormData untuk mengirim data formulir
            var formData = new FormData(this);

            Swal.fire({
                title: 'Tambah Data Kategori?',
                text: "Apakah Anda yakin ingin menambah data kategori?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Tambah',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "proses_kategori.php",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            Swal.fire({
                                title: "Sukses",
                                text: "Tambah Data Sukses",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                window.location.href = "menu.php";
                            });
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            Swal.fire({
                                title: "Error",
                                text: "Terjadi kesalahan saat menambah data.",
                                icon: "error"
                            });
                        }
                    });
                }
            });
        });
    });

    //edit Kategori
    $(document).ready(function() {
        $("#submitEdit").click(function() {
            var formData = new FormData($("#editKategoriForm")[0]);

            Swal.fire({
                title: 'Edit Data Kategori?',
                text: "Apakah Anda yakin ingin mengedit data kategori?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Edit',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "update_kategori.php",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            Swal.fire({
                                title: "Sukses",
                                text: "Edit Data Sukses",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                window.location.href = "menu.php";
                            });
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            Swal.fire({
                                title: "Error",
                                text: "Terjadi kesalahan saat mengedit data.",
                                icon: "error"
                            });
                        }
                    });
                }
            });
        });
    });

    //hapus Kategori
    function hapusKategori(id_kategori) {
        Swal.fire({
            title: 'Hapus Data Kategori?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "hapus_kategori.php?id_kategori=" + id_kategori,
                    type: "POST",
                    success: function(data) {
                        Swal.fire({
                            title: "Sukses",
                            text: "Hapus Data Sukses",
                            showConfirmButton: false,
                            icon: "success",
                            timer: 2000
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Hapus Data Gagal');
                    }
                });
            }
        });
    }
</script>

<!-- menu -->
<script>
    //tambah menu
    $(document).ready(function() {
        $("#menuForm").submit(function(e) {
            e.preventDefault();

            // Membuat objek FormData untuk mengirim data formulir
            var formData = new FormData(this);

            Swal.fire({
                title: 'Tambah Data Menu?',
                text: "Apakah Anda yakin ingin menambah data menu?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Tambah',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "proses_menu.php",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            Swal.fire({
                                title: "Sukses",
                                text: "Tambah Data Sukses",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                window.location.href = "menu.php";
                            });
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            Swal.fire({
                                title: "Error",
                                text: "Terjadi kesalahan saat menambah data.",
                                icon: "error"
                            });
                        }
                    });
                }
            });
        });
    });

    //edit menu
    $(document).ready(function() {
        $("#editMenuForm").submit(function(event) {
            event.preventDefault(); // Mencegah pengiriman form secara konvensional

            var formData = new FormData($("#editMenuForm")[0]);

            Swal.fire({
                title: 'Edit Data Menu?',
                text: "Apakah Anda yakin ingin mengedit data menu?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Edit',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "update_menu.php",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            Swal.fire({
                                title: "Sukses",
                                text: "Edit Data Sukses",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                window.location.href = "menu.php";
                            });
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            Swal.fire({
                                title: "Error",
                                text: "Terjadi kesalahan saat mengedit data.",
                                icon: "error"
                            });
                        }
                    });
                }
            });
        });
    });

    //hapus menu
    function hapusMenu(id_menu) {
        Swal.fire({
            title: 'Hapus Data Menu?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "hapus_menu.php?id_menu=" + id_menu,
                    type: "POST",
                    success: function(data) {
                        Swal.fire({
                            title: "Sukses",
                            text: "Hapus Data Sukses",
                            showConfirmButton: false,
                            icon: "success",
                            timer: 2000
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Hapus Data Gagal');
                    }
                });
            }
        });
    }

    //qris submit
    function qrisSubmit(id_order, id_user) {
        Swal.fire({
            title: 'Apakah Pelanggan Sudah Konfirmasi ?',
            text: "Pastikan kembali sebelum klik submit !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Submit',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "p_qris.php?id_order=" + id_order + "&id_user=" + id_user,
                    type: "POST",
                    success: function(data) {
                        Swal.fire({
                            title: "Sukses",
                            text: "Sudah Konfirmasi Pembayaran",
                            showConfirmButton: false,
                            icon: "success",
                            timer: 2000
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Qris Gagal');
                    }
                });
            }
        });
    }
</script>

<!-- user -->
<script>
    //tambah user
    $(document).ready(function() {
        $("#userForm").submit(function(e) {
            e.preventDefault();

            // Membuat objek FormData untuk mengirim data formulir
            var formData = new FormData(this);

            Swal.fire({
                title: 'Tambah Data User?',
                text: "Apakah Anda yakin ingin menambah data user?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Tambah',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "proses_user.php",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            Swal.fire({
                                title: "Sukses",
                                text: "Tambah Data Sukses",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                window.location.href = "user.php";
                            });
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            Swal.fire({
                                title: "Error",
                                text: "Terjadi kesalahan saat menambah data.",
                                icon: "error"
                            });
                        }
                    });
                }
            });
        });
    });

    //edit user
    $(document).ready(function() {
        $("#submitEdit").click(function() {
            var formData = new FormData($("#editUserForm")[0]);

            Swal.fire({
                title: 'Edit Data User?',
                text: "Apakah Anda yakin ingin mengedit data user?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Edit',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "update_user.php",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            Swal.fire({
                                title: "Sukses",
                                text: "Edit Data Sukses",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                window.location.href = "user.php";
                            });
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            Swal.fire({
                                title: "Error",
                                text: "Terjadi kesalahan saat mengedit data.",
                                icon: "error"
                            });
                        }
                    });
                }
            });
        });
    });

    //hapus user
    function hapusUser(id_user) {
        Swal.fire({
            title: 'Hapus Data User?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "hapus_user.php?id_user=" + id_user,
                    type: "POST",
                    success: function(data) {
                        Swal.fire({
                            title: "Sukses",
                            text: "Hapus Data Sukses",
                            showConfirmButton: false,
                            icon: "success",
                            timer: 2000
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Hapus Data Gagal');
                    }
                });
            }
        });
    }
</script>

<script>
    // Fungsi untuk menghitung kembalian
    function calculateChange() {
        var total = parseFloat(document.getElementById('inputTotalOrder').value);
        var bayar = parseFloat(document.getElementById('inputBayar').value);
        var kembali = bayar - total;

        if (kembali >= 0) {
            document.getElementById('inputKembali').value = kembali.toFixed(2);
        } else {
            document.getElementById('inputBayar').value = '';
            document.getElementById('inputKembali').value = '';
            Swal.fire({
                title: 'Error',
                text: 'Pembayaran kurang dari total.',
                icon: 'error'
            });
        }
    }

    // Fungsi untuk menyimpan data ke database
    function saveToDatabase() {
        var bayar = parseFloat(document.getElementById('inputBayar').value);
        var kembali = parseFloat(document.getElementById('inputKembali').value);
        var id_order = <?php echo $_GET['id_order']; ?>;
        var id_user = <?php echo $_SESSION['id_user']; ?>;


        // Buat objek FormData
        var formData = new FormData();
        formData.append('bayar', bayar);
        formData.append('kembali', kembali);
        formData.append('id_order', id_order);
        formData.append('id_user', id_user);


        // Panggil skrip PHP menggunakan Ajax
        fetch('save_to_database.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: 'Sukses',
                        text: 'Data berhasil disimpan ke database.',
                        icon: 'success'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Redirect ke halaman order.php
                            window.location.href = 'order.php';
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: 'Terjadi kesalahan saat menyimpan data ke database.',
                        icon: 'error'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error',
                    text: 'Terjadi kesalahan saat mengirim data ke server.',
                    icon: 'error'
                });
            });
    }

    // Fungsi untuk menampilkan form SweetAlert
    function showForm(id_order) {
        // Panggil get_order_data.php menggunakan Ajax
        var id_user = <?php echo $_SESSION['id_user']; ?>;

        fetch('get_order_data.php?id_order=' + id_order) // Ganti dengan order_id yang sesuai
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    Swal.fire({
                        title: 'Error',
                        text: data.error,
                        icon: 'error'
                    });
                } else {
                    Swal.fire({
                        title: 'Kasir Sederhana',
                        html: `
                        <form id="kasirForm">
    <table>
        <tr>
            <td><label>No. Order</label></td>
            <td><input type="text" value="${data.no_order}" readonly></td>
        </tr>
        <tr>
            <td><label>Tanggal Order</label></td>
            <td><input type="text" value="${data.tanggal_order}" readonly></td>
        </tr>
        <tr>
            <td><label>Nama Pembeli</label></td>
            <td><input type="text" value="${data.nama_pelanggan}" readonly></td>
        </tr>
        <tr>
            <td><label>TOTAL</label></td>
            <td><input type="text" id="inputTotalOrder" value="${data.total_order}" readonly></td>
        </tr>
        <tr>
            <td><label>Bayar</label></td>
            <td><input type="text" id="inputBayar" onchange="calculateChange()"></td>
        </tr>
        <tr>
            <td><label>Kembali</label></td>
            <td><input type="text" id="inputKembali" readonly></td>
        </tr>
    </table>
</form>

                        `,
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonText: 'Simpan',
                        cancelButtonText: 'Batal',
                        didOpen: () => {
                            // Fokuskan input bayar saat form terbuka
                            document.getElementById('inputBayar').focus();
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Panggil fungsi untuk menyimpan data ke database
                            saveToDatabase();
                        }
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error',
                    text: 'Terjadi kesalahan saat mengambil data.',
                    icon: 'error'
                });
            });
    }
</script>

<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": [{
                extend: 'pdf',
                text: 'EXPORT PDF',
                title: 'Judul Laporan', // Tambahkan judul yang diinginkan di sini
                exportOptions: {
                    columns: ':visible'
                }
            }, ]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
        $('#example3').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>

<script>
    const refreshButton = document.getElementById("refreshButton");

    refreshButton.addEventListener("click", function() {
        location.reload(); // Ini akan memuat ulang halaman web saat tombol ditekan.
    });
</script>
</body>

</html>