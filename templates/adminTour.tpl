    
{include 'header.tpl'} 
<h1>Tours</h1>
<main class="container">
    {include 'form_tour.tpl'} 
        {if $error}
            <div class="alert alert-primary">
                {$error}
            </div>
        {/if}

        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Destino</th>
                    <th scope="col">Paquete</th>
                    <th scope="col">Itinerario</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Eliminar</th> 
                    <th scope="col">Actualizar</th>
                </tr>
            </thead>
            <tbody>
                {foreach from=$tours item= $tour}
                    <tr>
                        <th scope="row">{$tour->destinos}</th>
                        <td>{$tour->paquete}</td>
                        <td>{$tour->itinerario}</td>
                        <td>{$tour->precio}</td> 
                        


                        <td><a class='btn btn-danger btn-sm' href='eliminarTour/{$tour->id}'><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                        </svg></a></td>
                        <td><a class='btn btn-danger btn-sm' href='actualizarTour/{$tour->id}'><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                        </svg></a></td>
                    </tr>
                {/foreach}    
            </tbody>
        </table>
        
{include 'footer.tpl'}