<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Api;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function index() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Api';
            $judulmodul = 'Api';
            $api = new Api();
            $query = $api->orderBy('id','DESC')->get();
            return view('api/api_index',compact('query','judulmodul','judulhalaman'));
        }
    }

    public function kredit() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Kredit';
            $judulmodul = 'Kredit';
            return view('api/api_kredit',compact('judulmodul','judulhalaman'));
        }
    }

	public function simpan()
	{
		    $this->form_validation->set_rules('userkey','userkey','required|strip_tags');
			$this->form_validation->set_rules('passkey','passkey','required|strip_tags');
			if ($this->form_validation->run()==FALSE)
			{
				redirect('api','refresh');
			}else {
				$data=array(
						'userkey'	=> $this->input->post('userkey'),
						'passkey'		=> $this->input->post('passkey')
					);
				$save=$this->Api_m->insert($data);
				$this->data['phonebooklist']=$this->Api_m->tampil();

		redirect('api','refresh');
	}
	}
	public function cek_kredit()
	{
		if($this->session->userdata('logged_in')!=TRUE){
			redirect('login','refresh');
		}else
		{
		$CI =& get_instance();
		$CI->load->database();
		$CI->db->select('*');
		$CI->db->from('api');
		$query=$CI->db->get();
		$data=$query->result_array();
		foreach($data as $info)
		{

			$userkey=$info['userkey'];
			$passkey=$info['passkey'];

		}
		$userkey=$info['userkey'];
		$passkey=$info['passkey'];
		$feed = curl_init('https://reguler.zenziva.net/apps/smsapibalance.php?userkey='.$userkey.'&passkey='.$passkey.'');
		curl_setopt($feed, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($feed, CURLOPT_HEADER, 0);
		$xml = simplexml_load_string(curl_exec($feed));
		curl_close($feed);
		foreach ($xml->message as $item){
		$title = $item->value;

		//echo '<p>Sisa SMS anda <b>'.$title.'</b>';
	}
		$this->data['daerah']='';
		$this->data['koordinator']='';
		$this->data['relawan']='';
		$this->data['dpt']='';
		$this->data['pengaturan']='';
		$this->data['pemilih']='';
		$this->data['saksi']='';
		$this->data['kegiatancalon']='';
		$this->data['analisa']='';
		$this->data['hitung']='';
		$this->data['sms']='active';
		$this->data['calon']='';
		$this->data['listpengaturan']=$this->Pengaturan_m->tampil();
		$this->data['quick']='';
		$this->data['pengguna']='';
		$this->data['target']='';
		$this->data['notifikasi']='';
		$this->data['tim']='';
		$this->data['isu']='';
		$this->data['kp']='';
				$this->data['tr']='';
				$this->data['keluarga']='';
		$this->data['biaya']='';
		$this->data['event']='';
		$this->data['kredit']=$title;
		$this->data['halaman']='vkredit';
		$this->load->view('_main',$this->data);
 	}

	}
//end of class
}
