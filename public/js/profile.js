//review textarea
(function () {
    var submit_focus = false;
    $('#891284').focus(function () {
        $('.--ratebtn').show();
    }).blur(function () {
        if (submit_focus) {
            submit_focus = true;
        } else {
            $('.--ratebtn').hide();
        }
    });
    $('.--ratebtn').mousedown(function () {
        submit_focus = true;
    });
}());

$(document).ready(function(){
    //review rate thumb
    var _rateBtnLike = $('.switch .--like');
    var _rateBtnDislike = $('.switch .--dislike');
    $(".--rateSwitch").change(function() {
        if($(this).is(":checked")) {
          _rateBtnLike.addClass("active");
          _rateBtnDislike.removeClass("active");
      } else {
          _rateBtnDislike.addClass("active");
          _rateBtnLike.removeClass("active");
      }
  })
});