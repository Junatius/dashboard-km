<div class="container-fluid">

    <div class="row">
        <div class="col">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <!-- Card Identifikasi Setiap Halaman Pada Header -->
    <div class="card shadow mb-4">
        <div class="card-body pb-2 pt-3">
            <h5 class="font-weight-bold text-dark">Tambah Laporan</h5>
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
                Di halaman ini anda dapat menambahkan Laporan Kegiatan sesuai dengan tipe laporan
            </p>
        </div>
    </div>

    <div class="card shadow mb-4 pb-4">
        <div class="card-body pb-2 pt-4">
            <h6 class="font-weight-bold text-primary">Tambah Laporan</h6>
            <br>
        </div>

        <?= form_open_multipart('mahasiswa/laporan/tambah_laporan'); ?>
        <form class="col-12 font-weight-bold text-dark" style="padding-left: 21px;">
            <div class="container mb-3 font-weight-bold text-dark">
                <div class="row mb-2">
                    <div class="form-group col-3">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal">
                        <?= form_error('tanggal', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <div class="form-group col-3" style="padding-left: 19px;">
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

                    <div class="form-group col-5">
                        <label>Upload File</label>
                        <div class="custom-file">
                            <div>
                                <input type="file" class="custom-file-input"
                                    id="file" name="file">
                                <label class="custom-file-label" for="file">Choose file</label>
                            </div>
                            <div>
                                <p>Bagian Upload File Hanya Untuk Laporan Akhir</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col">
                        <label for="uraian_kegiatan">Uraian Kegiatan</label>
                        <textarea class="form-control" id="uraian_kegiatan" rows="2" name="uraian_kegiatan"></textarea>
                        <?= form_error("uraian_kegiatan", "<small class=\"text-danger pl-3\">", "</small>"); ?>
                        <div>
                            <p>Bagian Uraian Kegiatan Untuk Laporan Harian dan Laporan Mingguan</p>
                        </div>
                    </div>

                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-sm mt-4" style="margin: auto; display: block;">Simpan</button>
        </form>
    </div>
</div>