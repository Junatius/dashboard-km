<div class="container-fluid">
    <!-- Card Identifikasi Setiap Halaman Pada Header -->
    <div class="card shadow mb-4">
        <div class="card-body pb-2 pt-3">
            <h5 class="font-weight-bold text-dark">Monitoring Laporan Mahasiswa <?= $programstudi['nama_prodi']; ?></h5>
        </div>
    </div>

    <!-- Keterangan Bagian Atas Untuk Header -->
    <div class="row">
        <div class="col">
            <div style="width: 28px; height: 7px; background-color: #4e73df; border-radius: 100px; margin-left: 3px; display: inline-block;"></div>
            <div style="display: inline-block;">
                <h6 class="font-weight-bold text-dark" style="padding-left: 5px;">Monitoring Laporan Mahasiswa</h6>
            </div>
            <p style="padding-left: 40px; margin-top: -6px;">
                Di halaman ini anda dapat memonitoring Laporan Mahasiswa
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
                            <th>Program KM</th>
                            <th>Tipe Laporan</th>
                            <th>Sertifikat</th>
                            <th>Status Kegiatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($mahasiswa as $mhs): ?>
                            <tr>
                                <td class="text-center" style="width: 5%;"><?= $no++; ?></td>
                                <td style="width: 10%;"><?= $mhs['nama_mahasiswa']; ?></td>
                                <td style="width: 20%;"><?= $mhs['nama_programkm']; ?></td>
                                <td class="text-center">
                                    <?php
                                    if (!empty($mhs['logbooks'])) {
                                        foreach ($mhs['logbooks'] as $logbook) :
                                    ?>
                                            <button data-toggle="modal" data-target="#view_laporan_mahasiswa_<?= $logbook['id_logbook'] ?>" class="btn btn btn-secondary" style="padding: 0.40rem .4rem; font-size: 12px; margin-right: 4px;"><?= $logbook['tipe_laporan']; ?></button>
                                    <?php endforeach;
                                    } else {
                                        echo "Belum ada logbook";
                                    } ?>
                                </td>
                                <td style="color: <?= $mhs['file'] ? 'blue' : 'red'; ?>;">
                                    <?php if (!empty($mhs['file'])): ?>
                                        <a href="<?= base_url('assets/template/file/sertifikat/') . $mhs['file']; ?>" style="color: blue; text-decoration: none;" target="_blank">
                                            Lihat Sertifikat
                                        </a>
                                    <?php else: ?>
                                        Belum ada
                                    <?php endif; ?>
                                </td>
                                <td class="col-2 text-center"><?= $mhs['status_kegiatan']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Laporan -->
<?php foreach ($mahasiswa as $mhs) : ?>
    <?php foreach ($mhs['logbooks'] as $logbook) : ?>

        <div class="modal fade" id="view_laporan_mahasiswa_<?= $logbook['id_logbook'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold text-dark" id="exampleModalLabel">Laporan Mahasiwa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group col">
                            <label for="nama_mahasiswa">Nama Mahasiswa</label>
                            <input type="text" class="form-control" id="nama_mahasiswa"
                                name="nama_mahasiswa" value="<?= $mhs['nama_mahasiswa']; ?>" readonly>
                        </div>

                        <div class="form-group col">
                            <label for="program_km">Program KM</label>
                            <input type="text" class="form-control" id="program_km"
                                name="program_km" value="<?= $mhs['nama_programkm']; ?>" readonly>
                        </div>

                        <div class="form-group col">
                            <label for="tanggal">Tanggal</label>
                            <input type="text" class="form-control" id="tanggal"
                                name="tanggal" value="<?= date('d-m-Y', strtotime($logbook['tanggal'])); ?>" readonly>
                        </div>

                        <div class="form-group col">
                            <label for="tipe_laporan">Tipe Laporan</label>
                            <input type="text" class="form-control" id="tipe_laporan"
                                name="tipe_laporan" value="<?= $logbook['tipe_laporan']; ?>" readonly>
                        </div>

                        <div class="form-group col">
                            <label for="uraian_kegiatan">Uraian Kegiatan</label>
                            <textarea class="form-control" id="uraian_kegiatan" rows="2" name="uraian_kegiatan" readonly><?= $logbook['uraian_kegiatan']; ?></textarea>
                        </div>

                        <div class="form-group col">
                            <label for="komentar_mentor">Komentar Mentor</label>
                            <textarea class="form-control" id="komentar_mentor" rows="2" name="komentar_mentor" readonly><?= !empty($logbook['komentar_mentor']) ? $logbook['komentar_mentor'] : 'Tidak ada komentar'; ?></textarea>
                        </div>

                        <div class="form-group col">
                            <label for="status">Status Laporan</label>
                            <input type="text" class="form-control" id="status"
                                name="status" value="<?= ($logbook['status'] == 'Disetujui') ? 'Disetujui' : 'Belum Disetujui'; ?>" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endforeach; ?>