<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Saksi;
use App\Models\LoginModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class SaksiController extends Controller
{
    public function index() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'FISCAIS';
            $judulmodul = 'FISCAIS';

            $query = DB::table('saksi')
                ->leftJoin('kabupaten','kabupaten.kode_district','=','saksi.kabupatensaksi')
                ->leftJoin('kecamatan','kecamatan.kode_subdistrict','=','saksi.kecamatansaksi')
                ->leftJoin('kelurahan','kelurahan.kode_suco','=','saksi.kelurahansaksi')
                ->leftJoin('tps','tps.kode_aldeia','=','saksi.tpssaksi')
                ->orderBy('saksi.idsaksi','DESC')
                ->get();
            return view('fiscais/fiscais_index',compact('query','judulmodul','judulhalaman'));
        }
    }


	public function save(Request $request)
	{
		if(!Session::get('username')){
			redirect('/');
		} else {
			/*$this->form_validation->set_rules('namasaksi', 'Nama Saksi', 'required|strip_tags');
			$this->form_validation->set_rules('hpsaksi', 'HP Saksi', 'required|strip_tags');
			$this->form_validation->set_rules('electoralsaksi', 'Elektoral Saksi', 'required|strip_tags');
			$this->form_validation->set_rules('kabupatensaksi', 'Kabupaten', 'required|strip_tags');
			$this->form_validation->set_rules('kecamatansaksi', 'Kecamatan', 'required|strip_tags');
			$this->form_validation->set_rules('kelurahansaksi', 'Kelurahan', 'required|strip_tags');
			// $this->form_validation->set_rules('deskripsisaksi', 'Deskripsi', 'required|strip_tags');
			$this->form_validation->set_rules('tpssaksi', 'TPS', 'required|strip_tags');
			// $this->form_validation->set_rules('saksiuntuk', 'Pilih Saksi untuk Calon', 'required|strip_tags');
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Gagal!</div></div>");
				$this->data['halaman'] = 'vsaksi';
				$this->load->view('_main', $this->data);
				$status = FALSE;
			} else {
				$data = array(
					'namasaksi'					=> $this->input->post('namasaksi', TRUE),
					'hpsaksi'						=> $this->input->post('hpsaksi', TRUE),
					'electoralsaksi'		=> $this->input->post('electoralsaksi', TRUE),
					// 'saksiuntuk'				=> $this->input->post('saksiuntuk', TRUE),
					'kabupatensaksi'		=> $this->input->post('kabupatensaksi', TRUE),
					'kecamatansaksi'		=> $this->input->post('kecamatansaksi', TRUE),
					'kelurahansaksi'		=> $this->input->post('kelurahansaksi', TRUE),
					// 'deskripsisaksi'		=> $this->input->post('deskripsisaksi', TRUE),
					'tpssaksi'					=> $this->input->post('tpssaksi', TRUE)
				);
				$this->Saksi_m->insert($data);

				$a = $this->db->insert_id('idsaksi');

				$password = hash('sha512', $this->input->post('password', TRUE) . config_item('encryption_key'));

				$datauntuklogin = array(
					'username' 	=> $this->input->post('hpsaksi', TRUE),
					'nama' 			=> $this->input->post('namasaksi', TRUE),
					'level' 		=> 'saksi',
					'saksikode' => $a,
					'password' 	=> $password
				);
				$this->Saksi_m->insertkelogin($datauntuklogin);

				$this->session->set_flashdata('pesan', $a);
				$status = TRUE;
			}
			echo json_encode(array("status" => $status));*/

            $namasaksi = $request->namasaksi;
            $hpsaksi = $request->hpsaksi;
            $electoralsaksi = $request->electoralsaksi;
            $kabupatensaksi = $request->kabupatensaksi;
            $kecamatansaksi = $request->kecamatansaksi;
            $kelurahansaksi = $request->kelurahansaksi;
            $tpssaksi = $request->tpssaksi;
            $password = sha1($request->password);

            $saksi = new Saksi();
            $saksi->namasaksi = $namasaksi;
            $saksi->hpsaksi = $hpsaksi;
            $saksi->electoralsaksi = $electoralsaksi;
            $saksi->kabupatensaksi = $kabupatensaksi;
            $saksi->kecamatansaksi = $kecamatansaksi;
            $saksi->kelurahansaksi = $kelurahansaksi;
            $saksi->tpssaksi = $tpssaksi;
            $saksi->save();
            $idsaksi=$saksi->idsaksi;

            $admin = new LoginModel();
            $admin->username = $hpsaksi;
            $admin->nama = $namasaksi;
            $admin->level = 'saksi';
            $admin->saksikode = $idsaksi;
            $admin->password = $password;
            $admin->save();


            echo json_encode(array("status" => TRUE));
		}
	}

	public function verify_saksi($idsaksi)
	{
		/*$check = $this->db->get_where('saksi', ['idsaksi' => $id])->row();
		if (isset($check)) {
			if ($check->status == 0) {
				$this->db->update('user', ['active' => 1], ['username' => $check->hpsaksi]);
				$this->db->update('saksi', ['status' => 1], ['idsaksi' => $id]);
			} else {
				$this->db->update('user', ['active' => 0], ['username' => $check->hpsaksi]);
				$this->db->update('saksi', ['status' => 0], ['idsaksi' => $id]);
			}
			$status = TRUE;
		}

		echo json_encode(array("status" => $status));
        */

        $saksiku = new Saksi();
        $saksi=$saksiku->find($idsaksi);
        if($saksi->status == 1) {$saksi->status = 0; $aktif=0;}
        else { $saksi->status = 1; $aktif=1;}
        $saksi->save();


        $adminku = new LoginModel();
        $admin=$adminku->where('saksikode','=',$idsaksi)->first();
        $admin->active=$aktif;
        $admin->save();

        echo json_encode(array("status" => TRUE));

	}

	public function hash($string)
	{
		return hash('sha512', $string . config_item('encryption_key'));
	}

	public function update($idsaksi)
	{
		//$data = $this->Saksi_m->getid($idsaksi);
		//echo json_encode($data);


        $saksi = new Saksi();
		$data=$saksi->find($idsaksi);
		echo json_encode($data);
	}

	public function updateaction(Request $request)
	{
		/*$this->form_validation->set_rules('namasaksi', 'Nama Saksi', 'required|strip_tags');
		$this->form_validation->set_rules('hpsaksi', 'HP Saksi', 'required|strip_tags');
		$this->form_validation->set_rules('electoralsaksi', 'Elektoral Saksi', 'required|strip_tags');
		$this->form_validation->set_rules('kabupatensaksi', 'Kabupaten', 'required|strip_tags');
		$this->form_validation->set_rules('kecamatansaksi', 'Kecamatan', 'required|strip_tags');
		$this->form_validation->set_rules('kelurahansaksi', 'Kelurahan', 'required|strip_tags');
		// $this->form_validation->set_rules('deskripsisaksi', 'Deskripsi', 'required|strip_tags');
		$this->form_validation->set_rules('tpssaksi', 'TPS', 'required|strip_tags');
		// $this->form_validation->set_rules('saksiuntuk', 'Pilih Saksi untuk Calon', 'required|strip_tags');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Gagal!</div></div>");
			$this->data['halaman'] = 'vsaksi';
			$this->load->view('_main', $this->data);
		} else {
			$data = array(
				'namasaksi'				=> $this->input->post('namasaksi', TRUE),
				'hpsaksi'					=> $this->input->post('hpsaksi', TRUE),
				'electoralsaksi'	=> $this->input->post('electoralsaksi', TRUE),
				// 'saksiuntuk'			=> $this->input->post('saksiuntuk', TRUE),
				'kabupatensaksi'	=> $this->input->post('kabupatensaksi', TRUE),
				'kecamatansaksi'	=> $this->input->post('kecamatansaksi', TRUE),
				'kelurahansaksi'	=> $this->input->post('kelurahansaksi', TRUE),
				// 'deskripsisaksi'	=> $this->input->post('deskripsisaksi', TRUE),
				'tpssaksi'				=> $this->input->post('tpssaksi', TRUE)
			);
			$this->Saksi_m->actionupdate(array('idsaksi' => $this->input->post('idsaksi', TRUE)), $data);

			$user_pass = $this->input->post('password', TRUE);
			if ($user_pass != '') {
				$password = hash('sha512', $this->input->post('password', TRUE) . config_item('encryption_key'));
				$datauntuklogin = array(
					'username' => $this->input->post('hpsaksi', TRUE),
					'password' => $password
				);
			} else {
				$datauntuklogin = array(
					'username' => $this->input->post('hpsaksi', TRUE)
				);
			}

			$this->Saksi_m->updatekelogin(['level' => 'saksi', 'saksikode' => $this->input->post('idsaksi', TRUE)], $datauntuklogin);

			echo json_encode(array("status" => TRUE));
		}*/

        $idsaksi = $request->idsaksi;
        $namasaksi = $request->namasaksi;
        $hpsaksi = $request->hpsaksi;
        $electoralsaksi = $request->electoralsaksi;
        $kabupatensaksi = $request->kabupatensaksi;
        $kecamatansaksi = $request->kecamatansaksi;
        $kelurahansaksi = $request->kelurahansaksi;
        $tpssaksi = $request->tpssaksi;


        $saksiku = new Saksi();
        $saksi=$saksiku->find($request->idsaksi);
        $saksi->namasaksi = $namasaksi;
        $saksi->hpsaksi = $hpsaksi;
        $saksi->electoralsaksi = $electoralsaksi;
        $saksi->kabupatensaksi = $kabupatensaksi;
        $saksi->kecamatansaksi = $kecamatansaksi;
        $saksi->kelurahansaksi = $kelurahansaksi;
        $saksi->tpssaksi = $tpssaksi;
        $saksi->save();

        if (!empty($request->password)) {
            $adminku = new LoginModel();
            $admin=$adminku->where('saksikode','=',$idsaksi)->find();
            $password = sha1($request->password);
            $admin->username = $hpsaksi;
            $admin->password = $password;
            $admin->save();
		} else {
            $adminku = new LoginModel();
            $admin=$adminku->where('saksikode','=',$idsaksi)->first();
            $admin->username = $hpsaksi;
            $admin->save();
		}

        echo json_encode(array("status" => TRUE));
	}
	public function delete($idsaksi)
	{
		/*$this->Saksi_m->delete($idsaksi);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Sukses</h4>
                Data berhasil Dihapaus
            </div>');
		echo json_encode(array("status" => TRUE));*/



        $saksiku = new Saksi();
        $saksi = $saksiku->find($idsaksi);
        $saksi->delete();
		echo json_encode(array("status" => TRUE));
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



//end of class
}
