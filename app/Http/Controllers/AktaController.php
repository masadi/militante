<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Akta;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class AktaController extends Controller
{
    public function index() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'DPT';
            $judulmodul = 'DPT';
            $akta = new Akta();
            $query = $akta->orderBy('iddpt','DESC')->get();
            return view('akta/akta_index',compact('query','judulmodul','judulhalaman'));
        }
    }

	public function indexx()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			$keyword = $this->uri->segment(3);
			$this->data['daerah'] = '';
			$this->data['koordinator'] = '';
			$this->data['listpengaturan'] = $this->Pengaturan_m->tampil();
			$this->data['dpt'] = 'active';
			$this->data['kp'] = '';
			$this->data['tr'] = '';
			$this->data['keluarga'] = '';
			$this->data['pemilih'] = '';
			$this->data['isu'] = '';
			$this->data['target'] = '';
			$this->data['pengaturan'] = '';
			$this->data['notifikasi'] = '';
			$this->data['tim'] = '';
			$this->data['saksi'] = '';
			$this->data['quick'] = '';
			$this->data['hitung'] = '';
			$this->data['calon'] = '';
			$this->data['pengguna'] = '';
			$this->data['relawan'] = '';
			$this->data['kegiatancalon'] = '';
			$this->data['analisa'] = '';
			$this->data['sms'] = '';
			$this->data['biaya'] = '';
			$this->data['event'] = '';
			$this->data['halaman'] = 'vdpt';
			$this->data['listkabupaten'] = $this->Dpt_m->getallkabupaten();
			$this->data['listcalon'] = $this->Kabupaten_m->getallcalon();
			$this->data['jumlahhasil'] = $this->Dpt_m->jumlahhasil();
			$this->load->view('_main', $this->data);
		} else {
			redirect('login', 'refresh');
		}
	}

    public function ajax_list()
	{
        if(Session::get('username')){
            $list = DB::table('dpt')
                ->leftJoin('kabupaten','kabupaten.kode_district','=','dpt.kabupatendpt')
                ->leftJoin('kecamatan','kecamatan.kode_subdistrict','=','dpt.kecamatandpt')
                ->leftJoin('kelurahan','kelurahan.kode_suco','=','dpt.kelurahandpt')
                ->leftJoin('tps','tps.kode_aldeia','=','dpt.tpsdpt')
                ->orderBy('dpt.iddpt','DESC')
                ->get();

			$data = array();
			$no = 0;
			foreach ($list as $dpt) {
				$no++;
				$row = array();
				if ($dpt->statusdpt == '1') {
					$row[] = '<span class="btn btn-sm btn-success"><i class="fa fa-check"></i> Disetujui</span>';
				} else {
					$row[] = '<span class="btn btn-sm btn-warning"><i class="fa fa-trash"></i> belum Disetujui</span>  ';
				}
				if ($dpt->ditambahkanoleh >= '1') {
					$row[] = '<span class="btn btn-sm btn-success"><i class="fa fa-user"></i> ' . $dpt->ditambahkanoleh . '</span>';
				} else {
					$row[] = '<span class="btn btn-sm btn-warning"><i class="fa fa-trash"></i> mendaftar dari aplikasi</span>  ';
				}
				$row[] = $dpt->nama_district;
				$row[] = $dpt->nama_subdistrict;
				$row[] = $dpt->nama_suco;
				$row[] = $dpt->nama_aldeia;
				$row[] = $dpt->nikdpt;
				$row[] = $dpt->namadpt;
				$row[] = $dpt->tempatlahirdpt;
				$row[] = $dpt->ttldpt;
				$row[] = $dpt->statusperkawinandpt;
				$row[] = $dpt->jkdpt;
				$row[] = $dpt->alamatdpt;
				// $row[] = $dpt->disabilitasdpt;
				$row[] = $dpt->ketdpt;
				$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_dpt(' . "'" . $dpt->iddpt . "'" . ')"><i class="fa fa-edit"></i> Edit</a> <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_dpt(' . "'" . $dpt->iddpt . "'" . ')"><i class="fa fa-trash"></i> Delete</a>';
				$data[] = $row;
			}
			$output = array(
				"draw" =>  1,
				"recordsTotal" => $no,
				"recordsFiltered" =>$no,
				"data" => $data,
			);
			echo json_encode($output);
		} else {
			redirect('/');
		}
	}

	public function ajax_edit($iddpt)
	{
        $akta = new Akta();
		$data=$akta->find($iddpt);
		//$data = $this->Dpt_m->get_by_id($iddpt);
		echo json_encode($data);
	}

	public function ajax_add(Request $request)
	{
		//$this->form_validation->set_rules('nikdpt', 'NIK', 'required|max_length[16]|is_unique[dpt.nikdpt]');
        //$this->validate($request, [
        //    'nikdpt'=> 'required|max_length[16]|is_unique[dpt.nikdpt]',
        //]);
		/*if ($this->form_validation->run() === true) {
			$tanggallahir = $this->input->post('ttldpt');
			if(Session::get('username')){
				$nama = Session::get('nama');
			} else {
				$nama = 'mendaftar dari aplikasi';
			}
			$ttl = date('Y-m-d', strtotime($tanggallahir));
			$data = array(
				'kabupatendpt'				=> $this->input->post('kabupatendpt', TRUE),
				'kecamatandpt'				=> $this->input->post('kecamatandpt', TRUE),
				'kelurahandpt'				=> $this->input->post('kelurahandpt', TRUE),
				'tpsdpt'							=> $this->input->post('tpsdpt', TRUE),
				'nikdpt'							=> $this->input->post('nikdpt', TRUE),
				'namadpt'         		=> $this->input->post('namadpt', TRUE),
				'tempatlahirdpt'			=> $this->input->post('tempatlahirdpt', TRUE),
				'ttldpt'							=> $ttl,
				'statusperkawinandpt'	=> $this->input->post('statusperkawinandpt', TRUE),
				'jkdpt'								=> $this->input->post('jkdpt', TRUE),
				'alamatdpt'						=> $this->input->post('alamatdpt', TRUE),
				// 'disabilitasdpt'			=> $this->input->post('disabilitasdpt', TRUE),
				'ketdpt'							=> $this->input->post('ketdpt', TRUE),
				'statusdpt'						=> $this->input->post('statusdpt', TRUE),
				'ditambahkanoleh' 		=> $nama
			);
			$insert = $this->Dpt_m->save($data);
			echo json_encode(array("status" => TRUE));
		} else {
			$errors = validation_errors();
			echo json_encode(['error' => $errors]);
		}*/
        if(Session::get('username')){
			$nama = Session::get('nama');
        } else {
			$nama = 'mendaftar dari aplikasi';
		}

        $tanggallahir = $request->ttldpt;
        $ttl = date('Y-m-d', strtotime($tanggallahir));

        $kabupatendpt = $request->kabupatendpt;
        $kecamatandpt = $request->kecamatandpt;
        $kelurahandpt = $request->kelurahandpt;
        $tpsdpt = $request->tpsdpt;
        $nikdpt = $request->nikdpt;
        $namadpt = $request->namadpt;
        $tempatlahirdpt = $request->tempatlahirdpt;
        $ttldpt = $request->ttl;
        $statusperkawinandpt = $request->statusperkawinandpt;
        $jkdpt = $request->jkdpt;
        $alamatdpt = $request->alamatdpt;
        $ketdpt = $request->ketdpt;
        $statusdpt = $request->statusdpt;
        $ditambahkanoleh = $nama;


        $dpt = new Akta();
        $dpt->kabupatendpt = $kabupatendpt;
        $dpt->kecamatandpt = $kecamatandpt;
        $dpt->kelurahandpt = $kelurahandpt;
        $dpt->tpsdpt = $tpsdpt;
        $dpt->nikdpt = $nikdpt;
        $dpt->namadpt = $namadpt;
        $dpt->tempatlahirdpt = $tempatlahirdpt;
        $dpt->ttldpt = $request->ttldpt;
        $dpt->statusperkawinandpt = $statusperkawinandpt;
        $dpt->jkdpt = $jkdpt;
        $dpt->alamatdpt = $alamatdpt;
        $dpt->ketdpt = $ketdpt;
        $dpt->statusdpt = $statusdpt;
        $dpt->ditambahkanoleh = $ditambahkanoleh;
        $dpt->save();

        echo json_encode(array("status" => TRUE));
        //return redirect('dpt')->with('pesaninfo','Data DPT telah berhasil disimpan');
	}

	public function ajax_update(Request $request)
	{
		/*$tanggallahir = $this->input->post('ttldpt');
		$ttl 					= date('Y-m-d', strtotime($tanggallahir));
		$data = array(
			'kabupatendpt'				=> $this->input->post('kabupatendpt', TRUE),
			'kecamatandpt'				=> $this->input->post('kecamatandpt', TRUE),
			'kelurahandpt'				=> $this->input->post('kelurahandpt', TRUE),
			'tpsdpt'							=> $this->input->post('tpsdpt', TRUE),
			'nikdpt'							=> $this->input->post('nikdpt', TRUE),
			'namadpt'         		=> $this->input->post('namadpt', TRUE),
			'tempatlahirdpt'			=> $this->input->post('tempatlahirdpt', TRUE),
			'ttldpt'							=> $ttl,
			'statusperkawinandpt'	=> $this->input->post('statusperkawinandpt', TRUE),
			'jkdpt'								=> $this->input->post('jkdpt', TRUE),
			'alamatdpt'						=> $this->input->post('alamatdpt', TRUE),
			// 'disabilitasdpt'			=> $this->input->post('disabilitasdpt', TRUE),
			'ketdpt'							=> $this->input->post('ketdpt', TRUE),
			'statusdpt'						=> $this->input->post('statusdpt', TRUE)
		);

		$this->Dpt_m->update(array('iddpt' => $this->input->post('iddpt')), $data);
		echo json_encode(array("status" => TRUE));*/

        if(Session::get('username')){
			$nama = Session::get('nama');
        } else {
			$nama = 'mendaftar dari aplikasi';
		}

        $kabupatendpt = $request->kabupatendpt;
        $kecamatandpt = $request->kecamatandpt;
        $kelurahandpt = $request->kelurahandpt;
        $tpsdpt = $request->tpsdpt;
        $nikdpt = $request->nikdpt;
        $namadpt = $request->namadpt;
        $tempatlahirdpt = $request->tempatlahirdpt;
        $ttldpt = $request->ttl;
        $statusperkawinandpt = $request->statusperkawinandpt;
        $jkdpt = $request->jkdpt;
        $alamatdpt = $request->alamatdpt;
        $ketdpt = $request->ketdpt;
        $statusdpt = $request->statusdpt;
        $ditambahkanoleh = $nama;


        $dptku = new Akta();
        $dpt=$dptku->find($request->iddpt);
        $dpt->kabupatendpt = $kabupatendpt;
        $dpt->kecamatandpt = $kecamatandpt;
        $dpt->kelurahandpt = $kelurahandpt;
        $dpt->tpsdpt = $tpsdpt;
        $dpt->nikdpt = $nikdpt;
        $dpt->namadpt = $namadpt;
        $dpt->tempatlahirdpt = $tempatlahirdpt;
        $dpt->ttldpt = $request->ttldpt;
        $dpt->statusperkawinandpt = $statusperkawinandpt;
        $dpt->jkdpt = $jkdpt;
        $dpt->alamatdpt = $alamatdpt;
        $dpt->ketdpt = $ketdpt;
        $dpt->statusdpt = $statusdpt;
        $dpt->ditambahkanoleh = $ditambahkanoleh;
        $dpt->save();

        echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($iddpt)
	{
		//     $ada=$this->Dpt_m->get_by_id($iddpt);
		//$this->Dpt_m->delete_by_id($iddpt);
		//echo json_encode(array("status" => TRUE));


        $dptku = new Akta();
        $dpt = $dptku->find($iddpt);
        $dpt->delete();
		echo json_encode(array("status" => TRUE));
	}

	public function cetak()
	{
		$data['judul'] = "Daftar Pemilih Tetap";
		$data['ambildata'] = $this->Dpt_m->tampil();
		$this->load->helper('dompdf');
		$view_file = $this->load->view('dpt_pdf', $data, true);
		pdf_create($view_file, 'Daftar Pemilih');
	}

	public function import()
	{
		if(Session::get('username')){
			if ($this->session->userdata('level') == 'admin') {
				$this->data['daerah'] = '';
				$this->data['koordinator'] = '';
				$this->data['relawan'] = '';
				$this->data['pemilih'] = '';
				$this->data['kegiatancalon'] = '';
				$this->data['notifikasi'] = '';
				$this->data['target'] = '';
				$this->data['isu'] = '';
				$this->data['tim'] = '';
				$this->data['quick'] = '';
				$this->data['saksi'] = '';
				$this->data['hitung'] = '';
				$this->data['calon'] = '';
				$this->data['dpt'] = 'active';
				$this->data['pengaturan'] = '';
				$this->data['pengguna'] = '';
				$this->data['analisa'] = '';
				$this->data['listpengaturan'] = $this->Pengaturan_m->tampil();
				$this->data['sms'] = '';
				$this->data['biaya'] = '';
				$this->data['event'] = '';
				$this->data['kp'] = '';
				$this->data['tr'] = '';
				$this->data['keluarga'] = '';
				$this->data['halaman'] = 'vimport';
				$this->data['listkabupaten'] = $this->Kelurahan_m->ambilkecamatanuntukdptimport();
				$this->load->view('_main', $this->data);
			} else {
				echo "anda bukan admin";
			}
		} else {
			redirect('/');
		}
	}

	public function saveimport()
	{
		if(Session::get('username')){
			if ($this->session->userdata('level') == 'admin') {
				if (isset($_FILES["file"]["name"])) {
					$path = $_FILES["file"]["tmp_name"];
					$object = PHPExcel_IOFactory::load($path);
					foreach ($object->getWorksheetIterator() as $worksheet) {
						$highestRow = $worksheet->getHighestRow();
						$highestColumn = $worksheet->getHighestColumn();
						for ($row = 2; $row <= $highestRow; $row++) {
							$kabupatendpt 				= $worksheet->getCellByColumnAndRow(1, $row)->getValue();
							$kecamatandpt 				= $worksheet->getCellByColumnAndRow(2, $row)->getValue();
							$kelurahandpt 				= $worksheet->getCellByColumnAndRow(3, $row)->getValue();
							$tpsdpt 							= $worksheet->getCellByColumnAndRow(4, $row)->getValue();
							$kkdpt 								= $worksheet->getCellByColumnAndRow(5, $row)->getValue();
							$nikdpt 							= $worksheet->getCellByColumnAndRow(6, $row)->getValue();
							$namadpt 							= $worksheet->getCellByColumnAndRow(7, $row)->getValue();
							$tempatlahirdpt 			= $worksheet->getCellByColumnAndRow(8, $row)->getValue();
							$ttldpt 							= $worksheet->getCellByColumnAndRow(9, $row)->getValue();
							$statusperkawinandpt	= $worksheet->getCellByColumnAndRow(10, $row)->getValue();
							$jkdpt 								= $worksheet->getCellByColumnAndRow(11, $row)->getValue();
							$alamatdpt 						= $worksheet->getCellByColumnAndRow(12, $row)->getValue();
							$disabilitasdpt 			= $worksheet->getCellByColumnAndRow(13, $row)->getValue();
							$ketdpt 							= $worksheet->getCellByColumnAndRow(14, $row)->getValue();
							$data[] = array(
								'kabupatendpt'				=> $kabupatendpt,
								'kecamatandpt'				=> $kecamatandpt,
								'kelurahandpt'				=> $kelurahandpt,
								'tpsdpt'							=> $tpsdpt,
								'kkdpt'								=> $kkdpt,
								'nikdpt'							=> $nikdpt,
								'namadpt'							=> $namadpt,
								'tempatlahirdpt'			=> $tempatlahirdpt,
								'ttldpt'							=> $ttldpt,
								'statusperkawinandpt'	=> $statusperkawinandpt,
								'jkdpt'								=> $jkdpt,
								'alamatdpt'						=> $alamatdpt,
								'disabilitasdpt'			=> $disabilitasdpt,
								'ketdpt'							=> $ketdpt,
								'ditambahkanoleh' 		=> 'admin'
							);
						}
					}
					$this->Dpt_m->insertimport($data);
					$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Data Berhasil Di Import</h4>Data berhasil di Import</div>');
					redirect('dpt', 'refresh');
				}
			} else {
				echo "anda bukan admin";
			}
		} else {
			redirect('/');
		}
	}

	public function caridpt()
	{
		$nikdpt = $this->input->post('nikdpt');
		$statusdpt = '1';
		$cariya = array('nikdpt' => $nikdpt, 'statusdpt' => $statusdpt);
		$dpt = $this->Dpt_m->caridpt($cariya);

		if (!empty($dpt)) { // Jika data siswa ada/ditemukan
			$callback = array(
				'status' 				=> 'success', // Set array status dengan success
				'namadpt' 			=> $dpt->namadpt,
				'kabupatendpt' 	=> $dpt->nama_district,
				'kecamatandpt' 	=> $dpt->namakecamatan,
				'kelurahandpt' 	=> $dpt->namakelurahan,
				'tpsdpt' 				=> $dpt->namatps,
				'iddpt'	 				=> $dpt->iddpt,
			);
		} else {
			$callback = array('status' => 'failed'); // set array status dengan failed
		}
		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}

	public function ajax_add_dpt()
	{
		$this->form_validation->set_rules('nikdptdaftar', 'NIK', 'required|max_length[16]|is_unique[dpt.nikdpt]');

		if ($this->form_validation->run() === true) {
			$tanggallahir = $this->input->post('ttldptdaftar');
			$ttl = date('Y-m-d', strtotime($tanggallahir));
			$data = array(
				'kabupatendpt'					=> $this->input->post('kabupatendptdaftar', TRUE),
				'kecamatandpt'					=> $this->input->post('kecamatandptdaftar', TRUE),
				'kelurahandpt'					=> $this->input->post('kelurahandptdaftar', TRUE),
				'tpsdpt'								=> $this->input->post('tpsdptdaftar', TRUE),
				'nikdpt'								=> $this->input->post('nikdptdaftar', TRUE),
				'namadpt'        				=> $this->input->post('namadptdaftar', TRUE),
				'tempatlahirdpt'				=> $this->input->post('tempatlahirdptdaftar', TRUE),
				'ttldpt'								=> $ttl,
				'statusperkawinandpt'		=> $this->input->post('statusperkawinandptdaftar', TRUE),
				'jkdpt'									=> $this->input->post('jkdptdaftar', TRUE),
				'alamatdpt'							=> $this->input->post('alamatdptdaftar', TRUE),
				'disabilitasdpt'				=> $this->input->post('disabilitasdptdaftar', TRUE),
				'ketdpt'								=> $this->input->post('ketdptdaftar', TRUE),
				'statusdpt'							=> '0'
			);
			$insert = $this->Dpt_m->save($data);
			echo json_encode(array("status" => TRUE));
		} else {
			$errors = validation_errors();
			echo json_encode(['error' => $errors]);
		}
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
