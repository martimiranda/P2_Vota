var options =1;
$(document).ready(function(){
    if ($('#poll_created').length === 0) {
        var containerDiv = $('<div>').addClass('container');
        var boxDiv = $('<div>').attr('id', 'box');
        var h4Element = $('<h4>').text('Encuesta a realizar:');
        var inputElement = $('<input>').attr({
            type: 'text',
            name: 'question',
            placeholder: 'Escriba aqui su encuesta'
        });
        inputElement.on('input', function () {
            $(this).closest('#box').nextAll('#box').remove();
            $(this).css('background-color', '');
        });
        var buttonElement = $('<button>').attr('id', 'validate').text('Validar');
        boxDiv.append(h4Element, inputElement, buttonElement);
        containerDiv.append(boxDiv);
        $('body').append(containerDiv);
    $('#validate').click(function(){
        if (boxDiv.next('#box').length === 0) {
        validatePoll('question');  }
    });}
});
function validatePoll(type){
    switch(type) {
        case "question":
             var nameQuestion = $('input[name=question]').val();
            if(nameQuestion.trim()===""){
                errormessage("La encuesta no puede estar vacia");
            }
            else{
                $('input[name=user]').css('background-color', '#b4e7b3');
                localStorage.setItem('question',nameQuestion);
                createBoxOptions();
            }
            break;
        }
}

function createBoxOptions() {
    var containerDiv = $('<div>').addClass('container');
    var boxDiv = $('<div>').addClass('box-options').attr('id', 'box');
    var h4Element = $('<h4>').text('Opciones de respuesta:');

    var inputElement = $('<input>').addClass('input-option').attr({
        type: 'text',
        name: 'option' + options,
        placeholder: 'Escriba aqui su opcion número ' + options
    });
    options++;
    var inputElement2 = $('<input>').addClass('input-option').attr({
        type: 'text',
        name: 'option' + options,
        placeholder: 'Escriba aqui su opcion número ' + options
    });

    var buttonElement = $('<button>').addClass('validate-button').attr('id', 'validate' + options).text('Aceptar');
    var buttonElement2 = $('<button>').addClass('new-button').attr('id', 'new' + options).text('Añadir opcion');

    boxDiv.append(h4Element, inputElement,inputElement2, buttonElement, buttonElement2);
    containerDiv.append(boxDiv);
    $('body').append(containerDiv);

    // Incrementa el contador de opciones
    options++;

    $('#validate' + (options - 1)).click(function () {
        if ($(this).closest('.box-options').next('.box-options').length === 0) {
            validatePoll('question');
        }
    });
   
}

function errormessage(message) {
    var errorWindow = $('<div>').addClass('error-window');
    var titleBar = $('<div>').addClass('title-bar');
    var closeButton = $('<div>').addClass('close-button').click(function () {
        $('body').css('filter', 'none');
        errorWindow.remove();
    });
    titleBar.append(closeButton);

    var content = $('<div>').addClass('content');
    var errorImage = $('<img>').attr({
        src: 'img/error.png',
        alt: 'Error Image'
    }).addClass('error-image');

    var textAndButton = $('<div>').addClass('text-and-button');
    var h2Element = $('<h2 id="errormessage">').text('Error');
    var pElement = $('<p>').text(message);
    var acceptButton = $('<button>').addClass('accept-button').text('Aceptar').click(function () {
        errorWindow.remove();
    });
    textAndButton.append(h2Element, pElement, acceptButton);

    content.append(errorImage, textAndButton);
    errorWindow.append(titleBar, content);

    // Añadir la ventana emergente al final del body
    $('body').append(errorWindow);
}


