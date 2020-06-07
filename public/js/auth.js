$(document).ready(function(){
    //Password viewer
    $(".--tggl-pass").click(function() {
    	$(this).toggleClass("--show");
    	var input = $($(this).attr("toggle"));
    	if (input.attr("type") == "password") {
    		input.attr("type", "text");
            $(".--tggl-pass").text('visibility');
        } else {
          input.attr("type", "password");
          $(".--tggl-pass").text('visibility_off');
        }
    });

    var countryData = window.intlTelInputGlobals.getCountryData(),
    input = document.querySelector("#login");
    for (var i = 0; i < countryData.length; i++) {
        var country = countryData[i];
        country.name = country.name.replace(/.+\((.+)\)/,"$1");
    }
    $("#login").intlTelInput({
        initialCountry: "kz",
        hiddenInput: "phone",
        preferredCountries: ["kz", "tj"],
        onlyCountries: ["kz", "tj", "kg", "uz", "ae", "tr", "cz"],
        utilsScript: "/js/phoneinpt.utils.js"
    });

    var validationData = [
    {name:"capital", value: false, reg : new RegExp("[A-z]") },
    {name:"strLength", value : false, reg : new RegExp("[A-za-z0-9]{8,}") }
    ];
    $("[data-password-validation]").keyup(function(){
        $('.OrzuInputHelper').show();
        var psw = this.value;
        var strength = 0;
        $.each(validationData,function(index,data){
            data.value = data.reg.test(psw);
            $('[data-validate-icon="'+data.name+'"]').attr("class", data.value?"fa fa-check":"fa fa-times");
            strength += (data.value)?100/(validationData.length):0;
            $('[data-validation-progress] .progress-meter').width(strength+"%");
            if(strength == 0){
                $('.progress').removeClass("success");
                $('.progress').removeClass("warning");
            }
            if(strength <= 50 && strength > 0){
                $('.progress').removeClass("success");
                $('.progress').addClass("warning");
            }
            if(strength > 50){
                $('.progress').removeClass("warning");
                $('.progress').addClass("success");
            }      
        });
    });

    // let phone = document.querySelector('#login');
    //
    // phone.addEventListener('keyup', e =>{
    //     console.log(e);
    //     // if(phone.value.length>=0){
    //     if(!parseInt(e.key)){
    //             let check = phone.value.match(/\+\d+/g).join('');
    //             phone.value = check;
    //     }
    //
    //         if(phone.value[0] != '+'){
    //             if(phone.value[0] == 8){
    //                 let change = phone.value.split('');
    //                 change[0] = '+7';
    //                 phone.value=change.join('');
    //             }
    //         }
    //     // }
    //
    // })
});