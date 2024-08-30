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
        return view('producto.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::pluck('nombre', 'id');
        return view('producto.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $campos = [
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string|max:1000',
            'precio' => 'required|numeric',
            'categoria_id' => 'required|integer|exists:categorias,id',
            'imagen' => 'required|mimes:jpeg,bmp,png,jpg'

        ];
        $mensaje = [
            'required' => 'El :attribute es requerido',
            'imagen.mimes' => 'La imagen debe ser jpeg, bmp o png',
        ];
        $this->validate($request, $campos, $mensaje);
        $datos = request()->all();
        if ($request->hasFile('imagen')) {
            $datos['imagen'] = $request->file('imagen')->store('uploads', 'public');
        }
        Producto::create($datos);
        return redirect()->route('producto.index')->with('mensaje', 'Producto agregado correctamente');
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
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::pluck('nombre', 'id');
        return view('producto.edit', compact('producto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $campos = [
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string|max:1000',
            'precio' => 'required|numeric',
            'categoria_id' => 'required|integer|exists:categorias,id',
        ];
        $mensaje = [
            'required' => 'El :attribute es requerido',
        ];
        $this->validate($request, $campos, $mensaje);
        $producto = Producto::findOrFail($id);
        $datos = $request->all();
        if ($request->hasFile('imagen')) {
            Storage::delete('public/' . $producto->imagen);
            $datos['imagen'] = $request->file('imagen')->store('uploads', 'public');
        }
        $producto->update($datos);
        return redirect('producto')->with('mensaje', 'Producto modificado correctamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return redirect()->route('producto.index')->with('mensaje', 'El producto ha sido eliminado');
    }

    public function stock($id)
    {
        $producto = Producto::findOrFail($id);
        return view('producto.stock', compact('producto'));
    }

    public function updateStock(Request $request, $id)
    {

        $producto = Producto::findOrFail($id);
        $campos = [
            'stock' => 'required|numeric|min:0'
        ];
        $mensaje = [
            'required' => 'El :attribute es requerido',
            'min' => 'El :attribute debe ser mayor a 0',
        ];
        $this->validate($request, $campos, $mensaje);
        $producto->update(['stock' => $request->input('stock')]);

        return redirect()->route('producto.index')->with('mensaje', 'Stock actualizado correctamente');
    }

    public function trashed()
    {
        $productos = Producto::onlyTrashed()->paginate(5);
        return view('producto.trashed',compact('productos'));
    }

    public function restore($id)
    {
        $producto = Producto::where('id',$id)->withTrashed()->restore();
        return redirect()->route('producto.trashed')->with('mensaje', 'Producto restaurado correctamente');
    }

    public function forceDelete($id)
    {
        $producto = Producto::where('id',$id)->withTrashed()->forceDelete();
        return redirect()->route('producto.trashed')->with('mensaje', 'Producto eliminado correctamente');
    }
}
