<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

class PersonaController extends Controller
{
    //
    
    public function index() 
    { 
    $personas = Persona::orderBy('id')->get(); 
    return response()->json($personas, 200); 
    } 
    public function show(int $id) 
    { 
    $persona = Persona::findOrFail($id); 
    return response()->json($persona, 200); 
    } 
}
