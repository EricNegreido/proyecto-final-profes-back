<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|min:2|max:255',
            'apellido' => 'required|min:2|max:255',
            
            'email' => 'required|email|max:255',
            'mensaje' => 'max:500',
        ]);
        
        if ($validatedData) {
            $persona = Persona:: create([
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'email' => $request->email,
                'mensaje' => $request->mensaje,
            ]);
            }

        
        $details = [
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
        ];

       Mail::to($request->email)-> send(new \App\Mail\RegistroMail($details));

        return response()->json ([
            'mensaje' => 'Se inserto correctamente la persona', 
            'data' => [
                'nombre' => $persona->nombre,
                'apellido' => $persona->apellido,
            ]

            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Persona $persona)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Persona $persona)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Persona $persona)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Persona $persona)
    {
        //
    }
}
