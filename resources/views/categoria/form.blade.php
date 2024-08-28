<div class="container">
    <form action="{{url('/categoria')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de la Categoria</label>
            <input type="text" class="form-control" id="nombre" name="nombre">
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
        <a href="{{route('categoria.index')}}" class="btn btn-success">Regresar</a>
    </form>

</div>

