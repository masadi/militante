
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
          
          <li class="active">Category Biaya</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
       
       <div class="row">
         <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
             <button type="button" class="btn btn-block btn-primary" data-toggle="modal" onclick="tambah_category()"> <i class="fa fa-fw fa-plus-circle"></i> Tambah Category </button>
              <?=$this->session->flashdata('pesan')?> 


              
            </div>
             <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Category</th>
                  <th>Deskripsi</th>
                  <th>Aksi</th>
                  
                </tr>
                </thead>
                <tbody>
                  <?php $no=1; ?>
                    <?php foreach($categorylist as $list): ?>
                  <tr>
                    <td><?=$no++?></td>
                            <td><?=$list->nama_category?></td>
                            <td><?=$list->deskripsi_category?></td>
                            <td>
                            <button class="btn btn-primary" onclick="edit_category(<?=$list->id_category;?>)"><i class="fa fa-fw fa-edit"></i>Edit</button>
                            <button class="btn btn-danger" onclick="delete_category(<?=$list->id_category;?>)">
                            <i class="fa fa-fw fa-trash-o"></i> Hapus
                            </button>
                          </td>
                  </tr>
                   <?php endforeach; ?>   
                </tbody>
               
              </table>
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
  <script type="text/javascript">
    var save_method; //for save method string
      var table;
      function tambah_category()
        {
          save_method = 'add';
          $('#form')[0].reset(); // reset form on modals
          $('#modal-category').modal('show'); // show bootstrap modal
          $('.modal-title').text('Tambah Category '); // Set Title to Bootstrap modal title
        }
         $(document).ready(function(){
          $("#form").validate({
            rules:{
              
              nama_category:{required:true},
              deskripsi_category:{required:true}
            }
           });

      });
         function save()
        {   
          var form = $("#form");
          var url;
          if (!form.valid())
            {
              document.getElementById('form').focus();
            }
            else{
              if (save_method == 'add') {
                url="<?=site_url('biaya/savecategory')?>";
              }else{
                url="<?=site_url('biaya/updateactioncategory')?>";
              }
            $.ajax({
              url:url,
              type:"POST",
              data:$('#form').serialize(),
              dataType:"JSON",
              success:function(data)
                {
                  $('#modal-category').modal('hide');
                  location.reload();
                },
              error:function ()
                {
                  alert('Terdapat Kesalahan');
                }
            }); 
        }}
        function edit_category(id_category)
         {
            save_method='update';
            $('#form')[0].reset();
            $.ajax
            ({
                url:"<?=site_url('biaya/updatecategory')?>/"+id_category,
                type:"GET",
                dataType:"JSON",
                success:function(data)
                {
                  $('[name="id_category"]').val(data.id_category);
                  $('[name="nama_category"]').val(data.nama_category);
                  $('[name="deskripsi_category"]').val(data.deskripsi_category);
                  $('#modal-category').modal('show');
                  $('.modal-title').text('Edit Category');
                },
                error:function(jqXHR, textStatus, errorThrown)
                {
                  alert('Gagal dalam pengambilan data');
                }
            });
         }
         function delete_category(id_category)
         {
            if (confirm('Anda Yakin Menghapus Category ini?')) 
            {
              $.ajax
              ({
                url:"<?=site_url('biaya/deletecategory')?>/"+id_category,
                type:"POST",
                dataType:"JSON",
                success :function(data)
                {
                  location.reload();
                },
                error:function(jqXHR, textStatus, errorThrown)
                {
                  alert('Terdapat Kesalahan Dalam Menghapus Data');
                }
              });
            }
         }
  </script>
 <div class="modal fade" id="modal-category">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data Daerah</h4>
              </div>
              <div class="modal-body">
               <form action="#" id="form" name="form" class="form-horizontal" enctype="multipart/form-data" novalidate="novalidate">
                  <input type="hidden" name="id_category" id="id_category" value="">

                  <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Category</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama_category" placeholder="Nama Category" name="nama_category" required="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Deskripsi Category</label>
                   <div class="col-sm-10">
                  <textarea class="form-control" placeholder="Deskripsi Category" id="deskripsi_category" name="deskripsi_category" required=""></textarea>
                </div>
                </div>

               </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>