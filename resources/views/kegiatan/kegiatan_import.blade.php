
  <!-- Full Width Column -->
  <div class="content-wrapper">
   
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
         
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?=site_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
          
          <li class="active">Pemilih</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
       
       <div class="row">
         <div class="col-md-2">
          <div class="box">
        
             <div class="box-body">
            <form method="post" action="<?=site_url()?>pemilih/saveimport" class="form-horizontal" enctype="multipart/form-data">  
             
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Lampirkan File</label>
                   <div class="col-sm-10">
                 
                  <input type="file" name="file" class="form-control" id="file" required accept=".xls, .xlsx" /></p>
                </div>
                </div>
                  <div class="form-group">
                 
                   <div class="col-sm-10">
                  <input type="submit" class="btn btn-block btn-warning" value="Import" name="import">
                </div>
                </div>
             </form>
             </div>
          </div>
         </div>

          <div class="col-md-10">
          <div class="box">
        
             <div class="box-body">
              
          <p>
               ketentuan:<br>
               Download contoh File :<a href="<?=site_url()?>contohpemilih.xls">Disini</a> <br>
              
               
                <table id="example6" class="display" >
                <thead>
                  <tr>
                    <td style="width:10%"> ID PROVINSI</td>
                    <td style="width:15%">NAMA PROVINSI</td>
                    <td style="width:10%">ID KABUPATEN</td>
                    <td style="width:15%">NAMA KABUPATEN</td>
                    <td style="width:10%">ID KECAMATAN</td>
                    <td style="width:15%">NAMA KECAMATAN</td>
                    <td style="width:10%">ID KELURAHAN</td>
                    <td >NAMA KELURAHAN</td>
                  </tr>
                </thead>
                <tbody>
                   <?php foreach ( $listkabupaten as $nama ){?>
                  <tr>
                   
                      <td style="width:10%"><b><?=$nama->idprovinsi?></b></td>
                      <td><?=$nama->namaprovinsi?></td>
                      <td style="width:10%"><b><?=$nama->idkabupaten?></b></td>
                      <td><?=$nama->namakabupaten?></td>
                      <td style="width:10%"><?=$nama->idkecamatan?></td>
                      <td><?=$nama->namakecamatan?></td>
                      <td style="width:10%"><?=$nama->idkelurahan?></td>
                      <td><?=$nama->namakelurahan?></td>
                    
                  </tr>
                  <?php } ?>
                  </tbody>
                </table>  
       
               
             </p>
             </div>
          </div>
         </div>
       </div>
       
        <!-- /.box -->
      </section>
      <!-- /.content -->

    <!-- /.container -->
  </div>
 