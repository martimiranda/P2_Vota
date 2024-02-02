$(document).ready(function(){
    if ($('#voters_sended').length > 0) {
        $('#box3').remove();
    }

    $('#enviarButton').click(function(){
        var inviteText = $('#inviteText').val();
        var voters = inviteText.split('\n');
        var error = false;
        for (var i = 0; i < voters.length; i++) {
            var voter = voters[i].trim(); 
        
            if (voter !== '') {
                if (!voter.includes('@') || !voter.includes('.') || voter.includes(' ') || voter.length <= 2) {
                    errormessage('Error en los datos, Comprueba que todos los correos sean correos correctos.');
                    error = true;
                    break;
                }
            } else {
                
                voters.splice(i, 1);
                i--; 
            }
        }
        if(!error){
            $('#box3').remove();
            createBoxSendData(voters);

        }
    });
});

function createBoxSendData(voters) {


    var options = voters;

    var form = $('<form>').attr({
        action: 'inviteVoters.php',
        method: 'POST'
    });




    $.each(options, function(index, option) {
        $('<input>').attr({
            type: 'hidden',
            name: 'option[]', 
            value: option
        }).appendTo(form);
    });

    form.append('<h4>Mails de los invitados correctos!!</h4>');
    form.append($('<button>').attr('type', 'submit').text('Invitar'));

    var sendDiv = $('<div id="box">').append(form);

    $('.container').append(sendDiv);

    scrollTo('form');


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