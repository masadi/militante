<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membru;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class MembruController extends Controller
{
    public function index() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Membru Cooperativa';
            $judulmodul = 'Membru Cooperativa';


            $data =  DB::table('membru')->orderBy('id','DESC')->get();
            return view('membru/membru_index',compact('judulmodul','judulhalaman','data'));
        }
    }

	public function save(Request $request)
	{
        $name = $request->name;
        $value = $request->value;

        $data = new membru();
        $data->name = $name;
        $data->value = $value;
        $data->save();

		echo json_encode(array("status"=>TRUE));
	}
	public function update($id)
	{
        $dataku = new membru();
		$data=DB::table('membru')->find($id);
		echo json_encode($data);
	}
	public function updateaction(Request $request)
	{
        $name = $request->name;
        $value = $request->value;

        $dataku = new membru();
        $data=$dataku->find($request->id);
        $data->name = $name;
        $data->value = $value;
        $data->save();
        echo json_encode(array("status"=>TRUE));
	}
	public function delete($id)
	{
        $dataku = new membru();
        $data = $dataku->find($id);
        $data->delete();
		echo json_encode(array("status"=>TRUE));
	}

//end of class
}
