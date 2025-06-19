<div class="container-fluid">

    <div class="row">
        <div class="col">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <!-- Card Identifikasi Setiap Halaman Pada Header -->
    <div class="card shadow mb-4">
        <div class="card-body pb-2 pt-3">
            <h5 class="font-weight-bold text-dark">Monitoring Profil Kaprodi</h5>
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
                Di halaman ini anda dapat memonitoring Profil Kaprodi
            </p>
        </div>
    </div>

    <?php
    $this->load->database();

    //Bagian Mahasiswa Per Prodi
    $namaprodi = [];
    $id_prodi = [];
    foreach ($mahasiswa_prodi as $row) {
        // Check if the program has already been displayed
        if (!in_array($row['nama_prodi'], $namaprodi)) {
            // Add the program name to the displayed array
            $namaprodi[] = $row['nama_prodi'];
            $id_prodi[] = $row['id_prodi'];
        }
    }

    //menghitung jumlah mahasiswa dalam program
    $jumlahMhs = [];

    foreach ($mahasiswa_prodi as $p) {
        $p_id = $p['id_prodi'];

        if (!isset($jumlahMhs[$p_id])) {
            $jumlahMhs[$p_id] = 0;
        }

        if (!empty($p['id_mahasiswa'])) {
            $jumlahMhs[$p_id] += 1;
        }
    }

    //END Bagian Mahasiswa Per Prodi
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
                            <th>NIP</th>
                            <th>Program Studi</th>
                            <th>No. HP</th>
                            <th>Jenis Kelamin</th>
                            <th>Jumlah Mahasiswa</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php $angka = 1;
                            foreach ($kaprodi as $kprdi): ?>
                                <td style="width: 5%;" class="text-center"><?= $angka++; ?></td>
                                <td style="width: 15%;"><?= $kprdi->nama_kaprodi; ?></td>
                                <td style="width: 20%;" class="text-center"><?= $kprdi->nip; ?></td>
                                <td style="width: 20%;"><?= $kprdi->nama_prodi; ?></td>
                                <td><?= $kprdi->no_hp; ?></td>
                                <td><?= $kprdi->jenis_kelamin; ?></td>
                                <td style="width: 5%;" class="text-center">
                                    <a href="<?= base_url("admin/Monprofil_kaprodi/jumlahMahasiswa_prodi/" . $kprdi->id_prodi) ?>" class="btn btn-sm btn-secondary" style="padding: 0.10rem .4rem; font-size: 12px;"><?= $jumlahMhs[$kprdi->id_prodi]; ?> Mahasiswa</a>
                                </td>
                                <td style="width: 18%;" class="text-center">
                                    <a href="<?= base_url("admin/Monprofil_kaprodi/viewprofil_kaprodi/" . $kprdi->id_kaprodi) ?>" class="btn btn-sm btn-info" style="padding: 0.10rem .4rem; font-size: 12px;">View</a>
                                    <a href="<?= base_url("admin/Monprofil_kaprodi/editprofil_kaprodi/" . $kprdi->id_kaprodi) ?>" class="btn btn-sm btn-warning" style="padding: 0.10rem .4rem; font-size: 12px;">Edit</a>
                                    <a href="<?= base_url("admin/Monprofil_kaprodi/hapusprofil_kaprodi/" . $kprdi->id_kaprodi) ?>" class="btn btn-sm btn-danger" style="padding: 0.10rem .4rem; font-size: 12px;" onclick="return confirm('Apakah anda yakin menghapus data ini?')">Hapus</a>
                                </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>