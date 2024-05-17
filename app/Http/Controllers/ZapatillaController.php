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
        Zapatilla::create($request->all());
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
        $zapatilla->update($request->all());
        return redirect()->route('zapatillas.index');
    }

    public function destroy(Zapatilla $zapatilla)
    {
        $zapatilla->delete();
        return redirect()->route('zapatillas.index');
    }
}
