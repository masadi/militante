
<?php
$level = Session::get('level');
?>


<nav class="main-header navbar navbar-expand navbar-white navbar-light">
     <!-- Left navbar links -->
     <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('dashboard')}}" class="nav-link">Dashboard</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('login/logout')}}" class="nav-link">Log Out</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="navbar-nav">
							<a class="nav-link"  ><span class='fa fa-calendar'></span>&nbsp;<?php echo gmdate("M d , Y");?>&nbsp;<span id="clock"></span></a>
			</li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            
            <a href="{{url('profil/')}}" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
            </a>
            <div class="dropdown-divider"></div>
            <a href="{{url('login/logout')}}" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
          
        </div>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->

   <!-- Main Sidebar Container -->
   <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src="{{url('app-assets/potocalegroot/ok3.png')}}"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{Session::get('namaaplikasi')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <?php /*<div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{url('app-assets/admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Session::get('nama')}}</a>
        </div>
      </div> */?>

      <!-- Sidebar Menu -->
      <nav class="mt-2" style="font-size:0.9em">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         
          <li class="nav-item">
            <a href="{{url('dashboard')}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <?php if ($level == 'admin') { ?>
          <!-- <li class="nav-item has-treeview menu-open"> 
                <span class="badge badge-info right">6</span>-->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Data Wilayah
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('kabupaten')}}" class="nav-link">
                  <i class="far fa-circlex nav-icon"></i>
                  <p>Municipio</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('kecamatan')}}" class="nav-link">
                  <i class="far fa-circlex nav-icon"></i>
                  <p>Posto</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('kelurahan')}}" class="nav-link">
                  <i class="far fa-circlex nav-icon"></i>
                  <p>Suco</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('tps')}}" class="nav-link">
                  <i class="far fa-circlex nav-icon"></i>
                  <p>Aldeia</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('tps_detail')}}" class="nav-link">
                  <i class="far fa-circlex nav-icon"></i>
                  <p>TPS</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-comment"></i>
              <p>
                Master Data
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('relfamilia')}}" class="nav-link">
                  <i class="far fa-circlex nav-icon"></i>
                  <p>Relasaun Familia</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('aktmilitante')}}" class="nav-link">
                  <i class="far fa-circlex nav-icon"></i>
                  <p>Actual Militantes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('kargoaktual')}}" class="nav-link">
                  <i class="far fa-circlex nav-icon"></i>
                  <p>Kargo Actual Iha Orgaun</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('sectorservico')}}" class="nav-link">
                  <i class="far fa-circlex nav-icon"></i>
                  <p>Sector Servico</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('profisaun')}}" class="nav-link">
                  <i class="far fa-circlex nav-icon"></i>
                  <p>Profisaun</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('literaria')}}" class="nav-link">
                  <i class="far fa-circlex nav-icon"></i>
                  <p>Hab. Literaria</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('estatuto')}}" class="nav-link">
                  <i class="far fa-circlex nav-icon"></i>
                  <p>Estatuto / Mutasaun</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('membru')}}" class="nav-link">
                  <i class="far fa-circlex nav-icon"></i>
                  <p>Membru Cooperative</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('periode')}}" class="nav-link">
                  <i class="far fa-circlex nav-icon"></i>
                  <p>Periode Partai</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('escola')}}" class="nav-link">
                  <i class="far fa-circlex nav-icon"></i>
                  <p>Escola/Universidade</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('faculdade')}}" class="nav-link">
                  <i class="far fa-circlex nav-icon"></i>
                  <p>Faculdade/Departamento</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('esperiancia')}}" class="nav-link">
                  <i class="far fa-circlex nav-icon"></i>
                  <p>Esperiancia Servisu</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Candidate
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('calon')}}" class="nav-link">
                  <i class="far fa-circlex nav-icon"></i>
                  <p>Presiden</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('parlement')}}" class="nav-link">
                  <i class="far fa-circlex nav-icon"></i>
                  <p>Parlement</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Tim Sukses
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('koordinator')}}" class="nav-link">
                  <i class="far fa-circlex nav-icon"></i>
                  <p>Koordinator</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('saksi')}}" class="nav-link">
                  <i class="far fa-circlex nav-icon"></i>
                  <p>Fiscais</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('tim')}}" class="nav-link">
                  <i class="far fa-circlex nav-icon"></i>
                  <p>Team</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('relawan')}}" class="nav-link">
                  <i class="far fa-circlex nav-icon"></i>
                  <p>Volunter</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Register No. Militante
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('militante/register')}}" class="nav-link">
                  <i class="far fa-circlex nav-icon"></i>
                  <p>Register</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('militante/listregister')}}" class="nav-link">
                  <i class="far fa-circlex nav-icon"></i>
                  <p>List No Militante</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Militante
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('militantevip/list')}}" class="nav-link">
                  <i class="far fa-circlex nav-icon"></i>
                  <p>Militante VIP</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('militantediaspora/list')}}" class="nav-link">
                  <i class="far fa-circlex nav-icon"></i>
                  <p>Militante Diaspora</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('militante/list')}}" class="nav-link">
                  <i class="far fa-circlex nav-icon"></i>
                  <p>Militante</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-address-card"></i>
              <p>
                UMA KAIN
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('addumakain')}}" class="nav-link">
                  <i class="far fa-circlex nav-icon"></i>
                  <p>Register New</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('umakain/list')}}" class="nav-link">
                  <i class="far fa-circlex nav-icon"></i>
                  <p>List of Uma Kain</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Quick Qount
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('dpt')}}" class="nav-link">
                  <i class="far fa-circlex nav-icon"></i>
                  <p>Akta</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('hitung')}}" class="nav-link">
                  <i class="far fa-circlex nav-icon"></i>
                  <p>Hitung Cepat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('upload')}}" class="nav-link">
                  <i class="far fa-circlex nav-icon"></i>
                  <p>Screen Shoot Foto</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Broadcast WA & SMS
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('api')}}" class="nav-link">
                  <i class="far fa-circlex nav-icon"></i>
                  <p>API</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('sms')}}" class="nav-link">
                  <i class="far fa-circlex nav-icon"></i>
                  <p>Broadcast SMS to</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('wa')}}" class="nav-link">
                  <i class="far fa-circlex nav-icon"></i>
                  <p>Broadcast WA to</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Setting
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('user')}}" class="nav-link">
                  <i class="far fa-circlex nav-icon"></i>
                  <p>User & Priveldge</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('pengaturan')}}" class="nav-link">
                  <i class="far fa-circlex nav-icon"></i>
                  <p>Setting Dashboard</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>

          <?php if ($level == 'saksi') { ?>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                Quick Count
                    <i class="fas fa-angle-left right"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{url('hitung')}}" class="nav-link">
                    <i class="far fa-circlex nav-icon"></i>
                    <p>Hitung Cepat</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('upload')}}" class="nav-link">
                    <i class="far fa-circlex nav-icon"></i>
                    <p>Upload Bukti</p>
                    </a>
                </li>
                </ul>
            </li>

        <?php } ?>

        <?php if ($level == 'koordinator') { ?>
          <li class="nav-item">
            <a href="{{url('pemilih')}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Kelola Pemilih
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('dpt')}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                DPT
              </p>
            </a>
          </li>

        <?php } ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>