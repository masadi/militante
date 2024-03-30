@extends('layoututama')
@section('content')

<div class="main-content">
    <section class="section">
        <div><div>
                    <div class="row">
                        <div class="col-12">
                            
							<div class="card flex-fill w-100">
                                <div class="card-body">
                                    <form role="form" action="{{url('kecamatan/excel')}}" method="POST" id="form1" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <input type="hidden" class="form-control" id="_token"  name="_token" value="{{csrf_token()}}">
                                        <div>
                                            <div class="row">
                                                <div class="col-12">
                                                <?php 
                                                    $unitid=Session::get('unitcompany');
                                                    if(!empty($unitid)) {
                                                        $check=DB::table('internal_company')->where('id',$unitid)->first();
                                                        $check_company_shortname=$check->company_shortname;
                                                    } else {
                                                        $check_company_shortname="subsidiary";
                                                    }
                                                               
                                                    // echo "---".$check->company_shortname; ?>
									                <p>Download Xls Template File <a href="{{url('uploadlead/download')}}" class="btn btn-success ml-10" style="margin-left:10px"><i style="top: -1px;position: relative;" class="align-middle" data-feather="download"></i> <img src="{{url('app-assets/img/icons/icone-excel.png')}}"></a></p>
									                <h5 class="mb-1"><b>Upload file</b></h5> 
                                                    <div class="row">
                                                        <div class="mb-2 col-md-6 form-password-toggle">
                                                            <label class="form-label" for="fileuploada">Upload Template</label>
                                                            <input type="file" class="form-control"  accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"   id="fileupload" name="fileupload" required/>
                                                            <!-- <input class="form-control " type="file" id="fileuploada" name="fileuploada" data-error="#fileupload-error" required/> -->
                                                                           
                                                            <div class="error" id="newPassword-error"></div>
                                                        </div>
                                                    </div>
                                                    <label class="custome-upload-file mb-4" for="upload-profitability">
                                                        <div><button type="submit" class="btn btn-primary ml-10"><i style="top: -1px;position: relative;" class="align-middle"></i> Upload</button></div>
                                                    </label>
                                                </div>
                                            </div>
                                    </form>
                                </div>
                                    <!-- /.card-body -->
                                                
                                
                            </div>
                            <br>
							<div class="card flex-fill">                    

                                <div class="card-body">        
                                        {{csrf_field()}}
                                        <input type="hidden" class="form-control" id="_token"  name="_token" value="{{csrf_token()}}">
                                        <?php if($sukses>0 || $gagal>0){?> 
                                        <b class="card-header"><?php echo "Upload Success: $sukses | Failed: $gagal ";?></b>
                                        <?php } ?>
                                        
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
</div>
                                        </section>

</div>
@endsection
