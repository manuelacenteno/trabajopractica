document.addEventListener("DOMContentLoaded", iniciar)

function iniciar() {

    "use strict";

    let URL = 'http://localhost/AgenciaDeViajes1/api/comentarios';
    let id = window.location.pathname.substr(window.location.pathname.lastIndexOf('/') + 1);

    let app = new Vue({
        el: "#app",
        data: {
            comments: [],
        },
    });

    console.log(id);


    function getAll() { //funcion para administrador

        fetch(URL, {
                "method": "GET",

            })
            .then(response => response.json()) //=> funcion anonima
            .then(comments => {
                // imprimo las tareas
                app.comments = comments;
            })
            .catch(function(error) {
                console.log(error)
            })

    }
    getAll();

    function get(id) { //funcion para llamar comentarios de un tour

        fetch(URL + "/" + id, {
                "method": "GET",

            })
            .then(response => response.json()) //=> funcion anonima
            .then(comments => {
                renderComments(comments);
            })
            .catch(function(error) {
                console.log(error)
            })

    }
    get(id);


    /*function renderComments(comments) {

        let container = document.querySelector("#tarjeta");
        container.innerHTML = '';

        for (let comment of comments) {

            container.innerHTML += `<h5 class="card-title">${comment.calificacion}</h5>` + `<p class="card-text">${comment.texto}</p>`

            //console.log(comment.texto);


        }

    }*/

    document.querySelector('#formComment').addEventListener('submit', function(event) {

        event.preventDefault();

        addComment();

    });


    function addComment() {
        //armo la tarea
        let comment = {

            "texto": document.querySelector('textarea[name=comentario]').value, //agarra el valor ingresado en el input
            "calificacion": document.querySelector('input[name=inlineRadioOptions]:checked').value,
            "id_tour": document.querySelector('input[name=id]').value,
        }

        fetch(URL, {
                "method": "POST",
                "headers": { "Content-Type": "application/json" },
                "body": JSON.stringify(comment)
            })
            .then(response => response.json())
            .then(comments => {
                getAll(comments);
            })
            .catch(function(error) {
                console.log(error)
            })
    }

    /*document.querySelector('#borrar').addEventListener('submit', function(event) {

        event.preventDefault();

        deleteComment();

    });*/

    function deleteComment() {


        fetch(URL + "/" + id, {
                "method": "DELETE",

            })
            .then(response => response.json())
            .then(comments => {
                getAll(comments);
            })
            .catch(function(e) {
                console.log(e)
            })


    }








}