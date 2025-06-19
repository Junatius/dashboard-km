<div class="container-fluid">
    <!-- Card Identifikasi Setiap Halaman Pada Header -->
    <div class="card shadow mb-4">
        <div class="card-body pb-2 pt-3">
            <h5 class="font-weight-bold text-dark">Dashboard Admin</h5>
        </div>
    </div>


    <!-- Greetings-->
    <div class="mb-4">
        <div style="margin-left: 4px">
            <h5><span>Hai,</span>
                <span class="font-weight-bold text-dark"><?= $profil['username']; ?> !</span>
                <br>
                <span>Selamat datang di</span>
                <span class="font-weight-bold text-dark">Portal Kampus Merdeka</span>
            </h5>
        </div>
    </div>

    <?php
    $this->load->database();

    $namaprogram = [];
    $program_id = [];
    foreach ($program as $row) {
        // Check if the program has already been displayed
        if (!in_array($row['nama_programkm'], $namaprogram)) {
            // Add the program name to the displayed array
            $namaprogram[] = $row['nama_programkm'];
            $program_id[] = $row['id_programkm'];
        }
    }

    //menghitung jumlah mahasiswa dalam program
    $jumlah = [];

    foreach ($program as $p) {
        $p_id = $p['id_programkm'];

        if (!isset($jumlah[$p_id])) {
            $jumlah[$p_id] = 0;
        }

        if (!empty($p['id_mahasiswa'])) {
            $jumlah[$p_id] += 1;
        }
    }

    $totalMahasiswa = array_sum($jumlah);
    ?>


    <!-- Content -->
    <div class="row">
        <!-- Total Mahasiswa -->
        <div class=" col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2" style="border-radius: 3px; border-left: .20rem solid #4e73df!important">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="font-size: .8rem; font-weight: 720!important;">
                                Total Mahasiswa
                            </div>
                            <div class="h6 mb-0 font-weight-bold" style="color: #2a2a2a;"><?= $totalMahasiswa; ?> Mahasiswa</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-people-fill fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Studi Independen -->
        <div class=" col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2" style="border-radius: 3px; border-left: .20rem solid #4e73df!important">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="font-size: .8rem; font-weight: 720!important;">
                                <?= $namaprogram[0]; ?>
                            </div>
                            <div class="h6 mb-0 font-weight-bold" style="color: #2a2a2a;"><?= $jumlah[$program_id[0]]; ?> Mahasiswa</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-people-fill fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Magang Bersertifikat -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2" style="border-radius: 3px; border-left: .20rem solid #4e73df!important">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="font-size: .8rem; font-weight: 720!important;">
                                <?= $namaprogram[1]; ?>
                            </div>
                            <div class="h6 mb-0 font-weight-bold" style="color: #2a2a2a;"><?= $jumlah[$program_id[1]]; ?> Mahasiswa</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-people-fill fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <!-- IISMA -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2" style="border-radius: 3px; border-left: .20rem solid #4e73df!important">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="font-size: .8rem; font-weight: 720!important;">
                                <?= $namaprogram[2]; ?>
                            </div>
                            <div class="h6 mb-0 font-weight-bold" style="color: #2a2a2a;"><?= $jumlah[$program_id[2]]; ?> Mahasiswa</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-people-fill fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pertukaran Mahasiswa -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2" style="border-radius: 3px; border-left: .20rem solid #4e73df!important">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="font-size: .8rem; font-weight: 720!important;">
                                <?= $namaprogram[3]; ?>
                            </div>
                            <div class="h6 mb-0 font-weight-bold" style="color: #2a2a2a;"><?= $jumlah[$program_id[3]]; ?> Mahasiswa</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-people-fill fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Penelitian/Riset -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2" style="border-radius: 3px; border-left: .20rem solid #4e73df!important">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="font-size: .8rem; font-weight: 720!important;">
                                <?= $namaprogram[4]; ?>
                            </div>
                            <div class="h6 mb-0 font-weight-bold" style="color: #2a2a2a;"><?= $jumlah[$program_id[4]]; ?> Mahasiswa</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-people-fill fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Proyek Kemanusiaan -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2" style="border-radius: 3px; border-left: .20rem solid #4e73df!important">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="font-size: .8rem; font-weight: 720!important;">
                                <?= $namaprogram[5]; ?>
                            </div>
                            <div class="h6 mb-0 font-weight-bold" style="color: #2a2a2a;"><?= $jumlah[$program_id[5]]; ?> Mahasiswa</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-people-fill fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kegiatan Wirausaha -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2" style="border-radius: 3px; border-left: .20rem solid #4e73df!important">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="font-size: .8rem; font-weight: 720!important;">
                                <?= $namaprogram[6]; ?>
                            </div>
                            <div class="h6 mb-0 font-weight-bold" style="color: #2a2a2a;"><?= $jumlah[$program_id[6]]; ?> Mahasiswa</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-people-fill fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Studi/Proyek Independen -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2" style="border-radius: 3px; border-left: .20rem solid #4e73df!important">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="font-size: .8rem; font-weight: 720!important;">
                                <?= $namaprogram[7]; ?>
                            </div>
                            <div class="h6 mb-0 font-weight-bold" style="color: #2a2a2a;"><?= $jumlah[$program_id[7]]; ?> Mahasiswa</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-people-fill fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">



        <!-- Membangun Desa (KKN Tematik) -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2" style="border-radius: 3px; border-left: .20rem solid #4e73df!important">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="font-size: .8rem; font-weight: 720!important;">
                                <?= $namaprogram[8]; ?>
                            </div>
                            <div class="h6 mb-0 font-weight-bold" style="color: #2a2a2a;"><?= $jumlah[$program_id[8]]; ?> Mahasiswa</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-people-fill fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bela Negara -->
        <div class=" col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2" style="border-radius: 3px; border-left: .20rem solid #4e73df!important">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="font-size: .8rem; font-weight: 720!important;">
                                <?= $namaprogram[9]; ?>
                            </div>
                            <div class="h6 mb-0 font-weight-bold" style="color: #2a2a2a;"><?= $jumlah[$program_id[9]]; ?> Mahasiswa</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-people-fill fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>