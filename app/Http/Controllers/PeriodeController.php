<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periode;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class PeriodeController extends Controller
{
    public function index() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Periode';
            $judulmodul = 'Periode';


            $data =  DB::table('periode')->orderBy('id','DESC')->get();
            return view('periode/periode_index',compact('judulmodul','judulhalaman','data'));
        }
    }

	public function save(Request $request)
	{
        $name = $request->name;

        $data = new Periode();
        $data->name = $name;
        $data->save();

		echo json_encode(array("status"=>TRUE));
	}
	public function update($id)
	{
        $dataku = new Periode();
		$data=DB::table('periode')->find($id);
		echo json_encode($data);
	}
	public function updateaction(Request $request)
	{
        $name = $request->name;

        $dataku = new Periode();
        $data=$dataku->find($request->id);
        $data->name = $name;
        $data->save();
        echo json_encode(array("status"=>TRUE));
	}
	public function delete($id)
	{
        $dataku = new Periode();
        $data = $dataku->find($id);
        $data->delete();
		echo json_encode(array("status"=>TRUE));
	}

//end of class
}
