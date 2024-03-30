<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profisaun;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class ProfisaunController extends Controller
{
    public function index() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Profisaun';
            $judulmodul = 'Profisaun';


            $data =  DB::table('profisaun')->orderBy('id','DESC')->get();
            return view('profisaun/profisaun_index',compact('judulmodul','judulhalaman','data'));
        }
    }

	public function save(Request $request)
	{
        $name = $request->name;
        $value = $request->value;

        $data = new profisaun();
        $data->name = $name;
        $data->value = $value;
        $data->save();

		echo json_encode(array("status"=>TRUE));
	}
	public function update($id)
	{
        $dataku = new profisaun();
		$data=DB::table('profisaun')->find($id);
		echo json_encode($data);
	}
	public function updateaction(Request $request)
	{
        $name = $request->name;
        $value = $request->value;

        $dataku = new profisaun();
        $data=$dataku->find($request->id);
        $data->name = $name;
        $data->value = $value;
        $data->save();
        echo json_encode(array("status"=>TRUE));
	}
	public function delete($id)
	{
        $dataku = new profisaun();
        $data = $dataku->find($id);
        $data->delete();
		echo json_encode(array("status"=>TRUE));
	}

//end of class
}
