<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SectorServico;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class SectorServicoController extends Controller
{
    public function index() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Sector Servico';
            $judulmodul = 'Sector Servico';


            $data =  DB::table('sectorservico')->orderBy('id','DESC')->get();
            return view('sectorservico/sectorservico_index',compact('judulmodul','judulhalaman','data'));
        }
    }

	public function save(Request $request)
	{
        $name = $request->name;
        $value = $request->value;

        $data = new sectorservico();
        $data->name = $name;
        $data->value = $value;
        $data->save();

		echo json_encode(array("status"=>TRUE));
	}
	public function update($id)
	{
        $dataku = new sectorservico();
		$data=DB::table('sectorservico')->find($id);
		echo json_encode($data);
	}
	public function updateaction(Request $request)
	{
        $name = $request->name;
        $value = $request->value;

        $dataku = new sectorservico();
        $data=$dataku->find($request->id);
        $data->name = $name;
        $data->value = $value;
        $data->save();
        echo json_encode(array("status"=>TRUE));
	}
	public function delete($id)
	{
        $dataku = new sectorservico();
        $data = $dataku->find($id);
        $data->delete();
		echo json_encode(array("status"=>TRUE));
	}

//end of class
}
