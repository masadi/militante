<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upload;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class UploadController extends Controller
{
    public function index() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Upload';
            $judulmodul = 'Upload';
            $upload = new Upload();
            $query = $upload->orderBy('idbukti','DESC')->get();
            return view('upload/upload_index',compact('query','judulmodul','judulhalaman'));
        }
    }

	public function xindex()
	{
		if ($this->session->userdata('logged_in')==TRUE)
			{
				if($this->session->userdata('level')=='admin'){
				$this->data['daerah']='';
				$this->data['relawan']='';
				$this->data['koordinator']='';
				$this->data['listpengaturan']=$this->Pengaturan_m->tampil();
				$this->data['pengaturan']='';
				$this->data['pemilih']='';
				$this->data['target']='';
				$this->data['isu']='';
				$this->data['kegiatancalon']='';
				$this->data['tim']='';
				$this->data['notifikasi']='';
				$this->data['kp']='';
				$this->data['tr']='';
				$this->data['keluarga']='';
				$this->data['pengguna']='';
				$this->data['saksi']='';
				$this->data['quick']='';
				$this->data['calon']='';
				$this->data['event']='';
				$this->data['dpt']='';
				$this->data['hitung']='active';
				$this->data['sms']='';
				$this->data['biaya']='';
				$this->data['analisa']='';
				$this->data['halaman']='vupload';
				$this->data['provinsilist']=$this->Upload_m->tampil();
				$this->load->view('_main',$this->data);
				}elseif ($this->session->userdata('level')=='saksi')
				{
					$this->data['daerah']='';
					$this->data['pengaturan']='';
				$this->data['koordinator']='';
				$this->data['pemilih']='';
				$this->data['tim']='';
				$this->data['notifikasi']='';
				$this->data['calon']='';
				$this->data['pengguna']='';
				$this->data['relawan']='';
				$this->data['isu']='';
				$this->data['saksi']='';
				$this->data['dpt']='';
				$this->data['listpengaturan']=$this->Pengaturan_m->tampil();
				$this->data['event']='';
				$this->data['quick']='';
				$this->data['kegiatancalon']='';
				$this->data['hitung']='active';
				$this->data['target']='';
				$this->data['kp']='';
				$this->data['tr']='';
				$this->data['keluarga']='';
				$this->data['sms']='';
				$this->data['biaya']='';
				$this->data['analisa']='';
				$this->data['halaman']='vupload';
				$this->data['provinsilist']=$this->Upload_m->tampil();
				$this->load->view('_main',$this->data);
				} else
				{
					redirect('login','refresh');
				}
			}
		else
		{
			redirect('login','refresh');
		}
	}
	public function add()
	{
		if ($this->session->userdata('logged_in')==TRUE)
			{
				if($this->session->userdata('level')=='saksi'){
				$this->data['daerah']='';
				$this->data['notifikasi']='';
				$this->data['pengguna']='';
				$this->data['koordinator']='';
				$this->data['pemilih']='';
				$this->data['kegiatancalon']='';
				$this->data['tim']='';
				$this->data['saksi']='';
				$this->data['quick']='';
				$this->data['dpt']='';
				$this->data['event']='';
				$this->data['pengaturan']='';
				$this->data['calon']='';
				$this->data['kp']='';
				$this->data['tr']='';
				$this->data['keluarga']='';
				$this->data['listpengaturan']=$this->Pengaturan_m->tampil();
				$this->data['relawan']='';
				$this->data['target']='';
				$this->data['isu']='';
				$this->data['hitung']='active';
				$this->data['sms']='';
				$this->data['biaya']='';
				$this->data['analisa']='';
				$this->data['halaman']='vuploadadd';
				$this->data['listkabupaten']=$this->Kabupaten_m->get_categories();
				$this->load->view('_main',$this->data);
				}else
				{
					echo "anda bukan saksi";
				}
			}
		else
		{
			redirect('login','refresh');
		}
	}
	public function save()
	{
		if ($this->session->userdata('logged_in')!=TRUE)
		{
			redirect('login','refresh');
		}
		else
		{

			$this->form_validation->set_rules('kabupaten','Kabupaten','required|strip_tags');
			$this->form_validation->set_rules('kecamatan','kecamatan','required|strip_tags');
			$this->form_validation->set_rules('kelurahan','kelurahan','required|strip_tags');
			$this->form_validation->set_rules('tps','tps','required|strip_tags');
			$this->form_validation->set_rules('deskripsi','deskripsi','required|strip_tags');
			if ($this->form_validation->run()==FALSE)
			{
				$this->session->set_flashdata("pesan","<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Gagal!</div></div>");
				$this->data['halaman']='vupload';
				$this->load->view('_main',$this->data);
			}
			else
			{
				$id =$this->session->userdata('nama');


						$data=array(


						'kabupaten'		=> $this->input->post('kabupaten'),
						'kecamatan'	=> $this->input->post('kecamatan'),
						'kelurahan'		=> $this->input->post('kelurahan'),
						'tps'=>$this->input->post('tps'),
						'deskripsi'		=>$this->input->post('deskripsi'),
						'saksi'			=>$id
					);
					if(!empty($_FILES['namabukti']['name']))
					        {
					        	$upload = $this->_do_upload();
					        	$data['namabukti'] = $upload;
					        }
					$save=$this->Upload_m->insert($data);
					redirect('upload','refresh');
					}

			}

	}
	private function _do_upload()
    {
    	$id =$this->session->userdata('nama');
        $config['upload_path']          = 'assets/bukti/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|JPG';
        $config['overwrite']=TRUE;

        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('namabukti')) //upload and validate
        {
            $data['inputerror'][] = 'namabukti';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        $namatext="diupload oleh ".$id;
        $image_data = $this->upload->data();
        $config['image_library'] = 'gd2';
        $config['source_image'] = $image_data['full_path'];
        $config['maintain_ratio'] = FALSE;
        $config['wm_text']=$namatext;
        $config['wm_type']='text';
        $config['wm_font_size']='12';
        $config['width'] = 250;
        $config['height'] = 250;
        $this->load->library('image_lib', $config);
        if (!$this->image_lib->resize()) {
            $this->handle_error($this->image_lib->display_errors());
        }
        if (!$this->image_lib->watermark()) {
            $this->handle_error($this->image_lib->display_errors());
        }
        return $this->upload->data('file_name');
    }

//end of class
}
