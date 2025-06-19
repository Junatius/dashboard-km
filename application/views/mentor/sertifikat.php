<div class="container-fluid">

    <div class="row">
        <div class="col">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <!-- Card Identifikasi Setiap Halaman Pada Header -->
    <div class="card shadow mb-4">
        <div class="card-body pb-2 pt-3">
            <h5 class="font-weight-bold text-dark">Upload Sertifikat</h5>
        </div>
    </div>

    <!-- Content Row -->
    <!-- Keterangan Bagian Atas Untuk Header -->
    <div class="mb-2">
        <div class="row">
            <div class="col">
                <div style="width: 28px; height: 7px; background-color: #4e73df; border-radius: 100px; margin-left: 3px; display: inline-block;"></div>
                <div style="display: inline-block;">
                    <h6 class="font-weight-bold text-dark" style="padding-left: 5px;">Hi, <?= $profil['nama_mentor']; ?></h6>
                </div>
                <p style="padding-left: 40px; margin-top: -6px;">
                    Please Upload Your Student Certificate Here
                </p>
            </div>
        </div>
    </div>

    <!-- Edit Account Details -->
    <div class="card shadow mb-4 pb-2">


        <?= form_open_multipart('mentor/sertifikat'); ?>
        <form class="col" style="padding-left: 21px; margin-left: -35px;">
            <div class="card-body pb-2 pt-4">
                <h6 class="font-weight-bold text-primary">Upload Sertifikat</h6>
                <br>
            </div>
            <div class="container mb-3 font-weight-bold text-dark">
                <div class="row">

                    <div class="form-group col-3" style="padding-left: 19px;">
                        <label>Nama Mahasiswa</label>
                        <select class="form-control" name="nama_mahasiswa">
                            <option value=""></option>
                            <?php foreach ($mahasiswa as $mhs): ?>
                                <option value=<?= $mhs->id_mahasiswa; ?> <?= (isset($mhs->id_mahasiswa)) ? "" : ""; ?>><?= $mhs->nama_mahasiswa; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error("nama_mahasiswa", "<small class=\"text-danger pl-3\">", "</small>"); ?>
                    </div>

                    <div class="form-group col-4">
                        <label>Sertifikat</label>
                        <div class="custom-file">
                            <div>
                                <input type="file" class="custom-file-input"
                                    id="file" name="file">
                                <label class="custom-file-label" for="file">Choose file</label>
                            </div>
                        </div>
                        <?= form_error("file", "<small class=\"text-danger pl-3\">", "</small>"); ?>
                    </div>

                </div>
                <button type="submit" class="btn btn-primary btn-sm mt-4" style="margin: auto; display: block;">Simpan</button>
            </div>
    </div>

</div>