<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kecamatan;
/*use App\Models\Bahan;
use App\Models\Barang;
use App\Models\Hargagrosir;
use App\Models\Barangdetail;*/
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class KecamatanController extends Controller
{
    public function index() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Kecamatan';
            $judulmodul = 'Kecamatan';
            $kecamatan = new Kecamatan();
            $query = $kecamatan->orderBy('idkecamatan','DESC')->get();
            return view('kecamatan/kecamatan_index',compact('query','judulmodul','judulhalaman'));
        }
    }

    public function upload() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Kecamatan';
            $judulmodul = 'Kecamatan';
            $kabupaten = new Kecamatan();
            $sukses=0;$gagal=0;
            //$query = $kabupaten->orderBy('idkabupaten','DESC')->get();
            return view('kecamatan/kecamatan_upload',compact('judulmodul','judulhalaman','sukses','gagal'));
        }
    }
    
    public function excel(Request $request)
	{
        //if(!Session::get('userid')){
        //    redirect('/');
        //} else {
            $judulhalaman = 'Upload Sheet';
            $judulmodul = 'Upload Sheet';
            $stat=1;

            
            $fileupload = $request->fileupload;
            //$subs = $request->subs;
            //$periode = $request->periode;
            
            if(!empty($fileupload)){
                
                $dttime=date('ymdHis');
                if(!empty($subs)){
                    $new_name = $subs.'_lop_'.$dttime.'.xlsx';
                } else {
                    $new_name = 'subsidiary_lop_'.$dttime.'.xlsx';
                }
                //echo $new_name;
                $fileupload->move('data/',$new_name);

                //$data = DB::table('upload_file')->where('user_company',Session::get('userid'))->delete();

                //Memanggil class dari PhpSpreadsheet dengan namespace
                
                $spreadsheet = new Spreadsheet();
                $inputFileType="Xlsx";
                $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
                $spreadsheet = $reader->load('data/'.$new_name);

                
                $sheetData = $spreadsheet->getActiveSheet()->toArray();

                $sukses = $gagal = 0;
                //if(!empty($sheetData[1]['8'])) {
                    for ($i = 1; $i < count($sheetData); $i++) {
                        $kode_subdistrict=$sheetData[$i]['0'];
                        $nama_subdistrict=$sheetData[$i]['1'];

                        //if(!empty($business_model)) {

                            //$exec = mysqli_query($koneksi, "INSERT INTO calon (username,password,nama,nisn,jenis_kelamin,tempat_lahir,tanggal_lahir,smpasal,tanggaldaftar)VALUES('$username','$password','$nama','$nis','$jeniskelamin','$tempat','$tanggallahir','$asal','$tgldaftar')");
                            //($exec) ? $sukses++ : $gagal++;
                            $exec = DB::table('kecamatan')->insert([
                                
                                'kode_subdistrict' => $kode_subdistrict,
                                'nama_subdistrict' => $nama_subdistrict,
                                
                                'kabupaten' => substr($kode_subdistrict,0,2),
                                'urut_subdistrict' => substr($kode_subdistrict,2,2)
                            ]);
                            ($exec) ? $sukses++ : $gagal++;
                        //}
                    }
                //}
                    echo "SUKSES : ".$sukses." - GAGAL : ".$gagal;
                //return view('upload/upload_index',compact('judulhalaman','sukses','gagal','new_name','stat'));
            } else {
                //echo json_encode(array("status" => FALSE));
                echo "SUKSES : ".$sukses." - GAGAL : ".$gagal;
            }
        //}
    }

    public function ajax_list()
    {
        $kecamatan = new Kecamatan();
        $query = $kecamatan->orderBy('idkecamatan','DESC')->get();
        $data = array();
        $no = 0;
        foreach ($query as $kecamatan) {
            $no++;
            $row = array();
            $row[] = $kecamatan->kabupaten;
            $row[] = $kecamatan->kode_subdistrict;

            $row[] = $kecamatan->nama_subdistrict;
            $row[] = $kecamatan->urut_subdistrict;
            $row[] = $kecamatan->user;

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_kecamatan(' . "'" . $kecamatan->idkecamatan . "'" . ')"><i class="fa fa-edit"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_kecamatan(' . "'" . $kecamatan->idkecamatan . "'" . ')"><i class="fa fa-trash"></i> Delete</a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => 0,
            "recordsTotal" => $no,
            "recordsFiltered" => $no,
            "data" => $data,
        );
        //output to json formatm
        echo json_encode($output);
    }
    public function ajax_edit($idkecamatan)
    {
        //$data = $this->Kecamatan_m->get_by_id($idkecamatan);
        //echo json_encode($data);
        $kecamatan = new Kecamatan();
        $data = $kecamatan->find($idkecamatan);

        echo json_encode($data);
    }
    public function ajax_add(Request $request)
    {

        /*$id = $this->session->userdata('nama');
        $data = array(
            'nama_subdistrict'        => $this->input->post('nama_subdistrict'),
            'kabupaten'            => $this->input->post('kabupaten'),
            'kode_subdistrict'            => $this->input->post('kode_subdistrict'),
            'urut_subdistrict'          => $this->input->post('urut_subdistrict'),
            'user' => $id
        );
        $insert = $this->Kecamatan_m->save($data);
        echo json_encode(array("status" => TRUE));*/


            $nama_subdistrict = $request->nama_subdistrict;
            $kabupaten = $request->kabupaten;
            $kode_subdistrict = $request->kode_subdistrict;
            $urut_subdistrict = $request->urut_subdistrict;

            $kecamatan = new Kecamatan();
            $kecamatan->nama_subdistrict = $nama_subdistrict;
            $kecamatan->kabupaten = $kabupaten;
            $kecamatan->kode_subdistrict = $kode_subdistrict;
            $kecamatan->urut_subdistrict = $urut_subdistrict;
            $kecamatan->user = Session::get('nama');
            $kecamatan->save();

            echo json_encode(array("status" => TRUE));
    }
    public function ajax_update(Request $request)
    {
        /*$id = $this->session->userdata('nama');
        $data = array(
            'nama_subdistrict'        => $this->input->post('nama_subdistrict'),
            'kabupaten'         => $this->input->post('kabupaten'),
            'kode_subdistrict'          => $this->input->post('kode_subdistrict'),
            'urut_subdistrict'          => $this->input->post('urut_subdistrict'),
            'user' => $id
        );
        $this->Kecamatan_m->update(array('idkecamatan' => $this->input->post('idkecamatan')), $data);
        echo json_encode(array("status" => TRUE));*/

            $nama_subdistrict = $request->nama_subdistrict;
            $kabupaten = $request->kabupaten;
            $kode_subdistrict = $request->kode_subdistrict;
            $urut_subdistrict = $request->urut_subdistrict;

            $kecamatanku = new Kecamatan();
            $kecamatan=$kecamatanku->find($request->idkecamatan);
            $kecamatan->nama_subdistrict = $nama_subdistrict;
            $kecamatan->kabupaten = $kabupaten;
            $kecamatan->kode_subdistrict = $kode_subdistrict;
            $kecamatan->urut_subdistrict = $urut_subdistrict;
            $kecamatan->user = Session::get('nama');
            $kecamatan->save();

            echo json_encode(array("status" => TRUE));
    }
    public function ajax_delete($idkecamatan)
    {
        //$this->Kecamatan_m->delete_by_id($idkecamatan);
        //echo json_encode(array("status" => TRUE));
        $kecamatanku = new Kecamatan();
        $kecamatan = $kecamatanku->find($idkecamatan);
        $kecamatan->delete();
        echo json_encode(array("status" => TRUE));
    }

    public function get_subcategories_ajax1($id)
    {
        $sub_cat = $this->Kecamatan_m->get_subcategories_by_cat_idx($id);
        $str = '';
        $str .= '<option value="#">#</option>';
        foreach ($sub_cat as $value) {

            $str .= '<option value="' . $value->idkecamatan . '">' . $value->nama_subdistrict . '</option>';
        }

        echo $str;
    }

    public function import()
    {
        if ($this->session->userdata('logged_in') == TRUE) {
            if ($this->session->userdata('level') == 'admin') {
                $this->data['daerah'] = 'active';
                $this->data['notifikasi'] = '';
                $this->data['koordinator'] = '';
                $this->data['calon'] = '';
                $this->data['relawan'] = '';
                $this->data['pemilih'] = '';
                $this->data['pengaturan'] = '';
                $this->data['saksi'] = '';
                $this->data['quick'] = '';
                $this->data['kegiatancalon'] = '';
                $this->data['target'] = '';
                $this->data['dpt'] = '';
                $this->data['isu'] = '';
                $this->data['tim'] = '';
                $this->data['pengguna'] = '';
                $this->data['event'] = '';
                $this->data['hitung'] = '';
                $this->data['sms'] = '';
                $this->data['biaya'] = '';
                $this->data['kp'] = '';
                $this->data['tr'] = '';
                $this->data['listpengaturan'] = $this->Pengaturan_m->tampil();
                $this->data['keluarga'] = '';
                $this->data['analisa'] = '';
                $this->data['halaman'] = 'vimport';

                $this->data['listkabupaten'] = $this->Kabupaten_m->ambilkabupaten();
                $this->load->view('_main', $this->data);
            } else {
                echo "anda bukan admin";
            }
        } else {
            redirect('login', 'refresh');
        }
    }
    public function saveimport()
    {
        if ($this->session->userdata('logged_in') == TRUE) {

            if ($this->session->userdata('level') == 'admin') {
                /////////////////////////

                if (isset($_FILES["file"]["name"])) {
                    $path = $_FILES["file"]["tmp_name"];
                    $object = PHPExcel_IOFactory::load($path);
                    foreach ($object->getWorksheetIterator() as $worksheet) {
                        $highestRow = $worksheet->getHighestRow();
                        $highestColumn = $worksheet->getHighestColumn();
                        for ($row = 2; $row <= $highestRow; $row++) {
                            $idkecamatan = '';
                            $namakecamatan = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                            $deskripsikecamatan = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                            $kabupaten = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                            $provinsi = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                            $data[] = array(

                                'idkecamatan'            => $idkecamatan,
                                'namakecamatan'      =>  $namakecamatan,
                                'deskripsikecamatan'         =>  $deskripsikecamatan,
                                'kabupaten'         =>  $kabupaten
                            );
                        }
                    }
                    $this->Kecamatan_m->insertimport($data);
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Data Berhasil Di Import</h4>
               Data berhasil di Import
            </div>');
                    redirect('kecamatan', 'refresh');
                }

                /////////////////////
            } else {
                echo "anda bukan admin";
            }
        } else {
            redirect('login', 'refresh');
        }
    }
//end of class
}
