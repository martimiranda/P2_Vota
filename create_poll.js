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
            options=1;
        });
        var buttonElement = $('<button>').attr('id', 'validate').text('Validar');
        boxDiv.append(h4Element, inputElement, buttonElement);
        containerDiv.append(boxDiv);
        $('#reg').append(containerDiv);
    $('#validate').click(function(){
        if (boxDiv.next('#box').length === 0) {
        validatePoll('question');  }
    });}
});
function validatePoll(type){
    var ok = true;
    switch(type) {
        case "question":
             var nameQuestion = $('input[name=question]').val();
            if(nameQuestion.trim()===""){
                errormessage("La encuesta no puede estar vacia");
            }
            else{
                $('input[name=question]').css('background-color', '#b4e7b3');
                localStorage.setItem('question',nameQuestion);
                createBoxOptions();
            }
            break;
        
        case "options":
            var options = [];
            $('.optionsDiv').find('input').each(function() {
                var val = $(this).val();
                $(this).css('background-color', '#b4e7b3');
                if(val.trim()===""){
                    errormessage("No pueden existir opciones vacias");
                    ok=false;
                    $(this).css('background-color', '');
                } 
                options.push(val);
            });

            if(ok){localStorage.setItem('options', JSON.stringify(options));
            createBoxDate();
        }

            break;

            case "date":
                inicio = $('.startDate').val();
                final = $('.endDate').val();
                var fechaInicio = new Date(inicio);
                var fechaFinal = new Date(final);
                var actual = new Date();
                if(inicio==='' || final===''){
                    errormessage("Las fechas no pueden estar vacias");
                }
                else if(fechaInicio > fechaFinal){
                    errormessage("La fecha de activación tiene que ser anterior a la de finalización");
                }
                else if(final===inicio){
                    errormessage("Las fechas no pueden ser iguales");
                }
                else if(fechaInicio<actual){
                    errormessage("La fecha de activación tiene que ser posterior al momento actual");
                }     
                else if(fechaFinal>fechaInicio && fechaInicio>actual){
                    var start= fechaInicio.toJSON();
                    var end = fechaFinal.toJSON();
                    localStorage.setItem('start',start);
                    localStorage.setItem('end',end);
                    createBoxSendData();
                }          
    
                break;
        }
        
}

function createBoxOptions() {
    var boxDiv = $('<div>').attr('id', 'box').attr('class','optionsDiv');
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
    inputElement.on('input', function () {
        $(this).css('background-color', '');
        $(this).closest('#box').nextAll('#box').remove();
    });
    inputElement2.on('input', function () {
        $(this).css('background-color', '');
        $(this).closest('#box').nextAll('#box').remove();
    });
    var buttonElement = $('<button>').addClass('validate-button').attr('id', 'validate').text('Aceptar');
    var buttonElement2 = $('<button>').addClass('new-button').attr('id', 'new').text('Añadir opcion');

    boxDiv.append(h4Element, inputElement,inputElement2, buttonElement, buttonElement2);
    $('.container').append(boxDiv);
    boxDiv.on('click', '#validate', function () {
        console.log("click");
        if ($(this).closest('#box').next('#box').length === 0) {
            validatePoll('options');
        }
    });
    boxDiv.on('click', '#new', function () {
        options++;
        var inputElement = $('<input>').addClass('input-option').attr({
            type: 'text',
            name: 'option' + options,
            placeholder: 'Escriba aqui su opcion número ' + options
        });
        inputElement.on('input', function () {
            $(this).css('background-color', '');
            $(this).closest('#box').nextAll('#box').remove();
        });
        inputElement.insertBefore($(this).prev('#validate'));
    });
    scrollTo('input[name="option1"]');
    
}
function createBoxDate(){
    var boxDiv = $('<div>').attr('id', 'box').attr('class','optionsDiv');
    var h4Element = $('<h4>').text('Fecha de activación:');
    var h4Element2 = $('<h4>').text('Fecha de finalización:');

    var inputElement = $('<input>').addClass('startDate').attr({
        type: 'datetime-local',
        name: 'startDate',
        placeholder: 'Fecha de activación'
    });
    options++;
    var inputElement2 = $('<input>').addClass('endDate').attr({
        type: 'datetime-local',
        name: 'endDate',
        placeholder: 'Fecha de finalización'
    });
    inputElement.on('change', function () {
        $(this).closest('#box').nextAll('#box').remove();
    });
    inputElement2.on('change', function () {
        $(this).closest('#box').nextAll('#box').remove();
    });
    var buttonElement = $('<button>').addClass('validate-button').attr('id', 'validate').text('Aceptar');

    boxDiv.append(h4Element, inputElement,h4Element2,inputElement2, buttonElement);
    $('.container').append(boxDiv);
    boxDiv.on('click', '#validate', function () {
        console.log("click");
        if ($(this).closest('#box').next('#box').length === 0) {
            validatePoll('date');
        }
    });
    scrollTo('input[name="startDate"]');
}

function createBoxSendData(password) {
    var question = localStorage.getItem('question');
    var optionsString = localStorage.getItem('options');

    var options = JSON.parse(optionsString);

    var start = localStorage.getItem('start');
    var end = localStorage.getItem('end');
    var form = $('<form>').attr({
        action: 'create_poll.php',
        method: 'POST'
    });

    var hiddenFields = [
        { name: 'question', value: question },
        { name: 'start', value: start },
        { name: 'end', value: end }
    ];


    $.each(hiddenFields, function(index, field) {
        $('<input>').attr({
            type: 'hidden',
            name: field.name,
            value: field.value
        }).appendTo(form);
    });


    $.each(options, function(index, option) {
        $('<input>').attr({
            type: 'hidden',
            name: 'option[]', 
            value: option
        }).appendTo(form);
    });

    form.append('<h4>Encuesta creada correctamente!!</h4>');
    form.append($('<button>').attr('type', 'submit').text('Aceptar'));

    var sendDiv = $('<div id="box">').append(form);

    $('.container').append(sendDiv);

    scrollTo('input[name="end"]');


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

    $('body').append(errorWindow);
}


function scrollTo(element) {
    $('html, body').animate({
        scrollTop: $(element).offset().top
    }, 1200); 
}