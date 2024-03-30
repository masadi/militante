
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
          
          <li class="active">Pemilih</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
       
       <div class="row">
         <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
            
              <?=$this->session->flashdata('pesan')?> 

               <form action="<?=site_url()?>pemilih/send" id="formsms" name="formsms" class="form-horizontal" enctype="multipart/form-data" novalidate="novalidate" method="POST">
                  <input type="hidden" name="idpemilih" id="idpemilih" value="<?=$getid->idpemilih?>">

                  <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">NAMA</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="namapemilih" placeholder="namapemilih" name="namapemilih" required="" value="<?=$getid->namapemilih?>">
                  </div>
                </div>
               
                
                 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">HP</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="hp" placeholder="hp" name="hp" required="" value="<?=$getid->hp?>">
                  </div>
                </div>



                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">PeSAN </label>
                   <div class="col-sm-10">
                  <textarea class="form-control" placeholder="PESAN" id="pesan" name="pesan" required=""></textarea>
                </div>
                </div>
                 <div class="modal-footer">
               
                <button type="submit" id="btnSave" class="btn btn-primary">Kirim</button>
              </div>
                 <input type="hidden" id="cekhp" name="cekhp"  value="<?=$getid->hp?>">
               </form>
              
            </div>
             <div class="box-body">
             
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
  