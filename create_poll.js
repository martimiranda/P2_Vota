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
        validatePoll($(this).prev("input[name]").attr("name"));  }
    });}
});
function validatePoll(type){

}