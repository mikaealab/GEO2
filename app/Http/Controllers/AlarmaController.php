<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alarma;
class AlarmaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alarma = Alarma::all();
        return view('alarmas.index', compact('alarma'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('alarmas.nuevo');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $alarmas = [
            'serie' => $request->serie,
            'responsable' => $request->responsable,
            'tipo' => $request->tipo,
            'radio' => $request->radio,
            'latitud' => $request->latitud,
            'longitud' => $request->longitud
        ];
        Alarma::create($alarmas);
        // Pasar mensaje a la vista con nombre 'message'
        return redirect()->route('alarmas.index')->with('message', 'Alarma creada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}