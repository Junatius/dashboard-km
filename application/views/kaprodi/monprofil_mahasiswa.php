<div class="container-fluid">

    <div class="row">
        <div class="col">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>


    <!-- Card Identifikasi Setiap Halaman Pada Header -->
    <div class="card shadow mb-4">
        <div class="card-body pb-2 pt-3">
            <h5 class="font-weight-bold text-dark">Monitoring Profil Mahasiswa <?= $programstudi['nama_prodi']; ?></h5>
        </div>
    </div>

    <!-- Keterangan Bagian Atas Untuk Header -->
    <div class="row">
        <div class="col">
            <div style="width: 28px; height: 7px; background-color: #4e73df; border-radius: 100px; margin-left: 3px; display: inline-block;"></div>
            <div style="display: inline-block;">
                <h6 class="font-weight-bold text-dark" style="padding-left: 5px;">Monitoring Profil Mahasiswa</h6>
            </div>
            <p style="padding-left: 40px; margin-top: -6px;">
                Di halaman ini anda dapat memonitoring Profil Mahasiswa
            </p>
        </div>
    </div>

    <!-- Tabel Untuk Laporan -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>NIM</th>
                            <th>Dosen Pembimbing</th>
                            <th>Program KM</th>
                            <th>Instansi/Mitra</th>
                            <th>Alamat Instansi/Mitra</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php $angka = 1;
                        foreach ($mahasiswa as $mhs): ?>
                            <tr>
                                <td><?= $angka++; ?></td>
                                <td><?= $mhs->nama_mahasiswa; ?></td>
                                <td><?= $mhs->nim; ?></td>
                                <td><?= $mhs->nama_dospem; ?></td>
                                <td><?= $mhs->nama_programkm; ?></td>
                                <td><?= $mhs->nama_instansi; ?></td>
                                <td><?= $mhs->alamat_instansi; ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url("kaprodi/Monprofil_mahasiswa/viewprofil_mahasiswa/" . $mhs->id_mahasiswa) ?>" class="btn btn-sm btn-info" style="padding: 0.10rem .4rem; font-size: 12px;">View</a>
                                    <a href="<?= base_url("kaprodi/Monprofil_mahasiswa/editprofil_mahasiswa/" . $mhs->id_mahasiswa) ?>" class="btn btn-sm btn-warning" style="padding: 0.10rem .4rem; font-size: 12px;">Edit</a>
                                    <a href="<?= base_url('kaprodi/monprofil_mahasiswa/hapusprofil_mahasiswa/' . $mhs->id_mahasiswa) ?>" class="btn btn-sm btn-danger" style="padding: 0.10rem .4rem; font-size: 12px;" onclick="return confirm('Apakah anda yakin menghapus data ini?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>