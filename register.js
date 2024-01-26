$(document).ready(function(){
    if ($('#account_created').length === 0) {
    var containerDiv = $('<div>').addClass('container');
    var boxDiv = $('<div>').attr('id', 'box');
    var h4Element = $('<h4>').text('Ingrese su nombre:');
    var inputElement = $('<input>').attr({
        type: 'text',
        name: 'user',
        placeholder: 'Nombre completo'
    });
    inputElement.on('input', function () {
        $(this).closest('#box').nextAll('#box').remove();
        $(this).css('background-color', '');
    });
    var buttonElement = $('<button>').attr('id', 'validate').text('Validar');
    boxDiv.append(h4Element, inputElement, buttonElement);
    containerDiv.append(boxDiv);
    $('#reg').append(containerDiv);
$('#validate').click(function(){
    if (boxDiv.next('#box').length === 0) {
    validateRegister($(this).prev("input[name]").attr("name"));  }
});}

});
function validateRegister(inputType){
    console.log(inputType);
    switch(inputType) {
        case "user":
             var nameUser = $('input[name=user]').val();
            if(nameUser.trim()===""){
                errormessage("El nombre no puede estar vacio");
            }
            else if(/\d/.test(nameUser)){
                errormessage("El nombre no puede contener numeros");
            }
            else{
                $('input[name=user]').css('background-color', '#b4e7b3');
                localStorage.setItem('nameUser',nameUser);
                createBoxEmail();
            }
            break;
    
        case "pwd2":
            if($('input[name=pwd1]').val()===$('input[name=pwd2]').val()){
                var pwd = $('input[name=pwd1]').val();
                if(pwd.trim().length>=8){
                    $('input[name=pwd1]').css('background-color', '#b4e7b3');
                    $('input[name=pwd2]').css('background-color', '#b4e7b3');
                    createBoxSendData(pwd);
                    
                }

                else{
                    errormessage("La contraseña debe contener como minimo 8 caracteres");
                }
            }else{
                errormessage("Las contraseñas no coinciden");
            }
            break;
    
        case "mail":
            var mail = $('input[name=mail]').val();
            if(mail.includes('@') && mail.includes('.') && !mail.includes(' ') && mail.length>2){
                localStorage.setItem('mail',mail);
                $('input[name=mail]').css('background-color', '#b4e7b3');
                createBoxTlf();
            }else{
                errormessage("Email incorrecto. El campo correo electrónico debe contener como minimo el carácter '@' y '.'");
            }
            break;

        case "tlf":
            var tlf = $('input[name=tlf]').val().replace(/\s/g, '');

            if (!isNaN(tlf) && tlf.length === 9) {
                localStorage.setItem('phone', tlf);
                $('input[name=tlf]').css('background-color', '#b4e7b3');
                createBoxCountry();
                
            } else {
                errormessage("Teléfono incorrecto. El campo de teléfono deben ser 9 numeros");
            }
            break;
            
        case null:
            createBoxCity();
            break;

        case "city":
           var city = $('input[name=city]').val();
            if(city.trim()===""){
                errormessage("El campo ciudad no puede estar vacio");
            }else{
                $('input[name=city]').css('background-color', '#b4e7b3');
                localStorage.setItem('city',city);
                createBoxCode();
            }
            break;

        case "postal_code":
            var code = $('input[name=postal_code]').val().replace(/\s/g, '');

            if (!isNaN(code)) {
                $('input[name=postal_code]').css('background-color', '#b4e7b3');
                localStorage.setItem('code', code);
                createBoxPwd();
                
            } else {
                errormessage("El código postal debe estar compuesto solo de numeros");
            }
            break;

        case "country":
            var country = $('#selectCountry').val();
            localStorage.setItem('country',country);
            createBoxCity();
            break;
}
}
function createBoxSendData(password) {
    var user = localStorage.getItem('nameUser');
    var pwd = password;
    var mail = localStorage.getItem('mail');
    var phone = localStorage.getItem('phone');
    var city = localStorage.getItem('city');
    var code = localStorage.getItem('code');
    var country = localStorage.getItem('country');
    var form = $('<form>').attr({
        action: 'register.php',
        method: 'POST'
    });

    var hiddenFields = [
        { name: 'user', value: user },
        { name: 'pwd', value: pwd },
        { name: 'email', value: mail },
        { name: 'tel', value: phone },
        { name: 'country', value: country },
        { name: 'city', value: city },
        { name: 'postal', value: code }
    ];

    $.each(hiddenFields, function(index, field) {
        $('<input>').attr({
            type: 'hidden',
            name: field.name,
            value: field.value
        }).appendTo(form);
    });

    form.append('<h4>Datos de registro correctas!!</h4>');
    form.append($('<button>').attr('type', 'submit').text('Enviar'));
    var sendDiv = $('<div id="box">').append(form);

    $('.container').append(sendDiv);


}
function createBoxPwd(){
    var pwdDiv = $('<div id="box">').append(
        $('<h4>').text('Ingrese su nueva contraseña:'),
        $('<input>').attr({ type: 'password', name: 'pwd1', placeholder: 'Nueva contraseña'}).on('input', function () {
            $(this).closest('#box').nextAll('#box').remove();
            $(this).css('background-color', '');
        }),
        $('<h4>').text('Repita contraseña'),
        $('<input>').attr({ type: 'password', name: 'pwd2', placeholder: 'Contraseña repetida'}).on('input', function () {
            $(this).closest('#box').nextAll('#box').remove();
            $(this).css('background-color', '');
        }),
        $('<button>').attr({ id: 'validate' }).text('Validar').click(function(){
            if (pwdDiv.next('#box').length === 0) {
                validateRegister($(this).prev("input[name]").attr("name"));  } 
        })
    );

    $('.container').append(pwdDiv);

    scrollTo('input[name="pwd1"]');

    
}

