<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsuarioController extends Controller
{
    
    public function index(Request $request)
    {
        $query = User::query();

        
        if ($request->has('estado')) {
            $query->where('estado', $request->query('estado'));
        }

        $usuarios = $query->get();

        
        return response()->json($usuarios, 200);
    }

   
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|unique:usuarios,email|max:100',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        
        $usuario = User::create([
            'nombre'   => $request->nombre,
            'email'    => $request->email,
            'password' => $request->password, 
            'estado'   => 1 
        ]);

        return response()->json([
            'status' => 'Exitoso',
            'message' => 'Usuario creado exitosamente',
            'data' => $usuario
        ], 201);
    }

    
    public function show(string $id)
    {
        //
    }

   
    public function update(Request $request, string $id)
    {
        $usuario = User::find($id);

        if (!$usuario) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Usuario no encontrado'
            ], 404);
        }

        
        $validator = Validator::make($request->all(), [
            'nombre' => 'sometimes|string|max:100',
            'estado' => 'sometimes|integer|in:0,1',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'Error', 'errors' => $validator->errors()], 422);
        }

        
        $usuario->update($request->only(['nombre', 'estado']));

        return response()->json([
            'status' => 'Exitoso',
            'message' => 'Datos actualizados',
            'data' => $usuario
        ], 200);
    }

    
    public function destroy(string $id)
    {
        $usuario = User::find($id);

        if (!$usuario) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Usuario no encontrado'
            ], 404);
        }

        
        $usuario->estado = 0;
        $usuario->save();

        return response()->json([
            'status' => 'Exitoso',
            'message' => 'Usuario desactivado correctamente'
        ], 200);
    }
}
