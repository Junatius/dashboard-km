<div class="container-fluid">

    <div class="row">
        <div class="col">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <!-- Card Identifikasi Setiap Halaman Pada Header -->
    <div class="card shadow mb-4">
        <div class="card-body pb-2 pt-3">
            <h5 class="font-weight-bold text-dark">Monitoring Laporan Mahasiswa</h5>
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
                            <th>Program Studi</th>
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
                                <td style="width: 5%;" class="text-center"><?= $no++; ?></td>
                                <td style="width: 12%;"><?= $mhs['nama_mahasiswa']; ?></td>
                                <td style="width: 13%;"><?= $mhs['nama_prodi']; ?></td>
                                <td style="width: 19%;"><?= $mhs['nama_programkm']; ?></td>
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
                                <td style="width: 12%;"><?= $mhs['status_kegiatan']; ?></td>
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
                        <?= form_open_multipart('admin/monlaporan/editmonlaporan_mahasiswa/' . $logbook['id_logbook']); ?>
                        <form action="<?= base_url("admin/monlaporan/editmonlaporan_mahasiswa/" . $logbook['id_logbook']); ?>" method="POST">
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
                                    name="tanggal" value="<?= date('d-m-Y', strtotime($logbook['tanggal'])); ?>">
                            </div>

                            <div class="form-group col">
                                <label for="tipe_laporan">Tipe Laporan</label>
                                <select class="form-control" id="tipe_laporan" name="tipe_laporan">
                                    <option value=""></option>
                                    <option value="Bulan ke-1" <?= (isset($logbook['tipe_laporan']) && $logbook['tipe_laporan'] == "Bulan ke-1") ? "selected" : ""; ?>>Bulan ke-1</option>
                                    <option value="Bulan ke-2" <?= (isset($logbook['tipe_laporan']) && $logbook['tipe_laporan'] == "Bulan ke-2") ? "selected" : ""; ?>>Bulan ke-2</option>
                                    <option value="Bulan ke-3" <?= (isset($logbook['tipe_laporan']) && $logbook['tipe_laporan'] == "Bulan ke-3") ? "selected" : ""; ?>>Bulan ke-3</option>
                                    <option value="Bulan ke-4" <?= (isset($logbook['tipe_laporan']) && $logbook['tipe_laporan'] == "Bulan ke-4") ? "selected" : ""; ?>>Bulan ke-4</option>
                                    <option value="Bulan ke-5" <?= (isset($logbook['tipe_laporan']) && $logbook['tipe_laporan'] == "Bulan ke-5") ? "selected" : ""; ?>>Bulan ke-5</option>
                                    <option value="Laporan Akhir" <?= (isset($logbook['tipe_laporan']) && $logbook['tipe_laporan'] == "Laporan Akhir") ? "selected" : ""; ?>>Laporan Akhir</option>
                                </select>
                                <?= form_error("tipe_laporan", "<small class=\"text-danger pl-3\">", "</small>"); ?>
                            </div>

                            <div class="form-group col">
                                <label for="uraian_kegiatan">Uraian Kegiatan</label>
                                <textarea class="form-control" id="uraian_kegiatan" rows="2" name="uraian_kegiatan"><?= $logbook['uraian_kegiatan']; ?></textarea>
                            </div>

                            <div class="form-group col">
                                <label for="komentar_mentor">Komentar Mentor</label>
                                <textarea class="form-control" id="komentar_mentor" rows="2" name="komentar_mentor"><?= !empty($logbook['komentar_mentor']) ? $logbook['komentar_mentor'] : 'Tidak ada komentar'; ?></textarea>
                            </div>

                            <div class="form-group col">
                                <label for="status">Status Laporan</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="Disetujui" <?= (isset($logbook['status']) && $logbook['status'] == "Disetujui") ? "selected" : ""; ?>>Disetujui</option>
                                    <option value="Belum Disetujui" <?= (!isset($logbook['status']) || $logbook['status'] == "" || $logbook['status'] == "Belum Disetujui") ? "selected" : ""; ?>>Belum Disetujui</option>
                                </select>
                                <?= form_error("status", "<small class='text-danger pl-3'>", "</small>"); ?>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
                                <a href="<?= base_url('admin/monlaporan/hapusmonlaporan_mahasiswa/' . $logbook['id_logbook']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin menghapus data ini?')"><i class="fas fa-save"></i> Hapus</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endforeach; ?>

<?php
if (isset($id_logbook)) {
    $modal = $id_logbook;
} else {
    $modal = "";
}
?>

<script>
    $(window).ready(function() {
        $("#view_laporan_mahasiswa_<?= $modal; ?>").modal("show");
    });
</script>