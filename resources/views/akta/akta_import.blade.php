  <div class="main-content">
      <section class="section">
          <div class="section-header">
              <h1>Import DPT</h1>
          </div>
          <div class="row">
              <div class="col-3">
                  <div class="box">
                      <div class="box-body">
                          <form method="post" action="<?= site_url() ?>dpt/saveimport" class="form-horizontal" enctype="multipart/form-data">
                              <div class="form-group">
                                  <label for="inputEmail3" class="col-sm-2 control-label">Lampirkan File</label>
                                  <div class="col-sm-12">

                                      <input type="file" name="file" class="form-control" id="file" required accept=".xls, .xlsx" /></p>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <div class="col-sm-12">
                                      <input type="submit" class="btn btn-block btn-warning" value="Import" name="import">
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>

              <div class="col-12">
                  <div class="card">
                      <div class="card-body">
                          <div class="table-responsive">
                              <p>
                                  ketentuan:<br>
                                  Download contoh File :<a href="<?= site_url() ?>contohdpt.xls">Disini</a> <br>

                              <table id="tabledpt" class="table table-striped">
                                  <thead>
                                      <tr>
                                          <th style="width:10%"> ID PROVINSI</th>
                                          <th style="width:15%">NAMA PROVINSI</th>
                                          <th style="width:10%">ID KABUPATEN</th>
                                          <th style="width:15%">NAMA KABUPATEN</th>
                                          <th style="width:10%">ID KECAMATAN</th>
                                          <th style="width:15%">NAMA KECAMATAN</th>
                                          <th style="width:10%">ID KELURAHAN</th>
                                          <th>NAMA KELURAHAN</th>
                                          <th style="width:10%">ID TPS</th>
                                          <th>NAMA TPS</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php foreach ($listkabupaten as $nama) { ?>
                                          <tr>

                                              <td style="width:10%"><b><?= $nama->idprovinsi ?></b></td>
                                              <td><?= $nama->namaprovinsi ?></td>
                                              <td style="width:10%"><b><?= $nama->idkabupaten ?></b></td>
                                              <td><?= $nama->namakabupaten ?></td>
                                              <td style="width:10%"><?= $nama->idkecamatan ?></td>
                                              <td><?= $nama->namakecamatan ?></td>
                                              <td style="width:10%"><?= $nama->idkelurahan ?></td>
                                              <td><?= $nama->namakelurahan ?></td>
                                              <td style="width:10%"><?= $nama->idtps ?></td>
                                              <td><?= $nama->namatps ?></td>
                                          </tr>
                                      <?php } ?>
                                  </tbody>
                              </table>


                              </p>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

          <!-- /.box -->
      </section>
      <!-- /.content -->

      <!-- /.container -->
  </div>
  <script>
      $(document).ready(function() {
          $("#tabledpt").dataTable();
      })
  </script>