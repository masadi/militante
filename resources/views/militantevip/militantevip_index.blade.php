@extends('layoututama')
@section('content')
<?php
$username = Session::get('username');
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>


<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
<link href="{{url('app-assets/css/signature//jquery.signature.css')}}" rel="stylesheet">
<style>
.kbw-signature { width: 400px; height: 200px; }
</style>

<style type="text/css">
  #results { padding:20px; border:1px solid; background:#ccc; }

  .labelbold { font-weight:bold;}
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<div class="main-content">
  <section class="section">
    <div class='row'>
						<div class='col-md-12'>
						</form>

						<form action="javascript:save()" id="form1" name="form1" class="form-horizontal" method='POST' enctype="multipart/form-data" >
                                        {{csrf_field()}}
                                        <input type="hidden" class="form-control" id="_token"  name="_token" value="{{csrf_token()}}">
              <div class='card card-primary'>
								<div class='card-header with-border'>
									<h4 class='card-title'><i class="fas fa-address-book"></i> I. TEMPAT TINGGAL</h4>
								</div><!-- /.card-header -->
								<div class='card-body'>
									<div>
                                              <div class="row">
                                                <div class="form-group  row col-md-3">
                                                  <label for="tahunlulus" class="col-sm-12 control-label labelbold">Municipio</label>

                                                  <div class="col-md-12">
                                                    <select name="kabupatentim" id="kabupatentim" class="form-control" required>
                                                      <?php
                                                      $listkabupaten = DB::table('kabupaten')->get();
                                                      ?>
                                                      <option>-- Select Municipio --</option>
                                                      <?php foreach ($listkabupaten as $list) { $dt_option = $list->kode_district . ' | ' . $list->nama_district; ?>
                                                      <option value="{{ $list->kode_district }}" >
                                                          {{ $dt_option }}
                                                      </option>
                                                      <?php } ?>
                                                    </select>

                                                  </div>
                                                </div>

                                                <div class="form-group  row col-md-3">
                                                  <label for="kecamatantim" class="col-sm-12 control-label">Posto</label>

                                                  <div class="col-md-12">
                                                  <select name="kecamatantim" id="kecamatantim" value="" class="form-control" required>

                                                  </select>
                                                  </div>
                                                </div>

                                                <div class="form-group  row col-md-3">
                                                  <label for="tahunlulus" class="col-sm-12 control-label">Suco</label>

                                                  <div class="col-md-12">
                                                    <select name="kelurahantim" id="kelurahantim" value="" class="form-control" required>

                                                    </select>
                                                  </div>
                                                </div>

                                                <div class="form-group  row col-md-3">
                                                  <label for="tahunlulus" class="col-sm-12 control-label">Aldeia</label>

                                                  <div class="col-md-12">
                                                    <select name="tpstim" id="tpstim" value="" class="form-control" required>

                                                    </select>

                                                  </div>
                                                </div>
                                              </div>
                                              <!-- /.card-body -->

									</div>
								</div>
							</div>

							<div class='card card-primary'>
								<div class='card-header with-border'>
									<h4 class='card-title'><i class="fas fa-address-book    "></i> II. BIODATA</h4>
								</div><!-- /.card-header -->

								<div class='card-body'>
									<div>
                                              <div class="row">

                                                <div class="form-group  row col-md-4">
                                                  <label for="nama" class="col-sm-12 control-label">No. Militante</label>

                                                  <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="nomilitante" name="nomilitante" placeholder="No Militante" value=""    required='required' readonly>
                                                  </div>
                                                  <div class="col-sm-1">
                                                    <a href="{{url('militante/register')}}" class='btn btn-dark' ><span class="fa fa-search"></span></a>
                                                  </div>
                                                </div>

                                                <div class="form-group  row col-md-4">
                                                  <label for="nama" class="col-sm-12 control-label">Tanggal</label>

                                                  <div class="col-sm-12">
                                                    <input type="text" class="form-control pickadate" id="date1" name="tanggal" placeholder="Nama Lengkap" value="<?php echo date('Y-m-d');?>"    required='required'>
                                                  </div>
                                                </div>

                                                <div class="form-group  row col-md-4">
                                                  <label for="nama" class="col-sm-12 control-label">No. Elektor</label>

                                                  <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="noelektor" name="noelektor" placeholder="No Elektor" value=""    required='required'>
                                                  </div>
                                                </div>


                                                <div class="form-group  row col-md-4">
                                                  <label for="nama" class="col-sm-12 control-label">Status Militante</label>

                                                  <div class="col-sm-12">
                                                    <select name="statusmilitante" class="form-control">
                                                      <option value="">-- Select Status --</option>
                                                      <option value="1">Active</option>
                                                      <option value="2">Non Active</option>
                                                    </select>
                                                  </div>
                                                </div>


                                                <div class="form-group  row col-md-4">
                                                  <label for="nama" class="col-sm-12 control-label">Tanggal Terbit</label>

                                                  <div class="col-sm-12">
                                                    <input type="text" class="form-control pickadate" id="date2" name="tanggalterbit" placeholder="Nama Lengkap" value="<?php echo date('Y-m-d') ?>"    required='required'>
                                                  </div>
                                                </div>

                                                <div class="form-group  row col-md-4">
                                                  <label for="nama" class="col-sm-12 control-label">Valid Until</label>

                                                  <div class="col-sm-12"><?php $end = date('Y-m-d', strtotime('+5 years'));?>
                                                    <input type="text" class="form-control pickadate" id="date3" name="validuntil" placeholder="Nama Lengkap" value="{{$end}}"    required='required'>
                                                  </div>
                                                </div>


                                                <div class="form-group  row col-md-12">
                                                  <label for="nama" class="col-sm-12 control-label">Nama Lengkap</label>

                                                  <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" value=""    required='required'>
                                                  </div>
                                                </div>


                                                <div class="form-group row col-md-8">
                                                    <label for="tempatlahir" class="col-sm-12 control-label">Tempat / Tgl Lahir</label>

                                                    <div class="col-sm-4">
                                                      <input type="text" class="form-control" id="tempatlahir" name="tempatlahir" placeholder="Tempat Lahir" value=""  maxlength='20'   required='required'>
                                                    </div>
                                                    <?php /* <div class="col-sm-6">
                                                      <input type="text" class="form-control pickadate" id="tgllahir"  name="tgllahir" placeholder="Tanggal Lahir" value=""    required='required'>
                                                    </div> */ ?>

