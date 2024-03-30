
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          KampanyeAPP
          <small>V 1.0</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?=site_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
          
          <li class="active">Daerah</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
       
       <div class="row">
         <div class="col-md-6">
          <div class="box">
        
             <div class="box-body">
            <form method="post" action="<?=site_url()?>kecamatan/saveimport" class="form-horizontal" enctype="multipart/form-data">  
             
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

          <div class="col-md-6">
          <div class="box">
        
             <div class="box-body">
              
             <p>
               ketentuan:<br>
               Download contoh File :<a href="<?=site_url()?>contohx.xls">Disini</a>
             </p>
             </div>
          </div>
         </div>
       </div>
       
        <!-- /.box -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
 