<div class="container-fluid">

    <div class="row">
        <div class="col">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <!-- Card Identifikasi Setiap Halaman Pada Header -->
    <div class="card shadow mb-4">
        <div class="card-body pb-2 pt-3">
            <h5 class="font-weight-bold text-dark">Laporan Kegiatan Program (Logbook)</h5>
        </div>
    </div>

    <!-- Keterangan Bagian Atas Untuk Header -->
    <div class="row">
        <div class="col">
            <div style="width: 28px; height: 7px; background-color: #4e73df; border-radius: 100px; margin-left: 3px; display: inline-block;"></div>
            <div style="display: inline-block;">
                <h6 class="font-weight-bold text-dark" style="padding-left: 5px;">Hi, <?= $profil['nama_mahasiswa']; ?></h6>
            </div>
            <p style="padding-left: 40px; margin-top: -6px;">
                Di halaman ini anda dapat memasukkan Laporan Kegiatan
            </p>
        </div>
        <div class="col">


            <!-- Button Tambah Laporan -->
            <div style="margin-top: 12px">
                <div class="mb">
                    <a href="<?= base_url("mahasiswa/laporan/tambah_laporan") ?>" style="float: right; border-radius: 100px;" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Laporan</a><br></br>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Untuk Laporan -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>Tanggal</th>
                            <th>Uraian Kegiatan</th>
                            <th>Komentar Mentor</th>
                            <th>Status</th>
                            <th>Tipe Laporan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($logbook as $log): ?>
                            <tr>
                                <td><?= date('d-m-Y', strtotime($log['tanggal'])); ?></td>
                                <td>
                                    <?php if ($log['tipe_laporan'] == 'Laporan Akhir'): ?>
                                        <a href="<?= base_url('assets/template/file/') . $log['uraian_kegiatan']; ?>" target="_blank"><?= $log['uraian_kegiatan']; ?></a>
                                    <?php else: ?>
                                        <?= $log['uraian_kegiatan']; ?>
                                    <?php endif; ?>
                                </td>
                                <td><?= $log['komentar_mentor']; ?></td>
                                <td>
                                    <div style="text-align: center;">
                                        <?php if (isset($log['status']) && $log['status'] == "Disetujui"): ?>
                                            <i class="fa fa-check-square" style="font-size: 23px; color: green;"></i>
                                        <?php else: ?>
                                            <i class="fa fa-window-close" style="font-size: 23px; color: red;"></i>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td><?= $log['tipe_laporan']; ?></td>
                                <td class="text-center">
                                    <button data-toggle="modal" data-target="#edit_laporan_<?= $log['id_logbook'] ?>" class="btn btn-sm btn-warning" style="padding: 0.10rem .4rem; font-size: 12px;">Edit</button>
                                    <a href="<?= base_url('mahasiswa/laporan/hapus_laporan/' . $log['id_logbook']) ?>" class="btn btn-sm btn-danger" style="padding: 0.10rem .4rem; font-size: 12px;" onclick="return confirm('Apakah anda yakin menghapus data ini?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal Edit Laporan -->
<?php foreach ($logbook as $log) { ?>

    <div class="modal fade" id="edit_laporan_<?= $log['id_logbook']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Laporan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open_multipart('mahasiswa/laporan/edit_laporan/' . $log['id_logbook']); ?>
                    <form action="<?= base_url("mahasiswa/laporan/edit_laporan/" . $log['id_logbook']); ?>" method="POST">

                        <div class="form-group col">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal">
                            <?= form_error('tanggal', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="form-group col">
                            <label for="tipe_laporan">Tipe Laporan</label>
                            <select class="form-control" id="tipe_laporan" name="tipe_laporan">
                                <option value=""></option>
                                <option value="Bulan ke-1" <?= (isset($log['tipe_laporan']) && $log['tipe_laporan'] == "Bulan ke-1") ? "selected" : ""; ?>>Bulan ke-1</option>
                                <option value="Bulan ke-2" <?= (isset($log['tipe_laporan']) && $log['tipe_laporan'] == "Bulan ke-2") ? "selected" : ""; ?>>Bulan ke-2</option>
                                <option value="Bulan ke-3" <?= (isset($log['tipe_laporan']) && $log['tipe_laporan'] == "Bulan ke-3") ? "selected" : ""; ?>>Bulan ke-3</option>
                                <option value="Bulan ke-4" <?= (isset($log['tipe_laporan']) && $log['tipe_laporan'] == "Bulan ke-4") ? "selected" : ""; ?>>Bulan ke-4</option>
                                <option value="Bulan ke-5" <?= (isset($log['tipe_laporan']) && $log['tipe_laporan'] == "Bulan ke-5") ? "selected" : ""; ?>>Bulan ke-5</option>
                                <option value="Laporan Akhir" <?= (isset($log['tipe_laporan']) && $log['tipe_laporan'] == "Laporan Akhir") ? "selected" : ""; ?>>Laporan Akhir</option>
                            </select>
                            <?= form_error("tipe_laporan", "<small class=\"text-danger pl-3\">", "</small>"); ?>
                        </div>

                        <div class="form-group col">
                            <label>Upload File</label>
                            <div class="custom-file">
                                <div>
                                    <input type="file" class="custom-file-input"
                                        id="file" name="file">
                                    <label class="custom-file-label" for="file">Choose file</label>
                                </div>
                                <div>
                                    <p class="font-weight-bold text-dark">*Bagian Upload File Hanya Untuk Laporan Akhir</p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col">
                            <label for="uraian_kegiatan">Uraian Kegiatan</label>
                            <textarea class="form-control" id="uraian_kegiatan" rows="2" name="uraian_kegiatan"><?php if (isset($log['tipe_laporan']) && $log['tipe_laporan'] != "Laporan Akhir"): ?><?= $log['uraian_kegiatan']; ?><?php endif; ?></textarea>
                            <?= form_error("uraian_kegiatan", "<small class=\"text-danger pl-3\">", "</small>"); ?>
                            <div>
                                <p class="font-weight-bold text-dark">*Bagian Uraian Kegiatan Untuk Laporan Harian dan Laporan Mingguan</p>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
                            <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>


<?php
if (isset($id_logbook)) {
    $modal = $id_logbook;
} else {
    $modal = "";
}
?>

<script>
    $(window).ready(function() {
        $("#edit_laporan_<?= $modal; ?>").modal("show");
    });
</script>