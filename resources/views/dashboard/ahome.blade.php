@extends('layoututama')
@section('content')
<?php
$level = Session::get('level');
?>
<style>

</style>
<div class="main-content">
    <section class="section">
        <?php  if ($level == 'admin') { ?>
            <div class="row">

          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-info">
              <div class="inner">
                                
                <h3>{{ $totalmilitante }}<sup style="font-size: 20px"> Orang</sup></h3>

                <p>Militante</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-barss"></i>
              </div>
              <a href="{{url('militante')}}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $totalmilitantevip }}<sup style="font-size: 20px"> Orang</sup></h3>

                <p>Militante VIP</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{url('militantevip')}}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $totalmilitantediaspora }}<sup style="font-size: 20px"> Orang</sup></h3>

                <p>Militante Diaspora</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{url('militantediaspora')}}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-purple">
              <div class="inner">
                <h3>0</h3>

                <p>UMA KAIN</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{url('umakain')}}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div> 

          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Sebaran Militante</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-wrench"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="#" class="dropdown-item">Action</a>
                      <a href="#" class="dropdown-item">Another action</a>
                      <a href="#" class="dropdown-item">Something else here</a>
                      <a class="dropdown-divider"></a>
                      <a href="#" class="dropdown-item">Separated link</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div>
                        <div class="h-100 w-100">
                        <div class="h-100 bg-white" id="map" style="min-height: 500px;"></div>
                       
                        </div>
              </div>
              <!-- ./card-body -->
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <h5 class="description-header">0</h5>
                      <span class="description-text">TOTAL POSTO</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <h5 class="description-header">0</h5>
                      <span class="description-text">TOTAL SUCO</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <h5 class="description-header">0</h5>
                      <span class="description-text">TOTAL ALDEIA</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block">
                      <h5 class="description-header">1200</h5>
                      <span class="description-text">GOAL COMPLETIONS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->


            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                        <h5 class="card-title">Target Suara Municipio</h5>
                        </div>
                        <div class="card-body">
                            <!-- <canvas id="targetSuaraDistrictChart"></canvas> -->
                            
                            <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                        <h5 class="card-title">Target Suara Posto</h5>
                        </div>
                        <div class="card-body">
                            <!-- <canvas id="targetSuaraSubDistrictChart"></canvas> -->
                            <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                        <h5 class="card-title">Target Suara Suco</h5>
                        </div>
                        <div class="card-body">
                            <!-- <canvas id="targetSuaraSucoChart"></canvas> -->
                            <canvas id="pieChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                </div>
            </div>



          </div>
          <!-- /.col -->

          
          <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Sebaran Militante</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-wrench"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="#" class="dropdown-item">Action</a>
                      <a href="#" class="dropdown-item">Another action</a>
                      <a href="#" class="dropdown-item">Something else here</a>
                      <a class="dropdown-divider"></a>
                      <a href="#" class="dropdown-item">Separated link</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div>
              <div id="divkabupaten">
              </div>
              <!-- ./card-body -->
              
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>

        <?php  } elseif ($level == 'koordinator') { ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="box-title">Pengumuman untuk koordinator</h4>
                        </div>
                        <div class="card-body">

                            <?php $notifikasikoordinator = DB::table('notifikasi')->get(); ?>
                            <?php  foreach ($notifikasikoordinator as $listkoordinator) { ?>
                                <ul class="timeline">
                                    <li class="time-label">
                                        <span class="bg-red">
                                            <?= $listkoordinator->tanggalnotifikasi ?>
                                        </span>
                                    </li>
                                    <li>
                                        <i class="fa fa-envelope bg-blue"></i>
                                        <div class="timeline-item">

                                            <h3 class="timeline-header"><?= $listkoordinator->namanotifikasi ?></h3>

                                            <div class="timeline-body">
                                                <?= $listkoordinator->deskripsinotifikasi ?>
                                            </div>
                                    <li>
                                        <i class="fa fa-user bg-aqua"></i>

                                        <div class="timeline-item">
                                            <h3 class="timeline-header no-border"><?= $listkoordinator->usernotifikasi ?> | ADMIN</h3>
                                        </div>
                                    </li>
                        </div>
                        </li>
                        </ul>
                    <?php  } ?>
                    </div>
                </div>
            </div>
</div>
<?php  } elseif ($level == 'relawan') { ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Pengumuman untuk relawan</h4>
                </div>
                <div class="card-body">
                    <?php $notifikasirelawan = DB::table('notifikasi')->get(); ?>
                    <?php  foreach ($notifikasirelawan as $listrelawan) { ?>
                        <ul class="timeline">
                            <li class="time-label">
                                <span class="bg-red">
                                    <?= $listrelawan->tanggalnotifikasi ?>
                                </span>
                            </li>
                            <li>
                                <i class="fa fa-envelope bg-blue"></i>
                                <div class="timeline-item">
                                    <h3 class="timeline-header"><?= $listrelawan->namanotifikasi ?></h3>

                                    <div class="timeline-body">
                                        <?= $listrelawan->deskripsinotifikasi ?>
                                    </div>
                            <li>
                                <i class="fa fa-user bg-aqua"></i>
                                <div class="timeline-item">
                                    <h3 class="timeline-header no-border"><?= $listrelawan->usernotifikasi ?> | ADMIN</h3>
                                </div>
                            </li>

                </div>
                </li>
                </ul>
            <?php  } ?>



            </div>
        </div>
    </div>
    </div>
<?php  } elseif ($level == 'saksi') { ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Pengumuman untuk Saksi</h4>
                </div>
                <div class="card-body">
                    <?php $notifikasisaksi = DB::table('notifikasi')->get(); ?>
                    <?php  foreach ($notifikasisaksi as $listxx) { ?>
                        <ul class="timeline">
                            <li class="time-label">
                                <span class="bg-red">
                                    <?= $listxx->tanggalnotifikasi ?>
                                </span>
                            </li>
                            <li>
                                <i class="fa fa-envelope bg-blue"></i>
                                <div class="timeline-item">



                                    <h3 class="timeline-header"><?= $listxx->namanotifikasi ?></h3>

                                    <div class="timeline-body">
                                        <?= $listxx->deskripsinotifikasi ?>
                                    </div>
                            <li>
                                <i class="fa fa-user bg-aqua"></i>

                                <div class="timeline-item">


                                    <h3 class="timeline-header no-border"><?= $listxx->usernotifikasi ?> | ADMIN</h3>
                                </div>
                            </li>
                </div>
                </li>
                </ul>
            <?php  } ?>



            </div>
        </div>
    </div>
    </div>


<?php  } else { ?>
    <div class="row">

        <div class="col-6 col-sm-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>Grafik Suara Per District</h4>
                    <div class="card-header-action">
                        <a data-collapse="#mycard-collapse" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                    </div>
                </div>
                <div class="collapse show" id="mycard-collapse">
                    <div id="divkabupaten">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>Grafik Suara Per Sub District</h4>
                    <div class="card-header-action">
                        <a data-collapse="#kecamatan-collapse" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                    </div>
                </div>
                <div class="collapse show" id="kecamatan-collapse">
                    <div id="divkecamatan">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>Grafik Suara Per Suco</h4>
                    <div class="card-header-action">
                        <a data-collapse="#suco-collapse" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                    </div>
                </div>
                <div class="collapse show" id="suco-collapse">
                    <div id="divkelurahan">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>Grafik Suara Per Aldeia</h4>
                    <div class="card-header-action">
                        <a data-collapse="#aldeia-collapse" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                    </div>
                </div>
                <div class="collapse show" id="aldeia-collapse">
                    <div id="divtps">
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php  } ?>

</section>
</div>
<?php $totaltarget=300;?>



@endsection