<div class="col-sm-8 ">
                                                  <div class="row  col-sm-12">
                                                  <div class="" style="width=50px">
                                                    <select name="thn" id="thn" class="form-control">
                                                      <?php for($i=date('Y');$i>date('Y')-120;$i--) { ?>
                                                        <option value="{{$i}}">{{$i}}</option>
                                                      <?php } ?>
                                                    </select>
                                                  </div>
                                                  <div class="" style="width=60px">
                                                    <select name="bln" id="bln" class="form-control">
                                                      <?php $bln=date('m');
                                                        for($i=1;$i<=12;$i++) { ?>
                                                        <?php if($i==1) { ?>
                                                          <?php if($i==$bln) { ?>
                                                            <option value="{{$i}}" selected>January</option>
                                                          <?php } else { ?>
                                                            <option value="{{$i}}">January</option>
                                                          <?php } ?>
                                                        <?php } else if($i==2) { ?>
                                                          <?php if($i==$bln) { ?>
                                                            <option value="{{$i}}" selected>February</option>
                                                          <?php } else { ?>
                                                            <option value="{{$i}}">February</option>
                                                          <?php } ?>
                                                        
                                                        <?php } else if($i==3) { ?>
                                                          <?php if($i==$bln) { ?>
                                                            <option value="{{$i}}" selected>March</option>
                                                          <?php } else { ?>
                                                            <option value="{{$i}}">March</option>
                                                          <?php } ?>
                                                        
                                                        <?php } else if($i==4) { ?>
                                                          <?php if($i==$bln) { ?>
                                                            <option value="{{$i}}" selected>April</option>
                                                          <?php } else { ?>
                                                            <option value="{{$i}}">April</option>
                                                          <?php } ?>
                                                        
                                                        <?php } else if($i==5) { ?>
                                                          <?php if($i==$bln) { ?>
                                                            <option value="{{$i}}" selected>May</option>
                                                          <?php } else { ?>
                                                            <option value="{{$i}}">May</option>
                                                          <?php } ?>
                                                        
                                                        <?php } else if($i==6) { ?>
                                                          <?php if($i==$bln) { ?>
                                                            <option value="{{$i}}" selected>June</option>
                                                          <?php } else { ?>
                                                            <option value="{{$i}}">June</option>
                                                          <?php } ?>
                                                        
                                                        <?php } else if($i==7) { ?>
                                                          <?php if($i==$bln) { ?>
                                                            <option value="{{$i}}" selected>July</option>
                                                          <?php } else { ?>
                                                            <option value="{{$i}}">July</option>
                                                          <?php } ?>
                                                        
                                                        <?php } else if($i==8) { ?>
                                                          <?php if($i==$bln) { ?>
                                                            <option value="{{$i}}" selected>August</option>
                                                          <?php } else { ?>
                                                            <option value="{{$i}}">August</option>
                                                          <?php } ?>
                                                        
                                                        <?php } else if($i==9) { ?>
                                                          <?php if($i==$bln) { ?>
                                                            <option value="{{$i}}" selected>September</option>
                                                          <?php } else { ?>
                                                            <option value="{{$i}}">September</option>
                                                          <?php } ?>
                                                        
                                                        <?php } else if($i==10) { ?>
                                                          <?php if($i==$bln) { ?>
                                                            <option value="{{$i}}" selected>October</option>
                                                          <?php } else { ?>
                                                            <option value="{{$i}}">October</option>
                                                          <?php } ?>
                                                        
                                                        <?php } else if($i==11) { ?>
                                                          <?php if($i==$bln) { ?>
                                                            <option value="{{$i}}" selected>November</option>
                                                          <?php } else { ?>
                                                            <option value="{{$i}}">November</option>
                                                          <?php } ?>
                                                        
                                                        <?php } else if($i==12) { ?>
                                                          <?php if($i==$bln) { ?>
                                                            <option value="{{$i}}" selected>December</option>
                                                          <?php } else { ?>
                                                            <option value="{{$i}}">December</option>
                                                          <?php } ?>
                                                        <?php } ?>
                                                        
                                                      <?php } ?>
                                                    </select>    
                                                  </div>
                                                  <div class=""  style="width=50px">
                                                    <?php $tgl=date('d');?>
                                                    <select name="tgl" id="tgl" class="form-control">
                                                      <?php for($i=1;$i<=31;$i++) { ?>
                                                        <?php if($tgl==$i) { ?> <option value="{{$i}}" selected><?php } else { ?>
                                                          <option value="{{$i}}">
                                                          <?php } ?>
                                                        
                                                          <?php if($i<10) { 
                                                            echo "0".$i;
                                                           } else {
                                                            echo $i;
                                                           } ?>
                                                        </option>
                                                      <?php } ?>
                                                    </select>
                                                          </div>
                                                  </div>

                                                    </div>
                                                </div>

                                                <div class="form-group  row col-md-4">
                                                  <label for="tgllahir" class="col-sm-12 control-label" >Usia (Tahun)</label>

                                                  <div class="col-sm-12">
                                                    <input type="text"  class='form-control' id="usia" name="usia" placeholder="Usia" value="" >
                                                  </div>
                                                </div>

                                                <div class="form-group  row col-md-3">
                                                  <label for="jeniskelamin" class="col-sm-12 control-label">Jenis Kelamin</label>

                                                  <div class="col-sm-12">
                                                    <select class="form-control" id="jeniskelamin" name="jeniskelamin" placeholder="Jenis Kelamin"  required='required'>

                                                      <option value="">-- Select Jenis Kelamin --</option>
                                                      <option value="L">Mane</option>
                                                      <option value="P">Feto</option>
                                                    </select>
                                                  </div>
                                                </div>


                                                <div class="form-group  row col-md-3">
                                                  <label for="agama" class="col-sm-12 control-label">Agama</label>

                                                  <div class="col-sm-12">
                                                    <select class="form-control" id="agama" name="agama" placeholder="Agama" required='required'>
                                                      <option value="">-- Select Agama --</option>
                                                      <option value="Katolik">Katolik</option>
                                                      <option value="Kristen">Kristen</option>
                                                      <option value="Islam">Islam</option>
                                                      <option value="Hindu">Hindu</option>
                                                      <option value="Budha">Budha</option>
                                                    </select>
                                                  </div>
                                                </div>

                                                <div class="form-group  row col-md-12">
                                                  <label for="nisn" class="col-sm-12 control-label">Nama Ayah</label>

                                                  <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="namaayah" name="namaayah" placeholder="Nama Ayah" value=""    >
                                                  </div>
                                                </div>

                                                <div class="form-group  row col-md-12">
                                                  <label for="nisn" class="col-sm-12 control-label">Nama Ibu</label>

                                                  <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="namaibu" name="namaibu" placeholder="Nama Ibu" value=""    >
                                                  </div>
                                                </div>

                                                <div class="form-group  row col-md-12">
                                                  <label for="nik" class="col-sm-12 control-label">Alamat Sekarang</label>

                                                  <div class="col-sm-10">
                                                    <textarea  class="form-control" rows="5" id="alamat" name="alamat" placeholder="Alamat"  required='required'></textarea>
                                                  </div>
                                                </div>


                                                <div class="form-group  row col-md-3">
                                                  <label for="nama" class="col-sm-12 control-label">Telepon</label>

                                                  <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Telepon" value=""   >
                                                  </div>
                                                </div>

                                                <div class="form-group  row col-md-4">
                                                  <label for="nama" class="col-sm-12 control-label">Email</label>

                                                  <div class="col-sm-12">
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value=""   >
                                                  </div>
                                                </div>
                                                <div class="form-group  row col-md-12">
                                                  <label for="nik" class="col-sm-12 control-label">Keterangan</label>

                                                  <div class="col-sm-10">
                                                    <textarea  class="form-control" rows="10" id="keterangan" name="keterangan" placeholder="Keterangan" ></textarea>
                                                  </div>
                                                </div>



                                              </div>
                                              <!-- /.card-body -->


									</div>
								</div>
							</div>



							<div class="row"><div class="col-lg-6">
							<div class='card card-primary'>
								<div class='card-header with-border'>
									<h4 class='card-title'><i class="fas fa-address-book    "></i> III. Tahun Patis</h4>
								</div><!-- /.card-header -->

								<div class='card-body'>
									<div>


                  <div class="row">
                                                <div class="form-group  row col-md-6">
                                                  <label for="agama" class="col-sm-12 control-label">Periode</label>

                                                  <div class="col-sm-12">
                                                    <select class="form-control" id="periode" name="periode"  >
                                                        <?php
                                                        $periodelist = DB::table('periode')->get();
                                                        ?>
                                                        <option>Select Item</option>
                                                        <?php foreach ($periodelist as $list) { $dt_option = $list->name; ?>
                                                        <option value="{{ $list->id }}" >
                                                        {{ $dt_option }}
                                                        </option>
                                                        <?php } ?>
                                                    </select>
                                                  </div>
                                                </div>

                                                <div class="form-group  row col-md-6">
                                                  <label for="agama" class="col-sm-12 control-label">Jabatan</label>

                                                  <div class="col-sm-12">
                                                    <select class="form-control" id="jabatan" name="jabatan" placeholder="Jabatan">

                                                        <?php
                                                        $jabatan_list = DB::table('kargoaktual')->get();
                                                        ?>
                                                        <option>Select Item</option>
                                                        <?php foreach ($jabatan_list as $list) { $dt_option = $list->name; ?>
                                                        <option value="{{ $list->id }}" >
                                                        {{ $dt_option }}
                                                        </option>
                                                        <?php } ?>

                                                  </select>
                                                  </div>
                                                </div>
                                                <div class="form-group  row col-md-6">
                                                  <label for="agama" class="col-sm-12 control-label">Habilitasaun Literaria</label>

                                                  <div class="col-sm-12">
                                                    <select class="form-control" id="pendidikan" name="pendidikan"  >
                                                        <?php
                                                        $didiklist = DB::table('literaria')->get();
                                                        ?>
                                                        <option>Select Item</option>
                                                        <?php foreach ($didiklist as $list) { $dt_option = $list->name; ?>
                                                        <option value="{{ $list->id }}" >
                                                        {{ $dt_option }}
                                                        </option>
                                                        <?php } ?>

                                                    </select>
                                                  </div>
                                                </div>
                                                <div class="form-group  row col-md-6">
                                                  <label for="agama" class="col-sm-12 control-label">Faculdade/Departamento</label>

                                                  <div class="col-sm-12">
                                                    <select class="form-control" id="jurusan" name="jurusan" placeholder="jurusan">

                                                        <?php
                                                        $faculdade_list = DB::table('faculdade')->get();
                                                        ?>
                                                        <option>Select Item</option>
                                                        <?php foreach ($faculdade_list as $list) { $dt_option = $list->name; ?>
                                                        <option value="{{ $list->id }}" >
                                                        {{ $dt_option }}
                                                        </option>
                                                        <?php } ?>

                                                  </select>
                                                  </div>
                                                </div>


                                                <div class="form-group  row col-md-6">
                                                  <label for="universitas" class="col-sm-12 control-label">Escola/Universidade</label>

                                                  <div class="col-sm-12">
                                                    <select class="form-control" id="universitas" name="universitas" placeholder="universitas">

                                                        <?php
                                                        $escola_list = DB::table('escola')->get();
                                                        ?>
                                                        <option>Select Item</option>
                                                        <?php foreach ($escola_list as $list) { $dt_option = $list->name; ?>
                                                        <option value="{{ $list->id }}" >
                                                        {{ $dt_option }}
                                                        </option>
                                                        <?php } ?>

                                                  </select>
                                                  </div>
                                                  
                                                </div>


                                                <div class="form-group  row col-md-6">

                                                  <label for="tahunlulus" class="col-sm-12 control-label">Tinan Remata</label>

                                                  <div class="col-sm-8">
                                                    <input type="number" class="form-control" id="tahunlulus" name="tahunlulus" >

                                                  </div>
                                                </div>

                                                <div class="form-group  row col-md-6">
                                                  <label for="agama" class="col-sm-12 control-label">Profisaun</label>

                                                  <div class="col-sm-12">
                                                    <select class="form-control" id="profesi" name="profesi" placeholder="Profesi">
                                                    <?php
                                                        $profesi = DB::table('profisaun')->get();
                                                        ?>
                                                        <option>Select Item</option>
                                                        <?php foreach ($profesi as $list) { $dt_option = $list->name; ?>
                                                        <option value="{{ $list->id }}" >
                                                        {{ $dt_option }}
                                                        </option>
                                                        <?php } ?>

                                                    </select>
                                                  </div>
                                                </div>

                                                
                                                <div class="form-group  row col-md-6">
                                                  <label for="universitas" class="col-sm-12 control-label">Esperiancia Servisu</label>

                                                  <div class="col-sm-12">
                                                    <select class="form-control" id="esperiancia" name="esperiancia" placeholder="esperiancia">

                                                        <?php
                                                        $esperiancia_list = DB::table('esperiancia')->get();
                                                        ?>
                                                        <option>Select Item</option>
                                                        <?php foreach ($esperiancia_list as $list) { $dt_option = $list->name; ?>
                                                        <option value="{{ $list->id }}" >
                                                        {{ $dt_option }}
                                                        </option>
                                                        <?php } ?>

                                                  </select>
                                                  </div>
                                                </div>

                                                <div class="form-group  row col-md-12">

                                                  <label for="tahunlulus" class="col-sm-12 control-label">Biografia</label>

                                                  <div class="col-sm-12">
                                                    <textarea rows="5" class="form-control" id="biografia" name="biografia" ></textarea>

                                                  </div>
                                                </div>
                                                <div class="form-group  row col-md-12">

                                                  <label for="tahunlulus" class="col-sm-12 control-label">Observasaun</label>

                                                  <div class="col-sm-12">
                                                    <textarea rows="5" class="form-control" id="observasaun" name="observasaun" ></textarea>

                                                  </div>
                                                </div>
                                              </div>
                                              <!-- /.card-body -->
                                              <!-- /.card-body -->

									</div>
								</div>
							</div>
							</div>

							<div class="col-lg-6">
							<div class='card card-primary '>
								<div class='card-header with-border'>
									<h4 class='card-title'><i class="fas fa-address-book    "></i> IV. Informasi Pendaftaran</h4>
								</div><!-- /.card-header -->

								<div class='card-body'>
									<div>

                                             <div class="row">
                                                <div class="form-group  row col-md-6">
                                                  <label for="agama" class="col-sm-12 control-label">Tanggal Input</label>

                                                  <div class="col-sm-12">
                                                    <input type="text" class="form-control pickadate" id="date5" name="tglinput"  >

                                                  </div>
                                                </div>
                                                <div class="form-group  row col-md-6">
                                                  <label for="agama" class="col-sm-12 control-label">Tanggal Edit</label>

                                                  <div class="col-sm-12">
                                                    <input type="text" class="form-control pickadate" id="date6" name="tgledit"  >

                                                  </div>
                                                </div>
                                                <div class="form-group  row col-md-6">
                                                  <label for="agama" class="col-sm-12 control-label">Opr. Input</label>

                                                  <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="oprinput" name="oprinput" >

                                                  </div>
                                                </div>

                                                <div class="form-group  row col-md-6">
                                                  <label for="agama" class="col-sm-12 control-label">Opr. Edit</label>

                                                  <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="opredit" name="opredit" >

                                                  </div>
                                                </div>


                                                <div class="form-group  row col-md-6">
                                                  <label for="agama" class="col-sm-12 control-label">Distrik Input</label>
                                                  <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="distrikinput" name="distrikinput" >

                                                  </div>
                                                </div>
                                                <div class="form-group  row col-md-6">
                                                  <label for="agama" class="col-sm-12 control-label">Cetak Kartu</label>

                                                  <div class="col-sm-12">
                                                    <select class="form-control" id="cetakkartu" name="cetakkartu"  >

                                                    <option value="1">Cetak Baru</option>
                                                      <option value="2">Cetak Ulang</option>
                                                    </select>
                                                  </div>
                                                </div>
                                              </div>
                                              <!-- /.card-body -->

									</div>
								</div>
							</div>
							</div></div>



						<div>
							<div class='card card-primary'>
								<div class='card-header with-border'>
									<h4 class='card-title'><i class="fas fa-address-book    "></i> Upload Dokumen</h4>

								</div><!-- /.card-header -->

								<div class='card-body'>
									<div>
                                              <div class="card-body">


                                              <div class="row">
                                                                <div class="form-group col-lg-12">
                                                                  <form method="POST" action="storeImage.php">
                                                                      <div class="row">
                                                                          <div class="col-md-12">
                                                                            <label for="exampleInputFile"><b>Photo</b></label>
                                                                          </div><br>
                                                                          <div class="col-md-6 text-center">
                                                                              <div id="results">
                                                                              <div id="my_camera"></div>
                                                                              </div>
                                                                              <br/>
                                                                              <input type=button value="Take Snapshot" onClick="take_snapshot()">
                                                                              <input type="hidden" name="image" class="image-tag">
                                                                          </div>
                                                                          <div class="col-md-6">
                                                                              <div id="results">Your captured image will appear here...</div>
                                                                          </div>
                                                                          <div class="col-md-12 text-center">
                                                                              <!-- <br/>
                                                                              <button class="btn btn-success">Submit</button> -->
                                                                          </div>
                                                                      </div>
                                                                  </form>
                                                                  <input type="file" class="form-control"  name="photo">
                                                                  <br>
                                            					            <div class="col-sm-6"><i>* Upload photo dengan format PNG atau JPG dengan ukuran maksimal 500Kb.</i></div>
                                                                  
                                                                </div>
                                                                <div class="form-group col-lg-12">
                                                                  <hr>
                                                                  <label for="exampleInputFile"><b>Finger</b></label>
                                                                  <input type="file" class="form-control"  name="filefinger">
                                                                  <br>
                                            					  <div class="col-sm-6"><i>* Upload Finger dengan format PNG atau JPG dengan ukuran maksimal 500Kb.</i></div>

                                                                </div>
                                                                </div>
                                                                <div class="row">
                                                                <div class="form-group col-lg-12">
                                                                  <hr>
                                                                  <label for="exampleInputFile"><b>Signature</b></label>
                                                                  <table border="0"><tr><td>
                                                                  <div id="sig"></div>
                                                                  </td></tr></table>
                                                                  <p style="clear: both;">
                                                                    <button id="disable">Disable</button> 
                                                                    <button id="clear">Clear</button> 
                                                                    <?php /*button id="json">To JSON</button>
                                                                    <button id="svg">To SVG</button>*/?>
                                                                  </p>
                                                                  <input type="file" class="form-control" name="filesignature">
                                                                  <br>
                                            					            <div class="col-sm-6"><i>* Upload Signature format PNG atau JPG dengan ukuran maksimal 500Kb.</i></div>

                                                                </div>
                                                                </div>
                                                                <input type='hidden' name='tupload' value='UPLOAD'>

                                              </div>
                                              <!-- /.card-body -->
                                              <div class="card-footer">
                                                <a href="{{url('militantevip/list')}}" class="btn btn-danger">Back to List</a>
                                                <button type="submit" name="btnupload" class="btn btn-success ">SAVE MILITANTE VIP</button>
                                              </div>
									</div>
								</div>
							</div>
						</div>
						</form>
					</div>
