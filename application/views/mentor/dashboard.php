<div class="container-fluid">

    <!-- Card Identifikasi Setiap Halaman Pada Header -->
    <div class="card shadow mb-4">
        <div class="card-body pb-2 pt-3">
            <h5 class="font-weight-bold text-dark">Dashboard Mentor</h5>
        </div>
    </div>

    <!-- Greetings-->
    <div class="mb-4">
        <div style="margin-left: 4px">
            <h5><span>Hai,</span>
                <span class="font-weight-bold text-dark"><?= $profil['nama_mentor']; ?> !</span>
                <br>
                <span>Selamat datang di</span>
                <span class="font-weight-bold text-dark">Portal Kampus Merdeka</span>
            </h5>
        </div>
    </div>

    <!-- Content -->


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

    //Bagian Laporan
    // Inisialisasi array untuk menghitung laporan
    $label_tipelaporan = [
        "Bulan ke-1",
        "Bulan ke-2",
        "Bulan ke-3",
        "Bulan ke-4",
        "Bulan ke-5",
        "Laporan Akhir"
    ];

    $laporan_terisi = [];
    $laporan = [];
    $nama_mahasiswa = [];

    // Looping data untuk menghitung laporan berdasarkan tipe
    foreach ($detail_program as $dp) {
        $tipeLaporan = $dp['tipe_laporan'];

        // Jika tipe laporan sudah ada, tambahkan jumlahnya
        if (isset($laporan[$tipeLaporan])) {

            $laporan[$tipeLaporan]++;
        } else {
            // Jika belum ada, inisialisasi jumlah menjadi 1
            $laporan[$tipeLaporan] = 1;
        }

        if (!in_array($dp['nama_mahasiswa'], $nama_mahasiswa)) {
            // Add the program name to the displayed array
            $nama_mahasiswa[] = $dp['nama_mahasiswa'];
        }
    }

    foreach ($label_tipelaporan as $label) {
        if (isset($laporan[$label])) {
            $laporan_terisi[] = $laporan[$label];
        } else {
            $laporan_terisi[] = 0;
        }
    }

    $jumlahmahasiswa = count($nama_mahasiswa); // Menghitung jumlah mahasiswa yang terdaftar dalam laporan

    $laporan_belumterisi = [];

    foreach ($label_tipelaporan as $label) {
        if (isset($laporan[$label])) {
            $laporan_belumterisi[] = $jumlahmahasiswa - $laporan[$label];
        } else {
            $laporan_belumterisi[] = $jumlahmahasiswa;
        }
    }

    //End Bagian Laporan

    ?>

    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
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
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4" style="border-radius: 3px; border-left: .20rem solid #4e73df!important">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Berdasarkan Laporan Mahasiswa</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body mb-4">
                    <div class="chart-pie pt-2">
                        <canvas id="mybarChartlaporan" style="width:100%;max-width:800px"></canvas>
                    </div>
                    <br>
                    <br>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Donut Berdasarkan Laporan Mahasiswa -->
    <script>
        var xValues = <?php echo json_encode($label_tipelaporan); ?>;
        var yValues1 = <?php echo json_encode($laporan_terisi); ?>;
        var yValues2 = <?php echo json_encode($laporan_belumterisi); ?>;
        yValues1 = Object.values(yValues1);
        yValues2 = Object.values(yValues2);

        var ctx = document.getElementById("mybarChartlaporan");
        var mybarChart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                        label: 'Laporan diisi',
                        backgroundColor: "#26B99A",
                        data: yValues1
                    },
                    {
                        label: 'Laporan Belum diisi',
                        backgroundColor: "#b91d47",
                        data: yValues2
                    }
                ]
            },

            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>

    <!--END Script Donut Berdasarkan Laporan Mahasiswa -->
</div>