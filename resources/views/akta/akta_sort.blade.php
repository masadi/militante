<div class="content-wrapper">
  <section class="content-header">
      <h1>
      
        <small>Grafik Pemilih</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=site_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Grafik Pemilih</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-success">
             <div class="box-header with-border">
             <div class="col-md-6">
<p>Gunakan Form Dibawah Ini untuk menampilkan Grafik</p>


</div>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                 
              </div>
              <!-- /.box-tools -->
            </div>
             <div class="box-body">
 
<form id="account-statement" action="<?=site_url()?>pemilih/actionsort" method="POST">
 <?php
            $option = array();
            $option[''] = 'Pilih Kabupaten';
            foreach ($kabupaten as $kab) {
               
                    $option[$kab->idkabupaten] = $kab->namakabupaten;
                
            }
            ?>


  <div class="form-group">
                 

                  <div class="col-sm-3">
                    <?php echo form_dropdown('kabupaten', $option,'', 'id="kabupaten" class="form-control" required') ?>
                  </div>
                  
                </div>
                 <?php
            $option1 = array();
            $option1[''] = 'Pilih Kecamatan';
            foreach ($kecamatan as $kec) {
               
                    $option1[$kec->idkecamatan] = $kec->namakecamatan;
                
            }
            ?>


  <div class="form-group">
                 

                  <div class="col-sm-3">
                    <?php echo form_dropdown('kecamatan', $option1,'', 'id="kelurahan" class="form-control"required') ?>
                  </div>
                  
                </div>
                 <?php
            $option2 = array();
            $option2[''] = 'Pilih Kelurahan';
            foreach ($kelurahan as $kel) {
               
                    $option2[$kel->idkelurahan] = $kel->namakelurahan;
                
            }
            ?>


  <div class="form-group">
                
                  <div class="col-sm-3">
                    <?php echo form_dropdown('kelurahan', $option2,'', 'id="kelurahan" class="form-control"required') ?>
                  </div>
                  
                </div>
                
                <div class="form-group">
                

                  <div class="col-sm-3">
                   
                  </div>
                  <div class="col-sm-1">
                   <input type="submit" class="btn btn-primary" name="" value="Tampilkan">
                  </div>
                </div>
</form>            </div>
          </div>
        </div>
        
             
        
      </div>
  
    </section>
</div>


