<!DOCTYPE html>
<?php
require_once 'controllers.php';
require_once 'koneksi.php';

$controller = new Controller();
$transaksis = $controller->getTransaksiData($conn);
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Transaksi</title>
    <meta name="author" content="David Grzyb">
    <meta name="description" content="">

    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

        .font-family-karla {
            font-family: karla;
        }

        .bg-sidebar {
            background: #3d68ff;
        }

        .cta-btn {
            color: #3d68ff;
        }

        .upgrade-btn {
            background: #1947ee;
        }

        .upgrade-btn:hover {
            background: #0038fd;
        }

        .active-nav-link {
            background: #1947ee;
        }

        .nav-item:hover {
            background: #1947ee;
        }

        .account-link:hover {
            background: #3d68ff;
        }
    </style>
</head>

<body class="bg-gray-100 font-family-karla flex">

    <aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
        <div class="p-6">
            <a href="dashboard.php" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">WRM</a>
            <a href="formTambahTransaksi.php" class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
                <i class="fas fa-plus mr-3"></i> Transaksi Baru
            </a>
        </div>
        <nav class="text-white text-base font-semibold pt-3">
            <a href="dashboard.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-home mr-3"></i>
                Dashboard
            </a>
            <a href="indexBarang.php" class="flex items-center opacity-75 hover:opacity-100 text-white py-4 pl-6 nav-item">
                <i class="fas fa-box mr-3"></i>
                Barang
            </a>
            <a href="indexGudang.php" class="flex items-center text-white opacity-75 hover:opacity-100  py-4 pl-6 nav-item">
                <i class="fas fa-warehouse mr-3"></i>
                Gudang
            </a>
            <a href="indexPemasok.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-user-tie mr-3"></i>
                Pemasok
            </a>
            <a href="indexTransaksi.php" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
                <i class="fas fa-file-invoice mr-3"></i>
                Transaksi
            </a>
            <a href="indexUser.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-users mr-3"></i>
                Users
            </a>
        </nav>
    </aside>

    <div class="relative w-full flex flex-col h-screen overflow-y-hidden">
        <!-- Desktop Header -->
        <header class="w-full items-center bg-white py-2 px-6 hidden sm:flex">
            <div class="w-1/2"></div>
            <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
                <button @click="isOpen = !isOpen" class="realtive z-10 w-12 h-12 rounded-full overflow-hidden border-2 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none">
                    <svg height="44px" width="44px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 60.671 60.671" xml:space="preserve" fill="#ddddd"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <ellipse style="fill:#010002;" cx="30.336" cy="12.097" rx="11.997" ry="12.097"></ellipse> <path style="fill:#010002;" d="M35.64,30.079H25.031c-7.021,0-12.714,5.739-12.714,12.821v17.771h36.037V42.9 C48.354,35.818,42.661,30.079,35.64,30.079z"></path> </g> </g> </g></svg>
                </button>
                <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>
                <div x-show="isOpen" class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
                    <a href="#" class="block px-4 py-2 account-link hover:text-white">Account</a>
                    <a href="#" class="block px-4 py-2 account-link hover:text-white">Support</a>
                    <a href="#" class="block px-4 py-2 account-link hover:text-white">Sign Out</a>
                </div>
            </div>
        </header>

        <!-- Mobile Header & Nav -->
        <header x-data="{ isOpen: false }" class="w-full bg-sidebar py-5 px-6 sm:hidden">
            <div class="flex items-center justify-between">
                <a href="index.html" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>
                <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
                    <i x-show="!isOpen" class="fas fa-bars"></i>
                    <i x-show="isOpen" class="fas fa-times"></i>
                </button>
            </div>

            <!-- Dropdown Nav -->
            <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">
                <a href="index.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>
                <a href="blank.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-sticky-note mr-3"></i>
                    Blank Page
                </a>
                <a href="tables.html" class="flex items-center active-nav-link text-white py-2 pl-4 nav-item">
                    <i class="fas fa-table mr-3"></i>
                    Tables
                </a>
                <a href="forms.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-align-left mr-3"></i>
                    Forms
                </a>
                <a href="tabs.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-tablet-alt mr-3"></i>
                    Tabbed Content
                </a>
                <a href="calendar.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-calendar mr-3"></i>
                    Calendar
                </a>
                <a href="#" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-cogs mr-3"></i>
                    Support
                </a>
                <a href="#" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-user mr-3"></i>
                    My Account
                </a>
                <a href="#" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    Sign Out
                </a>
                <button class="w-full bg-white cta-btn font-semibold py-2 mt-3 rounded-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
                    <i class="fas fa-arrow-circle-up mr-3"></i> Upgrade to Pro!
                </button>
            </nav>
            <!-- <button class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
                <i class="fas fa-plus mr-3"></i> New Report
            </button> -->
        </header>

        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <h1 class="text-3xl text-black pb-6">Transaksi</h1>

                <!-- <div class="w-full mt-6">
                    <p class="text-xl pb-3 flex items-center">
                        <i class="fas fa-list mr-3"></i> Table Example
                    </p>
                    <div class="bg-white overflow-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Name</th>
                                    <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Last name</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Phone</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Email</td>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                                <tr>
                                    <td class="w-1/3 text-left py-3 px-4">Lian</td>
                                    <td class="w-1/3 text-left py-3 px-4">Smith</td>
                                    <td class="text-left py-3 px-4"><a class="hover:text-blue-500" href="tel:622322662">622322662</a></td>
                                    <td class="text-left py-3 px-4"><a class="hover:text-blue-500" href="mailto:jonsmith@mail.com">jonsmith@mail.com</a></td>
                                </tr>
                                <tr class="bg-gray-200">
                                    <td class="w-1/3 text-left py-3 px-4">Emma</td>
                                    <td class="w-1/3 text-left py-3 px-4">Johnson</td>
                                    <td class="text-left py-3 px-4"><a class="hover:text-blue-500" href="tel:622322662">622322662</a></td>
                                    <td class="text-left py-3 px-4"><a class="hover:text-blue-500" href="mailto:jonsmith@mail.com">jonsmith@mail.com</a></td>
                                </tr>
                                <tr>
                                    <td class="w-1/3 text-left py-3 px-4">Oliver</td>
                                    <td class="w-1/3 text-left py-3 px-4">Williams</td>
                                    <td class="text-left py-3 px-4"><a class="hover:text-blue-500" href="tel:622322662">622322662</a></td>
                                    <td class="text-left py-3 px-4"><a class="hover:text-blue-500" href="mailto:jonsmith@mail.com">jonsmith@mail.com</a></td>
                                </tr>
                                <tr class="bg-gray-200">
                                    <td class="w-1/3 text-left py-3 px-4">Isabella</td>
                                    <td class="w-1/3 text-left py-3 px-4">Brown</td>
                                    <td class="text-left py-3 px-4"><a class="hover:text-blue-500" href="tel:622322662">622322662</a></td>
                                    <td class="text-left py-3 px-4"><a class="hover:text-blue-500" href="mailto:jonsmith@mail.com">jonsmith@mail.com</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p class="pt-3 text-gray-600">
                        Source: <a class="underline" href="https://tailwindcomponents.com/component/striped-table">https://tailwindcomponents.com/component/striped-table</a>
                    </p>
                </div> -->

                <!-- <div class="w-full mt-12">
                    <p class="text-xl pb-3 flex items-center">
                        <i class="fas fa-list mr-3"></i> Table Example
                    </p>
                    <div class="bg-white overflow-auto">
                        <table class="text-left w-full border-collapse"> 
                            <thead>
                                <tr>
                                    <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Name</th>
                                    <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Last Name</th>
                                    <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Phone</th>
                                    <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="hover:bg-grey-lighter">
                                    <td class="py-4 px-6 border-b border-grey-light">Lian</td>
                                    <td class="py-4 px-6 border-b border-grey-light">Smith</td>
                                    <td class="py-4 px-6 border-b border-grey-light">622322662</td>
                                    <td class="py-4 px-6 border-b border-grey-light">jonsmith@mail.com</td>
                                </tr>
                                <tr class="hover:bg-grey-lighter">
                                    <td class="py-4 px-6 border-b border-grey-light">Lian</td>
                                    <td class="py-4 px-6 border-b border-grey-light">Smith</td>
                                    <td class="py-4 px-6 border-b border-grey-light">622322662</td>
                                    <td class="py-4 px-6 border-b border-grey-light">jonsmith@mail.com</td>
                                </tr>
                                <tr class="hover:bg-grey-lighter">
                                    <td class="py-4 px-6 border-b border-grey-light">Lian</td>
                                    <td class="py-4 px-6 border-b border-grey-light">Smith</td>
                                    <td class="py-4 px-6 border-b border-grey-light">622322662</td>
                                    <td class="py-4 px-6 border-b border-grey-light">jonsmith@mail.com</td>
                                </tr>
                                <tr class="hover:bg-grey-lighter">
                                    <td class="py-4 px-6 border-b border-grey-light">Lian</td>
                                    <td class="py-4 px-6 border-b border-grey-light">Smith</td>
                                    <td class="py-4 px-6 border-b border-grey-light">622322662</td>
                                    <td class="py-4 px-6 border-b border-grey-light">jonsmith@mail.com</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p class="pt-3 text-gray-600">
                        Source: <a class="underline" href="https://tailwindcomponents.com/component/table">https://tailwindcomponents.com/component/table</a>
                    </p>
                </div> -->

                <div class="w-full mt-12">
                    <div class="flex justify-between">
                        <p class="text-xl pb-3 flex items-center">
                            <i class="fas fa-list mr-3"></i> Tabel Transaksi
                        </p>

                        <a href="formTambahTransaksi.php" class="bg-sidebar hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4"><i class="fa fa-plus mr-2"></i> Tambah</a>


                    </div>
                    <div class="bg-white overflow-auto p-5">
                        <table class="display w-full" id="table-transaksi">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Tipe Transaksi</th>
                                    <th>Jumlah</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($transaksis)):
                                    foreach ($transaksis as $transaksi):
                                ?>
                                        <tr>
                                            <td><?= $transaksi['nama_barang'] ?></td>
                                            <td><?= $transaksi['tipe_transaksi'] ?></td>
                                            <td><?= $transaksi['jumlah'] ?></td>
                                            <td><?= $transaksi['tgl_transaksi'] ?></td>
                                            <td>
                                                <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded show-button" data-id="<?= $transaksi['id'] ?>"><i class="fa fa-eye"></i></a>
                                                <a href="formEditTransaksi.php?id=<?= $transaksi['id'] ?>" class="bg-yellow-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"><i class="fa fa-pen"></i></a>
                                                <a href="logic/hapus.php?m=transaksi&id=<?= $transaksi['id'] ?>" class="bg-red-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded delete-btn" data-id="<?= $transaksi['id'] ?>"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                <?php endforeach;
                                endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Modal structure -->
                <div id="editModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
                    <div class="flex items-center justify-center min-h-screen p-4 text-center">
                        <div class="relative bg-white rounded-lg shadow-xl w-full max-w-md">
                            <!-- Modal header -->
                            <div class="flex justify-between items-center p-4 border-b">
                                <h3 class="text-lg font-semibold text-gray-900">Detail Transaksi</h3>
                                <button id="closeModal" class="text-gray-400 hover:text-gray-500">
                                    <span class="text-xl">&times;</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-4">
                                <form id="editForm">
                                    <div class="mb-4">
                                        <label for="nama_barang" class="block text-left text-sm font-medium text-gray-700">Nama Barang</label>
                                        <input type="text" id="nama_barang" name="nama_barang" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" readonly>
                                    </div>
                                    <div class="mb-4">
                                        <label for="tipe_transaksi" class="block text-left text-sm font-medium text-gray-700">Tipe Transaksi</label>
                                        <input type="text" id="tipe_transaksi" name="tipe_transaksi" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" readonly>
                                    </div>
                                    <div class="mb-4">
                                        <label for="jumlah" class="block text-left text-sm font-medium text-gray-700">Jumlah</label>
                                        <input type="text" id="jumlah" name="jumlah" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" readonly>
                                    </div>
                                    <div class="mb-4">
                                        <label for="tgl_transaksi" class="block text-left text-sm font-medium text-gray-700">Tanggal Transaksi</label>
                                        <input type="text" id="tgl_transaksi" name="tgl_transaksi" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" readonly>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </main>

            <footer class="w-full bg-white text-right p-4">
                Built by <a href="javascript:void()" class="underline">Kelompok 5</a>.
            </footer>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.tailwindcss.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#table-transaksi').DataTable({
                language: {
                    emptyTable: "",
                    zeroRecords: ""
                }
            });

            // Show modal
            function showModal() {
                $('#editModal').removeClass('hidden');
            }

            // Hide modal
            function hideModal() {
                $('#editModal').addClass('hidden');
            }

            // Close modal
            $('#closeModal').click(function() {
                hideModal();
            });

            $('.delete-btn').on('click', function(e) {
                e.preventDefault();

                var href = $(this).attr('href');
                var id = $(this).data('id');

                Swal.fire({
                    title: 'Apakah Anda Yakin?',
                    text: "Data ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = href;
                    }
                });
            });

            // Handle edit button click
            $('#table-transaksi').on('click', '.show-button', function(e) {
                e.preventDefault();
                let transaksiID = $(this).data('id'); // Get the ID from the button's data attribute

                // Show the modal
                showModal();

                // AJAX request to fetch the barang details
                $.ajax({
                    url: `logic/tampil.php?model=transaksi&id=${transaksiID}`, // Update the URL to your PHP script
                    method: 'GET',
                    success: function(response) {
                        let data = JSON.parse(response); // Parse the JSON response

                        // Populate the form with fetched data
                        $('#nama_barang').val(data.nama_barang);
                        $('#jumlah').val(data.jumlah);
                        $('#tipe_transaksi').val(data.tipe_transaksi);
                        $('#tgl_transaksi').val(data.tgl_transaksi);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        })
    </script>

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
</body>

</html>