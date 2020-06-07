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
    $('#phone').inputmask({"mask": "(99) 999-99-99"});
});