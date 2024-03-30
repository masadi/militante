<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tim;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class TimController extends Controller
{
    public function index() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Tim';
            $judulmodul = 'Tim';


            $query = DB::table('tim')
                ->leftJoin('relawan','relawan.idrelawan','=','tim.anggota')
                ->leftJoin('pemilih','pemilih.idpemilih','=','relawan.idpemilihrelawan')
                ->leftJoin('dpt','dpt.iddpt','=','pemilih.iddptpemilih')
                ->leftJoin('kabupaten','kabupaten.kode_district','=','tim.kabupatentim')
                ->leftJoin('kecamatan','kecamatan.kode_subdistrict','=','tim.kecamatantim')
                ->leftJoin('kelurahan','kelurahan.kode_suco','=','tim.kelurahantim')
                ->orderBy('tim.idtim','ASC')
                ->get();

            return view('tim/tim_index',compact('query','judulmodul','judulhalaman'));
        }
    }


	public function save(Request $request)
	{
		if (!Session::get('username'))
		{
			redirect('/');
		}
		else
		{/*
			$this->form_validation->set_rules('namatim', 'namatim', 'required|strip_tags');

			$this->form_validation->set_rules('kabupatentim', 'Kabupaten Tim', 'required|strip_tags');
			$this->form_validation->set_rules('kecamatantim', 'Kecamatan Tim', 'required|strip_tags');
			$this->form_validation->set_rules('kelurahantim', 'kelurahan Tim', 'required|strip_tags');
			$this->form_validation->set_rules('anggota[]', 'anggota', 'required|strip_tags');
			$this->form_validation->set_rules('tugas', 'tugas', 'required|strip_tags');
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Gagal!</div></div>");
				$this->data['halaman'] = 'vtim';
				$this->load->view('_main', $this->data);
			} else {
				$anggota = $this->input->post('anggota');
				if (!empty($anggota)) {
					$anggota = implode(',', $this->input->post('anggota'));
				} else {
					$anggota = '';
				}

				$data = array(
					'namatim'		=> $this->input->post('namatim', TRUE),
					'kabupatentim'			=> $this->input->post('kabupatentim', TRUE),
					'kecamatantim'			=> $this->input->post('kecamatantim', TRUE),
					'kelurahantim'			=> $this->input->post('kelurahantim', TRUE),
					'anggota'			=> $anggota,
					'tugas'			=> $this->input->post('tugas', TRUE)
				);
				$insert = $this->Tim_m->insert($data);
				$this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Sukses!</div></div>");
				echo json_encode(array("status" => TRUE));
			}*/


            $namatim = $request->namatim;
            $kabupatentim = $request->kabupatentim;
            $kecamatantim = $request->kecamatantim;
            $kelurahantim = $request->kelurahantim;
            $anggota = $request->anggota;
            $tugas = $request->tugas;


            $tim = new Tim();
            $tim->namatim = $namatim;
            $tim->kabupatentim = $kabupatentim;
            $tim->kecamatantim = $kecamatantim;
            $tim->kelurahantim = $kelurahantim;
            $tim->anggota = $anggota;
            $tim->tugas = $tugas;

            $tim->save();

            echo json_encode(array("status" => $tim));
		}
	}
	public function delete($idtim)
	{
		/*$this->Tim_m->delete($idtim);
		$this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Sukses!</div></div>");
		echo json_encode(array("status" => TRUE));*/

        $timku = new Tim();
        $tim = $timku->find($idtim);
        $tim->delete();
		echo json_encode(array("status" => TRUE));
	}


	public function update($idtim)
	{
		//$data = $this->Tim_m->getid($idtim);
		//echo json_encode($data);
        $tim = DB::table('tim')
                ->leftjoin('kabupaten', 'kabupaten.kode_district','=','tim.kabupatentim')
                ->leftjoin('kecamatan', 'kecamatan.kode_subdistrict','=','tim.kecamatantim')
                ->leftjoin('kelurahan', 'kelurahan.kode_suco','=','tim.kelurahantim')
                ->where('idtim', $idtim)
                ->first();
		echo json_encode($tim);
	}
	public function updateaction(Request $request)
	{
		/*$this->form_validation->set_rules('namatim', 'namatim', 'required|strip_tags');
		$this->form_validation->set_rules('kabupatentim', 'Kabupaten Tim', 'required|strip_tags');
		$this->form_validation->set_rules('kecamatantim', 'Kecamatan Tim', 'required|strip_tags');
		$this->form_validation->set_rules('kelurahantim', 'kelurahan Tim', 'required|strip_tags');
		$this->form_validation->set_rules('anggota[]', 'anggota', 'required|strip_tags');
		$this->form_validation->set_rules('tugas', 'tugas', 'required|strip_tags');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Gagal!</div></div>");
			$this->data['halaman'] = 'vtim';
			$this->load->view('_main', $this->data);
		} else {
			$anggota = $this->input->post('anggota');
			if (!empty($anggota)) {
				$anggota = implode(',', $this->input->post('anggota'));
			} else {
				$anggota = '';
			}


			$data = array(
				'namatim'		=> $this->input->post('namatim', TRUE),
				'kabupatentim'			=> $this->input->post('kabupatentim', TRUE),
				'kecamatantim'			=> $this->input->post('kecamatantim', TRUE),
				'kelurahantim'			=> $this->input->post('kelurahantim', TRUE),
				'anggota'			=> $anggota,
				'tugas'			=> $this->input->post('tugas', TRUE)
			);

			$this->Tim_m->actionupdate(array('idtim' => $this->input->post('idtim')), $data);
			echo json_encode(array("status" => TRUE));
		}*/



            $namatim = $request->namatim;
            $kabupatentim = $request->kabupatentim;
            $kecamatantim = $request->kecamatantim;
            $kelurahantim = $request->kelurahantim;
            $anggota = $request->anggota;
            $tugas = $request->tugas;


            $timku = new Tim();
            $tim=$timku->find($request->idtim);
            $tim->namatim = $namatim;
            $tim->kabupatentim = $kabupatentim;
            $tim->kecamatantim = $kecamatantim;
            $tim->kelurahantim = $kelurahantim;
            $tim->anggota = $anggota;
            $tim->tugas = $tugas;
            $tim->save();
            echo json_encode(array("status" => TRUE));
	}
	public function detail($idtim)
	{

		if (!Session::get('username'))
		{
			redirect('/');
		}
		else
		{
			/*$this->data['daerah'] = '';
			$this->data['koordinator'] = '';
			$this->data['target'] = '';
			$this->data['pemilih'] = '';
			$this->data['tim'] = 'active';
			$this->data['pengguna'] = '';
			$this->data['saksi'] = '';
			$this->data['sms'] = '';
			$this->data['kegiatancalon'] = '';
			$this->data['calon'] = '';
			$this->data['relawan'] = '';
			$this->data['isu'] = '';
			$this->data['event'] = '';
			$this->data['notifikasi'] = '';
			$this->data['biaya'] = '';
			$this->data['quick'] = '';
			$this->data['dpt'] = '';
			$this->data['pengaturan'] = '';
			$this->data['hitung'] = '';
			$this->data['listpengaturan'] = $this->Pengaturan_m->tampil();
			$this->data['kp'] = '';
			$this->data['tr'] = '';
			$this->data['keluarga'] = '';
			$this->data['analisa'] = '';
			$this->data['timlist'] = $this->Tim_m->tampil();
			$this->data['timdetailist'] = $this->Tim_m->detailtim($idtim);
			$this->data['listkabupaten'] = $this->Kabupaten_m->getallkabupaten();
			$this->data['listrelawan'] = $this->Relawan_m->getallrelawan();
			$this->data['halaman'] = 'vdetail';
			$this->load->view('_main', $this->data);*/


            $judulhalaman = 'Tim';
            $judulmodul = 'Tim';


            $query = DB::table('tim')
                ->leftJoin('relawan','relawan.idrelawan','=','tim.anggota')
                ->leftJoin('pemilih','pemilih.idpemilih','=','relawan.idpemilihrelawan')
                ->leftJoin('dpt','dpt.iddpt','=','pemilih.iddptpemilih')
                ->leftJoin('kabupaten','kabupaten.kode_district','=','tim.kabupatentim')
                ->leftJoin('kecamatan','kecamatan.kode_subdistrict','=','tim.kecamatantim')
                ->leftJoin('kelurahan','kelurahan.kode_suco','=','tim.kelurahantim')
                ->orderBy('tim.idtim','ASC')
                ->get();

            return view('tim/tim_detail',compact('idtim','judulmodul','judulhalaman'));
		}
	}
	public function deletedetail()
	{
		$idtim = $this->input->get('idtim');
		$idkoordinator = $this->input->get('idkoordinator');
		$anggota = $this->Tim_m->getTeamById($idtim)->anggota;
		$anggota = explode(',', $anggota);
		$index = array_search($idkoordinator, $anggota);
		unset($anggota[$index]);
		$new_lineup = implode(',', $anggota);
		$data = array(
			'anggota' => $new_lineup
		);
		$this->Tim_m->updateTeam($idtim, $data);
		$this->session->set_flashdata('feedback', 'Deleted');
		redirect('tim/detail/' . $idtim);
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