function createBoxEmail(){
    var mailDiv = $('<div id="box">').append(
        $('<h4>').text('Ingrese su direccion de correo electrónico:'),
        $('<input>').attr({ type: 'text', name: 'mail', placeholder: 'Correo electrónico'}).on('input', function () {
            $(this).closest('#box').nextAll('#box').remove();
            $(this).css('background-color', '');
        }),
        $('<button>').attr({ id: 'validate' }).text('Validar').click(function(){
            if (mailDiv.next('#box').length === 0) {
                validateRegister($(this).prev("input[name]").attr("name"));  }  
        })
    );

    $('.container').append(mailDiv);

    scrollTo('input[name="mail"]');

    
}
function createBoxTlf(){
    var tlfDiv = $('<div id="box">').append(
        $('<h4>').text('Ingrese su número de teléfono:'),
        $('<input>').attr({ type: 'text', name: 'tlf', placeholder: 'Número de teléfono'}).on('input', function () {
            $(this).closest('#box').nextAll('#box').remove();
            $(this).css('background-color', '');
        }),
        $('<button>').attr({ id: 'validate' }).text('Validar').click(function(){
            if (tlfDiv.next('#box').length === 0) {
                validateRegister($(this).prev("input[name]").attr("name"));  }
        })
    );

    $('.container').append(tlfDiv);

    scrollTo('input[name="tlf"]');
    
}
function createBoxCountry() {
    var countryDiv = $('<div id="box">').append(
        $('<h4>').text('Escoja su país de nacimiento:'),
    );

    var select = $('<select>').attr('id', 'selectCountry');

    var options = countries_php;

    $.each(options, function (index, value) {
      $('<option>').text(value).appendTo(select);
    });
    select.on('change', function () {
        $(this).closest('#box').nextAll('#box').remove();
    });
    countryDiv.append(select);

    countryDiv.append($('<button>').attr({ id: 'validate' }).text('Validar').click(function(){
        if (countryDiv.next('#box').length === 0) {
            validateRegister("country");  }
        
    }));

    $('.container').append(countryDiv);

    scrollTo('select[id="selectCountry"]');

}
function createBoxCity(){
    var cityDiv = $('<div id="box">').append(
        $('<h4>').text('Ingrese su ciudad:'),
        $('<input>').attr({ type: 'text', name: 'city', placeholder: 'Ciudad donde se localiza'}).on('input', function () {
            $(this).closest('#box').nextAll('#box').remove();
            $(this).css('background-color', '');
        }),
        $('<button>').attr({ id: 'validate' }).text('Validar').click(function(){
            if (cityDiv.next('#box').length === 0) {
                validateRegister($(this).prev("input[name]").attr("name"));  }
        })
    );

    $('.container').append(cityDiv);

    scrollTo('input[name="city"]');

    
}
function createBoxCode(){
    var codeDiv = $('<div id="box">').append(
        $('<h4>').text('Ingrese su código postal:'),
        $('<input>').attr({ type: 'text', name: 'postal_code', placeholder: 'Codigo postal'}).on('input', function () {
            $(this).closest('#box').nextAll('#box').remove();
            $(this).css('background-color', '');
        }),
        $('<button>').attr({ id: 'validate' }).text('Validar').click(function(){
            if (codeDiv.next('#box').length === 0) {
                validateRegister($(this).prev("input[name]").attr("name"));  }  
        })
    );
    $('.container').append(codeDiv);

    scrollTo('input[name="postal_code"]');

    
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

function scrollTo(element) {
    $('html, body').animate({
        scrollTop: $(element).offset().top
    }, 1200); 
}


