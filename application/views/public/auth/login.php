                    <!-- Start col -->
                    <div class="col-md-6 col-lg-5">
                        <!-- Start Auth Box -->
                        <div class="auth-box-right">
                            <div class="card">
                                <div class="card-body">
                                    <form method="post">
                                        <div class="form-head">
                                            <a href="<?= base_url() ?>" class="logo"><h4 class="logo logo-large text-primary text-uppercase"><?= (config('title')) ? config('title') : $config['title'] ?></h4></a>
                                        </div> 
                                        <h5 class="text-primary text-center my-4">LOGIN</h5>
                                        <?php $this->load->view('result') ?>
                                        <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="username" placeholder="Masukkan username anda">

                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="password" placeholder="Masukkan password anda">
                                        </div>
                                        <div class="form-row mb-3">
                                            <div class="col-sm-6">
                                                <div class="custom-control custom-checkbox text-left">
                                                  <input type="checkbox" class="custom-control-input" id="rememberme" value="1">
                                                  <label class="custom-control-label font-14" for="rememberme">Ingat Saya</label>
                                                </div>                                
                                            </div>
                                            <div class="col-sm-6">
                                            </div>
                                        </div>                          
                                      <button type="submit" class="btn btn-primary btn-lg btn-block font-18">Login</button>
                                    </form>
                                    <p class="mb-0 mt-3">Belum memiliki akun? <a href="<?= base_url('auth/register') ?>">Daftar</a></p>
                                </div>
                            </div>
                        </div>
                        <!-- End Auth Box -->
                    </div>
                    <!-- End col -->