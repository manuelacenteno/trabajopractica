{include 'header.tpl'} 

<h1>Comentarios</h1>

<ul class='list-group mt-5'>

{foreach from=$comentarios item= $comentario}
    
         <li class='list-group-item d-flex justify-content-between'>
         <div class='info'>
         {$comentario->calificacion}|{$comentario->texto}
         </li>
         </div>
            
{/foreach}

</ul>   

{include 'footer.tpl'}
                    

                       
                 