<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::paginate(5);
        return view('categoria.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datos=request()->all();
        Categoria::create($datos);
        return redirect()->route('categoria.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categoria=Categoria::findOrFail($id);
        return view('categoria.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $categoria=Categoria::findOrFail($id);
        $datos=request()->all();
        $categoria->update($datos);
        return redirect('categoria')->with('mensaje','Categoria Actualizada Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $producto= Producto::where('categoria_id', $id)->count();
        if ($producto==0) {
            $categoria->delete();
            return redirect()->route('categoria.index')->with('mensaje', 'Categoría eliminada correctamente.');
        } else {

            return redirect()->route('categoria.index')->with('mensaje', 'No se puede eliminar la categoría porque tiene productos asociados.');
        }
    }
    public function trashed()
    {
        $categorias = Categoria::onlyTrashed()->paginate(5);
        return view('categoria.trashed',compact('categorias'));
    }

    public function restore($id)
    {
        $categoria = Categoria::where('id',$id)->withTrashed()->restore();
        return redirect()->route('categoria.trashed')->with('mensaje', 'Categoria restaurado correctamente');
    }

    public function forceDelete($id)
    {
        $categoria = Categoria::where('id',$id)->withTrashed()->forceDelete();
        return redirect()->route('categoria.trashed')->with('mensaje', 'Categoria eliminado correctamente');
    }
}