</section>
</div>

<script>
$("#date1").flatpickr();
$("#date2").flatpickr();
$("#date3").flatpickr();
$("#tgllahir").flatpickr();
$("#date5").flatpickr();
$("#date6").flatpickr();
$("#date7").flatpickr();
$("#pickadateandtime").flatpickr({enableTime: true,dateFormat: "Y-m-d H:i"});
</script>
<!-- SIGNATUR -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="{{url('app-assets/js/signature/jquery.signature.js')}}"></script>
<script>
$(function() {
	var sig = $('#sig').signature();
	$('#disable').click(function() {
		var disable = $(this).text() === 'Disable';
		$(this).text(disable ? 'Enable' : 'Disable');
		sig.signature(disable ? 'disable' : 'enable');
	});
	$('#clear').click(function() {
		sig.signature('clear');
	});
	$('#json').click(function() {
		alert(sig.signature('toJSON'));
	});
	$('#svg').click(function() {
		alert(sig.signature('toSVG'));
	});
});
</script>

<script>
    var baseUrl = "{{url('militantevip')}}/";

        function call_alert(type, title, content, timer = '') {
            if (timer == '') {
                timer = 3000;
            }
            Swal.fire({
                allowOutsideClick: false,
                icon: type,
                title: title,
                timer: timer,
                text: content,
            }).then(() => {

            });
        }

        function save() {
            var form = $('#form1')[0];
            var formData = new FormData(form);

            //btnLoader(true);

            $.ajax({
                url: baseUrl + 'save',
                dataType: 'json',
                method: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status) {
                            document.getElementById("form1").reset();
                            select_box = document.getElementById("kabupatentim");
                            select_box.selectedIndex = -1;
                            select_box = document.getElementById("kecamatantim");
                            select_box.selectedIndex = -1;
                            select_box = document.getElementById("kelurahantim");
                            select_box.selectedIndex = -1;
                            select_box = document.getElementById("tpstim");
                            select_box.selectedIndex = -1;
                            call_alert('success', 'Success', 'Data saved successfully.');
                    } else {
                        call_alert('error', 'Warning', 'Failed to save data..');
                    }
                },
                error: function() {
                    call_alert('error', 'Warning', 'Failed to save data.');
                }
            });
        }

