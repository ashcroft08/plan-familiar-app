<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function mostrar()
    {
        return view('home');
    }
    //
    public function guardar(Request $request)
    {
        dd($request->all());

        // Retornar una respuesta exitosa
        return response()->json(['success' => true, 'message' => 'Amenaza guardada correctamente.']);
    }
}
