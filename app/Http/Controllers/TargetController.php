<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Target;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class TargetController extends Controller
{
    public function index() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Target';
            $judulmodul = 'Target';
            $target = new Target();
            $query = $target->orderBy('idtarget','DESC')->get();
            return view('target/target_index',compact('query','judulmodul','judulhalaman'));
        }
    }



	public function indexx()
	{
		if ($this->session->userdata('logged_in')==TRUE)
			{
				if($this->session->userdata('level')=='admin'){
				$this->data['daerah']='';
				$this->data['koordinator']='';
				$this->data['pemilih']='';
				$this->data['listpengaturan']=$this->Pengaturan_m->tampil();
				$this->data['saksi']='';
				$this->data['target']='active';
				$this->data['pengaturan']='';
				$this->data['pengguna']='';
				$this->data['kp']='';
				$this->data['tr']='';
				$this->data['keluarga']='';
				$this->data['kegiatancalon']='';
				$this->data['relawan']='';
				$this->data['dpt']='';
				$this->data['calon']='';
				$this->data['notifikasi']='';
				$this->data['isu']='';
				$this->data['tim']='';
				$this->data['event']='';
				$this->data['hitung']='';
				$this->data['sms']='';
				$this->data['quick']='';
				$this->data['biaya']='';
				$this->data['analisa']='';
				$this->data['halaman']='vtarget';
				$this->data['targetlist']=$this->Target_m->tampil();
				$this->data['listkabupaten']=$this->Kabupaten_m->get_categories();
				$this->load->view('_main',$this->data);
				}else
				{
					redirect('login','refresh');
				}
			}
		else
		{
			redirect('login','refresh');
		}
	}
	public function save(Request $request)
	{
        if(!Session::get('username')){
            redirect('/');
        } else {
            /*
			$this->form_validation->set_rules('jumlahsuara','Jumlah Suara','required|strip_tags');
			$this->form_validation->set_rules('kabupatentarget','Kabupaten','required|strip_tags');
			$this->form_validation->set_rules('kecamatantarget','Kecamatan','required|strip_tags');
			$this->form_validation->set_rules('kelurahantarget','Kelurahan','required|strip_tags');
			$this->form_validation->set_rules('tpstarget','TPS','required|strip_tags');
			if ($this->form_validation->run()==FALSE)
			{
				$this->session->set_flashdata("pesan","<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Gagal!</div></div>");
				$this->data['halaman']='vtarget';
				$this->load->view('_main',$this->data);
			}
			else
			{
				$data=array(
						'jumlahsuara'		=>$this->input->post('jumlahsuara'),

						'kabupatentarget'			=>$this->input->post('kabupatentarget'),
						'kecamatantarget'			=>$this->input->post('kecamatantarget'),
						'kelurahantarget'			=>$this->input->post('kelurahantarget'),
						'tpstarget'			=>$this->input->post('tpstarget')
					);
				$insert=$this->Target_m->insert($data);
				$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Sukses</h4>
               Data berhasil Disimpan
            </div>');
				echo json_encode(array("status"=>TRUE));
			}*/


            $jumlahsuara = $request->jumlahsuara;
            $kabupatentarget = $request->kabupatentarget;
            $kecamatantarget = $request->kecamatantarget;
            $kelurahantarget = $request->kelurahantarget;
            $tpstarget = $request->tpstarget;


            $target = new Target();
            $target->jumlahsuara = $jumlahsuara;
            $target->kabupatentarget = $kabupatentarget;
            $target->kecamatantarget = $kecamatantarget;
            $target->kelurahantarget = $kelurahantarget;
            $target->tpstarget = $tpstarget;
            $target->save();

            echo json_encode(array("status" => TRUE));
		}
	}
	public function update($idtarget)
	{
		//$data=$this->Target_m->getid($idtarget);
		//echo json_encode($data);
        $target = new Target();
		$data=$target->find($idtarget);
		//$data = $this->Dpt_m->get_by_id($iddpt);
		echo json_encode($data);
	}
	public function updateaction(Request $request)
	{
        /*
			$this->form_validation->set_rules('jumlahsuara','Jumlah Suara','required|strip_tags');
			$this->form_validation->set_rules('kabupatentarget','Kabupaten','required|strip_tags');
			$this->form_validation->set_rules('kecamatantarget','Kecamatan','required|strip_tags');
			$this->form_validation->set_rules('kelurahantarget','Kelurahan','required|strip_tags');
			$this->form_validation->set_rules('deskripsitarget','Deskripsi','required|strip_tags');
			$this->form_validation->set_rules('tpstarget','TPS','required|strip_tags');
            if ($this->form_validation->run()==FALSE)
                {
                    $this->session->set_flashdata("pesan","<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Gagal!</div></div>");
                    $this->data['halaman']='vtarget';
                    $this->load->view('_main',$this->data);
                }
                else{
                $data=array(
                                'jumlahsuara'		=>$this->input->post('jumlahsuara'),
                                'kabupatentarget'			=>$this->input->post('kabupatentarget'),
                                'kecamatantarget'			=>$this->input->post('kecamatantarget'),
                                'kelurahantarget'			=>$this->input->post('kelurahantarget'),
                                'tpstarget'			=>$this->input->post('tpstarget')
                            );
                $this->Target_m->actionupdate(array('idtarget'=>$this->input->post('idtarget')),$data);
                echo json_encode(array("status"=>TRUE));
            }
        */


            $jumlahsuara = $request->jumlahsuara;
            $kabupatentarget = $request->kabupatentarget;
            $kecamatantarget = $request->kecamatantarget;
            $kelurahantarget = $request->kelurahantarget;
            $tpstarget = $request->tpstarget;


            $targetku = new Target();
            $target=$targetku->find($request->idtarget);
            $target->jumlahsuara = $jumlahsuara;
            $target->kabupatentarget = $kabupatentarget;
            $target->kecamatantarget = $kecamatantarget;
            $target->kelurahantarget = $kelurahantarget;
            $target->tpstarget = $tpstarget;
            $target->save();

            echo json_encode(array("status" => TRUE));
	}
	public function delete($idtarget)
	{
		/*$this->Target_m->delete($idtarget);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Sukses</h4>
                Data berhasil Dihapaus
            </div>');
		echo json_encode(array("status"=>TRUE));*/

        $targetku = new Target();
        $target = $targetku->find($idtarget);
        $target->delete();
		echo json_encode(array("status" => TRUE));
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
