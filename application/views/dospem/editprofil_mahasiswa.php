<div class="container-fluid">
    <!-- Card Identifikasi Setiap Halaman Pada Header -->
    <div class="card shadow mb-4">
        <div class="card-body pb-2 pt-3">
            <h5 class="font-weight-bold text-dark">Edit Profil Mahasiswa</h5>
        </div>
    </div>

    <!-- Keterangan Bagian Atas Untuk Header -->
    <div class="row">
        <div class="col">
            <div style="width: 28px; height: 7px; background-color: #4e73df; border-radius: 100px; margin-left: 3px; display: inline-block;"></div>
            <div style="display: inline-block;">
                <h6 class="font-weight-bold text-dark" style="padding-left: 5px;">Edit Profile</h6>
            </div>
            <p style="padding-left: 40px; margin-top: -6px;">
                Change information about student on this page
            </p>
        </div>
    </div>


    <!-- Edit Account Details -->
    <div class="card shadow mb-4 pb-2">
        <div class="card-body pb-2 pt-4">
            <h6 class="font-weight-bold text-primary">Account Details</h6>
            <br>
        </div>

        <form class="col" style="padding-left: 21px; margin-left: -35px;">
            <div class="container mb-3 font-weight-bold text-dark">

                <div class="row">
                    <div class="form-group col">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_lengkap">
                    </div>

                    <div class="form-group col">
                        <label for="nim">NIM</label>
                        <input type="text" class="form-control" id="nim">
                    </div>

                    <div class="form-group col">
                        <label for="ipk">IPK</label>
                        <input type="text" class="form-control" id="ipk">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="form-group col">
                        <label for="program_studi">Program Studi</label>
                        <input type="text" class="form-control" id="program_studi">
                    </div>

                    <div class="form-group col">
                        <label for="program_studi">Role</label>
                        <select id="program_studi" class="form-control">
                            <option selected>Select . . .</option>
                            <option>Mahasiswa</option>
                            <option>Kaprodi</option>
                            <option>Mentor</option>
                            <option>DPP</option>
                        </select>
                    </div>

                    <div class="col">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <div>
                            <div class="form-check font-weight-normal" style="margin-top: -5px;">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1">
                                <label class="form-check-label" for="exampleRadios1">
                                    Laki - Laki
                                </label>
                            </div>
                            <div class="form-check font-weight-normal">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                <label class="form-check-label" for="exampleRadios2">
                                    Perempuan
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="form-group col-4">
                        <label for="no_hp">No. HP</label>
                        <input type="text" class="form-control" id="no_hp">
                    </div>

                    <div class="form-group col-4">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email">
                    </div>
                </div>
            </div>


            <!-- Edit Program dan Instansi -->
            <div class="pt-3">
                <h6 class="font-weight-bold text-primary pb-3" style="margin-left: 36px;">Program dan Instansi</h6>
                <br>

                <form class="col" style="padding-left: 21px; margin-left: -35px;">
                    <div class="container mb-3 font-weight-bold text-dark">

                        <div class="row">
                            <div class="form-group col">
                                <label for="namaprogram_km">Nama Program KM</label>
                                <input type="text" class="form-control" id="namaprogram_km">
                            </div>

                            <div class="form-group col">
                                <label for="nama_instansi">Nama Instansi</label>
                                <input type="text" class="form-control" id="nama_instansi">
                            </div>

                            <div class="form-group col">
                                <label for="alamat_instansi">Alamat Instansi</label>
                                <input type="text" class="form-control" id="alamat_instansi">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="form-group col">
                                <label for="status_kegiatan">Status Kegiatan</label>
                                <select id="status_kegiatan" class="form-control">
                                    <option selected>Select . . .</option>
                                    <option>Aktif</option>
                                    <option>Tidak Aktif</option>
                                </select>
                            </div>

                            <div class="form-group col">
                                <label for="durasi_kegiatan">Durasi Kegiatan</label>
                                <select id="durasi_kegiatan" class="form-control">
                                    <option selected>Select . . .</option>
                                    <option>Februari - Maret 2024</option>
                                    <option>Agustus - Desember 2023</option>
                                </select>
                            </div>


                            <div class="form-group col-4">
                                <label for="nama_mentor">Nama Mentor</label>
                                <input type="text" class="form-control" id="nama_mentor">
                            </div>
                        </div>

                        <button type="button" class="btn btn-primary btn-sm mt-5" style="margin: auto; display: block;">Simpan</button>
                    </div>
            </div>
    </div>
</div>