<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class CalonController extends Controller
{
    public function index() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'CALON';
            $judulmodul = 'Calon';
            $calon = new Calon();
            $query = $calon->orderBy('idcaleg','DESC')->get();
            return view('presiden/presiden_index',compact('query','judulmodul','judulhalaman'));
        }
    }


 	public function ajax_list()
    {


        $calon = new Calon();
        $list = $calon->orderBy('idcaleg','DESC')->get();
        $data = array();
        $no = 0;
        foreach ($list as $calon) {
            $no++;
            $row = array();
            $row[] = $calon->defaultcalon;
            $row[] = $calon->namacaleg;
            $row[] = $calon->wakilcaleg;
            $row[] = $calon->hpcalon;
            $row[] = $calon->hpwakilcalon;
            $row[] =substr($calon->visi, 0,10)."..";

            $row[] = "<ol>".substr($calon->misi1, 0,10)."..</ol>".
            "<ol>".substr($calon->misi2, 0,10)."..</ol>".
            "<ol>".substr($calon->misi3, 0,10)."..</ol>".
            "<ol>".substr($calon->misi4, 0,10)."..</ol>";

            if($calon->potocaleg)
                $row[] = '<a href="app-assets/potocalegroot/'.$calon->potocaleg.'" target="_blank"><img src="app-assets/potocalegroot/'.$calon->potocaleg.'" class="img-fluid" /></a>';
            else
                $row[] = '(No photo)';

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_calon('."'".$calon->idcaleg."'".')"><i class="fa fa-edit"></i> Edit</a>
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_calon('."'".$calon->idcaleg."'".')"><i class="fa fa-trash"></i> Hapus</a>
                  ';

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
     public function ajax_edit($idcaleg)
    {

        $calon = new Calon();
        $data = $calon->find($idcaleg);

        echo json_encode($data);
    }
    public function ajax_add(Request $request)
    {
        /*$data = array(
                'namacaleg' => $this->input->post('namacaleg'),
                'defaultcalon' => $this->input->post('defaultcalon'),
                'wakilcaleg' => $this->input->post('wakilcaleg'),
                'biodatacaleg' => $this->input->post('biodatacaleg'),
                'biodatawakilcaleg' => $this->input->post('biodatawakilcaleg'),
                'visi' => $this->input->post('visi'),
                'misi1' => $this->input->post('misi1'),
                'misi2' => $this->input->post('misi2'),
                'misi3' => $this->input->post('misi3'),
                'misi4' => $this->input->post('misi4'),


                 'hpcalon' => $this->input->post('hpcalon'),
                'hpwakilcalon' => $this->input->post('hpwakilcalon')
            );

        if(!empty($_FILES['potocaleg']['name']))
        {
            $upload = $this->_do_upload();
            $data['potocaleg'] = $upload;
        }

        $insert = $this->Calon_m->save($data);

        echo json_encode(array("status" => TRUE));*/


            $namacaleg = $request->namacaleg;
            $defaultcalon = $request->defaultcalon;
            $wakilcaleg = $request->wakilcaleg;
            $biodatacaleg = $request->biodatacaleg;
            $biodatawakilcaleg = $request->biodatawakilcaleg;
            $visi = $request->visi;
            $misi1 = $request->misi1;
            $misi2 = $request->misi2;
            $misi3 = $request->misi3;
            $misi4 = $request->misi4;

            $calon = new Calon();
            $calon->namacaleg = $namacaleg;
            $calon->defaultcalon = $defaultcalon;
            $calon->wakilcaleg = $wakilcaleg;
            $calon->biodatacaleg = $biodatacaleg;
            $calon->biodatawakilcaleg = $biodatawakilcaleg;
            $calon->visi = $visi;
            $calon->misi1 = $misi1;
            $calon->misi2 = $misi2;
            $calon->misi3 = $misi3;
            $calon->misi4 = $misi4;
            $calon->save();

            echo json_encode(array("status" => TRUE));
    }
    public function ajax_update(Request $request)
    {

        /*$data = array(
               'namacaleg' => $this->input->post('namacaleg'),
               'defaultcalon' => $this->input->post('defaultcalon'),
               'wakilcaleg' => $this->input->post('wakilcaleg'),
               'biodatacaleg' => $this->input->post('biodatacaleg'),
               'biodatawakilcaleg' => $this->input->post('biodatawakilcaleg'),
                'visi' => $this->input->post('visi'),
                'misi1' => $this->input->post('misi1'),
                'misi2' => $this->input->post('misi2'),
                'misi3' => $this->input->post('misi3'),
                'misi4' => $this->input->post('misi4'),


                'hpcalon' => $this->input->post('hpcalon'),
                'hpwakilcalon' => $this->input->post('hpwakilcalon')
            );

        if($this->input->post('remove_photo')) // if remove photo checked
        {
            if(file_exists('assets/potocalegroot/'.$this->input->post('remove_photo')) && $this->input->post('remove_photo'))
                unlink('assets/potocalegroot/'.$this->input->post('remove_photo'));
            $data['potocaleg'] = '';
        }

        if(!empty($_FILES['potocaleg']['name']))
        {
            $upload = $this->_do_upload();

            //delete file
            $calon = $this->Calon_m->get_by_id($this->input->post('idcaleg'));
            if(file_exists('assets/potocalegroot/'.$calon->potocaleg) && $calon->potocaleg)
                unlink('assets/potocalegroot/'.$calon->potocaleg);

            $data['potocaleg'] = $upload;
        }

        $this->Calon_m->update(array('idcaleg' => $this->input->post('idcaleg')), $data);
        echo json_encode(array("status" => TRUE));*/


            $namacaleg = $request->namacaleg;
            $defaultcalon = $request->defaultcalon;
            $wakilcaleg = $request->wakilcaleg;
            $biodatacaleg = $request->biodatacaleg;
            $biodatawakilcaleg = $request->biodatawakilcaleg;
            $visi = $request->visi;
            $misi1 = $request->misi1;
            $misi2 = $request->misi2;
            $misi3 = $request->misi3;
            $misi4 = $request->misi4;
            $hpcalon = $request->hpcalon;
            $hpwakilcalon = $request->hpwakilcalon;

            $calonku = new Calon();
            $calon=$calonku->find($request->idcaleg);
            $calon->namacaleg = $namacaleg;
            $calon->defaultcalon = $defaultcalon;
            $calon->wakilcaleg = $wakilcaleg;
            $calon->biodatacaleg = $biodatacaleg;
            $calon->biodatawakilcaleg = $biodatawakilcaleg;
            $calon->visi = $visi;
            $calon->misi1 = $misi1;
            $calon->misi2 = $misi2;
            $calon->misi3 = $misi3;
            $calon->misi4 = $misi4;
            $calon->hpcalon = $hpcalon;
            $calon->hpwakilcalon = $hpwakilcalon;
            $calon->save();
        echo json_encode(array("status" => TRUE));
    }
    public function ajax_delete($idcaleg)
    {
        //delete file
        $calonx = new Calon();
        $calon = $calonx->find($idcaleg);
        if(file_exists('assets/potocalegroot/'.$calon->potocaleg) && $calon->potocaleg)
            unlink('assets/potocalegroot/'.$calon->potocaleg);

        $calon->delete();
        echo json_encode(array("status" => TRUE));
    }
    private function _do_upload()
    {
        $config['upload_path']  = 'app-assets/potocalegroot/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|JPG';
        $config['overwrite']=TRUE;

        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('potocaleg')) //upload and validate
        {
            $data['inputerror'][] = 'potocaleg';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        $image_data = $this->upload->data();
        $config['image_library'] = 'gd2';
        $config['source_image'] = $image_data['full_path'];
        $config['maintain_ratio'] = FALSE;
        $config['wm_text']='snippets-code.com';
        $config['wm_type']='text';
        $config['wm_font_size']='12';
        $config['width'] = 450;
        $config['height'] = 574;
        $this->load->library('image_lib', $config);

        return $this->upload->data('file_name');
    }






/*
    public function create() {
        if(Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Kelola Data Produk - Sistem Informasi Manajemen Percetakan';
            $judulmodul = 'Tambah Data Produk';
            return view('produk/produk_create',compact('judulmodul','judulhalaman'));
        }

    }


    public function store(Request $request) {

        $barang = new Barang();
        $barang->nama_barang = $request->nama;
        $barang->kode_barang = $request->kode;
        $barang->harga_jual = $request->harga;

        if(empty($request->hargapromo)) $barang->harga_promo =  0;
        else $barang->harga_promo = $request->hargapromo;

        $barang->satuan = $request->satuan;
        $barang->save();
        $idbarang= $barang->id;

        if(empty($request->minorder1)){ $request->minorder1=0; $request->hargagrosir1; }

            $harga = new Hargagrosir();

            $harga->id_barang = $idbarang;
            $harga->min_order1 = $request->minorder1;
            $harga->harga1 = $request->hargagrosir1;

            $harga->min_order2 = $request->minorder2;
            $harga->harga2 = $request->hargagrosir2;

            $harga->min_order3 = $request->minorder3;
            $harga->harga3 = $request->hargagrosir3;

            $harga->min_order4 = $request->minorder4;
            $harga->harga4 = $request->hargagrosir4;

            $harga->min_order5 = $request->minorder5;
            $harga->harga5 = $request->hargagrosir5;

            $harga->min_order6 = $request->minorder6;
            $harga->harga6 = $request->hargagrosir6;

            $harga->min_order8 = $request->minorder8;
            $harga->harga8 = $request->hargagrosir8;
            $harga->min_order7 = $request->minorder7;
            $harga->harga7 = $request->hargagrosir7;
            $harga->min_order9 = $request->minorder9;
            $harga->harga9 = $request->hargagrosir9;
            $harga->min_order10 = $request->minorder10;
            $harga->harga10 = $request->hargagrosir10;
            $harga->min_order11 = $request->minorder11;
            $harga->harga11 = $request->hargagrosir11;
            $harga->min_order12 = $request->minorder12;
            $harga->harga12 = $request->hargagrosir12;
            $harga->min_order13 = $request->minorder13;
            $harga->harga13 = $request->hargagrosir13;
            $harga->min_order14 = $request->minorder14;
            $harga->harga14 = $request->hargagrosir14;
            $harga->min_order15 = $request->minorder15;
            $harga->harga15 = $request->hargagrosir15;
            $harga->min_order16 = $request->minorder16;
            $harga->harga16 = $request->hargagrosir16;
            $harga->min_order17 = $request->minorder17;
            $harga->harga17 = $request->hargagrosir17;
            $harga->min_order18 = $request->minorder18;
            $harga->harga18 = $request->hargagrosir18;
            $harga->min_order19 = $request->minorder19;
            $harga->harga19 = $request->hargagrosir19;
            $harga->min_order20 = $request->minorder20;
            $harga->harga20 = $request->hargagrosir20;
            $harga->min_order21 = $request->minorder21;
            $harga->harga21 = $request->hargagrosir21;
            $harga->min_order22 = $request->minorder22;
            $harga->harga22 = $request->hargagrosir22;
            $harga->min_order23 = $request->minorder23;
            $harga->harga23 = $request->hargagrosir23;
            $harga->min_order24 = $request->minorder24;
            $harga->harga24 = $request->hargagrosir24;
            $harga->min_order25 = $request->minorder25;
            $harga->harga25 = $request->hargagrosir25;

            $harga->save();


        return redirect('produk')->with('pesan','Simpan Data berhasil.');
    }


    public function edit($id) {
        if(Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Kelola Data Produk - Sistem Informasi Manajemen Percetakan';
            $judulmodul = 'Update Data Produk';
            $barang = new Barang();
            $query = $barang->find($id);
            $hargamodel = new Hargagrosir();
            $harga = $hargamodel->where('id_barang',$id)->first();



            return view('produk/produk_edit',compact('judulmodul','judulhalaman','query','harga'));
        }
    }


    public function update(Request $request) {
        $id = $request->id;

        $barang = new Barang();
        $ubah = $barang->find($id);
        $ubah->nama_barang = $request->nama;
        $ubah->kode_barang = $request->kode;
        $ubah->harga_jual = $request->harga;

        if(empty($request->hargapromo)) $barang->harga_promo =  0;
        else $barang->harga_promo = $request->hargapromo;


        $ubah->satuan = $request->satuan;
        $ubah->save();

        $hargamodel = new Hargagrosir();
        $harga = $hargamodel->findOrFail($request->idgrosir);

        if(empty($request->minorder1)){ $request->minorder1=0; $request->hargagrosir1; }

        $harga->min_order1 = $request->minorder1;
        $harga->harga1 = $request->hargagrosir1;

        $harga->min_order2 = $request->minorder2;
        $harga->harga2 = $request->hargagrosir2;

        $harga->min_order3 = $request->minorder3;
        $harga->harga3 = $request->hargagrosir3;

        $harga->min_order4 = $request->minorder4;
        $harga->harga4 = $request->hargagrosir4;

        $harga->min_order5 = $request->minorder5;
        $harga->harga5 = $request->hargagrosir5;

        $harga->min_order6 = $request->minorder6;
        $harga->harga6 = $request->hargagrosir6;

        $harga->min_order8 = $request->minorder8;
        $harga->harga8 = $request->hargagrosir8;
        $harga->min_order7 = $request->minorder7;
        $harga->harga7 = $request->hargagrosir7;
        $harga->min_order9 = $request->minorder9;
        $harga->harga9 = $request->hargagrosir9;
        $harga->min_order10 = $request->minorder10;
        $harga->harga10 = $request->hargagrosir10;
        $harga->min_order11 = $request->minorder11;
        $harga->harga11 = $request->hargagrosir11;
        $harga->min_order12 = $request->minorder12;
        $harga->harga12 = $request->hargagrosir12;
        $harga->min_order13 = $request->minorder13;
        $harga->harga13 = $request->hargagrosir13;
        $harga->min_order14 = $request->minorder14;
        $harga->harga14 = $request->hargagrosir14;
        $harga->min_order15 = $request->minorder15;
        $harga->harga15 = $request->hargagrosir15;
        $harga->min_order16 = $request->minorder16;
        $harga->harga16 = $request->hargagrosir16;
        $harga->min_order17 = $request->minorder17;
        $harga->harga17 = $request->hargagrosir17;
        $harga->min_order18 = $request->minorder18;
        $harga->harga18 = $request->hargagrosir18;
        $harga->min_order19 = $request->minorder19;
        $harga->harga19 = $request->hargagrosir19;
        $harga->min_order20 = $request->minorder20;
        $harga->harga20 = $request->hargagrosir20;
        $harga->min_order21 = $request->minorder21;
        $harga->harga21 = $request->hargagrosir21;
        $harga->min_order22 = $request->minorder22;
        $harga->harga22 = $request->hargagrosir22;
        $harga->min_order23 = $request->minorder23;
        $harga->harga23 = $request->hargagrosir23;
        $harga->min_order24 = $request->minorder24;
        $harga->harga24 = $request->hargagrosir24;
        $harga->min_order25 = $request->minorder25;
        $harga->harga25 = $request->hargagrosir25;
        $harga->save();

        return redirect('produk')->with('pesan','Ubah Data berhasil.');
    }


    public function destroy($id) {
        $barang = new Barang();
        $hapus = $barang->find($id);
        $hapus->delete();
        return redirect('produk')->with('pesan','Hapus Data berhasil.');
    }


    public function detail($id) {
        $barang = new Barang();
        $query = $barang->find($id);
        $hargamodel = new Hargagrosir();
        $harga = $hargamodel->where('id_barang',$id)->first();
        $judulhalaman = 'Kelola Data Produk - Sistem Informasi Manajemen Percetakan';
            $judulmodul = 'Detail Produk';
        return view('produk/produk_detail',compact('judulmodul','judulhalaman','query','harga'));
    }
*/
//end of class
}
