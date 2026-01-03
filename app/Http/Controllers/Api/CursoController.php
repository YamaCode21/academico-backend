<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Curso::with('docente')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'docente_id' => 'required|exists:users,id',
        ]);

        return Curso::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Curso $curso)
    {
        return $curso->load('docente');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Curso $curso)
    {
        $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'descripcion' => 'sometimes|required|string',
            'docente_id' => 'sometimes|required|exists:users,id',
        ]);

        $curso->update($request->all());
        return $curso;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Curso $curso)
    {
        $curso->delete();

        return response()->json([
            'message' => 'Curso eliminado'
        ]);
    }
}
