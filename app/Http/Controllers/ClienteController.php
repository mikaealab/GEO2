<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Importar el modelo Cliente
use App\Models\Cliente;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Consulta de Clientes en la base de datos
        $clientes = Cliente::all();
        // Redenrizar la vista y pasar datos
        return view('clientes.index', compact('clientes'))->with('message', 'Cliente creado correctamente');
    }

    /**
     * Show the form for creating a new resource        
     */

    
    public function mapa()
    {
        // Consulta de Clientes en la base de datos
        $clientes = Cliente::all();
        // Redenrizar la vista y pasar datos
        return view('clientes.mapa', compact('clientes'))->with('message', 'Cliente creado correctamente');
    }
    /**    
     * Funcion que renderiza un mapa con las ubicaciones  de todos los clientes
     */


    public function create()
    {
        //Redenrizando el formulario para crear un nuevo cliente
        return view('clientes.nuevo') ->with('message', 'Cliente creado correctamente');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Capturar valores y almacenarlos en la base de datos
        $datos =[
            'cedula' => $request->cedula,
            'apellido' => $request->apellido,
            'nombre' => $request->nombre,
            'latitud' => $request->latitud,
            'longitud' => $request->longitud,
        ];
        Cliente::create($datos);
        return redirect()->route('clientes.index') ->with('message', 'Cliente creado correctamente');
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
        $cliente = Cliente::find($id);
        return view('clientes.editar', compact('cliente')) ->with('message', 'Cliente editado correctamente');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $cliente = Cliente::find($id);
        $cliente->cedula = $request->cedula;
        $cliente->apellido = $request->apellido;
        $cliente->nombre = $request->nombre;
        $cliente->latitud = $request->latitud;
        $cliente->longitud = $request->longitud;
        $cliente->save();
        return redirect()->route('clientes.index') ->with('message', 'Cliente editado correctamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $cliente = Cliente::find($id);
        $cliente->delete();
        return redirect()->route('clientes.index') ->with('message', 'Cliente borrado correctamente');
    }
}
