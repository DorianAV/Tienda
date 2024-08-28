
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Producto</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{isset($producto->nombre)?$producto->nombre:''}}">
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required >{{isset($producto->descripcion)?$producto->descripcion:''}}</textarea>
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" class="form-control" id="precio" name="precio" step="0.01" required value="{{isset($producto->precio)?$producto->precio:''}}">
        </div>
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen del Producto</label>
            @if(isset($producto->imagen))
                <br>
                <img src="{{asset('storage').'/'.$producto->imagen}}" width="200">
            @endif
            <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" required>
        </div>
        <div class="mb-3">
            <label for="categoria_id" class="form-label">Categoría</label>
            <select class="form-select" id="categoria_id" name="categoria_id" required>
                <option value="">Selecciona una categoría</option>
                <option value="1">Electrónica</option>
                <option value="2">Ropa</option>
                <option value="3">Hogar</option>
                <option value="5">Juguetes</option>
                <option value="4">Otros</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
        <a href="{{route('producto.index')}}" class="btn btn-success">Regresar</a>
