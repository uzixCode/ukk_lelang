                    <div class="row">

                        <div class="col-md-6 col-xl-6">
                            <div class="card widget-box-three">
                                <div class="card-body">
                                    <div class="float-right mt-2">
                                        <i class="mdi mdi-account-multiple display-3 m-0"></i>
                                    </div>
                                    <div class="overflow-hidden">
                                        <p class="text-uppercase font-weight-medium text-truncate mb-2">Total Pengguna</p>
                                        <h2 class="mb-0"><?= currency($widget_pengguna[0]['total']) ?></span> </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->

                        <div class="col-md-6 col-xl-6">
                            <div class="card widget-box-three">
                                <div class="card-body">
                                    <div class="float-right mt-2">
                                        <i class="mdi mdi-chart-areaspline display-3 m-0"></i>
                                    </div>
                                    <div class="overflow-hidden">
                                        <p class="text-uppercase font-weight-medium text-truncate mb-2">Total Penawaran</p>
                                        <h2 class="mb-0"><span data-plugin="counterup"><?= currency($widget_history_lelang[0]['total']) ?></span> </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->

                        <div class="col-md-6 col-xl-6">
                            <div class="card widget-box-three">
                                <div class="card-body">
                                    <div class="float-right mt-2">
                                        <i class="mdi mdi-folder-multiple display-3 m-0"></i>
                                    </div>
                                    <div class="overflow-hidden">
                                        <p class="text-uppercase font-weight-medium text-truncate mb-2">Total Barang</p>
                                        <h2 class="mb-0"><?= currency($widget_barang[0]['total']) ?></span> </h2>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-6">
                            <div class="card widget-box-three">
                                <div class="card-body">
                                    <div class="float-right mt-2">
                                        <i class="mdi mdi-bullhorn display-3 m-0"></i>
                                    </div>
                                    <div class="overflow-hidden">
                                        <p class="text-uppercase font-weight-medium text-truncate mb-2">Total Lelang</p>
                                        <h2 class="mb-0"><?= currency($widget_lelang[0]['total']) ?></span> </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->