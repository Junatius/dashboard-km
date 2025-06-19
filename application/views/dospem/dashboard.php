<div class="container-fluid">
    <!-- Card Identifikasi Setiap Halaman Pada Header -->
    <div class="card shadow mb-4">
        <div class="card-body pb-2 pt-3">
            <h5 class="font-weight-bold text-dark">Dashboard Dosen Pembimbing <?= $programstudi['nama_prodi']; ?></h5>
        </div>
    </div>

    <!-- Greetings-->
    <div class="mb-4">
        <div style="margin-left: 4px">
            <h5><span>Hai,</span>
                <span class="font-weight-bold text-dark"><?= $profil['nama_dospem']; ?> !</span>
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
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4" style="border-radius: 3px; border-left: .20rem solid #4e73df!important">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Berdasarkan Program Kampus Merdeka</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body mb-4">
                    <div class="chart-pie pt-2">
                        <canvas id="myChart" style="width:100%;max-width:800px"></canvas>
                    </div>
                    <br>
                    <br>
                </div>
            </div>
        </div>

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

    <!-- Script Donut Berdasarkan Program Kampus Merdeka -->
    <script>
        var xValues = <?php echo json_encode($namaprogram); ?>;
        var yValues = <?php echo json_encode($jumlah); ?>;
        yValues = Object.values(yValues);

        var barColors = [
            "#b91d47", "#00aba9", "#2b5797", "#e8c3b9", "#1e7145", "#eae7e2", "#d0cfdf",
            "#e99cb0", "#cb672b", "#ffe8ec", "#dc3545", "#706f7e", "#1b2a66", "#04a96d",
            "#a42b2a", "#38871b", "#607381", "#cb7a34", "#2de516", "#9c1719", "#e6f847",
            "#2f278c", "#080313", "#da34a8", "#d44951", "#c75c1f", "#18d204", "#1b057b",
            "#acce44", "#865414", "#bb83c5", "#35b9cc", "#bd96a3", "#76b524", "#e62634"
        ];

        new Chart("myChart", {
            type: "doughnut",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                title: {
                    display: false,
                }
            }
        });
    </script>
    <!--END Script Donut Berdasarkan Program Kampus Merdeka -->


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