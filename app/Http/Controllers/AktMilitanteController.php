<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AktMilitante;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class AktMilitanteController extends Controller
{
    public function index() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Aktualizasaun Militantes';
            $judulmodul = 'Aktualizasaun Militantes';


            $data =  DB::table('aktmilitante')->orderBy('id','DESC')->get();
            return view('aktmilitante/aktmilitante_index',compact('judulmodul','judulhalaman','data'));
        }
    }

	public function save(Request $request)
	{
        $name = $request->name;
        $value = $request->value;

        $data = new aktmilitante();
        $data->name = $name;
        $data->value = $value;
        $data->save();

		echo json_encode(array("status"=>TRUE));
	}
	public function update($id)
	{
        $dataku = new aktmilitante();
		$data=DB::table('aktmilitante')->find($id);
		echo json_encode($data);
	}
	public function updateaction(Request $request)
	{
        $name = $request->name;
        $value = $request->value;

        $dataku = new aktmilitante();
        $data=$dataku->find($request->id);
        $data->name = $name;
        $data->value = $value;
        $data->save();
        echo json_encode(array("status"=>TRUE));
	}
	public function delete($id)
	{
        $dataku = new aktmilitante();
        $data = $dataku->find($id);
        $data->delete();
		echo json_encode(array("status"=>TRUE));
	}

//end of class
}
