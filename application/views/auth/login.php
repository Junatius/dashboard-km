<body class="bg-gradient-primary">
    <div class="" style="height: 100vh;">
        <div class="row mx-auto" style="height: 100%;">
            <div class="col" style="background-image: url(<?php echo base_url('assets/template/img/gambar_login1.png'); ?>); background-size: cover; background-repeat: no-repeat;">
            </div>

            <div class="col-5 mx-auto" style="background-color: #f2f5fd;">
                <!-- Outer Row -->
                <div class="mx-auto" style="display: flex; justify-content: center; align-items: center; margin-top: 8vh;">
                    <div class="col-xl-10 col-lg-12 col-md-9">
                        <div class="o-hidden border-0 my-5 mx-auto">
                            <div class="card-body p-0">
                                <!-- Nested Row within Card Body -->
                                <div class="row mx-auto">
                                    <div class="col">
                                        <div class="p-5">
                                            <div class="text-center">
                                                <div class="mb-5 font-weight-bold text-uppercase" style="font-size: 1.5rem; font-weight: 720!important;  color: #303b84;">Kampus Merdeka Login Portal</div>
                                            </div>


                                            <?php if ($this->session->flashdata('message')) { ?>
                                                <?= $this->session->flashdata('message') ?>
                                            <?php
                                            } ?>

                                            <form class="user" method="post" action="<?= base_url('Auth'); ?>">
                                                <p class="mb-2">Email Pengguna</p>
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-user" style="border-radius: 10px; padding: 1.2rem 1rem;"
                                                        id="email" name="email"
                                                        placeholder="Email" value="<?= set_value('email'); ?>">
                                                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>

                                                <p class="mb-2">Password</p>
                                                <div class="form-group mb-4">
                                                    <input type="password" class="form-control form-control-user" style="border-radius: 10px; padding: 1.2rem 1rem;"
                                                        id="password" name="password" placeholder="Password">
                                                    <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-user btn-block shadow" style="border-radius: 7px; background-color: #303b84; padding: 0.5rem;">
                                                    Login
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>