<form action="ActulizarRegion" method="POST" class="my-4">
    <div class=" mx-auto">
        <div class="col-9 ">
            <div class="form-group w-50">
                <label>Nombre</label>
                <input name="nombre" type="text" class="form-control">
            </div>
        </div>
        
        <div class="form-group w-50">
            <label>Informacion</label>
            <textarea name="informacion" class="form-control" rows="3"></textarea>
        </div>
        <input name="id" type="hidden" value="{$region->id}">
        
    </div>

    <button type="submit" class="btn btn-primary">Actualizar</button>
</form>