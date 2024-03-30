<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelurahan;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class KelurahanController extends Controller
{
    public function index() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Kelurahan';
            $judulmodul = 'Kelurahan';
            $kelurahan = new Kelurahan();
            $query = $kelurahan->orderBy('idkelurahan','DESC')->get();
            return view('kelurahan/kelurahan_index',compact('query','judulmodul','judulhalaman'));
        }
    }


    public function upload() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Kelurahan';
            $judulmodul = 'Kelurahan';
            //$kabupaten = new Kecamatan();
            $sukses=0;$gagal=0;
            //$query = $kabupaten->orderBy('idkabupaten','DESC')->get();
            return view('kelurahan/kelurahan_upload',compact('judulmodul','judulhalaman','sukses','gagal'));
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
                        $kode=$sheetData[$i]['0'];
                        $nama=$sheetData[$i]['1'];

                        //if(!empty($business_model)) {

                            //$exec = mysqli_query($koneksi, "INSERT INTO calon (username,password,nama,nisn,jenis_kelamin,tempat_lahir,tanggal_lahir,smpasal,tanggaldaftar)VALUES('$username','$password','$nama','$nis','$jeniskelamin','$tempat','$tanggallahir','$asal','$tgldaftar')");
                            //($exec) ? $sukses++ : $gagal++;
                            $exec = DB::table('kelurahan')->insert([
                                
                                'kode_suco' => $kode,
                                'nama_suco' => $nama,
                                
                                'kabupaten' => substr($kode,0,2),
                                'kecamatan' => substr($kode,0,4),
                                'urut_suco' => substr($kode,4,2)
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
        $kelurahan = new Kelurahan();
        $query = $kelurahan->orderBy('idkelurahan','DESC')->get();
        $data = array();
        $no = 0;
        foreach ($query as $kelurahan) {
            $no++;
            $row = array();
            $row[] = $kelurahan->kabupaten;
            $row[] = $kelurahan->kecamatan;
            $row[] = $kelurahan->kode_suco;
            $row[] = $kelurahan->nama_suco;
            $row[] = $kelurahan->urut_suco;
            $row[] = $kelurahan->user;

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_kelurahan(' . "'" . $kelurahan->idkelurahan . "'" . ')"><i class="fa fa-edit"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_kelurahan(' . "'" . $kelurahan->idkelurahan . "'" . ')"><i class="fa fa-trash"></i> Delete</a>';

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
    public function ajax_edit($idkelurahan)
    {
        //$data = $this->Kelurahan_m->get_by_id($idkelurahan);
        //echo json_encode($data);
        $kelurahan = new Kelurahan();
        $data = $kelurahan->find($idkelurahan);
        $data->delete();

        echo json_encode(array("status" => TRUE));
    }
    public function ajax_add(Request $request)
    {

        /*$id = $this->session->userdata('nama');
        $data = array(
            'kabupaten'        => $this->input->post('kabupaten'),
            'kecamatan'            => $this->input->post('kecamatan'),
            'kode_suco'            => $this->input->post('kode_suco'),
            'nama_suco'            => $this->input->post('nama_suco'),
            'urut_suco'         => $this->input->post('urut_suco'),
            'user' => $id
        );
        $insert = $this->Kelurahan_m->save($data);
        echo json_encode(array("status" => TRUE));*/

            $kabupaten = $request->kabupaten;
            $kecamatan = $request->kecamatan;
            $kode_suco = $request->kode_suco;
            $nama_suco = $request->nama_suco;
            $urut_suco = $request->urut_suco;

            $kelurahan = new Kelurahan();
            $kelurahan->kabupaten = $kabupaten;
            $kelurahan->kecamatan = $kecamatan;
            $kelurahan->kode_suco = $kode_suco;
            $kelurahan->nama_suco = $nama_suco;
            $kelurahan->urut_suco = $urut_suco;
            $kelurahan->user = Session::get('nama');
            $kelurahan->save();

            echo json_encode(array("status" => TRUE));

    }
    public function ajax_update(Request $request)
    {
        /*$id = $this->session->userdata('nama');
        $data = array(
            'kabupaten'       => $this->input->post('kabupaten'),
            'kecamatan'         => $this->input->post('kecamatan'),
            'kode_suco'         => $this->input->post('kode_suco'),
            'nama_suco'         => $this->input->post('nama_suco'),
            'urut_suco'         => $this->input->post('urut_suco'),
            'user' => $id
        );
        $this->Kelurahan_m->update(array('idkelurahan' => $this->input->post('idkelurahan')), $data);
        echo json_encode(array("status" => TRUE));*/

            $kabupaten = $request->kabupaten;
            $kecamatan = $request->kecamatan;
            $kode_suco = $request->kode_suco;
            $nama_suco = $request->nama_suco;
            $urut_suco = $request->urut_suco;

            $kelurahanku = new Kelurahan();
            $kelurahan=$kelurahanku->find($request->idkelurahan);
            $kelurahan->kabupaten = $kabupaten;
            $kelurahan->kecamatan = $kecamatan;
            $kelurahan->kode_suco = $kode_suco;
            $kelurahan->nama_suco = $nama_suco;
            $kelurahan->urut_suco = $urut_suco;
            $kelurahan->user = Session::get('nama');
            $kelurahan->save();

            echo json_encode(array("status" => TRUE));

    }
    public function ajax_delete($idkelurahan)
    {
        //$this->Kelurahan_m->delete_by_id($idkelurahan);
        //echo json_encode(array("status" => TRUE));

        $kelurahanku = new Kelurahan();
        $kelurahan = $kelurahanku->find($idkelurahan);
        $kelurahan->delete();
        echo json_encode(array("status" => TRUE));
    }
    public function get_subcategories_ajaxge($id)
    {
        $sub_cat = $this->Kelurahan_m->get_subcategories_by_cat_idxyz($id);
        $str = '';
        // $str .= '<option value="#">#</option>';
        foreach ($sub_cat as $value) {

            $str .= '<option value="' . $value->kode_suco . '">' . $value->kode_suco . ' | ' . $value->nama_suco . '</option>';
        }

        echo $str;
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
    public function get_subcategories_ajaxsuco($id)
    {
        $sub_cat = $this->Kelurahan_m->get_subcategories_by_cat_idxyz($id);
        $str = '';
        $str .= '<option value="#">#</option>';
        foreach ($sub_cat as $value) {
            $str .= '<option value="' . $value->idkelurahan . '">' . $value->nama_suco . '</option>';
        }

        echo $str;
    }
    public function get_subcategories_ajax2($id)
    {
        $sub_cat = $this->Kelurahan_m->get_subcategories_by_cat_id($id);
        $str = '';
        $str .= '<option value="#">#</option>';
        foreach ($sub_cat as $value) {
            $str .= '<option value="' . $value->idtps . '">' . $value->namatps . '</option>';
        }

        echo $str;
    }
    public function get_subcategories_ajaxxc($id)
    {
        $sub_cat = $this->Kelurahan_m->get_subcategories_by_cat_idx($id);
        $str = '';
        $str .= '<option value="#">#</option>';
        foreach ($sub_cat as $value) {
            $str .= '<option value="' . $value->idkelurahan . '">' . $value->nama_suco . '</option>';
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
                $this->data['kp'] = '';
                $this->data['tr'] = '';
                $this->data['keluarga'] = '';
                $this->data['relawan'] = '';
                $this->data['pemilih'] = '';
                $this->data['quick'] = '';
                $this->data['dpt'] = '';
                $this->data['saksi'] = '';
                $this->data['tim'] = '';
                $this->data['kegiatancalon'] = '';
                $this->data['pengguna'] = '';
                $this->data['listpengaturan'] = $this->Pengaturan_m->tampil();
                $this->data['isu'] = '';
                $this->data['event'] = '';
                $this->data['hitung'] = '';
                $this->data['pengaturan'] = '';
                $this->data['sms'] = '';
                $this->data['target'] = '';
                $this->data['biaya'] = '';
                $this->data['analisa'] = '';
                $this->data['halaman'] = 'vimport';

                $this->data['listkabupaten'] = $this->Kelurahan_m->ambilkecamatan();
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
                            $idkelurahan = '';
                            $kabupaten = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                            $kecamatan = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                            $kode_suco = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                            $nama_suco = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                            $urut_suco = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                            $data[] = array(

                                'idkelurahan'            => $idkelurahan,
                                'kabupaten'      =>  $kabupaten,
                                'kecamatan'         =>  $kecamatan,
                                'kode_suco'         =>  $kode_suco,
                                'nama_suco'         =>  $nama_suco,
                                'urut_suco'         => $urut_suco
                            );
                        }
                    }
                    $this->Kelurahan_m->insertimport($data);
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Data Berhasil Di Import</h4>
               Data berhasil di Import
            </div>');
                    redirect('kelurahan', 'refresh');
                }

                /////////////////////
            } else {
                echo "anda bukan admin";
            }
        } else {
            redirect('login', 'refresh');
        }
    }

    /*public function get_kecamatan($id = '')
    {
        $sub_cat = $this->Kelurahan_m->get_kecamatan($id);
        $str = '';
        foreach ($sub_cat as $value) {
            $str .= '<option value="' . $value->kode_subdistrict . '">' . $value->kode_subdistrict . ' | ' . $value->nama_subdistrict . '</option>';
        }

        echo $str;
    }*/


	public function get_kecamatan($id)
	{

        $sub_cat = DB::table('kecamatan')
        ->where('kabupaten',$id)
        ->get();

		$str = '';
		// $str .= '<option value="#">#</option>';
		foreach ($sub_cat as $value) {
			$str .= '<option value="' . $value->kode_subdistrict . '">' . $value->kode_subdistrict . ' | ' . $value->nama_subdistrict . '</option>';
		}
		echo $str;
	}


	public function get_kecamatan_edit($id)
	{
        $sub_cat = DB::table('kecamatan')
        ->where('kode_subdistrict',$id)
        ->get();

		//$sub_cat = $this->db->get_where('kecamatan', ['kode_subdistrict' => $id])->result();
		$str = '';
		// $str .= '<option value="#">#</option>';
		foreach ($sub_cat as $value) {
			$str .= '<option value="' . $value->kode_subdistrict . '">' . $value->kode_subdistrict . ' | ' . $value->nama_subdistrict . '</option>';
		}
		echo $str;
	}

//end of class
}
