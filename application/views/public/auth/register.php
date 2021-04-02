
                    <!-- Start end -->
                   <div class="col-md-6 col-lg-5">
                        <!-- Start Auth Box -->
                        <div class="auth-box-right">
                            <div class="card">
                                <div class="card-body">
                                    <form class="form-horizontal" method="post">
                                        <h5 class="text-primary text-center mb-4">DAFTAR</h5>
                                        <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                                        <?php $this->load->view('result') ?>   
                                                <div class="form-group text-left">
                                                    <label for="username">Nama Lengkap</label>
                                                    <input type="text" class="form-control" name="nama_lengkap" placeholder="Masukkan Nama Lengkap" <?= set_value('nama_lengkap') ?>>
                                                </div>                                    
                                                <div class="form-group text-left">
                                                    <label for="username">Username</label>
                                                    <input type="text" class="form-control" name="username" placeholder="Masukkan username" <?= set_value('username') ?>>
                                                </div>
                                                <div class="form-group text-left">
                                                    <label for="username">Nomor Telepon</label>
                                                    <input type="text" class="form-control" name="telp" placeholder="Masukkan nomor telepon" <?= set_value('telp') ?>>
                                                </div>
                                                <div class="form-group text-left">
                                                    <label for="userpassword">Password</label>
                                                    <input type="password" class="form-control" name="password" placeholder="Masukkan password">
                                                </div>
                                                <div class="form-group text-left">
                                                    <label for="userpassword">Konfirmasi Password</label>
                                                    <input type="password" class="form-control" name="confirm_password" placeholder="Konfirmasi password">
                                                </div>                                  
                                                <div class="form-group text-left">
                                                    <label><input type="checkbox" name="terms" value="1"> Saya setuju dengan <a class="text-primary" data-animation="slideInUp" data-toggle="modal" data-target="#exampleModalLong-1">Ketentuan Layanan</a>.</label>
                                                </div>
                                                <div class="mt-4">
                                                    <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Daftar</button>
                                                </div>
                                    </form>
                                    <p class="mb-0 mt-3">Sudah punya akun? <a href="<?= base_url('auth/login') ?>">Login</a></p>
                                </div>
                            </div>
                        </div>
                        <!-- End Auth Box -->
                    </div>
                    <!-- End col -->
                    <!-- Modal -->
                                <div class="modal fade" id="exampleModalLong-1" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle-1">Ketentuan Layanan</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p><?= config('terms_link') ?></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Ok</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                                  