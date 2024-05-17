<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zapatilla;

class ZapatillaController extends Controller
{
    public function index()
    {
        $zapatillas = Zapatilla::all();
        return view('zapatillas.index', compact('zapatillas'));
    }

    public function create()
    {
        return view('zapatillas.create');
    }

    public function store(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'nombre' => 'required|string|max:255|min:3',
            'descripcion' => 'required|string|min:10',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        // Crear una nueva zapatilla
        Zapatilla::create($request->only(['nombre', 'descripcion', 'precio', 'stock']));

        return redirect()->route('zapatillas.index');
    }

    public function show(Zapatilla $zapatilla)
    {
        return view('zapatillas.show', compact('zapatilla'));
    }

    public function edit(Zapatilla $zapatilla)
    {
        return view('zapatillas.edit', compact('zapatilla'));
    }

    public function update(Request $request, Zapatilla $zapatilla)
    {
        // Validar la solicitud
        $request->validate([
            'nombre' => 'required|string|max:255|min:3',
            'descripcion' => 'required|string|min:10',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        // Actualizar la zapatilla
        $zapatilla->update($request->only(['nombre', 'descripcion', 'precio', 'stock']));

        return redirect()->route('zapatillas.index');
    }

    public function destroy(Zapatilla $zapatilla)
    {
        $zapatilla->delete();
        return redirect()->route('zapatillas.index');
    }
}
