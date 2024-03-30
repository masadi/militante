<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tps;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class TpsController extends Controller
{
    public function index() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'TPS';
            $judulmodul = 'TPS';
            $tps = new Tps();
            $query = $tps->orderBy('idtps','DESC')->get();
            return view('tps/tps_index',compact('query','judulmodul','judulhalaman'));
        }
    }


    
    public function upload() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'TPS';
            $judulmodul = 'TPS';
            //$kabupaten = new Kecamatan();
            $sukses=0;$gagal=0;
            //$query = $kabupaten->orderBy('idkabupaten','DESC')->get();
            return view('tps/tps_upload',compact('judulmodul','judulhalaman','sukses','gagal'));
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
                            $exec = DB::table('tps')->insert([
                                
                                'kode_aldeia' => $kode,
                                'nama_aldeia' => $nama,
                                
                                'kabupatentps' => substr($kode,0,2),
                                'kecamatantps' => substr($kode,0,4),
                                'kelurahantps' => substr($kode,0,6),
                                'urut_aldeia' => substr($kode,6,2)
                            ]);
                            ($exec) ? $sukses++ : $gagal++;
                        //}
                    }
                //}
                    //echo "SUKSES : ".$sukses." - GAGAL : ".$gagal;
                return view('tps/tps_upload',compact('judulhalaman','sukses','gagal','new_name','stat'));
            } else {
                echo json_encode(array("status" => FALSE));
                //echo "SUKSES : ".$sukses." - GAGAL : ".$gagal;
            }
        //}
    }

    public function ajax_list()
    {
        $tps = new Tps();
        $query = $tps->orderBy('idtps','DESC')->get();
        $data = array();
        $no = 0;
        foreach ($query as $tps) {
            $no++;
            $row = array();
            $row[] = $tps->kabupatentps;
            $row[] = $tps->kecamatantps;
            $row[] = $tps->kelurahantps;
            $row[] = $tps->kode_aldeia;
            $row[] = $tps->nama_aldeia;
            $row[] = $tps->urut_aldeia;


            //add html for action
            $row[] = '
            <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_tps(' . "'" . $tps->idtps . "'" . ')"><i class="fa fa-edit"></i> Edit</a> <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_tps(' . "'" . $tps->idtps . "'" . ')"><i class="fa fa-trash"></i> Delete</a>';

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
    public function ajax_edit($idtps)
    {
        //$data = $this->Tps_m->get_by_id($idtps);
        //echo json_encode($data);
        $tps = new Tps();
        $data = $tps->find($idtps);

        echo json_encode($data);
    }

    public function ajax_add(Request $request)
    {
        /*$data = array(
            'kabupatentps'        => $this->input->post('kabupatentps'),
            'kecamatantps'            => $this->input->post('kecamatantps'),
            'kelurahantps'            => $this->input->post('kelurahantps'),
            'kode_aldeia'            => $this->input->post('kode_aldeia'),
            'nama_aldeia'            => $this->input->post('nama_aldeia'),
            'urut_aldeia'         => $this->input->post('urut_aldeia')
        );
        $insert = $this->Tps_m->save($data);
        echo json_encode(array("status" => TRUE));*/

            $kabupatentps = $request->kabupatentps;
            $kecamatantps = $request->kecamatantps;
            $kelurahantps = $request->kelurahantps;
            $kode_aldeia = $request->kode_aldeia;
            $nama_aldeia = $request->nama_aldeia;
            $urut_aldeia = $request->urut_aldeia;

            $tps = new Tps();
            $tps->kabupatentps = $kabupatentps;
            $tps->kecamatantps = $kecamatantps;
            $tps->kelurahantps = $kelurahantps;
            $tps->kode_aldeia = $kode_aldeia;
            $tps->nama_aldeia = $nama_aldeia;
            $tps->urut_aldeia = $urut_aldeia;
            $tps->user = Session::get('nama');
            $tps->save();

            echo json_encode(array("status" => TRUE));
    }

    public function ajax_update(Request $request)
    {
        /*$id = $this->session->userdata('nama');
        $data = array(
            'kabupatentps'        => $this->input->post('kabupatentps'),
            'kecamatantps'            => $this->input->post('kecamatantps'),
            'kelurahantps'            => $this->input->post('kelurahantps'),
            'kode_aldeia'            => $this->input->post('kode_aldeia'),
            'nama_aldeia'            => $this->input->post('nama_aldeia'),
            'urut_aldeia'         => $this->input->post('urut_aldeia')
        );
        $this->Tps_m->update(array('idtps' => $this->input->post('idtps')), $data);
        echo json_encode(array("status" => TRUE));*/


            $kabupatentps = $request->kabupatentps;
            $kecamatantps = $request->kecamatantps;
            $kelurahantps = $request->kelurahantps;
            $kode_aldeia = $request->kode_aldeia;
            $nama_aldeia = $request->nama_aldeia;
            $urut_aldeia = $request->urut_aldeia;

            $tpsku = new Tps();
            $tps=$tpsku->find($request->idtps);
            $tps->kabupatentps = $kabupatentps;
            $tps->kecamatantps = $kecamatantps;
            $tps->kelurahantps = $kelurahantps;
            $tps->kode_aldeia = $kode_aldeia;
            $tps->nama_aldeia = $nama_aldeia;
            $tps->urut_aldeia = $urut_aldeia;
            $tps->user = Session::get('nama');
            $tps->save();

            echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($idtps)
    {
        //$this->Tps_m->delete_by_id($idtps);
        //echo json_encode(array("status" => TRUE));
        $tps = new Tps();
        $data = $tps->find($idtps);
        $data->delete();

        echo json_encode(array("status" => TRUE));
    }

    public function get_subcategories_ajax2($id)
    {
        $sub_cat = $this->Tps_m->get_subcategories_by_cat_id($id);
        $str = '';
        $str .= '<option value="#">#</option>';
        foreach ($sub_cat as $value) {
            $str .= '<option value="' . $value->idsaksi . '">' . $value->namasaksi . '</option>';
        }

        echo $str;
    }
    public function get_subcategories_ajaxxc($id)
    {
        $sub_cat = $this->Tps_m->get_subcategories_by_cat_idxx($id);
        $str = '';
        $str .= '<option value="#">#</option>';
        foreach ($sub_cat as $value) {
            $str .= '<option value="' . $value->idtps . '">' . $value->nama_aldeia . '</option>';
        }

        echo $str;
    }

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

	public function get_kelurahan($id)
	{
        $sub_cat = DB::table('kelurahan')
        ->where('kecamatan',$id)
        ->get();

		$str = '';
		foreach ($sub_cat as $value) {
			$str .= '<option value="' . $value->kode_suco . '">' . $value->kode_suco . ' | ' . $value->nama_suco . '</option>';
		}
		echo $str;
	}

	public function get_tps($id)
	{
        $sub_cat = DB::table('tps')
        ->where('kelurahantps',$id)
        ->get();
		$str = '';
		foreach ($sub_cat as $value) {
			$str .= '<option value="' . $value->kode_aldeia . '">' . $value->kode_aldeia . ' | ' . $value->nama_aldeia . '</option>';
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

	public function get_kelurahan_edit($id)
	{
        $sub_cat = DB::table('kelurahan')
        ->where('kode_suco',$id)
        ->get();

		//$sub_cat = $this->db->get_where('kelurahan', ['kode_suco' => $id])->result();
		$str = '';
		foreach ($sub_cat as $value) {
			$str .= '<option value="' . $value->kode_suco . '">' . $value->kode_suco . ' | ' . $value->nama_suco . '</option>';
		}
		echo $str;
	}

	public function get_tps_edit($id)
	{
        $sub_cat = DB::table('tps')
        ->where('kode_aldeia',$id)
        ->get();
		//$sub_cat = $this->db->get_where('tps', ['kode_aldeia' => $id])->result();
		$str = '';
		foreach ($sub_cat as $value) {
			$str .= '<option value="' . $value->kode_aldeia . '">' . $value->kode_aldeia . ' | ' . $value->nama_aldeia . '</option>';
		}
		echo $str;
	}

//end of class
}
