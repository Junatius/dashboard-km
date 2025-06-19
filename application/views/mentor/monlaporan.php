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
                <h6 class="font-weight-bold text-dark" style="padding-left: 5px;">Hi, <?= $profil['nama_mentor']; ?></h6>
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
                            <th>Nama Mahasiswa</th>
                            <th>Tipe Laporan</th>
                            <th>Program KM</th>
                            <th>Uraian Kegiatan</th>
                            <th>Komentar</th>
                            <th>Status Laporan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($mahasiswa as $mhs): ?>
                            <tr>
                                <td><?= $mhs->nama_mahasiswa; ?></td>
                                <td><?= $mhs->tipe_laporan; ?></td>
                                <td><?= $mhs->nama_programkm; ?></td>
                                <td>
                                    <?php if ($mhs->tipe_laporan == 'Laporan Akhir'): ?>
                                        <a href="<?= base_url('assets/template/file/') . $mhs->uraian_kegiatan; ?>" target="_blank"><?= $mhs->uraian_kegiatan; ?></a>
                                    <?php else: ?>
                                        <?= $mhs->uraian_kegiatan; ?>
                                    <?php endif; ?>
                                </td>
                                <td><?= $mhs->komentar_mentor; ?></td>
                                <td>
                                    <div style="text-align: center;">
                                        <?php if (isset($mhs->status) && $mhs->status == "Disetujui"): ?>
                                            <i class="fa fa-check-square" style="font-size: 23px; color: green;"></i>
                                        <?php else: ?>
                                            <i class="fa fa-window-close" style="font-size: 23px; color: red;"></i>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <button data-toggle="modal" data-target="#edit_laporan_mahasiswa_<?= $mhs->id_logbook; ?>" class="btn btn-sm btn-warning" style="padding: 0.10rem .4rem; font-size: 12px;">Edit</button>
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
<?php foreach ($mahasiswa as $mhs) { ?>

    <div class="modal fade" id="edit_laporan_mahasiswa_<?= $mhs->id_logbook; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold text-dark" id="exampleModalLabel">Edit Laporan Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open_multipart('mentor/monlaporan/edit_laporan/' . $mhs->id_logbook); ?>
                    <form action="<?= base_url("mentor/monlaporan/edit_laporan/" . $mhs->id_logbook); ?>" method="POST">

                        <div class="form-group col">
                            <label for="nama_lengkap">Nama Mahasiswa</label>
                            <input type="text" class="form-control" id="nama_lengkap"
                                name="nama_lengkap" value="<?= $mhs->nama_mahasiswa; ?>" readonly>
                            <?= form_error('nama_lengkap', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="form-group col">
                            <label for="tipe_laporan">Tipe Laporan</label>
                            <input type="text" class="form-control" id="tipe_laporan"
                                name="tipe_laporan" value="<?= $mhs->tipe_laporan; ?>" readonly>
                            <?= form_error('tipe_laporan', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="form-group col">
                            <label for="program_km">Program KM</label>
                            <input type="text" class="form-control" id="program_km"
                                name="program_km" value="<?= $mhs->nama_programkm; ?>" readonly>
                            <?= form_error('program_km', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="form-group col">
                            <label for="uraian_kegiatan">Uraian Kegiatan</label>
                            <textarea class="form-control" id="uraian_kegiatan" rows="2" name="uraian_kegiatan" readonly><?= $mhs->uraian_kegiatan; ?></textarea>
                            <?= form_error('uraian_kegiatan', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="form-group col">
                            <label for="komentar_mentor">Komentar Mentor</label>
                            <textarea class="form-control" id="komentar_mentor" rows="2" name="komentar_mentor"><?= $mhs->komentar_mentor; ?></textarea>
                            <?= form_error('komentar_mentor', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="form-group col">
                            <label for="status">Status Laporan</label>
                            <select class="form-control" id="status" name="status">
                                <option value=""></option>
                                <option value="Disetujui" <?= (isset($mhs->status) && $mhs->status == "Disetujui") ? "selected" : ""; ?>>Disetujui</option>
                                <option value="Belum Disetujui" <?= (isset($mhs->status) && $mhs->status == "Belum Disetujui") ? "selected" : ""; ?>>Belum Disetujui</option>
                            </select>
                            <?= form_error("status", "<small class='text-danger pl-3'>", "</small>"); ?>
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
        $("#edit_laporan_mahasiswa_<?= $modal; ?>").modal("show");
    });
</script>