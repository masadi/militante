<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Escola;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class EscolaController extends Controller
{
    public function index() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Escola/ Universidade';
            $judulmodul = 'Escola/ Universidade';


            $data =  DB::table('escola')->orderBy('id','DESC')->get();
            return view('escola/escola_index',compact('judulmodul','judulhalaman','data'));
        }
    }

	public function save(Request $request)
	{
        $name = $request->name;

        $data = new Escola();
        $data->name = $name;
        $data->save();

		echo json_encode(array("status"=>TRUE));
	}
	public function update($id)
	{
        $dataku = new Escola();
		$data=DB::table('escola')->find($id);
		echo json_encode($data);
	}
	public function updateaction(Request $request)
	{
        $name = $request->name;

        $dataku = new Escola();
        $data=$dataku->find($request->id);
        $data->name = $name;
        $data->save();
        echo json_encode(array("status"=>TRUE));
	}
	public function delete($id)
	{
        $dataku = new Escola();
        $data = $dataku->find($id);
        $data->delete();
		echo json_encode(array("status"=>TRUE));
	}

//end of class
}
