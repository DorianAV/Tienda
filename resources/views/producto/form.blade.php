<div class="mb-3">
    <label for="nombre" class="form-label">Nombre del Producto</label>
    <input type="text" class="form-control" id="nombre" name="nombre"
           value="{{isset($producto->nombre)?$producto->nombre:''}}">
</div>
<div class="mb-3">
    <label for="descripcion" class="form-label">Descripción</label>
    <textarea class="form-control" id="descripcion" name="descripcion" rows="3"
              >{{isset($producto->descripcion)?$producto->descripcion:''}}</textarea>
</div>
<div class="mb-3">
    <label for="precio" class="form-label">Precio</label>
    <input type="number" class="form-control" id="precio" name="precio" step="0.01"
           value="{{isset($producto->precio)?$producto->precio:''}}">
</div>
<div class="mb-3">
    <label for="imagen" class="form-label">Imagen del Producto</label>
    @if(isset($producto->imagen))
        <br>
        <img src="{{asset('storage').'/'.$producto->imagen}}" width="200">
    @endif
    <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
</div>
<div class="mb-3">
    <label for="categoria_id" class="form-label">Categoría</label>
    <select class="form-select" id="categoria_id" name="categoria_id" >
        @foreach($categorias as $id => $nombre)
            <option value="{{$id}}" {{ isset($producto->categoria_id) && $producto->categoria_id == $id ? 'selected' : '' }}>
                {{$nombre}}
            </option>
        @endforeach
    </select>
</div>
<button type="submit" class="btn btn-primary">Enviar</button>
<a href="{{route('producto.index')}}" class="btn btn-success">Regresar</a>
