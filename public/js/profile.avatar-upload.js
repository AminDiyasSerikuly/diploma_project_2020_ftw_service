$(document).ready(function(){
	$("#upload_link").on("click", function(t) {
		t.preventDefault();
		$("#upload:hidden").trigger("click");
	});
});