<nav class="navbar navbar-expand-lg bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="#">Halo! <?=$fetch_admin['username']?></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>

                <ul class="navbar-nav  mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="index_admin.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="supplier.php">Supplier</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="stok_barang.php">Stok Barang</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link text-white" href="histori_harga.php">Histori Harga</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link text-white" href="logout.php">Keluar</a>
                    </li>
                </ul>
            </div>
        </div>
</nav>