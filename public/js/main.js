$(document).ready(function(){
	$('#_getSMS').click(function() {
		$('._formgetsms').show();
		return false;
	});
});
if( window.navigator.vendor != "Apple Computer, Inc." ){
if(window.location.pathname === '/' || window.location.pathname === '/home' && $(window).width()>1280){
    	let heightAfter = parseInt($('header').height());
	console.log(heightAfter)
	let headerMargin = parseInt($('header').css('margin-top'));
	// heightAfter-=headerMargin;
	const translation = (arg) => {
			$('body').css({
				'background-position-y':arg+'px'
			})
	}
	let allowScroll = true;
	$(window).bind('scroll',function(e){
		let scrollTop = $(window).scrollTop();
		if(scrollTop >= heightAfter && scrollTop < $(document).height()/2){
			if(allowScroll){
				translation(scrollTop - heightAfter -52 + headerMargin);	
			}else{
				translation(-53 + headerMargin);
			}
		}else if(scrollTop < heightAfter){
			if(allowScroll){
				translation(-53 + headerMargin);
			}
		}
		$(window).width()<1280 ? allowScroll=false
							   : allowScroll=true;
	})
}
}