</script>

<script>

    function nomil(id) {
        var link = "{{url('militantevip/searchno')}}/" + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
          console.log('-');console.log(data);
            //$('#tpstim').html(data);
            //$('#nomilitante').value(data);
            document.getElementById("nomilitante").value=data;
        });
    }


    function kelurahantim(lurah) {
        var id = lurah;
        var link = "{{url('tim/get_kelurahan')}}/" + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#kelurahantim').html(data);
            var value = $(data).val();
            tpstim(value);
        });
    }

    function kecamatantim(lurah) {
        var id = lurah;
        var link = "{{url('tim/get_kecamatan')}}/" + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#kecamatan').html(data);
            kelurahantim(value);
            tpstim(value);
        });
    }

    function tpstim(tps) {
        var id = tps;
        var link = "{{url('tim/get_tps')}}/" + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#tpstim').html(data);
        });
    }

    $('#kabupatentim').on('change',function(e){
        console.log('testytttt ');
        var id = $(this).val();
        var link = '{{url("tim/get_kecamatan")}}/'  + id;
        console.log(link);
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#kecamatantim').html(data);
            var value = $(data).val();
            kelurahantim(value);
            tpstim(value);
            nomil(value);
        });
    });

    $('#kecamatantim').change(function() {
        var id = $(this).val();
        var link = '{{url("tim/get_kelurahan")}}/' + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#kelurahantim').html(data);
            var value = $(data).val();
            tpstim(value);
            nomil(value);
        });
    });

    $('#kelurahantim').change(function() {
        var id = $(this).val();
        var link = '{{url("tim/get_tps")}}/' + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#tpstim').html(data);
            var value = $(data).val();
        });
    });
