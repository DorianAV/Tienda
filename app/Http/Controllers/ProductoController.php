<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::with('categoria')->paginate(5);
        return view('producto.index',compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias=Categoria::pluck('nombre','id');
        return view('producto.create',compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $datos=request()->all();
        if ($request->hasFile('imagen')) {
            $datos['imagen']=$request->file('imagen')->store('uploads','public');
        }
        Producto::create($datos);
        return redirect()->route('producto.index')->with('mensaje','Producto agregado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $producto=Producto::findOrFail($id);
        $categorias=Categoria::pluck('nombre','id');
        return view('producto.edit',compact('producto','categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $producto=Producto::findOrFail($id);
        $datos=$request->all();
        if ($request->hasFile('imagen')) {
            Storage::delete('public/'.$producto->imagen);
            $datos['imagen']=$request->file('imagen')->store('uploads','public');
        }
        $producto->update($datos);
        return redirect('producto')->with('mensaje','Producto modificado correctamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return redirect()->route('producto.index')->with('mensaje','El producto ha sido eliminado');
    }
}
