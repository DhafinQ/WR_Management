<!DOCTYPE html>
<?php
require_once 'controllers.php';
require_once 'koneksi.php';

$controllers = new Controller();
$pemasoks = $controllers->getPemasokData($conn);
$gudangs = $controllers->getGudangData($conn);
$barang = $controllers->getBarang($conn,$_GET['id']);

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Edit Barang</title>
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
            <a href="indexBarang.php" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
                <i class="fas fa-box mr-3"></i>
                Barang
            </a>
            <a href="indexGudang.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-warehouse mr-3"></i>
                Gudang
            </a>
            <a href="indexPemasok.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-user-tie mr-3"></i>
                Pemasok
            </a>
            <a href="indexTransaksi.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
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
                <h1 class="text-3xl text-black pb-6">Barang</h1>
                <nav aria-label="breadcrumb" class="w-max">
                    <ol class="flex w-full flex-wrap items-center rounded-md bg-slate-50 px-4 py-2">
                        <li class="flex cursor-pointer items-center text-sm text-slate-500 transition-colors duration-300 hover:text-slate-800">
                            <a href="dashboard.php">Dashboard</a>
                            <span class="pointer-events-none mx-2 text-slate-800">
                                /
                            </span>
                        </li>
                        <li class="flex cursor-pointer items-center text-sm text-slate-500 transition-colors duration-300 hover:text-slate-800">
                            <a href="indexBarang.php">Barang</a>
                            <span class="pointer-events-none mx-2 text-slate-800">
                                /
                            </span>
                        </li>
                        <li class="flex cursor-pointer items-center text-sm text-slate-500 transition-colors duration-300 hover:text-slate-800">
                            <a href="javascript:void()">Edit Barang</a>
                        </li>
                    </ol>
                </nav>
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
                    <p class="text-xl pb-6 flex items-center">
                        <i class="fas fa-list mr-3"></i> Form Edit Barang
                    </p>
                    <div class="leading-loose">
                        <form class="p-10 bg-white rounded shadow-xl" id="barangForm">
                            <input type="hidden" name="model" value="barang">
                            <input type="hidden" name="id_barang" value="<?= $barang['id']?>">
                            <div class="">
                                <label class="block text-sm text-gray-600" for="nama_barang">Nama Barang</label>
                                <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" value="<?= $barang['nama_barang']?>" id="nama_barang" name="nama_barang" type="text" required="" placeholder="Masukan Nama Barang..." aria-label="Name">
                            </div>
                            <div class="">
                                <label class="block text-sm text-gray-600" for="kategori">Kategori</label>
                                <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" value="<?= $barang['kategori']?>" id="kategori" name="kategori" type="text" required="" placeholder="Masukan Kategori Barang..." aria-label="Name">
                            </div>
                            <div class="">
                                <label class="block text-sm text-gray-600" for="harga">Harga</label>
                                <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" value="<?= $barang['harga']?>" id="harga" name="harga" type="number" required="" aria-label="harga">
                            </div>
                            <div class="">
                                <label class="block text-sm text-gray-600" for="jumlah_stok">Stok Barang</label>
                                <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" value="<?= $barang['jumlah_stok']?>" id="jumlah_stok" name="jumlah_stok" type="number" required="" aria-label="harga">
                            </div>
                            <div class="">
                                <label class="block text-sm text-gray-600" for="tgl_kadaluwarsa">Tanggal Kadaluwarsa</label>
                                <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" value="<?= $barang['tgl_kadaluwarsa']?>" id="tgl_kadaluwarsa" name="tgl_kadaluwarsa" type="date" required="" aria-label="harga">
                            </div>
                            <div class="">
                                <label class="block text-sm text-gray-600" for="lokasi">Lokasi</label>
                                <select
                                    name="lokasi_gudang"
                                    class="w-full bg-gray-200 placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer" required>
                                    <option value="">-- Pilih --</option>
                                    <?php
                                    if (!empty($gudangs)):
                                        foreach ($gudangs as $gudang):
                                    ?>
                                            <option value="<?= $gudang['id_gudang']; ?>" <?= ($barang['lokasi_gudang'] == $gudang['id_gudang'] ? 'selected' : '') ?>><?= $gudang['nama_gudang']; ?></option>
                                    <?php endforeach;
                                    endif; ?>
                                </select>
                            </div>
                            <div class="">
                                <label class="block text-sm text-gray-600" for="pemasok">Pemasok</label>
                                <select
                                    name="id_pemasok"
                                    class="w-full bg-gray-200 placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer" required>
                                    <option value="">-- Pilih --</option>
                                    <?php
                                    if (!empty($pemasoks)):
                                        foreach ($pemasoks as $pemasok):
                                    ?>
                                            <option value="<?= $pemasok['id']; ?>" <?= ($pemasok['id'] == $barang['id_pemasok'] ? 'selected' : '') ?>><?= $pemasok['nama_pemasok']; ?></option>
                                    <?php endforeach;
                                    endif; ?>
                                </select>
                            </div>
                            <div class="mt-2">
                                <label class=" block text-sm text-gray-600" for="deskripsi">Deskripsi Barang</label>
                                <textarea class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded" id="deskripsi" name="deskripsi" rows="6" required="" placeholder="Masukan Deskripsi Barang..." aria-label="Email"><?= $barang['deskripsi'] ?></textarea>
                            </div>
                            <div class="mt-6">
                                <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded" type="submit">Submit</button>
                            </div>
                        </form>
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
        $('#barangForm').on('submit', function(e) {
            e.preventDefault(); // Prevent the form from submitting the traditional way

            $.ajax({
                url: 'logic/edit.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Data Berhasil Disimpan!',
                            showConfirmButton: false,
                            timer: 1000
                        }).then(function() {
                            window.location = 'indexbarang.php'; // Redirect to index after alert
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Data Gagal Disimpan!',
                            text: 'Terjadi kesalahan saat menyimpan data',
                            showConfirmButton: true
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan',
                        text: 'Tidak bisa mengirimkan data',
                        showConfirmButton: true
                    });
                }
            });
        });
    </script>

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
</body>

</html>