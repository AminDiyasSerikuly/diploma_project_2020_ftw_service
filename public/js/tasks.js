$(document).ready(function(){
	$('.__js-filter-category').deepcheckbox();
	$('select').formSelect();
	$('#ShowCat').click(function() {
		$('#ThisIsCatsList').slideToggle();
	});

	var _jsCatFilterList = $(".__js-filter-category-item > ul");
	$('.__js-filter-category-subarrow').click(function() {
		$(this).parent().parent().find(_jsCatFilterList).toggle();
	});
	$('.__js-filter-category-label').change(function() {
		$(this).parent().parent().find(_jsCatFilterList).toggle();
	});

	$('.__js-filter-category-item').on('click',function(e){
		if(!$(e.target).hasClass('material-icons')){
			//Тернарные операторы наше всё и глазная боль в одном лице
			e.target.checked ? $(e.currentTarget.children[0].children[1]).css({color:"#fe8c00"}) : $(e.currentTarget.children[0].children[1]).css({color:'black'}) ;
		}
	})
});