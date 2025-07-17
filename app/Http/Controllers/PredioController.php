<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Predio;

class PredioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Obteniendo todos los predios de la base de datos
        $predios = Predio::all();
        //Renderizando la vista con los predios
        return view('predios.index', compact('predios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Renderizando el formulario para crear un nuevo predio
        return view('predios.nuevo');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datos = [
            'propietario' => $request->propietario,
            'clave' => $request->clave,
            'latitud1' => $request->latitud1,
            'longitud1' => $request->longitud1,
            'latitud2' => $request->latitud2,
            'longitud2' => $request->longitud2,
            'latitud3' => $request->latitud3,
            'longitud3' => $request->longitud3,
            'latitud4' => $request->latitud4,
            'longitud4' => $request->longitud4,
        ];
        //Guardando los datos en la base de datos
        Predio::create($datos);
        return redirect()->route('predios.index')->with('success', 'Predio creado exitosamente');
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
        $predio = Predio::findOrFail($id);
        return view('predios.editar', compact('predio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $predio = Predio::findOrFail($id);
        $predio->update([
            'propietario' => $request->propietario,
            'clave' => $request->clave,
            'latitud1' => $request->latitud1,
            'longitud1' => $request->longitud1,
            'latitud2' => $request->latitud2,
            'longitud2' => $request->longitud2,
            'latitud3' => $request->latitud3,
            'longitud3' => $request->longitud3,
            'latitud4' => $request->latitud4,
            'longitud4' => $request->longitud4,
        ]);
        return redirect()->route('predios.index')->with('success', 'Predio actualizado exitosamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $predio = Predio::findOrFail($id);
        $predio->delete();
        return redirect()->route('predios.index')->with('success', 'Predio eliminado exitosamente');
    }
}
