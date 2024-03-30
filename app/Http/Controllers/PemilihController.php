<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemilih;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class PemilihController extends Controller
{
    public function index() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Pemilih';
            $judulmodul = 'Pemilih';
            $pemilih = new Pemilih();
            $query = $pemilih->orderBy('idpemilih','DESC')->get();
            return view('pemilih/pemilih_index',compact('query','judulmodul','judulhalaman'));
        }
    }


	public function sort()
	{
        if(Session::get('username')){
			$this->data['daerah'] = '';
			$this->data['koordinator'] = '';
			$this->data['pemilih'] = 'active';
			$this->data['notifikasi'] = '';
			$this->data['tim'] = '';
			$this->data['saksi'] = '';
			$this->data['relawan'] = '';
			$this->data['target'] = '';
			$this->data['dpt'] = '';
			$this->data['kegiatancalon'] = '';
			$this->data['listpengaturan'] = $this->Pengaturan_m->tampil();
			$this->data['pengaturan'] = '';
			$this->data['quick'] = '';
			$this->data['hitung'] = '';
			$this->data['calon'] = '';
			$this->data['isu'] = '';
			$this->data['kp'] = '';
			$this->data['tr'] = '';
			$this->data['keluarga'] = '';
			$this->data['pengguna'] = '';
			$this->data['analisa'] = '';
			$this->data['sms'] = '';
			$this->data['biaya'] = '';
			$this->data['event'] = '';
			$this->data['halaman'] = 'vsort';
			$this->data['kabupaten'] = $this->Pemilih_m->getkabupaten();
			$this->data['kecamatan'] = $this->Pemilih_m->getkecamatan();
			$this->data['kelurahan'] = $this->Pemilih_m->getkelurahan();

			$this->load->view('_main', $this->data);
		} else {
            redirect('/');
		}
	}

	public function actionsort()
	{
        if(Session::get('username')){
			$this->data['daerah'] = '';
			$this->data['koordinator'] = '';
			$this->data['pemilih'] = 'active';
			$this->data['notifikasi'] = '';
			$this->data['tim'] = '';
			$this->data['saksi'] = '';
			$this->data['relawan'] = '';
			$this->data['quick'] = '';
			$this->data['pengaturan'] = '';
			$this->data['kegiatancalon'] = '';
			$this->data['hitung'] = '';
			$this->data['dpt'] = '';
			$this->data['calon'] = '';
			$this->data['pengguna'] = '';
			$this->data['target'] = '';
			$this->data['isu'] = '';
			$this->data['analisa'] = '';
			$this->data['sms'] = '';
			$this->data['biaya'] = '';
			$this->data['event'] = '';
			$this->data['kp'] = '';
			$this->data['tr'] = '';
			$this->data['listpengaturan'] = $this->Pengaturan_m->tampil();
			$this->data['keluarga'] = '';
			$this->data['halaman'] = 'vactionsort';
			$this->data['kabupaten'] = $this->Pemilih_m->getkabupaten();
			$this->data['kecamatan'] = $this->Pemilih_m->getkecamatan();
			$this->data['kelurahan'] = $this->Pemilih_m->getkelurahan();
			$kabupaten = $this->input->post('kabupaten', true);
			$kecamatan = $this->input->post('kecamatan', true);
			$kelurahan = $this->input->post('kelurahan', true);
			$this->data['grafikkabupaten'] = $this->Pemilih_m->getgrafikkabupaten($kabupaten);
			$this->data['namakabupatenpilih'] = $this->Pemilih_m->getnamakabupatenyangdipilih($kabupaten);
			$this->data['grafikkecamatan'] = $this->Pemilih_m->getgrafikkecamatan($kecamatan);
			$this->data['namakecamatanpilih'] = $this->Pemilih_m->getnamakecamatanyangdipilih($kecamatan);
			$this->data['grafikkelurahan'] = $this->Pemilih_m->getgrafikkelurahan($kelurahan);
			$this->data['namakelurahanpilih'] = $this->Pemilih_m->getnamakelurahanyangdipilih($kelurahan);
			$this->load->view('_main', $this->data);
		} else {
            redirect('/');
		}
	}

	public function grafik()
	{
        if(Session::get('username')){
			$this->data['daerah'] = '';
			$this->data['koordinator'] = '';
			$this->data['pemilih'] = 'active';
			$this->data['notifikasi'] = '';
			$this->data['tim'] = '';
			$this->data['saksi'] = '';
			$this->data['quick'] = '';
			$this->data['hitung'] = '';
			$this->data['calon'] = '';
			$this->data['target'] = '';
			$this->data['isu'] = '';
			$this->data['pengguna'] = '';
			$this->data['analisa'] = '';
			$this->data['relawan'] = '';
			$this->data['dpt'] = '';
			$this->data['kp'] = '';
			$this->data['pengaturan'] = '';
			$this->data['listpengaturan'] = $this->Pengaturan_m->tampil();
			$this->data['tr'] = '';
			$this->data['keluarga'] = '';
			$this->data['kegiatancalon'] = '';
			$this->data['sms'] = '';
			$this->data['biaya'] = '';
			$this->data['event'] = '';
			$this->data['halaman'] = 'vgrafik';
			$this->data['listkabupaten'] = $this->Kabupaten_m->getallkabupaten();
			$this->data['kabupatengrafiklist'] = $this->Pemilih_m->reportkabupaten();
			$this->data['kecamatangrafiklist'] = $this->Pemilih_m->reportkecamatan();
			$this->data['kelurahangrafiklist'] = $this->Pemilih_m->reportkelurahan();
			$this->load->view('_main', $this->data);
		} else {
            redirect('/');
		}
	}

	public function ajax_list()
	{
        if(Session::get('username')){
			if (Session::get('level')== 'admin') {
                $list = DB::table('pemilih')
                    ->leftJoin('dpt','dpt.iddpt','=','pemilih.iddptpemilih')
                    ->leftJoin('kabupaten','kabupaten.kode_district','=','dpt.kabupatendpt')
                    ->leftJoin('kecamatan','kecamatan.kode_subdistrict','=','dpt.kecamatandpt')
                    ->leftJoin('kelurahan','kelurahan.kode_suco','=','dpt.kelurahandpt')
                    ->leftJoin('tps','tps.kode_aldeia','=','dpt.tpsdpt')
                    ->leftJoin('profil','profil.idcaleg','=','pemilih.calonyangdipilih')
                    ->get();



                    $no = 1;
				foreach ($list as $pemilih) {
					$no++;
					$row = array();
					$row[] = $pemilih->namadpt;
					$row[] = $pemilih->tlppemilih;
					//$row[] = $pemilih->namaprovinsi;
					//if ($pemilih->ktppemilih)
					//	$row[] = '<a href="app-assets/ktppemilihupload/'.$pemilih->ktppemilih.'" target="_blank"><img src="app-assets/ktppemilihupload/'.$pemilih->ktppemilih.'" class="profile-user-img img-responsive img-circle " /></a>';
					//else
						$row[] = '(No photo)';
					$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_pemilih(' . "'" . $pemilih->idpemilih . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_pemilih(' . "'" . $pemilih->idpemilih . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
					$data[] = $row;
				}
				$output = array(
					"draw" => 1,
					"recordsTotal" => $no,
					"recordsFiltered" => $no,
					"data" => $data,
				);
				echo json_encode($output);
			} else {

                $list = DB::table('pemilih')
                    ->leftJoin('dpt','dpt.iddpt','=','pemilih.iddptpemilih')
                    ->leftJoin('kabupaten','kabupaten.kode_district','=','dpt.kabupatendpt')
                    ->leftJoin('kecamatan','kecamatan.kode_subdistrict','=','dpt.kecamatandpt')
                    ->leftJoin('kelurahan','kelurahan.kode_suco','=','dpt.kelurahandpt')
                    ->leftJoin('tps','tps.kode_aldeia','=','dpt.tpsdpt')
                    ->leftJoin('profil','profil.idcaleg','=','pemilih.calonyangdipilih')
                    ->get();

				$data = array();
				$no = 0;
				foreach ($list as $pemilih) {
					$no++;
					$row = array();
					$row[] = $pemilih->namadpt;
					$row[] = $pemilih->tlppemilih;
					//	$row[] = $pemilih->namaprovinsi;
					//if ($pemilih->ktppemilih)
					//	$row[] = '<a href="app-assets/ktppemilihupload/'.$pemilih->ktppemilih.'" target="_blank"><img src="app-assets/ktppemilihupload/'.$pemilih->ktppemilih.'" class="profile-user-img img-responsive img-circle " /></a>';
					//else
						$row[] = '(No photo)';
					$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_pemilih(' . "'" . $pemilih->idpemilih . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_pemilih(' . "'" . $pemilih->idpemilih . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
					$data[] = $row;
				}
				$output = array(
					"draw" => 1,
					"recordsTotal" => $no,
					"recordsFiltered" => $no,
					"data" => $data,
				);
				echo json_encode($output);
			}
		} else {
            redirect('/');
		}
	}

	public function ajax_edit($idpemilih)
	{
        $data = DB::table('pemilih')
                ->leftJoin('dpt','dpt.iddpt','=','pemilih.iddptpemilih')
                ->leftJoin('kabupaten','kabupaten.kode_district','=','dpt.kabupatendpt')
                ->leftJoin('kecamatan','kecamatan.kode_subdistrict','=','dpt.kecamatandpt')
                ->leftJoin('kelurahan','kelurahan.kode_suco','=','dpt.kelurahandpt')
                ->leftJoin('tps','tps.kode_aldeia','=','dpt.tpsdpt')
                ->leftJoin('profil','profil.idcaleg','=','pemilih.calonyangdipilih')
                ->where('idpemilih','=', $idpemilih)
                ->get();


		//$data = $this->Pemilih_m->get_by_id($idpemilih);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->form_validation->set_rules('iddptpemilih', 'NIK', 'required|max_length[16]|is_unique[pemilih.iddptpemilih]');
		if ($this->form_validation->run() === true) {
			$data = array(
				'iddptpemilih'			=> $this->input->post('iddptpemilih', TRUE),
				'calonyangdipilih'	=> $this->input->post('calonyangdipilih', TRUE),
				'emailpemilih'			=> $this->input->post('emailpemilih', TRUE),
				'tlppemilih'				=> $this->input->post('tlppemilih', TRUE),
				'fbpemilih'					=> $this->input->post('fbpemilih', TRUE),
				'igpemilih'					=> $this->input->post('igpemilih', TRUE)
			);
			if (!empty($_FILES['ktpaja']['name'])) {
				$upload = $this->_do_upload();
				$data['ktppemilih'] = $upload;
			}

			$insert = $this->Pemilih_m->save($data);
			echo json_encode(array("status" => TRUE));
		} else {
			$errors = validation_errors();
			echo json_encode(['error' => $errors]);
		}
	}

	public function ajax_update()
	{
		$data = array(
			'iddptpemilih'			=> $this->input->post('iddptpemilih', TRUE),
			'calonyangdipilih'	=> $this->input->post('calonyangdipilih', TRUE),
			'emailpemilih'			=> $this->input->post('emailpemilih', TRUE),
			'tlppemilih'				=> $this->input->post('tlppemilih', TRUE),
			'fbpemilih'					=> $this->input->post('fbpemilih', TRUE),
			'igpemilih'					=> $this->input->post('igpemilih', TRUE)
		);

		if ($this->input->post('remove_photo')) // if remove photo checked
		{
			if (file_exists('assets/ktppemilihupload/' . $this->input->post('remove_photo')) && $this->input->post('remove_photo'))
				unlink('assets/ktppemilihupload/' . $this->input->post('remove_photo'));
			$data['ktppemilih'] = '';
		}

		if (!empty($_FILES['ktpaja']['name'])) {
			$upload = $this->_do_upload();
			//delete file
			$person = $this->Pemilih_m->get_by_id($this->input->post('idpemilih'));
			if (file_exists('assets/ktppemilihupload/' . $person->ktppemilih) && $person->ktppemilih)
				unlink('assets/ktppemilihupload/' . $person->ktppemilih);
			$data['ktppemilih'] = $upload;
		}

		$this->Pemilih_m->update(array('idpemilih' => $this->input->post('idpemilih')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($idpemilih)
	{
		//$ada = $this->Pemilih_m->get_by_id($idpemilih);
		//$this->Pemilih_m->delete_by_id($idpemilih);

        $data = DB::table('pemilih')
                ->where('idpemilih', $idpemilih)
                ->get();
		foreach ($data as $ada) {
            $ktp=$ada->ktppemilih;
        }

        $pemilihku = new Pemilih();
        $pemilih = $pemilihku->find($idpemilih);
        $pemilih->delete();

        if(!empty($ktp)){
            if (file_exists('app-assets/ktppemilihupload/' . $ktp) && $ktp)
                unlink('app-assets/ktppemilihupload/' . $ktp);
        }
		echo json_encode(array("status" => TRUE));

        //return redirect('pemilih')->with('pesan','Data Pesanan telah berhasil dihapus');
	}


	public function kirimsms($no_hp = '')
	{
		if (empty($no_hp) || !is_numeric($no_hp)) {
			show_404();
		}
		if ($this->session->userdata('logged_in') != TRUE) {
			redirect('login', 'refresh');
		} else {
			$this->data['daerah'] = '';
			$this->data['koordinator'] = '';
			$this->data['pemilih'] = 'active';
			$this->data['notifikasi'] = '';
			$this->data['relawan'] = '';
			$this->data['saksi'] = '';
			$this->data['calon'] = '';
			$this->data['kegiatancalon'] = '';
			$this->data['tim'] = '';
			$this->data['quick'] = '';
			$this->data['target'] = '';
			$this->data['isu'] = '';
			$this->data['analisa'] = '';
			$this->data['hitung'] = '';
			$this->data['pengaturan'] = '';
			$this->data['pengguna'] = '';
			$this->data['sms'] = '';
			$this->data['listpengaturan'] = $this->Pengaturan_m->tampil();
			$this->data['biaya'] = '';
			$this->data['event'] = '';
			$this->data['kp'] = '';
			$this->data['tr'] = '';
			$this->data['keluarga'] = '';
			$this->data['getid'] = $this->Pemilih_m->getidbyphone($no_hp);
			$this->data['halaman'] = 'vkirim';
			$this->load->view('_main', $this->data);
		}
	}

	public function send()
	{
		//$this->data['Settinglist']=$this->Setting_m->tampil();
		$no_hp = $this->input->post('hp');
		$cekhp = $this->input->post('cekhp');
		if ($no_hp != $cekhp) {
			$this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Pesan Gagal Dikirim,pastikan nomor penerima valid</div></div>");
			redirect('pemilih', 'refresh');
		} else {
			$namakontak = $this->input->post('namapemilih');
			$isi = $this->input->post('pesan');
			$b = str_replace('{nama}', $namakontak, $isi);

			kirim_sms($no_hp, $b);
			$this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Pesan Berhasil Dikirim!</div></div>");
			redirect('pemilih', 'refresh');
		}
	}

	private function _do_upload()
	{
		$config['upload_path']          = 'assets/ktppemilihupload/';
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
		$config['overwrite'] = TRUE;
		$config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('ktpaja')) //upload and validate
		{
			$data['inputerror'][] = 'ktpaja';
			$data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		$image_data = $this->upload->data();
		$config['image_library'] = 'gd2';
		$config['source_image'] = $image_data['full_path'];
		$config['maintain_ratio'] = FALSE;
		$config['wm_text'] = 'snippets-code.com';
		$config['wm_type'] = 'text';
		$config['wm_font_size'] = '12';
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

	public function cetak()
	{
		$query = DB::table('pemilih')
                 ->leftJoin('dpt','dpt.iddpt','=','pemilih.iddptpemilih')
                 ->leftJoin('kabupaten','kabupaten.kode_district','=','dpt.kabupatendpt')
                 ->leftJoin('kecamatan','kecamatan.kode_subdistrict','=','dpt.kecamatandpt')
                 ->leftJoin('kelurahan','kelurahan.kode_suco','=','dpt.kelurahandpt')
                 ->leftJoin('tps','tps.kode_aldeia','=','dpt.tpsdpt')
                 ->leftJoin('profil','profil.idcaleg','=','pemilih.calonyangdipilih')
                 ->get();

        $judulhalaman = 'Daftar Pemilih';
        $judulmodul = 'Daftar Pemilih';
        $no = 1;
        return view('pemilih/pemilih_laporan',compact('query','judulmodul','judulhalaman','no'));
	}

	public function import()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			if ($this->session->userdata('level') == 'admin') {
				$this->data['daerah'] = '';
				$this->data['koordinator'] = '';
				$this->data['relawan'] = '';
				$this->data['pemilih'] = 'active';
				$this->data['kegiatancalon'] = '';
				$this->data['notifikasi'] = '';
				$this->data['target'] = '';
				$this->data['isu'] = '';
				$this->data['tim'] = '';
				$this->data['quick'] = '';
				$this->data['kp'] = '';
				$this->data['tr'] = '';
				$this->data['keluarga'] = '';
				$this->data['pengaturan'] = '';
				$this->data['saksi'] = '';
				$this->data['hitung'] = '';
				$this->data['calon'] = '';
				$this->data['listpengaturan'] = $this->Pengaturan_m->tampil();
				$this->data['dpt'] = '';
				$this->data['pengguna'] = '';
				$this->data['analisa'] = '';
				$this->data['sms'] = '';
				$this->data['biaya'] = '';
				$this->data['event'] = '';
				$this->data['halaman'] = 'vimport';
				$this->data['listkabupaten'] = $this->Kelurahan_m->ambilkecamatanuntukpemilih();
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
						for ($row = 2; $row <= $highestRow; $row++) {	//$idpemilih ='';
							//$ktppemilih='';
							$tpspemilih = '67';
							$pemilihuser = $this->session->userdata('nama');
							$userkode = $this->session->userdata('akses');
							//$provinsipemilih = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
							$namapemilih = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
							$email = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
							$hp = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
							$ttl = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
							$kabupatenpemilih = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
							$kecamatanpemilih = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
							$kelurahanpemilih = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
							$nikpemilih = $worksheet->getCellByColumnAndRow(8, $row)->getValue();

							$data[] = array(
								//'idpemilih'			=>$idpemilih,
								//'ktppemilih'		=>$ktppemilih,
								'pemilihuser'		=> $pemilihuser,
								'userkode'			=> $userkode,
								//'provinsipemilih'	=>$provinsipemilih,
								'namapemilih'		=> $namapemilih,
								'email'				=> $email,
								'hp'				=> $hp,
								'ttl'				=> $ttl,
								'kabupatenpemilih'	=> $kabupatenpemilih,
								'kecamatanpemilih'	=> $kecamatanpemilih,
								'kelurahanpemilih'	=> $kelurahanpemilih,
								'nikpemilih'		=> $nikpemilih,
								'tpspemilih'		=> $tpspemilih
							);
						}
					}

					$this->Pemilih_m->insertimport($data);
					$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Data Berhasil Di Import</h4>
               Data berhasil di Import
            </div>');
					redirect('pemilih', 'refresh');
				}
				/////////////////////
			} else {
				echo "anda bukan admin";
			}
		} else {
			redirect('login', 'refresh');
		}
	}

	public function search()
	{
		// tangkap variabel keyword dari URL
		$keyword = $this->uri->segment(3);
		$statusdpt = '1';
		$dimana = array('nikdpt' => $keyword, 'statusdpt' => $statusdpt);
		// cari di database
		//$data = $this->db->from('dpt')->like('nikdpt',$keyword)->get();
		$this->db->select([
			'dpt.nikdpt',
			'dpt.namadpt',
			'dpt.iddpt',
			'kabupaten.nama_district',
			'kecamatan.nama_subdistrict',
			'kelurahan.nama_suco',
			'tps.nama_aldeia'
		]);
		$this->db->from('dpt');
		$this->db->join('kabupaten', 'kabupaten.kode_district=dpt.kabupatendpt');
		$this->db->join('kecamatan', 'kecamatan.kode_subdistrict=dpt.kecamatandpt');
		$this->db->join('kelurahan', 'kelurahan.kode_suco=dpt.kelurahandpt');
		$this->db->join('tps', 'tps.kode_aldeia=dpt.tpsdpt');
		$this->db->like($dimana);
		$query = $this->db->get();

		$arr = array();
		// format keluaran di dalam array
		foreach ($query->result() as $row) {
			$arr['query'] = $keyword;
			$arr['suggestions'][] = array(
				'value'	=> $row->nikdpt,
				'namadpt'	=> $row->namadpt,
				'iddpt'	=> $row->iddpt,
				//'provinsipemilih'	=>$row->namaprovinsi,
				'kabupatenpemilih'	=> $row->nama_district,
				'kecamatanpemilih'	=> $row->nama_subdistrict,
				'kelurahanpemilih'	=> $row->nama_suco,
				'tpspemilih'	=> $row->nama_aldeia,
				'iddptpemilih'	=> $row->iddpt
			);
		}
		// // print_r($arr);
		echo json_encode($arr);

		// if (isset($_POST["query"])) {
		// 	$output = '';
		// 	$key = $_POST["query"];
		// 	// $query = "SELECT * FROM provinsi WHERE nama LIKE ? LIMIT 10";
		// 	// $dewan1 = $db1->prepare($query);
		// 	// $dewan1->bind_param('s', $key);
		// 	// $dewan1->execute();
		// 	// $res1 = $dewan1->get_result();

		// 	$output = '';
		// 	$this->db->select([
		// 		'dpt.nikdpt',
		// 		'dpt.namadpt',
		// 		'dpt.iddpt',
		// 		'kabupaten.nama_district',
		// 		'kecamatan.nama_subdistrict',
		// 		'kelurahan.nama_suco',
		// 		'tps.nama_aldeia'
		// 	]);
		// 	$this->db->from('dpt');
		// 	$this->db->join('kabupaten', 'kabupaten.kode_district=dpt.kabupatendpt');
		// 	$this->db->join('kecamatan', 'kecamatan.kode_subdistrict=dpt.kecamatandpt');
		// 	$this->db->join('kelurahan', 'kelurahan.kode_suco=dpt.kelurahandpt');
		// 	$this->db->join('tps', 'tps.kode_aldeia=dpt.tpsdpt');
		// 	$this->db->like('dpt.nikdpt', $key);
		// 	// $this->db->like($dimana);
		// 	$query = $this->db->get();

		// 	$output = '<ul class="list-unstyled auto_load">';
		// 	if ($query->num_rows() > 0) {
		// 		foreach ($query->result() as $row) {
		// 			$output .= '<li class="auto_load">' . $row->nikdpt . ' | ' . $row->namadpt . '</li>';
		// 		}
		// 	} else {
		// 		$output .= '<li class="auto_load">Tidak ada yang cocok.</li>';
		// 	}
		// 	$output .= '</ul>';
		// 	echo $output;
		// }
	}
//end of class
}
