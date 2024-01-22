$(document).ready(function(){
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
    });
    var buttonElement = $('<button>').attr('id', 'validate').text('Validar');
    boxDiv.append(h4Element, inputElement, buttonElement);
    containerDiv.append(boxDiv);
    $('body').append(containerDiv);
$('#validate').click(function(){
    validateRegister($(this).prev("input[name]").attr("name"));  
});
});
function validateRegister(inputType){
    console.log(inputType);
    switch(inputType) {
        case "user":
             var nameUser = $('input[name=user]').val();
            if(nameUser.trim()==="" || /\d/.test(nameUser)){
                alert("NOMBRE INCORRECTO");
            }else{
                localStorage.setItem('nameUser',nameUser);
                createBoxEmail();
            }
            break;
    
        case "pwd2":
            if($('input[name=pwd1]').val()===$('input[name=pwd2]').val()){
                var pwd = $('input[name=pwd1]').val();
                if(pwd.trim().length>=8){

                    createBoxSendData(pwd);
                    
                }

                else{
                    alert("La contraseña debe contener como minimo 8 caracteres");
                }
            }else{
                alert("LAS CONTRASEÑAS NO COINCIDEN");
            }
            break;
    
        case "mail":
            var mail = $('input[name=mail]').val();
            if(mail.includes('@') && mail.includes('.') && !mail.includes(' ') && mail.length>2){
                localStorage.setItem('mail',mail);
                createBoxTlf();
            }else{
                alert("EMAIL INCORRECTO");
            }
            break;

        case "tlf":
            var tlf = $('input[name=tlf]').val().replace(/\s/g, '');

            if (!isNaN(tlf) && tlf.length === 9) {
                localStorage.setItem('phone', tlf);
                createBoxCountry();
                
            } else {
                alert("TELÉFONO INCORRECTO");
            }
            break;
            
        case null:
            createBoxCity();
            break;

        case "city":
           var city = $('input[name=city]').val();
            if(city.trim()===""){
                alert("CIUDAD INCORRECTA");
            }else{
                localStorage.setItem('city',city);
                createBoxCode();
            }
            break;

        case "postal_code":
            var code = $('input[name=postal_code]').val().replace(/\s/g, '');

            if (!isNaN(code)) {
                localStorage.setItem('code', code);
                createBoxPwd();
                
            } else {
                alert("CÓDIGO POSTAL INCORRECTO");
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
    form.append('<h4>Haga click en enviar para crear la cuenta</h4>');
    form.append($('<button>').attr('type', 'submit').text('Enviar'));
    var sendDiv = $('<div id="box">').append(form);

    $('.container').append(sendDiv);


}
function createBoxPwd(){
    var pwdDiv = $('<div id="box">').append(
        $('<h4>').text('Ingrese su nueva contraseña:'),
        $('<input>').attr({ type: 'password', name: 'pwd1', placeholder: 'Nueva contraseña'}),
        $('<h4>').text('Repita contraseña'),
        $('<input>').attr({ type: 'password', name: 'pwd2', placeholder: 'Contraseña repetida'}),
        $('<button>').attr({ id: 'validate' }).text('Validar').click(function(){
            validateRegister($(this).prev("input[name]").attr("name"));  
        })
    );

    $('.container').append(pwdDiv);
    
}
async function hashPwd(inputString) {
    const encoder = new TextEncoder();
    const data = encoder.encode(inputString);
    const hashBuffer = await crypto.subtle.digest('SHA-512', data);
    
    // Convertir el buffer de hash a una representación hexadecimal
    const hashArray = Array.from(new Uint8Array(hashBuffer));
    const hashHex = hashArray.map(byte => byte.toString(16).padStart(2, '0')).join('');
    
    return hashHex;
}
function createBoxEmail(){
    var mailDiv = $('<div id="box">').append(
        $('<h4>').text('Ingrese su direccion de correo electrónico:'),
        $('<input>').attr({ type: 'text', name: 'mail', placeholder: 'Correo electrónico'}).on('input', function () {
            $(this).closest('#box').nextAll('#box').remove();
        }),
        $('<button>').attr({ id: 'validate' }).text('Validar').click(function(){
            validateRegister($(this).prev("input[name]").attr("name"));  
        })
    );

    $('.container').append(mailDiv);
    
}
function createBoxTlf(){
    var tlfDiv = $('<div id="box">').append(
        $('<h4>').text('Ingrese su número de teléfono:'),
        $('<input>').attr({ type: 'text', name: 'tlf', placeholder: 'Número de teléfono'}).on('input', function () {
            $(this).closest('#box').nextAll('#box').remove();
        }),
        $('<button>').attr({ id: 'validate' }).text('Validar').click(function(){
            validateRegister($(this).prev("input[name]").attr("name"));  
        })
    );

    $('.container').append(tlfDiv);
    
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
        var selectedCountry = $('#selectCountry').val();
        validateRegister("country");
    }));

    $('.container').append(countryDiv);
}
function createBoxCity(){
    var cityDiv = $('<div id="box">').append(
        $('<h4>').text('Ingrese su ciudad:'),
        $('<input>').attr({ type: 'text', name: 'city', placeholder: 'Ciudad donde se localiza'}).on('input', function () {
            $(this).closest('#box').nextAll('#box').remove();
        }),
        $('<button>').attr({ id: 'validate' }).text('Validar').click(function(){
            validateRegister($(this).prev("input[name]").attr("name"));  
        })
    );

    $('.container').append(cityDiv);
    
}
function createBoxCode(){
    var codeDiv = $('<div id="box">').append(
        $('<h4>').text('Ingrese su código postal:'),
        $('<input>').attr({ type: 'text', name: 'postal_code', placeholder: 'Codigo postal'}).on('input', function () {
            $(this).closest('#box').nextAll('#box').remove();
        }),
        $('<button>').attr({ id: 'validate' }).text('Validar').click(function(){
            validateRegister($(this).prev("input[name]").attr("name"));  
        })
    );
    $('.container').append(codeDiv);
    
}