<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kabupaten;
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

class KabupatenController extends Controller
{
    public function index() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Kabupaten';
            $judulmodul = 'Kabupaten';
            $kabupaten = new Kabupaten();
            $query = $kabupaten->orderBy('idkabupaten','DESC')->get();
            return view('kabupaten/kabupaten_index',compact('query','judulmodul','judulhalaman'));
        }
    }

    public function upload() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Kabupaten';
            $judulmodul = 'Kabupaten';
            $kabupaten = new Kabupaten();
            $sukses=0;$gagal=0;
            //$query = $kabupaten->orderBy('idkabupaten','DESC')->get();
            return view('kabupaten/kabupaten_upload',compact('judulmodul','judulhalaman','sukses','gagal'));
        }
    }

    public function ajax_list()
    {
        $kabupaten = new Kabupaten();
        $query = $kabupaten->orderBy('idkabupaten','DESC')->get();
        $data = array();
        $no = 0;
        foreach ($query as $kabupaten) {
            $no++;
            $row = array();
            $row[] = $kabupaten->kelompok_district;
            $row[] = $kabupaten->kode_district;
            $row[] = $kabupaten->nama_district;
            $row[] = $kabupaten->urut_district;
            $row[] = $kabupaten->user;
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_kabupaten(' . "'" . $kabupaten->idkabupaten . "'" . ')"><i class="fa fa-edit"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_kabupaten(' . "'" . $kabupaten->idkabupaten . "'" . ')"><i class="fa fa-trash"></i> Delete</a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => 1,
            "recordsTotal" => $no,
            "recordsFiltered" => $no,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function ajax_edit($idkabupaten)
    {
        //$data = $this->Kabupaten_m->get_by_id($idkabupaten);
        //echo json_encode($data);
        $kabupaten = new Kabupaten();
        $data = $kabupaten->find($idkabupaten);

        echo json_encode($data);
    }
    public function ajax_add(Request $request)
    {

        /*$id = $this->session->userdata('nama');
        $data = array(
            'kelompok_district' => $this->input->post('kelompok_district'),
            'kode_district' => $this->input->post('kode_district'),
            'nama_district' => $this->input->post('nama_district'),
            'urut_district' => $this->input->post('urut_district'),
            'user' => $id,
        );
        $insert = $this->Kabupaten_m->save($data);
        echo json_encode(array("status" => TRUE));*/

            $kelompok_district = $request->kelompok_district;
            $kode_district = $request->kode_district;
            $nama_district = $request->nama_district;
            $urut_district = $request->urut_district;

            $kabupaten = new Kabupaten();
            $kabupaten->kelompok_district = $kelompok_district;
            $kabupaten->kode_district = $kode_district;
            $kabupaten->nama_district = $nama_district;
            $kabupaten->urut_district = $urut_district;
            $kabupaten->user = Session::get('nama');
            $kabupaten->save();

            echo json_encode(array("status" => TRUE));
    }
    public function ajax_update(Request $request)
    {
        /*$id = $this->session->userdata('nama');
        $data = array(
            'kelompok_district' => $this->input->post('kelompok_district'),
            'kode_district' => $this->input->post('kode_district'),
            'nama_district' => $this->input->post('nama_district'),
            'urut_district' => $this->input->post('urut_district'),
            'user' => $id,
        );
        $this->Kabupaten_m->update(array('idkabupaten' => $this->input->post('idkabupaten')), $data);
        echo json_encode(array("status" => TRUE));*/

            $kelompok_district = $request->kelompok_district;
            $kode_district = $request->kode_district;
            $nama_district = $request->nama_district;
            $dimm = $request->cakep;

            $kabupatenku = new Kabupaten();
            $kabupaten=$kabupatenku->find($request->idkabupaten);
            $kabupaten->kelompok_district = $kelompok_district;
            $kabupaten->kode_district = $kode_district;
            $kabupaten->nama_district = $nama_district;
            $kabupaten->user = Session::get('nama');
            $kabupaten->save();
        echo json_encode(array("status" => TRUE));
    }
    public function ajax_delete($idkabupaten)
    {
        //$this->Kabupaten_m->delete_by_id($idkabupaten);
        //echo json_encode(array("status" => TRUE));
        //delete file
        $kabupatenx = new Kabupaten();
        $kabupaten = $kabupatenx->find($idkabupaten);
        $kabupaten->delete();
        echo json_encode(array("status" => TRUE));
    }

    public function get_subcategories_ajax1($id)
    {
        $sub_cat = $this->Kelurahan_m->get_subcategories_by_cat_id($id);
        $str = '';
        $str .= '<option value="#">#</option>';
        foreach ($sub_cat as $value) {
            $str .= '<option value="' . $value->idtps . '">' . $value->nama_aldeia . '</option>';
        }

        echo $str;
    }
    public function get_subcategories_ajax2($id)
    {
        $sub_cat = $this->Kelurahan_m->get_subcategories_by_cat_id($id);
        $str = '';
        $str .= '<option value="#">#</option>';
        foreach ($sub_cat as $value) {
            $str .= '<option value="' . $value->idtps . '">' . $value->nama_aldeia . '</option>';
        }

        echo $str;
    }

    public function import()
    {
        if ($this->session->userdata('logged_in') == TRUE) {
            if ($this->session->userdata('level') == 'admin') {
                $this->data['daerah'] = 'active';
                $this->data['notifikasi'] = '';
                $this->data['quick'] = '';
                $this->data['koordinator'] = '';
                $this->data['calon'] = '';
                $this->data['dpt'] = '';
                $this->data['kegiatancalon'] = '';
                $this->data['relawan'] = '';
                $this->data['pemilih'] = '';
                $this->data['saksi'] = '';
                $this->data['isu'] = '';
                $this->data['target'] = '';
                $this->data['kp'] = '';
                $this->data['tr'] = '';
                $this->data['pengaturan'] = '';
                $this->data['keluarga'] = '';
                $this->data['tim'] = '';
                $this->data['pengguna'] = '';
                $this->data['listpengaturan'] = $this->Pengaturan_m->tampil();
                $this->data['event'] = '';
                $this->data['hitung'] = '';
                $this->data['sms'] = '';
                $this->data['biaya'] = '';
                $this->data['analisa'] = '';
                $this->data['halaman'] = 'vimport';
                //$this->data['daerahlist']=$this->Daerah_m->tampil();
                //   $this->data['listprovinsi']=$this->Provinsi_m->getallkecamatan();
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
                            $idkabupaten = '';
                            $namakabupaten = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                            $provinsi = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                            $deskripsikabupaten = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                            $data[] = array(

                                'idkabupaten'            => $idkabupaten,
                                'namakabupaten'      =>  $namakabupaten,
                                //  'provinsi'         =>  $provinsi,
                                'deskripsikabupaten'         =>  $deskripsikabupaten
                            );
                        }
                    }
                    $this->Kabupaten_m->insertimport($data);
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Data Berhasil Di Import</h4>
               Data berhasil di Import
            </div>');
                    redirect('kabupaten', 'refresh');
                }

                /////////////////////
            } else {
                echo "anda bukan admin";
            }
        } else {
            redirect('login', 'refresh');
        }
    }
    public function get_subcategories_ajax($id = '')
    {
        $sub_cat = $this->Kabupaten_m->get_subcategories_by_cat_idx($id);
        $str = '';
        $str .= '<option value="#">Pilih Sub District</option>';
        foreach ($sub_cat as $value) {
            $str .= '<option value="' . $value->idkecamatan . '">' . $value->nama_subdistrict . '</option>';
        }

        echo $str;
    }

    public function excelmunicipio(Request $request)
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
                        $kode_district=$sheetData[$i]['0'];
                        $nama_district=$sheetData[$i]['1'];
                        $kelompok_district=$sheetData[$i]['2'];
                        $urut_district=$sheetData[$i]['3'];
                        $urut_no_distrik=$sheetData[$i]['4'];
                        $kode_umakain=$sheetData[$i]['5'];

                        //if(!empty($business_model)) {

                            //$exec = mysqli_query($koneksi, "INSERT INTO calon (username,password,nama,nisn,jenis_kelamin,tempat_lahir,tanggal_lahir,smpasal,tanggaldaftar)VALUES('$username','$password','$nama','$nis','$jeniskelamin','$tempat','$tanggallahir','$asal','$tgldaftar')");
                            //($exec) ? $sukses++ : $gagal++;
                            $exec = DB::table('kabupaten')->insert([
                                
                                'kode_district' => $kode_district,
                                'nama_district' => $nama_district,
                                'kelompok_district' => $kelompok_district,
                                'urut_district' => $urut_district,
                                'urut_no_distrik' => $urut_no_distrik,
                                'kode_umakain' => $kode_umakain
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
//end of class
}
