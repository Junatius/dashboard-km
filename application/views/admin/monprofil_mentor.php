<div class="container-fluid">

    <div class="row">
        <div class="col">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <!-- Card Identifikasi Setiap Halaman Pada Header -->
    <div class="card shadow mb-4">
        <div class="card-body pb-2 pt-3">
            <h5 class="font-weight-bold text-dark">Monitoring Profil Mentor</h5>
        </div>
    </div>

    <!-- Keterangan Bagian Atas Untuk Header -->
    <div class="row">
        <div class="col">
            <div style="width: 28px; height: 7px; background-color: #4e73df; border-radius: 100px; margin-left: 3px; display: inline-block;"></div>
            <div style="display: inline-block;">
                <h6 class="font-weight-bold text-dark" style="padding-left: 5px;">Hi, <?= $profil['username']; ?></h6>
            </div>
            <p style="padding-left: 40px; margin-top: -6px;">
                Di halaman ini anda dapat memonitoring Profil Mentor
            </p>
        </div>
    </div>

    <?php

    $this->load->database();

    $id_mentor = [];
    foreach ($mentor as $m) {
        // Check if the program has already been displayed
        if (!in_array($m->id_mentor, $id_mentor)) {
            // Add the program name to the displayed array
            $id_mentor[] = $m->id_mentor;
        }
    }

    $jumlah_mahasiswa = [];
    foreach ($mahasiswa_mentor as $p) {
        $p_id = $p['id_mentor'];

        if (!isset($jumlah_mahasiswa[$p_id])) {
            $jumlah_mahasiswa[$p_id] = 0;
        }

        if (!empty($p['id_mahasiswa'])) {
            $jumlah_mahasiswa[$p_id] += 1;
        }
    }

    $tot_mhs = [];
    foreach ($id_mentor as $id_m) {
        if (isset($jumlah_mahasiswa[$id_m])) {
            $tot_mhs[$id_m] = $jumlah_mahasiswa[$id_m];
        } else {
            $tot_mhs[$id_m] = 0;
        }
    }


    ?>

    <!-- Tabel Untuk Laporan -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Personal Number</th>
                            <th>Nama Instansi</th>
                            <th>Alamat Instansi</th>
                            <th>No. HP</th>
                            <th>Jumlah Mahasiswa</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php $angka = 1;
                            foreach ($mentor as $mntr): ?>
                                <td style="width: 5%;" class="text-center"><?= $angka++; ?></td>
                                <td style="width: 15%;"><?= $mntr->nama_mentor; ?></td>
                                <td style="width: 10%;" class="text-center"><?= $mntr->personal_number; ?></td>
                                <td><?= $mntr->nama_instansi; ?></td>
                                <td><?= $mntr->alamat_instansi; ?></td>
                                <td class="text-center"><?= $mntr->no_hp; ?></td>
                                <td style="width: 5%;" class="text-center">
                                    <a href="<?= base_url("admin/Monprofil_mentor/jumlahMahasiswa_mentor/" . $mntr->id_mentor) ?>" class="btn btn-sm btn-secondary" style="padding: 0.10rem .4rem; font-size: 12px;"><?= $tot_mhs[$mntr->id_mentor]; ?> Mahasiswa</a>
                                </td>
                                <td class="text-center">
                                    <a href="<?= base_url("admin/Monprofil_mentor/viewprofil_mentor/" . $mntr->id_mentor) ?>" class="btn btn-sm btn-info" style="padding: 0.10rem .4rem; font-size: 12px;">View</a>
                                    <a href="<?= base_url("admin/Monprofil_mentor/editprofil_mentor/" . $mntr->id_mentor) ?>" class="btn btn-sm btn-warning" style="padding: 0.10rem .4rem; font-size: 12px;">Edit</a>
                                    <a href="<?= base_url("admin/Monprofil_mentor/hapusprofil_mentor/" . $mntr->id_mentor) ?>" class="btn btn-sm btn-danger" style="padding: 0.10rem .4rem; font-size: 12px;" onclick="return confirm('Apakah anda yakin menghapus data ini?')">Hapus</a>
                                </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>