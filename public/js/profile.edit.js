$(document).ready(function(){
    //Form counter
    $('textarea#description_profile').characterCounter();

    //Cities
    var CitySelect = $('#cities');
    $.ajax({
        url: '/tasks/cityajaxupload',
        type: 'GET',
        dataType: 'json'
    }).success(function(data) {
        //CitySelect.empty();
        for(var i=0; i<data.length; i++){
            CitySelect.append('<option value="' + data[i].name + '" data-cid="' + data[i].contry_id + '">' + data[i].name + '</option>');
        }
        CitySelect.formSelect();
    });

    $("#cities").on('change', function() {
        var getnamedata = $(this).find(':selected').data('cid');
        $.getJSON('/tasks/currentajaxupload', {find: getnamedata}, function(data) {
            $.each(data, function(index, result) {
                $('#currently').val(result.name);
            });
        });
    });

    //Select birthdate init
    for (i = 1; i < 32; i++){
    	$('#__jsDays').append($('<option/>').val(i).html(i));
    }
    for (i = 1; i < 13; i++){
    	$('#__jsMonths').append($('<option/>').val(i).html(i));
    }
    for (i = new Date().getFullYear(); i > 1900; i--){
    	$('#__jsYears').append($('<option/>').val(i).html(i));
    }
    $('.birthdate').formSelect();
});