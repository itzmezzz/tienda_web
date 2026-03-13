<?php

namespace App\Http\Controllers;
use App\Models\Editorial;
use Illuminate\Http\Request;

class EditorialController extends Controller
{

    public function nuevo(){
        return view('form_editorial');
    }
    function guardar(Request $req){
        $editorial = new Editorial();
        $editorial->nombre = $req->nombre;
        $editorial->save();
}
function lista(){
    $editoriales = Editorial::all();
    return view('lista_editorial', compact('editoriales'));
}
}