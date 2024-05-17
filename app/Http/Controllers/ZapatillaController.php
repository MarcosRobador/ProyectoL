<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zapatilla;
use Illuminate\Support\Facades\Storage;

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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Imagen obligatoria
        ]);

        // Almacenar la imagen
        $data = $request->only(['nombre', 'descripcion', 'precio', 'stock']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('zapatillas', 'public');
        }

        Zapatilla::create($data);

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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Imagen obligatoria
        ]);

        // Almacenar la imagen
        $data = $request->only(['nombre', 'descripcion', 'precio', 'stock']);
        if ($request->hasFile('image')) {
            if ($zapatilla->image) {
                Storage::delete('public/' . $zapatilla->image);
            }
            $data['image'] = $request->file('image')->store('zapatillas', 'public');
        }

        $zapatilla->update($data);

        return redirect()->route('zapatillas.index');
    }

    public function destroy(Zapatilla $zapatilla)
    {
        if ($zapatilla->image) {
            Storage::delete('public/' . $zapatilla->image);
        }
        $zapatilla->delete();
        return redirect()->route('zapatillas.index');
    }
}
