<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Literaria;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class LiterariaController extends Controller
{
    public function index() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Habilitasaun Literaria';
            $judulmodul = 'Habilitasaun Literaria';


            $data =  DB::table('literaria')->orderBy('id','DESC')->get();
            return view('literaria/literaria_index',compact('judulmodul','judulhalaman','data'));
        }
    }

	public function save(Request $request)
	{
        $name = $request->name;
        $value = $request->value;

        $data = new literaria();
        $data->name = $name;
        $data->value = $value;
        $data->save();

		echo json_encode(array("status"=>TRUE));
	}
	public function update($id)
	{
        $dataku = new literaria();
		$data=DB::table('literaria')->find($id);
		echo json_encode($data);
	}
	public function updateaction(Request $request)
	{
        $name = $request->name;
        $value = $request->value;

        $dataku = new literaria();
        $data=$dataku->find($request->id);
        $data->name = $name;
        $data->value = $value;
        $data->save();
        echo json_encode(array("status"=>TRUE));
	}
	public function delete($id)
	{
        $dataku = new literaria();
        $data = $dataku->find($id);
        $data->delete();
		echo json_encode(array("status"=>TRUE));
	}

//end of class
}
