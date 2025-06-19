<div class="container-fluid">

    <div class="row">
        <div class="col">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <!-- Card Identifikasi Setiap Halaman Pada Header -->
    <div class="card shadow mb-4">
        <div class="card-body pb-2 pt-3">
            <h5 class="font-weight-bold text-dark">Monitoring Profil Dosen Pembimbing</h5>
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
                Di halaman ini anda dapat memonitoring Profil Dosen Pembimbing
            </p>
        </div>
    </div>

    <?php

    $this->load->database();

    $id_dosen_pembimbing = [];
    foreach ($dospem as $dspm) {
        // Check if the program has already been displayed
        if (!in_array($dspm->id_dosen_pembimbing, $id_dosen_pembimbing)) {
            // Add the program name to the displayed array
            $id_dosen_pembimbing[] = $dspm->id_dosen_pembimbing;
        }
    }

    $jumlah_mahasiswa = [];
    foreach ($mahasiswa_dospem as $p) {
        $p_id = $p['id_dosen_pembimbing'];

        if (!isset($jumlah_mahasiswa[$p_id])) {
            $jumlah_mahasiswa[$p_id] = 0;
        }

        if (!empty($p['id_mahasiswa'])) {
            $jumlah_mahasiswa[$p_id] += 1;
        }
    }

    $tot_mhs = [];
    foreach ($id_dosen_pembimbing as $id_dospem) {
        if (isset($jumlah_mahasiswa[$id_dospem])) {
            $tot_mhs[$id_dospem] = $jumlah_mahasiswa[$id_dospem];
        } else {
            $tot_mhs[$id_dospem] = 0;
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
                            <th>Nama Dosen Pembimbing</th>
                            <th>NIP</th>
                            <th>Program Studi</th>
                            <th>No. Hp</th>
                            <th>Jenis Kelamin</th>
                            <th>Jumlah Mahasiswa</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php $angka = 1;
                            foreach ($dospem as $dp): ?>
                                <td style="width: 5%;" class="text-center"><?= $angka++; ?></td>
                                <td style="width: 12%;"><?= $dp->nama_dospem; ?></td>
                                <td style="width: 20%;" class="text-center"><?= $dp->nip; ?></td>
                                <td style="width: 17%;"><?= $dp->nama_prodi; ?></td>
                                <td style="width: 15%;" class="text-center"><?= $dp->no_hp; ?></td>
                                <td style="width: 15%;" class="text-center"><?= $dp->jenis_kelamin; ?></td>
                                <td style="width: 5%;" class="text-center">
                                    <a href="<?= base_url("admin/Monprofil_dospem/jumlahMahasiswa_dospem/" . $dp->id_dosen_pembimbing) ?>" class="btn btn-sm btn-secondary" style="padding: 0.10rem .4rem; font-size: 12px;"><?= $tot_mhs[$dp->id_dosen_pembimbing]; ?> Mahasiswa</a>
                                </td>
                                <td class="text-center">
                                    <a href="<?= base_url("admin/Monprofil_dospem/viewprofil_dospem/" . $dp->id_dosen_pembimbing) ?>" class="btn btn-sm btn-info" style="padding: 0.10rem .4rem; font-size: 12px;">View</a>
                                    <a href="<?= base_url("admin/Monprofil_dospem/editprofil_dospem/" . $dp->id_dosen_pembimbing) ?>" class="btn btn-sm btn-warning" style="padding: 0.10rem .4rem; font-size: 12px;">Edit</a>
                                    <a href="<?= base_url("admin/Monprofil_dospem/hapusprofil_dospem/" . $dp->id_dosen_pembimbing) ?>" class="btn btn-sm btn-danger" style="padding: 0.10rem .4rem; font-size: 12px;" onclick="return confirm('Apakah anda yakin menghapus data ini?')">Hapus</a>
                                </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>