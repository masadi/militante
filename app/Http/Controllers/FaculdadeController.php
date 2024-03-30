<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faculdade;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class FaculdadeController extends Controller
{
    public function index() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Faculdade/Departamento';
            $judulmodul = 'Faculdade/Departamento';


            $data =  DB::table('faculdade')->orderBy('id','DESC')->get();
            return view('faculdade/faculdade_index',compact('judulmodul','judulhalaman','data'));
        }
    }

	public function save(Request $request)
	{
        $name = $request->name;

        $data = new Faculdade();
        $data->name = $name;
        $data->save();

		echo json_encode(array("status"=>TRUE));
	}
	public function update($id)
	{
        $dataku = new Faculdade();
		$data=DB::table('faculdade')->find($id);
		echo json_encode($data);
	}
	public function updateaction(Request $request)
	{
        $name = $request->name;

        $dataku = new Faculdade();
        $data=$dataku->find($request->id);
        $data->name = $name;
        $data->save();
        echo json_encode(array("status"=>TRUE));
	}
	public function delete($id)
	{
        $dataku = new Faculdade();
        $data = $dataku->find($id);
        $data->delete();
		echo json_encode(array("status"=>TRUE));
	}

//end of class
}
