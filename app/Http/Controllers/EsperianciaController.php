<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Esperiancia;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class EsperianciaController extends Controller
{
    public function index() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Esperiancia Servisu';
            $judulmodul = 'Esperiancia Servisu';


            $data =  DB::table('esperiancia')->orderBy('id','DESC')->get();
            return view('esperiancia/esperiancia_index',compact('judulmodul','judulhalaman','data'));
        }
    }

	public function save(Request $request)
	{
        $name = $request->name;

        $data = new Esperiancia();
        $data->name = $name;
        $data->save();

		echo json_encode(array("status"=>TRUE));
	}
	public function update($id)
	{
        $dataku = new Esperiancia();
		$data=DB::table('esperiancia')->find($id);
		echo json_encode($data);
	}
	public function updateaction(Request $request)
	{
        $name = $request->name;

        $dataku = new Esperiancia();
        $data=$dataku->find($request->id);
        $data->name = $name;
        $data->save();
        echo json_encode(array("status"=>TRUE));
	}
	public function delete($id)
	{
        $dataku = new Esperiancia();
        $data = $dataku->find($id);
        $data->delete();
		echo json_encode(array("status"=>TRUE));
	}

//end of class
}