</script>
<script type="text/javascript">
        $(document).ready(function() {
            $("#number").keypress(function (e) {
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    $('#number-message').addClass('d-block').removeClass('d-none');
                    return false;
                } else {
                    $('#number-message').addClass('d-none').removeClass('d-block');
                }
            });
        });
</script>
<!-- Configure a few settings and attach camera -->
<script language="JavaScript">
    Webcam.set({
        width: 500,
        height: 400,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
  
    Webcam.attach( '#my_camera' );
  
    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
        } );
    }
</script>


<script type="text/javascript">



        window.onload=function(){

            $('#tgllahir').on('change', function() {

                var dob = new Date(this.value);

                var today = new Date();

var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));

                $('#usia').val(age);

            });

        }

          </script>


<script type="text/javascript">



        window.onload=function(){

            $('#thn').on('change', function() {
                var thn=document.getElementById("thn").value;
                var bln=document.getElementById("bln").value;
                var tgl=document.getElementById("tgl").value;

                var valuetgl= thn + '-' + bln + '-' + tgl;
                console.log(valuetgl);
                var dob = new Date(valuetgl);

                var today = new Date();

                var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));

                $('#usia').val(age);

            });
            $('#bln').on('change', function() {
                var thn=document.getElementById("thn").value;
                var bln=document.getElementById("bln").value;
                var tgl=document.getElementById("tgl").value;

                var valuetgl= thn + '-' + bln + '-' + tgl;
                console.log(valuetgl);
                var dob = new Date(valuetgl);

                var today = new Date();

                var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));

                $('#usia').val(age);

            });

            $('#tgl').on('change', function() {
                var thn=document.getElementById("thn").value;
                var bln=document.getElementById("bln").value;
                var tgl=document.getElementById("tgl").value;

                var valuetgl= thn + '-' + bln + '-' + tgl;
                console.log(valuetgl);
                var dob = new Date(valuetgl);

                var today = new Date();

                var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));

                $('#usia').val(age);

            });


        }

          </script>
@endsection
