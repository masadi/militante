<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tpsdetail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class TpsdetailController extends Controller
{
    public function index() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Master TPS';
            $judulmodul = 'Master TPS';
            $tpsdetail = new Tpsdetail();
            $query = $tpsdetail->orderBy('idtps_dt','DESC')->get();
            return view('tpsdetail/tpsdetail_index',compact('query','judulmodul','judulhalaman'));
        }
    }


    public function ajax_list()
    {
        $query = DB::table('tps_detail')
                ->leftJoin('kecamatan','kecamatan.kode_subdistrict','=','tps_detail.kecamatantps')
                ->leftJoin('kelurahan','kelurahan.kode_suco','=','tps_detail.kelurahantps')
                ->leftJoin('kabupaten','kabupaten.kode_district','=','tps_detail.kabupatentps')
                ->orderBy('tps_detail.idtps_dt','DESC')
                ->get();

        $data = array();
        $no = 0;
        foreach ($query as $tps) {
            $no++;
            $row = array();
            $row[] = $tps->nama_district;
            $row[] = $tps->nama_subdistrict;
            $row[] = $tps->nama_suco;
            $row[] = $tps->kode_tps;
            $row[] = $tps->nama_tps;
            //add html for action
            $row[] = '
            <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_tps(' . "'" . $tps->idtps_dt . "'" . ')"><i class="fa fa-edit"></i> Edit</a> <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_tps(' . "'" . $tps->idtps_dt . "'" . ')"><i class="fa fa-trash"></i> Delete</a>';

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
    public function ajax_edit($idtps_dt)
    {
        //$data = $this->Tps_detail_m->get_by_id($idtps_dt);
        //echo json_encode($data);
        $tps = new Tpsdetail();
        $data = $tps->find($idtps_dt);

        echo json_encode($data);
    }

    public function ajax_add(Request $request)
    {
        /*$data = array(
            'kabupatentps'        => $this->input->post('kabupatentps'),
            'kecamatantps'            => $this->input->post('kecamatantps'),
            'kelurahantps'            => $this->input->post('kelurahantps'),
            'kode_tps'            => $this->input->post('kode_tps'),
            'nama_tps'            => $this->input->post('nama_tps'),
        );
        $insert = $this->Tps_detail_m->save($data);
        echo json_encode(array("status" => TRUE));*/

            $kabupatentps = $request->kabupatentps;
            $kecamatantps = $request->kecamatantps;
            $kelurahantps = $request->kelurahantps;
            $kode_tps = $request->kode_tps;
            $nama_tps = $request->nama_tps;

            $tps = new Tpsdetail();
            $tps->kabupatentps = $kabupatentps;
            $tps->kecamatantps = $kecamatantps;
            $tps->kelurahantps = $kelurahantps;
            $tps->kode_tps = $kode_tps;
            $tps->nama_tps = $nama_tps;
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
            'kode_tps'            => $this->input->post('kode_tps'),
            'nama_tps'            => $this->input->post('nama_tps'),
        );
        $this->Tps_detail_m->update(array('idtps_dt' => $this->input->post('idtps_dt')), $data);
        echo json_encode(array("status" => TRUE));*/


            $kabupatentps = $request->kabupatentps;
            $kecamatantps = $request->kecamatantps;
            $kelurahantps = $request->kelurahantps;
            $kode_tps = $request->kode_tps;
            $nama_tps = $request->nama_tps;

            $tpsku = new Tpsdetail();
            $tps=$tpsku->find($request->idtps);
            $tps->kabupatentps = $kabupatentps;
            $tps->kecamatantps = $kecamatantps;
            $tps->kelurahantps = $kelurahantps;
            $tps->kode_tps = $kode_tps;
            $tps->nama_tps = $nama_tps;
            $tps->save();

            echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($idtps_dt)
    {
        /*$this->Tps_detail_m->delete_by_id($idtps_dt);
        echo json_encode(array("status" => TRUE));*/

        $tps = new Tpsdetail();
        $data = $tps->find($idtps_dt);
        $data->delete();
        echo json_encode(array("status" => TRUE));
    }

    public function get_subcategories_ajax2($id)
    {
        $sub_cat = $this->Tps_detail_m->get_subcategories_by_cat_id($id);
        $str = '';
        $str .= '<option value="#">#</option>';
        foreach ($sub_cat as $value) {
            $str .= '<option value="' . $value->idsaksi . '">' . $value->namasaksi . '</option>';
        }

        echo $str;
    }
    public function get_subcategories_ajaxxc($id)
    {
        $sub_cat = $this->Tps_detail_m->get_subcategories_by_cat_idxx($id);
        $str = '';
        $str .= '<option value="#">#</option>';
        foreach ($sub_cat as $value) {
            $str .= '<option value="' . $value->idtps_dt . '">' . $value->nama_tps . '</option>';
        }

        echo $str;
    }

	public function get_kecamatan($id)
	{

        $sub_cat = DB::table('kecamatan')
        ->where('idkecamatan',$id)
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
        ->where('idkelurahan',$id)
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
        ->where('idtps',$id)
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
