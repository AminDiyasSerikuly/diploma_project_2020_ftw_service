$(document).ready(function(){
    //Tabs init
    $('.tabs').tabs();
    //Collapsible init
    $('.collapsible').collapsible();
    var elem = document.querySelector('.collapsible.expandable');
    var instance = M.Collapsible.init(elem, {
    	accordion: false
    });

    //Inputs mask
    //$('#phone').inputmask({"mask": "(999) 99-9999"});

    //Password viewer
    $(".--tggl-pass").click(function() {
    	$(this).toggleClass("--show");
    	var input = $($(this).attr("toggle"));
    	if (input.attr("type") == "password") {
    		input.attr("type", "text");
    	} else {
    		input.attr("type", "password");
    	}
    });
});