$(document).ready(function(){
	//Helper text val
	$('._helperjs').click(function() {
		$('#h-form-input').val(this.text);
	});

	$('#_getSMS').click(function() {
		$('._formgetsms').show();
		return false;
	});
});